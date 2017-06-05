<?php
/**
* Template Name: Donate Page
*
*
* @package knight_wallace
*/

get_header('donate'); ?>

<?php
include_once('helpers.php');
//grab our junk
$slides = get_posts(array('post_type'=>'slider_content','posts_per_page'=> -1));
$sorted_slides = sort_slider_content($slides);
?>

<section class="story-list news">
  <div class="row">
    <div class="large-10 large-centered columns">
      <header class="entry-header">
        <h1 class="entry-title">Donate</h1>
      </header><!-- .entry-header -->
    </div>
  </div>

  <div class="row">
    <div class="large-10 large-centered columns">
      <div class="content donate">
        <h2>Support the essential work of journalists.</h2>
        <p>
          Gifts to Wallace House, the Knight-Wallace Fellowships and Livingston
          Awards for Young Journalists can be made online through the University
          of Michigan.
        </p>
        <p>
          <a class="button" href="https://leadersandbest.umich.edu/find/#!/give/basket/fund/312971"
             target="_blank">
            Support the <strong>Knight-Wallace Fellowships</strong> » </a>
        </p>
        <p>
          <a class="button" href="https://leadersandbest.umich.edu/find/#!/give/basket/fund/319082"
             target="_blank">
            Support the <strong>Livingston Awards for Young Journalists</strong> »</a>
        </p>
        <p>
          <a class="button" href="https://leadersandbest.umich.edu/find/#!/give/basket/fund/330034"
             target="_blank">
            Support the <strong>Wallace House Annual Fund</strong> » </a>
        </p>
        <p>If you prefer to mail a check, make it payable to:</p>
        <p><strong>The University of Michigan</strong></p>
        <p>and mail it to:</p>
        <p>
          Wallace House<br />
          University of Michigan<br />
          620 Oxford Road<br />
          Ann Arbor, Michigan 48104<br />
          Attn: Mary Ellen Doty
        </p>
        <p>
          For more information on making a gift or gift planning, please
          <a href="mailto:kwfgiving@.umich.edu">contact us</a> or call Mary Ellen
          Doty at 734-998-7666.
        </p>
        <p>
          <em>Wallace House, the Knight-Wallace Fellowships and the Livingston
            Awards are part of the University of Michigan and have 501(c)(3)
            non-profit tax exempt status.</em>
        </p>
      </div>
    </div>
  </div>
</section>

<?php if(!empty($sorted_slides['Donate'])): ?>
<section id="slideshow" class="slideshow-donate">
    <div class="row">
        <div class="large-10 columns large-centered">
            <ul class="bxslider">
                <?php foreach($sorted_slides['Donate'] as $slide):?>
                <li>
                    <div class="row">
                        <div class="medium-4 columns"><?php if(!empty($slide['image'])):?><?php echo $slide['image']; ?><?php endif; ?></div>
                        <div class="medium-8 columns">
                            <div class="win-meta">
                                <div class="name"><?php echo $slide['name']; ?></div>
                                <div class="details">
                                    <?php echo $slide['details']; ?>
                                </div>
                            </div>
                            <div class="testimonial"><?php echo $slide['testimonial']; ?></div>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
<?php endif; ?>

<?php get_footer('fellows'); ?>
