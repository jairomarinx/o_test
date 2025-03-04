<?php
/*
Plugin Name: Product of the Day
Plugin URI: http://jairomarin.com
Description: Allows admins to manage and display a random "Product of the Day".
Version: 1.0
Author: Jairo Marin
License: GPL2
*/

// Technical Test

// Register Custom Post Type for Products

require_once plugin_dir_path(__FILE__) . 'potd-settings.php';
function potd_register_product_post_type() {
    $args = array(
        'label' => 'Products',
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-cart',
    );
    register_post_type('product', $args);
}
add_action('init', 'potd_register_product_post_type');

// Add Meta Box for "Product of the Day"
function potd_add_meta_box() {
    add_meta_box('potd_meta', 'Product of the Day', 'potd_meta_box_callback', 'product', 'side', 'high');
}
add_action('add_meta_boxes', 'potd_add_meta_box');

function potd_meta_box_callback($post) {
    $value = get_post_meta($post->ID, '_potd_flag', true);
    ?>
    <label>
        <input type="checkbox" name="potd_flag" value="1" <?php checked($value, '1'); ?>> Set as Product of the Day
    </label>
    <?php
}

// Save Meta Box Data
function potd_save_meta_box($post_id) {
    if (isset($_POST['potd_flag'])) {
        update_post_meta($post_id, '_potd_flag', '1');
    } else {
        delete_post_meta($post_id, '_potd_flag');
    }
}
add_action('save_post', 'potd_save_meta_box');

// Display Random Product of the Day
function potd_display_random_product() {
    $args = array(
        'post_type'      => 'product',
        'meta_key'       => '_potd_flag',
        'meta_value'     => '1',
        'posts_per_page' => 1,
        'orderby'        => 'rand',
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            echo '<div class="potd-box">';
            echo '<h3>' . get_the_title() . '</h3>';
            echo get_the_post_thumbnail(get_the_ID(), 'medium');
            echo '<p>' . get_the_excerpt() . '</p>';
            echo '<a href="' . get_permalink() . '" class="btn">View Product</a>';
            echo '</div>';
        }
        wp_reset_postdata();
    } else {
        echo '<p>No product available.</p>';
    }
}
add_shortcode('product_of_the_day', 'potd_display_random_product');
