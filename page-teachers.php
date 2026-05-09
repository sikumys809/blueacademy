<?php
/**
 * Template Name: Teachers List
 *
 * 講師一覧ページ (page-teachers.php)
 * Mock: mockups/teachers.html
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

    $intro_text    = blueacademy_get_meta( 'teachers_intro_text' );
    $intro_tagline = blueacademy_get_meta( 'teachers_intro_tagline' );

    blueacademy_breadcrumb( array(
        array( 'label' => 'Instructors', 'url' => null ),
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
                    <div class="page-hero-visual-caption">Instructors &mdash; Visual</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- INTRO -->
<?php if ( $intro_text || $intro_tagline ) : ?>
<section class="teachers-intro">
    <div class="container">
        <?php if ( $intro_text ) : ?>
            <p class="teachers-intro-text"><?php echo wp_kses_post( html_entity_decode( $intro_text ) ); ?></p>
        <?php endif; ?>
        <?php if ( $intro_tagline ) : ?>
            <div class="teachers-intro-tagline"><?php echo esc_html( $intro_tagline ); ?></div>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>

<!-- TEACHER LIST -->
<section class="teacher-list">
    <?php
    $teachers = get_posts( array(
        'post_type'      => 'teacher',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'meta_key'       => 'sort_order',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
    ) );
    $total = count( $teachers );

    if ( $total === 0 ) : ?>
        <div class="container">
            <div class="teacher-empty">講師情報を準備中です。</div>
        </div>
    <?php else :
        $i = 0;
        foreach ( $teachers as $teacher ) :
            $i++;
            setup_postdata( $teacher );
            $tid       = $teacher->ID;
            $position  = get_post_meta( $tid, 'position', true );
            $name_jp   = get_post_meta( $tid, 'name_jp', true );
            $name_en   = get_post_meta( $tid, 'name_en', true );
            $list_bio  = get_post_meta( $tid, 'list_bio_html', true );
            $bio_html  = get_post_meta( $tid, 'bio_html', true );
            $photo_id  = get_post_meta( $tid, 'photo', true );
            $photo_src = $photo_id ? wp_get_attachment_image_url( $photo_id, 'medium_large' ) : '';
    ?>
        <article class="teacher-row" id="teacher-<?php echo str_pad( $i, 2, '0', STR_PAD_LEFT ); ?>">
            <div class="container">
                <div class="teacher-row-inner">
                    <div class="teacher-row-photo-side">
                        <div class="teacher-row-photo">
                            <?php if ( $photo_src ) : ?>
                                <img src="<?php echo esc_url( $photo_src ); ?>" alt="<?php echo esc_attr( $name_jp ); ?>">
                            <?php else : ?>
                                <div class="placeholder">Photo Coming Soon</div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="teacher-row-info">
                        <div class="teacher-row-num">Instructor <?php
                            echo str_pad( $i, 2, '0', STR_PAD_LEFT );
                        ?> ／ <?php echo str_pad( $total, 2, '0', STR_PAD_LEFT ); ?></div>
                        <?php if ( $position ) : ?>
                            <div class="teacher-row-role"><?php echo esc_html( $position ); ?></div>
                        <?php endif; ?>
                        <h2 class="teacher-row-name">
                            <a href="<?php echo esc_url( get_permalink( $tid ) ); ?>" style="color:inherit;text-decoration:none;"><?php
                                echo esc_html( $name_jp );
                            ?></a>
                        </h2>
                        <?php if ( $name_en ) : ?>
                            <div class="teacher-row-name-en"><?php echo esc_html( $name_en ); ?></div>
                        <?php endif; ?>
                        <?php if ( $list_bio ) : ?>
                            <div class="teacher-row-bio"><?php echo wp_kses_post( html_entity_decode( $list_bio ) ); ?></div>
                        <?php endif; ?>
                        <?php if ( $bio_html ) : ?>
                            <div class="teacher-row-desc"><?php echo wp_kses_post( html_entity_decode( $bio_html ) ); ?></div>
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
