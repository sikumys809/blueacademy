<?php
/**
 * Meta Box Fields: SEO (全post type共通)
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'rwmb_meta_boxes', 'blueacademy_register_seo_fields' );
function blueacademy_register_seo_fields( $meta_boxes ) {

    $meta_boxes[] = array(
        'title'      => 'SEO設定',
        'id'         => 'seo_settings',
        'post_types' => array( 'page', 'post', 'news', 'story', 'teacher' ),
        'context'    => 'normal',
        'priority'   => 'low',
        'fields'     => array(
            array(
                'name' => 'メタディスクリプション',
                'id'   => 'seo_description',
                'type' => 'textarea',
                'rows' => 3,
                'desc' => '検索結果やSNSシェア時に表示される説明文。120-160文字推奨。空の場合は本文の冒頭が自動使用される。',
                'placeholder' => '例: 総合型選抜・推薦入試専門のオンライン予備校。脱偏差値×個性無双をスローガンに、難関大学合格率93.3%を実現しています。',
            ),
            array(
                'name' => 'OGP画像（SNSシェア用）',
                'id'   => 'seo_ogp_image',
                'type' => 'single_image',
                'desc' => 'Facebook / Twitter / LINEなどでシェアされた時に表示される画像。推奨1200×630px。<br>未設定時はアイキャッチ画像を流用。アイキャッチも未設定の場合はサイトデフォルト画像。',
                'force_delete' => false,
            ),
        ),
    );

    return $meta_boxes;
}
