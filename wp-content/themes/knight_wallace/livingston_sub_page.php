<?php
/**
 * Template Name: Livingston Sub Page
 *
 * @package knight_wallace
 */

get_header('livingston'); ?>

<?php 
$parent_id = get_post_ancestors($post->ID); 
$parent = !empty($parent_id) ? get_post($parent_id[0]) : false;
?>

<?php if(!empty($parent)): ?>
<section class="breadcrumb">
<div class="row">
    <div class="small-6 columns">
    <a href="<?php echo !empty($parent->guid) ? $parent->guid : ''; ?>" class="breadcrumb-link">
        <?php echo !empty($parent->post_title) ? $parent->post_title : ''; ?>
    </a>
    </div>
</div>
</section>
<?php endif; ?>
  <main class="livingston-sub-page">
    <div class="row">
      <div class="large-12 columns">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'template-parts/content', 'page' ); ?>
    <?php endwhile; // End of the loop. ?>
      </div>
    </div>
  </main>
<?php get_footer('livingston'); ?>
