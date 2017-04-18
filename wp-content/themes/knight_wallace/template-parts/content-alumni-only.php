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

// determine if current user logged in and is an Alumni user
$is_user_logged_in = is_user_logged_in();
$is_alumi_user = is_alumni_user();
        
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

<?php 
if($is_user_logged_in && $is_alumi_user): // only show local nav for alumni users ?>
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
<?php endif; ?>

<div class="row">
    <div class="large-10 large-centered columns">
        <div class="content">
            <?php 
            // if current user is logged in, and IS an Alumni, display Alumni content 
            if($is_user_logged_in && $is_alumi_user):
                the_content();

            // if current user is logged in, but is NOT an Alumni
            elseif($is_user_logged_in && !$is_alumi_user):
                echo '<p>Sorry, you are logged in, but you must be an Alumni to view this content.</p>';

            // otherwise, show login form
            else :
                // if we have errors, let's show them
                if( isset($_GET['login']) ){ echo login_error(); }
                ?>
                <div class="large-8 large-centered columns">
                <p>Please log in to view this content.</p>
                    <?php // output login form
                    wp_login_form(array('form_id' => 'alumni_login_form')); 
                    ?>
                </div>
            <?php endif; ?>
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

