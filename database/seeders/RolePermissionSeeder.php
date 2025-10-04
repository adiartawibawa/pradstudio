<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->createPermissions();
        $this->createRolesAndAssignPermissions();
    }

    private function createPermissions(): void
    {
        $permissions = [
            // Dashboard
            'view dashboard',

            // User Management
            'view users',
            'create users',
            'edit users',
            'delete users',
            'activate users',
            'deactivate users',

            // Role Management
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            'assign roles',

            // Permission Management
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',

            // Content Management
            'view posts',
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts',

            // Report
            'view reports',
            'generate reports',
            'export reports',

            // Settings
            'view settings',
            'edit settings',

            // Profile
            'view profile',
            'edit profile',
            'change password',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $this->command->info('✅ All permissions created successfully.');
    }

    private function createRolesAndAssignPermissions(): void
    {
        // Definisi role + permission mapping
        $rolesWithPermissions = [
            'Admin' => Permission::pluck('name')->toArray(),

            'Author' => [
                'view dashboard',
                'view posts',
                'create posts',
                'edit posts',
                'delete posts',
                'publish posts',
                'view reports',
                'generate reports',
                'view profile',
                'edit profile',
                'change password',
            ],

            'Contributor' => [
                'view dashboard',
                'view posts',
                'create posts',
                'edit posts',
                'view profile',
                'edit profile',
                'change password',
            ],

            'User' => [
                'view dashboard',
                'view posts',
                'view profile',
                'edit profile',
                'change password',
            ],
        ];

        foreach ($rolesWithPermissions as $roleName => $permissions) {
            $role = Role::firstOrCreate(
                ['name' => $roleName],
                [
                    'description' => Role::description($roleName), // ambil langsung dari Role::ROLES
                    'guard_name'  => 'web',
                ]
            );

            $role->syncPermissions($permissions);

            $this->command->info("✅ Role '{$roleName}' created/updated with permissions.");
        }

        $this->command->info('🎉 All roles and permissions assigned successfully.');
    }
}
