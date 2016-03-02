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
<div class="row">
    <div class="large-10 columns large-centered">
        <header class="entry-header">
            <?php the_title( '<h2 class="entry-sub-title">', '</h2>' ); ?>
<?php if(!empty($pmeta['tagline'])): ?>
            <p class="tagline">
                 <?php echo $pmeta['tagline'][0]; ?>
            </p>
<?php endif; ?>
<?php if(!empty($pmeta['Author'])): ?>
            <p class="author">
              <?php echo $pmeta['Author'][0]; ?>
            </p>
<?php endif; ?>
            <div class="entry-meta">
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->
            <?php if(!empty($tags)):?>
            <div class="tags-list inline">
                <ul>
                    <?php foreach($tags as $tag): ?>
                    <li><a href="/tag/<?php echo $tag->name; ?>/"><?php echo $tag->name; ?></a> <span class="divider">|</span></li>
                    <?php endforeach; ?>
                </ul>
                <br />
            </div>
            <?php endif; ?>
        <div class="entry-content">
            <?php the_content(); ?>
        </div><!-- .entry-content -->
    </div>
</div>
</article><!-- #post-## -->

