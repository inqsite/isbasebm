<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package isbase
 */

?>

  </div>
  <!-- #content -->
  </div>

  <footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-info container">
      <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'isbase' ) ); ?>">
        <?php printf( esc_html__( 'Proudly powered by %s', 'isbase' ), 'WordPress' ); ?>
      </a>
      <span class="sep"> | </span>
      <?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'isbase' ), 'isbase', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?>
    </div>
    <!-- .site-info -->
  </footer>
  <!-- #colophon -->
  </div>
  <!-- #page -->

  <?php wp_footer(); ?>

    </body>

    </html>