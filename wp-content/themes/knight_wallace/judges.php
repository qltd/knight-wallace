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
$judges = get_posts(array('post_type'=>'person_laj','posts_per_page'=>200));
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
            <h1 class="text-center">Judges</h1>
        </div>
    </div>
    <div class="row">
        <div class="large-10 columns large-offset-2">
            <?php if(!empty($judges)): ?>
                <?php foreach($judges as $judge): ?>
                    <?php 
                    $image = get_the_post_thumbnail($judge->ID); 
                    $pmeta = get_post_meta($judge->ID); 
                    ?>
                    <div class="row">
                        <div class="large-4 columns">
                            <div class="board-member-image"><?php echo $image; ?></div>
                        </div>
                        <div class="large-8 columns">
                            <p class="name">
                                <a href="<?php echo !empty($judge->guid) ? $judge->guid : ''; ?>" class="link">
                                <?php echo !empty($pmeta['_kw_person_laj_first_name']) ? $pmeta['_kw_person_laj_first_name'][0] : ''; ?>&nbsp;
                                <?php echo !empty($pmeta['_kw_person_laj_last_name']) ? $pmeta['_kw_person_laj_last_name'][0] : ''; ?></a>
                            </p>
                            <p class="title">
                                <?php echo !empty($pmeta['_kw_person_laj_title']) ? $pmeta['_kw_person_laj_title'][0] : ''; ?>&nbsp;
                                <?php echo !empty($pmeta['_kw_person_laj_aff']) ? $pmeta['_kw_person_laj_aff'][0] : ''; ?>
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