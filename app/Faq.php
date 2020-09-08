<?php


namespace App;

use Jenssegers\Mongodb\Eloquent\Model;


class Faq extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_en', 'answer_en', 'answer_de', 'question_de'
    ];
}
