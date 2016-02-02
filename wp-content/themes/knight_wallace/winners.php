<?php
/**
 * Template Name: Winners
 *
 * @package knight_wallace
 */

get_header('livingston'); ?>

<?php 
include_once('helpers.php');
//grab our junk
$alerts = get_posts(array('category_name'=>'alert'));
$winners = get_posts(array('post_type'=>'person_livingston','posts_per_page'=>200));
$sorted_winners = sort_winners($winners);
?>

<main id="main" class="posts">
<div class="row">
    <div class="large-12 columns">
        <h1 class="text-center">Winners</h1>
    </div>
</div>

</main>

<?php 
//display alerts
if(!empty($alerts)):
?>
<section id="alerts">
<?php foreach($alerts as $alert): ?>
<div class="row alert">
  <div class="large-4 columns">
    <p>
    <strong><?php echo $alert->post_title; ?></strong>
      <br /><?php echo $alert->post_excerpt; ?></p>
  </div>
  <div class="large-8 columns">
  <p><?php echo $alert->post_content; ?></p>
  </div>
</div>
<?php endforeach; ?>
</section>
<?php endif; ?>


<?php get_footer('livingston'); ?>
