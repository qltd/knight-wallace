<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package knight_wallace
 */

get_header(); ?>

<section class="breadcrumb">
<div class="row">
    <div class="small-6 columns">
<?php $cat = get_the_category(); ?>
<?php if(!empty($cat[0]->name) && $cat[0]->name == 'Events'): ?>
        <a href="/wallace-house/events/" class="library-link">&nbsp;All Events</a>
<?php else: ?>
        <a href="/wallace-house/news/" class="library-link">&nbsp;All News</a>
<?php endif;  ?>
    </div>
    <?php get_template_part('template-parts/share'); ?>
</div>
</section>
<main id="main" class="site-main post-main content" role="main">
<div class="row">
    <div class="large-12 columns">
<?php if(!empty($cat[0]->name) && $cat[0]->name == 'Events'): ?>
        <h1 class="entry-title text-center">Events</h1>
<?php else: ?>
        <!-- <h1 class="entry-title text-center">News</h1> -->
<?php endif;  ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>

		<?php endwhile; // End of the loop. ?>
    </div>
</div>

</main><!-- #main -->

<?php get_footer(); ?>
