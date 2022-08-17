<?php

namespace App\Helpers;

class ValidateHelper{

    public function validateString($string){
        if(!is_string($string)){ return ""; }

        $string = filter_var($string, FILTER_SANITIZE_STRING);
        return trim(html_entity_decode($string));
    }

    public function validateArrayNumber($array){
        if(!is_array($array)){ return []; }

        array_filter($array, static function($value){
            return is_int($value);
        });

        array_map(function($value){
            return $this->validateNumber($value);
        }, $array);

        return $array;
    }

    public function validateNumber($number){
        if(!is_int($number)){ return 0; }

        return round($number);
    }
}
