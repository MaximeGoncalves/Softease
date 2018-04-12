<?php

use App\Source;
use Illuminate\Database\Seeder;

class SourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sfticket= new App\Source();
        $sfticket->name = 'SFticket';
        $sfticket->save();

        $mail = new App\Source();
        $mail->name = 'Email';
        $mail->save();

        $tel= new App\Source();
        $tel->name = 'Téléphone';
        $tel->save();

        $tel= new App\Source();
        $tel->name = 'Rendez-vous';
        $tel->save();
    }
}
