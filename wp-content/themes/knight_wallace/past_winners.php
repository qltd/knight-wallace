<?php
/**
 * Template Name: Past Winners
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

<section id="past_winners_control">
<form id="control_form">
<div class="row">
    <div class="large-4 columns">
        <p class="control-label">Refine by year:</p>
        <?php $year = date('Y'); ?>
        <?php for($i=0;$i<20;$i++): ?>
            <?php $year = $year - 1; ?>
            <input type="checkbox" name="year" value="<?php echo $year; ?>" /><label for="year"><?php echo $year; ?></label>
        <?php endfor; ?>
    </div>
    <div class="large-4 columns">
        <p class="control-label">Refine by award type:</p>
        <input type="checkbox" name="award" value="Local Reporting" /><label for="award">Local Reporting</label>
        <input type="checkbox" name="award" value="National Reporting" /><label for="award">National Reporting</label>
        <input type="checkbox" name="award" value="International Reporting" /><label for="award">International Reporting</label>
        <input type="checkbox" name="award" value="Clurman Award" /><label for="award">Clurman Award</label>
    </div>
    <div class="large-4 columns"></div>
</div>
</form>
</section>
<main class="posts winners-list">
<div class="row">
    <div class="large-12 columns">
        <h1 class="text-center">Winners</h1>
    </div>
</div>
<?php if(!empty($sorted_winners)): ?>
<?php foreach($sorted_winners as $win): ?>
<div class="row">
    <div class="large-12 columns">
        <div class="la-winner">
            <div class="type"><?php echo $win['type']; ?></div>
            <div class="name"><?php echo $win['first_name'].' '.$win['last_name'].','.$win['age']; ?></div>
            <div class="lib-item"><a href="<?php echo $win['library_link']; ?>"><?php echo $win['lib']; ?></a></div> 
            <div class="aff"><?php echo $win['aff']?></div> 
            <div class="image"><?php echo $win['library_image']; ?></div> 
            <div class="descrip"><?php echo $win['lib_item_des']; ?></div> 
            <div class="row">
                <div class="large-3 columns">
                    <div class="a-image"><?php echo $win['image']; ?></div> 
                    <div class="small-name"><?php echo $win['first_name'].' '.$win['last_name'].','.$win['age']; ?></div>
                </div>
                <div class="large-9 columns"><?php echo $win['winner_quote']; ?></div>
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
