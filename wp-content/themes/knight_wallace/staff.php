<?php
/**
 * Template Name: Staff
 *
 *
 * @package knight_wallace
 */

get_header('fellows'); ?>

<?php
include_once('helpers.php');
//grab our junk
$alerts = get_posts(array('category_name'=>'alert'));
$staff = get_posts(array('post_type'=>'person_staff','posts_per_page'=> -1));
?>
<div class="row">
    <div class="large-12 columns">
        <h1 class="entry-title">Staff</h1>
    </div>
</div>
<main id="main" class="site-main post-main" role="main">
    <div class="row staff">
        <div class="large-10 large-centered columns">
            <?php if(!empty($staff)): ?>
                <?php foreach($staff as $s): ?>
                    <?php
                    $image = get_the_post_thumbnail($s->ID);
                    $pmeta = get_post_meta($s->ID);
                    ?>
                    <div class="row director">
                        <div class="medium-2 columns">
                            <div class="image"><?php echo $image; ?></div>
                        </div>
                        <div class="medium-10 columns">
                            <p class="name">
                                <a href="<?php echo !empty($s->guid) ? $s->guid : ''; ?>" class="board-member-link">
                                <?php echo !empty($pmeta['_kw_person_staff_first_name']) ? $pmeta['_kw_person_staff_first_name'][0] : ''; ?>
                                <?php echo !empty($pmeta['_kw_person_staff_last_name']) ? $pmeta['_kw_person_staff_last_name'][0] : ''; ?></a>
                            </p>
                            <p class="title">
                                <?php echo !empty($pmeta['_kw_person_staff_title']) ? $pmeta['_kw_person_staff_title'][0] : ''; ?>
                            </p>
                            <p class="bio">
                                <?php echo !empty($pmeta['_kw_person_staff_bio']) ? $pmeta['_kw_person_staff_bio'][0] : ''; ?>
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
