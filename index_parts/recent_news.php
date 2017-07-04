<?php
/**
 * The template for the 'Recent News' section.
 * @package _UCLQ
 */
?>
<div class="row content-inner-row">
  <div id="recent-news" class="col-sm-12 no-padded-col">
    <div class="panel panel-default">
      <div class="panel-heading even">
        <h1 class="fp-title">Recent News</h1>
      </div>
      <div class="panel-body">
        <div class="row">
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
          <div class="col-sm-4 col-xs-12">
            <div class="col-sm-12 thumbnail text-center">
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