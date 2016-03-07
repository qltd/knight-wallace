<?php
/**
 * Template part for displaying private meet the fellows page
 *
 *
 * @package knight_wallace
 */

?>

<?php
$image = get_the_post_thumbnail();
$pmeta = get_post_meta($post->ID);
$this_year = !empty($pmeta['year']) ? $pmeta['year'][0] : null;
$fellows = get_posts(array('post_type'=>'person_kw_fellow','posts_per_page'=> -1));
$sorted_fellows = sort_fellows_by_year($fellows, $this_year);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if(!empty($image)): ?>
<div class="row">
    <div class="large-10 columns">
        <div class="featured-image-wrap">
            <?php echo $image; ?>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <div class="large-10 large-centered columns">
        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->
    </div>
</div>
<?php $children = get_pages('child_of='.$post->ID.'&parent='.$post->ID); ?>
<?php if(!empty($children)): ?>
<div class="in-this-section-nav">
    <div class="row">
        <div class="large-12 columns">
            <ul class="inline">
            <?php $c = 0; ?>
            <?php $count = count($children); ?>
            <?php foreach($children as $child): ?>
                <li><a href="<?php echo $child->guid; ?>"><?php echo $child->post_title; ?></a>
                <?php if($c < $count - 1): ?>
                    &nbsp;|&nbsp;
                <?php endif; ?>
                </li>
            <?php $c += 1; ?>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <div class="large-10 large-centered columns">
        <div class="content">
            <?php the_content(); ?>
        </div>
    </div>
</div>
<div class="meet-the-fellows-list">
    <div class="row board-of-directors">
        <div class="large-10 columns large-centered">
            <?php if(!empty($sorted_fellows)): ?>
                <?php foreach($sorted_fellows as $fellow): ?>
                    <div class="row director">
                        <div class="large-2 columns">
                                 <div class="board-member-image">
                                <?php if(!empty($fellow['pic_private'])): ?>
                                    <img src="<?php echo $fellow['pic_private']; ?>" alt="Fellow Personal Pic" />
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="large-10 columns">
                            <p class="name">
                                <?php echo $fellow['first_name']; ?>&nbsp;<?php echo $fellow['last_name']; ?>
                            </p>
                            <p class="title">
                            <?php echo $fellow['title']; ?>
                            </p>
                            <p class="bio">
                            <?php echo $fellow['bio_private']; ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php if(!empty($pmeta['accordion'])): ?>
<div class="row">
    <div class="large-12 columns">
        <ul class="accordion" data-accordion>
        <?php $acount = 1; ?>
        <?php foreach($pmeta['accordion'] as $accord): ?>
            <?php preg_match("/\[title (.+?)\]/",$accord,$matches); ?>
            <?php $accord_title = !empty($matches[0]) ? $matches[0] : ''; ?>
            <?php $accord = !empty($accord_title) ? preg_replace($accord_title,'',$accord) : $accord; ?>
            <?php $accord = preg_replace("/\[\]/",'',$accord); ?>
          <li class="accordion-navigation">
              <a href="#panel<?php echo $acount; ?>a">
                  <?php $accord_title = preg_replace("/\[title/",'',$accord_title); ?>
                  <?php $accord_title = preg_replace("/\]/",'',$accord_title); ?>
                  <?php echo !empty($accord_title) ? $accord_title : 'Accordion '.$acount; ?>
              </a>
            <div id="panel<?php echo $acount; ?>a" class="content active">
                <?php echo $accord; ?>
            </div>
          </li>
        <?php $acount += 1; ?>
        <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>
</article><!-- #post-## -->

