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
$sorted_donors = sort_donors($donors,$donor_type);
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
            <?php if(!empty($sorted_donors)): ?>
                <?php foreach($sorted_donors as $donor): ?>
                    <div class="row">
                        <div class="large-2 columns">
                            <div class="board-member-image"><?php echo $donor['image']; ?></div>
                        </div>
                        <div class="large-10 columns">
                            <h3 class="name">
                                <?php echo $donor['name']; ?>
                            </h3>
                            <p class="board-member-title">
                                <?php echo $donor['description']; ?>
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
