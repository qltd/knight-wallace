<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package knight_wallace
 */

?>

  <footer class="site-footer">
    <div class="top">

      <div class="row">
         <div class="medium-6 columns">
          <?php dynamic_sidebar( 'la-footer-left' ); ?>
        </div>
         <div class="medium-6 columns">
          <?php dynamic_sidebar( 'la-footer-right' ); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="medium-8 columns">
          <?php dynamic_sidebar( 'global-footer-left' ); ?>
      </div>
      <div class="medium-4 medium-text-right columns">
          <?php dynamic_sidebar( 'global-footer-right' ); ?>
      </div>
    </div>
  </footer>

<?php wp_footer(); ?>

  <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/bower_components/foundation/js/foundation.min.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/app.js"></script>
</body>
</html>
