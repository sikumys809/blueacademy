<?php
/**
 * JSON-LD Structured Data
 *
 * Google検索のリッチリザルト対応。
 * ページタイプ別にスキーマを生成して <head> に出力。
 *
 * @package Blueacademy
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * EducationalOrganization スキーマ（全ページ共通）
 */
function blueacademy_jsonld_organization() {
    return array(
        '@type'       => 'EducationalOrganization',
        '@id'         => home_url( '/#organization' ),
        'name'        => 'Blue Academy ／ ブルーアカデミー',
        'alternateName' => 'ブルーアカデミー',
        'url'         => home_url( '/' ),
        'logo'        => array(
            '@type' => 'ImageObject',
            'url'   => get_template_directory_uri() . '/assets/images/blueacademy-logo.svg',
        ),
        'description' => '総合型選抜・推薦入試専門のオンライン予備校。脱偏差値×個性無双をスローガンに、全国の受験生をオンラインでサポート。合格率100%、難関大93.3%を実現。',
        'foundingDate' => '2021',
        'parentOrganization' => array(
            '@type' => 'Organization',
            'name'  => 'クレア株式会社',
        ),
        'address' => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => '西新宿5-24-17 SIL西新宿6階',
            'addressLocality' => '新宿区',
            'addressRegion'   => '東京都',
            'postalCode'      => '160-0023',
            'addressCountry'  => 'JP',
        ),
        'contactPoint' => array(
            '@type'       => 'ContactPoint',
            'telephone'   => '+81-3-5358-9350',
            'email'       => 'info@blueacademy.jp',
            'contactType' => 'customer service',
            'areaServed'  => 'JP',
            'availableLanguage' => array( 'Japanese' ),
        ),
    );
}

/**
 * WebSite スキーマ（TOPのみ）
 */
function blueacademy_jsonld_website() {
    return array(
        '@type' => 'WebSite',
        '@id'   => home_url( '/#website' ),
        'name'  => get_bloginfo( 'name' ),
        'url'   => home_url( '/' ),
        'description' => get_bloginfo( 'description' ),
        'publisher' => array( '@id' => home_url( '/#organization' ) ),
        'inLanguage' => 'ja-JP',
    );
}

/**
 * BreadcrumbList スキーマ（パンくずがあるページ）
 */
function blueacademy_jsonld_breadcrumb() {
    if ( is_front_page() ) return null;

    $items = array(
        array(
            '@type'    => 'ListItem',
            'position' => 1,
            'name'     => 'Home',
            'item'     => home_url( '/' ),
        ),
    );

    $position = 2;

    if ( is_singular( 'story' ) ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => 'Stories',
            'item'     => home_url( '/stories/' ),
        );
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => get_the_title(),
        );
    } elseif ( is_singular( 'teacher' ) ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => 'Teachers',
            'item'     => home_url( '/teachers/' ),
        );
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => get_the_title(),
        );
    } elseif ( is_singular( 'news' ) ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => 'News',
            'item'     => home_url( '/news/' ),
        );
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => get_the_title(),
        );
    } elseif ( is_page() ) {
        $items[] = array(
            '@type'    => 'ListItem',
            'position' => $position++,
            'name'     => get_the_title(),
        );
    } else {
        return null;
    }

    return array(
        '@type'           => 'BreadcrumbList',
        'itemListElement' => $items,
    );
}

/**
 * Article スキーマ（story / news の個別ページ）
 */
function blueacademy_jsonld_article() {
    if ( ! is_singular( array( 'story', 'news' ) ) ) {
        return null;
    }

    $pid = get_the_ID();
    $thumb = '';
    if ( has_post_thumbnail( $pid ) ) {
        $thumb = get_the_post_thumbnail_url( $pid, 'large' );
    } elseif ( $photo_id = get_post_meta( $pid, 'photo', true ) ) {
        $thumb = wp_get_attachment_image_url( $photo_id, 'large' );
    }

    $headline = get_the_title();
    if ( is_singular( 'story' ) ) {
        $name_jp = get_post_meta( $pid, 'name_jp', true );
        $uni     = get_post_meta( $pid, 'university', true );
        if ( $name_jp && $uni ) {
            $headline = "{$name_jp}さん｜{$uni}合格体験記";
        }
    }

    return array(
        '@type'         => 'Article',
        'headline'      => $headline,
        'datePublished' => get_the_date( 'c', $pid ),
        'dateModified'  => get_the_modified_date( 'c', $pid ),
        'image'         => $thumb ? $thumb : ( get_template_directory_uri() . '/assets/images/blueacademy-logo.svg' ),
        'author'        => array(
            '@type' => 'Organization',
            'name'  => 'Blue Academy',
            '@id'   => home_url( '/#organization' ),
        ),
        'publisher'     => array( '@id' => home_url( '/#organization' ) ),
        'mainEntityOfPage' => array(
            '@type' => 'WebPage',
            '@id'   => get_permalink( $pid ),
        ),
    );
}

/**
 * Person スキーマ（teacher 個別ページ）
 */
function blueacademy_jsonld_person() {
    if ( ! is_singular( 'teacher' ) ) return null;

    $pid = get_the_ID();
    $name_jp  = get_post_meta( $pid, 'name_jp', true );
    $name_en  = get_post_meta( $pid, 'name_en', true );
    $position = get_post_meta( $pid, 'position', true );
    $photo_id = get_post_meta( $pid, 'photo', true );
    $photo_url = $photo_id ? wp_get_attachment_image_url( $photo_id, 'large' ) : '';

    $bio_html = get_post_meta( $pid, 'bio_html', true );
    $bio_text = $bio_html ? wp_strip_all_tags( $bio_html ) : '';
    if ( mb_strlen( $bio_text ) > 200 ) {
        $bio_text = mb_substr( $bio_text, 0, 197 ) . '...';
    }

    $person = array(
        '@type'       => 'Person',
        'name'        => $name_jp ? $name_jp : get_the_title(),
        'description' => $bio_text,
        'jobTitle'    => $position,
        'worksFor'    => array( '@id' => home_url( '/#organization' ) ),
    );

    if ( $name_en ) {
        $person['alternateName'] = $name_en;
    }
    if ( $photo_url ) {
        $person['image'] = $photo_url;
    }

    return $person;
}

/**
 * <head> に JSON-LD 出力（@graph で全部まとめる）
 */
add_action( 'wp_head', 'blueacademy_output_jsonld', 5 );
function blueacademy_output_jsonld() {
    $graph = array();

    // 全ページ共通
    $graph[] = blueacademy_jsonld_organization();

    // TOPのみ
    if ( is_front_page() ) {
        $graph[] = blueacademy_jsonld_website();
    }

    // BreadcrumbList
    if ( $bc = blueacademy_jsonld_breadcrumb() ) {
        $graph[] = $bc;
    }

    // Article
    if ( $art = blueacademy_jsonld_article() ) {
        $graph[] = $art;
    }

    // Person
    if ( $person = blueacademy_jsonld_person() ) {
        $graph[] = $person;
    }

    if ( empty( $graph ) ) return;

    $jsonld = array(
        '@context' => 'https://schema.org',
        '@graph'   => $graph,
    );

    echo "\n" . '<script type="application/ld+json">' . "\n";
    echo wp_json_encode( $jsonld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT );
    echo "\n" . '</script>' . "\n";
}
