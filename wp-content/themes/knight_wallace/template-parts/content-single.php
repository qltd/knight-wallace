<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package knight_wallace
 */

?>

<?php 
$image = get_the_post_thumbnail();
$pmeta = get_post_meta($post->ID); 
$tags = get_the_tags($post->ID);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if(!empty($image)): ?>
<div class="row">
    <div class="large-10 columns">
        <div class="featured-image-wrap">
            <?php echo $image; ?>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <div class="large-10 columns">
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
<?php if(!empty($pmeta['tagline'])): ?>
            <p class="tagline">
                 <?php echo $pmeta['tagline'][0]; ?>
            </p>
<?php endif; ?>
<?php if(!empty($pmeta['author'])): ?>
            <p class="author">
               by <?php echo $pmeta['author'][0]; ?>
            </p>
<?php endif; ?>
            <div class="entry-meta">
                <?php knight_wallace_posted_on(); ?>
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->
            <?php if(!empty($tags)):?>
            <p class="tags">
                <?php foreach($tags as $tag): ?>
                    <a href="/tag/<?php echo $tag->name; ?>/" class="tag"><?php echo $tag->name; ?></a>
                <?php endforeach; ?>
            </p>
            <?php endif; ?>
        <div class="entry-content">
            <?php the_content(); ?>
        </div><!-- .entry-content -->
    </div>
</div>
</article><!-- #post-## -->

