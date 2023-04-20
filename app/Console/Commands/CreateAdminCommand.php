<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CreateAdminCommand extends Command
{
    protected $signature = 'create:admin {--email= : The email address of the new admin} {--password= : The password for the new admin} {--name= : The name for the new admin}';
    protected $description = 'Create a new admin user';

    public function handle()
    {
        $email = $this->option('email');
        $password = $this->option('password');
        $name = $this->option('name');

        // Validate the email address
        if (empty($email)) {
            $this->error('Please provide an email address for the new admin.');
            return;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Please provide a valid email address for the new admin.');
            return;
        }

        // Validate the password
        if (empty($password)) {
            $this->error('Please provide a password for the new admin.');
            return;
        }
        if (strlen($password) < 6) {
            $this->error('The password must be at least 6 characters.');
            return;
        }

        $user = new User;
        $user->name = $name ?? 'Admin';
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->save();

        $this->info('Admin user created successfully!');
    }
}


//create admin using the following command
//php artisan create:admin --email=mostafa@admin.com --password=123456 --name="mostafa"

