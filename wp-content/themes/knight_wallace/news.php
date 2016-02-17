<?php
/**
* Template Name: News
*
*
* @package knight_wallace
*/

get_header(); ?>

<?php
//grab our junk
$news = get_posts(array('category_name'=>'news','posts_per_page'=> -1));
?>

<div class="row">
    <div class="large-12 columns">
        <h1 class="entry-title text-center">News</h1>
    </div>
</div>
<section class="story-list news">
    <?php if(!empty($news)): ?>
    <?php $count = 2;?>
    <div class="row">
        <?php foreach($news as $new): ?>
        <div class="large-6 columns">
            <?php if(!empty($new)): ?>
            <?php $tags = get_the_tags($new->ID); ?>
            <div class="row news snippet-box">
                <div class="large-12 columns">
                    <div class="news-article">
                        <div class="text">
                            <h4><a href="<?php echo $new>guid; ?>"><?php echo $new->post_title; ?></a></h4>
                            <div class="date"><?php echo $new->post_date; ?></div>
                            <div class="tags-list">
                                <ul>
                                    <?php if(!empty($tags)):?>
                                    <?php foreach($tags as $tag): ?>
                                    <li><a href="/tag/<?php echo $tag->name; ?>/"><?php echo $tag->name; ?></a> <span class="divider">|</span></li>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php if($count % 2 != 0): ?>
        </div><!--close row-->
        <div class="row"><!--start a new row-->
        <?php endif; ?>
        <?php $count += 1; ?>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</section>

<?php get_footer(); ?>
