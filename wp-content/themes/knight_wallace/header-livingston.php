<?php
/**
 * The header for Livingston Awards pages
 *
 *
 * @package knight_wallace
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
<?php wp_head(); ?>
<script src="<?php echo get_template_directory(); ?>/assets/bower_components/modernizr/modernizr.js"></script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site fellows-page">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'knight_wallace' ); ?></a>
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
            <img src="<?php echo get_template_directory(); ?>/assets/images/uofmlogo.png" alt="Knight-Wallace" />
        </a>
      </div>
      <div class="large-8 columns">
        <h1>Fellowships for Journalists</h1>
      </div>
    </div>
  </header>


		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'knight_wallace' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->

