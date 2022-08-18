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

// current user
$user = wp_get_current_user();
$alum_loggedin = !empty($user) && $user->roles[0] == 'administrator' || $user->roles[0] == 'alumni' ? true : false;


// get fellows
$alum = get_posts(array(
  'post_type'       => 'person_kw_fellow',
  'posts_per_page'  => -1,
  'meta_key'        => '_kw_person_kw_fellow_last_name',
  'orderby'         => 'meta_value',
  'order'           => 'ASC'
  )
);



// SORT ALUMNI BY METAFIELD
// determine which metafield to sort by (i.e. Worldwide, USA, Subject)
// this is passed in by an "alumni-sort-by" GET variable. acceptable values are 'usa', 'worldwide', 'subject'
$sort_by = (isset($_GET['alumni-sort-by'])) ? htmlspecialchars($_GET['alumni-sort-by']) : 'usa';
$alum_sorted_by_metafield = sort_alum($sort_by, $alum);



?>

<?php if(!empty($parent)): ?>
<section class="breadcrumb">
<div class="row">
    <div class="small-6 columns">
    <a href="<?php echo !empty($parent->guid) ? get_permalink($parent->ID) : ''; ?>" class="breadcrumb-link">
        <?php echo !empty($parent->post_title) ? $parent->post_title : ''; ?>
    </a>
    </div>
</div>
</section>
<?php endif; ?>

  <main class="fellows-sub-page alum-locate">
    <div class="row">
      <div class="large-12 columns">

        <?php while ( have_posts() ) : the_post(); ?>
          <?php get_template_part( 'template-parts/content', 'page' ); ?>
        <?php endwhile; // End of the loop. ?>

        <div class="row">
          <div class="large-10 large-centered columns">

            <?php $acount = 1; ?>
            <ul class="accordion" data-accordion>
            <?php foreach($alum_sorted_by_metafield as $special_key => $special_value): ?>
              <li class="accordion-navigation">
                  <a href="#<?php echo sanitize_title_with_dashes($special_key); ?>">
                    <?php echo $special_key; ?>
                  </a>
                <div id="<?php echo sanitize_title_with_dashes($special_key); ?>" class="content">
                    <?php foreach($special_value as $spv_ai): ?>
                    <?php

                      $name =                 $spv_ai->post_title;
                      $class_year =           !empty($spv_ai->extra_data['class_year']) ? $spv_ai->extra_data['class_year'] : null;
                      $class_year_abbr =      !empty($class_year) ? "'".substr($spv_ai->extra_data['class_year'], -2, 2) : null;
                      $current_job_title =    !empty($spv_ai->extra_data['current_job_title']) ? $spv_ai->extra_data['current_job_title'] : null;
                      $current_affiliation =  !empty($spv_ai->extra_data['current_affiliation']) ? $spv_ai->extra_data['current_affiliation'] : null;
                      $state =                !empty($spv_ai->extra_data['state']) ? $spv_ai->extra_data['state'] : null;
                      $country =              !empty($spv_ai->extra_data['country']) ? $spv_ai->extra_data['country'] : null;
                      $city =                 !empty($spv_ai->extra_data['city']) ? $spv_ai->extra_data['city'] : null;
                      $specialties =          !empty($spv_ai->extra_data['special']) ? $spv_ai->extra_data['special'] : null;
                      $available_for =        !empty($spv_ai->extra_data['available_for']) ? $spv_ai->extra_data['available_for'] : null;
                      $additional_info =      !empty($spv_ai->extra_data['additional_info']) ? $spv_ai->extra_data['additional_info'] : null;
                      $phone =                !empty($spv_ai->extra_data['phone']) ? $spv_ai->extra_data['phone'] : null;
                      $email =                !empty($spv_ai->extra_data['email']) ? $spv_ai->extra_data['email'] : null;
                      $twitter =              !empty($spv_ai->extra_data['twitter']) ? $spv_ai->extra_data['twitter'] : null;

                    ?>
                    <div class="row">
                        <div class="large-12 columns">
                            <div class="indiv_alum_wrap">
                                <h3>
                                    <?php echo $name; ?><?php if($class_year_abbr){ echo ' '.$class_year_abbr; }?>
                                </h3>

                                    <?php if($current_job_title || $current_affiliation): ?>
                                    <p>
                                      <?php if($current_job_title): ?><em>Job title: </em><?=$current_job_title;?><?php endif; ?>
                                      <?php if($current_job_title && $current_affiliation){ echo '<br />'; } ?>
                                      <?php if($current_affiliation): ?><em>Current Affiliation: </em><?=$current_affiliation;?><?php endif; ?>
                                    </p>
                                    <?php endif; ?>


                                    <?php if ($state || $country || $city): ?>
                                    <p>
                                      <?php if ($state || $country): ?>
                                        <em>Location:</em>
                                        <?=$state;?>
                                        <?=$country;?>
                                        <br />
                                      <?php endif; ?>

                                      <?php if( $city ): ?>
                                        <em>City:</em> <?=$city;?>
                                      <?php endif; ?>
                                    </p>
                                    <?php endif; ?>

                                    <?php if($specialties): ?><p><em>Subject-matter specialties:</em> <?=$specialties;?><?php endif; ?>

                                    <?php if($alum_loggedin): ?>

                                      <?php if($available_for): ?><p><em>Available for:</em> <?=$available_for;?><?php endif; ?>
                                      <?php if($additional_info): ?><p><em>Additional information:</em> <?=$additional_info;?><?php endif; ?>


                                      <?php if( $phone || $email || $twitter ): ?>
                                      <p>
                                        <?php if($phone){ echo $phone.'<br />'; } ?>
                                        <?php if($email){ echo $email.'<br />'; } ?>
                                        <?php if($twitter){ echo $twitter; } ?>
                                      </p>
                                    <?php endif; ?>

                                  <?php endif; // if alum_loggedin ?>
                            </div>
                            <br />
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


      </div>
    </div>

  </main>
<?php get_footer('fellows'); ?>
