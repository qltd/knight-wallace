<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package knight_wallace
 */

?>

<?php
$image = get_the_post_thumbnail();
$pmeta = get_post_meta($post->ID);
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
                <li><a href="<?php echo get_permalink($child->ID); ?>"><?php echo $child->post_title; ?></a>
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


<?php 
// custom local navigation for the Alumni Locator page 
if(get_page_template_slug() == 'alum_locate.php'):
$sort_by = htmlspecialchars($_GET['alumni-sort-by']); // determine the current 'search by' term
?>
<div class="in-this-section-nav">
    <div class="row">
        <div class="large-12 columns">
            <ul class="inline">
                <li><?php if(!$sort_by || $sort_by === 'usa'): ?>USA<?php else : ?><a href="<?php get_permalink(); ?>?alumni-sort-by=usa">USA</a><?php endif; ?>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
                <li><?php if($sort_by === 'worldwide'): ?>Worldwide<?php else : ?><a href="<?php get_permalink(); ?>?alumni-sort-by=worldwide">Worldwide</a><?php endif; ?>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
                <li><?php if($sort_by === 'subject'): ?>By Subject Matter<?php else : ?><a href="<?php get_permalink(); ?>?alumni-sort-by=subject">By Subject Matter</a><?php endif; ?></li>
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
<?php if(!empty($pmeta['accordion'])): ?>
<div class="row">
    <div class="large-10 large-centered columns">
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
            <div id="panel<?php echo $acount; ?>a" class="content">
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

