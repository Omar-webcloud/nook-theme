<?php
/**
 * Custom AJAX Cart Handler
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// 1. Start Session if not already started
function nook_start_session() {
    if ( ! session_id() ) {
        session_start();
    }
}
add_action( 'init', 'nook_start_session', 1 );

function nook_cart_requires_login() {
    wp_send_json_error( [
        'message'      => __( 'Please log in to use the cart.', 'nook-furniture' ),
        'login_url'    => nook_get_login_page_url(),
        'cart_html'    => '<p class="empty-cart">' . esc_html__( 'Please log in to use the cart.', 'nook-furniture' ) . '</p>',
        'cart_total'   => '$0.00',
        'cart_count'   => 0,
        'requiresAuth' => true,
    ], 401 );
}

function nook_clear_cart_on_logout() {
    unset( $_SESSION['nook_cart'] );
}
add_action( 'wp_logout', 'nook_clear_cart_on_logout' );

// 2. AJAX Add to Cart Handler
function nook_ajax_add_to_cart() {
    $product_id = isset( $_POST['product_id'] ) ? intval( $_POST['product_id'] ) : 0;
    
    if ( ! $product_id ) {
        wp_send_json_error( [ 'message' => 'Invalid Product ID' ] );
    }

    if ( ! isset( $_SESSION['nook_cart'] ) ) {
        $_SESSION['nook_cart'] = [];
    }

    // Check if product already in cart
    if ( isset( $_SESSION['nook_cart'][$product_id] ) ) {
        $_SESSION['nook_cart'][$product_id]['quantity'] += 1;
    } else {
        $product_post = get_post( $product_id );
        if ( ! $product_post ) {
            wp_send_json_error( [ 'message' => 'Product not found' ] );
        }

        $price = get_field( 'product_price', $product_id );
        $image = get_the_post_thumbnail_url( $product_id, 'thumbnail' );

        $_SESSION['nook_cart'][$product_id] = [
            'id'       => $product_id,
            'title'    => $product_post->post_title,
            'price'    => $price,
            'image'    => $image,
            'quantity' => 1,
        ];
    }

    $cart_html = nook_get_cart_html();
    $cart_total = nook_get_cart_total();

    wp_send_json_success( [
        'cart_html'  => $cart_html,
        'cart_total' => $cart_total,
        'cart_count' => nook_get_cart_count(),
    ] );
}
add_action( 'wp_ajax_nook_add_to_cart', 'nook_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_nook_add_to_cart', 'nook_cart_requires_login' );

// 3. Helper function to get cart HTML
function nook_get_cart_html() {
    if ( ! is_user_logged_in() ) {
        return '<p class="empty-cart">' . esc_html__( 'Please log in to use the cart.', 'nook-furniture' ) . '</p>';
    }

    $cart = isset( $_SESSION['nook_cart'] ) ? $_SESSION['nook_cart'] : [];
    
    if ( empty( $cart ) ) {
        return '<p class="empty-cart">Your cart is empty.</p>';
    }

    ob_start();
    foreach ( $cart as $item ) : ?>
        <div class="cart-item" data-id="<?php echo esc_attr( $item['id'] ); ?>">
            <div class="cart-item__image">
                <img src="<?php echo esc_url( $item['image'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>">
            </div>
            <div class="cart-item__details">
                <h4><?php echo esc_html( $item['title'] ); ?></h4>
                <p class="cart-item__price"><?php echo esc_html( $item['price'] ); ?> x <?php echo esc_html( $item['quantity'] ); ?></p>
            </div>
            <button class="remove-item" data-id="<?php echo esc_attr( $item['id'] ); ?>">&times;</button>
        </div>
    <?php endforeach;
    return ob_get_clean();
}

// 4. Helper function to get cart total
function nook_get_cart_total() {
    if ( ! is_user_logged_in() ) {
        return '$0.00';
    }

    $cart = isset( $_SESSION['nook_cart'] ) ? $_SESSION['nook_cart'] : [];
    $total = 0;
    foreach ( $cart as $item ) {
        // Strip non-numeric characters from price (e.g. "$120" -> 120)
        $price = floatval( preg_replace( '/[^0-9.]/', '', $item['price'] ) );
        $total += $price * $item['quantity'];
    }
    return '$' . number_format( $total, 2 );
}

// 5. Helper function to get cart count
function nook_get_cart_count() {
    if ( ! is_user_logged_in() ) {
        return 0;
    }

    $cart = isset( $_SESSION['nook_cart'] ) ? $_SESSION['nook_cart'] : [];
    $count = 0;
    foreach ( $cart as $item ) {
        $count += $item['quantity'];
    }
    return $count;
}

// 6. AJAX Remove from Cart Handler
function nook_ajax_remove_from_cart() {
    $product_id = isset( $_POST['product_id'] ) ? intval( $_POST['product_id'] ) : 0;
    
    if ( $product_id && isset( $_SESSION['nook_cart'][$product_id] ) ) {
        unset( $_SESSION['nook_cart'][$product_id] );
    }

    wp_send_json_success( [
        'cart_html'  => nook_get_cart_html(),
        'cart_total' => nook_get_cart_total(),
        'cart_count' => nook_get_cart_count(),
    ] );
}
add_action( 'wp_ajax_nook_remove_from_cart', 'nook_ajax_remove_from_cart' );
add_action( 'wp_ajax_nopriv_nook_remove_from_cart', 'nook_cart_requires_login' );

// 7. Initial Cart Load AJAX
function nook_ajax_get_cart() {
    wp_send_json_success( [
        'cart_html'  => nook_get_cart_html(),
        'cart_total' => nook_get_cart_total(),
        'cart_count' => nook_get_cart_count(),
    ] );
}
add_action( 'wp_ajax_nook_get_cart', 'nook_ajax_get_cart' );
add_action( 'wp_ajax_nopriv_nook_get_cart', 'nook_cart_requires_login' );
