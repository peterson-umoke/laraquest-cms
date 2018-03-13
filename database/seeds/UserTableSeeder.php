<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where("name", 'admin')->first();
        
        $admin = new User();
        $admin->first_name = 'PBoss';
        $admin->last_name = 'Umoke';
        $admin->username = 'umoke10';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('password');
        $admin->save();

        $admin->roles()->attach($role);
    }
}
