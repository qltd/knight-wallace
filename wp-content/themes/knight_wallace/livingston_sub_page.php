<?php
/**
 * Template Name: Livingston Sub Page
 *
 * @package knight_wallace
 */

get_header('livingston'); ?>
  <main class="livingston-sub-page">
    <div class="row">
      <div class="large-12 columns">

    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'template-parts/content', 'page' ); ?>

    <?php endwhile; // End of the loop. ?>
      </div>
    </div>
  </main>
<?php get_footer('livingston'); ?>
