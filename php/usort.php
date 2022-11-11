<?php

usort($array, function($a, $b) {
  return $a['order'] - $b['order'];
});