<?php
/**
 *  Template Name: Page+Sidebar1
 *
 *
 * @package weddingvendor
 */

get_header(); ?>
<div class="main-container"> 
  <!--main-container-->
    <div class="container">
      <div class="row">
        <div class="col-md-8 content-left">
          <div class="row">
			<?php while ( have_posts() ) : the_post(); ?>
            <div class="col-md-12">
              <?php the_content();?>
			</div>
			<?php endwhile; // End of the loop. ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="left-sidebar"><!--sidebar-->
				<?php if ( is_active_sidebar( 'page-1' ) ) { ?>
                    <?php dynamic_sidebar( 'page-1' ); ?>
                <?php } ?>          
          </div>
          <!--/.sidebar--> 
        </div>
      </div>
    </div>
  </div>
<!--/.main-container-->
<?php get_footer(); ?>