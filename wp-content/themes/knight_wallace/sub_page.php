<?php
/**
 * Template Name: Default (Wallace House) Sub Page
 *
 * @package knight_wallace
 */

get_header(); ?>

  <main class="wallace-house-subpage">
    <div class="row">
      <div class="large-12 columns">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'template-parts/content', 'page' ); ?>
    <?php endwhile; // End of the loop. ?>
      </div>
    </div>
  </main>
<?php get_footer(); ?>
