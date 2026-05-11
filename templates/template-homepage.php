
/**
 * Template Name: Homepage

 */

<?php get_header(); ?>

<main>

  <!-- ═══════════════════════════════════════
       HERO SECTION
  ═══════════════════════════════════════ -->
  <section class="hero">
    

    <div class="container">
      <div class="hero__content">
        <h1 class="hero__heading">
          <?php echo esc_html( nook_get( 'hero_heading', 'Make your environment minimalistic and futuristic' ) ); ?>
        </h1>
        <p class="hero__paragragph">
          <?php echo esc_html( nook_get( 'hero_paragraph', "Transform your closets into functional works of art with closet creations' custom design solutions." ) ); ?>
        </p>
      </div>

      <div class="hero__products">
        <!-- Left card -->
        <div class="hero__product-card">
          <img class="hero__product-image" src="<?php echo esc_url( nook_get( 'hero_left_image', get_template_directory_uri() . '/assets/images/vintage-desk.png' ) ); ?>" alt="<?php echo esc_attr( nook_get( 'hero_left_title', 'Vintage Desk Accessories 2024' ) ); ?>" />
          <div class="card__content">
            <h3 class="card__heading card__heading-left">
              <?php echo nl2br( esc_html( nook_get( 'hero_left_title', "Vintage Desk \nAccessories 2024" ) ) ); ?>
            </h3>
            <div class="card__icon-container">
              <img class="card__icon" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/play-btn.png" alt="" />
            </div>
          </div>
        </div>

        <!-- Main centre piece -->
        <div class="hero__product-main">
          <img class="product__logo" src="<?php echo esc_url( nook_get( 'hero_center_badge', get_template_directory_uri() . '/assets/images/badge.png' ) ); ?>" alt="Featured furniture" />
          <div>
            <img class="product__main-image" src="<?php echo esc_url( nook_get( 'hero_center_image', get_template_directory_uri() . '/assets/images/banner-main.png' ) ); ?>" alt="Featured Product" />
          </div>
        </div>

        <!-- Right card -->
        <div class="hero__product-card">
          <img class="hero__product-image card__image-right" src="<?php echo esc_url( nook_get( 'hero_right_image', get_template_directory_uri() . '/assets/images/Minimal-tulip.png' ) ); ?>" alt="<?php echo esc_attr( nook_get( 'hero_right_title', 'Minimal Tulip Chair 2024' ) ); ?>" />
          <div class="card__content">
            <h3 class="card__heading card__heading-right">
              <?php echo nl2br( esc_html( nook_get( 'hero_right_title', "Minimal Tulip \nChair 2024" ) ) ); ?>
            </h3>
            <div class="card__icon-container">
              <img class="card__icon" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/play-btn.png" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════
       MARQUEE
  ═══════════════════════════════════════ -->
  <div class="marquee-container">
    <?php for ( $i = 0; $i < 2; $i++ ) : ?>
    <div class="marquee-content">
      <?php
      $items = nook_get( 'marquee_items' );
      if ( $items ) :
        foreach ( $items as $item ) :
        ?>
          <span>
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/Subtract.svg" alt="" />
            <?php echo esc_html( $item['text'] ); ?>
          </span>
        <?php endforeach; ?>
      <?php else : 
        $default_items = [ 'Woak Table', 'Organic Fabric', 'Vintage Metal', 'Modern Chair', 'Mapple Shelf', 'Woak Table', 'Organic Fabric', 'Vintage Metal', 'Modern Chair', 'Mapple Shelf' ];
        foreach ( $default_items as $item ) :
        ?>
          <span>
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/Subtract.svg" alt="" />
            <?php echo esc_html( $item ); ?>
          </span>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
    <?php endfor; ?>
  </div>

  <div class="line"></div>

  <!-- ═══════════════════════════════════════
       PRODUCT SCROLL (SWIPER)
  ═══════════════════════════════════════ -->
  <section class="product-scroll">
    <div class="silder">
      <button class="leftClick">&lt;</button>
      Scroll
      <button class="rightClick">&gt;</button>
    </div>

    <div class="swiper horizontal-scroll">
      <div class="swiper-wrapper">
        <?php
        $slides = nook_get( 'product_slides' );
        if ( $slides ) :
          foreach ( $slides as $slide ) :
          ?>
          <div class="swiper-slide">
            <div class="text-box"><?php echo esc_html( $slide['label'] ); ?></div>
            <img src="<?php echo esc_url( $slide['image'] ); ?>" alt="<?php echo esc_attr( $slide['label'] ); ?>" />
          </div>
          <?php endforeach; ?>
        <?php else : 
          $default_slides = [
              [ 'label' => 'Sofa',        'img' => 'sofa.jpg' ],
              [ 'label' => 'Chairs',      'img' => 'chair.jpg' ],
              [ 'label' => 'Accessories', 'img' => 'accessories.jpg' ],
              [ 'label' => 'Table',       'img' => 'chair.jpg' ],
              [ 'label' => 'Sofa',        'img' => 'sofa.jpg' ],
          ];
          foreach ( $default_slides as $slide ) :
          ?>
          <div class="swiper-slide">
            <div class="text-box"><?php echo esc_html( $slide['label'] ); ?></div>
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/<?php echo esc_attr( $slide['img'] ); ?>" alt="<?php echo esc_attr( $slide['label'] ); ?>" />
          </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════
       POPULAR COLLECTION
  ═══════════════════════════════════════ -->
  <section class="popular">
    <h2><?php echo esc_html( nook_get( 'popular_title', 'Popular Collection' ) ); ?></h2>

    <div class="collection-tag">
      <?php 
      $categories = nook_get( 'popular_categories' );
      if ( $categories ) :
        foreach ( $categories as $index => $cat ) : ?>
          <p class="<?php echo $index === 0 ? 'active' : ''; ?>"><?php echo esc_html( $cat['name'] ); ?></p>
        <?php endforeach;
      else : ?>
        <p class="active">Sofa</p>
        <p>Table</p>
        <p>Chair</p>
        <p>Accessories</p>
      <?php endif; ?>
    </div>

    <div class="products">
      <?php
      $popular_products_query = new WP_Query( [
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => 8,
      ] );

      if ( $popular_products_query->have_posts() ) :
        while ( $popular_products_query->have_posts() ) : $popular_products_query->the_post();
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
        <?php endwhile; wp_reset_postdata(); ?>
      <?php else :
        $products = nook_get( 'popular_products' );
        if ( $products ) :
          foreach ( $products as $p ) : ?>
            <div class="product-card">
              <img src="<?php echo esc_url( $p['image'] ); ?>" alt="<?php echo esc_attr( $p['name'] ); ?>" />
              <h3><?php echo esc_html( $p['name'] ); ?></h3>
              <p class="price"><?php echo esc_html( $p['price'] ); ?></p>
            </div>
          <?php endforeach;
        else :
          $default_products = [
              [ 'img' => 'sofa_1.png',   'name' => 'Vintage Single Sofa 2024', 'price' => 'Tk 18,500' ],
              [ 'img' => 'chair_1.png',  'name' => 'Classic Dining Chair 2024', 'price' => 'Tk 18,000' ],
              [ 'img' => 'chair_2.png',  'name' => 'Modern Lounge Chair 2024',  'price' => 'Tk 18,000' ],
              [ 'img' => 'sofa_1.png',   'name' => 'Premium 3-Seat Sofa 2024',  'price' => 'Tk 18,000' ],
              [ 'img' => 'sofa_1.png',   'name' => 'Vintage Single Sofa 2024',  'price' => 'Tk 18,500' ],
              [ 'img' => 'chair_1.png',  'name' => 'Accent Chair 2024',         'price' => 'Tk 18,000' ],
              [ 'img' => 'chair_2.png',  'name' => 'Tulip Chair 2024',          'price' => 'Tk 18,000' ],
              [ 'img' => 'table-1.png',  'name' => 'Oak Coffee Table 2024',     'price' => 'Tk 18,000' ],
          ];
          foreach ( $default_products as $p ) : ?>
            <div class="product-card">
              <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/<?php echo esc_attr( $p['img'] ); ?>" alt="<?php echo esc_attr( $p['name'] ); ?>" />
              <h3><?php echo esc_html( $p['name'] ); ?></h3>
              <p class="price"><?php echo esc_html( $p['price'] ); ?></p>
            </div>
          <?php endforeach;
        endif;
      endif;
      ?>
    </div>

    <div class="see-all">
      <a href="<?php echo esc_url( nook_get( 'popular_see_all_link', get_post_type_archive_link( 'product' ) ) ); ?>" id="see-all-btn">
        <?php echo esc_html( nook_get( 'popular_see_all_text', 'See All Collections' ) ); ?>
        <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/arrow.png" alt="" />
      </a>
    </div>
  </section>

  <!-- ═══════════════════════════════════════
       DESIGN / FUTURA SECTION
  ═══════════════════════════════════════ -->
  <section class="design-container">
    <section class="design">
      <div class="design-inner">
        <div class="left">
          <div class="left-text">
            <h1><?php echo nl2br( esc_html( nook_get( 'design_heading', "Futura designed for\nBetter living" ) ) ); ?></h1>
            <p><?php echo esc_html( nook_get( 'design_paragraph', "Introducing collections of high-quality furniture that bear all the hallmarks of British engineering." ) ); ?></p>
            <span class="link-arrow">
              <a href="<?php echo esc_url( nook_get( 'design_read_more_link', '#' ) ); ?>" class="read-more">
                <?php echo esc_html( nook_get( 'design_read_more_text', 'Read More' ) ); ?>
              </a>
              <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/arrow-up-right.svg" alt="" />
            </span>
          </div>

          <div class="stats">
            <div class="stat">
              <span><?php echo esc_html( nook_get( 'stat_furniture_label', 'Furniture' ) ); ?></span>
              <h3><?php echo esc_html( nook_get( 'stat_furniture', '50+' ) ); ?></h3>
            </div>
            <div class="stat">
              <span><?php echo esc_html( nook_get( 'stat_decor_label', 'Decor' ) ); ?></span>
              <h3><?php echo esc_html( nook_get( 'stat_decor', '20+' ) ); ?></h3>
            </div>
            <div class="stat">
              <span><?php echo esc_html( nook_get( 'stat_finishes_label', 'Finishes' ) ); ?></span>
              <h3><?php echo esc_html( nook_get( 'stat_finishes', '800+' ) ); ?></h3>
            </div>
          </div>
        </div>

        <div class="right">
          <img src="<?php echo esc_url( nook_get( 'design_badge', get_template_directory_uri() . '/assets/images/badge-2.png' ) ); ?>" class="badge" alt="" />
          <div class="grid-img">
            <div class="img img1" style="background-image: url('<?php echo esc_url( nook_get( 'design_image_1', get_template_directory_uri() . '/assets/images/img-content.png' ) ); ?>');"></div>
            <div class="img img2" style="background-image: url('<?php echo esc_url( nook_get( 'design_image_2', get_template_directory_uri() . '/assets/images/img-content.png' ) ); ?>');"></div>
          </div>
        </div>
      </div>
    </section>
  </section>

  <!-- ═══════════════════════════════════════
       WHY US
  ═══════════════════════════════════════ -->
  <section class="why-us">
    <div class="why">
      <h1><?php echo esc_html( nook_get( 'why_us_title', 'Why Us?' ) ); ?></h1>
      <div class="services">
        <?php
        $services = nook_get( 'why_us_services' );
        if ( $services ) :
          foreach ( $services as $s ) :
          ?>
          <div class="service-box">
            <img src="<?php echo esc_url( $s['icon'] ); ?>" alt="<?php echo esc_attr( $s['title'] ); ?>" />
            <h3><?php echo esc_html( $s['title'] ); ?></h3>
            <p><?php echo esc_html( $s['description'] ); ?></p>
          </div>
          <?php endforeach; ?>
        <?php else : ?>
          <div class="service-box">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/call.png" alt="24/7 Support" />
            <h3>24/7 Support</h3>
            <p>Our support team is available around the clock to assist you with any inquiries or issues you may have.</p>
          </div>
          <div class="service-box">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/shipping.png" alt="Free Shipping" />
            <h3>Free Shipping</h3>
            <p>Enjoy free shipping on all orders over Tk 10,000.</p>
          </div>
          <div class="service-box">
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/call.png" alt="24/7 Support" />
            <h3>24/7 Support</h3>
            <p>Our support team is available around the clock to assist you with any inquiries or issues you may have.</p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- ═══════════════════════════════════════
       INSTANT QUOTE CTA
  ═══════════════════════════════════════ -->
  <section class="instant">
    <div class="instant-container">
      <h2><?php echo nl2br( esc_html( nook_get( 'cta_heading', "Get an instant quote for \nyour new office setup!" ) ) ); ?></h2>
      <p><?php echo esc_html( nook_get( 'cta_paragraph', "Do I have consent to record this meeting gain traction, review, nor game-plan?" ) ); ?></p>
      <div class="btn-container">
        <?php 
        $btn1_text = nook_get( 'cta_button_1_text', "Let's Talk" );
        $btn1_link = nook_get( 'cta_button_1_link', '#' );
        $btn1_icon = nook_get( 'cta_button_1_icon', get_template_directory_uri() . '/assets/images/talk.png' );

        $btn2_text = nook_get( 'cta_button_2_text', 'See all Collections' );
        $btn2_link = nook_get( 'cta_button_2_link', get_post_type_archive_link( 'product' ) ?: '#' );
        $btn2_icon = nook_get( 'cta_button_2_icon', get_template_directory_uri() . '/assets/images/white-arrow.png' );
        ?>
        <a href="<?php echo esc_url( $btn1_link ); ?>" class="btn-quote">
          <img src="<?php echo esc_url( $btn1_icon ); ?>" alt="" /> <?php echo esc_html( $btn1_text ); ?>
        </a>
        <a href="<?php echo esc_url( $btn2_link ); ?>" class="btn-contact">
          <?php echo esc_html( $btn2_text ); ?>
          <img src="<?php echo esc_url( $btn2_icon ); ?>" alt="" />
        </a>
      </div>
    </div>
  </section>

</main>



<?php get_footer(); ?>