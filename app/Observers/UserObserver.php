<?php
/**
 * Copyright. "NewGen" investment engine. All rights reserved.
 * Any questions? Please, visit https://newgen.company
 */

namespace App\Observers;

use App\Models\Deposit;
use App\Models\DepositQueue;
use App\Models\User;
use App\Models\Wallet;

/**
 * Class UserObserver
 * @package App\Observers
 */
class UserObserver
{
    /**
     * @param User $user
     * @throws \Exception
     */
    public function deleting(User $user) {
        foreach ($user->transactions()->get() as $transaction) {
            $transaction->delete();
        }

        foreach ($user->taskPropositions()->get() as $taskProposition) {
            $taskProposition->delete();
        }

        foreach ($user->userTaskActions()->get() as $userTaskAction) {
            $userTaskAction->delete();
        }

        foreach ($user->userTasks()->get() as $userTask) {
            $userTask->delete();
        }

        /** @var Deposit $deposit */
        foreach ($user->deposits()->get() as $deposit) {
            DepositQueue::where('deposit_id', $deposit->id)->delete();
            $deposit->delete();
        }

        foreach ($user->wallets()->get() as $wallet) {
            $wallet->delete();
        }

        foreach ($user->telegramUser()->get() as $telegramUser) {
            $telegramUser->delete();
        }

        foreach ($user->user_ips()->get() as $ip) {
            $ip->delete();
        }

        foreach ($user->socialMeta()->get() as $meta) {
            $meta->delete();
        }

        foreach ($user->youtubeVideoWatches()->get() as $watch) {
            $watch->delete();
        }

        foreach ($user->mailSents()->get() as $mail) {
            $mail->delete();
        }

        \DB::table('blockio_notifications')->where('user_id', $user->id)->delete();

        User::where('partner_id', $user->my_id)->update([
            'partner_id' => null !== $user->partner_id
                ? $user->partner_id
                : null,
        ]);
    }
    
    /**
     * Listen to the User created event.
     *
     * @param User $user
     * @return void
     * @throws
     */
    public function created(User $user)
    {
        Wallet::registerWallets($user);
        $user->sendVerificationEmail();
        
    }

    /**
     * Listen to the User creating event.
     *
     * @param User $user
     * @return void
     * @throws
     */
    public function creating(User $user)
    {
        if (empty($user->login)) {
            $user->login = $user->email;
        }

        if (null === $user->my_id || empty($user->my_id)) {
            $user->my_id = generateMyId();
        }
    }

    /**
     * @param User $user
     */
    public function saved(User $user)
    {
        if ($user->isDirty(['email'])) {
            $user->refreshEmailVerificationAndSendNew();
        }

        if ($user->isDirty(['partner_id'])) {
            if ($user->partner_id == $user->my_id) {
                $user->partner_id = null;
                $user->save();
            }
        }
    }

    /**
     * Listen to the User deleting event.
     *
     * @param User $user
     * @return void
     * @throws
     */
    public function deleted(User $user)
    {
    
    }
}