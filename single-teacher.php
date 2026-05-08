<?php
/**
 * Single Teacher Template — 講師の個別ページ
 *
 * @package Blueacademy
 */

get_header();

// ============================================================
// Meta Box フィールドからデータ取得
// ============================================================
$post_id            = get_the_ID();

// ヒーロー
$position           = blueacademy_get_meta( 'position' );
$name_jp            = blueacademy_get_meta( 'name_jp' );
$name_en            = blueacademy_get_meta( 'name_en' );
$tagline_html       = blueacademy_get_meta( 'tagline_html' );
$photo_url          = blueacademy_get_image_url( 'photo', 'large' );

// プロフィール
$alma_mater         = blueacademy_get_meta( 'alma_mater' );
$admission_method   = blueacademy_get_meta( 'admission_method' );
$hometown           = blueacademy_get_meta( 'hometown' );
$expertise          = blueacademy_get_meta( 'expertise' );
$expertise          = is_array( $expertise ) ? $expertise : array();
$subjects           = blueacademy_get_meta( 'subjects' );
$subjects           = is_array( $subjects ) ? $subjects : array();
$bio_html           = blueacademy_get_meta( 'bio_html' );

// 経歴タイムライン
$background_items   = blueacademy_get_meta( 'background' );
$background_items   = is_array( $background_items ) ? $background_items : array();

// 指導理念
$philosophy_html    = blueacademy_get_meta( 'philosophy_html' );
$philosophy_quote   = blueacademy_get_meta( 'philosophy_quote' );

// 実績
$achievements       = blueacademy_get_meta( 'achievements' );
$achievements       = is_array( $achievements ) ? $achievements : array();
$achievements_extra = blueacademy_get_meta( 'achievements_extra' );
$achievements_extra = is_array( $achievements_extra ) ? $achievements_extra : array();

// 生徒の声
$voices             = blueacademy_get_meta( 'voices' );
$voices             = is_array( $voices ) ? $voices : array();

// 5つの質問
$qa_items           = blueacademy_get_meta( 'qa' );
$qa_items           = is_array( $qa_items ) ? $qa_items : array();

// メッセージ
$message_html       = blueacademy_get_meta( 'message_html' );

// 前後の投稿
$adjacent           = blueacademy_get_adjacent_posts( 'teacher', $post_id );

// パンくず
blueacademy_breadcrumb( array(
    array( 'label' => 'Teachers', 'url' => home_url( '/teachers/' ) ),
    array( 'label' => $name_jp, 'url' => null ),
) );
?>

<?php while ( have_posts() ) : the_post(); ?>

