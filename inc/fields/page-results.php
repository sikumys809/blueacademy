<?php
/**
 * Meta Box Fields: Page Results (page-results.php 専用)
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'rwmb_meta_boxes', 'blueacademy_register_page_results_fields' );
function blueacademy_register_page_results_fields( $meta_boxes ) {

    // ----------------------------------------------------------------
    // Section 1: By the Numbers (Big Numbers x 6)
    // ----------------------------------------------------------------
    $numbers_fields = array(
        array( 'name' => 'セクション番号', 'id' => 'numbers_eyebrow_num',   'type' => 'text', 'placeholder' => '01' ),
        array( 'name' => 'セクションラベル(英)', 'id' => 'numbers_eyebrow_label', 'type' => 'text', 'placeholder' => 'By the Numbers' ),
        array(
            'name' => 'セクションタイトル(HTML可)',
            'id'   => 'numbers_title',
            'type' => 'textarea', 'rows' => 2,
            'placeholder' => '数字で見る、<br>2025年度。',
        ),
        array( 'name' => 'セクションリード', 'id' => 'numbers_lead', 'type' => 'textarea', 'rows' => 2 ),
    );
    for ( $i = 1; $i <= 6; $i++ ) {
        $numbers_fields[] = array( 'name' => sprintf( '── Big Number %d ──', $i ), 'type' => 'heading' );
        $numbers_fields[] = array(
            'name' => '数値',
            'id'   => "bignum_{$i}_value",
            'type' => 'text',
            'desc' => '例: 100, 93.3, 30, 全国（テキストの場合は下のチェックON）',
        );
        $numbers_fields[] = array(
            'name' => '単位',
            'id'   => "bignum_{$i}_unit",
            'type' => 'text',
            'std'  => '%',
            'desc' => '例: %, +（テキスト型なら空欄）',
        );
        $numbers_fields[] = array(
            'name' => 'ラベル(HTML可)',
            'id'   => "bignum_{$i}_label",
            'type' => 'textarea', 'rows' => 2,
        );
        $numbers_fields[] = array(
            'name' => 'テキスト型として表示',
            'id'   => "bignum_{$i}_is_text",
            'type' => 'checkbox',
            'desc' => '数値ではなく文字（例:「全国」）の場合ON。フォントサイズが小さくなる。',
        );
    }
    $meta_boxes[] = array(
        'title'      => 'Results: 1. By the Numbers',
        'id'         => 'page_results_numbers',
        'post_types' => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'include'    => array( 'template' => array( 'page-results.php' ) ),
        'fields'     => $numbers_fields,
    );

    // ----------------------------------------------------------------
    // Section 2: Universities List (Categories x 7)
    // ----------------------------------------------------------------
    $uni_fields = array(
        array( 'name' => 'セクション番号', 'id' => 'uni_eyebrow_num',   'type' => 'text', 'placeholder' => '02' ),
        array( 'name' => 'セクションラベル(英)', 'id' => 'uni_eyebrow_label', 'type' => 'text', 'placeholder' => 'Universities List' ),
        array(
            'name' => 'セクションタイトル(HTML可)',
            'id'   => 'uni_title',
            'type' => 'textarea', 'rows' => 2,
            'placeholder' => '合格実績<br>大学一覧',
        ),
        array( 'name' => 'セクションリード', 'id' => 'uni_lead', 'type' => 'textarea', 'rows' => 2 ),
    );
    for ( $i = 1; $i <= 7; $i++ ) {
        $uni_fields[] = array( 'name' => sprintf( '── Category %d ──', $i ), 'type' => 'heading' );
        $uni_fields[] = array(
            'name' => 'カテゴリナンバー',
            'id'   => "uni_cat_{$i}_num",
            'type' => 'text',
            'placeholder' => "CATEGORY 0{$i}",
        );
        $uni_fields[] = array(
            'name' => 'カテゴリタイトル',
            'id'   => "uni_cat_{$i}_title",
            'type' => 'text',
        );
        $uni_fields[] = array(
            'name' => '大学リスト',
            'id'   => "uni_cat_{$i}_list",
            'type' => 'textarea',
            'rows' => 8,
            'desc' => '1行 = 1大学。形式: <code>大学名|倍率</code>（パイプ区切り）。倍率なしの場合は <code>大学名|—</code> または <code>大学名</code> のみ。<br>例: <code>慶應義塾大学 環境情報学部|倍率 4.5</code>',
        );
    }
    $meta_boxes[] = array(
        'title'      => 'Results: 2. Universities List',
        'id'         => 'page_results_universities',
        'post_types' => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'include'    => array( 'template' => array( 'page-results.php' ) ),
        'fields'     => $uni_fields,
    );

    // ----------------------------------------------------------------
    // Section 3: Why We Achieve (Reasons x 3)
    // ----------------------------------------------------------------
    $why_fields = array(
        array( 'name' => 'セクション番号', 'id' => 'why_eyebrow_num',   'type' => 'text', 'placeholder' => '03' ),
        array( 'name' => 'セクションラベル(英)', 'id' => 'why_eyebrow_label', 'type' => 'text', 'placeholder' => 'Why We Achieve' ),
        array(
            'name' => 'セクションタイトル(HTML可)',
            'id'   => 'why_title',
            'type' => 'textarea', 'rows' => 2,
            'placeholder' => 'なぜ、<br>この実績が出せるのか。',
        ),
        array( 'name' => 'セクションリード', 'id' => 'why_lead', 'type' => 'textarea', 'rows' => 3 ),
    );
    for ( $i = 1; $i <= 3; $i++ ) {
        $why_fields[] = array( 'name' => sprintf( '── Reason %d ──', $i ), 'type' => 'heading' );
        $why_fields[] = array( 'name' => 'ナンバー', 'id' => "why_reason_{$i}_num",   'type' => 'text', 'placeholder' => "REASON 0{$i}" );
        $why_fields[] = array( 'name' => 'タイトル(HTML可)', 'id' => "why_reason_{$i}_title", 'type' => 'textarea', 'rows' => 2 );
        $why_fields[] = array( 'name' => '本文', 'id' => "why_reason_{$i}_text", 'type' => 'textarea', 'rows' => 3 );
    }
    $meta_boxes[] = array(
        'title'      => 'Results: 3. なぜこの実績が出せるのか',
        'id'         => 'page_results_why',
        'post_types' => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'include'    => array( 'template' => array( 'page-results.php' ) ),
        'fields'     => $why_fields,
    );

    // ----------------------------------------------------------------
    // Section 4: CTA Strip
    // ----------------------------------------------------------------
    $meta_boxes[] = array(
        'title'      => 'Results: 4. 末尾CTAストリップ',
        'id'         => 'page_results_cta',
        'post_types' => array( 'page' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'include'    => array( 'template' => array( 'page-results.php' ) ),
        'fields'     => array(
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
