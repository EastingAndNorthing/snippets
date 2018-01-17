<?php

$today = date('Y-m-d');
$args = [
    'post_type' => 'events',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'meta_query' => [
        'relation' => 'AND',
        'date_clause' => [
            'key' => 'date',
            'compare' => '>',
            'value' => $today,
            'type'    => 'DATE',
        ],
        'confirmed_clause' => [
            'key' => 'confirmed',
            'compare' => '=',
            'value' => '1',
            'type' => 'NUMERIC',
        ],
    ],
    'orderby' => [
        'date' => 'ASC',
    ],
];