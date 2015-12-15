<?php
/**
 * Template Name: Livingston Sub Page
 *
 * @package knight_wallace
 */

get_header('livingston'); ?>


    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'template-parts/content', 'page' ); ?>

    <?php endwhile; // End of the loop. ?>


  <main id="main" class="posts">
    <div class="row">
      <div class="large-6 columns">
        <img src="http://dummyimage.com/620x256/aeaeae/555.jpg?text=placeholder" alt="" />
        <div class="text">
          <h3>A life-changing experience</h3>
          <p><a href="">Learn more about the Knight-Wallace Fellowships ></a></p>
        </div>
      </div>
      <div class="large-6 columns">
        <img src="http://dummyimage.com/620x256/aeaeae/555.jpg?text=placeholder" alt="" />
        <div class="text">
          <h3>A life-changing experience</h3>
          <p><a href="">Learn more about the Knight-Wallace Fellowships ></a></p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="large-6 columns">
        <img src="http://dummyimage.com/620x256/aeaeae/555.jpg?text=placeholder" alt="" />
        <div class="text">
          <h3>A life-changing experience</h3>
          <p><a href="">Learn more about the Knight-Wallace Fellowships ></a></p>
        </div>
      </div>
      <div class="large-6 columns">
        <img src="http://dummyimage.com/620x256/aeaeae/555.jpg?text=placeholder" alt="" />
        <div class="text">
          <h3>A life-changing experience</h3>
          <p><a href="">Learn more about the Knight-Wallace Fellowships ></a></p>
        </div>
      </div>
    </div>
  </main>
  <section id="news_library">
    <div class="row headings">
      <div class="large-6 columns">
        <div class="heading">
          <h3>Recent News</h3>
        </div>
      </div>
      <div class="large-6 columns">
        <div class="heading">
          <h3>From the Wallace House Library</h3>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="large-6 columns">
        <div class="row news snippet-box">
          <div class="large-12 columns">
            <div class="news-article">
              <h4><a href="#">2015 Livingston Award Winners Announced</a></h4>
              <div class="date">August 15, 2015</div>
              <div class="tags">
                <ul>
                  <li><a href="#">Knight-Wallace</a> |</li>
                  <li><a href="#">Events</a> </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="large-6 columns">
        <div class="row news snippet-box">
          <div class="large-12 columns">
            <div class="news-article">
              <h4><a href="#">2015 Livingston Award Winners Announced</a></h4>
              <div class="date">August 15, 2015</div>
              <div class="tags">
                <ul>
                  <li><a href="#">Knight-Wallace</a> | </li>
                  <li><a href="#">Events</a> </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="large-6 columns">
        <div class="row news snippet-box">
          <div class="large-12 columns">
            <div class="news-article">
              <h4><a href="#">2015 Livingston Award Winners Announced</a></h4>
              <div class="date">August 15, 2015</div>
              <div class="tags">
                <ul>
                  <li><a href="#">Knight-Wallace</a> |</li>
                  <li><a href="#">Events</a> </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="large-6 columns">
        <div class="row news snippet-box">
          <div class="large-12 columns">
            <div class="news-article">
              <h4><a href="#">2015 Livingston Award Winners Announced</a></h4>
              <div class="date">August 15, 2015</div>
              <div class="tags">
                <ul>
                  <li><a href="#">Knight-Wallace</a> |</li>
                  <li><a href="#">Events</a> </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="large-6 columns"><a href="#" class="more-posts">See all Livingston Awards news &raquo;</a></div>
      <div class="large-6 columns"><a href="#" class="more-posts">See all Livingston Awards news &raquo;</a></div>
    </div>
  </section>
<?php get_footer('livingston'); ?>
