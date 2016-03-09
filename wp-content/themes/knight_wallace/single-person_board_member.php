<?php
/**
 * The template for displaying single board memeber.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package knight_wallace
 */

get_header('fellows'); ?>
<section class="breadcrumb">
<div class="row">
    <div class="small-6 columns">
        <a href="/knight-wallace-fellowships/board-members/" class="link">&nbsp;All Board Members</a>
    </div>
</div>
</section>
<main id="main" class="site-main post-main" role="main">
<div class="row">
    <div class="large-10 columns large-centered">
        <h1 class="entry-title text-center">Board of Directors</h1>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'board_member' ); ?>

		<?php endwhile; // End of the loop. ?>
    </div>
</div>
</main><!-- #main -->

<?php get_footer('fellows'); ?>
