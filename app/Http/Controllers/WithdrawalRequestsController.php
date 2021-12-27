<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Notification;
use App\Models\PaymentSystem;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\UserSidebarProperties;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

/**
 * Class WithdrawalRequestsController
 *
 * @package App\Http\Controllers
 */
class WithdrawalRequestsController extends Controller
{

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request) {
        if (request()->ajax()) {
            $transactionWithdrawType = TransactionType::getByName('withdraw');

            $transactions = Transaction::select('transactions.*')->with([
                'user',
            ])->where('type_id', $transactionWithdrawType->id)
                ->orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);

            /*
             * Фильтрация, если выбрано
             */
            if (!is_null($request->field) && !is_null($request->sort)) {
                $transactions = $transactions->with('paymentSystem')->orderBy($request->field, $request->sort);
            }

            /*
             * Получаем всех рефералов и их транзакции
             */
            if (!is_null($request->user)) {
                /** @var User $user */
                $user = User::where('id', $request->user)->first();

                $referrals = cache()->remember('user.referrals_1' . $user->id, 180, function () use ($user) {
                    return $user->getAllReferralsInArray(1, 1);
                });

                $ids = [];

                foreach ($referrals as $referral) {
                    $ids[] = $referral->id;
                }

                $transactions->whereIn('user_id', $ids);
            }

            if (!is_null($request->fake)) {
                $transactions->where('is_real', 0);
            } elseif (!is_null($request->real)) {
                $transactions->where('is_real', 1);
            } else {
                $transactions->where('approved', $request->only('type') ?? 0);
            }

            if (($request->has('fake') || $request->has('real')) && $request->has('type')) {
                $transactions->where('approved', $request->only('type') ?? 0);
            }

            if (isset($request->search['value']) && !is_null($request->search['value'])) {
                $transactions->where(function ($query) use ($request) {
                    $query->where('id', $request->search['value'])
                        ->orWhereHas('user', function($q) use($request) {
                            $q->where('login', 'like', '%'.$request->search['value'].'%')
                                ->orWhere('email', 'like', '%'.$request->search['value'].'%');
                        });
                });
            }

            $recordsFiltered = $transactions->count();
            $transactions->limit($request->length)->offset($request->start);
            $data = [];

            foreach ($transactions->get() as $transaction) {
                $data[] = [
                    'empty' => '',
                    'empty2' => '',
                    'id' => $transaction->id,
                    'email' => view('pages.withdrawals.partials.user-item', compact('transaction'))->render(),
//                    'login' => view('pages.withdrawals.partials.login', compact('transaction'))->render(),
                    'teamlead' => view('pages.withdrawals.partials.teamlead', compact('transaction'))->render(),
                    'partner' => view('pages.withdrawals.partials.upliner', compact('transaction'))->render(),
                    'amount' => view('pages.withdrawals.partials.amount', compact('transaction'))->render(),
                    'created_at' => $transaction->created_at->format('d-m-Y H:i'),
                    'approved' => view('pages.withdrawals.partials.external', compact('transaction'))->render(),
                    'actions' => view('pages.withdrawals.partials.actions', compact('transaction'))->render(),
                    'empty3' => '',
                    'color' => $transaction->user->getRoleColor() ?? '',
                ];
            }

            return response()->json([
                'draw' => $request->draw,
                'recordsTotal' => Transaction::select('transactions.*')->where('type_id', $transactionWithdrawType->id)->where('approved', $request->only('type') ?? 0)->count(),
                'recordsFiltered' => $recordsFiltered,
                'data' => $data,
            ]);
        } else {
            $filter_users = User::whereHas("roles", function ($q) {
                $q->where("name", "root")->orWhere("name", "teamlead");
            })->orderBy('int_id', 'asc')->get();
            UserSidebarProperties::where('user_id', auth()->user()->id)->where('sb_prop','withdrawals_amount')->update(['sb_val' => 0]);
            return view('pages.withdrawals.index', compact('filter_users'));
        }
    }

    /**
     * @param $transaction
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($transaction) {
        $transaction = Transaction::find($transaction);

        return view('pages.withdrawals.show', compact('transaction'));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function approveMany(Request $request) {
        $messages = [];

        if ($request->type == 'approve') {
            foreach ($request->list as $item) {
                /** @var Transaction $item */
                $transaction = Transaction::find($item);

                $messages[] = number_format($transaction->amount, $transaction->currency->precision, '.', '').' '.$transaction->currency->code.' -> '.$transaction->user->email.' : '.$this->approve($item, true);
            }
        } else if ($request->type == 'approveManually') {
            foreach ($request->list as $item) {
                /** @var Transaction $item */
                $transaction = Transaction::find($item);

                $messages[] = number_format($transaction->amount, $transaction->currency->precision, '.', '').' '.$transaction->currency->code.' -> '.$transaction->user->email.' : '.$this->approveManually($item, true);
            }
        } else if ($request->type == 'approveFake') {
            foreach ($request->list as $item) {
                /** @var Transaction $item */
                $transaction = Transaction::find($item);

                $messages[] = number_format($transaction->amount, $transaction->currency->precision, '.', '').' '.$transaction->currency->code.' -> '.$transaction->user->email.' : '.$this->approveFake($item, true);
            }
        } else if ($request->type == 'reject') {
            foreach ($request->list as $item) {
                /** @var Transaction $item */
                $transaction = Transaction::find($item);

                $messages[] = number_format($transaction->amount, $transaction->currency->precision, '.', '').' '.$transaction->currency->code.' -> '.$transaction->user->email.' : '.$this->reject($item, true);
            }
        } else if ($request->type == 'destroy') {
            foreach ($request->list as $item) {
                /** @var Transaction $item */
                $transaction = Transaction::find($item);

                $messages[] = number_format($transaction->amount, $transaction->currency->precision, '.', '').' '.$transaction->currency->code.' -> '.$transaction->user->email.' : '.$this->remove($item, true);
            }
        }

        return back()->with('info', __('List of withdrawal requests processed.') .'<hr>'. implode('<hr>', $messages))->withInput(\request()->all());
    }

    /**
     * @param      $transaction
     * @param bool $massMode
     *
     * @return array|\Illuminate\Http\RedirectResponse|null|string
     * @throws \Exception
     */
    public function reject($transaction, $massMode = false) {
        if (cache()->has('reject'.$transaction)) {
            if (true === $massMode) {
                return __('This transaction locked for 1 minutes.');
            }
            return back()->with('error', __('This transaction locked for 10 minutes.'))->withInput(\request()->all());
        }

        cache()->put('reject'.$transaction, true, now()->addMinutes(1));

        /** @var Transaction $transaction */
        $transaction = Transaction::find($transaction);

        if ($transaction->isApproved()) {
            if (true === $massMode) {
                return __('This request already processed.');
            }
            return back()->with('error', __('This request already processed.'))->withInput(\request()->all());
        }

        /** @var Wallet $wallet */
        $wallet = $transaction->wallet()->first();
        /** @var User $user */
        $user = $wallet->user()->first();
        /** @var Currency $currency */
        $currency = $wallet->currency()->first();
        $amount = $transaction->amount;

        if (null === $wallet || null === $user || null === $currency) {
            throw new \Exception('Wallet, user, payment system or currency is not found for withdrawal reject.');
        }

        $wallet->returnFromRejectedWithdrawal($transaction);
        $transaction->update(['approved' => Transaction::TRANSACTION_REJECTED]);
//        $notification_data = [
//            'notification_name' => 'Вывод средств',
//            'user' => $user,
//            'amount' => $transaction->amount . $currency->symbol,
//            'status' => 'отклонён',
//        ];
//        Notification::sendNotification($notification_data, 'new_withdrawal');
//        $data = [
//            'withdraw_amount' => $amount,
//            'currency' => $currency,
//            'payment_system' => $paymentSystem,
//        ];
        //        $user->sendNotification('rejected_withdrawal', $data);

        if (true === $massMode) {
            return __('Request rejected');
        }
        return back()->with('success', __('Request rejected'))->withInput(\request()->all());
    }

    /**
     * @param       $transaction
     * @param false $massMode
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|\Illuminate\Http\RedirectResponse|string|null
     */
    public function remove($transaction, $massMode = false) {
        if (cache()->has('remove'.$transaction)) {
            if (true === $massMode) {
                return __('This transaction locked for 1 minutes.');
            }
            return back()->with('error', __('This transaction locked for 1 minutes.'))->withInput(\request()->all());
        }

        cache()->put('remove'.$transaction, true, now()->addMinutes(1));

        /** @var Transaction $transaction */
        $transaction = Transaction::find($transaction);

        $transaction->delete();

        if (true === $massMode) {
            return __('Вывод удален');
        }
        return back()->with('success', __('Вывод удален'))->withInput(\request()->all());
    }

    /**
     * @param      $transaction
     * @param bool $massMode
     *
     * @return \Illuminate\Http\RedirectResponse|string
     * @throws \Exception
     */
    public static function approve($transaction, $massMode = false) {
        if (cache()->has('approve'.$transaction)) {
            if (true === $massMode) {
                return __('This transaction locked for 1 minutes.');
            }
            return back()->with('error', __('This transaction locked for 1 minutes.'))->withInput(\request()->all());
        }

        cache()->put('approve'.$transaction, true, now()->addMinutes(1));

        /** @var Transaction $transaction */
        $transaction = Transaction::find($transaction);

        if ($transaction->isApproved()) {
            if (true === $massMode) {
                return __('This request already processed.');
            }
            return back()->with('error', __('This request already processed.'))->withInput(\request()->all());
        }

        /** @var Wallet $wallet */
        $wallet = $transaction->wallet()->first();

        /** @var User $user */
        $user = $wallet->user()->first();

        /** @var Currency $currency */
        $currency = $wallet->currency;

        /** @var PaymentSystem $paymentSystem */
        $paymentSystem = $transaction->paymentSystem;

        if (null === $wallet || null === $user || null === $paymentSystem || null === $currency) {
            throw new \Exception('Wallet, user, payment system or currency is not found for withdrawal approve.');
        }

        $ps = $paymentSystem->getClassName();

        if (empty($ps)) {
            if (true === $massMode) {
                return 'Платежная система не поддерживает автоплатежи';
            }
            return back()->with('error_short', 'Платежная система не поддерживает автоплатежи')->withInput(\request()->all());
        }

        if (empty($wallet->external)) {
            if (true === $massMode) {
                return __('ERROR:') . ' wallet is empty';
            }
            return back()->with('error', __('ERROR:') . ' wallet is empty')->withInput(\request()->all());
        }

        try {
            $batchId = $ps::transfer($transaction);
        } catch (\Exception $e) {
            if (true === $massMode) {
                return __('ERROR:').' ' . $e->getMessage();
            }
            return back()->with('error_short', __('ERROR:').' ' . $e->getMessage())->withInput(\request()->all());
        }

        if (empty($batchId)) {
            $batchErr = __('Unable to approve request, payment system transfer is failed ..');

            if (true === $massMode) {
                return __($batchErr);
            }
            return back()->with('error_short', __($batchErr))->withInput(\request()->all());
        }


        $transaction->update([
            //            'batch_id' => $batchId,
            'approved' => true,
        ]);
//        $notification_data = [
//            'notification_name' => 'Вывод средств',
//            'user' => $user,
//            'amount' => $transaction->amount . $currency->symbol,
//            'status' => 'одобрен',
//        ];
//        Notification::sendNotification($notification_data, 'new_withdrawal');

//        $data = [
//            'withdraw_amount' => $transaction->amount,
//            'currency' => $currency,
//            'payment_system' => $paymentSystem,
//        ];
        //        $user->sendNotification('approved_withdrawal', $data);

        try {
            $ps::getBalances();
        } catch (\Exception $e) {
            if (true === $massMode) {
                return __('ERROR:') . ' ' . $e->getMessage();
            }
            return back()->with('error', __('ERROR:') . ' ' . $e->getMessage());
        }

        if (true === $massMode) {
            return $transaction->amount . $currency->symbol . ' - ' . __('Request approved, money transferred to user wallet');
        }
        return back()->with('success', $transaction->amount . $currency->symbol . ' - ' . __('Request approved, money transferred to user wallet'))->withInput(\request()->all());
    }

    /**
     * @param      $transaction
     * @param bool $massMode
     *
     * @return \Illuminate\Http\RedirectResponse|string
     * @throws \Exception
     */
    public function approveManually($transaction, $massMode = false) {
        if (cache()->has('approveManually'.$transaction)) {
            if (true === $massMode) {
                return __('This transaction locked for 1 minutes.');
            }
            return back()->with('error', __('This transaction locked for 1 minutes.'))->withInput(\request()->all());
        }

        cache()->put('approveManually'.$transaction, true, now()->addMinutes(1));

        /** @var Transaction $transaction */
        $transaction = Transaction::find($transaction);

        if ($transaction->isApproved()) {
            if (true === $massMode) {
                return __('This request already processed.');
            }
            return back()->with('error', __('This request already processed.'))->withInput(\request()->all());
        }

        /** @var Wallet $wallet */
        $wallet = $transaction->wallet()->first();
        /** @var User $user */
        $user = $wallet->user()->first();
        /** @var Currency $currency */
        $currency = $wallet->currency()->first();

        if (null === $wallet || null === $user || null === $currency) {
            throw new \Exception('Wallet, user, payment system or currency is not found for withdrawal approve.');
        }

//        if (empty($wallet->external)) {
//            if (true === $massMode) {
//                return __('ERROR:') . ' wallet is empty';
//            }
//            return back()->with('error', __('ERROR:') . ' wallet is empty');
//        }

        $transaction->update([
            'approved' => true,
        ]);
//        $notification_data = [
//            'notification_name' => 'Вывод средств',
//            'user' => $user,
//            'amount' => $transaction->amount . $currency->symbol,
//            'status' => 'одобрен',
//        ];
//        Notification::sendNotification($notification_data, 'new_withdrawal');
//        $data = [
//            'withdraw_amount' => $transaction->amount,
//            'currency' => $currency,
//            'payment_system' => $paymentSystem,
//        ];
        //        $user->sendNotification('approved_withdrawal', $data);

//        $ps = $paymentSystem->getClassName();
//
//        try {
//            $ps::getBalances();
//        } catch (\Exception $e) {
//            if (true === $massMode) {
//                return __('ERROR:') . ' ' . $e->getMessage();
//            }
//            return back()->with('error', __('ERROR:') . ' ' . $e->getMessage());
//        }

        if (true === $massMode) {
            return $transaction->amount . $currency->symbol . ' - ' . __('Request approved.');
        }
        return back()->with('success', $transaction->amount . $currency->symbol . ' - ' . __('Request approved.'))->withInput(\request()->all());
    }

    /**
     * @param      $transaction
     * @param bool $massMode
     *
     * @return \Illuminate\Http\RedirectResponse|string
     * @throws \Exception
     */
    public function approveFake($transaction, $massMode = false) {
        if (cache()->has('approveFake'.$transaction)) {
            if (true === $massMode) {
                return __('This transaction locked for 1 minutes.');
            }
            return back()->with('error', __('This transaction locked for 1 minutes.'))->withInput(\request()->all());
        }

        cache()->put('approveFake'.$transaction, true, now()->addMinutes(1));

        /** @var Transaction $transaction */
        $transaction = Transaction::find($transaction);

        if ($transaction->isApproved()) {
            if (true === $massMode) {
                return __('This request already processed.');
            }
            return back()->with('error', __('This request already processed.'))->withInput(\request()->all());
        }

        /** @var Wallet $wallet */
        $wallet = $transaction->wallet()->first();
        /** @var User $user */
        $user = $wallet->user()->first();
        /** @var Currency $currency */
        $currency = $wallet->currency()->first();

        if (null === $wallet || null === $user || null === $currency) {
            throw new \Exception('Wallet, user, payment system or currency is not found for withdrawal approve.');
        }

//        if (empty($wallet->external)) {
//            if (true === $massMode) {
//                return __('ERROR:') . ' wallet is empty';
//            }
//            return back()->with('error', __('ERROR:') . ' wallet is empty');
//        }

        $transaction->update([
            'approved' => true,
            'is_real' => false,
        ]);
//        $notification_data = [
//            'notification_name' => 'Вывод средств',
//            'user' => $user,
//            'amount' => $transaction->amount . $currency->symbol,
//            'status' => 'одобрен',
//        ];
//        Notification::sendNotification($notification_data, 'new_withdrawal');
//        $data = [
//            'withdraw_amount' => $transaction->amount,
//            'currency' => $currency,
//            'payment_system' => $paymentSystem,
//        ];
        //        $user->sendNotification('approved_withdrawal', $data);

//        $ps = $paymentSystem->getClassName();
//
//        try {
//            $ps::getBalances();
//        } catch (\Exception $e) {
//            if (true === $massMode) {
//                return __('ERROR:') . ' ' . $e->getMessage();
//            }
//            return back()->with('error', __('ERROR:') . ' ' . $e->getMessage());
//        }

        if (true === $massMode) {
            return $transaction->amount . $currency->symbol . ' - ' . __('Fake request approved.');
        }
        return back()->with('success', $transaction->amount . $currency->symbol . ' - ' . __('Fake request approved.'))->withInput(\request()->all());
    }

    /**
     * @param $transaction
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($transaction) {
        $transaction = Transaction::findOrFail($transaction);
        if ($transaction->delete()) {
            return redirect()->to(route('withdrawals.index'));
        }
        return back()->with('error', __('ERROR:') . ' Вывод не был удален')->withInput(\request()->all());
    }
}
