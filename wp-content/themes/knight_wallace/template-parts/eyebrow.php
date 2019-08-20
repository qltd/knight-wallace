<?php $eyebrow = wp_get_nav_menu_items('eyebrow'); ?>
<ul>
  <?php if(!empty($eyebrow)): ?>
      <?php foreach($eyebrow as $eye): ?>
      <li><a href="<?php echo $eye->url; ?>"><?php echo $eye->title; ?></a> | </li>
      <?php endforeach; ?>
  <?php endif; ?>

  <?php if(is_user_logged_in()): ?>
    <li><a href="<?php echo wp_logout_url(); ?>">Logout</a></li>
  <?php endif; ?>

  <li>
    <div class="row">
        <div class="small-2 columns">
            <a href="/search"><i class="fa fa-search search-form-trigger"></i></a>
        </div>
        <div class="small-10 columns">
            <div class="search-form-wrap">
              <?php  //the_widget( 'WP_Widget_Search' ); ?>
            </div>
        </div>
    </div>
  </li>
</ul>