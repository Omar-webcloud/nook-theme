<?php
/**
 * Utility helper functions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Get dynamic value from ACF/SCF with fallback to options page
 */
function nook_get( $key, $default = '', $post_id = null ) {
    // 1. Try to get from current post/page
    $value = get_field( $key, $post_id );
    
    // 2. Fallback to Options Page
    if ( ! $value ) {
        $value = get_field( $key, 'option' );
    }
    
    // 3. Fallback to default
    return $value ? $value : $default;
}
