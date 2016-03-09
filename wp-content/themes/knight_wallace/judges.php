<?php
/**
 * Template Name: Judges
 *
 *
 * @package knight_wallace
 */

get_header('livingston'); ?>

<?php
include_once('helpers.php');
//grab our junk
$alerts = get_posts(array('category_name'=>'alert'));
$judges = get_posts(array('post_type'=>'person_laj','posts_per_page'=> -1));
$sorted_judges = sort_judges($judges);
?>

<section class="breadcrumb">
<div class="row">
    <div class="small-6 columns">
        <a href="/livingston-awards/" class="library-link">&nbsp;Livingston Awards</a>
    </div>
</div>
</section>
<div class="row">
    <div class="large-12 columns">
        <h1 class="entry-title text-center">Judges</h1>
    </div>
</div>
<main id="main" class="site-main post-main" role="main">
     <div class="row judges">
        <div class="large-10 large-centered columns">
            <?php if(!empty($sorted_judges['National'])): ?>
            <div class="row">
                <div class="large-12 columns">
                    <h2 class="judge-type">National</h2>
                </div>
            </div>
                <?php foreach($sorted_judges['National'] as $judge): ?>
                    <div class="row director">
                        <div class="medium-2 columns">
                            <div class="board-member-image"><?php echo $judge['image']; ?></div>
                        </div>
                        <div class="medium-10 columns">
                            <p class="name">
                                <a href="<?php echo $judge['link']; ?>" class="link">
                                <?php echo $judge['first_name'].' '.$judge['last_name']; ?></a>
                            </p>
                            <p class="title">
                                <?php echo $judge['title']; ?><?php if (!empty($judge['aff'])): ?>,&nbsp;<?php echo $judge['aff']; endif;?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if(!empty($sorted_judges['Regional'])): ?>
            <div class="row">
                <div class="large-12 columns">
                    <h2 class="judge-type hr">Regional</h2>
                </div>
            </div>
                <?php foreach($sorted_judges['Regional'] as $judge): ?>
                    <div class="row director">
                        <div class="medium-2 columns">
                            <div class="board-member-image"><?php echo $judge['image']; ?></div>
                        </div>
                        <div class="medium-10 columns">
                            <p class="name">
                                <a href="<?php echo $judge['link']; ?>" class="link">
                                <?php echo $judge['first_name']; ?>&nbsp;<?php echo $judge['last_name']; ?></a>
                            </p>
                            <p class="title">
                                <?php echo $judge['title']; ?><?php if (!empty($judge['aff'])): ?>,&nbsp;<?php echo $judge['aff']; endif;?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
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
