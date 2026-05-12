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

function nook_get_page_url_by_template( $template ) {
    $pages = get_posts( [
        'post_type'      => 'page',
        'meta_key'       => '_wp_page_template',
        'meta_value'     => $template,
        'posts_per_page' => 1,
        'fields'         => 'ids',
    ] );

    if ( ! empty( $pages ) ) {
        return get_permalink( $pages[0] );
    }

    return '';
}

function nook_get_login_page_url( $redirect_to = '' ) {
    $login_page = nook_get_page_url_by_template( 'templates/template-login.php' );
    if ( $login_page ) {
        if ( $redirect_to ) {
            return add_query_arg( 'redirect_to', rawurlencode( $redirect_to ), $login_page );
        }
        return $login_page;
    }

    return wp_login_url( $redirect_to ?: home_url( '/' ) );
}

function nook_get_register_page_url() {
    $register_page = nook_get_page_url_by_template( 'templates/template-register.php' );
    if ( $register_page ) {
        return $register_page;
    }

    return wp_registration_url();
}
