<?php
/**
* Template Name: Fellows Page
*
* @package knight_wallace
*/

get_header('fellows'); ?>

<?php
include_once('helpers.php');
//grab our junk
$alerts = get_posts(array('category_name'=>'alert'));
$news = get_posts(array('category_name'=>'news'));
$libs = get_posts(array('post_type'=>'library'));
$events = get_posts(array('category_name'=>'events','post_status'=>'any','posts_per_page'=> 2 ));
$sorted_events = sort_events($events);
$content_blocks = get_posts(array('post_type'=>'homepage_fcb','posts_per_page'=>200));
$sorted_content_blocks = sort_homepage_featured_content_blocks($content_blocks);
$hero = get_posts(array('post_type'=>'hero_content','posts_per_page'=>200));

$args = array(
    'post_type'=>'hero_content',
    'posts_per_page'=>200,
   'meta_query' => array(
       array(
           'key' => 'hero_content_which_page',
           'value' => 'Wallace House',
           'compare' => '=',
       )
   )
       );
$hero = new WP_Query($args);

$hero_content = sort_hero_content($hero);
$random_hero_content = random_hero_content($hero_content,'Knight-Wallace Fellowships');
$slides = get_posts(array('post_type'=>'slider_content','posts_per_page'=> -1));
$sorted_slides = sort_slider_content($slides);
//twitter integration
$twitter_username = 'UMWallaceHouse';
include_once('twitter_feed.php');//$tweets var is set here
?>

<?php if(!empty($random_hero_content)): ?>
<?php $background_image = $random_hero_content['image']; ?>
<style>
#hero_image {
background: url(<?php echo $background_image; ?>) no-repeat scroll center center / cover;
}
</style>
<section id="hero_image">
    <div class="row">
        <div class="large-8 columns">
            <h2>
            <?php echo !empty($random_hero_content['link']) ? '<a href="'.$random_hero_content['link'].'">' : ''; ?>
                <?php echo $random_hero_content['title']; ?>
            <?php echo !empty($random_hero_content['link']) ? '</a>' : ''; ?>
            </h2>
            <p>
                <?php echo !empty($random_hero_content['link']) ? '<a href="'.$random_hero_content['link'].'">' : ''; ?>
                    <?php echo $random_hero_content['content']; ?>
                <?php echo !empty($random_hero_content['link']) ? '</a>' : ''; ?>
            </p>
        </div>
    </div>
</section>
<?php endif; //end if get_post_thumbnail ?>


<?php if(!empty($sorted_slides['Knight-Wallace Fellowships'])): ?>
<section id="slideshow">
    <div class="row">
        <div class="large-10 columns large-centered">
            <ul class="bxslider">
                <?php foreach($sorted_slides['Knight-Wallace Fellowships'] as $slide):?>
                <li>
                    <div class="row slide">

                        <div class="medium-4 columns text-right"><?php if(!empty($slide['image'])):?><?php echo $slide['image']; ?><?php endif; ?></div>

                        <div class="medium-8 columns">
                            <div class="heading"><?php echo $slide['heading']; ?></div>
                            <div class="win-meta">
                                <div class="name"><?php echo $slide['name']; ?></div>
                                <div class="details">
                                    <?php echo $slide['details']; ?>
                                </div>
                            </div>
                            <div class="testimonial"><?php echo $slide['testimonial']; ?></div>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
<?php endif; ?>

