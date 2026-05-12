<?php
/**
 * Template Name: Checkout
 *
 * @package Nook_Furniture
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! is_user_logged_in() ) {
    wp_redirect( wp_login_url( get_permalink() ) );
    exit;
}

get_header();

$cart_html = nook_get_cart_html();
$cart_total = nook_get_cart_total();
$cart_count = nook_get_cart_count();
?>

<main class="checkout-page">
  <section class="checkout-hero">
    <div class="checkout-header">
      <h1>Checkout</h1>
      <p>Review your items and complete your order.</p>
    </div>

    <div class="checkout-grid">
      <div class="checkout-summary">
        <h2>Order Summary</h2>
        <div class="cart-items checkout-cart-items">
          <?php echo $cart_html; ?>
        </div>
      </div>

      <aside class="checkout-sidebar">
        <div class="checkout-total">
          <span>Total</span>
          <strong><?php echo esc_html( $cart_total ); ?></strong>
        </div>

        <?php if ( $cart_count > 0 ) : ?>
          <a href="#" class="place-order button">Place Order</a>
        <?php else : ?>
          <p class="empty-checkout">Your cart is empty. Add products before checking out.</p>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button">Continue Shopping</a>
        <?php endif; ?>
      </aside>
    </div>
  </section>
</main>

<?php get_footer();
