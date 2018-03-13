<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * relate the user table with the role
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
