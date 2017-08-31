<?php
/**
 * The template for the 'Facilities' description..
 *
 * @package _UCLQ
 */
?>
<div class="row content-inner-row">
    <div class="col-sm-12 no-padded-col">
        <div class="panel panel-default">
            <div class="panel-heading even">
                <h1 class="fp-title">Facilities</h1>
            </div>
            <div class="panel panel-body">
                        <?php $facility_args = array( 'posts_per_page'=>3,
                                    'orderby' => 'rand',
                                    'post_type'=>'uclq_facility');
              $recent_posts = new WP_Query($facility_args);
              if ($recent_posts->have_posts() ) {
                while ($recent_posts->have_posts()){
                  $recent_posts->the_post();
                  $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
        ?>
          <div class="col-sm-4 col-xs-12">
            <div class="col-sm-12 thumbnail text-center">
              <img class="news-thumb" src="<?php echo $thumbnail[0];?>">
              <a href="<?php echo get_the_permalink();?>">
                <div class="facility_caption">
                  <p><span style="font-weight:bold"><?php echo get_the_title();?></span><br>
                  <?php 
                 $post_department = array_shift(wp_get_post_terms($post->ID, 'department'));
                  echo get_post_meta(get_the_ID(), 'facility_location', true).' in '.$post_department->name;
                  ?>
                  </p>
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