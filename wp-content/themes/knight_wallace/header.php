<?php
/**
 * The header for our theme. This header is intended for use with Wallace House pages
 * this is also the default header
 *
 *
 * @package knight_wallace
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
<?php wp_head(); ?>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/bower_components/modernizr/modernizr.js"></script>
</head>

<body <?php body_class(); ?> id="wallace_house_page">
  <header id="header">
    <div class="row" id="eyebrow">
      <div class="large-12 columns">
        <ul>
          <li><a href="">Contact Us</a> | </li>
          <li><a href="">Donate</a> | </li>
          <li><a href=""><i class="fa fa-search"></i></a></li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="large-4 columns">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/wallacehouselogo.png" alt="Knight-Wallace" />
        </a>
      </div>
      <div class="large-8 columns">
        <h1>Knight-Wallace Fellowships for Journalists<br />and the Livingston Awards</h1>
      </div>
    </div>
  </header>
<nav id="main_nav">
<?php
//Grab Main nav item items
$main_menu = wp_get_nav_menu_items('primary');
$ni1_link = !empty($main_menu[0]->url) ? $main_menu[0]->url : "Menu Item";
$ni1_title = !empty($main_menu[0]->title) ? $main_menu[0]->title : "Menu Item";
$ni2_link = !empty($main_menu[1]->url) ? $main_menu[1]->url : "Menu Item";
$ni2_title = !empty($main_menu[1]->title) ? $main_menu[1]->title : "Menu Item";
$ni3_link = !empty($main_menu[2]->url) ? $main_menu[2]->url : "Menu Item";
$ni3_title = !empty($main_menu[2]->title) ? $main_menu[2]->title : "Menu Item";
?>
    <div class="row small-collapse">
      <div class="large-4 columns">
        <p class="primary active wallace-house" data-sub-nav-menu="wallace-house">
        <a href="<?php echo $ni1_link; ?>"><?php echo $ni1_title; ?></a>
        </p>
      </div>
      <div class="large-4 columns">
        <p class="primary knight-wallace-fellows" data-sub-nav-menu="knight-wallace-fellows">
            <a href="<?php echo $ni2_link; ?>"><?php echo $ni2_title; ?></a>
        </p>
      </div>
      <div class="large-4 columns">
        <p class="primary livingston-awards" data-sub-nav-menu="livingston-awards">
            <a href="<?php echo $ni3_link; ?>"><?php echo $ni3_title; ?></a>
        </p>
      </div>
    </div>
    <div class="sub-nav-wrap">
      <div class="row">
        <div class="large-12 columns">

<?php $sub_menu_one = wp_get_nav_menu_items('sub-menu-one'); ?>

          <ul class="wallace-house">

<?php if(!empty($sub_menu_one)): ?>

    <?php foreach($sub_menu_one as $smo_obj): ?>

        <li><a href="<?php echo $smo_obj->url; ?>"><?php echo $smo_obj->title; ?></a></li>

    <?php endforeach;?>

<?php endif; ?>

          </ul>

<?php $sub_menu_two = wp_get_nav_menu_items('sub-menu-two'); ?>

          <ul class="knight-wallace-fellows disappear">

<?php if(!empty($sub_menu_two)): ?>

    <?php foreach($sub_menu_two as $smo_obj2): ?>

        <li><a href="<?php echo $smo_obj2->url; ?>"><?php echo $smo_obj2->title; ?></a></li>

    <?php endforeach;?>

<?php endif; ?>

          </ul>

<?php $sub_menu_three = wp_get_nav_menu_items('sub-menu-three'); ?>

          <ul class="livingston-awards disappear">

<?php if(!empty($sub_menu_three)): ?>

    <?php foreach($sub_menu_three as $smo_obj3): ?>

        <li><a href="<?php echo $smo_obj3->url; ?>"><?php echo $smo_obj3->title; ?></a></li>

    <?php endforeach;?>

<?php endif; ?>

          </ul>
        </div>
      </div>
    </div>
</nav>

<nav id="mobile_nav">
<?php
//Grab Mobile nav item items
//$mobile_menu = wp_get_nav_menu_items('mobile');
?>
<div class="mobile-menu-trigger-wrap">
    <div class="row">
        <div class="small-2 columns small-offset-10"><p class="mobile-menu-trigger">Menu</p></div>
    </div>
</div>
<div class="row mobile-menu-wrap">
    <div class="large-12 columns">
        <?php wp_nav_menu('mobile'); ?>
    </div>
</div>
</nav>
