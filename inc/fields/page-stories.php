<?php
/**
 * Meta Box Fields: Page Stories (page-stories.php 専用)
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'rwmb_meta_boxes', 'blueacademy_register_page_stories_fields' );
function blueacademy_register_page_stories_fields( $meta_boxes ) {

    $meta_boxes[] = array(
        'title'      => 'Stories: Intro & CTA',
        'id'         => 'page_stories_intro',
        'post_types' => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'include'    => array( 'template' => array( 'page-stories.php' ) ),
        'fields'     => array(
            array(
                'name' => 'Intro 見出し（HTML可）',
                'id'   => 'stories_intro_heading',
                'type' => 'textarea',
                'rows' => 3,
                'placeholder' => '「いかにもすごそうな何か」を、<br>あなたが持っていなくても。<br><span class="blue">志望校に届く勝機は、確実にある.</span>',
            ),
            array(
                'name' => 'Intro リスト（1行1項目）',
                'id'   => 'stories_intro_items',
                'type' => 'textarea',
                'rows' => 8,
                'desc' => '1行 = 1項目。各行が li になる。',
                'placeholder' => "多額の費用をかけた留学経験
国際的な受賞歴や輝かしい実績
高い評定と、幼少期から鍛え上げた語学力
大学附属高校でのハイレベルな教育環境
部活での全国レベルの戦績
潤沢な資金と、太い人脈",
            ),
            array(
                'name' => 'Intro サイドテキスト（HTML可・複数段落は <p>...</p>）',
                'id'   => 'stories_intro_side',
                'type' => 'textarea',
                'rows' => 6,
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
