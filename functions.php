<?php
/**
 * Blue Academy theme functions
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'BLUEACADEMY_VERSION', '0.1.0' );
define( 'BLUEACADEMY_THEME_DIR', get_template_directory() );
define( 'BLUEACADEMY_THEME_URI', get_template_directory_uri() );

/**
 * テーマサポート設定
 */
function blueacademy_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support(
        'html5',
        array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
    );

    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'blueacademy' ),
            'footer'  => __( 'Footer Menu', 'blueacademy' ),
        )
    );
}
add_action( 'after_setup_theme', 'blueacademy_theme_setup' );

/**
 * 各種モジュール読み込み
 */
require_once BLUEACADEMY_THEME_DIR . '/inc/post-types.php';
require_once BLUEACADEMY_THEME_DIR . '/inc/meta-box-fields.php';
require_once BLUEACADEMY_THEME_DIR . '/inc/enqueue.php';
require_once BLUEACADEMY_THEME_DIR . '/inc/helpers.php';
require_once BLUEACADEMY_THEME_DIR . '/inc/seo.php';
require_once BLUEACADEMY_THEME_DIR . '/inc/json-ld.php';
