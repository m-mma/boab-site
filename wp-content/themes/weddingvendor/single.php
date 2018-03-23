<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package weddingvendor
 */

get_header(); ?>

<div class="main-container">
	<div class="container"> 
        <div class="row">
            <div class="col-md-8">
				<?php
                while ( have_posts() ) : the_post();
        
                    get_template_part( 'template-parts/content', 'single' );
        
					// related post 
        			wedding_related_post();
					
					 //  single post prev and next post display
		            wedding_single_post_pre_next();

					// author bio
					get_template_part( 'author-bio' );					
        
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
					
        
                endwhile; // End of the loop.
                ?>
            </div><!-- #main -->
            <div class="col-md-4 right-sidebar"><!-- right sidebar -->
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            <?php } ?>         
       		</div>
        </div>
	</div>
</div>
<?php
get_footer();
?>