<?php
// Technical Test

function orchard_theme_setup() {
    register_nav_menus(array(
        'MainMenu' => __('Main Menu', 'orchard_theme'),
    ));
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'orchard_theme_setup');
?>




<?php
// Technical Test

function get_root_category($post_id) {
    $categories = get_the_category($post_id);
    if ($categories) {
        foreach ($categories as $category) {
            // Buscar la categoría raíz (Root A o Root B)
            while ($category->parent != 0) {
                $category = get_category($category->parent);
            }
            return $category->slug; // Retorna 'root-a' o 'root-b'
        }
    }
    return '';
}

function get_banner_image() {
    if (is_single()) {
        $root_category = get_root_category(get_the_ID());
        if ($root_category === 'root-a') {
            return get_template_directory_uri() . '/banner-a.png';
        } elseif ($root_category === 'root-b') {
            return get_template_directory_uri() . '/banner-b.png';
        }
    }
    return get_template_directory_uri() . '/banner-default.png'; // Banner por defecto
}




function update_post_category_on_menu_change($menu_id, $menu_item_db_id, $args) {
    $menu_item = get_post($menu_item_db_id);
    
    if ($menu_item->post_type == 'nav_menu_item') {
        $menu_meta = get_post_meta($menu_item_db_id);
        
        if (isset($menu_meta['_menu_item_object_id'][0])) {
            $post_id = $menu_meta['_menu_item_object_id'][0];

            if (isset($menu_meta['_menu_item_menu_item_parent'][0])) {
                $parent_menu_id = $menu_meta['_menu_item_menu_item_parent'][0];

                if ($parent_menu_id) {
                    $parent_category = get_term($parent_menu_id, 'category');

                    if ($parent_category) {
                        wp_set_post_categories($post_id, [$parent_category->term_id]);
                    }
                }
            }
        }
    }
}
add_action('wp_update_nav_menu_item', 'update_post_category_on_menu_change', 10, 3);



