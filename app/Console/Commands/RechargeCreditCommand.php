<?php

namespace App\Console\Commands;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RechargeCreditCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recharge:credit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recharge user credit';

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
        $users = User::get();
        DB::beginTransaction();
        try {
            foreach ($users as $user) {
                if ($user->type == UserTypeEnum::premium()) {
                    $newCredit = $user->credit + 40;
                    $user->credit = $newCredit;
                } elseif ($user->type == UserTypeEnum::regular()) {
                    $newCredit = $user->credit + 20;
                    $user->credit = $newCredit;
                }
                $user->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
