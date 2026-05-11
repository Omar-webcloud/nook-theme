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





  <nav class="nav-container">
      <div class="logo">
        <?php 
        $logo = nook_get('header_logo');
        if ( $logo ) : ?>
          <img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo('name'); ?>" />
        <?php else : ?>
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo.svg" alt="<?php bloginfo('name'); ?>" />
        <?php endif; ?>
      </div>

      <div class="nav-toggler">
        <img src="<?php echo esc_url( nook_get( 'header_menu_icon', get_template_directory_uri() . '/assets/images/hamburger.svg' ) ); ?>" alt="Menu" />
      </div>

      <div class="quickxs">
        <img src="<?php echo esc_url( nook_get( 'header_profile_icon', get_template_directory_uri() . '/assets/images/profile.svg' ) ); ?>" alt="Profile" />
        <img src="<?php echo esc_url( nook_get( 'header_wishlist_icon', get_template_directory_uri() . '/assets/images/heart.svg' ) ); ?>" alt="Wishlist" />
        <div class="cart-wrapper">
          <img src="<?php echo esc_url( nook_get( 'header_cart_icon', get_template_directory_uri() . '/assets/images/cart.svg' ) ); ?>" alt="Cart" class="cart-trigger" />
          <span class="cart-count"><?php echo nook_get_cart_count(); ?></span>
        </div>
      </div>
    </nav>





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

  <!-- Cart Sidebar -->
  <div class="cart-sidebar">
    <div class="cart-sidebar__header">
      <h3>Your Cart</h3>
      <button class="cart-close">&times;</button>
    </div>
    <div class="cart-sidebar__content">
      <div class="cart-items">
        <!-- Cart items will be loaded here via AJAX -->
        <p class="empty-cart">Your cart is empty.</p>
      </div>
    </div>
    <div class="cart-sidebar__footer">
      <div class="cart-total">
        <span>Total:</span>
        <span class="total-amount">$0.00</span>
      </div>
      <a href="#" class="checkout-btn">Checkout</a>
    </div>
  </div>

  <div class="menu-overlay"></div>
</header>
