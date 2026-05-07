<?php
/**
 * Fallback template
 *
 * @package Blueacademy
 */

get_header();
?>

<main class="site-main">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h1><?php the_title(); ?></h1>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <p>コンテンツが見つかりませんでした。</p>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
