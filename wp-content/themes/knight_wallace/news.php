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
include_once 'helpers.php';
$news = get_posts(array('category_name'=>'news','posts_per_page'=> -1));
$featured = find_featured_news_article($news);
?>

<div class="row">
    <div class="large-12 columns">
        <h1 class="entry-title text-center">News</h1>
    </div>
</div>
<?php if(!empty($featured)): ?>
<div id="library">
    <div class="row">
        <div class="large-12 column">
          <div class="featured">
            <div class="row" data-equalizer>
              <div class="large-6 column" data-equalizer-watch>
                <?php $featured_image = get_the_post_thumbnail($featured[0]->ID); ?>
                <?php if(!empty($featured_image)): ?>
                    <?php echo $featured_image; ?>
                <?php else: ?>
                    <div style="min-height: 285px;"></div>
                <?php endif; ?>
              </div>
              <div class="large-6 column" data-equalizer-watch>
                <div class="featured-text">
                  <h4>Featured</h4>
                  <h3>
                      <a href="<?php echo $featured[0]->guid; ?>">
                        <?php echo $featured[0]->post_title; ?>
                      </a>
                  </h3>
                  <div class="author">
                        <?php $featured_meta = get_post_meta($featured[0]->ID); ?>

                        <?php if(!empty($featured_meta['Author'])): ?>
                            <?php echo $featured_meta['Author'][0]; ?>
                        <?php endif; ?>
                  </div>
                  <p><?php echo $featured[0]->post_excerpt; ?></p>
                  <p><a href="<?php echo $featured[0]->guid; ?>" class="button">Read Full Story <i class="fa fa-angle-double-right"></i>
</a></p>
                  <div class="tags-list">
                    <?php $featured_tags = get_the_tags($featured[0]->ID); ?>
                    <ul>
                        <?php if(!empty($sorted_libs['featured'][0]['tags'])): ?>
                            <?php foreach($sorted_libs['featured'][0]['tags'] as $tag): ?>
                            <li><a href="/tag/<?php echo $tag->name; ?>/"><?php echo $tag->name; ?></a> <span class="divider">|</span></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
<?php endif; ?>
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
                            <h4><a href="<?php echo $new->guid; ?>"><?php echo $new->post_title; ?></a></h4>
                        <?php $nmeta = get_post_meta($new->ID); ?>
                        <?php if(!empty($nmeta['Author'])): ?>
                            <div class="date"><?php echo $nmeta['Author'][0]; ?></div>
                        <?php endif; ?>
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
