<?php

function get_child_pages($post_id, $direct_descendants = true) {

	global $post;

	$args = array(
    'child_of' => $post_id,
	);

	if($direct_descendants) {
		$args['parent'] = $post_id;
		$args['hierarchical'] = 0;
	}

	return get_pages( $args );
}

function hierarchical_nav_menu($post_id) {

	global $post;

	$current_post_id = 0;
	if($post) $current_post_id = $post->ID;

	$children = get_child_pages($post_id);

	$sub_menu_items = [];

	if(count($children) > 0): ?>
		<ul class="top-level-menu">
			<?php foreach($children as $childpage):

				$is_active_menu_item = (bool)(wp_get_post_parent_id($current_post_id) == $childpage->ID || $current_post_id == $childpage->ID)

				?>

				<li>
					<a href="<?php echo get_permalink($childpage->ID); ?>"
						class="menu-item <?php if($is_active_menu_item) echo 'active'; ?>"
						data-menu-id="<?php echo $childpage->ID; ?>"
						>
						<?php echo $childpage->post_title; ?>
					</a>
				</li>

				<?php

				$grandchildren = get_child_pages($childpage->ID);

				$sub_menu_items[$childpage->ID] = $grandchildren;

			endforeach; ?>
		</ul>
	<?php endif;

	$menu_ids = array_keys($sub_menu_items);

	foreach($menu_ids as $menu_id): ?>
		<ul class="child-menu <?php echo "child-menu-$menu_id"?>">

			<?php foreach($sub_menu_items[$menu_id] as $item): ?>
				<li>
					<a class="<?php if($current_post_id == $item->ID) echo 'active'; ?>" href="<?php echo get_permalink($item->ID); ?>">
						<?php echo $item->post_title; ?>
					</a>
				</li>
			<?php endforeach; ?>

		</ul>
	<?php endforeach;

}
