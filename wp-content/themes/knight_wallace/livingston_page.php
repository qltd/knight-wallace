<?php
/**
 * Template Name: Livingston Page
 *
 * @package knight_wallace
 */

get_header('livingston'); ?>

<?php 
include_once('helpers.php');
//Here we are grabing special content that we will need in this template, including news, alerts, and library items
//@rdarling42
$alerts = get_posts(array('category_name'=>'alert'));
$news = get_posts(array('category_name'=>'news'));
$libs = get_posts(array('post_type'=>'library'));
$content_blocks = get_posts(array('post_type'=>'homepage_fcb','posts_per_page'=>200));
$sorted_content_blocks = sort_homepage_featured_content_blocks($content_blocks);
$hero = get_posts(array('post_type'=>'hero_content'));
$hero_content = sort_hero_content($hero);
$random_livingston_hero_content = random_hero_content($hero_content,'Livingston Awards');
?>

<?php if(!empty($random_livingston_hero_content)):?>

<?php $background_image = turn_img_tag_to_url($random_livingston_hero_content['image']);?>
<style>
#hero_image {
    background: url(<?php echo $background_image; ?>) no-repeat scroll center center / cover;
}
</style>
<section id="hero_image">
    <div class="row">
        <div class="large-8 columns">
            <h2>
<?php echo !empty($random_livingston_hero_content['link']) ? '<a href="'.$random_livingston_hero_content['link'].'">' : ''; ?>
                <?php echo $random_livingston_hero_content['title']; ?>
<?php echo !empty($random_livingston_hero_content['link']) ? '</a>' : ''; ?>
            </h2>
            <p>
<?php echo !empty($random_livingston_hero_content['link']) ? '<a href="'.$random_livingston_hero_content['link'].'">' : ''; ?>
            <?php echo $random_livingston_hero_content['content']; ?> 
<?php echo !empty($random_livingston_hero_content['link']) ? '</a>' : ''; ?>
            </p>
        </div>
    </div>
</section>
<?php endif; //end if get_post_thumbnail ?>

<main id="main" class="posts">
<div class="row">
  <div class="large-6 columns">
    <?php if(!empty($sorted_content_blocks['Livingston Awards'][0])): ?>
        <?php if(!empty($sorted_content_blocks['Livingston Awards'][0]['image'])): ?>
            <a href="<?php echo $sorted_content_blocks['Livingston Awards'][0]['link']; ?>">
            <?php echo $sorted_content_blocks['Livingston Awards'][0]['image']; ?>
            </a>
        <?php else: ?>
            <img src="http://dummyimage.com/620x256/aeaeae/555.jpg" alt="" />
        <?php endif; ?>
    <div class="text">
      <h3><?php echo $sorted_content_blocks['Livingston Awards'][0]['title']; ?></h3>
      <p>
          <a href="<?php echo $sorted_content_blocks['Livingston Awards'][0]['link']; ?>">
              <?php echo $sorted_content_blocks['Livingston Awards'][0]['content']; ?>
          </a>
      </p>
    </div>
    <?php endif; ?>
  </div>
  <div class="large-6 columns">
    <?php if(!empty($sorted_content_blocks['Livingston Awards'][1])): ?>
        <?php if(!empty($sorted_content_blocks['Livingston Awards'][1]['image'])): ?>
          <a href="<?php echo $sorted_content_blocks['Livingston Awards'][1]['link']; ?>">
            <?php echo $sorted_content_blocks['Livingston Awards'][1]['image']; ?>
          </a>
        <?php else: ?>
            <img src="http://dummyimage.com/620x256/aeaeae/555.jpg" alt="" />
        <?php endif; ?>
    <div class="text">
      <h3><?php echo $sorted_content_blocks['Livingston Awards'][1]['title']; ?></h3>
      <p>
          <a href="<?php echo $sorted_content_blocks['Livingston Awards'][1]['link']; ?>">
              <?php echo $sorted_content_blocks['Livingston Awards'][1]['content']; ?>
          </a>
      </p>
    </div>
    <?php endif; ?>
  </div>
