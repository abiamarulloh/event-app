<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the roles
        $adminRole = Role::findByName('Admin');
        $eventOrganizerRole = Role::findByName('Event Organizer');
        $attenderRole = Role::findByName('Attender');

        // Create some basic users
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'jhon@mailinator.com',
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id, // Assign admin role
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@mailinator.com',
                'password' => Hash::make('password'),
                'role_id' => $eventOrganizerRole->id, // Assign moderator role
            ],
            [
                'name' => 'Michael Doe',
                'email' => 'micel@mailinator.com',
                'password' => Hash::make('password'),
                'role_id' => $attenderRole->id, // Assign attender role
            ],
        ];

        // Insert users into the database
        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
