<?php
/**
 * Template Name: Finalists
 *
 * @package knight_wallace
 */

get_header('livingston'); ?>

<?php
include_once('helpers.php');
//grab our junk
$alerts = get_posts(array('category_name'=>'alert'));
$this_page_meta = get_post_meta($post->ID);
$this_year = !empty($this_page_meta['year']) ? $this_page_meta['year'][0] : null;
$finalists = get_posts(array('post_type'=>'person_livingston','posts_per_page'=> -1));
$sorted_finalists = sort_finalists($finalists, $this_year);
?>
<div class="row">
    <div class="large-12 columns">
        <h1 class="entry-title">Finalists</h1>
    </div>
</div>
<main class="posts winners-list">
<div class="fin-local">
<div class="row">
    <div class="large-12 columns">
        <h2 class="entry-title">Excellence in Local Reporting</h2>
    </div>
</div>
<?php if(!empty($sorted_finalists['Excellence in Local Reporting'])): ?>
<?php foreach($sorted_finalists['Excellence in Local Reporting'] as $fin): ?>
<div class="row">
    <div class="large-10 large-centered columns">
        <div class="la-winner">
            <div class="type"><?php echo $fin['type']; ?></div>
            <div class="name"><?php echo $fin['first_name'].' '.$fin['last_name'].', '.$fin['age']; ?></div>
            <div class="lib-item"><a href="<?php echo $fin['library_link']; ?>">&ldquo;<?php echo $fin['lib']; ?>&rdquo;</a></div>
            <div class="aff"><?php echo $fin['aff']?></div>
            <div class="image"><?php echo $fin['library_image']; ?></div>
            <div class="descrip"><?php echo $fin['lib_item_des']; ?></div>
            <div class="row winner-quote">
                <div class="large-2 columns">
                    <div class="a-image"><?php echo $fin['image']; ?></div>
                    <div class="small-name"><?php echo $fin['first_name'].' '.$fin['last_name'].', '.$fin['age']; ?></div>
                </div>
                <div class="large-10 columns quote"><?php echo $fin['winner_quote']; ?></div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>
</div>

<div class="fin-national">
<div class="row">
    <div class="large-12 columns">
        <h2 class="entry-title">Excellence in National Reporting</h2>
    </div>
</div>
<?php if(!empty($sorted_finalists['Excellence in National Reporting'])): ?>
<?php foreach($sorted_finalists['Excellence in National Reporting'] as $fin): ?>
<div class="row">
    <div class="large-10 large-centered columns">
        <div class="la-winner">
            <div class="type"><?php echo $fin['type']; ?></div>
            <div class="name"><?php echo $fin['first_name'].' '.$fin['last_name'].', '.$fin['age']; ?></div>
            <div class="lib-item"><a href="<?php echo $fin['library_link']; ?>">&ldquo;<?php echo $fin['lib']; ?>&rdquo;</a></div>
            <div class="aff"><?php echo $fin['aff']?></div>
            <div class="image"><?php echo $fin['library_image']; ?></div>
            <div class="descrip"><?php echo $fin['lib_item_des']; ?></div>
            <div class="row winner-quote">
                <div class="large-2 columns">
                    <div class="a-image"><?php echo $fin['image']; ?></div>
                    <div class="small-name"><?php echo $fin['first_name'].' '.$fin['last_name'].', '.$fin['age']; ?></div>
                </div>
                <div class="large-10 columns quote"><?php echo $fin['winner_quote']; ?></div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>
</div>

<div class="fin-international">
<div class="row">
    <div class="large-12 columns">
        <h2 class="entry-title">Excellence in International Reporting</h2>
    </div>
</div>
<?php if(!empty($sorted_finalists['Excellence in International Reporting'])): ?>
<?php foreach($sorted_finalists['Excellence in International Reporting'] as $fin): ?>
<div class="row">
    <div class="large-10 large-centered columns">
        <div class="la-winner">
            <div class="type"><?php echo $fin['type']; ?></div>
            <div class="name"><?php echo $fin['first_name'].' '.$fin['last_name'].', '.$fin['age']; ?></div>
            <div class="lib-item"><a href="<?php echo $fin['library_link']; ?>">&ldquo;<?php echo $fin['lib']; ?>&rdquo;</a></div>
            <div class="aff"><?php echo $fin['aff']?></div>
            <div class="image"><?php echo $fin['library_image']; ?></div>
            <div class="descrip"><?php echo $fin['lib_item_des']; ?></div>
            <div class="row winner-quote">
                <div class="large-2 columns">
                    <div class="a-image"><?php echo $fin['image']; ?></div>
                    <div class="small-name"><?php echo $fin['first_name'].' '.$fin['last_name'].', '.$fin['age']; ?></div>
                </div>
                <div class="large-10 columns quote"><?php echo $fin['winner_quote']; ?></div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>
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
