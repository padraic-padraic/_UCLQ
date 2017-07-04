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
            <div id="sticky-posts">
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
             $('#story-carousel').on('slide.bs.carousel', function (event) {
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
      <div id="content" class="main-content-inner col-sm-12 col-md-9 no-padded-col">
        <?php
          include('index_parts/about_us.php');
          include('index_parts/recent_news.php');
          include('index_parts/Ques2T.php');
          include('index_parts/skills_training.php');
          include('index_parts/facilities.php');
          include('index_parts/videos.php');
        ?>
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
