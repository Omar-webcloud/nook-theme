<?php
$paged = get_query_var( 'paged', 1 );
$products_query = new WP_Query( [
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'posts_per_page' => 12,
    'paged'          => $paged,
] );
?>

<?php if ( $products_query->have_posts() ) : ?>
  <?php while ( $products_query->have_posts() ) : $products_query->the_post();
    $product_price = function_exists( 'get_field' ) ? get_field( 'product_price' ) : '';
    ?>
    <a class="product-card" href="<?php the_permalink(); ?>">
      <?php if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail( 'medium' ); ?>
      <?php endif; ?>
      <h3><?php the_title(); ?></h3>
      <?php if ( $product_price ) : ?>
        <p class="price"><?php echo esc_html( $product_price ); ?></p>
      <?php endif; ?>
    </a>
  <?php endwhile; ?>

  <div class="products-pagination">
    <?php
    echo paginate_links( [
        'total'   => $products_query->max_num_pages,
        'current' => $paged,
    ] );
    ?>
  </div>
<?php else : ?>
  <p><?php esc_html_e( 'No products found.', 'nook-furniture' ); ?></p>
<?php endif; ?>

<?php wp_reset_postdata(); ?>