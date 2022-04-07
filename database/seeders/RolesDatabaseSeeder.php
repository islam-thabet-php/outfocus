<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CreateRoleSeederTableSeeder::class);
        $this->call(AssignRoleToUserSeederTableSeeder::class);
        $this->call(CreatePermissionsSeederTableSeeder::class);
    }
}
