<?php
/**
 * Single Story Template — 合格者体験記の個別ページ
 *
 * @package Blueacademy
 */

get_header();

// ============================================================
// Meta Box フィールドからデータ取得
// ============================================================
$post_id        = get_the_ID();
$file_num       = blueacademy_get_meta( 'file_num' );
$name_jp        = blueacademy_get_meta( 'name_jp' );
$name_en        = blueacademy_get_meta( 'name_en' );
$university     = blueacademy_get_meta( 'university' );
$tagline_html   = blueacademy_get_meta( 'tagline_html' );
$photo_url      = blueacademy_get_image_url( 'photo', 'large' );

// プロフィール
$from_place     = blueacademy_get_meta( 'from_place' );
$school         = blueacademy_get_meta( 'school' );
$since          = blueacademy_get_meta( 'since' );
$gpa            = blueacademy_get_meta( 'gpa' );
$english        = blueacademy_get_meta( 'english' );
$result         = blueacademy_get_meta( 'result' );
$bio_html       = blueacademy_get_meta( 'bio_html' );

// 3部構成ストーリー
$story_01_title = blueacademy_get_meta( 'story_01_title' );
$story_01_html  = blueacademy_get_meta( 'story_01_html' );
$story_02_title = blueacademy_get_meta( 'story_02_title' );
$story_02_html  = blueacademy_get_meta( 'story_02_html' );
$story_03_title = blueacademy_get_meta( 'story_03_title' );
$story_03_html  = blueacademy_get_meta( 'story_03_html' );

// 動画
$youtube_id     = blueacademy_get_meta( 'youtube_id' );

// その他の合格校
$extras         = blueacademy_get_meta( 'extras' );
$extras         = is_array( $extras ) ? $extras : array();

// 10つの質問
$qa_items       = blueacademy_get_meta( 'qa' );
$qa_items       = is_array( $qa_items ) ? $qa_items : array();

// 課外活動
$activities_layout = blueacademy_get_meta( 'activities_layout' );
$activities     = blueacademy_get_meta( 'activities' );
$activities     = is_array( $activities ) ? $activities : array();

// アドバイス
$advice_items   = blueacademy_get_meta( 'advice' );
$advice_items   = is_array( $advice_items ) ? $advice_items : array();

// PDF
$pdf_url        = blueacademy_get_meta( 'pdf_url' );

// 前後の投稿（sort_order基準）
$adjacent       = blueacademy_get_adjacent_posts( 'story', $post_id );

// パンくず
blueacademy_breadcrumb( array(
    array( 'label' => 'Stories', 'url' => home_url( '/stories/' ) ),
    array( 'label' => sprintf( 'File %s ／ %s', $file_num, $name_jp ), 'url' => null ),
) );
?>

<?php while ( have_posts() ) : the_post(); ?>

