<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'hp',
        'email',
        'password',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['all_roles'];

    public function isHasRole($role)
    {
        foreach ($this->roles as $r) {
            if ($role == $r->name)
                return true;
        }
        return false;
    }

    public function getAllRolesAttribute()
    {
        $a = "";
        foreach ($this->roles as $role) {
            $a .= $role->name . ", ";
        }
        return ($a == "") ? "" : substr($a, 0, strlen($a) - 2);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($name)
    {
        foreach ($this->roles as $role) {
            if ($role->name == $name)
                return true;
        }
        return false;
    }

}
