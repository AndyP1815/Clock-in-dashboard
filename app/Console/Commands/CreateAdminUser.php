<?php

namespace App\Console\Commands;

use App\Enums\Roles;
use App\Models\EmployeeSubscription;
use App\Models\MailSubscription;
use App\Models\Subscription;
use Illuminate\Console\Command;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $email = $this->ask('Enter admin email', 'admin@example.com');
        $password = $this->secret('Enter admin password');

        $user = \App\Models\User::create([
            'name' => 'Admin',
            'email' => $email,
            'password' => \Illuminate\Support\Facades\Hash::make($password),
        ]);



        $this->info('Admin user created successfully!');
    }
}
