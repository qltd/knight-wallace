<?php
/**
 * Template Name: Fellows Page 
 *
 *
 * @package knight_wallace
 */

get_header('fellows'); ?>

<main id="main" class="posts">
<div class="row">
  <div class="large-6 columns">
    <img src="http://dummyimage.com/620x256/aeaeae/555.jpg?text=placeholder" alt="" />
    <div class="text">
      <h3>A life-changing experience</h3>
      <p><a href="">Learn more about the Knight-Wallace Fellowships ></a></p>
    </div>
  </div>
  <div class="large-6 columns">
    <img src="http://dummyimage.com/620x256/aeaeae/555.jpg?text=placeholder" alt="" />
    <div class="text">
      <h3>A life-changing experience</h3>
      <p><a href="">Learn more about the Knight-Wallace Fellowships ></a></p>
    </div>
  </div>
</div>
<div class="row">
  <div class="large-6 columns">
    <img src="http://dummyimage.com/620x256/aeaeae/555.jpg?text=placeholder" alt="" />
    <div class="text">
      <h3>A life-changing experience</h3>
      <p><a href="">Learn more about the Knight-Wallace Fellowships ></a></p>
    </div>
  </div>
  <div class="large-6 columns">
    <img src="http://dummyimage.com/620x256/aeaeae/555.jpg?text=placeholder" alt="" />
    <div class="text">
      <h3>A life-changing experience</h3>
      <p><a href="">Learn more about the Knight-Wallace Fellowships ></a></p>
    </div>
  </div>
</div>
</main>

<?php 
//grab alerts
$alerts = get_posts(array('category_name'=>'alert'));

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

<?php $news = get_posts(array('category_name'=>'news'));//get news ?>

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
  <div class="large-6 columns">
    <div class="row news snippet-box">
      <div class="large-12 columns">
        <div class="news-article">
          <h4><a href="#">2015 Livingston Award Winners Announced</a></h4>
          <div class="date">August 15, 2015</div>
          <div class="tags-list">
            <ul>
              <li><a href="#">Knight-Wallace</a> |</li>
              <li><a href="#">Events</a> </li>
            </ul>
            <br />
          </div>
        </div>
      </div>
    </div>
  </div>
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
    <div class="row news snippet-box">
      <div class="large-12 columns">
        <div class="news-article">
          <h4><a href="#">2015 Livingston Award Winners Announced</a></h4>
          <div class="date">August 15, 2015</div>
          <div class="tags-list">
            <ul>
              <li><a href="#">Knight-Wallace</a> |</li>
              <li><a href="#">Events</a> </li>
            </ul>
            <br />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="large-6 columns"><a href="#" class="more-posts">See all Knight-Wallace Fellowship news &raquo;</a></div>
  <div class="large-6 columns"><a href="#" class="more-posts">See all Wallace House library items &raquo;</a></div>
</div>
</section>

<?php get_footer('fellows'); ?>
