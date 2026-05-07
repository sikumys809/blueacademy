<?php
/**
 * Meta Box Fields: Story (合格者体験記)
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_filter( 'rwmb_meta_boxes', 'blueacademy_register_story_fields' );
function blueacademy_register_story_fields( $meta_boxes ) {

    // 1. ヒーロー & 基本情報
    $meta_boxes[] = array(
        'title'      => '基本情報・ヒーロー',
        'id'         => 'story_hero',
        'post_types' => array( 'story' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields'     => array(
            array(
                'name' => 'File番号',
                'id'   => 'file_num',
                'type' => 'text',
                'desc' => '例: 01, 02, 11（2桁ゼロ埋め）',
                'size' => 10,
                'required' => true,
            ),
            array(
                'name' => '名前（漢字）',
                'id'   => 'name_jp',
                'type' => 'text',
                'desc' => '例: 鈴木 蒼葉',
                'required' => true,
            ),
            array(
                'name' => '名前（英語）',
                'id'   => 'name_en',
                'type' => 'text',
                'desc' => '例: Aoba Suzuki',
            ),
            array(
                'name' => '進学先大学',
                'id'   => 'university',
                'type' => 'text',
                'desc' => '例: 明治大学 総合数理学部 先端メディアサイエンス学科',
                'required' => true,
            ),
            array(
                'name' => 'キャッチコピー（HTML可）',
                'id'   => 'tagline_html',
                'type' => 'textarea',
                'desc' => 'HTMLタグ使用可。<span class="blue">明治大学に。</span>のようにキーワードを青く強調できる',
                'rows' => 3,
            ),
            array(
                'name' => 'プロフィール写真',
                'id'   => 'photo',
                'type' => 'single_image',
                'desc' => '4:5 縦長推奨（例: 800x1000px）',
                'force_delete' => false,
            ),
        ),
    );

    // 2. WHO セクション
    $meta_boxes[] = array(
        'title'      => '01. プロフィール（Who）',
        'id'         => 'story_who',
        'post_types' => array( 'story' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'name' => '出身地',
                'id'   => 'from_place',
                'type' => 'text',
                'desc' => '例: 東京都江戸川区',
            ),
            array(
                'name' => '出身高校',
                'id'   => 'school',
                'type' => 'text',
                'desc' => '例: 品川女子学院高等部（中高一貫）',
            ),
            array(
                'name' => '入塾時期',
                'id'   => 'since',
                'type' => 'text',
                'desc' => '例: 高校3年生8月より通塾',
            ),
            array(
                'name' => 'GPA（評定平均）',
                'id'   => 'gpa',
                'type' => 'text',
                'desc' => '例: 3.4',
                'size' => 10,
            ),
            array(
                'name' => '英語スコア',
                'id'   => 'english',
                'type' => 'text',
                'desc' => '例: 2級, 準1級, TOEIC 800',
            ),
            array(
                'name' => '結果',
                'id'   => 'result',
                'type' => 'text',
                'desc' => '例: 現役合格',
            ),
            array(
                'name' => 'プロフィール本文（HTML可）',
                'id'   => 'bio_html',
                'type' => 'wysiwyg',
                'desc' => 'リッチエディタ。<strong>タグなどHTMLが使える',
                'options' => array( 'textarea_rows' => 8 ),
            ),
        ),
    );

    // 3. My Success Story 3部構成
    $meta_boxes[] = array(
        'title'      => '02. My Success Story（受験の軌跡）',
        'id'         => 'story_my_success',
        'post_types' => array( 'story' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'name' => '【01 Looking Back】タイトル',
                'id'   => 'story_01_title',
                'type' => 'text',
                'desc' => '例: 総合型選抜での受験を振り返って。今、思うこと',
            ),
            array(
                'name' => '【01 Looking Back】本文（HTML可）',
                'id'   => 'story_01_html',
                'type' => 'wysiwyg',
                'desc' => '<h3>でサブ見出し、<strong>で強調',
                'options' => array( 'textarea_rows' => 12 ),
            ),
            array(
                'name' => '【02 Lessons Learned】タイトル',
                'id'   => 'story_02_title',
                'type' => 'text',
                'desc' => '例: 受験を終えてみて改めて大切だった点',
            ),
            array(
                'name' => '【02 Lessons Learned】本文（HTML可）',
                'id'   => 'story_02_html',
                'type' => 'wysiwyg',
                'options' => array( 'textarea_rows' => 12 ),
            ),
            array(
                'name' => '【03 Future Vision】タイトル',
                'id'   => 'story_03_title',
                'type' => 'text',
                'desc' => '例: これからのさらなる活躍に向けて',
            ),
            array(
                'name' => '【03 Future Vision】本文（HTML可）',
                'id'   => 'story_03_html',
                'type' => 'wysiwyg',
                'options' => array( 'textarea_rows' => 12 ),
            ),
        ),
    );

    // 4. Video
    $meta_boxes[] = array(
        'title'      => '03. 動画（Video）',
        'id'         => 'story_video',
        'post_types' => array( 'story' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'name' => 'YouTube動画ID',
                'id'   => 'youtube_id',
                'type' => 'text',
                'desc' => '例: zGyTytx5RG8（URLの v= 以降の文字列）',
            ),
        ),
    );

    // 5. Other Acceptances
    $meta_boxes[] = array(
        'title'      => '04. その他の合格校（Other Acceptances）',
        'id'         => 'story_extras',
        'post_types' => array( 'story' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'id'     => 'extras',
                'type'   => 'group',
                'clone'  => true,
                'sort_clone' => true,
                'add_button' => '+ 合格校を追加',
                'collapsible' => true,
                'group_title' => array( 'field' => 'extra_name', 'prefix' => '🎓 ' ),
                'fields' => array(
                    array(
                        'name' => '番号',
                        'id'   => 'extra_num',
                        'type' => 'text',
                        'desc' => '例: 01, 02',
                        'size' => 10,
                    ),
                    array(
                        'name' => '大学名',
                        'id'   => 'extra_name',
                        'type' => 'text',
                        'desc' => '例: 東京都市大学 情報工学部 知能情報工学科',
                    ),
                    array(
                        'name' => '入試方式',
                        'id'   => 'extra_method',
                        'type' => 'text',
                        'desc' => '例: 1段階選抜創作ソフトウェア入試',
                    ),
                ),
            ),
        ),
    );

    // 6. 10つの質問
    $meta_boxes[] = array(
        'title'      => '05. 10つの質問（10 Questions）',
        'id'         => 'story_qa',
        'post_types' => array( 'story' ),
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
                        'name' => '番号',
                        'id'   => 'qa_num',
                        'type' => 'text',
                        'desc' => '例: 01, 02',
                        'size' => 10,
                    ),
                    array(
                        'name' => '質問',
                        'id'   => 'qa_question',
                        'type' => 'text',
                    ),
                    array(
                        'name' => '回答',
                        'id'   => 'qa_answer',
                        'type' => 'textarea',
                        'rows' => 3,
                    ),
                ),
            ),
        ),
    );

    // 7. 課外活動
    $meta_boxes[] = array(
        'title'      => '06. 課外活動ハイライト（Activities）',
        'id'         => 'story_activities',
        'post_types' => array( 'story' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'name' => 'レイアウト',
                'id'   => 'activities_layout',
                'type' => 'select',
                'desc' => '課外活動の表示レイアウト',
                'options' => array(
                    ''       => '3カラム（標準・3件以上）',
                    'cols-2' => '2カラム（2件のとき）',
                    'cols-1' => '1カラム（1件のみ・活動なし）',
                ),
            ),
            array(
                'id'     => 'activities',
                'type'   => 'group',
                'clone'  => true,
                'sort_clone' => true,
                'add_button' => '+ 課外活動を追加',
                'collapsible' => true,
                'group_title' => array( 'field' => 'activity_title', 'prefix' => '🏆 ' ),
                'fields' => array(
                    array(
                        'name' => '番号',
                        'id'   => 'activity_num',
                        'type' => 'text',
                        'desc' => '例: 01',
                        'size' => 10,
                    ),
                    array(
                        'name' => 'タイトル',
                        'id'   => 'activity_title',
                        'type' => 'text',
                    ),
                    array(
                        'name' => '説明',
                        'id'   => 'activity_desc',
                        'type' => 'textarea',
                        'rows' => 4,
                    ),
                    array(
                        'name' => '受賞・実績',
                        'id'   => 'activity_awards',
                        'type' => 'textarea',
                        'rows' => 2,
                    ),
                ),
            ),
        ),
    );

    // 8. アドバイス
    $meta_boxes[] = array(
        'title'      => '07. 後輩へのアドバイス（Advice）',
        'id'         => 'story_advice',
        'post_types' => array( 'story' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'id'     => 'advice',
                'type'   => 'group',
                'clone'  => true,
                'sort_clone' => true,
                'add_button' => '+ アドバイスを追加',
                'collapsible' => true,
                'group_title' => array( 'field' => 'advice_question', 'prefix' => 'Q. ' ),
                'fields' => array(
                    array(
                        'name' => '質問',
                        'id'   => 'advice_question',
                        'type' => 'text',
                    ),
                    array(
                        'name' => '回答',
                        'id'   => 'advice_answer',
                        'type' => 'textarea',
                        'rows' => 4,
                    ),
                ),
            ),
        ),
    );

    // 9. PDF
    $meta_boxes[] = array(
        'title'      => 'PDF（FlipHTML5 URL）',
        'id'         => 'story_pdf',
        'post_types' => array( 'story' ),
        'context'    => 'normal',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'name' => 'PDF URL（FlipHTML5）',
                'id'   => 'pdf_url',
                'type' => 'url',
                'desc' => '例: https://online.fliphtml5.com/ringi/zvqd/',
            ),
        ),
    );

    // 10. ナビ順
    $meta_boxes[] = array(
        'title'      => 'ナビゲーション順序',
        'id'         => 'story_nav',
        'post_types' => array( 'story' ),
        'context'    => 'side',
        'priority'   => 'default',
        'fields'     => array(
            array(
                'name' => '並び順（数値）',
                'id'   => 'sort_order',
                'type' => 'number',
                'desc' => '小さい順に表示。File番号と一致させると分かりやすい',
                'min'  => 0,
            ),
        ),
    );

    return $meta_boxes;
}
