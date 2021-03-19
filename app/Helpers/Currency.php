<?php
namespace App\Helpers;

class Currency{
    public static function rupiah($number){
        return number_format($number, 2,',','.');
    }
}
