<?php
/**
 *  Template Name: Blog Template
 *
 * @package weddingvendor
 */
get_header(); 

query_posts('post_type=post&post_status=publish&posts_per_page='.get_option('posts_per_page').'&paged='. get_query_var('paged'));
?>
<!--main-container-->
<div class="main-container">
    <div class="container">
      <div class="row">
          <div class="col-md-8"><!-- col-md-8 -->
			<?php if ( have_posts() ) : ?>
            <?php /* Start the Loop */  ?>
            <?php while ( have_posts() ) : the_post(); ?>
            <?php
                /* Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                get_template_part( 'template-parts/content', get_post_format() );				 	
            ?>
            <?php endwhile; ?>
            <?php wedding_pagination(); ?>
            <?php else : ?>
            <?php get_template_part( 'template-parts/content', 'none' ); ?>
            <?php endif; ?>             
        </div>
        <!-- /.content left -->
		<div class="col-md-4 right-sidebar"><!-- right sidebar -->
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            <?php } ?>         
       </div>
      </div>
    </div>
</div>
<!--/.main-container-->
<?php get_footer(); ?>