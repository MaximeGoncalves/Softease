<?php

use App\Ticket;
use Illuminate\Database\Seeder;

class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = \App\User::find(1);
        $user2 = \App\User::find(4);

        for($i=0; $i<10; $i++){
            DB::table('tickets')->insert([
                'topic' => "J'adore créer des tickets $i!",
                'description' => 'alekfmlef'.$i,
                'close_at' => \Date('Y-m-d H:i'),
                'state' => 0,
                'importance' => 0,
                'user_id' => $user1->id,
                'society_id' => $user1->society->id,
                'created_at' => \Date('Y-m-d H:i'),
            ]);
        }

        $ticket = new Ticket();
        $ticket->topic = "Ca marche pas !";
        $ticket->description = 'alekfmlef';
        $ticket->close_at = \Date('Y-m-d H:i');
        $ticket->user()->associate($user2);
        $ticket->society()->associate($user2->society->id);
        $ticket->save();


        $ticket2 = new Ticket();
        $ticket2->topic = "Toujours pas!";
        $ticket2->description = 'alekfmlef';
        $ticket2->close_at = \Date('Y-m-d H:i');
        $ticket2->user()->associate($user2);
        $ticket2->society()->associate($user2->society->id);
        $ticket2->save();

    }
}
