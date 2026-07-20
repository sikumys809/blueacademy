<?php
/**
 * Template Name: About
 *
 * About page template (page-about.php)
 * Mock: mockups/about.html
 *
 * Depends on:
 *   - inc/fields/page.php       (hero_meta / hero_title_html / hero_sub / hero_text / hero_visual)
 *   - inc/fields/page-about.php (Pillar / Definition / Online / Specialist / CTA)
 *   - assets/css/pages/page.css
 *   - assets/css/pages/about.css
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

    blueacademy_breadcrumb( array(
        array( 'label' => 'About', 'url' => null ),
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
                    <?php
                    if ( $hero_title ) {
                        echo wp_kses_post( html_entity_decode( $hero_title ) );
                    } else {
                        echo esc_html( get_the_title() );
                    }
                    ?>
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
                    <div class="page-hero-visual-caption"><?php
                        echo esc_html( $hero_meta ? $hero_meta : 'About Us' );
                    ?> — Visual</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- 1. THREE PILLARS -->
<?php
$pillars_eyebrow_num   = blueacademy_get_meta( 'pillars_eyebrow_num' );
$pillars_eyebrow_label = blueacademy_get_meta( 'pillars_eyebrow_label' );
$pillars_title         = blueacademy_get_meta( 'pillars_title' );
$pillars_lead          = blueacademy_get_meta( 'pillars_lead' );
?>
<section class="section">
    <div class="container">
        <div class="section-head">
            <div class="section-eyebrow">
                <?php if ( $pillars_eyebrow_num ) : ?>
                    <span class="num"><?php echo esc_html( $pillars_eyebrow_num ); ?></span>
                <?php endif; ?>
                <?php echo esc_html( $pillars_eyebrow_label ); ?>
            </div>
            <div>
                <?php if ( $pillars_title ) : ?>
                    <h2 class="section-title"><?php echo wp_kses_post( html_entity_decode( $pillars_title ) ); ?></h2>
                <?php endif; ?>
                <?php if ( $pillars_lead ) : ?>
                    <p class="section-lead"><?php echo esc_html( $pillars_lead ); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="pillars">
            <?php for ( $i = 1; $i <= 3; $i++ ) :
                $num   = blueacademy_get_meta( "pillar_{$i}_num" );
                $title = blueacademy_get_meta( "pillar_{$i}_title" );
                $text  = blueacademy_get_meta( "pillar_{$i}_text" );
                if ( ! $title && ! $text ) continue;
            ?>
                <div class="pillar">
                    <?php if ( $num ) : ?>
                        <div class="pillar-num"><?php echo esc_html( $num ); ?></div>
                    <?php endif; ?>
                    <?php if ( $title ) : ?>
                        <h3 class="pillar-title"><?php echo esc_html( $title ); ?></h3>
                    <?php endif; ?>
                    <?php if ( $text ) : ?>
                        <p class="pillar-text"><?php echo esc_html( $text ); ?></p>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- 2. DEFINITIONS -->
<?php for ( $i = 1; $i <= 3; $i++ ) :
    $label = blueacademy_get_meta( "def_{$i}_label" );
    $title = blueacademy_get_meta( "def_{$i}_title" );
    $body  = blueacademy_get_meta( "def_{$i}_body" );
    if ( ! $title && ! $body ) continue;
?>
<section class="def-section">
    <div class="container">
        <div class="def-grid">
            <div>
                <?php if ( $label ) : ?>
                    <div class="def-label"><?php echo esc_html( $label ); ?></div>
                <?php endif; ?>
                <?php if ( $title ) : ?>
                    <h2 class="def-jp-title"><?php echo wp_kses_post( html_entity_decode( $title ) ); ?></h2>
                <?php endif; ?>
            </div>
            <div class="def-body">
                <?php
                if ( $body ) {
                    echo apply_filters( 'the_content', $body );
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php endfor; ?>

<!-- 3. ONLINE ADVANTAGE (DARK) -->
<?php
$online_eyebrow_num   = blueacademy_get_meta( 'online_eyebrow_num' );
$online_eyebrow_label = blueacademy_get_meta( 'online_eyebrow_label' );
$online_title         = blueacademy_get_meta( 'online_title' );
$online_lead          = blueacademy_get_meta( 'online_lead' );
?>
<section class="numbers-section">
    <div class="container">
        <div class="section-head">
            <div class="section-eyebrow">
                <?php if ( $online_eyebrow_num ) : ?>
                    <span class="num"><?php echo esc_html( $online_eyebrow_num ); ?></span>
                <?php endif; ?>
                <?php echo esc_html( $online_eyebrow_label ); ?>
            </div>
            <div>
                <?php if ( $online_title ) : ?>
                    <h2 class="section-title"><?php echo wp_kses_post( html_entity_decode( $online_title ) ); ?></h2>
                <?php endif; ?>
                <?php if ( $online_lead ) : ?>
                    <p class="section-lead"><?php echo esc_html( $online_lead ); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="big-numbers">
            <?php for ( $i = 1; $i <= 4; $i++ ) :
                $value = blueacademy_get_meta( "bignum_{$i}_value" );
                $unit  = blueacademy_get_meta( "bignum_{$i}_unit" );
                $label = blueacademy_get_meta( "bignum_{$i}_label" );
                if ( ! $value && ! $label ) continue;
            ?>
                <div class="big-num-cell">
                    <div class="big-num-value">
                        <?php echo esc_html( $value ); ?><?php
                        if ( $unit ) echo '<small>' . esc_html( $unit ) . '</small>';
                        ?>
                    </div>
                    <?php if ( $label ) : ?>
                        <div class="big-num-label"><?php echo wp_kses_post( html_entity_decode( $label ) ); ?></div>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>

        <div class="reasons-grid">
            <?php for ( $i = 1; $i <= 3; $i++ ) :
                $num   = blueacademy_get_meta( "reason_{$i}_num" );
                $title = blueacademy_get_meta( "reason_{$i}_title" );
                $text  = blueacademy_get_meta( "reason_{$i}_text" );
                if ( ! $title && ! $text ) continue;
            ?>
                <div class="reason-card">
                    <?php if ( $num ) : ?>
                        <div class="reason-num"><?php echo esc_html( $num ); ?></div>
                    <?php endif; ?>
                    <?php if ( $title ) : ?>
                        <h3 class="reason-title"><?php echo wp_kses_post( html_entity_decode( $title ) ); ?></h3>
                    <?php endif; ?>
                    <?php if ( $text ) : ?>
                        <p class="reason-text"><?php echo esc_html( $text ); ?></p>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- 4. SPECIALIST TEAM -->
<?php
$spec_eyebrow_num   = blueacademy_get_meta( 'specialist_eyebrow_num' );
$spec_eyebrow_label = blueacademy_get_meta( 'specialist_eyebrow_label' );
$spec_title         = blueacademy_get_meta( 'specialist_title' );
$spec_lead          = blueacademy_get_meta( 'specialist_lead' );
?>
<section class="section">
    <div class="container">
        <div class="section-head">
            <div class="section-eyebrow">
                <?php if ( $spec_eyebrow_num ) : ?>
                    <span class="num"><?php echo esc_html( $spec_eyebrow_num ); ?></span>
                <?php endif; ?>
                <?php echo esc_html( $spec_eyebrow_label ); ?>
            </div>
            <div>
                <?php if ( $spec_title ) : ?>
                    <h2 class="section-title"><?php echo wp_kses_post( html_entity_decode( $spec_title ) ); ?></h2>
                <?php endif; ?>
                <?php if ( $spec_lead ) : ?>
                    <p class="section-lead"><?php echo esc_html( $spec_lead ); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="specialists-grid">
            <?php for ( $i = 1; $i <= 3; $i++ ) :
                $num   = blueacademy_get_meta( "specialist_{$i}_num" );
                $title = blueacademy_get_meta( "specialist_{$i}_title" );
                $text  = blueacademy_get_meta( "specialist_{$i}_text" );
                if ( ! $title && ! $text ) continue;
            ?>
                <div class="specialist-card">
                    <?php if ( $num ) : ?>
                        <div class="specialist-num"><?php echo esc_html( $num ); ?></div>
                    <?php endif; ?>
                    <?php if ( $title ) : ?>
                        <h3 class="specialist-title"><?php echo wp_kses_post( html_entity_decode( $title ) ); ?></h3>
                    <?php endif; ?>
                    <?php if ( $text ) : ?>
                        <p class="specialist-text"><?php echo esc_html( $text ); ?></p>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- 5. CTA STRIP -->
<?php
$cta_strip_title = blueacademy_get_meta( 'cta_strip_title' );
if ( $cta_strip_title ) :
?>
<section class="cta-strip">
    <div class="container">
        <div class="cta-strip-grid">
            <h2><?php echo wp_kses_post( html_entity_decode( $cta_strip_title ) ); ?></h2>
            <div class="cta-strip-actions">
                <a href="https://utage-system.com/event/nLgsJEGf1Pff/register" class="btn btn-primary btn-arrow" target="_blank" rel="noopener">無料受験相談</a>
                <a href="https://utage-system.com/line/open/6mWKcAJuw1Ke?mtid=07ij3JpYP7K4" class="btn btn-line btn-arrow" target="_blank" rel="noopener">LINE追加</a>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
endwhile;

get_footer();
