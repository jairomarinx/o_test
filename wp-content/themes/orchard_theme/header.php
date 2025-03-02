<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">

</head>
<body <?php body_class(); ?>>
    <header>
        <h1><?php bloginfo('name'); ?></h1>
        <nav>
    <?php
    wp_nav_menu(array(
        'theme_location' => 'MainMenu', // Exactamente como lo registraste
        'container'      => 'ul',
        'menu_class'     => 'nav-menu',
        'fallback_cb'    => false
    ));
    ?>
</nav>
    </header>
    <div class="banner" style="background-image: url('<?php echo get_banner_image(); ?>'); height: auto; background-size: cover; background-position: center;"></div>

