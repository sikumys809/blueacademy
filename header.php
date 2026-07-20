<?php
/**
 * Header Template
 *
 * @package Blueacademy
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" role="banner">
    <div class="container">
        <div class="site-header-inner">

            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" aria-label="<?php bloginfo( 'name' ); ?>">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/blueacademy-logo.svg" alt="<?php bloginfo( 'name' ); ?>" class="site-logo-img">
            </a>

            <nav class="primary-nav" role="navigation" aria-label="Primary">

                <button class="menu-toggle" type="button" aria-controls="primary-menu" aria-expanded="false" aria-label="メニューを開く">
                    <span class="menu-toggle-bar"></span>
                </button>

                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'menu_class'     => 'primary-nav-list',
                            'container'      => false,
                            'depth'          => 1,
                            'fallback_cb'    => false,
                        )
                    );
                } else {
                    // メニュー未登録時のフォールバック
                    ?>
                    <ul id="primary-menu" class="primary-nav-list">
                        <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/stories/' ) ); ?>">Stories</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/teachers/' ) ); ?>">Teachers</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/results/' ) ); ?>">Results</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/news/' ) ); ?>">News</a></li>
                    </ul>
                    <?php
                }
                ?>

                <a href="https://utage-system.com/event/nLgsJEGf1Pff/register" class="btn btn-primary btn-sm primary-nav-cta" target="_blank" rel="noopener">無料受験相談</a>

            </nav>

        </div>
    </div>
</header>

<main id="content" class="site-main">