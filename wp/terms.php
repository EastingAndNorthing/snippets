<?php

$terms = get_terms(array(
    'taxonomy' => 'taxonomy_slug',
    'hide_empty' => true
));

$terms = get_the_terms(get_the_id(), 'slug');
