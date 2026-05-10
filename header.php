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
            echo '<ul>
              <li><a href="' . esc_url( home_url('/') ) . '">Home</a></li>
              <li><a href="#">Shop</a></li>
              <li><a href="#">About Us</a></li>
              <li><a href="#">Contact</a></li>
            </ul>';
        },
    ] );
    ?>
  </div>
  <div class="menu-overlay"></div>
</header>
