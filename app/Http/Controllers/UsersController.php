<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestBonusUser;
use App\Http\Requests\RequestPenaltyUser;
use App\Models\Deposit;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Role;
use Webpatser\Countries\Countries;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $filter_role = $request->get('roles') ? $request->get('roles') : false;
        $users = User::when($filter_role, function($query) use ($filter_role){
            return $query->role($filter_role);
        })->orderByDesc('created_at')->paginate(10);
        $users_count = User::count();
        $roles = Role::all();
        return view('pages.sample.app-contacts', compact('users','users_count', 'roles'));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function dataTable()
    {
        $users = User::orderBy('created_at', 'desc');

        return Datatables::of($users)->addColumn('show', function ($user) {
            return route('admin.users.show', ['id' => $user->id]);
        })->addColumn('edit', function ($user) {
            return route('admin.users.edit', ['id' => $user->id]);
        })->make(true);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, User $user)
    {
        $level = $request->has('level') ? $request->level : 1;
        $plevel = $request->has('plevel') ? $request->plevel : 1;

        $stat_deposits = $user->transactions()
            ->where('type_id', TransactionType::getByName('enter')->id)
            ->where('approved', 1)
            ->sum('main_currency_amount');
        $stat_withdraws = $user->transactions()
            ->where('type_id', TransactionType::getByName('withdraw')->id)
            ->where('approved', 1)
            ->sum('main_currency_amount');
        $stat_different = $stat_deposits - $stat_withdraws;
        $stat_salary = $stat_different / 100 * $user->stat_salary_percent;
        $stat_left = $stat_salary - $user->stat_worker_withdraw;

        $user->stat_deposits    = $stat_deposits;
        $user->stat_withdraws   = $stat_withdraws;
        $user->stat_different   = $stat_different;
        $user->stat_salary      = $stat_salary;
        $user->stat_left        = $stat_left;
        $user->save();

        return view('admin/users/show', [
            'user'      => $user,
            'level'     => $level,
            'plevel'    => $plevel,
        ]);
    }

    /**
     * @param Request $request
     * @param string $id
     */
    public function updateStat(Request $request, string $id)
    {
        /** @var User $user */
        $user = User::findOrFail($id);

        $user->stat_salary_percent = (float) $request->stat['stat_salary_percent'];
        $user->stat_worker_withdraw = (float) $request->stat['stat_worker_withdraw'];
        $user->stat_additional = (string) $request->stat['stat_additional'];
        $user->save();

        return redirect()->back();
    }

    /**
     * @param $userId
     * @return mixed
     * @throws \Exception
     */
    public function dataTableWrs($userId)
    {
        /** @var TransactionType $transactionWithdrawalType */
        $transactionWithdrawalType = TransactionType::getByName('withdraw');
        /** @var Transaction $wrs */
        $wrs = Transaction::select('transactions.*')->with([
            'currency',
            'paymentSystem',
            'user',
            'wallet',
        ])
            ->where('type_id', $transactionWithdrawalType->id)
            ->where('user_id', $userId);

        return Datatables::of($wrs)
            ->addColumn('status', function (Transaction $transaction) {
                return $transaction->isApproved() ? __('approved') : __('new');
            })
            ->editColumn('amount', function (Transaction $transaction) {
                return number_format($transaction->amount, $transaction->wallet->currency->precision, '.', '');
            })
            ->make(true);
    }

    /**
     * @param $userId
     * @return mixed
     * @throws \Exception
     */
    public function dataTableDeposits($userId)
    {
        $deposits = Deposit::where('user_id', $userId)
            ->with('rate', 'currency')
            ->select('deposits.*');

        return Datatables::of($deposits)
            ->editColumn('condition', function ($deposit) {
                return __($deposit->condition);
            })
            ->make(true);
    }

    /**
     * @param $userId
     * @return mixed
     * @throws \Exception
     */
    public function dataTableTransactions($userId)
    {
        $transactions = Transaction::where('user_id', $userId)
            ->with('currency', 'type')
            ->select('transactions.*');

        return Datatables::of($transactions)
            ->addColumn('type_name', function ($transaction) {
                return __($transaction->type->name);
            })
            ->editColumn('approved', function ($transaction) {
                return __($transaction->approved == 1 ? 'yes' : 'no');
            })
            ->make(true);
    }

    /**
     * @param RequestBonusUser $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bonus(RequestBonusUser $request)
    {
        $wallet = Wallet::find($request->wallet_id);
        $wallet = $wallet->addBonus($request->amount);
        if ($wallet) {
            // send notification to user
            $data = [
                'bonus_amount'   => $request->amount,
                'currency'       => $wallet->currency,
                'payment_system' => $wallet->paymentSystem,
                'balance'        => $wallet->balance,
            ];
//            $wallet->user->sendNotification('bonus_accrued', $data);
            return back()->with('success', __('Bonus accrued'));
        }
        return back()->with('error', __('Unable to accrue bonus'));
    }

    /**
     * @param RequestPenaltyUser $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function penalty(RequestPenaltyUser $request)
    {
        /** @var Wallet $wallet */
        $wallet = Wallet::find($request->wallet_id);
        $wallet = $wallet->removeAmount($request->amount);

        if ($wallet) {
            // send notification to user
            $data = [
                'bonus_amount'   => $request->amount,
                'currency'       => $wallet->currency,
                'payment_system' => $wallet->paymentSystem,
                'balance'        => $wallet->balance,
            ];
//            $wallet->user->sendNotification('penalty_accrued', $data);
            return back()->with('success', __('Penalty handled'));
        }
        return back()->with('error', __('Unable to handle penalty'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin/users/edit', ['roles' => $roles, 'user' => $user]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email',
            'password' => 'nullable|min:6',
        ]);

        if ($user->update($request->except(['roles', 'password']))) {
            if (!empty($request->get('password'))) {
                $user->setPassword($request->password);
            }
            if ($request->roles) {
                $user->syncRoles($request->roles);
            }
            return redirect()->route('admin.users.show', ['id' => $user->id])->with('success', __('User has been updated'));
        } else {
            return back()->with('error', __('Unable to update user'))->withInput();
        }
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return redirect()->route('admin.users.index')->with('success', __('User has been deleted'));
        }
        return redirect()->route('admin.users.index')->with('error', __('Unable to delete user'));
    }
}
