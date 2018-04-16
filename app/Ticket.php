<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function society(){
        return $this->belongsTo(Society::class);
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }
    public function attachments(){
        return $this->hasMany(Attachment::class);
    }
    public function source(){
        return $this->belongsTo(Source::class);
    }
}
