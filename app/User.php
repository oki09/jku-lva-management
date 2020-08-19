<?php

namespace App;

use Jenssegers\Mongodb\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $primaryKey = 'studentId';

    public function courses()
    {
        return $this->embedsMany(Course::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'studentId', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
