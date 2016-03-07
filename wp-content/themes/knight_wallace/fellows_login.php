<?php
/**
 * Template Name: Fellows Login Page
 *
 *
 * @package knight_wallace
 */

session_start();
include_once('helpers.php');

if(empty($_SESSION['form_id'])){
    $_SESSION['form_id'] = rand().'form'.time();
}

if(isset($_POST) && !empty($_POST['fellow_login']) && $_POST['fellow_login'] == $_SESSION['form_id']){
    if(empty($_POST['username']) || empty($_POST['password'])){
        $logged_in = false;
        $message = 'Please enter both a username and password';
        $message_type = 'warning';
    }else{
        //login the user
        $logged_in = login_fellows_user($_POST['username'],$_POST['password'],$_SESSION['form_id']);
        if($logged_in){
            $_SESSION['logged_in'] = $_SESSION['form_id'];
        }else{
            $message = 'Sorry, that was the wrong username or password';
            $message_type = 'alert';
        }
    }
}else{
    $logged_in = is_fellows_user_logged_in($_SESSION);
}

get_header('fellows'); ?>

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

<?php if($logged_in): ?>

  <main class="fellows-sub-page">
    <div class="row">
      <div class="large-12 columns">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'template-parts/content', 'page' ); ?>
    <?php endwhile; // End of the loop. ?>
      </div>
    </div>
  </main>

<?php else: ?>

<?php if(!empty($message)): ?>
<div class="row">
    <div class="large-12 columns">
    <div data-alert class="alert-box radius <?php echo !empty($message_type) ? $message_type : ''; ?>">
            <?php echo $message; ?>
            <a href="#" class="close">&times;</a>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="row">
    <div class="large-12 columns">
        <form method="post" class="meet-fellows-login" action="">
            <div class="row">
                <div class="large-12 columns">
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="Enter username" />
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter password" />
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                <input type="hidden" name="fellow_login" value="<?php echo $_SESSION['form_id']; ?>" />
                    <input type="submit" value="Sign In" class="button" />
                </div>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<?php get_footer('fellows'); ?>
