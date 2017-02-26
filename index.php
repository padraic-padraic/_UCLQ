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
				    <div class="item active">
				      <img style="height:200px; width:100%;" src="http://i.giphy.com/ZkYiNL52YuXYY.gif" alt="...">
				      <div class="carousel-caption">
				        Boop
				      </div>
				    </div>
				    <div class="item">
				      <img style="height:200px; width:100%;" src="http://i.giphy.com/yhfTY8JL1wIAE.gif" alt="...">
				      <div class="carousel-caption">
				        Beep
				      </div>
				    </div>
			    </div>
  			</div>
  		</div>
  	</div>
	<div class="row">
	    <div id="content" class="main-content-inner col-sm-12 col-md-8">
			<?php if ( have_posts() ) : ?>
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
				<?php endif; ?>
		</div><!-- close .main-content-inner -->
		<?php get_sidebar(); ?>
	</div><!-- close .row -->
  </div><!-- close .container -->
</div><!-- close .main-content -->
<?php get_footer(); ?>