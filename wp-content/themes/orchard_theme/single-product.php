<?php
/* Technical Test */
get_header();
?>

<main>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="single-product">
            <h1>Product:</h1>
            <h1><?php the_title(); ?></h1>
            <?php if (has_post_thumbnail()) : ?>
                <div class="product-image">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>
            
            <div class="product-content">
                <?php the_content(); ?>
            </div>
            
            <?php
            // Check if it's marked as "Product of the Day"
            $is_potd = get_post_meta(get_the_ID(), '_potd_flag', true);
            if ($is_potd) :
            ?>
                <p class="potd-label">🔥 This is the Product of the Day! 🔥</p>
            <?php endif; ?>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>