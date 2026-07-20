<?php
/**
 * Template Name: Results
 *
 * Results page template (page-results.php)
 * Mock: mockups/results.html
 *
 * Depends on:
 *   - inc/fields/page.php          (hero_*)
 *   - inc/fields/page-results.php  (numbers_* / uni_* / why_* / cta_strip_title)
 *   - assets/css/pages/page.css
 *   - assets/css/components.css   (.section / .numbers-section / .reasons-grid / .cta-strip)
 *   - assets/css/pages/results.css (.uni-* )
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
        array( 'label' => 'Achievement', 'url' => null ),
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
                        echo esc_html( $hero_meta ? $hero_meta : 'Achievement' );
                    ?> — Visual</div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- 1. BY THE NUMBERS (DARK) -->
<?php
$numbers_eyebrow_num   = blueacademy_get_meta( 'numbers_eyebrow_num' );
$numbers_eyebrow_label = blueacademy_get_meta( 'numbers_eyebrow_label' );
$numbers_title         = blueacademy_get_meta( 'numbers_title' );
$numbers_lead          = blueacademy_get_meta( 'numbers_lead' );
?>
<section class="numbers-section">
    <div class="container">
        <div class="section-head">
            <div class="section-eyebrow">
                <?php if ( $numbers_eyebrow_num ) : ?>
                    <span class="num"><?php echo esc_html( $numbers_eyebrow_num ); ?></span>
                <?php endif; ?>
                <?php echo esc_html( $numbers_eyebrow_label ); ?>
            </div>
            <div>
                <?php if ( $numbers_title ) : ?>
                    <h2 class="section-title"><?php echo wp_kses_post( html_entity_decode( $numbers_title ) ); ?></h2>
                <?php endif; ?>
                <?php if ( $numbers_lead ) : ?>
                    <p class="section-lead"><?php echo esc_html( $numbers_lead ); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="big-numbers">
            <?php for ( $i = 1; $i <= 6; $i++ ) :
                $value   = blueacademy_get_meta( "bignum_{$i}_value" );
                $unit    = blueacademy_get_meta( "bignum_{$i}_unit" );
                $label   = blueacademy_get_meta( "bignum_{$i}_label" );
                $is_text = blueacademy_get_meta( "bignum_{$i}_is_text" );
                if ( ! $value && ! $label ) continue;
                $value_class = 'big-num-value' . ( $is_text ? ' is-text' : '' );
            ?>
                <div class="big-num-cell">
                    <div class="<?php echo esc_attr( $value_class ); ?>">
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
    </div>
</section>

<!-- 2. UNIVERSITIES LIST -->
<?php
$uni_eyebrow_num   = blueacademy_get_meta( 'uni_eyebrow_num' );
$uni_eyebrow_label = blueacademy_get_meta( 'uni_eyebrow_label' );
$uni_title         = blueacademy_get_meta( 'uni_title' );
$uni_lead          = blueacademy_get_meta( 'uni_lead' );
?>
<section class="section">
    <div class="container">
        <div class="section-head">
            <div class="section-eyebrow">
                <?php if ( $uni_eyebrow_num ) : ?>
                    <span class="num"><?php echo esc_html( $uni_eyebrow_num ); ?></span>
                <?php endif; ?>
                <?php echo esc_html( $uni_eyebrow_label ); ?>
            </div>
            <div>
                <?php if ( $uni_title ) : ?>
                    <h2 class="section-title"><?php echo wp_kses_post( html_entity_decode( $uni_title ) ); ?></h2>
                <?php endif; ?>
                <?php if ( $uni_lead ) : ?>
                    <p class="section-lead"><?php echo esc_html( $uni_lead ); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="uni-categories">
            <?php for ( $i = 1; $i <= 7; $i++ ) :
                $cat_num   = blueacademy_get_meta( "uni_cat_{$i}_num" );
                $cat_title = blueacademy_get_meta( "uni_cat_{$i}_title" );
                $cat_list  = blueacademy_get_meta( "uni_cat_{$i}_list" );
                if ( ! $cat_title && ! $cat_list ) continue;

                // 大学リストのパース: 1行 = 1大学、"大学名|倍率" 形式
                $items = array();
                if ( $cat_list ) {
                    foreach ( preg_split( "/\r\n|\n|\r/", $cat_list ) as $line ) {
                        $line = trim( $line );
                        if ( $line === '' ) continue;
                        $parts = array_map( 'trim', explode( '|', $line, 2 ) );
                        $items[] = array(
                            'name' => $parts[0],
                            'rate' => isset( $parts[1] ) ? $parts[1] : '',
                        );
                    }
                }
            ?>
                <div class="uni-cat">
                    <div class="uni-cat-head">
                        <?php if ( $cat_num ) : ?>
                            <div class="uni-cat-num"><?php echo esc_html( $cat_num ); ?></div>
                        <?php endif; ?>
                        <?php if ( $cat_title ) : ?>
                            <h3 class="uni-cat-title"><?php echo esc_html( $cat_title ); ?></h3>
                        <?php endif; ?>
                    </div>
                    <?php if ( ! empty( $items ) ) : ?>
                        <ul class="uni-list">
                            <?php foreach ( $items as $item ) : ?>
                                <li>
                                    <span class="uni-name"><?php echo esc_html( $item['name'] ); ?></span>
                                    <?php if ( $item['rate'] ) : ?>
                                        <span class="uni-rate"><?php echo esc_html( $item['rate'] ); ?></span>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<!-- 3. WHY WE ACHIEVE -->
<?php
$why_eyebrow_num   = blueacademy_get_meta( 'why_eyebrow_num' );
$why_eyebrow_label = blueacademy_get_meta( 'why_eyebrow_label' );
$why_title         = blueacademy_get_meta( 'why_title' );
$why_lead          = blueacademy_get_meta( 'why_lead' );
?>
<section class="section">
    <div class="container">
        <div class="section-head">
            <div class="section-eyebrow">
                <?php if ( $why_eyebrow_num ) : ?>
                    <span class="num"><?php echo esc_html( $why_eyebrow_num ); ?></span>
                <?php endif; ?>
                <?php echo esc_html( $why_eyebrow_label ); ?>
            </div>
            <div>
                <?php if ( $why_title ) : ?>
                    <h2 class="section-title"><?php echo wp_kses_post( html_entity_decode( $why_title ) ); ?></h2>
                <?php endif; ?>
                <?php if ( $why_lead ) : ?>
                    <p class="section-lead"><?php echo esc_html( $why_lead ); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="reasons-grid">
            <?php for ( $i = 1; $i <= 3; $i++ ) :
                $num   = blueacademy_get_meta( "why_reason_{$i}_num" );
                $title = blueacademy_get_meta( "why_reason_{$i}_title" );
                $text  = blueacademy_get_meta( "why_reason_{$i}_text" );
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

<!-- 4. CTA STRIP -->
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
