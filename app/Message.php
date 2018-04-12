<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
    public function from(){
        return $this->belongsTo(User::class, 'from_id');
    }
}
