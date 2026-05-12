<?php
/**
 * Template Name: Login
 *
 * @package Nook_Furniture
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( is_user_logged_in() ) {
    wp_safe_redirect( home_url( '/' ) );
    exit;
}

$redirect_url = home_url( '/' );
if ( isset( $_GET['redirect_to'] ) ) {
    $redirect_url = esc_url_raw( $_GET['redirect_to'] );
}

$login_status = isset( $_GET['login'] ) ? sanitize_key( wp_unslash( $_GET['login'] ) ) : '';

$form_args = [
    'redirect'       => $redirect_url,
    'form_id'        => 'nook-login-form',
    'label_username' => __( 'Username or Email', 'nook-furniture' ),
    'label_password' => __( 'Password', 'nook-furniture' ),
    'label_log_in'   => __( 'Log In', 'nook-furniture' ),
    'remember'       => true,
    'value_remember' => true,
];

get_header();
?>

<main class="login-page">
  <section class="auth-panel">
    <div class="auth-card">
      <h1><?php esc_html_e( 'Login', 'nook-furniture' ); ?></h1>
      <p><?php esc_html_e( 'Enter your credentials to continue to checkout.', 'nook-furniture' ); ?></p>

      <?php if ( 'failed' === $login_status ) : ?>
        <div class="auth-alert auth-alert--error">
          <p><?php esc_html_e( 'The username or password you entered is incorrect.', 'nook-furniture' ); ?></p>
        </div>
      <?php elseif ( 'empty' === $login_status ) : ?>
        <div class="auth-alert auth-alert--error">
          <p><?php esc_html_e( 'Please enter both your username and password.', 'nook-furniture' ); ?></p>
        </div>
      <?php endif; ?>

      <div class="auth-form">
        <?php wp_login_form( $form_args ); ?>
      </div>

      <p class="auth-note">
        <?php esc_html_e( 'Need an account?', 'nook-furniture' ); ?>
        <a href="<?php echo esc_url( nook_get_register_page_url() ); ?>">
          <?php esc_html_e( 'Register here', 'nook-furniture' ); ?>
        </a>
      </p>
    </div>
  </section>
</main>

<?php get_footer();
