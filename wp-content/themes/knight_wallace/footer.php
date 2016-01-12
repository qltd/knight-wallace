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
        <div class="large-6 columns">
          <h6>Wallace House at the University of Michigan</h6>
          <address>
            620 Oxford Road Ann Arbor, Michigan 48104
          </address>
          <div class="phone">Phone: <a href="#">(734) 998-7666</a></div>
          <div class="email">Email: <a href="#">livawards@umich.edu</a></div>

        </div>
        <div class="large-6 columns">
          <ul class="social-media-links">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
          </ul>

          <div class="newsletter-signup">
            <h6>Sign up for our newsletter</h6>
            <p>Your privacy is important.</p>
            <form>
              <input type="text" placeholder="Enter email" />
              <input type="submit" value="Subscribe" />
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="large-10 columns">
        <p><a href="#">University of Michigan</a> | &copy; U-M Regents</p>

      </div>
      <div class="large-2 columns">
        <p>&copy; 2015 Wallace House</p>
      </div>
    </div>
  </footer>

<?php wp_footer(); ?>

</body>
</html>
