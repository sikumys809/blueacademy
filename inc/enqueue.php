<?php
/**
 * Enqueue scripts and styles
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * フロントエンド用 CSS / JS / フォントの読み込み
 */
function blueacademy_enqueue_assets() {

    // ============================================================
    // Google Fonts (Geist + Noto Sans JP)
    // ============================================================
    wp_enqueue_style(
        'blueacademy-google-fonts',
        'https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700;800;900&family=Noto+Sans+JP:wght@400;500;700;900&display=swap',
        array(),
        null
    );

    // ============================================================
    // CSS
    // ============================================================
    // 1. base.css — design tokens / リセット / タイポ
    wp_enqueue_style(
        'blueacademy-base',
        BLUEACADEMY_THEME_URI . '/assets/css/base.css',
        array( 'blueacademy-google-fonts' ),
        BLUEACADEMY_VERSION
    );

    // 2. layout.css — header / footer / container
    wp_enqueue_style(
        'blueacademy-layout',
        BLUEACADEMY_THEME_URI . '/assets/css/layout.css',
        array( 'blueacademy-base' ),
        BLUEACADEMY_VERSION
    );

    // 3. components.css — btn / breadcrumb / cta-strip
    wp_enqueue_style(
        'blueacademy-components',
        BLUEACADEMY_THEME_URI . '/assets/css/components.css',
        array( 'blueacademy-base' ),
        BLUEACADEMY_VERSION
    );

    // 4. style.css (テーマヘッダー識別用、最後に読み込み)
    wp_enqueue_style(
        'blueacademy-style',
        get_stylesheet_uri(),
        array( 'blueacademy-base' ),
        BLUEACADEMY_VERSION
    );

    // ============================================================
    // JS
    // ============================================================
    wp_enqueue_script(
        'blueacademy-modal',
        BLUEACADEMY_THEME_URI . '/assets/js/modal.js',
        array(),
        BLUEACADEMY_VERSION,
        true // </body> 直前で読み込み
    );

    wp_enqueue_script(
        'blueacademy-menu',
        BLUEACADEMY_THEME_URI . '/assets/js/menu.js',
        array(),
        BLUEACADEMY_VERSION,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'blueacademy_enqueue_assets' );

/**
 * preconnect ヒントを <head> に追加（Google Fonts高速化）
 */
function blueacademy_resource_hints( $hints, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $hints[] = array(
            'href'        => 'https://fonts.googleapis.com',
            'crossorigin' => 'anonymous',
        );
        $hints[] = array(
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }
    return $hints;
}
add_filter( 'wp_resource_hints', 'blueacademy_resource_hints', 10, 2 );
