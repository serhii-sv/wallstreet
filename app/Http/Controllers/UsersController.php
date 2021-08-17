<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestBonusUser;
use App\Http\Requests\RequestPenaltyUser;
use App\Models\ActivityLog;
use App\Models\Deposit;
use App\Models\Permission;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{
    public function index(Request $request) {
        $users_count = User::count();
        if (request()->ajax()) {
            $filter_role = $request->get('roles') ? $request->get('roles') : false;
            $users = User::when($filter_role, function ($query) use ($filter_role) {
                return $query->role($filter_role);
            })->orderByDesc('created_at');

            if (isset($request->search['value']) && !is_null($request->search['value'])) {
                $users->where(function ($query) use ($request) {
                    foreach ($request->columns as $column) {
                        if ($column["searchable"] == "true") {
                            $query->orWhere($column["data"], 'like', '%' . $request->search['value'] . '%');
                        }
                    }
                });
            }

            $recordsFiltered = $users->count();
            $users->limit($request->length)->offset($request->start);
            $data = [];

            foreach ($users->get() as $user) {
                $data[] = [
                    'empty' => view('pages.users.partials.checkbox', compact('user'))->render(),
                    'user' => view('pages.users.partials.avatar')->render(),
                    'name' => $user->name ?? 'Не указано',
                    'email' => $user->email ?? 'Не указано',
                    'country' => $user->country ?? 'Не указано',
                    'actions' => view('pages.users.partials.actions', compact('user'))->render()
                ];
            }

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' =>  $users_count,
                'recordsFiltered' => $recordsFiltered,
                'data' => $data
            ]);
        } else {
            $roles = Role::all();
            return view('pages.sample.app-contacts', compact('users_count', 'roles'));
        }
    }

    /**
     * @param Request $request
     * @param string  $id
     */
    public function updateStat(Request $request, string $id) {
        /** @var User $user */
        $user = User::findOrFail($id);

        $user->stat_salary_percent = (float)$request->stat['stat_salary_percent'];
        $user->stat_worker_withdraw = (float)$request->stat['stat_worker_withdraw'];
        $user->stat_additional = (string)$request->stat['stat_additional'];
        $user->save();

        return redirect()->back();
    }

    /**
     * @param $userId
     *
     * @return mixed
     * @throws \Exception
     */
    public function dataTableWrs($userId) {
        /** @var TransactionType $transactionWithdrawalType */
        $transactionWithdrawalType = TransactionType::getByName('withdraw');
        /** @var Transaction $wrs */
        $wrs = Transaction::select('transactions.*')->with([
            'currency',
            'paymentSystem',
            'user',
            'wallet',
        ])->where('type_id', $transactionWithdrawalType->id)->where('user_id', $userId);

        return Datatables::of($wrs)->addColumn('status', function (Transaction $transaction) {
                return $transaction->isApproved() ? __('approved') : __('new');
            })->editColumn('amount', function (Transaction $transaction) {
                return number_format($transaction->amount, $transaction->wallet->currency->precision, '.', '');
            })->make(true);
    }

    public function dataTableDeposits($userId) {
        $deposits = Deposit::where('user_id', $userId)->with('rate', 'currency')->select('deposits.*');

        return Datatables::of($deposits)->editColumn('condition', function ($deposit) {
                return __($deposit->condition);
            })->make(true);
    }

    public function dataTableTransactions($userId) {
        $transactions = Transaction::where('user_id', $userId)->with('currency', 'type')->select('transactions.*');

        return Datatables::of($transactions)->addColumn('type_name', function ($transaction) {
                return __($transaction->type->name);
            })->editColumn('approved', function ($transaction) {
                return __($transaction->approved == 1 ? 'yes' : 'no');
            })->make(true);
    }

    public function bonus(RequestBonusUser $request) {
        $wallet = Wallet::find($request->wallet_id);
        $wallet = $wallet->addBonus($request->amount);
        if ($wallet) {
            // send notification to user
            $data = [
                'bonus_amount' => $request->amount,
                'currency' => $wallet->currency,
                'payment_system' => $wallet->paymentSystem,
                'balance' => $wallet->balance,
            ];
            //            $wallet->user->sendNotification('bonus_accrued', $data);
            return back()->with('success', __('Bonus accrued'));
        }
        return back()->with('error', __('Unable to accrue bonus'));
    }

    public function penalty(RequestPenaltyUser $request) {
        /** @var Wallet $wallet */
        $wallet = Wallet::find($request->wallet_id);
        $wallet = $wallet->removeAmount($request->amount);

        if ($wallet) {
            // send notification to user
            $data = [
                'bonus_amount' => $request->amount,
                'currency' => $wallet->currency,
                'payment_system' => $wallet->paymentSystem,
                'balance' => $wallet->balance,
            ];
            //            $wallet->user->sendNotification('penalty_accrued', $data);
            return back()->with('success', __('Penalty handled'));
        }
        return back()->with('error', __('Unable to handle penalty'));
    }

    public function show(Request $request, User $user) {
        $level = $request->has('level') ? $request->level : 1;
        $plevel = $request->has('plevel') ? $request->plevel : 1;

        $stat_deposits = $user->transactions()->where('type_id', TransactionType::getByName('enter')->id)->where('approved', 1)->sum('main_currency_amount');
        $stat_withdraws = $user->transactions()->where('type_id', TransactionType::getByName('withdraw')->id)->where('approved', 1)->sum('main_currency_amount');
        $stat_different = $stat_deposits - $stat_withdraws;
        $stat_salary = $stat_different / 100 * $user->stat_salary_percent;
        $stat_left = $stat_salary - $user->stat_worker_withdraw;

        $user->stat_deposits = $stat_deposits;
        $user->stat_withdraws = $stat_withdraws;
        $user->stat_different = $stat_different;
        $user->stat_salary = $stat_salary;
        $user->stat_left = $stat_left;
        $user->save();

        $userActivityDay = ActivityLog::getActivityLog($user, 'day');
        $userActivityWeek = ActivityLog::getActivityLog($user, 'week');
        $userActivityMonth = ActivityLog::getActivityLog($user, 'month');

        $deposit_sum = $user->transactions()->where('type_id', TransactionType::getByName('create_dep')->id)->where('approved', 1)->sum('main_currency_amount');

        return view('pages.sample.page-users-view', [
            'user' => $user,
            'deposit_sum' => $deposit_sum,
            'balance_usd' => $user->wallets()->sum('main_currency_amount'),
            'userActivityDay' => $userActivityDay,
            'userActivityWeek' => $userActivityWeek,
            'userActivityMonth' => $userActivityMonth,
        ]);
    }

    public function edit(User $user) {

        $roles = Role::all();
        $permissions = Permission::all();
        return view('pages.sample.page-users-edit', [
            'roles' => $roles,
            'permissions' => $permissions,
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user) {
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email',
        ]);
        if ($user->update($request->except([
            'permissions',
            'roles',
            'password',
        ]))) {
            if ($request->roles) {
                $user->syncRoles($request->roles);
            }
            if ($request->permissions) {
                $user->syncPermissions($request->permissions);
            }
            return redirect()->route('users.show', $user)->with('success','Пользователь успешно изменён!')->with('success_short', 'Пользователь успешно изменён!');
        } else {
            return back()->with('error', __('Unable to update user'))->withInput();
        }
    }

    public function destroy(User $user) {
        if ($user->delete()) {
            return redirect()->route('admin.users.index')->with('success', __('User has been deleted'));
        }
        return redirect()->route('admin.users.index')->with('error', __('Unable to delete user'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lockUser() {
        Session::put('locked', true);
        return redirect()->route('user.locked');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function lockedUser() {
        return view('pages.sample.user-lock-screen');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlockUser(Request $request) {
        $user_id = $request->get('user_id');
        $password = $request->get('password');
        $user = User::find($user_id);

        if (Hash::check($password, $user->password)){
            Session::forget('locked');
            Session::put('last_activity', now());
            return redirect()->route('home');
        }else{
            return redirect()->back()->withErrors(['Попробуй заново!']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function activityByDate(Request $request)
    {
        list($dateFrom, $dateTo) = explode('/', $request->date);

        $user = User::findOrFail($request->user_id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Пользователь не найден.'
            ]);
        }

        $userActivity = ActivityLog::getActivityLog($user, null, $dateFrom, $dateTo);

        return \response()->json([
            'success' => true,
            'html' => view('pages.partials.user-activity-item', compact('dateFrom', 'dateTo', 'userActivity'))->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function massRoleChange(Request $request)
    {
        $users = User::whereIn('id', $request->list)->get();

        $role = Role::findOrFail($request->role_id);

        foreach ($users as $user) {
            $user->roles()->sync([$role->id]);
        }

        return back()->with('success_short', 'Пользователям назначена роль: ' . $role->name);
    }

}
