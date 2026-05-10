<?php
/**
 * Nook Furniture Theme Functions
 *
 * @package Nook_Furniture
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Proper Theme Structure: 
 * All logic is separated into the inc/ directory for better maintainability.
 */

// 1. Theme Setup (Support, Menus, Widgets)
require get_template_directory() . '/inc/setup.php';

// 2. Enqueue Scripts & Styles
require get_template_directory() . '/inc/enqueue.php';

// 3. ACF / SCF Options Page & Settings
require get_template_directory() . '/inc/acf-options.php';

// 4. Utility Helper Functions
require get_template_directory() . '/inc/helpers.php';
