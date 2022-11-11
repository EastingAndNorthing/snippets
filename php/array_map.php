<?php

$ids = array_map(function ($item){ 
	return $item->ID; 
}, $array);

$ids = array_map(fn($item) => $item->ID, $array);
