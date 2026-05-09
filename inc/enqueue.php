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
    // CSS — グローバル
    // ============================================================
    wp_enqueue_style(
        'blueacademy-base',
        BLUEACADEMY_THEME_URI . '/assets/css/base.css',
        array( 'blueacademy-google-fonts' ),
        BLUEACADEMY_VERSION
    );

    wp_enqueue_style(
        'blueacademy-layout',
        BLUEACADEMY_THEME_URI . '/assets/css/layout.css',
        array( 'blueacademy-base' ),
        BLUEACADEMY_VERSION
    );

    wp_enqueue_style(
        'blueacademy-components',
        BLUEACADEMY_THEME_URI . '/assets/css/components.css',
        array( 'blueacademy-base' ),
        BLUEACADEMY_VERSION
    );

    wp_enqueue_style(
        'blueacademy-style',
        get_stylesheet_uri(),
        array( 'blueacademy-base' ),
        BLUEACADEMY_VERSION
    );

    // ============================================================
    // CSS — ページ別（CPT判定で動的読み込み）
    // ============================================================
    if ( is_singular( 'story' ) ) {
        wp_enqueue_style(
            'blueacademy-page-story',
            BLUEACADEMY_THEME_URI . '/assets/css/pages/story.css',
            array( 'blueacademy-base' ),
            BLUEACADEMY_VERSION
        );
    }

    if ( is_singular( 'teacher' ) ) {
        wp_enqueue_style(
            'blueacademy-page-teacher',
            BLUEACADEMY_THEME_URI . '/assets/css/pages/teacher.css',
            array( 'blueacademy-base' ),
            BLUEACADEMY_VERSION
        );
    }

    if ( is_singular( 'news' ) ) {
        wp_enqueue_style(
            'blueacademy-page-news',
            BLUEACADEMY_THEME_URI . '/assets/css/pages/news.css',
            array( 'blueacademy-base' ),
            BLUEACADEMY_VERSION
        );
    }

    if ( is_front_page() ) {
        wp_enqueue_style(
            'blueacademy-page-front',
            BLUEACADEMY_THEME_URI . '/assets/css/pages/front-page.css',
            array( 'blueacademy-base' ),
            BLUEACADEMY_VERSION
        );
    }

    if ( is_page() && ! is_front_page() ) {
        wp_enqueue_style(
            'blueacademy-page-page',
            BLUEACADEMY_THEME_URI . '/assets/css/pages/page.css',
            array( 'blueacademy-base' ),
            BLUEACADEMY_VERSION
        );
    }

    if ( is_page_template( 'page-about.php' ) ) {
        wp_enqueue_style(
            'blueacademy-page-about',
            BLUEACADEMY_THEME_URI . '/assets/css/pages/about.css',
            array( 'blueacademy-page-page' ),
            BLUEACADEMY_VERSION
        );
    }

    if ( is_page_template( 'page-results.php' ) ) {
        wp_enqueue_style(
            'blueacademy-page-results',
            BLUEACADEMY_THEME_URI . '/assets/css/pages/results.css',
            array( 'blueacademy-page-page' ),
            BLUEACADEMY_VERSION
        );
    }



    // ============================================================
    // JS
    // ============================================================
    wp_enqueue_script(
        'blueacademy-modal',
        BLUEACADEMY_THEME_URI . '/assets/js/modal.js',
        array(),
        BLUEACADEMY_VERSION,
        true
    );

    wp_enqueue_script(
        'blueacademy-menu',
        BLUEACADEMY_THEME_URI . '/assets/js/menu.js',
        array(),
        BLUEACADEMY_VERSION,
        true
    );

    // page.php (特商法 / プライバシー等) で目次自動生成
    if ( is_page() && ! is_front_page() && ! is_page_template() ) {
        wp_enqueue_script(
            'blueacademy-page-toc',
            BLUEACADEMY_THEME_URI . '/assets/js/page-toc.js',
            array(),
            BLUEACADEMY_VERSION,
            true
        );
    }

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
