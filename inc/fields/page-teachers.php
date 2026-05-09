<?php
/**
 * Meta Box Fields: Page Teachers (page-teachers.php 専用)
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'rwmb_meta_boxes', 'blueacademy_register_page_teachers_fields' );
function blueacademy_register_page_teachers_fields( $meta_boxes ) {

    // Intro セクション + CTA
    $meta_boxes[] = array(
        'title'      => 'Teachers: Intro & CTA',
        'id'         => 'page_teachers_intro',
        'post_types' => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'include'    => array( 'template' => array( 'page-teachers.php' ) ),
        'fields'     => array(
            array(
                'name' => 'Intro テキスト（HTML可）',
                'id'   => 'teachers_intro_text',
                'type' => 'textarea',
                'rows' => 4,
                'placeholder' => '教育のプロである前に、それぞれの現場で勝負してきた<span class="blue">実務家たち。</span><br>合言葉はひとつ。<span class="blue">「脱偏差値・個性無双」。</span>',
            ),
            array(
                'name' => 'Intro タグライン',
                'id'   => 'teachers_intro_tagline',
                'type' => 'text',
                'std'  => '8 Instructors ／ Blue Academy',
            ),
            array(
                'name' => 'CTAタイトル(HTML可)',
                'id'   => 'cta_strip_title',
                'type' => 'textarea',
                'rows' => 2,
                'placeholder' => 'まず話を聞きに来てください。<br>戦略の輪郭が、見えてくるはずです。',
            ),
        ),
    );

    return $meta_boxes;
}
