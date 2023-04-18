<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new  Admin();
        $super_admin = $admin->create([
            'name' => 'super_admin',
            'email' => 'super_admin@admin.com',
            'password' => bcrypt('admin'),
            'is_super_admin' => true,
        ]);

        $admin = $admin->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'is_super_admin' => false,
        ]);
        $super_admin->addRole('super_admin');
        $admin->addRole('admin');
        Admin::factory(10)->create();
    }
}
