<?php
/**
 * Template Name: Fellows Sub Page 
 *
 *
 * @package knight_wallace
 */

get_header('fellows'); ?>

<?php 
include_once('helpers.php');
$parent_id = get_post_ancestors($post->ID); 
$parent = !empty($parent_id) ? get_post($parent_id[0]) : false;
//get fellows
$fellows = get_posts(array('post_type'=>'person_kw_fellow','posts_per_page'=> -1));

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
  <main class="fellows-sub-page alum-locate">
    <div class="row">
      <div class="large-12 columns">

      </div>
    </div>
  </main>
<?php get_footer('fellows'); ?>
