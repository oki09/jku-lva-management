<?php


namespace App;

use Jenssegers\Mongodb\Eloquent\Model;


class Course extends Model
{

    protected $primaryKey = 'nr';

    public function slots()
    {
        return $this->embedsMany(Slot::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nr', 'title', 'ects', 'isDisabled', 'capacity', 'color', 'type', 'teachers'
    ];
}
