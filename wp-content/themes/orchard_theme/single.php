<?php get_header(); ?>

<div class="banner" style="background-image: url('<?php echo get_banner_image(); ?>'); height: 400px; background-size: cover; background-position: center;"></div>

<main>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article>
            <h1><?php the_title(); ?></h1>
            <div><?php the_content(); ?></div>
        </article>
    <?php endwhile; else : ?>
        <p>No content available.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
