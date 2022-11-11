<?php

function ws_prevent_future_type( $post_data ) {
    if ( $post_data['post_status'] == 'future' && $post_data['post_type'] == 'events' )
         $post_data['post_status'] = 'publish';
    return $post_data;
}
add_filter('wp_insert_post_data', 'ws_prevent_future_type');
remove_action('future_post', '_future_post_hook');
