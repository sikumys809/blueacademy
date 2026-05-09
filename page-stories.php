<?php
/**
 * Template Name: Stories List
 *
 * 合格者体験記一覧 (page-stories.php)
 * Mock: mockups/stories.html
 *
 * @package Blueacademy
 */

get_header();

while ( have_posts() ) : the_post();

    $hero_meta  = blueacademy_get_meta( 'hero_meta' );
    $hero_title = blueacademy_get_meta( 'hero_title_html' );
    $hero_sub   = blueacademy_get_meta( 'hero_sub' );
    $hero_text  = blueacademy_get_meta( 'hero_text' );
    $hero_image = blueacademy_get_image_url( 'hero_visual', 'large' );

    $intro_heading = blueacademy_get_meta( 'stories_intro_heading' );
    $intro_items   = blueacademy_get_meta( 'stories_intro_items' );
    $intro_side    = blueacademy_get_meta( 'stories_intro_side' );

    blueacademy_breadcrumb( array(
        array( 'label' => 'Stories', 'url' => null ),
        array( 'label' => get_the_title(), 'url' => null ),
    ) );
?>

<!-- HERO -->
<section class="page-hero">
    <div class="container">
        <div class="page-hero-inner">
            <div class="page-hero-text-wrap">
                <?php if ( $hero_meta ) : ?>
                    <div class="page-hero-meta"><?php echo esc_html( $hero_meta ); ?></div>
                <?php endif; ?>
                <h1 class="page-hero-title">
                    <?php echo $hero_title ? wp_kses_post( html_entity_decode( $hero_title ) ) : esc_html( get_the_title() ); ?>
                </h1>
                <?php if ( $hero_sub ) : ?>
                    <p class="page-hero-sub"><?php echo esc_html( $hero_sub ); ?></p>
                <?php endif; ?>
                <?php if ( $hero_text ) : ?>
                    <p class="page-hero-text"><?php echo wp_kses_post( html_entity_decode( $hero_text ) ); ?></p>
                <?php endif; ?>
            </div>
            <?php if ( $hero_image ) : ?>
                <div class="page-hero-visual">
                    <img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                </div>
            <?php else : ?>
                <div class="page-hero-visual">
                    <div class="page-hero-visual-placeholder">Image Area</div>
                    <div class="page-hero-visual-caption">Stories &mdash; Visual</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- INTRO -->
