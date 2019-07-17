
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
                  <img src="<?php echo get_bloginfo('template_directory') . '/assets/images/WH-presents-logo-1.svg'; ?>" class="wh-presents-logo" />
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
</div>
<?php endif; ?>
