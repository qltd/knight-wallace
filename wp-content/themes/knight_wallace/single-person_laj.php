<?php
/**
 * The template for displaying all single livingston award judges.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package knight_wallace
 */

get_header('livingston'); ?>
<section class="breadcrumb">
<div class="row">
    <div class="small-6 columns">
        <a href="/livingston-awards/judges/" class="link">All Judges</a>
    </div>
</div>
</section>
<main id="main" class="site-main post-main" role="main">
<div class="row">
    <div class="large-12 columns">
        <h1 class="text-center">Judges</h1>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'laj' ); ?>

		<?php endwhile; // End of the loop. ?>
    </div>
</div>

</main><!-- #main -->

<?php get_footer('livingston'); ?>
