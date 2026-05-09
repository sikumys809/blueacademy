<?php
/**
 * SEO Helper Functions
 *
 * 各ページの description / OGP image / canonical URL を取得。
 * 設定がない場合は自動フォールバック。
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * メタディスクリプションを取得（自動フォールバック付き）
 */
function blueacademy_get_seo_description() {
    $desc = '';

    // 1. SEO設定から取得
    if ( is_singular() ) {
        $desc = get_post_meta( get_the_ID(), 'seo_description', true );
    }

    // 2. フォールバック: 本文の冒頭
    if ( ! $desc && is_singular() ) {
        $post = get_post();
        if ( $post && $post->post_excerpt ) {
            $desc = $post->post_excerpt;
        } elseif ( $post && $post->post_content ) {
            $desc = wp_strip_all_tags( $post->post_content );
        }
    }

    // 3. 最終フォールバック: サイト説明
    if ( ! $desc ) {
        $desc = get_bloginfo( 'description' );
    }

    // 余計な空白除去 + 160文字以内に丸める
    $desc = preg_replace( '/\s+/', ' ', trim( $desc ) );
    if ( mb_strlen( $desc ) > 160 ) {
        $desc = mb_substr( $desc, 0, 157 ) . '...';
    }

    return $desc;
}

/**
 * OGP画像URLを取得（フォールバック: アイキャッチ → サイトデフォルト）
 */
function blueacademy_get_seo_ogp_image() {
    if ( is_singular() ) {
        $pid = get_the_ID();

        // 1. 専用OGP画像
        $ogp_id = (int) get_post_meta( $pid, 'seo_ogp_image', true );
        if ( $ogp_id > 0 ) {
            $url = wp_get_attachment_image_url( $ogp_id, 'large' );
            if ( $url ) return $url;
        }

        // 2. アイキャッチ画像
        if ( has_post_thumbnail( $pid ) ) {
            $url = get_the_post_thumbnail_url( $pid, 'large' );
            if ( $url ) return $url;
        }

        // 3. ヒーロー画像（既存メタ流用）
        $hero_id = (int) get_post_meta( $pid, 'hero_visual', true );
        if ( $hero_id > 0 ) {
            $url = wp_get_attachment_image_url( $hero_id, 'large' );
            if ( $url ) return $url;
        }
    }

    // 4. サイトデフォルト
    return get_template_directory_uri() . '/assets/images/blueacademy-logo.svg';
}

/**
 * canonical URL を取得
 */
function blueacademy_get_canonical_url() {
    if ( is_singular() ) {
        return get_permalink();
    }
    if ( is_front_page() ) {
        return home_url( '/' );
    }
    if ( is_archive() ) {
        return get_pagenum_link();
    }
    return home_url( add_query_arg( null, null ) );
}

/**
 * <head> に SEO meta タグを出力
 */
add_action( 'wp_head', 'blueacademy_output_seo_meta', 1 );
function blueacademy_output_seo_meta() {
    $desc      = blueacademy_get_seo_description();
    $ogp_image = blueacademy_get_seo_ogp_image();
    $canonical = blueacademy_get_canonical_url();
    $title     = wp_get_document_title();
    $site_name = get_bloginfo( 'name' );

    $og_type = is_singular( 'post' ) || is_singular( 'news' ) ? 'article' : 'website';

    ?>
    <meta name="description" content="<?php echo esc_attr( $desc ); ?>">
    <link rel="canonical" href="<?php echo esc_url( $canonical ); ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $desc ); ?>">
    <meta property="og:image" content="<?php echo esc_url( $ogp_image ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $canonical ); ?>">
    <meta property="og:type" content="<?php echo esc_attr( $og_type ); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr( $site_name ); ?>">
    <meta property="og:locale" content="ja_JP">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $desc ); ?>">
    <meta name="twitter:image" content="<?php echo esc_url( $ogp_image ); ?>">
    <?php
}
