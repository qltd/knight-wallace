<?php
/**
 * Template part for displaying single library items.
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
    <div class="large-6 columns">
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            <p class="author-name">By: <?php echo !empty($pmeta['_library_author']) ? $pmeta['_library_author'][0] : ''; ?></p>
            <p class="publisher"><?php echo !empty($pmeta['_library_publisher']) ? $pmeta['_library_publisher'][0] : '';?></p>
            <?php if(!empty($tags)):?>
            <p class="tags">
                <?php foreach($tags as $tag): ?>
                    <a href="/tag/<?php echo $tag->name; ?>/" class="tag"><?php echo $tag->name; ?></a>
                <?php endforeach; ?>
            </p>
            <?php endif; ?>
        </header><!-- .entry-header -->
    </div>
</div>
<div class="row">
<?php if(!empty($image)): ?>
    <div class="large-6 columns">
        <div class="featured-image-wrap">
            <?php echo $image; ?>
        </div>
    </div>
<?php endif; ?>
    <div class="large-6 columns">
        <div class="entry-content">
            <?php the_content(); ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'knight_wallace' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div><!-- .entry-content -->
        <footer class="entry-footer">
            <?php knight_wallace_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    </div>
</div>


</article><!-- #post-## -->

