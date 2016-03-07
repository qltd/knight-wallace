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
$sorted_winners = sort_past_winners($winners,array('2014','2015','2013','2012','2011','2010','2009','2008','2007','2006'));
?>
<section class="breadcrumb">
<div class="row">
    <div class="small-6 columns">
        <a href="/livingston-awards/winners/" class="link">Current Winners</a>
    </div>
</div>
</section>
<div class="row">
    <div class="large-12 columns">
        <h1 class="entry-title">Past Winners</h1>
    </div>
</div>
<section id="past_winners_control">
<form id="control_form" action="/livingston-awards/winners/past-winners/">
<input type="hidden" name="action" value="past_winners" />
<div class="row">
    <div class="medium-3 columns">
        <p class="control-label">Refine by year:</p>
        <?php $year = date('Y'); ?>
        <ul class="years">
        <?php for($i=0;$i<20;$i++): ?>
            <?php $year = $year - 1; ?>
            <li>
            <input type="checkbox" name="year" value="<?php echo $year; ?>" /><label for="year"><?php echo $year; ?></label>
            </li>
        <?php endfor; ?>
        </ul>
        <a href="#" class="show-more">More &raquo;</a>
    </div>
    <div class="medium-4 columns">
        <p class="control-label">Refine by award type:</p>
        <ul>
            <li><input type="checkbox" name="award" value="Local Reporting" /><label for="award">Local Reporting</label></li>
            <li><input type="checkbox" name="award" value="National Reporting" /><label for="award">National Reporting</label></li>
            <li><input type="checkbox" name="award" value="International Reporting" /><label for="award">International Reporting</label></li>
        </ul>
    </div>
    <div class="medium-5 columns small-text-center medium-text-right">
        <ul>
            <li><a href="/livingston-awards/winners/past-winners/" class="button gray-scale">Clear All</a></li>
            <li><input type="button" value="Apply" class="button la-past-winner-control-form-action" /></li>
        </ul>
    </div>
</div>
</form>
</section>
<main class="posts winners-list past">
<?php if(!empty($sorted_winners)): ?>
<?php foreach($sorted_winners as $win): ?>
<div class="row">
    <div class="large-10 large-centered columns">
        <div class="past-winner">
            <div class="name"><?php echo $win['first_name'].' '.$win['last_name']; ?></div>
            <div class="lib-item"><a href="<?php echo $win['library_link']; ?>"><?php echo $win['lib']; ?></a></div>
            <div class="winning">
                <span class="job"><?php echo $win['past_job']; ?></span>, <span class="aff"><?php echo $win['past_aff']; ?></span> 
            </div>
            <div class="current">
            <?php if(!empty($win['job'])): ?>
                 <span class="job">Current Affiliation: <?php echo $win['job']; ?></span>, 
            <?php endif; ?>
            <?php if(!empty($win['aff'])): ?> 
                <span class="aff"><?php echo $win['aff']; ?></span>
            <?php endif; ?>
            </div>
            <div class="tags">
                <?php echo $win['year']; ?> |
                <?php echo $win['winner']; ?> |
                <?php echo $win['type']; ?>
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
