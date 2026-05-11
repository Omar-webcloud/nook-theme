<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header>
  <!-- Side Menu -->
  <div class="side-menu">
    <button class="close-btn">&times;</button>
    <?php
    wp_nav_menu( [
        'theme_location' => 'primary',
        'menu_class'     => '',
        'container'      => false,
        'fallback_cb'    => function() {
            $menu_items = [
                [
                    'text' => nook_get( 'menu_home_text', 'Home' ),
                    'link' => nook_get( 'menu_home_link', home_url('/') ),
                ],
                [
                    'text' => nook_get( 'menu_shop_text', 'Shop' ),
                    'link' => nook_get( 'menu_shop_link', '#' ),
                ],
                [
                    'text' => nook_get( 'menu_about_text', 'About Us' ),
                    'link' => nook_get( 'menu_about_link', '#' ),
                ],
                [
                    'text' => nook_get( 'menu_contact_text', 'Contact' ),
                    'link' => nook_get( 'menu_contact_link', '#' ),
                ],
            ];

            echo '<ul>';
            foreach ( $menu_items as $item ) {
                echo '<li><a href="' . esc_url( $item['link'] ) . '">' . esc_html( $item['text'] ) . '</a></li>';
            }
            echo '</ul>';
        },
    ] );
    ?>
  </div>
  <div class="menu-overlay"></div>
</header>