<!-- ============ HERO ============ -->
<section class="story-hero">
    <div class="container">
        <div class="story-hero-grid">
            <div>
                <div class="story-hero-meta">
                    <?php echo esc_html( sprintf( 'File %s ／ Success Stories', $file_num ) ); ?>
                </div>
                <?php if ( $university ) : ?>
                    <div class="story-hero-uni"><?php echo esc_html( $university ); ?></div>
                <?php endif; ?>
                <h1 class="story-hero-name"><?php echo esc_html( $name_jp ); ?></h1>
                <?php if ( $name_en ) : ?>
                    <div class="story-hero-name-en"><?php echo esc_html( $name_en ); ?></div>
                <?php endif; ?>
                <?php if ( $tagline_html ) : ?>
                    <h2 class="story-hero-tagline"><?php echo wp_kses_post( html_entity_decode( html_entity_decode( $tagline_html, ENT_QUOTES | ENT_HTML5, 'UTF-8' ), ENT_QUOTES | ENT_HTML5, 'UTF-8' ) ); ?></h2>
                <?php endif; ?>
            </div>
            <?php if ( $photo_url ) : ?>
                <div class="story-hero-photo">
                    <img src="<?php echo esc_url( $photo_url ); ?>" alt="<?php echo esc_attr( $name_jp ); ?>さん">
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ============ 01 WHO ============ -->
<?php if ( $bio_html || $from_place || $school ) : ?>
<section class="story-section">
    <div class="container">
        <div class="section-num-head">
            <div class="section-num">01 ／ Who</div>
            <h2 class="section-h2">プロフィール<span class="blue">.</span></h2>
        </div>
        <div class="who-grid">
            <dl class="who-spec-block">
                <?php if ( $from_place ) : ?>
                    <div class="who-spec-row"><dt>From</dt><dd><?php echo esc_html( $from_place ); ?></dd></div>
                <?php endif; ?>
                <?php if ( $school ) : ?>
                    <div class="who-spec-row"><dt>School</dt><dd><?php echo esc_html( $school ); ?></dd></div>
                <?php endif; ?>
                <?php if ( $since ) : ?>
                    <div class="who-spec-row"><dt>Since</dt><dd><?php echo esc_html( $since ); ?></dd></div>
                <?php endif; ?>
                <?php if ( $gpa ) : ?>
                    <div class="who-spec-row"><dt>GPA</dt><dd>評定平均 <?php echo esc_html( $gpa ); ?></dd></div>
                <?php endif; ?>
                <?php if ( $english ) : ?>
                    <div class="who-spec-row"><dt>English</dt><dd><?php echo esc_html( $english ); ?></dd></div>
                <?php endif; ?>
                <?php if ( $result ) : ?>
                    <div class="who-spec-row"><dt>Result</dt><dd><?php echo esc_html( $result ); ?></dd></div>
                <?php endif; ?>
            </dl>
            <?php if ( $bio_html ) : ?>
                <div class="who-bio">
                    <?php echo wp_kses_post( $bio_html ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============ 02 My Success Story ============ -->
<?php if ( $story_01_html || $story_02_html || $story_03_html ) : ?>
<section class="story-section">
    <div class="container">
        <div class="section-num-head">
            <div class="section-num">02 ／ My Success Story</div>
            <h2 class="section-h2">受験の<span class="blue">軌跡。</span></h2>
        </div>
        <div class="story-three">
            <?php if ( $story_01_html ) : ?>
                <div class="story-part">
                    <div class="story-part-num-block">
                        <div class="story-part-num">01</div>
                        <div class="story-part-label">Looking Back</div>
                        <?php if ( $story_01_title ) : ?>
                            <h3 class="story-part-title"><?php echo esc_html( $story_01_title ); ?></h3>
                        <?php endif; ?>
                    </div>
                    <div class="story-part-content">
                        <?php echo wp_kses_post( $story_01_html ); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $story_02_html ) : ?>
                <div class="story-part">
                    <div class="story-part-num-block">
                        <div class="story-part-num">02</div>
                        <div class="story-part-label">Lessons Learned</div>
                        <?php if ( $story_02_title ) : ?>
                            <h3 class="story-part-title"><?php echo esc_html( $story_02_title ); ?></h3>
                        <?php endif; ?>
                    </div>
                    <div class="story-part-content">
                        <?php echo wp_kses_post( $story_02_html ); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ( $story_03_html ) : ?>
                <div class="story-part">
                    <div class="story-part-num-block">
                        <div class="story-part-num">03</div>
                        <div class="story-part-label">Future Vision</div>
                        <?php if ( $story_03_title ) : ?>
                            <h3 class="story-part-title"><?php echo esc_html( $story_03_title ); ?></h3>
                        <?php endif; ?>
                    </div>
                    <div class="story-part-content">
                        <?php echo wp_kses_post( $story_03_html ); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============ 03 Video ============ -->
<?php if ( $youtube_id ) : ?>
<section class="video-section">
    <div class="container">
        <div class="section-num-head">
            <div class="section-num">03 ／ Video</div>
            <h2 class="section-h2"><?php echo esc_html( $name_jp ); ?>さんの<span class="blue">物語を観る。</span></h2>
        </div>
        <div class="video-frame-wrap">
            <iframe
                src="<?php echo esc_url( blueacademy_youtube_embed_url( $youtube_id ) ); ?>"
                title="<?php echo esc_attr( $name_jp ); ?>さんの合格体験記"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen></iframe>
        </div>
        <p class="video-caption">Blue Academy Success Stories ／ FILE <?php echo esc_html( $file_num ); ?></p>
    </div>
</section>
<?php endif; ?>

<!-- ============ 04 Other Acceptances ============ -->
<section class="extras-section">
    <div class="container">
        <div class="section-num-head">
            <div class="section-num">04 ／ Other Acceptances</div>
            <h2 class="section-h2">その他の<span class="blue">合格校。</span></h2>
        </div>
        <?php if ( ! empty( $extras ) ) : ?>
            <div class="extras-list">
                <?php foreach ( $extras as $extra ) : ?>
                    <div class="extras-row">
                        <div class="extras-num"><?php echo esc_html( $extra['extra_num'] ?? '' ); ?></div>
                        <div class="extras-name"><?php echo esc_html( $extra['extra_name'] ?? '' ); ?></div>
                        <div class="extras-method"><?php echo esc_html( $extra['extra_method'] ?? '' ); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="extras-empty">他の合格校情報はありません。</div>
        <?php endif; ?>
    </div>
</section>

<!-- ============ 05 10 Questions ============ -->
<?php if ( ! empty( $qa_items ) ) : ?>
<section class="qa-section">
    <div class="container">
        <div class="section-num-head">
            <div class="section-num">05 ／ 10 Questions</div>
            <h2 class="section-h2"><?php echo esc_html( $name_jp ); ?>さんに聞く<br><span class="blue">10つの質問。</span></h2>
        </div>
        <div class="qa-grid">
            <?php foreach ( $qa_items as $qa ) : ?>
                <div class="qa-card">
                    <div class="qa-num">Q<?php echo esc_html( $qa['qa_num'] ?? '' ); ?></div>
                    <div class="qa-q"><?php echo esc_html( $qa['qa_question'] ?? '' ); ?></div>
                    <div class="qa-a"><?php echo nl2br( esc_html( $qa['qa_answer'] ?? '' ) ); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============ 06 Activities ============ -->
