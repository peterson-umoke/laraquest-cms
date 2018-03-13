<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * create a relationship between the role and user
     *
     * @return void
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * authorize for a role
     *
     * @param [type] $roles
     * @return void
     */
    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || abort(401, "This Action is not authorized");
        }

        return $this->hasRole($roles) || abort(401, "This Action is not authorized");
    }

    /**
     * has any roles
     *
     * @param [type] $roles
     * @return boolean
     */
    public function hasAnyRole($roles)
    {
        return null != $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasRole($role)
    {
        return null != $this->roles()->where('name', $role)->first();
    }
}
