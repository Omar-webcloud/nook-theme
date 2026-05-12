<?php
/**
 * helper functions
 */

if ( ! defined( 'ABSPATH' ) ) exit;


function nook_get( $key, $default = '', $post_id = null ) {
    $value = get_field( $key, $post_id );

    if ( ! $value ) {
        $value = get_field( $key, 'option' );
    }

    return $value ? $value : $default;
}

function nook_get_checkout_url() {
    $pages = get_posts( [
        'post_type'      => 'page',
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'templates/template-checkout.php',
        'posts_per_page' => 1,
        'fields'         => 'ids',
    ] );

    if ( ! empty( $pages ) ) {
        return get_permalink( $pages[0] );
    }

    return site_url( '/checkout/' );
}
