<?php


namespace App\Helpers;


use App\User;

class Util
{
    static function getTotalEcts($studentId) {
        $lvas = User::find($studentId)->courses;
        $sum = 0.0;
        foreach ($lvas as $lva) {
            $ects = str_replace(',', '.', $lva->ects);
            $sum += $ects;
        }
        return $sum;
    }
}
