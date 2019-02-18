<?php
/**
* Template Name: Donate Page
*
*
* @package knight_wallace
*/

get_header(); ?>

<?php
include_once('helpers.php');
//grab our junk
$slides = get_posts(array('post_type'=>'slider_content','posts_per_page'=> -1));
$sorted_slides = sort_slider_content($slides);
?>

<section class="fullwidth-content">

  <div class="banner--yellow">
    <div class="row">
      <div class="large-10 large-centered columns">
        <div class="content donate">
          <h2 class="jumbo">Uphold Democracy.<br><span class="ublue">Support Journalists.</span></h2>
        </div>
      </div>
    </div>
  </div>

  <div class="banner--dark-blue">
    <div class="row">
      <div class="large-10 large-centered columns">
        <div class="content donate">
          <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php the_content('Read the rest of this entry »'); ?>
            <?php endwhile; ?>
            <?php else : ?>
        <?php endif; ?>
        </div>
      </div>
    </div> 
  </div>

  <div class="banner--gray">
    <div class="row">
      <div class="large-10 large-centered columns">
        <div class="content donate">
          <div class="row">
            <div class="medium-5 columns">
              <?php $annualFundImage = get_field('annual_fund_image'); ?>
              <img src="<?php echo $annualFundImage['url']; ?>" class="donate-image" />
            </div>
            <div class="medium-7 columns">
              <h2 class="lblue">Support the Wallace House Annual Fund</h2>
              <p><?php the_field('annual_fund_text'); ?></p>
              <a href="<?php the_field('annual_fund_donation_url'); ?>" target="_blank" rel="noopener noreferrer" class="button">Donate &raquo;</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="banner--white">
    <div class="row">
      <div class="large-10 large-centered columns">
        <div class="content donate">
          <div class="row flex-row">
            <div class="column medium-7 small-float-right">
              <h2 class="lblue">Support the Livingston Awards for Young Journalists</h2>
              <p><?php the_field('livingston_awards_text'); ?></p>
              <a href="<?php the_field('livingston_awards_donation_url'); ?>" target="_blank" rel="noopener noreferrer" class="button">Donate &raquo;</a>
            </div>
            <div class="column medium-5 small-float-left text-md-right text-small-left">
              <?php $annualFundImage = get_field('livingston_awards_image'); ?>
              <img src="<?php echo $annualFundImage['url']; ?>" class="donate-image" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="banner--gray">
    <div class="row">
      <div class="large-10 large-centered columns">
        <div class="content donate">
          <div class="row">
            <div class="medium-5 columns">
              <?php $annualFundImage = get_field('knight_wallace_fellowships_image'); ?>
              <img src="<?php echo $annualFundImage['url']; ?>" class="donate-image" />
            </div>
            <div class="medium-7 columns">
              <h2 class="lblue">Support the Knight-Wallace Fellowships</h2>
              <p><?php the_field('knight_wallace_fellowships_text'); ?></p>
              <a href="<?php the_field('knight_wallace_fellowships_donation_url'); ?>" target="_blank" rel="noopener noreferrer" class="button">Donate &raquo;</a>  
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>

<?php if(!empty($sorted_slides['Donate'])): ?>
<section class="testimonials">
    <div class="row">
        <div class="large-10 columns large-centered">
            <ul class="testimonials__list">
                <?php foreach($sorted_slides['Donate'] as $slide):?>
                <li>
                    <?php if(!empty($slide['image'])):?><?php echo $slide['image']; ?><?php endif; ?>
                    <div class="testimonial">
                      <p><?php echo str_replace(array('”', '“'), '', $slide['testimonial']); ?><span class="white">&rdquo;</p>
                      <div class="details">
                          <div class="name"><?php echo $slide['name']; ?></div>
                          <?php echo $slide['details']; ?>
                      </div>   
                    </div> 
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (get_field('additional_content')): ?>
<section class="fullwidth-content additional-content">
  <div class="row">
    <div class="large-10 large-centered columns">
      <div class="content donate">
        <?php the_field('additional_content'); ?>
      </div>
    </div>
  </div> 
</section>
<?php endif; ?>

<?php get_footer(); ?>
