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
$winners = get_posts(array('post_type'=>'person_livingston','posts_per_page'=> -1));
$sorted_winners = sort_winners($winners);
?>
<div class="row">
    <div class="large-12 columns">
        <h1 class="entry-title">Winners</h1>
    </div>
</div>
<div class="row">
    <div class="large-12 columns">
        <p class="text-center"><a href="/livingston-awards/winners/past-winners/">See Past Winners</a></p>
    </div>
</div>
<main class="posts winners-list">
<?php if(!empty($sorted_winners)): ?>
<?php foreach($sorted_winners as $win): ?>
<div class="row">
    <div class="large-10 large-centered columns">
        <div class="la-winner">
            <div class="type"><?php echo $win['type']; ?></div>
            <div class="name"><?php echo $win['first_name'].' '.$win['last_name'].', '.$win['age']; ?></div>
            <div class="lib-item"><a href="<?php echo $win['library_link']; ?>">&ldquo;<?php echo $win['lib']; ?>&rdquo;</a></div>
            <div class="aff"><?php echo $win['aff']?></div>
            <div class="image"><?php echo $win['library_image']; ?></div>
            <div class="descrip"><?php echo $win['lib_item_des']; ?></div>
            <div class="row winner-quote">
                <div class="large-2 columns">
                    <div class="a-image"><?php echo $win['image']; ?></div>
                    <div class="small-name"><?php echo $win['first_name'].' '.$win['last_name'].', '.$win['age']; ?></div>
                </div>
                <div class="large-10 columns quote"><?php echo $win['winner_quote']; ?></div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>
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
