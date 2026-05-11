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
