<?php


namespace App;

use Jenssegers\Mongodb\Eloquent\Model;


class News extends Model
{
    protected $collection = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'de', 'en'
    ];
}
