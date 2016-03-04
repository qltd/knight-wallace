<?php
/**
 * Template Name: Donors
 *
 *
 * @package knight_wallace
 */

get_header(); ?>

<?php
include_once('helpers.php');
//grab our junk
$alerts = get_posts(array('category_name'=>'alert'));
$donors = get_posts(array('post_type'=>'person_donor','posts_per_page' => -1));
$this_page_meta = get_post_meta($post->ID);
$donor_type = !empty($this_page_meta['donor']) ? $this_page_meta['donor'][0] : '';
?>

<section class="breadcrumb">
<div class="row">
    <div class="small-6 columns">
        <a href="/wallace-house/about/our-donors/" class="library-link">Our Donors</a>
    </div>
</div>
</section>

<div class="row">
    <div class="large-12 columns">
    <h1 class="entry-title"><?php echo $post->post_title; ?></h1>
    </div>
</div>

<main id="main" class="site-main post-main" role="main">
    <div class="row board-of-directors">
        <div class="large-10 large-centered columns">
            <?php if(!empty($donors)): ?>
                <?php foreach($donors as $donor): ?>
                    <?php
                    $image = get_the_post_thumbnail($donor->ID);
                    $pmeta = get_post_meta($donor->ID);
                    ?>
                    <?php if(!empty($pmeta['_kw_person_donor_type']) && $pmeta['_kw_person_donor_type'][0] == $donor_type): ?>
                    <div class="row">
                        <div class="large-2 columns">
                            <div class="board-member-image"><?php echo $image; ?></div>
                        </div>
                        <div class="large-10 columns">
                            <h3 class="name">
                                <?php echo !empty($pmeta['_kw_person_donor_name']) ? $pmeta['_kw_person_donor_name'][0] : ''; ?>
                            </h3>
                            <p class="board-member-title">
                                <?php echo !empty($pmeta['_kw_person_donor_description']) ? $pmeta['_kw_person_donor_description'][0] : ''; ?>
                            </p>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php
//display alerts
if(!empty($alerts)):
?><br /><br /><br />
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


<?php get_footer(); ?>
