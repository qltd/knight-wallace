<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package knight_wallace
 */

get_header(); ?>

<main id="main" class="site-main post-main content" role="main">

<div class="row">
    <div class="large-12 columns">
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title entry-title text-center"><?php printf( esc_html__( 'Search Results for: %s', 'knight_wallace' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php while ( have_posts() ) : the_post(); ?>
           <div class="row search-result">
               <div class="large-10 columns large-centered">
                    <?php get_template_part( 'template-parts/content', 'search' ); ?>
                </div>
            </div>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
    </div>
</div>
		</main><!-- #main -->

<?php get_footer(); ?>
