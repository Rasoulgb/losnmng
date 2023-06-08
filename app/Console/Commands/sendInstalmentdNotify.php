<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Loan;
use App\Jobs\SendEmailJob;
use App\Models\Instalment;
use Illuminate\Console\Command;
use Psy\VersionUpdater\Installer;
use Illuminate\Support\Facades\Log;

class sendInstalmentdNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'InstalmentdNotify:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now('Asia/Tehran');
        $hour = now('Asia/Tehran')->format('H');


        $loans = Loan::where('reminder', 'on')->where('what_time', $hour)->get();

        foreach ($loans as $key => $loan) {

            $how_many_days_earlier = $loan->how_many_days_earlier;
            $instalments =   $loan->instalments()->Postponed()->get();
            foreach ($instalments as $row => $instalment) {
                if ($now->diffInDays($instalment->date) == $how_many_days_earlier) {
                    $user = $loan->user()->get();
                    echo "$user[0]->name loan->id $loan->id  -- instalment->id $instalment->id Must Bee Alarmed ";
                    Log::debug(["loan->id $loan->id  -- instalment->id $instalment->id must be announced ", $instalment->date, $hour]);


                    $validated['user_id'] = $user[0]->id;
                    $validated['username'] = $user[0]->name;
                    $validated['to'] = $user[0]->email;
                    $validated['subject'] = 'Postponed Instalment';
                    $validated['body'] = "loan->id $loan->id  -- instalment->id $instalment->id must be announced ";
                    $validated['title'] = 'Postponed Instalment';
                    $validated['view'] = 'recapemail';
                    $validated['recivername'] = $user[0]->surename;

                    dispatch(new SendEmailJob($validated));


                }
            }
        }
        return Command::SUCCESS;
    }
}
