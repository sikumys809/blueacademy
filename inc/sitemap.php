<?php
/**
 * Sitemap & Robots.txt customization
 *
 * WordPress 5.5+ 標準の wp-sitemap.xml をカスタマイズ。
 * 不要な post type / taxonomy / users を除外し、
 * 余計な情報がクロールされないようにする。
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Sitemap に含める post type を制限
 * (post と attachment を除外、page / news / story / teacher のみ)
 */
add_filter( 'wp_sitemaps_post_types', 'blueacademy_sitemap_post_types' );
function blueacademy_sitemap_post_types( $post_types ) {
    unset( $post_types['post'] );
    unset( $post_types['attachment'] );
    return $post_types;
}

/**
 * Sitemap から taxonomy (category / post_tag) を完全除外
 */
add_filter( 'wp_sitemaps_taxonomies', '__return_empty_array' );

/**
 * Sitemap から users (著者一覧) を除外
 * 著者URL露出は user enumeration 攻撃のリスクになる
 */
add_filter( 'wp_sitemaps_add_provider', 'blueacademy_sitemap_remove_users', 10, 2 );
function blueacademy_sitemap_remove_users( $provider, $name ) {
    if ( $name === 'users' ) {
        return false;
    }
    return $provider;
}

/**
 * Sitemap から特定の page を除外（Sample Page など）
 */
add_filter( 'wp_sitemaps_posts_query_args', 'blueacademy_sitemap_exclude_pages', 10, 2 );
function blueacademy_sitemap_exclude_pages( $args, $post_type ) {
    if ( $post_type === 'page' ) {
        // Sample Page (slug=sample-page) を除外
        $sample = get_page_by_path( 'sample-page' );
        if ( $sample ) {
            $args['post__not_in'] = isset( $args['post__not_in'] )
                ? array_merge( $args['post__not_in'], array( $sample->ID ) )
                : array( $sample->ID );
        }
    }
    return $args;
}

/**
 * robots.txt にセキュリティ・SEO的に望ましい Disallow を追加
 */
add_filter( 'robots_txt', 'blueacademy_robots_txt', 10, 2 );
function blueacademy_robots_txt( $output, $public ) {
    if ( ! $public ) {
        return $output;
    }

    // 既存の Disallow / Allow を保持しつつ、追加分を挿入
    $extra = "Disallow: /wp-includes/
";
    $extra .= "Disallow: /xmlrpc.php
";
    $extra .= "Disallow: /readme.html
";
    $extra .= "Disallow: /license.txt
";
    $extra .= "Disallow: /wp-login.php
";
    $extra .= "Disallow: /?author=
";

    // 既存の "Disallow: /wp-admin/" の後ろに追加分を入れる
    $output = str_replace(
        "Disallow: /wp-admin/
",
        "Disallow: /wp-admin/
" . $extra,
        $output
    );

    return $output;
}
