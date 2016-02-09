<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package knight_wallace
 */

?>

<?php
$image = get_the_post_thumbnail();
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
    <div class="large-10 large-centered columns">
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->
    </div>
</div>
<?php $children = get_pages('child_of='.$post->ID.'&parent='.$post->ID); ?>
<?php if(!empty($children)): ?>
<div class="in-this-section-nav">
    <div class="row">
        <div class="large-12 columns">
            <ul class="inline">
            <?php $c = 0; ?>
            <?php $count = count($children); ?>
            <?php foreach($children as $child): ?>
                <li><a href="<?php echo $child->guid; ?>"><?php echo $child->post_title; ?></a> 
                <?php if($c < $count - 1): ?>
                    &nbsp;|&nbsp; 
                <?php endif; ?>
                </li>
            <?php $c += 1; ?>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <div class="large-10 large-centered columns">
        <div class="content">
            <?php the_content(); ?>
        </div>
    </div>
</div>

</article><!-- #post-## -->

