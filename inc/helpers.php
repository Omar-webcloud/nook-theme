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
    $checkout_page = nook_get_page_url_by_template( 'templates/template-checkout.php', 'checkout' );

    return $checkout_page ?: site_url( '/checkout/' );
}

function nook_get_page_url_by_template( $template, $slug = '', $title = '', $create = false ) {
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

    if ( $slug ) {
        $page = get_page_by_path( $slug );

        if ( $page instanceof WP_Post ) {
            if ( $template !== get_page_template_slug( $page->ID ) ) {
                update_post_meta( $page->ID, '_wp_page_template', $template );
            }

            return get_permalink( $page->ID );
        }
    }

    if ( $create && $slug && $title ) {
        $page_id = wp_insert_post( [
            'post_title'   => $title,
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ], true );

        if ( ! is_wp_error( $page_id ) ) {
            update_post_meta( $page_id, '_wp_page_template', $template );
            return get_permalink( $page_id );
        }
    }

    return '';
}

function nook_get_login_page_url( $redirect_to = '' ) {
    $login_page = nook_get_page_url_by_template( 'templates/template-login.php', 'login' );
    if ( $login_page ) {
        if ( $redirect_to ) {
            return add_query_arg( 'redirect_to', rawurlencode( $redirect_to ), $login_page );
        }
        return $login_page;
    }

    return wp_login_url( $redirect_to ?: home_url( '/' ) );
}

function nook_get_register_page_url() {
    $register_page = nook_get_page_url_by_template( 'templates/template-register.php', 'register' );
    if ( $register_page ) {
        return $register_page;
    }

    return wp_registration_url();
}

function nook_get_profile_url() {
    if ( is_user_logged_in() ) {
        $profile_page = nook_get_page_url_by_template( 'templates/template-profile.php', 'profile' );

        if ( $profile_page ) {
            return $profile_page;
        }

        return home_url( '/' );
    }

    return nook_get_login_page_url();
}

function nook_ensure_auth_pages() {
    nook_get_page_url_by_template( 'templates/template-login.php', 'login', __( 'Login', 'nook-furniture' ), true );
    nook_get_page_url_by_template( 'templates/template-register.php', 'register', __( 'Register', 'nook-furniture' ), true );
    nook_get_page_url_by_template( 'templates/template-checkout.php', 'checkout', __( 'Checkout', 'nook-furniture' ), true );
    nook_get_page_url_by_template( 'templates/template-profile.php', 'profile', __( 'Profile', 'nook-furniture' ), true );
}
add_action( 'after_switch_theme', 'nook_ensure_auth_pages' );
add_action( 'admin_init', 'nook_ensure_auth_pages' );

function nook_redirect_failed_login_to_custom_page( $username ) {
    $referrer = wp_get_referer();

    if ( ! $referrer || false === strpos( $referrer, nook_get_login_page_url() ) ) {
        return;
    }

    $redirect_to = isset( $_POST['redirect_to'] ) ? esc_url_raw( wp_unslash( $_POST['redirect_to'] ) ) : '';
    $login_url   = nook_get_login_page_url( $redirect_to );

    wp_safe_redirect( add_query_arg( 'login', 'failed', $login_url ) );
    exit;
}
add_action( 'wp_login_failed', 'nook_redirect_failed_login_to_custom_page' );

function nook_redirect_empty_login_to_custom_page( $user, $username, $password ) {
    if ( ! empty( $username ) && ! empty( $password ) ) {
        return $user;
    }

    $referrer = wp_get_referer();

    if ( $referrer && false !== strpos( $referrer, nook_get_login_page_url() ) ) {
        $redirect_to = isset( $_POST['redirect_to'] ) ? esc_url_raw( wp_unslash( $_POST['redirect_to'] ) ) : '';
        $login_url   = nook_get_login_page_url( $redirect_to );

        wp_safe_redirect( add_query_arg( 'login', 'empty', $login_url ) );
        exit;
    }

    return $user;
}
add_filter( 'authenticate', 'nook_redirect_empty_login_to_custom_page', 30, 3 );
