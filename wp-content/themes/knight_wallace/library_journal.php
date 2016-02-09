<?php
/**
 * Template Name: Library Journal
 *
 *
 * @package knight_wallace
 */

get_header(); ?>
<?php
//grab our junk
include_once('helpers.php');
$libs = get_posts(array('post_type'=>'library','posts_per_page'=> -1));
$sorted_libs = sort_library_items_sub_cat($libs, "Journal");
?>

<?php if(!empty($sorted_libs['featured'])): ?>
<section id="library">
    <div class="row">
        <div class="large-12">
            <h1 class="text-center">Library</h1>
        </div>
    </div>
    <div class="row">
        <div class="large-12 column">
          <div class="featured">
            <div class="row" data-equalizer>
              <div class="large-6 column" data-equalizer-watch>
                <?php if(!empty($sorted_libs['featured'][0])): ?>
                    <?php echo $sorted_libs['featured'][0]['image']; ?>
                <?php else: ?>
                    <div style="min-height: 285px;"></div>
                <?php endif; ?>
              </div>
              <div class="large-6 column" data-equalizer-watch>
                <div class="featured-text">
                  <h4>Featured</h4>
                  <h3>
                      <a href="<?php echo $sorted_libs['featured'][0]['link']; ?>">
                        <?php echo $sorted_libs['featured'][0]['title']; ?>
                      </a>
                  </h3>
                  <div class="author">
                        <?php echo $sorted_libs['featured'][0]['author']; ?>
                  </div>
                  <p>
                        <?php echo $sorted_libs['featured'][0]['content']; ?>
                  </p>
                  <div class="tags-list">
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
</section>
<?php else: ?>
    <div class="row">
        <div class="large-12">
            <h1 class="text-center">Library</h1>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty($sorted_libs)): ?>
<section class="story-list library" id="articles">
    <div class="row headings">
        <div class="large-12 columns">
            <div class="heading">
                <h3>Journal</h3>
            </div>
        </div>
    </div>
    <div class="row"><!--start first row-->
<?php $c = 1; ?>
<?php foreach($sorted_libs as $slib): ?>
        <div class="large-6 columns">
            <div class="row">
                <div class="large-12 columns">
                    <div class="news-article">
                        <?php if(!empty($slib['image'])): ?>
                            <?php echo $slib['image']; ?>
                        <?php else: ?>
                            <div style="min-height: 140px;"></div>
                        <?php endif; ?>
                        <div class="text">
                            <h4>
                                <a href="<?php echo $slib['link']; ?>">
                                    <?php echo $slib['title']; ?>
                                </a>
                            </h4>
                            <div class="date"><?php echo $slib['date']; ?></div>
                            <div class="tags-list">
                                <ul>
                                <?php if(!empty($slib['tags'])): ?>
                                    <?php foreach($slib['tags'] as $tag): ?>
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
<?php if($c % 2 == 0): ?>
</div>
<div class="row">
<?php endif; ?>
<?php $c += 1; ?>
<?php endforeach; ?>
</div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
