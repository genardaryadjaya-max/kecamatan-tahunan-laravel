<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'admin:create 
                            {--email=admin@tahunan.id : Admin email address}
                            {--password=admin123 : Admin password}
                            {--name=Administrator : Admin name}';

    /**
     * The console command description.
     */
    protected $description = 'Create or reset admin user account';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->option('email');
        $password = $this->option('password');
        $name = $this->option('name');

        // Check if user exists
        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            $this->warn("User with email {$email} already exists!");

            if ($this->confirm('Do you want to reset the password?', true)) {
                $existingUser->update([
                    'password' => Hash::make($password),
                    'name' => $name,
                    'role' => 'admin',
                    'is_active' => true,
                ]);

                $this->info('✅ Admin user password reset successfully!');
                $this->newLine();
                $this->line("   Email: {$email}");
                $this->line("   Password: {$password}");
                $this->newLine();

                return 0;
            } else {
                $this->info('Operation cancelled.');
                return 1;
            }
        }

        // Create new admin user
        User::create([
            'name' => $name,
            'email' => $email,
            'role' => 'admin',
            'password' => Hash::make($password),
            'is_active' => true,
        ]);

        $this->info('✅ Admin user created successfully!');
        $this->newLine();
        $this->line("   Email: {$email}");
        $this->line("   Password: {$password}");
        $this->newLine();
        $this->comment('You can now login at: ' . url('/login'));

        return 0;
    }
}
