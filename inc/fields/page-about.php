<?php
/**
 * Meta Box Fields: Page About (page-about.php 専用)
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'rwmb_meta_boxes', 'blueacademy_register_page_about_fields' );
function blueacademy_register_page_about_fields( $meta_boxes ) {

    // ----------------------------------------------------------------
    // Section 1: 3 Pillars (Three Principles)
    // ----------------------------------------------------------------
    $pillar_fields = array(
        array(
            'name'        => 'セクション番号',
            'id'          => 'pillars_eyebrow_num',
            'type'        => 'text',
            'placeholder' => '01',
        ),
        array(
            'name'        => 'セクションラベル(英)',
            'id'          => 'pillars_eyebrow_label',
            'type'        => 'text',
            'placeholder' => 'Three Principles',
        ),
        array(
            'name'        => 'セクションタイトル(HTML可)',
            'id'          => 'pillars_title',
            'type'        => 'textarea',
            'rows'        => 2,
            'placeholder' => '3つの原則で、<br>合格を再現する。',
        ),
        array(
            'name'        => 'セクションリード',
            'id'          => 'pillars_lead',
            'type'        => 'textarea',
            'rows'        => 2,
            'placeholder' => '地理、講師、体制 ― ブルーアカデミーが他と違う3つの理由。',
        ),
    );
    for ( $i = 1; $i <= 3; $i++ ) {
        $pillar_fields[] = array(
            'name' => sprintf( '── Pillar %d ──', $i ),
            'type' => 'heading',
        );
        $pillar_fields[] = array(
            'name'        => 'ナンバー',
            'id'          => "pillar_{$i}_num",
            'type'        => 'text',
            'placeholder' => "PRINCIPLE 0{$i}",
        );
        $pillar_fields[] = array(
            'name' => 'タイトル',
            'id'   => "pillar_{$i}_title",
            'type' => 'text',
        );
        $pillar_fields[] = array(
            'name' => '本文',
            'id'   => "pillar_{$i}_text",
            'type' => 'textarea',
            'rows' => 3,
        );
    }
    $meta_boxes[] = array(
        'title'         => 'About: 1. 3つの原則',
        'id'            => 'page_about_pillars',
        'post_types'    => array( 'page' ),
        'context'       => 'normal',
        'priority'      => 'default',
        'include'       => array( 'template' => array( 'page-about.php' ) ),
        'fields'        => $pillar_fields,
    );

    // ----------------------------------------------------------------
    // Section 2: Definitions (3 blocks)
    // ----------------------------------------------------------------
    $def_fields = array();
    for ( $i = 1; $i <= 3; $i++ ) {
        $def_fields[] = array(
            'name' => sprintf( '── Definition %d ──', $i ),
            'type' => 'heading',
        );
        $def_fields[] = array(
            'name'        => 'ラベル(英)',
            'id'          => "def_{$i}_label",
            'type'        => 'text',
            'placeholder' => "Definition 0{$i}",
        );
        $def_fields[] = array(
            'name'        => 'タイトル(HTML可)',
            'id'          => "def_{$i}_title",
            'type'        => 'textarea',
            'rows'        => 2,
            'desc'        => '<br>で改行可',
        );
        $def_fields[] = array(
            'name'        => '本文(HTML可)',
            'id'          => "def_{$i}_body",
            'type'        => 'wysiwyg',
            'options'     => array(
                'textarea_rows' => 6,
                'media_buttons' => false,
            ),
            'desc'        => '<span class="blue">青色</span>でアクセント可。段落ごとに改行。',
        );
    }
    $meta_boxes[] = array(
        'title'      => 'About: 2. 定義 (Definition × 3)',
        'id'         => 'page_about_definitions',
        'post_types' => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'include'    => array( 'template' => array( 'page-about.php' ) ),
        'fields'     => $def_fields,
    );

    // ----------------------------------------------------------------
    // Section 3: Online Advantage (Big Numbers + Reasons)
    // ----------------------------------------------------------------
    $online_fields = array(
        array(
            'name'        => 'セクション番号',
            'id'          => 'online_eyebrow_num',
            'type'        => 'text',
            'placeholder' => '02',
        ),
        array(
            'name'        => 'セクションラベル(英)',
            'id'          => 'online_eyebrow_label',
            'type'        => 'text',
            'placeholder' => 'Online Advantage',
        ),
        array(
            'name'        => 'セクションタイトル(HTML可)',
            'id'          => 'online_title',
            'type'        => 'textarea',
            'rows'        => 2,
            'placeholder' => 'オンラインだから、<br>結果が出る。',
        ),
        array(
            'name'        => 'セクションリード',
            'id'          => 'online_lead',
            'type'        => 'textarea',
            'rows'        => 2,
        ),
    );
    for ( $i = 1; $i <= 4; $i++ ) {
        $online_fields[] = array(
            'name' => sprintf( '── Big Number %d ──', $i ),
            'type' => 'heading',
        );
        $online_fields[] = array(
            'name' => '数値',
            'id'   => "bignum_{$i}_value",
            'type' => 'text',
            'desc' => '例: 100, 93.3',
        );
        $online_fields[] = array(
            'name'    => '単位',
            'id'      => "bignum_{$i}_unit",
            'type'    => 'text',
            'std'     => '%',
        );
        $online_fields[] = array(
            'name' => 'ラベル(HTML可)',
            'id'   => "bignum_{$i}_label",
            'type' => 'textarea',
            'rows' => 2,
            'desc' => '<br>で改行可',
        );
    }
    for ( $i = 1; $i <= 3; $i++ ) {
        $online_fields[] = array(
            'name' => sprintf( '── Reason %d ──', $i ),
            'type' => 'heading',
        );
        $online_fields[] = array(
            'name'        => 'ナンバー',
            'id'          => "reason_{$i}_num",
            'type'        => 'text',
            'placeholder' => "REASON 0{$i}",
        );
        $online_fields[] = array(
            'name' => 'タイトル(HTML可)',
            'id'   => "reason_{$i}_title",
            'type' => 'textarea',
            'rows' => 2,
        );
        $online_fields[] = array(
            'name' => '本文',
            'id'   => "reason_{$i}_text",
            'type' => 'textarea',
            'rows' => 3,
        );
    }
    $meta_boxes[] = array(
        'title'      => 'About: 3. オンライン優位性 (数字+理由)',
        'id'         => 'page_about_online',
        'post_types' => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'include'    => array( 'template' => array( 'page-about.php' ) ),
        'fields'     => $online_fields,
    );

    // ----------------------------------------------------------------
    // Section 4: Specialist Team
    // ----------------------------------------------------------------
    $spec_fields = array(
        array(
            'name'        => 'セクション番号',
            'id'          => 'specialist_eyebrow_num',
            'type'        => 'text',
            'placeholder' => '03',
        ),
        array(
            'name'        => 'セクションラベル(英)',
            'id'          => 'specialist_eyebrow_label',
            'type'        => 'text',
            'placeholder' => 'Specialist Team',
        ),
        array(
            'name'        => 'セクションタイトル(HTML可)',
            'id'          => 'specialist_title',
            'type'        => 'textarea',
            'rows'        => 2,
            'placeholder' => '専門職体制が、<br>本番に強い理由。',
        ),
        array(
            'name'        => 'セクションリード',
            'id'          => 'specialist_lead',
            'type'        => 'textarea',
            'rows'        => 3,
        ),
    );
    for ( $i = 1; $i <= 3; $i++ ) {
        $spec_fields[] = array(
            'name' => sprintf( '── Specialist %d ──', $i ),
            'type' => 'heading',
        );
        $spec_fields[] = array(
            'name'        => 'ナンバー',
            'id'          => "specialist_{$i}_num",
            'type'        => 'text',
            'placeholder' => "SPECIALIST 0{$i}",
        );
        $spec_fields[] = array(
            'name' => 'タイトル(HTML可)',
            'id'   => "specialist_{$i}_title",
            'type' => 'textarea',
            'rows' => 2,
        );
        $spec_fields[] = array(
            'name' => '本文',
            'id'   => "specialist_{$i}_text",
            'type' => 'textarea',
            'rows' => 3,
        );
    }
    $meta_boxes[] = array(
        'title'      => 'About: 4. 専門職チーム',
        'id'         => 'page_about_specialists',
        'post_types' => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'include'    => array( 'template' => array( 'page-about.php' ) ),
        'fields'     => $spec_fields,
    );

    // ----------------------------------------------------------------
    // Section 5: CTA Strip
    // ----------------------------------------------------------------
    $meta_boxes[] = array(
        'title'      => 'About: 5. 末尾CTAストリップ',
        'id'         => 'page_about_cta',
        'post_types' => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'include'    => array( 'template' => array( 'page-about.php' ) ),
        'fields'     => array(
            array(
                'name'        => 'CTAタイトル(HTML可)',
                'id'          => 'cta_strip_title',
                'type'        => 'textarea',
                'rows'        => 2,
                'placeholder' => 'まず話を聞きに来てください。<br>戦略の輪郭が、見えてくるはずです。',
            ),
        ),
    );

    return $meta_boxes;
}
