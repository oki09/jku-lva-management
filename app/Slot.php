<?php


namespace App;


use Jenssegers\Mongodb\Eloquent\Model;

class Slot extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start', 'end'
    ];
}
