<?php
/**
 * Nook Theme Functions
 *
 * @package Nook_Furniture
 */

if ( ! defined( 'ABSPATH' ) ) exit;



// 1. Theme Setup (Support, Menus, Widgets)
require get_template_directory() . '/inc/setup.php';

// 2. Utility Helper Functions
require get_template_directory() . '/inc/helpers.php';

// 3. Enqueue Scripts & Styles
require get_template_directory() . '/inc/enqueue.php';

// 4. ACF / SCF Options Page & Settings
require get_template_directory() . '/inc/acf-options.php';

// 5. Custom Cart Handler
require get_template_directory() . '/inc/cart-handler.php';
