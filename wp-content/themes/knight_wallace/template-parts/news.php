
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
                                    <li><?php echo $tag->name; ?> <span class="divider">|</span></li>
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
