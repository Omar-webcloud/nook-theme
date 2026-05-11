<?php get_header(); ?>

<main>
  <section class="popular">
    <h2><?php post_type_archive_title(); ?></h2>

    <div class="collection-tag">
      <p class="active">Sofa</p>
      <p>Table</p>
      <p>Chair</p>
      <p>Accessories</p>
    </div>

    <div class="products">
      <?php get_template_part( 'templates/parts/product', 'loop' ); ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
