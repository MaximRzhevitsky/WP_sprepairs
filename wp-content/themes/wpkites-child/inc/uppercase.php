<?php
function uppercase($str){
    $first = mb_substr($str,0,1, 'UTF-8');//первая буква
    $last = mb_substr($str,1);//все кроме первой буквы
    $first = mb_strtoupper($first, 'UTF-8');
    $last = mb_strtolower($last, 'UTF-8');
    $str_out = $first.$last;
    return $str_out;
}