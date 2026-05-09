<?php
/**
 * Meta Box Fields - Main Loader
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function blueacademy_metabox_active_check() {
    if ( ! function_exists( 'rwmb_meta' ) ) {
        if ( is_admin() && current_user_can( 'activate_plugins' ) ) {
            add_action( 'admin_notices', function() {
                echo '<div class="notice notice-error"><p><strong>Blue Academyテーマ:</strong> Meta Box プラグインが必要です。</p></div>';
            } );
        }
        return false;
    }
    return true;
}

if ( blueacademy_metabox_active_check() ) {
    require_once BLUEACADEMY_THEME_DIR . '/inc/fields/story.php';
    require_once BLUEACADEMY_THEME_DIR . '/inc/fields/teacher.php';
    require_once BLUEACADEMY_THEME_DIR . '/inc/fields/news.php';
    require_once BLUEACADEMY_THEME_DIR . '/inc/fields/page.php';
    require_once BLUEACADEMY_THEME_DIR . '/inc/fields/page-about.php';
    require_once BLUEACADEMY_THEME_DIR . '/inc/fields/page-results.php';
}