<!-- ============ HERO ============ -->
<section class="teacher-hero">
    <div class="container">
        <div class="teacher-hero-grid">
            <div>
                <div class="teacher-hero-meta">Blue Academy ／ Instructors</div>
                <?php if ( $position ) : ?>
                    <div class="teacher-hero-position"><?php echo esc_html( $position ); ?></div>
                <?php endif; ?>
                <h1 class="teacher-hero-name"><?php echo esc_html( $name_jp ); ?></h1>
                <?php if ( $name_en ) : ?>
                    <div class="teacher-hero-name-en"><?php echo esc_html( $name_en ); ?></div>
                <?php endif; ?>
                <?php if ( $tagline_html ) : ?>
                    <h2 class="teacher-hero-tagline"><?php echo wp_kses_post( html_entity_decode( html_entity_decode( $tagline_html, ENT_QUOTES | ENT_HTML5, 'UTF-8' ), ENT_QUOTES | ENT_HTML5, 'UTF-8' ) ); ?></h2>
                <?php endif; ?>
            </div>
            <?php if ( $photo_url ) : ?>
                <div class="teacher-hero-photo">
                    <img src="<?php echo esc_url( $photo_url ); ?>" alt="<?php echo esc_attr( $name_jp ); ?>">
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ============ 01 Profile ============ -->
<?php if ( $bio_html || $alma_mater || ! empty( $expertise ) ) : ?>
<section class="teacher-section">
    <div class="container">
        <div class="section-num-head">
            <div class="section-num">01 ／ Profile</div>
            <h2 class="section-h2">プロフィール<span class="blue">.</span></h2>
        </div>
        <div class="profile-grid">
            <dl class="profile-spec-block">
                <?php if ( $alma_mater ) : ?>
                    <div class="profile-spec-row"><dt>Alma Mater</dt><dd><?php echo esc_html( $alma_mater ); ?></dd></div>
                <?php endif; ?>
                <?php if ( $admission_method ) : ?>
                    <div class="profile-spec-row"><dt>Method</dt><dd><?php echo esc_html( $admission_method ); ?></dd></div>
                <?php endif; ?>
                <?php if ( $hometown ) : ?>
                    <div class="profile-spec-row"><dt>From</dt><dd><?php echo esc_html( $hometown ); ?></dd></div>
                <?php endif; ?>
                <?php if ( ! empty( $expertise ) ) : ?>
                    <div class="profile-spec-row">
                        <dt>Expertise</dt>
                        <dd>
                            <div class="profile-spec-tags">
                                <?php foreach ( $expertise as $tag ) : ?>
                                    <?php if ( ! empty( $tag ) ) : ?>
                                        <span class="profile-spec-tag"><?php echo esc_html( $tag ); ?></span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </dd>
                    </div>
                <?php endif; ?>
                <?php if ( ! empty( $subjects ) ) : ?>
                    <div class="profile-spec-row">
                        <dt>Subjects</dt>
                        <dd>
                            <div class="profile-spec-tags">
                                <?php foreach ( $subjects as $tag ) : ?>
                                    <?php if ( ! empty( $tag ) ) : ?>
                                        <span class="profile-spec-tag"><?php echo esc_html( $tag ); ?></span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </dd>
                    </div>
                <?php endif; ?>
            </dl>
            <?php if ( $bio_html ) : ?>
                <div class="profile-bio">
                    <?php echo wp_kses_post( $bio_html ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============ 02 Background ============ -->
<?php if ( ! empty( $background_items ) ) : ?>
<section class="teacher-section">
    <div class="container">
        <div class="section-num-head">
            <div class="section-num">02 ／ Background</div>
            <h2 class="section-h2">経歴・<span class="blue">キャリア。</span></h2>
        </div>
        <div class="background-timeline">
            <?php foreach ( $background_items as $bg ) : ?>
                <div class="background-item">
                    <?php if ( ! empty( $bg['bg_year'] ) ) : ?>
                        <div class="background-year"><?php echo esc_html( $bg['bg_year'] ); ?></div>
                    <?php endif; ?>
                    <?php if ( ! empty( $bg['bg_title'] ) ) : ?>
                        <h3 class="background-title"><?php echo esc_html( $bg['bg_title'] ); ?></h3>
                    <?php endif; ?>
                    <?php if ( ! empty( $bg['bg_desc'] ) ) : ?>
                        <p class="background-desc"><?php echo nl2br( esc_html( $bg['bg_desc'] ) ); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============ 03 Philosophy ============ -->
<?php if ( $philosophy_html || $philosophy_quote ) : ?>
<section class="teacher-section philosophy-section">
    <div class="container">
        <div class="section-num-head">
            <div class="section-num">03 ／ Philosophy</div>
            <h2 class="section-h2">指導<span class="blue">理念。</span></h2>
        </div>
        <div class="philosophy-content">
            <?php if ( $philosophy_html ) : ?>
                <?php echo wp_kses_post( $philosophy_html ); ?>
            <?php endif; ?>
            <?php if ( $philosophy_quote ) : ?>
                <div class="philosophy-pulled-quote"><?php echo wp_kses_post( html_entity_decode( html_entity_decode( $philosophy_quote, ENT_QUOTES | ENT_HTML5, 'UTF-8' ), ENT_QUOTES | ENT_HTML5, 'UTF-8' ) ); ?></div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============ 04 Achievements ============ -->
<?php if ( ! empty( $achievements ) || ! empty( $achievements_extra ) ) : ?>
<section class="teacher-section">
    <div class="container">
        <div class="section-num-head">
            <div class="section-num">04 ／ Achievements</div>
            <h2 class="section-h2">講師としての<span class="blue">実績。</span></h2>
        </div>
        <?php if ( ! empty( $achievements ) ) : ?>
            <div class="achievements-grid">
                <?php foreach ( $achievements as $ach ) : ?>
                    <div class="achievement-card">
                        <?php if ( ! empty( $ach['ach_num'] ) ) : ?>
                            <div class="achievement-num"><?php echo esc_html( $ach['ach_num'] ); ?></div>
                        <?php endif; ?>
                        <?php if ( ! empty( $ach['ach_label'] ) ) : ?>
                            <div class="achievement-label"><?php echo esc_html( $ach['ach_label'] ); ?></div>
                        <?php endif; ?>
                        <?php if ( ! empty( $ach['ach_sub'] ) ) : ?>
                            <div class="achievement-sub"><?php echo esc_html( $ach['ach_sub'] ); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if ( ! empty( $achievements_extra ) ) : ?>
            <div class="achievements-extra">
                <div class="achievements-extra-title">主な合格実績校</div>
                <ul class="achievements-extra-list">
                    <?php foreach ( $achievements_extra as $uni ) : ?>
                        <?php if ( ! empty( $uni ) ) : ?>
                            <li><?php echo esc_html( $uni ); ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<!-- ============ 05 Voices ============ -->
<?php if ( ! empty( $voices ) ) : ?>
<section class="teacher-section voices-section">
    <div class="container">
        <div class="section-num-head">
            <div class="section-num">05 ／ Voices from Students</div>
            <h2 class="section-h2">生徒からの<span class="blue">声。</span></h2>
        </div>
        <div class="voices-grid">
            <?php foreach ( $voices as $v ) : ?>
                <div class="voice-card">
                    <?php if ( ! empty( $v['voice_quote'] ) ) : ?>
                        <p class="voice-quote"><?php echo nl2br( esc_html( $v['voice_quote'] ) ); ?></p>
                    <?php endif; ?>
                    <div class="voice-attribution">
                        <?php echo esc_html( $v['voice_name'] ?? '' ); ?>
                        <?php if ( ! empty( $v['voice_uni'] ) ) : ?>
                            <span class="voice-uni"><?php echo esc_html( $v['voice_uni'] ); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============ 06 5 Questions ============ -->
<?php if ( ! empty( $qa_items ) ) : ?>
<section class="teacher-section">
    <div class="container">
        <div class="section-num-head">
            <div class="section-num">06 ／ 5 Questions</div>
            <h2 class="section-h2"><?php echo esc_html( $name_jp ); ?>に聞く<br><span class="blue">5つの質問。</span></h2>
        </div>
        <div class="teacher-qa-list">
            <?php foreach ( $qa_items as $qa ) : ?>
                <div class="teacher-qa-item">
                    <div class="teacher-qa-q"><?php echo esc_html( $qa['qa_question'] ?? '' ); ?></div>
                    <div class="teacher-qa-a"><?php echo nl2br( esc_html( $qa['qa_answer'] ?? '' ) ); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============ 07 Message ============ -->
<?php if ( $message_html ) : ?>
<section class="message-section">
    <div class="container">
        <div class="message-grid">
            <?php if ( $photo_url ) : ?>
                <div class="message-photo">
                    <img src="<?php echo esc_url( $photo_url ); ?>" alt="<?php echo esc_attr( $name_jp ); ?>">
                </div>
            <?php endif; ?>
            <div>
                <div class="message-eyebrow">／ Message to Students</div>
                <div class="message-text"><?php echo wp_kses_post( html_entity_decode( html_entity_decode( $message_html, ENT_QUOTES | ENT_HTML5, 'UTF-8' ), ENT_QUOTES | ENT_HTML5, 'UTF-8' ) ); ?></div>
                <?php if ( $name_en && $position ) : ?>
                    <div class="message-signature">— <?php echo esc_html( $name_en ); ?> ／ <?php echo esc_html( $position ); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============ Teacher Navigation ============ -->
<nav class="teacher-nav">
    <div class="container">
        <div class="teacher-nav-grid">
            <?php if ( $adjacent['prev'] ) :
                $prev_pos  = get_post_meta( $adjacent['prev']->ID, 'position', true );
                $prev_name = get_post_meta( $adjacent['prev']->ID, 'name_jp', true );
            ?>
                <a href="<?php echo esc_url( get_permalink( $adjacent['prev'] ) ); ?>" class="teacher-nav-link prev">
                    <span class="teacher-nav-meta"><?php echo esc_html( $prev_pos ); ?> ／ Prev</span>
                    <span class="teacher-nav-name"><?php echo esc_html( $prev_name ); ?></span>
                </a>
            <?php else : ?>
                <div></div>
            <?php endif; ?>

            <a href="<?php echo esc_url( home_url( '/teachers/' ) ); ?>" class="teacher-nav-back">All Instructors</a>

            <?php if ( $adjacent['next'] ) :
                $next_pos  = get_post_meta( $adjacent['next']->ID, 'position', true );
                $next_name = get_post_meta( $adjacent['next']->ID, 'name_jp', true );
            ?>
                <a href="<?php echo esc_url( get_permalink( $adjacent['next'] ) ); ?>" class="teacher-nav-link next">
                    <span class="teacher-nav-meta"><?php echo esc_html( $next_pos ); ?> ／ Next</span>
                    <span class="teacher-nav-name"><?php echo esc_html( $next_name ); ?></span>
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
    sprintf( '%sと、<br>合格までの戦略を相談する。', esc_html( $name_jp ) )
); ?>

<?php get_footer();
