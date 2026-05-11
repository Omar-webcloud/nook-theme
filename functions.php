<?php
/**
 * Nook Theme Functions
 *
 * @package Nook_Furniture
 */

if ( ! defined( 'ABSPATH' ) ) exit;



// 1. Theme Setup (Support, Menus, Widgets)
require get_template_directory() . '/inc/setup.php';

// 2. Enqueue Scripts & Styles
require get_template_directory() . '/inc/enqueue.php';

// 3. ACF / SCF Options Page & Settings
require get_template_directory() . '/inc/acf-options.php';

// 4. Utility Helper Functions
require get_template_directory() . '/inc/helpers.php';

// 5. Custom Cart Handler
require get_template_directory() . '/inc/cart-handler.php';
