<?php
/**
 * Single News Template — お知らせの個別ページ
 *
 * @package Blueacademy
 */

get_header();

$post_id      = get_the_ID();
$is_important = (int) blueacademy_get_meta( 'is_important' );
$external_url = blueacademy_get_meta( 'external_url' );

// カテゴリ取得
$cats = get_the_terms( $post_id, 'news_category' );
$cat_labels = array();
if ( $cats && ! is_wp_error( $cats ) ) {
    foreach ( $cats as $cat ) {
        $cat_labels[] = $cat->name;
    }
}

// パンくず
blueacademy_breadcrumb( array(
    array( 'label' => 'News', 'url' => home_url( '/news/' ) ),
    array( 'label' => get_the_title(), 'url' => null ),
) );
?>

<?php while ( have_posts() ) : the_post(); ?>

<!-- ============ HERO ============ -->
<section class="news-hero">
    <div class="container">
        <div class="news-hero-meta">
            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" class="news-date">
                <?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?>
            </time>
            <?php if ( ! empty( $cat_labels ) ) : ?>
                <span class="news-cat"><?php echo esc_html( implode( ' / ', $cat_labels ) ); ?></span>
            <?php endif; ?>
            <?php if ( $is_important ) : ?>
                <span class="news-flag-important">重要</span>
            <?php endif; ?>
        </div>
        <h1 class="news-title"><?php the_title(); ?></h1>
    </div>
</section>

<!-- ============ Body ============ -->
<section class="news-body-section">
    <div class="container">
        <div class="news-body">
            <?php the_content(); ?>
        </div>

        <?php if ( $external_url ) : ?>
            <div class="news-external">
                <a href="<?php echo esc_url( $external_url ); ?>" class="btn btn-secondary btn-arrow" target="_blank" rel="noopener">関連リンクを開く</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ============ Back ============ -->
<nav class="news-nav">
    <div class="container">
        <a href="<?php echo esc_url( home_url( '/news/' ) ); ?>" class="news-nav-back">All News</a>
    </div>
</nav>

<?php endwhile; ?>

<!-- ============ CTA Strip ============ -->
<?php blueacademy_cta_strip(); ?>

<?php get_footer();
