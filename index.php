<?php
/**
 * The main template file.
 * WordPress requires this file. For the homepage, front-page.php is used.
 */
get_header();
?>

<main style="max-width:1440px;margin:0 auto;padding:80px 70px;">
  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div><?php the_excerpt(); ?></div>
      </article>
    <?php endwhile; ?>
    <?php the_posts_navigation(); ?>
  <?php else : ?>
    <p><?php esc_html_e( 'No content found.', 'nook-furniture' ); ?></p>
  <?php endif; ?>
</main>

<?php get_footer(); ?>