</div>
<div class="row">
  <div class="large-6 columns">
    <?php if(!empty($sorted_content_blocks['Livingston Awards'][2])): ?>
        <?php if(!empty($sorted_content_blocks['Livingston Awards'][2]['image'])): ?>
          <a href="<?php echo $sorted_content_blocks['Livingston Awards'][2]['link']; ?>">
            <?php echo $sorted_content_blocks['Livingston Awards'][2]['image']; ?>
          </a>
        <?php else: ?>
            <img src="http://dummyimage.com/620x256/aeaeae/555.jpg" alt="" />
        <?php endif; ?>
    <div class="text">
      <h3><?php echo $sorted_content_blocks['Livingston Awards'][2]['title']; ?></h3>
      <p>
          <a href="<?php echo $sorted_content_blocks['Livingston Awards'][2]['link']; ?>">
              <?php echo $sorted_content_blocks['Livingston Awards'][2]['content']; ?>
          </a>
      </p>
    </div>
    <?php endif; ?>
  </div>
  <div class="large-6 columns">
    <?php if(!empty($sorted_content_blocks['Livingston Awards'][3])): ?>
        <?php if(!empty($sorted_content_blocks['Livingston Awards'][3]['image'])): ?>
          <a href="<?php echo $sorted_content_blocks['Livingston Awards'][3]['link']; ?>">
            <?php echo $sorted_content_blocks['Livingston Awards'][3]['image']; ?>
          </a>
        <?php else: ?>
            <img src="http://dummyimage.com/620x256/aeaeae/555.jpg" alt="" />
        <?php endif; ?>
    <div class="text">
      <h3><?php echo $sorted_content_blocks['Livingston Awards'][3]['title']; ?></h3>
      <p>
          <a href="<?php echo $sorted_content_blocks['Livingston Awards'][3]['link']; ?>">
              <?php echo $sorted_content_blocks['Livingston Awards'][3]['content']; ?>
          </a>
      </p>
    </div>
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

<section class="story-list news">
<div class="row headings">
  <div class="large-6 columns">
    <div class="heading">
      <h3>Recent News</h3>
    </div>
  </div>
  <div class="large-6 columns">
    <div class="heading">
      <h3>From the Wallace House Library</h3>
    </div>
  </div>
</div>
<div class="row">
<!--display first news item-->
  <div class="large-6 columns">
<?php if(!empty($news[0])): ?>
<?php $tags = get_the_tags($news[0]->ID); ?>
    <div class="row news snippet-box">
      <div class="large-12 columns">
        <div class="news-article">
        <h4><a href="<?php echo $news[0]->guid; ?>"><?php echo $news[0]->post_title; ?></a></h4>
          <div class="date"><?php echo $news[0]->post_date; ?></div>
          <div class="tags-list">
            <ul>
            <?php if(!empty($tags)):?>
                <?php foreach($tags as $tag): ?>
                    <li><a href="/tag/<?php echo $tag->name; ?>/"><?php echo $tag->name; ?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
            </ul>
            <br />
          </div>
        </div>
      </div>
    </div>
<?php endif; ?>
  </div>
<!--end display first news item-->
<!-- display first library item -->
  <div class="large-6 columns">
    <?php if(!empty($libs[0])): ?>
    <div class="row news snippet-box">
      <div class="large-12 columns">
        <div class="news-article">
        <h4><a href="/library/<?php echo $libs[0]->post_name; ?>"><?php echo $libs[0]->post_title; ?></a></h4>
        <div class="date"><?php echo $libs[0]->post_date; ?></div>
        <?php $tagslib = get_the_tags($libs[0]->ID); ?>
          <div class="tags-list">
            <ul>
            <?php if(!empty($tagslib)):?>
                <?php foreach($tagslib as $t): ?>
                    <li><a href="/tag/<?php echo $t->name; ?>/"><?php echo $t->name; ?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
            </ul>
            <br />
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>
<!--end display first library item-->
</div>

<div class="row">
<!--display second news item -->
  <div class="large-6 columns">
<?php if(!empty($news[1])): ?>
<?php $tags1 = get_the_tags($news[1]->ID); ?>
    <div class="row news snippet-box">
      <div class="large-12 columns">
        <div class="news-article">
          <h4><a href="<?php echo $news[1]->guid; ?>"><?php echo $news[1]->post_title; ?></a></h4>
          <div class="date"><?php echo $news[1]->post_date; ?></div>
          <div class="tags-list">
            <ul>
            <?php if(!empty($tags1)):?>
                <?php foreach($tags1 as $tag1): ?>
                    <li><a href="/tag/<?php echo $tag1->name; ?>/"><?php echo $tag1->name; ?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
            </ul>
            <br />
          </div>
        </div>
      </div>
    </div>
<?php endif; ?>
  </div>
<!--end display second news item -->
  <div class="large-6 columns">
<!--display second library item-->
    <?php if(!empty($libs[1])): ?>
    <div class="row news snippet-box">
      <div class="large-12 columns">
        <div class="news-article">
            <h4><a href="/library/<?php echo $libs[1]->post_name; ?>"><?php echo $libs[1]->post_title; ?></a></h4>
            <div class="date"><?php echo $libs[1]->post_date; ?></div>
          <div class="tags-list">
            <?php $tagslib1 = get_the_tags($libs[1]->ID); ?>
            <ul>
            <?php if(!empty($tagslib1)):?>
                <?php foreach($tagslib1 as $t1): ?>
                    <li><a href="/tag/<?php echo $t1->name; ?>/"><?php echo $t1->name; ?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
            </ul>
            <br />
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
<!--end second display library item-->
  </div>
</div>
<div class="row">
  <div class="large-6 columns"><a href="#" class="more-posts">See all Livingston Awards news &raquo;</a></div>
  <div class="large-6 columns"><a href="#" class="more-posts">See all library items &raquo;</a></div>
</div>
</section>
<?php get_footer('livingston'); ?>
