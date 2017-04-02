<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _UCLQ
 */

get_header(); ?>
<div class="main-content">
  <div class="container-fluid">
    <div class="row">
      <div id="story-carousel-row" class="col-sm-12">
        <div id="story-carousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner" role="listbox">
          <?php
          $sticky_args=array('post__in'=>get_option('sticky_posts'),
                             'ignore_sticky_posts'=>1
                            );
          $sticky_posts = new WP_Query($sticky_args);
          if ($sticky_posts->have_posts()) {
            while ($sticky_posts->have_posts()){
              $sticky_posts->the_post(); ?>
             <div class="item <?php if ($sticky_posts->current_post==0){
                 echo "active";
                }?>">
              <?php $thumbnail = wp_get_attachment_image_src(
                          get_post_thumbnail_id($post->ID), 'full');?>
                <a href="<?php echo the_permalink();?>">
                  <div class="carousel-image" style="background: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,1)), url('<?php echo $thumbnail[0];?>');
                                                     background-repeat: no repeat;
                                                     background-size: 100% 100%;">
                  </div>
                  <div class="carousel-caption"><?php echo the_excerpt()?></div>
                </a>
              </div>
          <?php  }
            // wp_reset_postdata();
          }
          rewind_posts();?>
            <div class="sticky-posts">
              <h3>Top Stories</h3>
              <div class="carousel-controls">
              <?php
                while ($sticky_posts->have_posts()) {
                    $sticky_posts->the_post();?>
                  <div class="carousel-row <?php
                        if ($sticky_posts->current_post==0){
                          echo "active";}?>"
                       data-target="#story-carousel"
                       data-slide-to="<?php echo $sticky_posts->current_post?>">
                    <div class="carousel-indicator">&nbsp;</div>
                    <div class="carousel-headline">
                      <?php echo get_the_title();?>
                    </div>
                  </div>
                  <?php }
                wp_reset_postdata();
                ?>
                </div>
            </div>
          </div>
        </div>
        <script type="application/javascript">
         (function($) {
             $('#story-carousel').on('slid.bs.carousel', function (event) {
               var nextactiveslide = $(event.relatedTarget).index();
               var $btns = $('.carousel-controls');
               var $active = $btns.find("[data-slide-to='" + nextactiveslide + "']");
               console.log($active);
               $btns.find('.carousel-row').removeClass('active');
               $active.addClass('active');
             });
         })(jQuery);
        </script>
      </div>
    </div>
    <div class="row">
      <div id="content" class="main-content-inner col-sm-12 col-md-8">
        <div class="row content-inner-row">
          <div id="about-us" class="col-sm-12">
            <div class="panel panel-default">
              <div class="panel-heading odd">
                  <h1 class="fp-title"> About Us </h1>
              </div>
              <div class="panel-body">
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
              </div>
            </div>
          </div>
        </div>
        <div class="row content-inner-row">
          <div class="col-sm-12">
            <div class="panel panel-default">
              <div class="panel-heading even">
                <h1 class="fp-title">Recent News</h1>
              </div>
              <div class="panel-body">
                <div class="equal row">
                <?php $recent_args = array( 'posts_per_page'=>3,
                                            'category_name'=>'News',
                                            'ignore_sticky_posts'=>1,
                                            'post__not_in'=>get_option('sticky_posts'));
                      $recent_posts = new WP_Query($recent_args);
                      if ($recent_posts->have_posts() ) {
                        while ($recent_posts->have_posts()){
                          $recent_posts->the_post();
                          $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                ?>
                  <div class="col-md-4 col-sm-12">
                    <div class="thumbnail">
                      <img class="news-thumb" src="<?php echo $thumbnail[0];?>">
                      <a href="<?php echo get_the_permalink();?>">
                        <div class="caption">
                          <p><?php echo get_the_title();?></p>
                        </div>
                      </a>
                    </div>
                  </div>
               <?php
                       }
                       wp_reset_postdata();
                     }
               ?>
               </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row content-inner-row">
          <div id="ques2t" class="col-sm-12">
            <div class="panel panel-default">
              <div class="panel-heading odd">
                <h1 class="fp-title">Ques2T</h1>
              </div>
              <div class="panel-body">
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
              </div>
            </div>
          </div>
        </div>
        <div class="row content-inner-row">
          <div class="col-sm-12">
            <div class="panel panel-default">
              <div class="panel-heading even">
                <h1 class="fp-title">Skills and Training</h1>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="panel panel-default">
                      <div class="panel-heading odd">
                        <p class="fp-title">Delivering Quantum Technologies</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="panel panel-default">
                      <div class="panel-heading odd">
                        <p class="fp-title">Quantum Engineering Skills Hub</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row content-inner-row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading even">
                        <h1 class="fp-title">Facilities</h1>
                    </div>
                    <div class="panel panel-body">
                        <div class="equal row content-inner-row">
                            <div class="col-sm-4">
                                <img class="img-responsive" src="http://i.giphy.com/3KMnQJcwcZB0k.gif">
                            </div>
                            <div class="col-sm-4">
                                <img class="img-responsive" src="http://i.giphy.com/uiDCwmi3I3yQo.gif">
                            </div>
                            <div class="col-sm-4">
                                <img class="img-responsive" src="http://i.giphy.com/qjj4xrA1STjfa.gif">
                            </div>
                        </div>
                    </div>
                </div>
          </div>
        </div>
        <div class="row content-inner-row">
          <div class="col-sm-12">
            <div class="panel panel-default">
              <div class="panel-heading odd">
                <h1 class="fp-title"> Videos</h1>
              </div>
              <div class="panel-body">
                  <div class="row">
                  <div class="col-md-4 col-sm-12">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/SXSJHEkQcmM?rel=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/QN5tns6TIO4?rel=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/hil-tkoIFFw?rel=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                  </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
<!--         <?php if ( have_posts() ) : ?>
          <?php /* Start the Loop */ ?>
            <?php //while ( have_posts() ) : the_post(); ?>
              <?php
                  /* Include the Post-Format-specific template for the content.
                   * If you want to overload this in a child theme then include a file
                   * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                   */
                  //get_template_part( 'content', get_post_format() );
                ?>
            <?php //endwhile; ?>
            <?php // _UCLQ_content_nav( 'nav-below' ); ?>
                <?php //_UCLQ_pagination(); ?>
          <?php else : ?>
            <?php //get_template_part( 'no-results', 'index' ); ?>
          <?php endif; ?> -->
      </div><!-- close .main-content-inner -->
      <?php get_sidebar(); ?>
    </div><!-- close .row -->
  </div><!-- close .container -->
</div><!-- close .main-content -->
<?php get_footer(); ?>
