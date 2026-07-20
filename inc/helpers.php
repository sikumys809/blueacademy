<?php
/**
 * Helper functions
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Meta Boxフィールドの値を取得（rwmb_meta ラッパー）
 */
function blueacademy_get_meta( $key, $args = array(), $post_id = null ) {
    if ( ! function_exists( 'rwmb_meta' ) ) {
        return null;
    }
    return rwmb_meta( $key, $args, $post_id );
}

/**
 * 画像フィールドからURLを取得
 */
function blueacademy_get_image_url( $key, $size = 'full', $post_id = null ) {
    $image = blueacademy_get_meta( $key, array( 'size' => $size ), $post_id );
    if ( ! $image ) {
        return '';
    }
    if ( is_array( $image ) && isset( $image['url'] ) ) {
        return $image['url'];
    }
    if ( is_array( $image ) && isset( $image['full_url'] ) ) {
        return $image['full_url'];
    }
    return '';
}

/**
 * パンくずリスト出力（パーツ呼び出しのラッパー）
 */
function blueacademy_breadcrumb( $items ) {
    get_template_part( 'parts/breadcrumb', null, array( 'items' => $items ) );
}

/**
 * 共通CTAストリップ出力
 */
function blueacademy_cta_strip(
    $title_html = 'あなたの物語も、<br>ここに加えませんか。',
    $primary_label = '無料受験相談',
    $primary_url = 'https://utage-system.com/event/nLgsJEGf1Pff/register',
    $line_label = 'LINE追加',
    $line_url = 'https://utage-system.com/line/open/6mWKcAJuw1Ke?mtid=07ij3JpYP7K4'
) {
    ?>
    <section class="cta-strip">
        <div class="container">
            <div class="cta-strip-grid">
                <h2><?php echo wp_kses_post( $title_html ); ?></h2>
                <div class="cta-strip-actions">
                    <a href="<?php echo esc_url( $primary_url ); ?>" class="btn btn-primary btn-arrow" target="_blank" rel="noopener"><?php echo esc_html( $primary_label ); ?></a>
                    <a href="<?php echo esc_url( $line_url ); ?>" class="btn btn-line btn-arrow" target="_blank" rel="noopener"><?php echo esc_html( $line_label ); ?></a>
                </div>
            </div>
        </div>
    </section>
    <?php
}

/**
 * 同じCPTの前後の投稿を取得（sort_orderメタフィールド基準）
 */
function blueacademy_get_adjacent_posts( $post_type, $current_id ) {
    $all_posts = get_posts( array(
        'post_type'      => $post_type,
        'posts_per_page' => -1,
        'meta_key'       => 'sort_order',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
        'post_status'    => 'publish',
        'fields'         => 'ids',
    ) );

    if ( empty( $all_posts ) ) {
        return array( 'prev' => null, 'next' => null );
    }

    $current_index = array_search( $current_id, $all_posts, true );
    if ( false === $current_index ) {
        return array( 'prev' => null, 'next' => null );
    }

    $prev = ( $current_index > 0 ) ? get_post( $all_posts[ $current_index - 1 ] ) : null;
    $next = ( $current_index < count( $all_posts ) - 1 ) ? get_post( $all_posts[ $current_index + 1 ] ) : null;

    return array( 'prev' => $prev, 'next' => $next );
}

/**
 * YouTube埋め込みURL生成
 */
function blueacademy_youtube_embed_url( $youtube_id ) {
    if ( empty( $youtube_id ) ) {
        return '';
    }
    return 'https://www.youtube.com/embed/' . esc_attr( $youtube_id ) . '?rel=0';
}