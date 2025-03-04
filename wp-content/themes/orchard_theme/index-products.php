<?php
/* Template Name: Products Index */
get_header();
?>

<main>
    <h1>All Products</h1>
    <div class="product-list">
        <?php
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                ?>
                <div class="product-item">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    <?php endif; ?>
                    <p><?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn">View Product</a>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>No products found.</p>';
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>