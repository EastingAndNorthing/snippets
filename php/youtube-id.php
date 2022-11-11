<?php

function extract_yt_id($url) {

    $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
    
    $result = preg_match($pattern, $url, $matches);
    
    if ($result) return $matches[1];
    
    return false;
}
