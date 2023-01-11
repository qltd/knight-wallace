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
            <?php if (is_active_sidebar('kwf-footer-left') && (is_page('knight-wallace') || (isset($post->post_parent->post_name) && $post->post_parent->post_name === 'knight-wallace'))){ 
                $footerLeftSidebar = 'kwf-footer-left';
            } elseif (is_active_sidebar('la-footer-left') && (is_page('livingston-awards') || (isset($post->post_parent->post_name) && $post->post_parent->post_name === 'livingston-awards'))){ 
                $footerLeftSidebar = 'la-footer-left';
            } else { 
                $footerLeftSidebar = 'wallace-house-footer-left';
            }  ?>
          <?php dynamic_sidebar( $footerLeftSidebar ); ?>
        </div>
        <div class="medium-6 columns">
          <?php if (is_active_sidebar('kwf-footer-right') && (is_page('knight-wallace') || (isset($post->post_parent->post_name) && $post->post_parent->post_name === 'knight-wallace'))){ 
                $footerRightSidebar = 'kwf-footer-right';
            } elseif (is_active_sidebar('la-footer-right') && (is_page('livingston-awards') || (isset($post->post_parent->post_name) && $post->post_parent->post_name === 'livingston-awards'))){ 
                $footerRightSidebar = 'la-footer-right';
            } else { 
                $footerRightSidebar = 'wallace-house-footer-right';
            } ?>
          <?php dynamic_sidebar( $footerRightSidebar ); ?>
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


<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-NLG296NBJF"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-NLG296NBJF');
</script>


</body>
</html>