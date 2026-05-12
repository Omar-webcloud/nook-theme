<?php
/**
 * Template Name: Login
 *
 * @package Nook_Furniture
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

if ( is_user_logged_in() ) {
    wp_redirect( home_url( '/' ) );
    exit;
}

$redirect_url = home_url( '/' );
if ( isset( $_GET['redirect_to'] ) ) {
    $redirect_url = esc_url_raw( $_GET['redirect_to'] );
}

$form_args = [
    'redirect'       => $redirect_url,
    'form_id'        => 'nook-login-form',
    'label_username' => __( 'Username or Email', 'nook-furniture' ),
    'label_password' => __( 'Password', 'nook-furniture' ),
    'label_log_in'   => __( 'Log In', 'nook-furniture' ),
    'remember'       => true,
    'value_remember' => true,
];
?>

<main class="login-page">
  <section class="auth-panel">
    <div class="auth-card">
      <h1><?php esc_html_e( 'Login', 'nook-furniture' ); ?></h1>
      <p><?php esc_html_e( 'Enter your credentials to continue to checkout.', 'nook-furniture' ); ?></p>

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
