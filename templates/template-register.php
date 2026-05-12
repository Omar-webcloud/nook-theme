<?php
/**
 * Template Name: Register
 *
 * @package Nook_Furniture
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( is_user_logged_in() ) {
    wp_redirect( home_url( '/' ) );
    exit;
}

$registration_open = get_option( 'users_can_register' );
$errors = [];
$success = false;

if ( $registration_open && 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['nook_register_nonce'] ) && wp_verify_nonce( wp_unslash( $_POST['nook_register_nonce'] ), 'nook_register_action' ) ) {
    $username = sanitize_user( wp_unslash( $_POST['username'] ) );
    $email    = sanitize_email( wp_unslash( $_POST['email'] ) );
    $password = sanitize_text_field( wp_unslash( $_POST['password'] ) );

    if ( empty( $username ) ) {
        $errors[] = __( 'Username is required.', 'nook-furniture' );
    } elseif ( username_exists( $username ) ) {
        $errors[] = __( 'That username is already taken.', 'nook-furniture' );
    }

    if ( empty( $email ) ) {
        $errors[] = __( 'Email is required.', 'nook-furniture' );
    } elseif ( ! is_email( $email ) ) {
        $errors[] = __( 'Please enter a valid email address.', 'nook-furniture' );
    } elseif ( email_exists( $email ) ) {
        $errors[] = __( 'That email address is already registered.', 'nook-furniture' );
    }

    if ( empty( $password ) || strlen( $password ) < 6 ) {
        $errors[] = __( 'Password must be at least 6 characters.', 'nook-furniture' );
    }

    if ( empty( $errors ) ) {
        $user_id = wp_create_user( $username, $password, $email );

        if ( is_wp_error( $user_id ) ) {
            $errors[] = $user_id->get_error_message();
        } else {
            wp_new_user_notification( $user_id, null, 'user' );
            wp_set_current_user( $user_id );
            wp_set_auth_cookie( $user_id );
            wp_redirect( home_url( '/' ) );
            exit;
        }
    }
}

get_header();
?>

<main class="register-page">
  <section class="auth-panel">
    <div class="auth-card">
      <h1><?php esc_html_e( 'Create Account', 'nook-furniture' ); ?></h1>
      <p><?php esc_html_e( 'Register to save your cart and complete checkout faster.', 'nook-furniture' ); ?></p>

      <?php if ( ! $registration_open ) : ?>
        <div class="auth-alert">
          <p><?php esc_html_e( 'Registration is currently disabled. You can still create an account through the standard WordPress registration form.', 'nook-furniture' ); ?></p>
          <a class="button" href="<?php echo esc_url( wp_registration_url() ); ?>"><?php esc_html_e( 'Use WordPress registration', 'nook-furniture' ); ?></a>
        </div>
      <?php else : ?>
        <?php if ( ! empty( $errors ) ) : ?>
          <div class="auth-alert auth-alert--error">
            <ul>
              <?php foreach ( $errors as $error ) : ?>
                <li><?php echo esc_html( $error ); ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>

        <form class="auth-form" method="post" action="<?php echo esc_url( get_permalink() ); ?>">
          <label for="nook-username"><?php esc_html_e( 'Username', 'nook-furniture' ); ?></label>
          <input id="nook-username" type="text" name="username" value="<?php echo isset( $username ) ? esc_attr( $username ) : ''; ?>" required>

          <label for="nook-email"><?php esc_html_e( 'Email', 'nook-furniture' ); ?></label>
          <input id="nook-email" type="email" name="email" value="<?php echo isset( $email ) ? esc_attr( $email ) : ''; ?>" required>

          <label for="nook-password"><?php esc_html_e( 'Password', 'nook-furniture' ); ?></label>
          <input id="nook-password" type="password" name="password" required>

          <?php wp_nonce_field( 'nook_register_action', 'nook_register_nonce' ); ?>
          <button type="submit" class="button"><?php esc_html_e( 'Register', 'nook-furniture' ); ?></button>
        </form>

        <p class="auth-note">
          <?php esc_html_e( 'Already have an account?', 'nook-furniture' ); ?>
          <a href="<?php echo esc_url( nook_get_login_page_url() ); ?>">
            <?php esc_html_e( 'Log in here', 'nook-furniture' ); ?>
          </a>
        </p>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer();
