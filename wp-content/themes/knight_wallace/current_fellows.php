<?php
/**
* Template Name: Current Fellows
*
*
* @package knight_wallace
*/

get_header('fellows'); ?>

<?php
include_once('helpers.php');
//grab our junk
$this_page_meta = get_post_meta($post->ID);
$this_year = !empty($this_page_meta['year']) ? $this_page_meta['year'][0] : null;
$alerts = get_posts(array('category_name'=>'alert'));
$fellows = get_posts(array('post_type'=>'person_kw_fellow','posts_per_page'=> -1));
$sorted_fellows = sort_fellows_by_year($fellows, $this_year);
?>

<section class="breadcrumb">
    <div class="row">
        <div class="small-6 columns">
            <a href="/knight-wallace/" class="library-link">&nbsp;Knight-Wallace Fellowships</a>
        </div>
    </div>
</section>

<div class="row">
    <div class="large-12 columns">
        <h1 class="entry-title text-center">Current Fellows</h1>
    </div>
</div>

<div class="in-this-section-nav">
    <div class="row">
        <div class="large-12 columns">
            <ul class="inline">
                <li>
                    <a href="<?php echo get_permalink(7157); ?>">Past Fellows</a>
                    <?php /* |
                    <a href="#">Alumni Locator</a> */ ?>
                </li>
            </ul>
        </div>
    </div>
</div>

    <main id="main" class="site-main post-main" role="main">
    <div class="row board-of-directors">
        <div class="large-10 large-centered columns">
            <?php if(!empty($sorted_fellows)): ?>
            <?php foreach($sorted_fellows as $fellow): ?>
            <div class="row director">
                <div class="medium-2 columns">
                    <div class="fellow-image"><?php echo $fellow['image']; ?></div>
                </div>
                <div class="medium-10 columns">
                    <p class="name">
                            <?php echo $fellow['first_name']; ?>
                            <?php echo $fellow['last_name']; ?>
                    </p>
                    <p class="aff">
                    <span class="job"><?php echo $fellow['job']; ?></span><?php if(!empty($fellow['aff'])): ?>, <?php echo $fellow['aff']; ?><?php endif; ?>
                    </p>
                    <?php if(!empty($fellow['title'])): ?>
                    <p class="title">
                        Study Plan: <?php echo $fellow['title']; ?>
                    </p>
                    <?php endif; ?>
                    <?php if(!empty($fellow['bio'])): ?>
                    <div class="bio">
                        <?php echo $fellow['bio']; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    </main>

    <?php
    //display alerts
    if(!empty($alerts)):
    ?>
    <section id="alerts">
        <?php foreach($alerts as $alert): ?>
        <div class="row alert">
            <div class="large-4 columns">
                <p>
                    <strong><?php echo $alert->post_title; ?></strong>
                <br /><?php echo $alert->post_excerpt; ?></p>
            </div>
            <div class="large-8 columns">
                <p><?php echo $alert->post_content; ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </section>
    <?php endif; ?>


    <?php get_footer('fellows'); ?>
