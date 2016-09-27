<?php
/**
 * Template Name: Alumni Locator
 *
 *
 * @package knight_wallace
 */

get_header('fellows'); ?>

<?php 
include_once('alum_functions.php');
$parent_id = get_post_ancestors($post->ID); 
$parent = !empty($parent_id) ? get_post($parent_id[0]) : false;
//get fellows
$fellows = get_posts(array('post_type'=>'person_kw_fellow','posts_per_page'=> -1));
$alum = sort_alum($fellows);
//current user
$user = wp_get_current_user();
$alum_loggedin = !empty($user) && $user->roles[0] == 'administrator' || $user->roles[0] == 'alumni' ? true : false;
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
  <main class="fellows-sub-page alum-locate">
    <div class="row">
      <div class="large-12 columns">
            <p id="alum_view_switch" >View by Location</p>
      </div>
    </div>
    <div class="row" id="alum_view_special">
      <div class="large-12 columns">
            <?php $acount = 1; ?>
            <ul class="accordion" data-accordion>
            <?php foreach($alum['special'] as $special_key => $special_value): ?>
              <li class="accordion-navigation">
                  <a href="#panel<?php echo $acount; ?>a">
                    <?php echo $special_key; ?>
                  </a>
                <div id="panel<?php echo $acount; ?>a" class="content">
                    <?php foreach($special_value as $spv_ai): ?>
                    <div class="row">
                        <div class="large-12 columns">
                            <div class="indiv_alum_wrap">
                                <h3>
                                    <?php echo $spv_ai->post_title; ?>
                                </h3>
                                    <p><?php echo !empty($spv_ai->extra_data['location']) ? $spv_ai->extra_data['location'] : '';?></p>
                                    <?php if($alum_loggedin): ?>
                                    <p><?php echo !empty($spv_ai->extra_data['phone']) ? $spv_ai->extra_data['phone'] : '';?></p>
                                    <p><?php echo !empty($spv_ai->extra_data['email']) ? $spv_ai->extra_data['email'] : '';?></p>
                                    <?php endif; ?>
                            </div>
                            
                        </div>
                    </div>  
                    <?php endforeach; ?>
                </div>
              </li>
            <?php $acount += 1; ?>
            <?php endforeach; ?>
            </ul>
      </div>
    </div>
    <div class="row disappear" id="alum_view_location">
      <div class="large-12 columns">
            <?php $bcount = 1; ?>
            <ul class="accordion" data-accordion>
            <?php foreach($alum['location'] as $special_keyb => $special_valueb): ?>
              <li class="accordion-navigation">
                  <a href="#panel<?php echo $bcount; ?>ab">
                    <?php echo $special_keyb; ?>
                  </a>
                <div id="panel<?php echo $bcount; ?>ab" class="content">
                    <?php foreach($special_valueb as $spv_aib): ?>
                    <div class="row">
                        <div class="large-12 columns">
                            <div class="indiv_alum_wrap">
                                <h3>
                                    <?php echo $spv_aib->post_title; ?>
                                </h3>
                                    <p><?php echo !empty($spv_aib->extra_data['special']) ? $spv_aib->extra_data['special'] : '';?></p>

                                    <?php if($alum_loggedin): ?>
                                    <p><?php echo !empty($spv_aib->extra_data['phone']) ? $spv_aib->extra_data['phone'] : '';?></p>
                                    <p><?php echo !empty($spv_aib->extra_data['email']) ? $spv_aib->extra_data['email'] : '';?></p>
                                    <?php endif; ?>

                            </div>
                            
                        </div>
                    </div>  
                    <?php endforeach; ?>
                </div>
              </li>
            <?php $bcount += 1; ?>
            <?php endforeach; ?>
            </ul>
      </div>
    </div>
  </main>
<?php get_footer('fellows'); ?>
