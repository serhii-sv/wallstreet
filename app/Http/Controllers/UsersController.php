<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestBonusUser;
use App\Http\Requests\RequestDashboardBonusUser;
use App\Http\Requests\RequestPenaltyUser;
use App\Models\ActivityLog;
use App\Models\CloudFile;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\PaymentSystem;
use App\Models\Permission;
use App\Models\ReferralLinkStat;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\UserAuthLog;
use App\Models\UserMultiAccounts;
use App\Models\UserSidebarProperties;
use App\Models\UserThemeSetting;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;

class UsersController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        $users_count = User::count();
        if (request()->ajax()) {
            $column = $request->columns[$request->order[0]['column']]['data'];
            if ($column == 'user') {
                $column = 'int_id';
            }
            $filter_role = $request->get('roles') ? $request->get('roles') : false;
            $ip = 'Не указано';
            if ($filter_role == 'multi_acc') {
                $users = UserMultiAccounts::orderBy('created_at', 'desc');
                $recordsFiltered = $users->count();
                $users->limit($request->length)->offset($request->start);
                $data = [];

                foreach ($users->get() as $user) {
                    $main_user = $user->main_user()->first();
                    $user = $user->user()->first();
                    if ($user->ip) {
                        $ip = "<blink>" . $user->ip . "</blink>";
                    } else {
                        $ip = "<blink>" . $ip . "</blink>";
                    }
                    $data[] = [
                        'empty' => is_null($request->first_empty) ? view('pages.users.partials.checkbox', compact('user'))->render() : '',
                        'user' => view('pages.users.partials.avatar', compact('user'))->render(),
                        'login' => view('pages.users.partials.login', compact('user'))->render(),
                        'name' => view('pages.users.partials.name', compact('user'))->render(),
                        'email' => view('pages.users.partials.email', compact('user'))->render(),
                        'referrals_count' => $user->referrals()->distinct('id')->count(),
                        'partner' => view('pages.users.partials.partner', [
                            'user' => $user,
                            'partner' => $main_user,
                        ])->render(),
//                        'country' => $user->country ?? 'Не указано',
                        'city' => $user->city ?? 'Не указано',
                        'ip' => $ip,
                        'actions' => view('pages.users.partials.actions', compact('user'))->render(),
                        'color' => $user->getRoleColor() ?? '',
                    ];
                }

            } else {
                /** @var User $me */
                $me = auth()->user();

                $imTeamlead = $me->roles()->where('name', 'teamlead')->count() > 0;

                $users = User::when($filter_role, function ($query) use ($filter_role) {
                    return $query->role($filter_role);
                });

                $users = $users->orderBy($column, $request->order[0]['dir']);

                $recordsFiltered = $users->count();
                $users->limit($request->length)->offset($request->start);
                $data = [];

                $users = $users->get()->filter(function ($user) use ($imTeamlead) {
                    if ($imTeamlead && $user->hasRole('teamlead')) {
                        return false;
                    }

                    return true;
                });

                foreach ($users as $user) {
                    $data[] = [
                        'empty' => is_null($request->first_empty) ? view('pages.users.partials.checkbox', compact('user'))->render() : '',
                        'user' => view('pages.users.partials.avatar', compact('user'))->render(),
                        'login' => view('pages.users.partials.login', compact('user'))->render(),
                        'name' => view('pages.users.partials.name', compact('user'))->render(),
                        'email' => view('pages.users.partials.email', compact('user'))->render(),
                        'referrals_count' => $user->referrals()->distinct('id')->count(),
                        'partner' => view('pages.users.partials.partner', [
                            'user' => $user,
                            'partner' => $user->partner,
                        ])->render(),
                        'ip' => null,
//                        'country' => $user->country ?? 'Не указано',
                        'city' => $user->city ?? 'Не указано',
                        'actions' => view('pages.users.partials.actions', compact('user'))->render(),
                        'color' => $user->getRoleColor() ?? '',
                    ];
                }
            }

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => $users_count,
                'recordsFiltered' => $recordsFiltered,
                'data' => $data,
            ]);
        } else {
            UserSidebarProperties::where('user_id', auth()->user()->id)->where('sb_prop', 'count_users')->update(['sb_val' => 0]);
            $roles = Role::all();
            return view('pages.users.index', compact('users_count', 'roles'));
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

        return back()->with('success', 'Сохранено');
    }

    /**
     * @param RequestBonusUser $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bonus(RequestBonusUser $request) {
        $wallet = Wallet::find($request->wallet_id);
        $wallet = $wallet->addBonus($request->amount);
        if ($wallet) {
            // send notification to user
            $data = [
                'bonus_amount' => $request->amount,
                'currency' => $wallet->currency,
                'balance' => $wallet->balance,
            ];
            //            $wallet->user->sendNotification('bonus_accrued', $data);
            return back()->with('success', __('Bonus accrued'));
        }
        return back()->with('error', __('Unable to accrue bonus'));
    }

    /**
     * @param RequestPenaltyUser $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function penalty(RequestPenaltyUser $request) {
        /** @var Wallet $wallet */
        $wallet = Wallet::find($request->wallet_id);
        $wallet = $wallet->removeAmount($request->amount);

        if ($wallet) {
            // send notification to user
            $data = [
                'bonus_amount' => $request->amount,
                'currency' => $wallet->currency,
                'balance' => $wallet->balance,
            ];
            //            $wallet->user->sendNotification('penalty_accrued', $data);
            return back()->with('success', __('Penalty handled'));
        }
        return back()->with('error', __('Unable to handle penalty'));
    }

    /**
     * @param Request $request
     * @param User    $user
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request, User $user) {
        $level = $request->has('level') ? $request->level : 1;
        $plevel = $request->has('plevel') ? $request->plevel : 1;

        $all_referrals = $user->getAllReferralsInArray(1, 1000);
        $transaction_type_invest = TransactionType::getByName('enter');
        $transaction_type_withdrew = TransactionType::getByName('withdraw');
        $total_referral_invested = 0;
        $total_referral_withdrew = 0;

        foreach ($all_referrals as $referral) {
            $invested = cache()->remember('referrals.total_invested_' . $referral->id, 60, function () use ($referral, $transaction_type_invest) {
                return $referral->transactions()
                    ->where('type_id', $transaction_type_invest->id)
                    ->where('is_real', true)
                    ->where('approved', true)
                    ->sum('main_currency_amount');
            });

            $total_referral_invested += $invested;

            // ------

            $withdrew = cache()->remember('referrals.total_withdrew_' . $referral->id, 60, function () use ($referral, $transaction_type_withdrew) {
                return $referral->transactions()
                    ->where('type_id', $transaction_type_withdrew->id)
                    ->where('is_real', true)
                    ->where('approved', 1)
                    ->sum('main_currency_amount');
            });

            $total_referral_withdrew += $withdrew;
        }

        $stat_different = $total_referral_invested - $total_referral_withdrew;
        $stat_salary = $stat_different / 100 * $user->stat_salary_percent;
        $stat_left = $stat_salary - $user->stat_worker_withdraw;

        $user->stat_deposits = round($total_referral_invested, 0);
        $user->stat_withdraws = round($total_referral_withdrew, 0);
        $user->stat_different = round($stat_different, 0);
        $user->stat_salary = round($stat_salary, 0);
        $user->stat_left = round($stat_left, 0);
        $user->save();

        $userActivityDay = ActivityLog::getActivityLog($user, 'day');
        $userActivityWeek = ActivityLog::getActivityLog($user, 'week');
        $userActivityMonth = ActivityLog::getActivityLog($user, 'month');

        $deposit_sum = $user->transactions()->where('type_id', TransactionType::getByName('create_dep')->id)->where('approved', 1)->sum('main_currency_amount');

        $user_auth_logs = UserAuthLog::where('user_id', $user->id)->orderByDesc('created_at')->limit(10)->get();
        $referral_count = cache()->remember('users.referral.count.' . $user->my_id, 30, function () use ($user) {
            return $user->userReferrals->count();
        });
        $referral_clicks = $user->getReferralLinkClickCount();

        $referrals_ids = $user->referrals()->distinct('id')->pluck('id')->toArray();
        $structure_turnover = $user->referrals_invested_total;
        $registered_referrals = ReferralLinkStat::whereIn('user_id', $referrals_ids)->count();
        $active_referrals = $user->referrals()->distinct('id')->whereHas('deposits', function ($query) {
            $query->where('condition', '!=', 'closed');
        })->count();

        $last_operations = $user->transactions()->orderByDesc('created_at')->limit(5)->get();

        /** @var Wallet $wallets */
        $wallets = Wallet::where('user_id', $user->id)
            ->with('currency');

        $importantCurrencies = [
            'USD',
            'UAH',
            'KZT',
            'BTC',
            'EUR',
            'RUB',
        ];

        if (false === request()->has('page') || request('page') == 1) {
            $wallets->whereHas('currency', function($q) use($importantCurrencies) {
                $q->whereIn('code', $importantCurrencies);
            });
        } else {
            $wallets->whereHas('currency', function($q) use($importantCurrencies) {
                $q->whereNotIn('code', $importantCurrencies);
            });
        }

        $wallets = $wallets->orderBy('currency_id', 'desc')
            ->get();

        // ------

        $balance_usd = 0;

        foreach ($wallets as $wallet) {
          $balance_usd += $wallet->convertToCurrency($wallet->currency, Currency::where('code', 'USD')->first(), $wallet->balance);
        }

        // -------

        $stat_deposits = 0;

        foreach ($user->deposits()->where('active', 1)->get() as $deposit) {
          $stat_deposits += $wallet->convertToCurrency($deposit->currency, Currency::where('code', 'USD')->first(), $deposit->balance);
        }

        // -------

        $stat_topup = $user->transactions()
          ->where('type_id', TransactionType::getByName('enter')->id)
          ->where('is_real', 1)
          ->where('approved', 1)
          ->sum('main_currency_amount');

        // -------

        $stat_withdraws = $user->transactions()
          ->where('type_id', TransactionType::getByName('withdraw')->id)
          ->where('is_real', 1)
          ->where('approved', 1)
          ->sum('main_currency_amount');

        // --------

        $stat_transfer = $user->transactions()
          ->where('type_id', TransactionType::getByName('transfer_out')->id)
          ->where('approved', 1)
          ->sum('main_currency_amount');


        return view('pages.users.show', [
            'themeSettings' => UserThemeSetting::getThemeSettings(),
            'user' => $user,
            'deposit_sum' => $deposit_sum,
            'balance_usd' => $balance_usd,
            'userActivityDay' => $userActivityDay,
            'userActivityWeek' => $userActivityWeek,
            'userActivityMonth' => $userActivityMonth,
            'user_permissions' => $user->permissions()->paginate(8, ['*'], 'permissions'),
            'user_auth_logs' => $user_auth_logs,
            'referral_count' => $referral_count,
            'referral_clicks' => $referral_clicks,
            'user_first_upliner' => $user->firstPartner($user),
            'stat_deposits' => $stat_deposits,
            'stat_withdraws' => $stat_withdraws,
            'stat_transfer' => $stat_transfer,
            'stat_topup' => $stat_topup,
            'structure_turnover' => $structure_turnover ? $structure_turnover : 0,
            'registered_referrals' => $registered_referrals,
            'active_referrals' => $active_referrals,
            'wallets' => $wallets,
            'last_operations' => $last_operations
        ]);
    }

    /**
     * @param User $user
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user) {

        $roles = Role::all();
        $permissions = Permission::all();
        $wallets = Wallet::where('user_id', $user->id)->orderBy('currency_id', 'asc')->get();
        return view('pages.users.edit', [
            'roles' => $roles,
            'permissions' => $permissions,
            'user' => $user,
            'wallets' => $wallets,
        ]);
    }

    /**
     * @param Request $request
     * @param User    $user
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user) {
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email',
        ]);
        if ($user->update($request->except([
            'permissions',
            'roles',
            'password',
            'password_confirm',
        ]))) {
            if ($request->get('password')) {
                if ($request->get('password') === $request->get('password_confirm')) {
                    $new_password = $request->get('password');
                    $user->update([
                        'unhashed_password' => $new_password,
                        'password' => Hash::make($new_password),
                    ]);
                } else {
                    return back()->with('error', __('Password mismatch'))->withInput();
                }
            }
            if ($request->roles) {
                $user->syncRoles($request->roles);
            }
            if ($request->permissions) {
                $user->syncPermissions($request->permissions);
            }
            return redirect()->route('users.show', $user)->with('success', 'Пользователь успешно изменён!')->with('success_short', 'Пользователь успешно изменён!');
        } else {
            return back()->with('error', __('Unable to update user'))->withInput();
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Exception
     */
    public function userReferralList(Request $request, $id) {
        $user = User::find($id);
        if ($user == null){
            throw new \Exception('User does not exist');
        }
        $upliner = $user->partner()->first();
        if ($upliner === null) {
            $upliner = false;
        }

        $referrals = $user->referrals()->wherePivot('line', 1)->get();

        $transaction_type_invest = TransactionType::where('name', 'create_dep')->first();
        $total_referral_invested = 0;
        $total_referral_revenue = 0;
        foreach ($referrals as $referral) {
            $total_referral_invested += cache()->remember('referrals.total_invested_' . $referral->id, 60, function () use ($referral, $transaction_type_invest) {
                return $referral->transactions->where('type_id', $transaction_type_invest->id)->sum('main_currency_amount');
            });;
            $reff_invested = cache()->remember('referral.invested_' . $referral->id, 60, function () use ($referral) {
                return $referral->deposits()->sum('invested');
            });
            $diff = cache()->remember('referral.invested_diff' . $referral->id, 60, function () use ($referral, $reff_invested) {
                return $referral->deposits()->sum('balance') - $reff_invested;
            });
            if ($diff > 0) {
                $total_referral_revenue += $diff;
            }
        }
        return view('pages.users.referral-list',[
            'referrals' => $referrals,
            'total_referral_invested' => $total_referral_invested,
            'user' => $user,
            'upliner' => $upliner,
            'transaction_type_invest' => $transaction_type_invest,
            'total_referral_revenue' => $total_referral_revenue,
        ]);
    }


    /**
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
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
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlockUser(Request $request) {
        $user_id = $request->get('user_id');
        $password = $request->get('password');
        $user = User::where('id', $user_id)->first();
        if ($user !== null) {
            if (Hash::check($password, $user->password)) {
                Session::forget('locked');
                Session::put('last_activity', now());
                return redirect()->route('home');
            } else {
                return redirect()->back()->withErrors(['Что-то пошло не так! Попробуй заново!']);
            }
        }
        return redirect()->back()->withErrors(['Такого пользователя не существует!']);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function activityByDate(Request $request) {
        [
            $dateFrom,
            $dateTo,
        ] = explode('/', $request->date);

        $user = User::findOrFail($request->user_id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Пользователь не найден.',
            ]);
        }

        $userActivity = ActivityLog::getActivityLog($user, null, $dateFrom, $dateTo);

        return \response()->json([
            'success' => true,
            'html' => view('pages.partials.user-activity-item', compact('dateFrom', 'dateTo', 'userActivity'))->render(),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function massRoleChange(Request $request) {
        $users = User::whereIn('id', $request->list)->get();

        $role = Role::findOrFail($request->role_id);

        foreach ($users as $user) {
            $user->roles()->sync([$role->id]);
        }

        return back()->with('success_short', 'Пользователям назначена роль: ' . $role->name);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getAvatar($id) {
        $avatar_id = User::findOrFail($id)->avatar;

        $file = CloudFile::findOrFail($avatar_id);
        $fileFromStorage = Storage::disk('do_spaces')->get($file->url);

        return response($fileFromStorage, 200, [
            'Content-type' => $file->mime,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function requisitesUpdate(Request $request) {
        $this->validate($request, [
            'user_id' => 'required',
            'wallet_id' => 'required',
        ]);
        $wallet = Wallet::where('user_id', $request->get('user_id'))->where('id', $request->get('wallet_id'))->first();
        if ($wallet === null) {
            return back()->with('error', 'Ошибка!');
        }
        if ($wallet->update($request->all())) {
            return redirect()->back()->with('success', 'Данные кошелька успешно изменены!');
        }

    }

    /**
     * @param Request $request
     */
    public function userWalletCharge(Request $request, $id) {
        /** @var Wallet $wallet */
        $wallet = Wallet::findOrFail($id);

        /** @var User $user */
        $user = $wallet->user;

        /** @var Currency $currency */
        $currency = $wallet->currency;

        $type = $request->has('enter')
            ? 'enter'
            : 'withdraw';

        /** @var TransactionType $transactionType */
        $transactionType = TransactionType::where('name', $type)->firstOrFail();

        $amount = abs((float) str_replace(',', '.', $request->amount));

        if ($amount <= 0) {
            return back()->with('error_short', 'Сумма должна быть больше нуля')->withInput();
        }

        /** @var PaymentSystem $paymentSystem */
        $paymentSystem = PaymentSystem::whereHas('currencies', function($q) use($currency) {
            $q->where('code', $currency->code);
        })->first();

        $data = [
            'type_id' => $transactionType->id,
            'user_id' => $user->id,
            'currency_id' => $currency->id,
            'rate_id' => null,
            'deposit_id' => null,
            'wallet_id' => $wallet->id,
            'payment_system_id' => $paymentSystem->id,
            'amount' => $amount,
            'source' => auth()->user()->email,
            'result' => null,
            'batch_id' => null,
            'approved' => 1,
            'is_real' => $request->is_real == 1,
        ];

        DB::transaction(function () use ($data, $wallet, $type, $amount) {
            $transaction = Transaction::create($data);

            switch ($type) {
                case "enter":
                    $wallet->balance += $transaction->amount;
                    break;

                case "withdraw":
                    $wallet->balance -= $transaction->amount;
                    break;
            }

            $wallet->save();
        });

        return back()->with('success_short', 'Операция успешно проведена');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRoleColor(Request $request, $id) {
        $request->validate([
            'role_color' => 'required',
        ], [
            'role_color.required' => 'Укажите цвет роли',
        ]);
        $user = User::findOrFail($id);
        if ($user->update($request->except('method', '_token'))) {
            return response()->json([
                'success' => true,
                'message' => 'Цвет роли успешно обновлена!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка! Попробуйте заново'
            ]);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disable2fa($id)
    {
        $user = User::findOrFail($id);

        if ($user->loginSecurity()->first()->update([
            'google2fa_enable' => false
        ])) {
            return back()->with('success_short', 'Операция успешно проведена');
        }

        return back()->with('error_short', 'Операция не проведена');
    }
}
