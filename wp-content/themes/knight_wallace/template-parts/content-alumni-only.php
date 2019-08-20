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
            <h1 class="entry-title">
              <?php if($is_user_logged_in && $is_alumi_user): ?>
                Alumni Profile
              <?php else: ?>
                <?php the_title(); ?>
              <?php endif; ?>
            </h1>
        </header><!-- .entry-header -->
    </div>
</div>

<?php
if($is_user_logged_in && $is_alumi_user): // only show local nav for alumni users ?>
    <div class="in-this-section-nav">
        <div class="row">
            <div class="large-12 columns">
                <ul class="inline">
                    <li><a href="<?php echo get_permalink(7503); ?>">Alumni Locator</a> &nbsp;|&nbsp; </li>
                    <li><a href="<?php echo get_permalink(7182); ?>">Past Fellows By Class Year &nbsp;|&nbsp; </a></li>
                    <li><a href="<?php echo wp_logout_url(); ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
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
                    <h3>Helping Knight-Wallace Alumni Connect</h3>

                    <p>We've created a private web space for our alumni to network and keep connected. Please sign in here to access the restricted Alumni Locator portal to learn more about your fellow Fellows, their work, locations, areas of interest and ways to get in touch.</p>

                    <p>For alumni only. If you need access or help with your private username and password, please contact <a href="mailto:brieck@umich.edu">Birgit Rieck</a>.  </p><br /><br />

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

