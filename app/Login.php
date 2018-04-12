<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class login extends Model
{
    protected $fillable = ['name', 'url', 'username', 'password'];

    public function society(){
        return $this->belongsTo(Society::class);
    }
}
