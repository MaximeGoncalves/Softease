<?php

use App\Society;
use Illuminate\Database\Seeder;

class SocietyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $softease = new Society();
        $softease->name = 'Softease';
        $softease->save();

        $mus = new Society();
        $mus->name = 'Jean Mus';
        $mus->address= 'Allée des mangues';
        $mus->cp= 'Allée des mangues';
        $mus->email= 'Allée des mangues';
        $mus->phone= 'Allée des mangues';
        $mus->fax= 'Allée des mangues';
        $mus->save();


    }
}
