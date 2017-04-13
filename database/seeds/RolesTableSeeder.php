<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'description' => 'An admin user. All privileges.',
        ]);

        Role::create([
            'name' => 'Moderator',
            'description' => 'A moderator user. Some privileges.',
        ]);

        Role::create([
            'name' => 'Normal',
            'description' => 'A normal user. Basic privileges.',
        ]);
    }
}
