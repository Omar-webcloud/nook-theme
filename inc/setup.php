<?php
/**
 * Theme setup and registration
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function nook_setup() {
    load_theme_textdomain( 'nook-furniture', get_template_directory() . '/languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );

    register_nav_menus( [
        'primary' => __( 'Side Menu', 'nook-furniture' ),
    ] ); 
}
add_action( 'after_setup_theme', 'nook_setup' );

function nook_register_product_post_type() {
    register_post_type( 'product', [
        'labels' => [
            'name'          => __( 'Products', 'nook-furniture' ),
            'singular_name' => __( 'Product', 'nook-furniture' ),
        ],
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => [ 'slug' => 'products' ],
        'supports'      => [ 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields' ],
        'show_in_rest'  => true,
    ] );
}
add_action( 'init', 'nook_register_product_post_type' );

function nook_widgets_init() {
    register_sidebar( [
        'name'          => __( 'Sidebar', 'nook-furniture' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here.', 'nook-furniture' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>', 
    ] );
}
add_action( 'widgets_init', 'nook_widgets_init' );

function nook_customize_register( $wp_customize ) {

}
add_action( 'customize_register', 'nook_customize_register' );
