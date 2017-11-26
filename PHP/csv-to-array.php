<?php

function commaSeperatedToArray($str) {
  if(!empty($str)) {
    if(strpos($str, ',')) {
      $arr = explode(',', $str);
    } else {
      $arr = [ $str ];
    }
    return $arr;
  }
}