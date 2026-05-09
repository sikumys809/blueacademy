<?php
/**
 * Performance & Cleanup
 *
 * 不要な wp_head 出力削除、emoji停止、script defer化、
 * attachment ページ404化、XML-RPC無効化など。
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ============================================================
 * 1. <head> から不要な出力を削除
 * ============================================================ */
remove_action( 'wp_head', 'wp_generator' );                      // <meta name="generator">
remove_action( 'wp_head', 'wlwmanifest_link' );                  // Windows Live Writer
remove_action( 'wp_head', 'rsd_link' );                          // Really Simple Discovery
remove_action( 'wp_head', 'wp_shortlink_wp_head' );              // <link rel="shortlink">
remove_action( 'wp_head', 'rest_output_link_wp_head' );          // <link rel="https://api.w.org/">
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );     // oEmbed JSON/XML
remove_action( 'wp_head', 'feed_links', 2 );                     // RSS feed
remove_action( 'wp_head', 'feed_links_extra', 3 );               // RSS feed extra

remove_action( 'template_redirect', 'rest_output_link_header', 11 );  // HTTP Link header

/* ============================================================
 * 2. wp-emoji 完全停止 (不要な inline JS + CSS を削除)
 * ============================================================ */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

// emoji DNS prefetch も削除
add_filter( 'emoji_svg_url', '__return_false' );

/* ============================================================
 * 3. テーマ JS に defer を追加 (レンダリングブロック解消)
 * ============================================================ */
add_filter( 'script_loader_tag', 'blueacademy_defer_scripts', 10, 2 );
function blueacademy_defer_scripts( $tag, $handle ) {
    if ( is_admin() ) return $tag;

    $defer_handles = array(
        'blueacademy-modal',
        'blueacademy-menu',
        'blueacademy-page-toc',
        'blueacademy-stories-video-modal',
    );

    if ( in_array( $handle, $defer_handles, true ) ) {
        return str_replace( '<script ', '<script defer ', $tag );
    }
    return $tag;
}

/* ============================================================
 * 4. Attachment ページを 404 化
 * ============================================================
 * /?attachment_id=123 や /attachment-slug/ をクロール対象から外す。
 * 画像本体 URL (/wp-content/uploads/...) には影響しない。
 */
add_action( 'template_redirect', 'blueacademy_disable_attachment_pages' );
function blueacademy_disable_attachment_pages() {
    if ( is_attachment() ) {
        global $wp_query;
        $wp_query->set_404();
        status_header( 404 );
        nocache_headers();
    }
}

/* ============================================================
 * 5. XML-RPC 完全無効化 (セキュリティ向上)
 * ============================================================
 * XMLRPC を経由したブルートフォース攻撃の入口を塞ぐ。
 * wp-cli は内部直接アクセスなので影響なし。
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

// X-Pingback HTTPヘッダーも削除
add_filter( 'wp_headers', 'blueacademy_remove_xpingback' );
function blueacademy_remove_xpingback( $headers ) {
    unset( $headers['X-Pingback'] );
    return $headers;
}

/* ============================================================
 * 6. WP標準サイトマップに不要なpost typeのフィードリンクを停止
 * ============================================================ */
remove_action( 'wp_head', 'rest_queried_resource_route_embed_links' );
