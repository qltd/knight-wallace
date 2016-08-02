<?php
/**
* Template Name: Events 
*
*
* @package knight_wallace
*/

get_header(); ?>

<?php
$parent_id = get_post_ancestors($post->ID);
$parent = !empty($parent_id) ? get_post($parent_id[0]) : false;
?>
<?php if(!empty($parent)): ?>
<section class="breadcrumb">
<div class="row">
    <div class="small-6 columns">
    <a href="<?php echo !empty($parent->guid) ? $parent->guid : ''; ?>" class="breadcrumb-link">
        <?php echo !empty($parent->post_title) ? $parent->post_title : ''; ?>
    </a>
    </div>
</div>
</section>
<?php endif; ?>

<?php
//grab our junk
include_once 'helpers.php';
$news = get_posts(array('category_name'=>'events','post_status'=>'any','posts_per_page'=> -1 ));
$featured = find_featured_news_article($news);
$sorted_events = sort_events($news);
?>
<div class="row">
    <div class="large-12 columns">
        <h1 class="entry-title text-center">Events</h1>
    </div>
</div>

<?php include_once(locate_template('template-parts/featured.php')); ?>

<?php if(!empty($sorted_events['future_events'])):?>
   <div class="future-events story-list">
        <div class="row">
            <div class="large-12 columns">
                <div class="heading">
                    <h3 class="">Upcoming Events</h3>
                </div>
            </div>
        </div>
<?php $news = $sorted_events['future_events']; ?>
<?php include(locate_template('template-parts/news.php')); ?>
   </div> 
<?php endif; ?>
<?php if(!empty($sorted_events['past_events'])):?>
   <div class="future-events story-list">
        <div class="row">
            <div class="large-12 columns">
                <div class="heading">
                    <h3 class="">Past Events</h3>
                </div>
            </div>
        </div>
<?php $news = $sorted_events['past_events']; ?>
<?php include(locate_template('template-parts/news.php')); ?>
   </div> 
<?php endif; ?>

<?php get_footer(); ?>