<?php if ( $intro_heading || $intro_items || $intro_side ) : ?>
<section class="stories-intro">
    <div class="container">
        <div class="stories-intro-grid">
            <div>
                <?php if ( $intro_heading ) : ?>
                    <h2><?php echo wp_kses_post( html_entity_decode( $intro_heading ) ); ?></h2>
                <?php endif; ?>
                <?php if ( $intro_items ) : ?>
                    <ul class="stories-intro-list">
                        <?php foreach ( preg_split( "/\r\n|\n|\r/", $intro_items ) as $line ) :
                            $line = trim( $line );
                            if ( $line === '' ) continue;
                        ?>
                            <li><?php echo esc_html( $line ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <?php if ( $intro_side ) : ?>
                <div class="stories-intro-side">
                    <?php echo wp_kses_post( wpautop( html_entity_decode( $intro_side ) ) ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- STORIES LIST -->
<section class="stories-list">
    <?php
    $stories = get_posts( array(
        'post_type'      => 'story',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'meta_key'       => 'sort_order',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
    ) );
    $total = count( $stories );

    if ( $total === 0 ) : ?>
        <div class="container">
            <div class="story-empty">合格者体験記を準備中です。</div>
        </div>
    <?php else :
        $i = 0;
        foreach ( $stories as $story ) :
            $i++;
            setup_postdata( $story );
            $sid = $story->ID;

            $file_num     = get_post_meta( $sid, 'file_num', true );
            $name_jp      = get_post_meta( $sid, 'name_jp', true );
            $name_en      = get_post_meta( $sid, 'name_en', true );
            $university   = get_post_meta( $sid, 'university', true );
            $tagline_html = get_post_meta( $sid, 'tagline_html', true );

            $from_place = get_post_meta( $sid, 'from_place', true );
            $school     = get_post_meta( $sid, 'school', true );
            $since      = get_post_meta( $sid, 'since', true );
            $gpa        = get_post_meta( $sid, 'gpa', true );
            $english    = get_post_meta( $sid, 'english', true );
            $result     = get_post_meta( $sid, 'result', true );

            $bio_html  = get_post_meta( $sid, 'bio_html', true );
            $youtube   = get_post_meta( $sid, 'youtube_id', true );
            $pdf_url   = get_post_meta( $sid, 'pdf_url', true );
            $photo_id  = get_post_meta( $sid, 'photo', true );
            $photo_src = $photo_id ? wp_get_attachment_image_url( $photo_id, 'medium_large' ) : '';

            $num_str = $file_num ? $file_num : str_pad( $i, 2, '0', STR_PAD_LEFT );
    ?>
        <article class="story-row" id="file-<?php echo esc_attr( $num_str ); ?>">
            <div class="container">
                <div class="story-row-inner">
                    <div class="story-photo-side">
                        <div class="story-photo">
                            <?php if ( $photo_src ) : ?>
                                <img src="<?php echo esc_url( $photo_src ); ?>" alt="<?php echo esc_attr( $name_jp ); ?>">
                            <?php else : ?>
                                <div class="story-photo-placeholder">Photo Coming Soon</div>
                            <?php endif; ?>
                        </div>
                        <dl class="story-photo-spec">
                            <?php
                            $specs = array(
                                'From'    => $from_place,
                                'School'  => $school,
                                'Since'   => $since,
                                'GPA'     => $gpa,
                                'English' => $english,
                                'Result'  => $result,
                            );
                            foreach ( $specs as $label => $val ) :
                                if ( ! $val ) continue;
                            ?>
                                <div class="story-photo-spec-row">
                                    <dt><?php echo esc_html( $label ); ?></dt>
                                    <dd><?php echo esc_html( $val ); ?></dd>
                                </div>
                            <?php endforeach; ?>
                        </dl>
                    </div>
                    <div class="story-info-side">
                        <div class="story-num-wrap">
                            <div class="story-num">FILE <?php echo esc_html( $num_str ); ?> ／ <?php echo str_pad( $total, 2, '0', STR_PAD_LEFT ); ?></div>
                            <a href="<?php echo esc_url( get_permalink( $sid ) ); ?>" class="story-permalink">View Full Profile</a>
                        </div>
                        <h2 class="story-name"><a href="<?php echo esc_url( get_permalink( $sid ) ); ?>"><?php echo esc_html( $name_jp ); ?></a></h2>
                        <?php if ( $name_en ) : ?>
                            <div class="story-name-en"><?php echo esc_html( $name_en ); ?></div>
                        <?php endif; ?>
                        <?php if ( $university ) : ?>
                            <div class="story-uni"><?php echo esc_html( $university ); ?></div>
                        <?php endif; ?>
                        <?php if ( $tagline_html ) : ?>
                            <h3 class="story-headline"><?php echo wp_kses_post( html_entity_decode( $tagline_html ) ); ?></h3>
                        <?php endif; ?>
                        <?php if ( $bio_html ) : ?>
                            <div class="story-body"><?php echo wp_kses_post( html_entity_decode( $bio_html ) ); ?></div>
                        <?php endif; ?>

                        <?php if ( $youtube || $pdf_url ) : ?>
                            <div class="story-actions-label">Watch &amp; Read the Full Story</div>
                            <div class="story-actions">
                                <?php if ( $youtube ) :
                                    $yt_thumb = "https://img.youtube.com/vi/{$youtube}/maxresdefault.jpg";
                                ?>
                                    <button type="button" class="story-video-thumb" data-video-id="<?php echo esc_attr( $youtube ); ?>" aria-label="<?php echo esc_attr( $name_jp ); ?>さんの合格体験記動画を再生">
                                        <img src="<?php echo esc_url( $yt_thumb ); ?>" alt="" loading="lazy">
                                        <span class="story-video-play"></span>
                                        <span class="story-video-meta">▶ Play Video ／ YouTube</span>
                                    </button>
                                <?php endif; ?>
                                <?php if ( $pdf_url ) : ?>
                                    <button type="button" class="story-pdf-card" data-pdf-url="<?php echo esc_attr( $pdf_url ); ?>" aria-label="<?php echo esc_attr( $name_jp ); ?>さんの合格体験記PDFを開く">
                                        <div class="story-pdf-icon"></div>
                                        <div class="story-pdf-title">合格体験記PDF</div>
                                        <div class="story-pdf-sub">志望理由書・課外活動歴を含む全14ページ</div>
                                        <div class="story-pdf-link">Read Full Document</div>
                                    </button>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </article>
    <?php
        endforeach;
        wp_reset_postdata();
    endif; ?>
</section>

<?php
endwhile;

blueacademy_cta_strip();

get_footer();
