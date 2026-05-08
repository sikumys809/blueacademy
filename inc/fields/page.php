<?php
/**
 * Meta Box Fields: Page (固定ページ用 Hero)
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'rwmb_meta_boxes', 'blueacademy_register_page_fields' );
function blueacademy_register_page_fields( $meta_boxes ) {

    $meta_boxes[] = array(
        'title'      => 'ページヒーロー設定',
        'id'         => 'page_hero',
        'post_types' => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'     => array(
            array(
                'name'        => 'ヒーロー上部メタテキスト',
                'id'          => 'hero_meta',
                'type'        => 'text',
                'desc'        => '例：「About Us ／ ブルーアカデミーとは」',
                'placeholder' => 'About Us ／ ブルーアカデミーとは',
            ),
            array(
                'name'        => 'ヒーロータイトル（HTML可）',
                'id'          => 'hero_title_html',
                'type'        => 'textarea',
                'rows'        => 3,
                'desc'        => '大見出し。<br>で改行、<span class="blue">青く</span>で青色アクセント可。',
                'placeholder' => '脱偏差値、<br><span class="blue">個性無双.</span>',
            ),
            array(
                'name'        => 'ヒーローサブタイトル',
                'id'          => 'hero_sub',
                'type'        => 'text',
                'desc'        => 'タイトル直下の1行サブテキスト',
                'placeholder' => '個性を、大学に届く合格理由へ。',
            ),
            array(
                'name' => 'ヒーローリード本文',
                'id'   => 'hero_text',
                'type' => 'textarea',
                'rows' => 4,
                'desc' => '導入の本文。<br>で改行可。',
            ),
            array(
                'name'             => 'ヒーロービジュアル画像（任意）',
                'id'               => 'hero_visual',
                'type'             => 'single_image',
                'force_delete'     => false,
                'max_file_uploads' => 1,
                'desc'             => '右側に表示するヒーロー画像。OGP用とは別物。未設定なら左テキストが横幅いっぱい。',
            ),
        ),
    );

    return $meta_boxes;
}
