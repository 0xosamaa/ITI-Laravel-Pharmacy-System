<?php

namespace App\Jobs;

use App\Mail\WelcomeEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class WelcomeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->user->hasVerifiedEmail()) {
            // Mail::send(new WelcomeEmail($this->user));
            $data = [
                'name' => $this->user->name,
                'email' => 'FOOL',
                'message' => 'This is a test email'
            ];

            $toEmail = $this->user->email;
            $subject = 'From Pharmacy With Love';

            Mail::send('emails.welcome', $data, function ($message) use ($toEmail, $subject) {
                $message->to($toEmail);
                $message->subject($subject);
                $message->from('Admin@Pharmacy.Co', 'Pharmacy Admin');
            });
        }
        }
    }



