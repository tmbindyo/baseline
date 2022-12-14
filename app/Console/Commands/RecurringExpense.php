<?php

namespace App\Console\Commands;

use App\Expense;
use App\User;
use App\Frequency;
use App\Income;
use App\IncomeDebit;
use App\Transaction;
use App\UserAccount;
use Illuminate\Console\Command;

class RecurringExpense extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recurring:expense';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Task to schedule coming up recurring expenses.';

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
     * @return mixed
     */
    public function handle()
    {

        // Date today
        $today = date('Y-m-d');

        // get all users
        $userAccounts = UserAccount::where('user_type_id','5f29e668-9029-4278-a5e7-9ba9f96a20df')->with('user')->get();
        // can be limited to users with user accounts
        foreach ($userAccounts as $userAccount){

            $frequencies = Frequency::where("status_id","c670f7a2-b6d1-4669-8ab5-9c764a1e403e")->where('is_user',true)->where('user_id',$userAccount->user->id)->get();

            foreach ($frequencies as $frequency){
                $datesum = date('d-m-Y', strtotime($today.' + '.$frequency->frequency.' '.$frequency->type));
                $incomes = Income::where('frequency_id',$frequency->id)->where('is_recurring',true)->whereDate('end_repeat', '<', $datesum)->get();

                foreach($incomes as $income){
                    $size = 5;
                    $reference = $this->getRandomString($size);
                    $incomeDebit = new IncomeDebit();
                    $incomeDebit->reference = $reference;
                    $incomeDebit->date = date('Y-m-d', strtotime($datesum));
                    $incomeDebit->amount = $income->amount;
                    $incomeDebit->account_id = $income->account;
                    $incomeDebit->status_id = 'a40b5983-3c6b-4563-ab7c-20deefc1992b';
                    $incomeDebit->income_id = $income->id;
                    $incomeDebit->user_id = $userAccount->user->id;
                    $incomeDebit->is_debited = true;
                    $incomeDebit->save();

                    // TODO send notification of generation

                }
            }
        }

        $this->info('Recurring expenses regenerated');

    }
}
