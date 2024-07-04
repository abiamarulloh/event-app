<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::findByName('Admin');
        $eventOrganizerRole = Role::findByName('Event Organizer');

        // Buat permissions
        $createPostPermission = Permission::create(['name' => 'create post']);
        $editPostPermission = Permission::create(['name' => 'edit post']);
        $deletePostPermission = Permission::create(['name' => 'delete post']);

        // Assign permissions ke roles
        $adminRole->syncPermissions([$createPostPermission, $editPostPermission, $deletePostPermission]);
        $eventOrganizerRole->syncPermissions([$createPostPermission, $editPostPermission]);

        // Assign roles ke user
        $admin = User::find(1); // Ganti dengan ID user admin
        $admin->assignRole($adminRole);

        $eventOrganizerRole = User::find(2); // Ganti dengan ID user Event Organizer
        $eventOrganizerRole->assignRole($eventOrganizerRole);
    }
}
