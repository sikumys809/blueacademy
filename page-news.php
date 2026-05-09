<?php
/**
 * Template Name: News List
 *
 * News 一覧ページテンプレート (page-news.php)
 * Mock: mockups/news.html
 *
 * @package Blueacademy
 */

get_header();

while ( have_posts() ) : the_post();

    $hero_meta  = blueacademy_get_meta( 'hero_meta' );
    $hero_title = blueacademy_get_meta( 'hero_title_html' );
    $hero_sub   = blueacademy_get_meta( 'hero_sub' );
    $hero_text  = blueacademy_get_meta( 'hero_text' );
    $hero_image = blueacademy_get_image_url( 'hero_visual', 'large' );

    blueacademy_breadcrumb( array(
        array( 'label' => 'News', 'url' => null ),
        array( 'label' => get_the_title(), 'url' => null ),
    ) );
?>

<!-- HERO -->
<section class="page-hero">
    <div class="container">
        <div class="page-hero-inner">
            <div class="page-hero-text-wrap">
                <?php if ( $hero_meta ) : ?>
                    <div class="page-hero-meta"><?php echo esc_html( $hero_meta ); ?></div>
                <?php endif; ?>
                <h1 class="page-hero-title">
                    <?php echo $hero_title ? wp_kses_post( html_entity_decode( $hero_title ) ) : esc_html( get_the_title() ); ?>
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
            <?php else : ?>
                <div class="page-hero-visual">
                    <div class="page-hero-visual-placeholder">Image Area</div>
                    <div class="page-hero-visual-caption">News &mdash; Visual</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- NEWS LIST -->
<section class="section">
    <div class="container">
        <?php
        $paged = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
        $per_page = 10;
        $news_query = new WP_Query( array(
            'post_type'      => 'news',
            'post_status'    => 'publish',
            'posts_per_page' => $per_page,
            'paged'          => $paged,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );

        if ( $news_query->have_posts() ) : ?>
            <div class="news-list-full">
                <?php while ( $news_query->have_posts() ) : $news_query->the_post();
                    $cat = blueacademy_get_meta( 'display_category' );
                ?>
                    <a href="<?php the_permalink(); ?>" class="news-item">
                        <div class="news-date"><?php echo esc_html( get_the_date( 'Y.m.d' ) ); ?></div>
                        <div class="news-cat"><?php echo esc_html( $cat ? $cat : 'Notice' ); ?></div>
                        <div class="news-title"><?php the_title(); ?></div>
                        <div class="news-arrow">&rarr;</div>
                    </a>
                <?php endwhile; ?>
            </div>

            <?php
            // ページネーション
            $total = $news_query->max_num_pages;
            if ( $total > 1 ) :
                $base = preg_replace( '/\?.*/', '', get_pagenum_link( 1 ) );
                $links = paginate_links( array(
                    'base'      => trailingslashit( $base ) . '%_%',
                    'format'    => 'page/%#%/',
                    'current'   => $paged,
                    'total'     => $total,
                    'prev_text' => 'Prev',
                    'next_text' => 'Next',
                    'type'      => 'array',
                ) );
                if ( $links ) : ?>
                    <nav class="pagination">
                        <?php foreach ( $links as $link ) {
                            // Prev/Next にクラス追加
                            $link = preg_replace( '/page-numbers prev/', 'page-numbers prev nav', $link );
                            $link = preg_replace( '/page-numbers next/', 'page-numbers next nav', $link );
                            echo $link;
                        } ?>
                    </nav>
                <?php endif;
            endif;

            wp_reset_postdata();
        else : ?>
            <div class="empty-state">
                お知らせはまだ投稿されていません。
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
endwhile;

blueacademy_cta_strip();

get_footer();
