<?php
// Technical Test - Product of the Day Settings Page

// Add menu page to the WordPress admin
function potd_add_admin_page() {
    add_menu_page(
        'Product of the Day Settings',
        'POTD Settings',
        'manage_options',
        'potd_settings',
        'potd_render_settings_page',
        'dashicons-admin-generic',
        80
    );
}
add_action('admin_menu', 'potd_add_admin_page');

// Render the settings page
function potd_render_settings_page() {
    ?>
    <div class="wrap potd-settings">
        <h1>Product of the Day - Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('potd_settings_group');
            do_settings_sections('potd_settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings
function potd_register_settings() {
    register_setting('potd_settings_group', 'potd_block_title');
    register_setting('potd_settings_group', 'potd_admin_email');

    add_settings_section(
        'potd_main_settings',
        'Main Settings',
        null,
        'potd_settings'
    );

    add_settings_field(
        'potd_block_title',
        'Block Title:',
        'potd_block_title_callback',
        'potd_settings',
        'potd_main_settings'
    );

    add_settings_field(
        'potd_admin_email',
        'Admin Email for Reports:',
        'potd_admin_email_callback',
        'potd_settings',
        'potd_main_settings'
    );
}
add_action('admin_init', 'potd_register_settings');

// Callbacks for settings fields
function potd_block_title_callback() {
    $title = get_option('potd_block_title', 'Product of the Day');
    echo '<input type="text" name="potd_block_title" value="' . esc_attr($title) . '" class="regular-text">';
}

function potd_admin_email_callback() {
    $email = get_option('potd_admin_email', '');
    echo '<input type="text" name="potd_admin_email" value="' . esc_attr($email) . '" class="regular-text">';
}

// Handle AJAX request to register product clicks
function potd_register_product_click() {
    if (isset($_POST['product_id'])) {
        $product_id = intval($_POST['product_id']);
        $clicks = get_post_meta($product_id, '_potd_clicks', true);
        $clicks = ($clicks) ? $clicks + 1 : 1;
        update_post_meta($product_id, '_potd_clicks', $clicks);
    }
    wp_die();
}
add_action('wp_ajax_register_product_click', 'potd_register_product_click');
add_action('wp_ajax_nopriv_register_product_click', 'potd_register_product_click');

// Add Clicks Column to Product List in Admin Panel
function potd_add_clicks_column($columns) {
    $columns['potd_clicks'] = 'Clicks';
    return $columns;
}
add_filter('manage_product_posts_columns', 'potd_add_clicks_column');

function potd_display_clicks_column($column, $post_id) {
    if ($column === 'potd_clicks') {
        $clicks = get_post_meta($post_id, '_potd_clicks', true);
        echo ($clicks) ? $clicks : '0';
    }
}
add_action('manage_product_posts_custom_column', 'potd_display_clicks_column', 10, 2);

?>
