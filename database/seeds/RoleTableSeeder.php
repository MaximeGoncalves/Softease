<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = new Role();
        $role_user->name = 'ROLE_USER';
        $role_user->description = 'Simple utilisateur.';
        $role_user->save();

        $role_leader = new Role();
        $role_leader->name = 'ROLE_LEADER';
        $role_leader->description = 'Utilisateur ayant accès a la partie ticket';
        $role_leader->save();

        $role_technician = new Role();
        $role_technician->name = 'ROLE_TECHNICIAN';
        $role_technician->description = 'Utilisateur ayant accès a la partie ticket';
        $role_technician->save();

        $role_admin = new Role();
        $role_admin->name = 'ROLE_ADMIN';
        $role_admin->description = 'SUPER SAYEN !';
        $role_admin->save();
    }
}
