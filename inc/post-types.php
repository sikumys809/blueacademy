<?php
/**
 * Custom Post Types
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 合格者体験記 CPT (story)
 */
function blueacademy_register_story_cpt() {
    $labels = array(
        'name'                  => '合格者体験記',
        'singular_name'         => '合格者体験記',
        'menu_name'             => '合格者体験記',
        'name_admin_bar'        => '合格者体験記',
        'add_new'               => '新規追加',
        'add_new_item'          => '新規 合格者体験記 を追加',
        'new_item'              => '新規 合格者体験記',
        'edit_item'             => '合格者体験記 を編集',
        'view_item'             => '合格者体験記 を表示',
        'all_items'             => 'すべての合格者体験記',
        'search_items'          => '合格者体験記 を検索',
        'not_found'             => '合格者体験記 が見つかりませんでした',
        'not_found_in_trash'    => 'ゴミ箱に 合格者体験記 はありません',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => false,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'story', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-awards',
        'supports'           => array( 'title', 'thumbnail', 'page-attributes' ),
    );

    register_post_type( 'story', $args );
}
add_action( 'init', 'blueacademy_register_story_cpt' );

/**
 * 講師 CPT (teacher)
 */
function blueacademy_register_teacher_cpt() {
    $labels = array(
        'name'                  => '講師',
        'singular_name'         => '講師',
        'menu_name'             => '講師',
        'add_new'               => '新規追加',
        'add_new_item'          => '新規 講師 を追加',
        'new_item'              => '新規 講師',
        'edit_item'             => '講師 を編集',
        'view_item'             => '講師 を表示',
        'all_items'             => 'すべての講師',
        'search_items'          => '講師 を検索',
        'not_found'             => '講師 が見つかりませんでした',
        'not_found_in_trash'    => 'ゴミ箱に 講師 はありません',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => false,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'teacher', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-businessperson',
        'supports'           => array( 'title', 'thumbnail', 'page-attributes' ),
    );

    register_post_type( 'teacher', $args );
}
add_action( 'init', 'blueacademy_register_teacher_cpt' );

/**
 * お知らせ CPT (news)
 */
function blueacademy_register_news_cpt() {
    $labels = array(
        'name'                  => 'お知らせ',
        'singular_name'         => 'お知らせ',
        'menu_name'             => 'お知らせ',
        'add_new'               => '新規追加',
        'add_new_item'          => '新規 お知らせ を追加',
        'new_item'              => '新規 お知らせ',
        'edit_item'             => 'お知らせ を編集',
        'view_item'             => 'お知らせ を表示',
        'all_items'             => 'すべてのお知らせ',
        'search_items'          => 'お知らせ を検索',
        'not_found'             => 'お知らせ が見つかりませんでした',
        'not_found_in_trash'    => 'ゴミ箱に お知らせ はありません',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'news', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-megaphone',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    );

    register_post_type( 'news', $args );

    register_taxonomy(
        'news_category',
        'news',
        array(
            'labels'            => array(
                'name'          => 'お知らせカテゴリー',
                'singular_name' => 'お知らせカテゴリー',
            ),
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'rewrite'           => array( 'slug' => 'news-category' ),
        )
    );
}
add_action( 'init', 'blueacademy_register_news_cpt' );
