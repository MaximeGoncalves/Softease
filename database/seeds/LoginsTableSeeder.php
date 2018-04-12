<?php

use App\Society;
use Illuminate\Database\Seeder;

class LoginsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $softease = Society::where('name', 'Softease')->first();
        $mus = Society::where('name', 'Jean Mus')->first();

        $loginS = new App\Login();
        $loginS->name = 'Softease';
        $loginS->url = 'http://softease.fr';
        $loginS->username = 'admin';
        $loginS->password = encrypt('admin');
        $loginS->society()->associate($softease);
        $loginS->save();

        $loginSo = new App\Login();
        $loginSo->name = 'Wordpress';
        $loginSo->url = 'http://Wordpress.fr';
        $loginSo->username = 'Wordpress';
        $loginSo->password = encrypt('wordpress');
        $loginSo->society()->associate($softease);
        $loginSo->save();

        $mus1 = new App\Login();
        $mus1->name = 'Wordpress';
        $mus1->url = 'http://Wordpress.fr';
        $mus1->username = 'admin';
        $mus1->password = encrypt('1234567');
        $mus1->society()->associate($mus);
        $mus1->save();

    }
}
