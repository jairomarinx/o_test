<?php get_header(); ?>

<main>
    <?php
    // Obtener todas las categorías principales (sin padre)
    $categories = get_categories(['parent' => 0]);

    foreach ($categories as $category) {
        echo '<h2>' . esc_html($category->name) . '</h2>'; // Mostrar la categoría

        // Obtener posts dentro de la categoría
        $posts = new WP_Query([
            'category_name' => $category->slug,
            'posts_per_page' => -1, // Mostrar todos los posts
        ]);

        if ($posts->have_posts()) {
            echo '<ul>';
            while ($posts->have_posts()) {
                $posts->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
        }
        wp_reset_postdata(); // Restablecer la consulta
    }
    ?>
</main>

<?php get_footer(); ?>
