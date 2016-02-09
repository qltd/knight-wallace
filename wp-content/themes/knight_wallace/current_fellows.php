<?php
/**
 * Template Name: Current Fellows 
 * 
 *
 * @package knight_wallace
 */

get_header('fellows'); ?>

<?php 
include_once('helpers.php');
//grab our junk
$alerts = get_posts(array('category_name'=>'alert'));
$fellows = get_posts(array('post_type'=>'person_kw_fellow','posts_per_page'=>200));
?>

<section class="breadcrumb">
<div class="row">
    <div class="small-6 columns">
        <a href="/knight-wallace-fellowships/" class="library-link">Knight-Wallace</a>
    </div>
</div>
</section>

<main id="main" class="site-main post-main" role="main">
    <div class="row">
        <div class="large-12 columns">
            <h1 class="text-center">Board of Directors</h1>
        </div>
    </div>
    <div class="row">
        <div class="large-10 columns large-offset-2">
            <?php if(!empty($fellows)): ?>
                <?php foreach($fellows as $fellow): ?>
                    <?php 
                    $image = get_the_post_thumbnail($fellow->ID); 
                    $pmeta = get_post_meta($fellow->ID); 
                    ?>
                    <div class="row">
                        <div class="large-4 columns">
                            <div class="board-member-image"><?php echo $image; ?></div>
                        </div>
                        <div class="large-8 columns">
                            <p class="board-member-name">
                                <a href="<?php echo !empty($fellow->guid) ? $fellow->guid : ''; ?>" class="board-member-link">
                                <?php echo !empty($pmeta['_kw_person_kw_fellow_first_name']) ? $pmeta['_person_board_member_first_name'][0] : ''; ?>&nbsp;
                                <?php echo !empty($pmeta['_person_board_member_last_name']) ? $pmeta['_person_board_member_last_name'][0] : ''; ?></a>
                            </p>
                            <p class="board-member-title">
                                <?php echo !empty($pmeta['_person_board_member_title']) ? $pmeta['_person_board_member_title'][0] : ''; ?>&nbsp;
                                <?php echo !empty($pmeta['_person_board_member_ass']) ? $pmeta['_person_board_member_ass'][0] : ''; ?>
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


<?php get_footer('fellows'); ?>
