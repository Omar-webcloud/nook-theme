<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article class="product-detail">
    <div class="product-detail__hero">
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="product-detail__image"><?php the_post_thumbnail( 'large' ); ?></div>
      <?php endif; ?>

      <div class="product-detail__summary">
        <h1><?php the_title(); ?></h1>

        <?php if ( function_exists( 'get_field' ) ) : ?>
          <?php if ( $price = get_field( 'product_price' ) ) : ?>
            <p class="product-price"><?php echo esc_html( $price ); ?></p>
          <?php endif; ?>

          <?php if ( $sku = get_field( 'product_sku' ) ) : ?>
            <p class="product-sku"><?php echo esc_html( $sku ); ?></p>
          <?php endif; ?>

          <?php if ( $details = get_field( 'product_details' ) ) : ?>
            <div class="product-extra"><?php echo wp_kses_post( $details ); ?></div>
          <?php endif; ?>
        <?php endif; ?>

        <a href="#" class="add-to-cart" data-product-id="<?php the_ID(); ?>">Add to Cart</a>
      </div>
    </div>

    <div class="product-detail__content">
      <?php the_content(); ?>
    </div>
  </article>
<?php endwhile; endif; ?>