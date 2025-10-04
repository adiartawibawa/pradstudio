<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminUsers();
        $this->createAuthorUsers();
        $this->createContributorUsers();
        $this->createRegularUsers();
    }

    private function createAdminUsers(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();

        $admins = [
            [
                'name' => 'Super Administrator',
                'email' => 'admin@app.test',
                'password' => Hash::make('password'),
                'phone' => '081111111111',
                'address' => 'Jl. Utama No. 1, Jakarta',
                'date_of_birth' => '1980-01-01',
                'gender' => 'L',
                'is_active' => true,
            ],
            [
                'name' => 'System Manager',
                'email' => 'manager@app.test',
                'password' => Hash::make('password'),
                'phone' => '081111111112',
                'address' => 'Jl. Utama No. 2, Jakarta',
                'date_of_birth' => '1982-02-02',
                'gender' => 'P',
                'is_active' => true,
            ],
        ];

        foreach ($admins as $adminData) {
            $admin = User::create($adminData);
            $admin->assignRole($adminRole);
            $this->command->info("Admin user created: {$admin->email}");
        }
    }

    private function createAuthorUsers(): void
    {
        $authorRole = Role::where('name', 'Author')->first();

        $authors = [
            [
                'name' => 'Penulis Utama',
                'email' => 'author@app.test',
                'password' => Hash::make('password'),
                'phone' => '082222222221',
                'address' => 'Jl. Penulis No. 1, Jakarta',
                'date_of_birth' => '1990-03-10',
                'gender' => 'L',
                'is_active' => true,
            ],
            [
                'name' => 'Redaktur Konten',
                'email' => 'editor@app.test',
                'password' => Hash::make('password'),
                'phone' => '082222222222',
                'address' => 'Jl. Penulis No. 2, Jakarta',
                'date_of_birth' => '1991-04-12',
                'gender' => 'P',
                'is_active' => true,
            ],
        ];

        foreach ($authors as $authorData) {
            $author = User::create($authorData);
            $author->assignRole($authorRole);
            $this->command->info("Author user created: {$author->email}");
        }
    }

    private function createContributorUsers(): void
    {
        $contributorRole = Role::where('name', 'Contributor')->first();

        $contributors = [
            [
                'name' => 'Kontributor Satu',
                'email' => 'contributor@app.test',
                'password' => Hash::make('password'),
                'phone' => '083333333331',
                'address' => 'Jl. Kontributor No. 1, Jakarta',
                'date_of_birth' => '1995-05-20',
                'gender' => 'L',
                'is_active' => true,
            ],
            [
                'name' => 'Kontributor Dua',
                'email' => 'contributor2@app.test',
                'password' => Hash::make('password'),
                'phone' => '083333333332',
                'address' => 'Jl. Kontributor No. 2, Jakarta',
                'date_of_birth' => '1996-06-25',
                'gender' => 'P',
                'is_active' => true,
            ],
        ];

        foreach ($contributors as $contributorData) {
            $contributor = User::create($contributorData);
            $contributor->assignRole($contributorRole);
            $this->command->info("Contributor user created: {$contributor->email}");
        }
    }

    private function createRegularUsers(): void
    {
        $userRole = Role::where('name', 'User')->first();

        $users = [
            [
                'name' => 'User Biasa',
                'email' => 'user@app.test',
                'password' => Hash::make('password'),
                'phone' => '084444444441',
                'address' => 'Jl. User No. 1, Jakarta',
                'date_of_birth' => '2000-07-15',
                'gender' => 'L',
                'is_active' => true,
            ],
            [
                'name' => 'User Kedua',
                'email' => 'user2@app.test',
                'password' => Hash::make('password'),
                'phone' => '084444444442',
                'address' => 'Jl. User No. 2, Jakarta',
                'date_of_birth' => '2001-08-18',
                'gender' => 'P',
                'is_active' => true,
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create($userData);
            $user->assignRole($userRole);
            $this->command->info("Regular user created: {$user->email}");
        }
    }
}
