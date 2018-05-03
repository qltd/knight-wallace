<?php
/**
 * Template Name: Library Videos
 *
 *
 * @package knight_wallace
 */

get_header(); ?>
<?php
//grab our junk
include_once('helpers.php');
$libs = get_posts(array('post_type'=>'library','posts_per_page'=> -1));
$sorted_libs = sort_library_items_sub_cat($libs, "Video");
?>

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

<?php if(!empty($sorted_libs['featured'])): ?>
<section id="library">
    <div class="row">
        <div class="large-12">
            <h1 class="entry-title text-center">Library</h1>
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
                            <li><?php echo $tag->name; ?> <span class="divider">|</span></li>
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
            <h1 class="entry-title text-center">Library</h1>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty($sorted_libs)): ?>
<section class="story-list library" id="articles">
    <div class="row headings">
        <div class="large-12 columns">
            <div class="heading">
                <h3 id="lib_heading">Videos</h3>
            </div>
        </div>
    </div>
    <div class="row pager page-1"><!--start first row-->
<?php $c = 2; ?>
<?php $page = 1;?>
<?php $pager_count = 0;?>
<?php foreach($sorted_libs as $slib): ?>
<?php if(count($slib) > 1): ?>
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
                            <div class="date"><?php echo $slib['author']; ?></div>
                            <div class="tags-list">
                                <ul>
                                <?php if(!empty($slib['tags'])): ?>
                                    <?php foreach($slib['tags'] as $tag): ?>
                                    <li><?php echo $tag->name; ?> <span class="divider">|</span></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $c += 1; ?>
<?php endif; ?>
<?php if($c % 2 == 0): ?>
</div>
<?php $pager_count += 1; ?>
<div class="row pager page-<?php echo $page; ?>">
    <?php if($pager_count >= 20):?>
        <?php $page += 1; //increase what page we are on?>
        <?php $pager_count = 0; //reset pager count ?>
    <?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
</div>
<!--pagination controls-->
<div class="pagination-centered">
  <ul class="pagination">
    <li class="arrow"><a href="#lib_heading" class="display-page-action" data-page="1">&laquo;</a></li>
    <li class="current page-control-1"><a href="#lib_heading" class="display-page-action" data-page="1">1</a></li>
    <?php for($i=2;$i<=$page;$i++): ?>
        <li class="page-control-<?php echo $i; ?>"><a href="#lib_heading" class="display-page-action" data-page="<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php endfor; ?>
        <li class="arrow"><a href="#lib_heading" class="display-page-action" data-page="<?php echo $page; ?>">&raquo;</a></li>
  </ul>
</div>
<!--end pagination controls-->
</section>
<?php endif; ?>

<?php get_footer(); ?>
