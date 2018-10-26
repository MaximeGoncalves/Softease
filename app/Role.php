<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{


    public function users()
    {

        return $this->belongsToMany(User::class)->withPivot('role_id', 'user_id');
    }

    public function getAdmins()
    {
        $admin = Role::find(4);
        return $admin->users()->get();
    }
}
