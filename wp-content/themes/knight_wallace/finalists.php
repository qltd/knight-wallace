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
<section class="breadcrumb">
<div class="row">
    <div class="small-6 columns">
        <a href="/livingston-awards/" class="library-link">&nbsp;Livingston Awards</a>
    </div>
    <?php get_template_part('template-parts/share'); ?>
</div>
</section>
<div class="row">
    <div class="large-12 columns">
        <h1 class="entry-title">Finalists</h1>
    </div>
</div>
<div class="row">
    <div class="large-12 columns">
        <div class="tagline dynamic-temp"><?php echo !empty($post->post_content) ? $post->post_content : '';?></div>
    </div>
</div>
<main class="posts winners-list">
<div class="fin-local">
<div class="row">
    <div class="large-10 large-centered columns">
        <h2 class="type">Excellence in Local Reporting</h2>
<?php if(!empty($sorted_finalists['Excellence in Local Reporting'])): ?>
<?php foreach($sorted_finalists['Excellence in Local Reporting'] as $fin): ?>
<div class="row">
    <div class="large-12 columns">
        <div class="la-winner">
            <div class="name"><?php echo $fin['first_name'].' '.$fin['last_name']; ?></div>
            <div class="lib-item"><a href="<?php echo $fin['library_link']; ?>">&ldquo;<?php echo $fin['lib']; ?>&rdquo;</a></div>
            <?php if(!empty($fin['winning_aff'])):?>
                <div class="aff"><?php echo $fin['winning_aff']; ?></div>
            <?php endif;?>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>
   </div>
</div>
</div>

<div class="fin-national">
<div class="row">
    <div class="large-10 large-centered columns">
        <h2 class="type">Excellence in National Reporting</h2>
<?php if(!empty($sorted_finalists['Excellence in National Reporting'])): ?>
<?php foreach($sorted_finalists['Excellence in National Reporting'] as $fin): ?>
<div class="row">
    <div class="large-12 columns">
        <div class="la-winner">
            <div class="name"><?php echo $fin['first_name'].' '.$fin['last_name']; ?></div>
            <div class="lib-item"><a href="<?php echo $fin['library_link']; ?>">&ldquo;<?php echo $fin['lib']; ?>&rdquo;</a></div>
            <?php if(!empty($fin['winning_aff'])):?>
                <div class="aff"><?php echo $fin['winning_aff']; ?></div>
            <?php endif;?>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>
</div>

<div class="fin-international">
<div class="row">
    <div class="large-10 large-centered columns">
        <h2 class="type">Excellence in International Reporting</h2>
<?php if(!empty($sorted_finalists['Excellence in International Reporting'])): ?>
<?php foreach($sorted_finalists['Excellence in International Reporting'] as $fin): ?>
<div class="row">
    <div class="large-12 columns">
        <div class="la-winner">
            <div class="name"><?php echo $fin['first_name'].' '.$fin['last_name']; ?></div>
            <div class="lib-item"><a href="<?php echo $fin['library_link']; ?>">&ldquo;<?php echo $fin['lib']; ?>&rdquo;</a></div>
            <?php if(!empty($fin['winning_aff'])):?>
                <div class="aff"><?php echo $fin['winning_aff']; ?></div>
            <?php endif;?>
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
