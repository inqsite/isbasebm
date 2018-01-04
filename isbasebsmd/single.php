<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package isbase
 */

get_header(); ?>

  <div id="primary" class="content-area col-sm-9">
    <main id="main" class="site-main" role="main">

      <?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() ); ?>

        <ul class="pager">
          <li class="previous">
            <?php previous_post_link('%link','<i class="fa fa-arrow-circle-left" aria-hidden="true"></i> %title'); ?>
          </li>
          <li class="next">
            <?php next_post_link('%link','%title <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>'); ?>
          </li>
        </ul>
        <?php // If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

    </main>
    <!-- #main -->
  </div>
  <!-- #primary -->

  <?php
get_sidebar();
get_footer();