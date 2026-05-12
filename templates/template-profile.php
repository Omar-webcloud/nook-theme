<?php
/**
 * Template Name: Profile
 *
 * @package Nook_Furniture
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! is_user_logged_in() ) {
    wp_safe_redirect( nook_get_login_page_url( get_permalink() ) );
    exit;
}

$current_user = wp_get_current_user();
$display_name = $current_user->display_name ?: $current_user->user_login;
$logout_url = wp_logout_url( nook_get_login_page_url() );

get_header();
?>

<main class="profile-page">
  <section class="profile-header">
    <div>
      <p class="profile-eyebrow"><?php esc_html_e( 'Customer Profile', 'nook-furniture' ); ?></p>
      <h1>
        <?php
        printf(
            /* translators: %s: current user's display name. */
            esc_html__( 'Hello, %s', 'nook-furniture' ),
            esc_html( $display_name )
        );
        ?>
      </h1>
    </div>

    <a class="profile-logout" href="<?php echo esc_url( $logout_url ); ?>">
      <?php esc_html_e( 'Log Out', 'nook-furniture' ); ?>
    </a>
  </section>

  <section class="profile-grid">
    <div class="profile-panel">
      <h2><?php esc_html_e( 'Account Details', 'nook-furniture' ); ?></h2>

      <dl class="profile-details">
        <div>
          <dt><?php esc_html_e( 'Name', 'nook-furniture' ); ?></dt>
          <dd><?php echo esc_html( $display_name ); ?></dd>
        </div>
        <div>
          <dt><?php esc_html_e( 'Username', 'nook-furniture' ); ?></dt>
          <dd><?php echo esc_html( $current_user->user_login ); ?></dd>
        </div>
        <div>
          <dt><?php esc_html_e( 'Email', 'nook-furniture' ); ?></dt>
          <dd><?php echo esc_html( $current_user->user_email ); ?></dd>
        </div>
      </dl>
    </div>

    <aside class="profile-panel profile-actions">
      <h2><?php esc_html_e( 'Quick Actions', 'nook-furniture' ); ?></h2>

      <a class="button" href="<?php echo esc_url( nook_get_checkout_url() ); ?>">
        <?php esc_html_e( 'Go to Checkout', 'nook-furniture' ); ?>
      </a>
      <a class="button button-secondary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php esc_html_e( 'Continue Shopping', 'nook-furniture' ); ?>
      </a>
    </aside>
  </section>
</main>

<?php get_footer();
