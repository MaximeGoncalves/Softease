<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Society extends Model
{
    public function logins(){
        return $this->hasMany(Login::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }

}
