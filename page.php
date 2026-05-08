<?php
/**
 * The template for displaying all single pages
 *
 * @package Blueacademy
 */

get_header();

while ( have_posts() ) : the_post();

    $post_id   = get_the_ID();
    $hero_meta  = blueacademy_get_meta( 'hero_meta' );
    $hero_title = blueacademy_get_meta( 'hero_title_html' );
    $hero_sub   = blueacademy_get_meta( 'hero_sub' );
    $hero_text  = blueacademy_get_meta( 'hero_text' );
    $hero_image = blueacademy_get_image_url( 'hero_visual', 'large' );

    // パンくず
    blueacademy_breadcrumb( array(
        array( 'label' => get_the_title(), 'url' => null ),
    ) );
?>

<!-- ============ HERO ============ -->
<section class="page-hero">
    <div class="container">
        <div class="page-hero-inner<?php echo empty( $hero_image ) ? ' is-no-visual' : ''; ?>">
            <div class="page-hero-text-wrap">
                <?php if ( $hero_meta ) : ?>
                    <div class="page-hero-meta"><?php echo esc_html( $hero_meta ); ?></div>
                <?php endif; ?>

                <h1 class="page-hero-title">
                    <?php
                    if ( $hero_title ) {
                        echo wp_kses_post( html_entity_decode( $hero_title ) );
                    } else {
                        echo esc_html( get_the_title() );
                    }
                    ?>
                </h1>

                <?php if ( $hero_sub ) : ?>
                    <p class="page-hero-sub"><?php echo esc_html( $hero_sub ); ?></p>
                <?php endif; ?>

                <?php if ( $hero_text ) : ?>
                    <p class="page-hero-text"><?php echo wp_kses_post( html_entity_decode( $hero_text ) ); ?></p>
                <?php endif; ?>
            </div>

            <?php if ( $hero_image ) : ?>
                <div class="page-hero-visual">
                    <img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ============ Body ============ -->
<section class="page-body-section">
    <div class="container">
        <div class="page-prose-wrap">

            <aside class="page-prose-aside" id="page-toc-aside" hidden>
                <div class="page-prose-aside-num">Contents</div>
                <h3 class="page-prose-aside-title">目次</h3>
                <ul class="page-prose-toc" id="page-toc-list"></ul>
                <div class="page-prose-meta">
                    Last Updated<br>
                    <?php echo esc_html( get_the_modified_date( 'Y.m.d' ) ); ?>
                </div>
            </aside>

            <article class="page-prose" id="page-prose-content">
                <?php the_content(); ?>
            </article>

        </div>
    </div>
</section>

<?php
endwhile;

// CTAストリップ
blueacademy_cta_strip();

get_footer();
