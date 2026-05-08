<?php
/**
 * Breadcrumb partial
 *
 * Usage:
 *   blueacademy_breadcrumb( array(
 *       array( 'label' => 'Stories', 'url' => home_url( '/stories/' ) ),
 *       array( 'label' => 'タイトル', 'url' => null ),
 *   ) );
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$items = ( isset( $args['items'] ) && is_array( $args['items'] ) ) ? $args['items'] : array();

if ( empty( $items ) ) {
    return;
}
?>
<nav class="breadcrumb" aria-label="Breadcrumb">
    <div class="container">
        <ol>
            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
            <?php foreach ( $items as $item ) : ?>
                <?php if ( ! empty( $item['url'] ) ) : ?>
                    <li><a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a></li>
                <?php else : ?>
                    <li aria-current="page"><?php echo esc_html( $item['label'] ); ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ol>
    </div>
</nav>
