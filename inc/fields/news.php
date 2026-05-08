<?php
/**
 * Meta Box Fields: News (お知らせ)
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'rwmb_meta_boxes', 'blueacademy_register_news_fields' );
function blueacademy_register_news_fields( $meta_boxes ) {

    $meta_boxes[] = array(
        'title'      => 'お知らせ追加情報',
        'id'         => 'news_meta',
        'post_types' => array( 'news' ),
        'context'    => 'side',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'name'        => '表示カテゴリ',
                'id'          => 'display_category',
                'type'        => 'select',
                'options'     => array(
                    'Notice' => 'Notice（お知らせ）',
                    'Update' => 'Update（更新情報）',
                    'Event'  => 'Event（イベント）',
                    'Other'  => 'Other（その他）',
                ),
                'std'         => 'Notice',
                'desc'        => 'TOPページや一覧で表示されるカテゴリラベル',
                'placeholder' => 'カテゴリを選択',
            ),
            array(
                'name' => '重要なお知らせ',
                'id'   => 'is_important',
                'type' => 'checkbox',
                'desc' => '一覧で目立つように表示',
            ),
            array(
                'name' => '外部リンク（任意）',
                'id'   => 'external_url',
                'type' => 'url',
                'desc' => 'クリック時に外部URLへ遷移する場合に入力',
            ),
        ),
    );

    return $meta_boxes;
}