<main id="main" class="posts landing-page-content-blocks">
<div class="row">
    <div class="medium-6 columns">
        <?php if(!empty($sorted_content_blocks['Knight-Wallace Fellowships'][0])): ?>
        <?php if(!empty($sorted_content_blocks['Knight-Wallace Fellowships'][0]['image'])): ?>
        <a href="<?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][0]['link']; ?>">
            <?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][0]['image']; ?>
        </a>
        <?php else: ?>
        <img src="https://dummyimage.com/620x256/aeaeae/555.jpg" alt="" />
        <?php endif; ?>
        <div class="text">
            <a href="<?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][0]['link']; ?>">
                <h3><?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][0]['title']; ?></h3>
                <p>
                    <?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][0]['content']; ?>
                </p>
            </a>
        </div>
        <?php endif; ?>
    </div>
    <div class="medium-6 columns">
        <?php if(!empty($sorted_content_blocks['Knight-Wallace Fellowships'][1])): ?>
        <?php if(!empty($sorted_content_blocks['Knight-Wallace Fellowships'][1]['image'])): ?>
        <a href="<?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][1]['link']; ?>">
            <?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][1]['image']; ?>
        </a>
        <?php else: ?>
        <img src="https://dummyimage.com/620x256/aeaeae/555.jpg" alt="" />
        <?php endif; ?>
        <div class="text">
            <a href="<?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][1]['link']; ?>">
                <h3><?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][1]['title']; ?></h3>
                <p>
                    <?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][1]['content']; ?>
                </p>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="medium-6 columns">
        <?php if(!empty($sorted_content_blocks['Knight-Wallace Fellowships'][2])): ?>
        <?php if(!empty($sorted_content_blocks['Knight-Wallace Fellowships'][2]['image'])): ?>
        <a href="<?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][2]['link']; ?>">
            <?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][2]['image']; ?>
        </a>
        <?php else: ?>
        <img src="https://dummyimage.com/620x256/aeaeae/555.jpg" alt="" />
        <?php endif; ?>
        <div class="text">
            <a href="<?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][2]['link']; ?>">
                <h3><?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][2]['title']; ?></h3>
                <p>
                    <?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][2]['content']; ?>
                </p>
            </a>
        </div>
        <?php endif; ?>
    </div>
    <div class="medium-6 columns">
        <?php if(!empty($sorted_content_blocks['Knight-Wallace Fellowships'][3])): ?>
        <?php if(!empty($sorted_content_blocks['Knight-Wallace Fellowships'][3]['image'])): ?>
        <a href="<?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][3]['link']; ?>">
            <?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][3]['image']; ?>
        </a>
        <?php else: ?>
        <img src="https://dummyimage.com/620x256/aeaeae/555.jpg" alt="" />
        <?php endif; ?>
        <div class="text">
            <a href="<?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][3]['link']; ?>">
                <h3><?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][3]['title']; ?></h3>
                <p>
                    <?php echo $sorted_content_blocks['Knight-Wallace Fellowships'][3]['content']; ?>
                </p>
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>
</main>

