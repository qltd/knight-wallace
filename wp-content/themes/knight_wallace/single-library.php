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
        <a href="/wallace-house/library/" class="library-link">&nbsp;All Library Items</a>
    </div>
    <div class="small-6 columns text-right">
        <p class="share-wrap">Share:
            <a href="https://twitter.com/intent/tweet?text=<?php urlencode(the_title()); ?> http://<?php echo urlencode($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="http://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="mailto:?subject=[Shared from wallacehouse.umich.edu] <?php the_title();?>&body=<?php the_permalink();?>"><i class="fa fa-envelope"></i></a>
        </p>
    </div>
</div>
</section>
<main id="main" class="site-main post-main" role="main">
<div class="row">
    <div class="large-12 columns">
        <h1 class="entry-title text-center">Library</h1>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'library_item' ); ?>

		<?php endwhile; // End of the loop. ?>
    </div>
</div>

</main><!-- #main -->

<?php get_footer(); ?>
