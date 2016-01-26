<?php
/**
 * Template part for displaying single fellows.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package knight_wallace
 */

?>

<?php 
$image = get_the_post_thumbnail();
$pmeta = get_post_meta($post->ID); 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="row">
<?php if(!empty($image)): ?>
    <div class="large-6 columns">
        <div class="featured-image-wrap">
            <?php echo $image; ?>
        </div>
    </div>
<?php endif; ?>
    <div class="large-6 columns">
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->
        <div class="content">
            <p class="title">
<?php echo !empty($pmeta['_person_board_member_title']) ? $pmeta['_person_board_member_title'][0] : ''; ?>,&nbsp;
<?php echo !empty($pmeta['_person_board_member_ass']) ? $pmeta['_person_board_member_ass'][0] : ''; ?>
            </p>
            <p class="bio">
<?php echo !empty($pmeta['_person_board_member_bio']) ? $pmeta['_person_board_member_bio'][0] : ''; ?>&nbsp;
            </p>
        </div>
        <footer class="entry-footer">
            <?php knight_wallace_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    </div>
</div>


</article><!-- #post-## -->

