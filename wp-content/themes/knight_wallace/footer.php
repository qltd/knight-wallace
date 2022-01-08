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
          <?php dynamic_sidebar( 'wallace-house-footer-left' ); ?>
        </div>
        <div class="medium-6 columns">
          <?php dynamic_sidebar( 'wallace-house-footer-right' ); ?>
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

<?php if (!is_user_logged_in()): ?>
    <script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-77325244-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
<?php endif; ?>

</body>
</html>
