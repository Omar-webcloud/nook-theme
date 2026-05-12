<?php
/**
 * Enqueue scripts , fonts and styles
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function nook_scripts() {
    // Theme Info
    wp_enqueue_style(
        'nook-style',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get( 'Version' )
    );

    // CSS
    wp_enqueue_style(
        'nook-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [ 'nook-style' ],
        wp_get_theme()->get( 'Version' )
    );

    // Google Fonts – Inter
    wp_enqueue_style(
        'nook-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap',
        [],
        null
    );

    // Font Awesome 7
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css',
        [],
        '7.0.1'
    );

    // Swiper CSS
    wp_enqueue_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        [],
        '11'
    );

    // Swiper JS
    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        [],
        '11',
        true
    );

    //  JS
    wp_enqueue_script(
        'nook-script',
        get_template_directory_uri() . '/assets/js/main.js',
        [ 'swiper-js' ],
        wp_get_theme()->get( 'Version' ),
        true
    );

    wp_localize_script( 'nook-script', 'nook_params', [
        'ajax_url'     => admin_url( 'admin-ajax.php' ),
        'checkout_url' => nook_get_checkout_url(),
    ] );
}
add_action( 'wp_enqueue_scripts', 'nook_scripts' );
