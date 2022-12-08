<?php
use Carbon\Carbon;

if(!function_exists('carbonParseDate')){
    function carbonParseDate($date){
        return Carbon::parse($date);
    }
}
