<footer>
  <div class="footer">
    <div class="about">
      <div class="info">
        <div class="footer-logo">
          <?php 
          $footer_logo = nook_get('footer_logo');
          if ( $footer_logo ) : ?>
            <img src="<?php echo esc_url( $footer_logo ); ?>" alt="<?php bloginfo('name'); ?>" />
          <?php else : ?>
            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/footer-logo.svg" alt="<?php bloginfo('name'); ?>" />
          <?php endif; ?>
        </div>
        <p><?php echo esc_html( nook_get( 'footer_description', 'Custom furniture for minimalist life. We make beautiful design and sustainable furniture in country' ) ); ?></p>
        <div class="social">
          <?php
          $socials = nook_get( 'footer_socials' );
          if ( $socials ) :
            foreach ( $socials as $s ) :
            ?>
              <a href="<?php echo esc_url( $s['link'] ); ?>">
                <?php if ( strpos( $s['icon'], 'fa-' ) !== false ) : ?>
                  <i class="<?php echo esc_attr( $s['icon'] ); ?>"></i>
                <?php else : ?>
                  <i><img src="<?php echo esc_url( $s['icon'] ); ?>" alt="Social"></i>
                <?php endif; ?>
              </a>
            <?php endforeach; ?>
          <?php else : ?>
            <i class="fa-brands fa-facebook-f"></i>
            <i><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/insta.svg" alt="Instagram"></i>
            <i class="fa-brands fa-twitter"></i>
          <?php endif; ?>
        </div>
      </div>

      <div class="links">
        <?php
        $footer_links = nook_get( 'footer_links' );
        if ( $footer_links ) :
          foreach ( $footer_links as $column ) :
          ?>
            <div>
              <?php foreach ( $column['links'] as $link ) : ?>
                <p><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['label'] ); ?></a></p>
              <?php endforeach; ?>
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <div>
            <p>About Us</p>
            <p>Reviews</p>
            <p>Financing</p>
            <p>Blog</p>
            <p>Contact Us</p>
          </div>
          <div>
            <p>FAQ</p>
            <p>Careers</p>
            <p>Return</p>
            <p>Shipping</p>
          </div>
        <?php endif; ?>
      </div>

      <div class="msg">
        <h2><?php echo esc_html( nook_get( 'footer_consultation_heading', 'Free consultation for your furniture?' ) ); ?></h2>
        <a href="<?php echo esc_url( nook_get( 'footer_consultation_link', '#' ) ); ?>">
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/phone.png" alt="" /> <?php echo esc_html( nook_get( 'footer_consultation_text', "Let's talk" ) ); ?>
        </a>
      </div>
    </div>

    <div class="line-2"></div>
    <div class="bottom">
      <p><?php echo esc_html( nook_get( 'footer_copyright', 'Nook2024 @ All Rights Reserved' ) ); ?></p>
      <div class="bottom-links">
        <?php
        $bottom_links = nook_get( 'footer_bottom_links' );
        if ( $bottom_links ) :
          foreach ( $bottom_links as $link ) :
          ?>
            <p><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['label'] ); ?></a></p>
          <?php endforeach; ?>
        <?php else : ?>
          <p>Cookies Policy</p>
          <p>Privacy Policy</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
