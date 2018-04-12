<?php

use App\Role;
use App\Society;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'ROLE_USER')->first();
        $role_leader = Role::where('name', 'ROLE_LEADER')->first();
        $role_technician = Role::where('name', 'ROLE_TECHNICIAN')->first();
        $role_admin = Role::where('name', 'ROLE_ADMIN')->first();

        $mus = Society::where('name', 'Jean Mus')->first();
        $softease = Society::where('name', 'Softease')->first();

        $admin = new User();
        $admin->name = 'Admin';
        $admin->fullname = 'Administrator';
        $admin->email = 'admin@softease.fr';
        $admin->password = bcrypt('admin');
        $admin->active = true;
        $admin->society()->associate($softease);
        $admin->save();
        $admin->roles()->attach($role_admin);

        $stan = new User();
        $stan->name = 'Stan';
        $stan->fullname = 'Stanislas Guillot';
        $stan->email = 'stan@softease.fr';
        $stan->password = bcrypt('admin');
        $stan->society()->associate($softease);
        $stan->save();
        $stan->roles()->attach($role_admin);

        $techician = new User();
        $techician->name = 'Technicien';
        $techician->fullname = 'Technicien Softease';
        $techician->email = 'technique@softease.fr';
        $techician->password = bcrypt('admin');
        $techician->society()->associate($softease);
        $techician->save();
        $techician->roles()->attach($role_technician);

        $florence = new User();
        $florence->name = 'Florence';
        $florence->fullname = 'Florence Mus';
        $florence->email = 'florence@mus.fr';
        $florence->active = true;
        $florence->password = bcrypt('0000');
        $florence->society()->associate($mus);
        $florence->save();
        $florence->roles()->attach($role_leader);

        $jean = new User();
        $jean->name = 'Jean-Agapit';
        $jean->fullname = 'Jean-Agapit aaaa';
        $jean->email = 'jean@mus.fr';
        $jean->password = bcrypt('0000');
        $jean->society()->associate($mus);
        $jean->save();
        $jean->roles()->attach($role_user);
    }
}
