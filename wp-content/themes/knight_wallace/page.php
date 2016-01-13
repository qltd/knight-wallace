<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * This template by default will display the header and footer for Wallace House
 *
 * @package knight_wallace
 */

get_header(); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>


			<?php endwhile; // End of the loop. ?>

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

<?php 
//get news
$news = get_posts(array('category_name'=>'news'));
var_dump($news);
?>

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
  <div class="large-6 columns"><a href="#" class="more-posts">See all Livingston Awards news &raquo;</a></div>
  <div class="large-6 columns"><a href="#" class="more-posts">See all Livingston Awards news &raquo;</a></div>
</div>
</section>

<?php get_footer(); ?>
