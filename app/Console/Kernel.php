<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {

        $schedule->call(function () {

            $users = User::all();

            foreach ($users as $key => $user) {

                $month_ago = Carbon::now()->subDays(30);

                $last_loggin_time = Carbon::parse($user->last_loggedIn_time);

                if ($last_loggin_time->lessThan($month_ago)) {
                    $data = [
                        'name' => 'John Doe',
                        'email' => 'FOOL',
                        'message' => 'This is a test email'
                    ];

                    $toEmail = $user->email;
                    $subject = 'From Pharmacy With Love';

                    Mail::send('emails.MissedYouTemplate', $data, function ($message) use ($toEmail, $subject) {
                        $message->to($toEmail);
                        $message->subject($subject);
                        $message->from('Admin@Pharmacy.Co', 'Pharmacy Admin');
                    });
                }
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
