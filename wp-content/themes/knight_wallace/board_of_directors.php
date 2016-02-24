<?php
/**
 * Template Name: Board of Directors
 *
 *
 * @package knight_wallace
 */

get_header('fellows'); ?>

<?php
include_once('helpers.php');
//grab our junk
$alerts = get_posts(array('category_name'=>'alert'));
$board_members = get_posts(array('post_type'=>'person_board_member','posts_per_page'=>200));
$sorted_board_members = sort_board_of_directors($board_members);
?>

<section class="breadcrumb">
<div class="row">
    <div class="small-6 columns">
        <a href="/knight-wallace-fellowships/" class="library-link">Knight-Wallace</a>
    </div>
</div>
</section>

<main id="main" class="site-main post-main" role="main">
    <div class="row">
        <div class="large-12 columns">
            <h1 class="entry-title">Board of Directors</h1>
        </div>
    </div>
    <div class="row board-of-directors">
        <div class="large-10 large-centered columns">
            <?php if(!empty($sorted_board_members)): ?>
                <?php foreach($sorted_board_members as $board_member): ?>
                    <div class="row director">
                        <div class="medium-2 columns">
                            <div class="board-member-image"><?php echo $board_member['image']; ?></div>
                        </div>
                        <div class="medium-10 columns">
                            <p class="name">
                                <a href="<?php echo $board_member['link']; ?>" class="board-member-link">
                                <?php echo $board_member['first_name']; ?>
                                <?php echo $board_member['last_name']; ?></a>
                            </p>
                            <p class="title">
                                <?php echo $board_member['title']; ?>
                                <?php echo $board_member['ass']; ?>
                            </p>
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
