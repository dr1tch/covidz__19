<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Http\Controllers\Auth;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'fname','lname', 'email', 'avatar', 'password','gender', 'birth_date'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }

    // public function hasAnyRoles($roles)
    // {
    //     if($this->roles()->whereIn('name', $roles)->first()) {
    //         return true;
    //     }
    //     return false;
    // }

    public function hasRole($role)
    {
        if($this->role()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}
