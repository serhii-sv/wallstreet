<?php

namespace App\Console\Commands;

use App\Models\ReferralRole;
use Illuminate\Console\Command;

class SetReferralsRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'referrals-role:set';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set referrals role';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (ReferralRole::where('processed', false)->get() as $item) {

            $roles = [
                $item->role->name
            ];

            $this->info('Set role "' . $item->role->name . '" for ' . $item->user->login . ' referrals');

            foreach ($item->user->getAllReferralsInArray() as $referral) {
                $referral->syncRoles($roles);
                $referral->permissions()->detach();
                $referral->givePermissionsFromRole($roles);

                $this->info('Set role "' . $item->role->name . '" for ' . $referral->login);
            }

            $item->update([
                'processed' => true
            ]);
        }
        return Command::SUCCESS;
    }
}
