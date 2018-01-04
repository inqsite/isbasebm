<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package isbase
 */

?>
  <!DOCTYPE html>
  <html <?php language_attributes(); ?>>

  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>

  </head>

  <body <?php body_class(); ?>>
    <div id="page" class="site">
      <a class="skip-link screen-reader-text" href="#content">
        <?php esc_html_e( 'Skip to content', 'isbase' ); ?>
      </a>

      <header id="masthead" class="site-header z-depth-2" role="banner">
        <div class="site-branding container">

          <?php
			if ( is_front_page() && is_home() ) : ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php else : ?>
              <p class="site-title">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                  <?php bloginfo( 'name' ); ?>
                </a>
              </p>
              <?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
                <p class="site-description">
                  <?php echo $description; /* WPCS: xss ok. */ ?>
                </p>
                <?php
			endif; ?>
        </div>

        <!-- .site-branding -->
        <div class="navbar navbar-info" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <?php wp_nav_menu( array('theme_location' => 'primary',
          'menu_class' => 'nav navbar-nav',
          'container_class' => 'navbar-collapse collapse',
          'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
          'walker' => new wp_bootstrap_navwalker()
    ) );?>
          </div>
          <!-- /.container -->
        </div>
        <!-- /.navbar -->
        <!-- #site-navigation -->
      </header>
      <!-- #masthead -->
      <div class="container">
        <div id="content" class="row site-content">