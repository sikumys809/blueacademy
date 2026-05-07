<?php
/**
 * Meta Box Fields: Teacher (講師)
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'rwmb_meta_boxes', 'blueacademy_register_teacher_fields' );
function blueacademy_register_teacher_fields( $meta_boxes ) {

    // 1. 基本情報
    $meta_boxes[] = array(
        'title'      => '基本情報・ヒーロー',
        'id'         => 'teacher_hero',
        'post_types' => array( 'teacher' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'     => array(
            array(
                'name' => '役職',
                'id'   => 'position',
                'type' => 'select',
                'desc' => '塾長・主任講師・講師から選択',
                'options' => array(
                    '塾長 / Director'              => '塾長 / Director',
                    '主任講師 / Lead Instructor'    => '主任講師 / Lead Instructor',
                    '講師 / Instructor'            => '講師 / Instructor',
                ),
                'required' => true,
            ),
            array(
                'name' => '名前（漢字）',
                'id'   => 'name_jp',
                'type' => 'text',
                'desc' => '例: 田村 江梨佳',
                'required' => true,
            ),
            array(
                'name' => '名前（英語）',
                'id'   => 'name_en',
                'type' => 'text',
                'desc' => '例: Erika Tamura',
            ),
            array(
                'name' => 'キャッチコピー（HTML可）',
                'id'   => 'tagline_html',
                'type' => 'textarea',
                'desc' => '<span class="blue">で強調できる',
                'rows' => 3,
            ),
            array(
                'name' => 'プロフィール写真',
                'id'   => 'photo',
                'type' => 'single_image',
                'desc' => '4:5 縦長推奨',
            ),
        ),
    );

    // 2. プロフィール
    $meta_boxes[] = array(
        'title'      => '01. プロフィール（Profile）',
        'id'         => 'teacher_profile',
        'post_types' => array( 'teacher' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'name' => '卒業大学',
                'id'   => 'alma_mater',
                'type' => 'text',
                'desc' => '例: 学習院大学 経済学部',
            ),
            array(
                'name' => '入試方式',
                'id'   => 'admission_method',
                'type' => 'text',
                'desc' => '例: 指定校推薦',
            ),
            array(
                'name' => '出身地',
                'id'   => 'hometown',
                'type' => 'text',
                'desc' => '例: 東京都',
            ),
            array(
                'name' => '専門領域',
                'id'   => 'expertise',
                'type' => 'text',
                'clone'  => true,
                'sort_clone' => true,
                'add_button' => '+ 専門領域を追加',
                'desc' => 'タグ形式で複数追加可能',
            ),
            array(
                'name' => '担当科目',
                'id'   => 'subjects',
                'type' => 'text',
                'clone'  => true,
                'sort_clone' => true,
                'add_button' => '+ 担当科目を追加',
                'desc' => 'タグ形式で複数追加可能',
            ),
            array(
                'name' => 'プロフィール本文（HTML可）',
                'id'   => 'bio_html',
                'type' => 'wysiwyg',
                'desc' => '人となりが伝わる経歴ストーリー',
                'options' => array( 'textarea_rows' => 8 ),
            ),
        ),
    );

    // 3. 経歴タイムライン
    $meta_boxes[] = array(
        'title'      => '02. 経歴・キャリア（Background）',
        'id'         => 'teacher_background',
        'post_types' => array( 'teacher' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'id'     => 'background',
                'type'   => 'group',
                'clone'  => true,
                'sort_clone' => true,
                'add_button' => '+ 経歴項目を追加',
                'collapsible' => true,
                'group_title' => array( 'field' => 'bg_title', 'prefix' => '📅 ' ),
                'fields' => array(
                    array(
                        'name' => '年',
                        'id'   => 'bg_year',
                        'type' => 'text',
                        'desc' => '例: 2014, 2014–2018, 現在',
                    ),
                    array(
                        'name' => 'タイトル',
                        'id'   => 'bg_title',
                        'type' => 'text',
                    ),
                    array(
                        'name' => '詳細',
                        'id'   => 'bg_desc',
                        'type' => 'textarea',
                        'rows' => 3,
                    ),
                ),
            ),
        ),
    );

    // 4. 指導理念
    $meta_boxes[] = array(
        'title'      => '03. 指導理念（Philosophy）',
        'id'         => 'teacher_philosophy',
        'post_types' => array( 'teacher' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'name' => '指導理念 本文（HTML可）',
                'id'   => 'philosophy_html',
                'type' => 'wysiwyg',
                'desc' => '<h3>で小見出し、<strong>で強調',
                'options' => array( 'textarea_rows' => 10 ),
            ),
            array(
                'name' => 'キーフレーズ（引用カード用）',
                'id'   => 'philosophy_quote',
                'type' => 'textarea',
                'desc' => '<span class="blue">で青強調可能',
                'rows' => 2,
            ),
        ),
    );

    // 5. 講師実績
    $meta_boxes[] = array(
        'title'      => '04. 講師実績（Achievements）',
        'id'         => 'teacher_achievements',
        'post_types' => array( 'teacher' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'id'     => 'achievements',
                'type'   => 'group',
                'clone'  => true,
                'sort_clone' => true,
                'add_button' => '+ 実績数値を追加',
                'collapsible' => true,
                'group_title' => array( 'field' => 'ach_label', 'prefix' => '📊 ' ),
                'fields' => array(
                    array(
                        'name' => '数値',
                        'id'   => 'ach_num',
                        'type' => 'text',
                        'desc' => '例: 150+, 92%, 30+',
                    ),
                    array(
                        'name' => 'ラベル',
                        'id'   => 'ach_label',
                        'type' => 'text',
                        'desc' => '例: 累計指導生徒数',
                    ),
                    array(
                        'name' => 'サブラベル',
                        'id'   => 'ach_sub',
                        'type' => 'text',
                        'desc' => '例: Total Students',
                    ),
                ),
            ),
            array(
                'name' => '主な合格実績校',
                'id'   => 'achievements_extra',
                'type' => 'text',
                'clone'  => true,
                'sort_clone' => true,
                'add_button' => '+ 合格大学を追加',
                'desc' => '大学名をタグ形式で追加',
            ),
        ),
    );

    // 6. 生徒の声
    $meta_boxes[] = array(
        'title'      => '05. 生徒からの声（Voices）',
        'id'         => 'teacher_voices',
        'post_types' => array( 'teacher' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'id'     => 'voices',
                'type'   => 'group',
                'clone'  => true,
                'sort_clone' => true,
                'add_button' => '+ 生徒の声を追加',
                'collapsible' => true,
                'group_title' => array( 'field' => 'voice_name', 'prefix' => '💬 ' ),
                'fields' => array(
                    array(
                        'name' => 'コメント',
                        'id'   => 'voice_quote',
                        'type' => 'textarea',
                        'rows' => 4,
                    ),
                    array(
                        'name' => '生徒名',
                        'id'   => 'voice_name',
                        'type' => 'text',
                    ),
                    array(
                        'name' => '進学先',
                        'id'   => 'voice_uni',
                        'type' => 'text',
                    ),
                ),
            ),
        ),
    );

    // 7. 5つの質問
    $meta_boxes[] = array(
        'title'      => '06. 5つの質問（5 Questions）',
        'id'         => 'teacher_qa',
        'post_types' => array( 'teacher' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'id'     => 'qa',
                'type'   => 'group',
                'clone'  => true,
                'sort_clone' => true,
                'add_button' => '+ 質問を追加',
                'collapsible' => true,
                'group_title' => array( 'field' => 'qa_question', 'prefix' => 'Q. ' ),
                'fields' => array(
                    array(
                        'name' => '質問',
                        'id'   => 'qa_question',
                        'type' => 'text',
                    ),
                    array(
                        'name' => '回答',
                        'id'   => 'qa_answer',
                        'type' => 'textarea',
                        'rows' => 4,
                    ),
                ),
            ),
        ),
    );

    // 8. メッセージ
    $meta_boxes[] = array(
        'title'      => '07. 受験生へのメッセージ（Message）',
        'id'         => 'teacher_message',
        'post_types' => array( 'teacher' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'name' => 'メッセージ本文（HTML可）',
                'id'   => 'message_html',
                'type' => 'wysiwyg',
                'options' => array( 'textarea_rows' => 6 ),
            ),
        ),
    );

    // 9. ナビ順
    $meta_boxes[] = array(
        'title'      => 'ナビゲーション順序',
        'id'         => 'teacher_nav',
        'post_types' => array( 'teacher' ),
        'context'    => 'side',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'name' => '並び順（数値）',
                'id'   => 'sort_order',
                'type' => 'number',
                'min'  => 0,
            ),
        ),
    );

    return $meta_boxes;
}