<?php if ( ! empty( $activities ) ) : ?>
<section class="activities-section">
    <div class="container">
        <div class="section-num-head">
            <div class="section-num">06 ／ Activities</div>
            <h2 class="section-h2">課外活動<span class="blue">ハイライト。</span></h2>
        </div>
        <div class="activities-grid <?php echo esc_attr( $activities_layout ); ?>">
            <?php foreach ( $activities as $act ) : ?>
                <article class="activity-card">
                    <?php if ( ! empty( $act['activity_num'] ) ) : ?>
                        <div class="activity-num">Activity <?php echo esc_html( $act['activity_num'] ); ?></div>
                    <?php endif; ?>
                    <h3 class="activity-title"><?php echo esc_html( $act['activity_title'] ?? '' ); ?></h3>
                    <?php if ( ! empty( $act['activity_desc'] ) ) : ?>
                        <p class="activity-desc"><?php echo nl2br( esc_html( $act['activity_desc'] ) ); ?></p>
                    <?php endif; ?>
                    <?php if ( ! empty( $act['activity_awards'] ) ) : ?>
                        <div class="activity-awards"><strong>受賞・実績</strong><?php echo nl2br( esc_html( $act['activity_awards'] ) ); ?></div>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============ 07 Advice ============ -->
<?php if ( ! empty( $advice_items ) ) : ?>
<section class="advice-section">
    <div class="container">
        <div class="section-num-head">
            <div class="section-num">07 ／ Advice</div>
            <h2 class="section-h2">これから総合型に<br>取り組む<span class="blue">あなたへ。</span></h2>
        </div>
        <div class="advice-list">
            <?php foreach ( $advice_items as $advice ) : ?>
                <div class="advice-item">
                    <div class="advice-q"><?php echo esc_html( $advice['advice_question'] ?? '' ); ?></div>
                    <div class="advice-a"><?php echo nl2br( esc_html( $advice['advice_answer'] ?? '' ) ); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============ PDF CTA ============ -->
<?php if ( $pdf_url ) : ?>
<section class="pdf-cta-section">
    <div class="container">
        <div class="pdf-cta-grid">
            <div>
                <div class="pdf-cta-eyebrow">／ Full Document</div>
                <h2 class="pdf-cta-title">全14ページの<br><span class="blue">合格体験記を読む。</span></h2>
                <p class="pdf-cta-text">
                    <?php echo esc_html( $name_jp ); ?>さんの実際の志望理由書、課外活動の詳細、受験スケジュールまで。<br>
                    Blue Academy Real Success Stories ／ FILE <?php echo esc_html( $file_num ); ?> ／ 全14ページのフルドキュメントを、ページめくり形式でお読みいただけます。
                </p>
                <button class="pdf-cta-button" data-pdf-url="<?php echo esc_url( $pdf_url ); ?>">PDFで全文を読む</button>
            </div>
            <div class="pdf-cta-preview">
                <div class="pdf-cta-preview-mark">Blue Academy</div>
                <div>
                    <div class="pdf-cta-preview-num">FILE <?php echo esc_html( $file_num ); ?></div>
                    <div class="pdf-cta-preview-title"><?php echo esc_html( $name_jp ); ?><br><?php echo esc_html( $name_en ); ?></div>
                </div>
                <div class="pdf-cta-preview-pages">14 Pages ／ Click to Open →</div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============ Story Navigation ============ -->
<nav class="story-nav">
    <div class="container">
        <div class="story-nav-grid">
            <?php if ( $adjacent['prev'] ) :
                $prev_num  = get_post_meta( $adjacent['prev']->ID, 'file_num', true );
                $prev_name = get_post_meta( $adjacent['prev']->ID, 'name_jp', true );
            ?>
                <a href="<?php echo esc_url( get_permalink( $adjacent['prev'] ) ); ?>" class="story-nav-link prev">
                    <span class="story-nav-meta">File <?php echo esc_html( $prev_num ); ?> ／ Prev</span>
                    <span class="story-nav-name"><?php echo esc_html( $prev_name ); ?>さん</span>
                </a>
            <?php else : ?>
                <div></div>
            <?php endif; ?>

            <a href="<?php echo esc_url( home_url( '/stories/' ) ); ?>" class="story-nav-back">All Stories</a>

            <?php if ( $adjacent['next'] ) :
                $next_num  = get_post_meta( $adjacent['next']->ID, 'file_num', true );
                $next_name = get_post_meta( $adjacent['next']->ID, 'name_jp', true );
            ?>
                <a href="<?php echo esc_url( get_permalink( $adjacent['next'] ) ); ?>" class="story-nav-link next">
                    <span class="story-nav-meta">File <?php echo esc_html( $next_num ); ?> ／ Next</span>
                    <span class="story-nav-name"><?php echo esc_html( $next_name ); ?>さん</span>
                </a>
            <?php else : ?>
                <div></div>
            <?php endif; ?>
        </div>
    </div>
</nav>

<?php endwhile; ?>

<!-- ============ CTA Strip ============ -->
<?php blueacademy_cta_strip(
    'あなたの物語も、<br>ここに加えませんか。'
); ?>

<?php get_footer();
