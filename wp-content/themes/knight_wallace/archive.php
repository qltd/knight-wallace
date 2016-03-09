<?php
/**
 * The template for displaying archive pages.
 * this page also displays tag results
 *
 *
 */

get_header(); ?>

<?php include_once "helpers.php"; ?>
<div class="row">
    <div class="large-12 columns">
        <h1 class="page-title entry-title text-center"></h1>
    </div>
</div>
<section class="archive-list content">

<div class="row">
    <div class="large-12 columns">

<section class="story-list news">
		<?php if ( have_posts() ) : ?>
    <?php $count = 2;?>
    <div class="row">
			<?php while ( have_posts() ) : the_post(); ?>
        <div class="large-6 columns">
            <?php $tags = get_the_tags($post->ID); ?>
            <div class="row news snippet-box">
                <div class="large-12 columns">
                    <div class="news-article">
                        <div class="text">
                            <h4><a href="<?php echo $post->guid; ?>"><?php echo $post->post_title; ?></a></h4>
                        <?php $nmeta = get_post_meta($post->ID); ?>
                        <?php if(!empty($nmeta['Author'])): ?>
                            <div class="date"><?php echo $nmeta['Author'][0]; ?></div>
                        <?php endif; ?>
                            <div class="tags-list">
                                <ul>
                                    <?php if(!empty($tags)):?>
                                    <?php foreach($tags as $tag): ?>
                                    <li><a href="/tag/<?php echo replace_space($tag->name,"-"); ?>/"><?php echo $tag->name; ?></a> <span class="divider">|</span></li>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if($count % 2 != 0): ?>
        </div><!--close row-->
        <div class="row"><!--start a new row-->
        <?php endif; ?>
        <?php $count += 1; ?>
			<?php endwhile; ?>
    </div>
			<?php the_posts_navigation(); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
</section>
    </div>
</div>

</section>
<?php get_footer(); ?>
