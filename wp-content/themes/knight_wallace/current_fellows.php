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

<?php if(!is_null($this_year)): ?>
<section class="year-control">
    <div class="row">
        <div class="large-12 columns">
            <div class="row">
                    <div class="large-12 columns">
                        <h4>VIEW BY CLASS YEAR:</h4>
                    </div>
            </div>
            <div class="row years">
                <div class="large-12 columns">
                    <?php $count = 1;?>
                    <div class="row">
                        <?php for($i=$this_year;$i>1973;$i--): ?>
                        <div class="medium-3 small-6 columns">
                            <a href="/knight-wallace/our-fellows/<?php echo $i - 1 .'-'. $i; ?>/"><?php echo $i - 1 .'-'. $i; ?></a>
                        </div>
                        <?php if($count == 4): ?>
                    </div>
                    <div class="row">
                        <?php $count = 0; ?>
                        <?php endif; ?>
                        <?php $count += 1; ?>
                        <?php endfor; ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="medium-9 columns"></div>
            <div class="medium-3 small-6 columns">
                <a href="#" class="show-more">More &raquo;</a>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="large-12 columns">
            <h2 class="entry-sub-title text-center"><?php echo $this_year - 1 .'-'. $this_year; ?> Fellows</h2>
        </div>
    </div>
    <?php endif; ?>

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
                        <span class="job"><?php echo $fellow['job']; ?></span>, <?php echo $fellow['aff']; ?>
                    </p>
                    <?php if(!empty($fellow['title'])): ?>
                    <p class="title">
                        Study Plan: <?php echo $fellow['title']; ?>
                    </p>
                    <?php endif; ?>
                    <?php if(!empty($fellow['bio'])): ?>
                    <p class="bio">
                        <?php echo $fellow['bio']; ?>
                    </p>
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