<section class="story-list news">
    <div class="row">
        <!--display first news item-->
        <div class="large-6 columns">
            <div class="heading">
                <h3>Recent News</h3>
            </div>
            <?php if(!empty($news[0])): ?>
            <?php $tags = get_the_tags($news[0]->ID); ?>
            <?php $n1meta = get_post_meta($news[0]->ID); ?>
            <div class="row news snippet-box">
                <div class="large-12 columns">
                    <div class="news-article">
                        <div class="text">
                            <h4><a href="<?php echo get_permalink($news[0]->ID); ?>"><?php echo $news[0]->post_title; ?></a></h4>
                            <div class="date"><?php echo !empty($n1meta['Author']) ? $n1meta['Author'][0] : ''; ?></div>
                            <div class="tags-list">
                                <ul>
                                    <?php if(!empty($tags)):?>
                                    <?php foreach($tags as $tag): ?>
                                    <li><?php echo $tag->name; ?> <span class="divider">|</span></li>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(!empty($news[1])): ?>
            <?php $tags1 = get_the_tags($news[1]->ID); ?>
            <?php $n2meta = get_post_meta($news[1]->ID); ?>
            <div class="row news snippet-box">
                <div class="large-12 columns">
                    <div class="news-article">
                        <div class="text">
                            <h4><a href="<?php echo get_permalink($news[1]->ID); ?>"><?php echo $news[1]->post_title; ?></a></h4>
                            <div class="date"><?php echo !empty($n2meta['Author']) ? $n2meta['Author'][0] : ''; ?></div>
                            <div class="tags-list">
                                <ul>
                                    <?php if(!empty($tags1)):?>
                                    <?php foreach($tags1 as $tag1): ?>
                                    <li><?php echo $tag1->name; ?> <span class="divider">|</span></li>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="row">
                <div class="large-12 columns"><a href="/wallace-house/news/" class="more-posts">See all Wallace House news &raquo;</a></div>
            </div>
        </div>
        <!--end display first news item-->
        <!--Library Item-->
        <div class="large-6 columns">
            <?php if(!empty($events)): ?>
                <div class="heading">
                     <h3>Events</h3>
                </div>
                <?php foreach ($events as $event): ?>
                    <div class="row news snippet-box">
                        <div class="large-12 columns">
                            <div class="news-article"> <div class="text">
                                <h4><a href="<?php echo get_permalink($event->ID); ?>"><?php echo $event->post_title; ?></a></h4>
                                <?php $tagslib = get_the_tags($event->ID); ?>
                                <div class="tags-list">
                                    <ul>
                                        <?php if(!empty($tagslib)):?>
                                        <?php foreach($tagslib as $t): ?>
                                        <li><?php echo $t->name; ?> <span class="divider">|</span></li>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                    <br />
                                </div></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="heading">
                    <h3>From The Wallace House Library</h3>
                </div>
                <?php if(!empty($libs[0])): ?>
                <?php $l1meta = get_post_meta($libs[0]->ID); ?>
                <div class="row news snippet-box">
                    <div class="large-12 columns">
                        <div class="news-article"> <div class="text">
                            <h4><a href="/library/<?php echo $libs[0]->post_name; ?>"><?php echo $libs[0]->post_title; ?></a></h4>
                            <div class="date"><?php echo !empty($l1meta['_library_author']) ? $l1meta['_library_author'][0] : ''; ?></div>
                            <?php $tagslib = get_the_tags($libs[0]->ID); ?>
                            <div class="tags-list">
                                <ul>
                                    <?php if(!empty($tagslib)):?>
                                    <?php foreach($tagslib as $t): ?>
                                    <li><?php echo $t->name; ?> <span class="divider">|</span></li>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                                <br />
                            </div></div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if(!empty($libs[1])): ?>
                <?php $l2meta = get_post_meta($libs[1]->ID); ?>
                <div class="row news snippet-box">
                    <div class="large-12 columns">
                        <div class="news-article">
                            <div class="text">
                                <h4><a href="/library/<?php echo $libs[1]->post_name; ?>"><?php echo $libs[1]->post_title; ?></a></h4>
                            <div class="date"><?php echo !empty($l2meta['_library_author']) ? $l2meta['_library_author'][0] : ''; ?></div>
                                <div class="tags-list">
                                    <?php $tagslib1 = get_the_tags($libs[1]->ID); ?>
                                    <ul>
                                        <?php if(!empty($tagslib1)):?>
                                        <?php foreach($tagslib1 as $t1): ?>
                                        <li><?php echo $t1->name; ?> <span class="divider">|</span></li>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="row">
                <?php if(!empty($events)): ?>
                    <div class="large-12 columns"><a href="/wallace-house/events/" class="more-posts">See all Wallace House events &raquo;</a></div>
                <?php else: ?>
                    <div class="large-12 columns"><a href="/wallace-house/library/" class="more-posts">See all Wallace House library items &raquo;</a></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</section>

<?php if(!empty($tweets)): ?>
<section id="tweets">
    <?php foreach($tweets as $tweet): ?>
    <div class="tweet-wrap">
        <div class="row">
            <div class="small-2 columns">
                <a href="https://twitter.com/<?php echo $twitter_username; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
            </div>
            <div class="small-10 columns">
                <a href="https://twitter.com/<?php echo $twitter_username; ?>/status/<?php echo $tweet->id_str; ?>" target="_blank"><strong><?php echo '@'.$twitter_username.'</strong><br />'.$tweet->text; ?></a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</section>
<?php endif; ?>



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
