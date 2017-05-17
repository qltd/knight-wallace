<?php
/**
 * Template Name: Library
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
include_once('helpers.php');
$libs = get_posts(array('post_type'=>'library','posts_per_page'=> -1));
$sorted_libs = sort_library_items($libs);
?>

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

<?php if(!empty($sorted_libs['Article'])): ?>
<section class="story-list library" id="articles">
    <div class="row headings">
        <div class="large-12 columns">
            <div class="heading">
                <h3>Articles</h3>
            </div>
        </div>
    </div>
    <div class="row"><!--start first row-->
        <div class="large-6 columns">
            <div class="row">
                <div class="large-12 columns">
                    <div class="news-article">
                        <?php if(!empty($sorted_libs['Article'][0]['image'])): ?>
                            <?php echo $sorted_libs['Article'][0]['image']; ?>
                        <?php else: ?>
                            <div style="min-height: 140px;"></div>
                        <?php endif; ?>

                        <div class="text">
                            <h4>
                                <a href="<?php echo $sorted_libs['Article'][0]['link']; ?>">
                                    <?php echo $sorted_libs['Article'][0]['title']; ?>
                                </a>
                            </h4>
                            <div class="date"><?php echo $sorted_libs['Article'][0]['author']; ?></div>
                            <div class="tags-list">
                                <ul>
                                <?php if(!empty($sorted_libs['Article'][0]['tags'])): ?>
                                    <?php foreach($sorted_libs['Article'][0]['tags'] as $tag): ?>
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
        <div class="large-6 columns">
            <div class="row news snippet-box">
                <div class="large-12 columns">
                    <div class="news-article">

                                <?php if(!empty($sorted_libs['Article'][1]['image'])): ?>
                                    <?php echo $sorted_libs['Article'][1]['image']; ?>
                                <?php else: ?>
                                    <div style="min-height: 140px;"></div>
                                <?php endif; ?>

                                <div class="text">
                                    <h4>
                                        <a href="<?php echo $sorted_libs['Article'][1]['link']; ?>">
                                            <?php echo $sorted_libs['Article'][1]['title']; ?>
                                        </a>
                                    </h4>
                                    <div class="date"><?php echo $sorted_libs['Article'][1]['author']; ?></div>
                                    <div class="tags-list">
                                        <ul>
                                        <?php if(!empty($sorted_libs['Article'][1]['tags'])): ?>
                                            <?php foreach($sorted_libs['Article'][1]['tags'] as $tag): ?>
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
    </div><!--end first row-->
    <div class="row"><!--start second row-->
        <div class="large-6 columns"><!--start first column-->
            <div class="row news snippet-box">
                <div class="large-12 columns">
                    <div class="news-article">
                        <?php if(!empty($sorted_libs['Article'][2]['image'])): ?>
                            <?php echo $sorted_libs['Article'][2]['image']; ?>
                        <?php else: ?>
                            <div style="min-height: 140px;"></div>
                        <?php endif; ?>

                                <div class="text">
                                    <h4>
                                        <a href="<?php echo $sorted_libs['Article'][2]['link']; ?>">
                                            <?php echo $sorted_libs['Article'][2]['title']; ?>
                                        </a>
                                    </h4>
                                    <div class="date"><?php echo $sorted_libs['Article'][2]['author']; ?></div>
                                    <div class="tags-list">
                                        <ul>
                                        <?php if(!empty($sorted_libs['Article'][2]['tags'])): ?>
                                            <?php foreach($sorted_libs['Article'][2]['tags'] as $tag): ?>
                                            <li><?php echo $tag->name; ?> <span class="divider">|</span></li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </ul>

                            </div>
                        </div>
                    </div>
                </div><!--end row news snippet-box-->
            </div><!--end first column-->
        </div>
        <div class="large-6 columns">
            <a href="/wallace-house/library/articles/" class="more-posts">See all Wallace House articles &raquo;</a>
        </div>
    </div><!--end second row-->
</section>
<?php endif; ?>

<?php if(!empty($sorted_libs['Book'])): ?>
<section class="story-list library" id="books">
    <div class="row headings">
        <div class="large-12 columns">
            <div class="heading">
                <h3>Books</h3>
            </div>
        </div>
    </div>
    <div class="row"><!--start first row-->
        <div class="large-6 columns">
            <div class="row">
                <div class="large-12 columns">
                    <div class="news-article books">

                                <?php if(!empty($sorted_libs['Book'][0]['image'])): ?>
                                    <?php echo $sorted_libs['Book'][0]['image']; ?>
                                <?php else: ?>
                                    <div style="min-height: 140px;"></div>
                                <?php endif; ?>

                                <div class="text">
                                    <h4>
                                        <a href="<?php echo $sorted_libs['Book'][0]['link']; ?>">
                                            <?php echo $sorted_libs['Book'][0]['title']; ?>
                                        </a>
                                    </h4>
                                    <div class="date"><?php echo $sorted_libs['Book'][0]['author']; ?></div>
                                    <div class="tags-list">
                                        <ul>
                                        <?php if(!empty($sorted_libs['Book'][0]['tags'])): ?>
                                            <?php foreach($sorted_libs['Book'][0]['tags'] as $tag): ?>
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
        <div class="large-6 columns">
            <div class="row news snippet-box">
                <div class="large-12 columns">
                    <div class="news-article books">

                                <?php if(!empty($sorted_libs['Book'][1]['image'])): ?>
                                    <?php echo $sorted_libs['Book'][1]['image']; ?>
                                <?php else: ?>
                                    <div style="min-height: 140px;"></div>
                                <?php endif; ?>

                                <div class="text">
                                    <h4>
                                        <a href="<?php echo $sorted_libs['Book'][1]['link']; ?>">
                                            <?php echo $sorted_libs['Book'][1]['title']; ?>
                                        </a>
                                    </h4>
                                    <div class="date"><?php echo $sorted_libs['Book'][1]['author']; ?></div>
                                    <div class="tags-list">
                                        <ul>
                                        <?php if(!empty($sorted_libs['Book'][1]['tags'])): ?>
                                            <?php foreach($sorted_libs['Book'][1]['tags'] as $tag): ?>
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
    </div><!--end first row-->
    <div class="row"><!--start second row-->
        <div class="large-6 columns"><!--start first column-->
            <div class="row news snippet-box">
                <div class="large-12 columns">
                    <div class="news-article books">

                                <?php if(!empty($sorted_libs['Book'][2]['image'])): ?>
                                    <?php echo $sorted_libs['Book'][2]['image']; ?>
                                <?php else: ?>
                                    <div style="min-height: 140px;"></div>
                                <?php endif; ?>

                                <div class="text">
                                    <h4>
                                        <a href="<?php echo $sorted_libs['Book'][2]['link']; ?>">
                                            <?php echo $sorted_libs['Book'][2]['title']; ?>
                                        </a>
                                    </h4>
                                    <div class="date"><?php echo $sorted_libs['Book'][2]['author']; ?></div>
                                    <div class="tags-list">
                                        <ul>
                                        <?php if(!empty($sorted_libs['Book'][2]['tags'])): ?>
                                            <?php foreach($sorted_libs['Book'][2]['tags'] as $tag): ?>
                                            <li><?php echo $tag->name; ?> <span class="divider">|</span></li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </ul>

                            </div>
                        </div>
                    </div>
                </div><!--end row news snippet-box-->
            </div><!--end first column-->
        </div>
        <div class="large-6 columns">
            <a href="/wallace-house/library/books/" class="more-posts">See all Wallace House books &raquo;</a>
        </div>
    </div><!--end second row-->
</section>
<?php endif; ?>

<?php if(!empty($sorted_libs['Video'])): ?>
<section class="story-list library" id="videos">
    <div class="row headings">
        <div class="large-12 columns">
            <div class="heading">
                <h3>Videos</h3>
            </div>
        </div>
    </div>
    <div class="row"><!--start first row-->
        <div class="large-6 columns">
            <div class="row">
                <div class="large-12 columns">
                    <div class="news-article">

                                <?php if(!empty($sorted_libs['Video'][0]['image'])): ?>
                                    <?php echo $sorted_libs['Video'][0]['image']; ?>
                                <?php else: ?>
                                    <div style="min-height: 140px;"></div>
                                <?php endif; ?>

                                <div class="text">
                                    <h4>
                                        <a href="<?php echo $sorted_libs['Video'][0]['link']; ?>">
                                            <?php echo $sorted_libs['Video'][0]['title']; ?>
                                        </a>
                                    </h4>
                                    <div class="date"><?php echo $sorted_libs['Video'][0]['author']; ?></div>
                                    <div class="tags-list">
                                        <ul>
                                        <?php if(!empty($sorted_libs['Video'][0]['tags'])): ?>
                                            <?php foreach($sorted_libs['Video'][0]['tags'] as $tag): ?>
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
        <div class="large-6 columns">
            <div class="row news snippet-box">
                <div class="large-12 columns">
                    <div class="news-article">

                                <?php if(!empty($sorted_libs['Video'][1]['image'])): ?>
                                    <?php echo $sorted_libs['Video'][1]['image']; ?>
                                <?php else: ?>
                                    <div style="min-height: 140px;"></div>
                                <?php endif; ?>

                                <div class="text">
                                    <h4>
                                        <a href="<?php echo $sorted_libs['Video'][1]['link']; ?>">
                                            <?php echo $sorted_libs['Video'][1]['title']; ?>
                                        </a>
                                    </h4>
                                    <div class="date"><?php echo $sorted_libs['Video'][1]['author']; ?></div>
                                    <div class="tags-list">
                                        <ul>
                                        <?php if(!empty($sorted_libs['Video'][1]['tags'])): ?>
                                            <?php foreach($sorted_libs['Video'][1]['tags'] as $tag): ?>
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
    </div><!--end first row-->
    <div class="row"><!--start second row-->
        <div class="large-6 columns"><!--start first column-->
            <div class="row news snippet-box">
                <div class="large-12 columns">
                    <div class="news-article">

                                <?php if(!empty($sorted_libs['Video'][2]['image'])): ?>
                                    <?php echo $sorted_libs['Video'][2]['image']; ?>
                                <?php else: ?>
                                    <div style="min-height: 140px;"></div>
                                <?php endif; ?>

                                <div class="text">
                                    <h4>
                                        <a href="<?php echo $sorted_libs['Video'][2]['link']; ?>">
                                            <?php echo $sorted_libs['Video'][2]['title']; ?>
                                        </a>
                                    </h4>
                                    <div class="date"><?php echo $sorted_libs['Video'][2]['author']; ?></div>
                                    <div class="tags-list">
                                        <ul>
                                        <?php if(!empty($sorted_libs['Video'][2]['tags'])): ?>
                                            <?php foreach($sorted_libs['Video'][2]['tags'] as $tag): ?>
                                            <li><?php echo $tag->name; ?> <span class="divider">|</span></li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </ul>

                            </div>
                        </div>
                    </div>
                </div><!--end row news snippet-box-->
            </div><!--end first column-->
        </div>
        <div class="large-6 columns">
            <a href="/wallace-house/library/videos/" class="more-posts">See all Wallace House videos &raquo;</a>
        </div>
    </div><!--end second row-->
</section>
<?php endif; ?>

<?php if(!empty($sorted_libs['Photojournalism'])): ?>
<section class="story-list library" id="photojournalism">
    <div class="row headings">
        <div class="large-12 columns">
            <div class="heading">
                <h3>Photojournalism</h3>
            </div>
        </div>
    </div>
    <div class="row"><!--start first row-->
        <div class="large-6 columns">
            <div class="row">
                <div class="large-12 columns">
                    <div class="news-article">

                                <?php if(!empty($sorted_libs['Photojournalism'][0]['image'])): ?>
                                    <?php echo $sorted_libs['Photojournalism'][0]['image']; ?>
                                <?php else: ?>
                                    <div style="min-height: 140px;"></div>
                                <?php endif; ?>

                                <div class="text">
                                    <h4>
                                        <a href="<?php echo $sorted_libs['Photojournalism'][0]['link']; ?>">
                                            <?php echo $sorted_libs['Photojournalism'][0]['title']; ?>
                                        </a>
                                    </h4>
                                    <div class="date"><?php echo $sorted_libs['Photojournalism'][0]['author']; ?></div>
                                    <div class="tags-list">
                                        <ul>
                                        <?php if(!empty($sorted_libs['Photojournalism'][0]['tags'])): ?>
                                            <?php foreach($sorted_libs['Photojournalism'][0]['tags'] as $tag): ?>
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
        <div class="large-6 columns">
            <div class="row news snippet-box">
                <div class="large-12 columns">
                    <div class="news-article">

                                <?php if(!empty($sorted_libs['Photojournalism'][1]['image'])): ?>
                                    <?php echo $sorted_libs['Photojournalism'][1]['image']; ?>
                                <?php else: ?>
                                    <div style="min-height: 140px;"></div>
                                <?php endif; ?>

                                <div class="text">
                                    <h4>
                                        <a href="<?php echo $sorted_libs['Photojournalism'][1]['link']; ?>">
                                            <?php echo $sorted_libs['Photojournalism'][1]['title']; ?>
                                        </a>
                                    </h4>
                                    <div class="date"><?php echo $sorted_libs['Photojournalism'][1]['author']; ?></div>
                                    <div class="tags-list">
                                        <ul>
                                        <?php if(!empty($sorted_libs['Photojournalism'][1]['tags'])): ?>
                                            <?php foreach($sorted_libs['Photojournalism'][1]['tags'] as $tag): ?>
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
    </div><!--end first row-->
    <div class="row"><!--start second row-->
        <div class="large-6 columns"><!--start first column-->
            <div class="row news snippet-box">
                <div class="large-12 columns">
                    <div class="news-article">

                                <?php if(!empty($sorted_libs['Photojournalism'][2]['image'])): ?>
                                    <?php echo $sorted_libs['Photojournalism'][2]['image']; ?>
                                <?php else: ?>
                                    <div style="min-height: 140px;"></div>
                                <?php endif; ?>

                                <div class="text">
                                    <h4>
                                        <a href="<?php echo $sorted_libs['Photojournalism'][2]['link']; ?>">
                                            <?php echo $sorted_libs['Photojournalism'][2]['title']; ?>
                                        </a>
                                    </h4>
                                    <div class="date"><?php echo $sorted_libs['Photojournalism'][2]['author']; ?></div>
                                    <div class="tags-list">
                                        <ul>
                                        <?php if(!empty($sorted_libs['Photojournalism'][2]['tags'])): ?>
                                            <?php foreach($sorted_libs['Photojournalism'][2]['tags'] as $tag): ?>
                                            <li><?php echo $tag->name; ?> <span class="divider">|</span></li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </ul>

                            </div>
                        </div>
                    </div>
                </div><!--end row news snippet-box-->
            </div><!--end first column-->
        </div>
        <div class="large-6 columns">
            <a href="/wallace-house/library/photojournalism/" class="more-posts">See all Wallace House photojournalism &raquo;</a>
        </div>
    </div><!--end second row-->
</section>
<?php endif; ?>

<?php if(!empty($sorted_libs['Journal'])): ?>
<section class="story-list library" id="journals">
    <div class="row headings">
        <div class="large-12 columns">
            <div class="heading">
                <h3>Wallace House Journals</h3>
            </div>
        </div>
    </div>
    <div class="row"><!--start first row-->
        <div class="large-6 columns">
            <div class="row">
                <div class="large-12 columns">
                    <div class="news-article">

                                <?php if(!empty($sorted_libs['Journal'][0]['image'])): ?>
                                    <?php echo $sorted_libs['Journal'][0]['image']; ?>
                                <?php else: ?>
                                    <div style="min-height: 140px;"></div>
                                <?php endif; ?>

                                <div class="text">
                                    <h4>
                                        <a href="<?php echo $sorted_libs['Journal'][0]['link']; ?>">
                                            <?php echo $sorted_libs['Journal'][0]['title']; ?>
                                        </a>
                                    </h4>
                                    <div class="date"><?php echo $sorted_libs['Journal'][0]['author']; ?></div>
                                    <div class="tags-list">
                                        <ul>
                                        <?php if(!empty($sorted_libs['Journal'][0]['tags'])): ?>
                                            <?php foreach($sorted_libs['Journal'][0]['tags'] as $tag): ?>
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
        <div class="large-6 columns">
            <div class="row news snippet-box">
                <div class="large-12 columns">
                    <div class="news-article">

                                <?php if(!empty($sorted_libs['Journal'][1]['image'])): ?>
                                    <?php echo $sorted_libs['Journal'][1]['image']; ?>
                                <?php else: ?>
                                    <div style="min-height: 140px;"></div>
                                <?php endif; ?>

                                <div class="text">
                                    <h4>
                                        <a href="<?php echo $sorted_libs['Journal'][1]['link']; ?>">
                                            <?php echo $sorted_libs['Journal'][1]['title']; ?>
                                        </a>
                                    </h4>
                                    <div class="date"><?php echo $sorted_libs['Journal'][1]['author']; ?></div>
                                    <div class="tags-list">
                                        <ul>
                                        <?php if(!empty($sorted_libs['Journal'][1]['tags'])): ?>
                                            <?php foreach($sorted_libs['Journal'][1]['tags'] as $tag): ?>
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
    </div><!--end first row-->
    <div class="row"><!--start second row-->
        <div class="large-6 columns"><!--start first column-->
            <div class="row news snippet-box">
                <div class="large-12 columns">
                    <div class="news-article">

                                <?php if(!empty($sorted_libs['Journal'][2]['image'])): ?>
                                    <?php echo $sorted_libs['Journal'][2]['image']; ?>
                                <?php else: ?>
                                    <div style="min-height: 140px;"></div>
                                <?php endif; ?>

                                <div class="text">
                                    <h4>
                                        <a href="<?php echo $sorted_libs['Journal'][2]['link']; ?>">
                                            <?php echo $sorted_libs['Journal'][2]['title']; ?>
                                        </a>
                                    </h4>
                                    <div class="date"><?php echo $sorted_libs['Journal'][2]['author']; ?></div>
                                    <div class="tags-list">
                                        <ul>
                                        <?php if(!empty($sorted_libs['Journal'][2]['tags'])): ?>
                                            <?php foreach($sorted_libs['Journal'][2]['tags'] as $tag): ?>
                                            <li><?php echo $tag->name; ?> <span class="divider">|</span></li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </ul>

                            </div>
                        </div>
                    </div>
                </div><!--end row news snippet-box-->
            </div><!--end first column-->
        </div>
        <div class="large-6 columns">
            <a href="/wallace-house/library/journals/" class="more-posts">See all Wallace House Journals &raquo;</a>
        </div>
    </div><!--end second row-->
</section>
<?php endif; ?>
<?php get_footer(); ?>
