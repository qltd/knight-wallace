<?php
/**
 * The template for displaying all single livingston award winners.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package knight_wallace
 */

get_header('livingston'); ?>
<section class="breadcrumb">
<div class="row">
    <div class="small-6 columns">
        <a href="/livingston-awards/winners/" class="link">&nbsp;All Winners</a>
    </div>
</div>
</section>
<main id="main" class="site-main post-main" role="main">
<div class="row">
    <div class="large-12 columns">
        <h1 class="text-center">Winner or Finalist</h1>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'person_livingston' ); ?>

		<?php endwhile; // End of the loop. ?>
    </div>
</div>

</main><!-- #main -->

<?php get_footer('livingston'); ?>
