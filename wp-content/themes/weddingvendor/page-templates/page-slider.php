<?php
/**
 *  Template Name: Page+Slider
 *
 * @package weddingvendor
 */

get_header(); 

$args = array( 'post_type' => 'slider' , 'posts_per_page' => -1 , 'orderby' => 'menu_order ID','order' => 'ASC','post_status'=> 'publish' );
$loop = new WP_Query( $args );

$map_item_listing=map_item_listing();

if($loop->have_posts())
{
?>
<!-- /.slider end -->
<div class="slider-bg"><!-- slider start-->
	<div class="tp-slider"><!-- slider start -->
      <div id="slider" class="owl-carousel owl-theme main-slider">
        <?php 
        while ( $loop->have_posts() ) : $loop->the_post();
        ?>
        <div class="item">
          <div class="caption">
          <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10">
                      <h1><?php the_title(); ?></h1>
                      <p><?php echo esc_html(get_post_meta( $post->ID, 'slider_content', true)); ?></p>
                     <?php if(get_post_meta( $post->ID, 'slider_btn_onoff', true )=='on'){ ?>
                      <a href="<?php echo esc_url(get_post_meta( $post->ID, 'slider_btn_url', true ));?>" class="btn tp-btn-second"><?php echo 
                      get_post_meta( $post->ID, 'slider_btn_txt', true ); ?></a>
                      <?php } ?>
                     </div>
                </div>
            </div>        
          </div>
            <?php 
              if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                  the_post_thumbnail( 'full');
              }
              ?>
          </div>
        <?php 
      endwhile;
      wp_reset_postdata();
      ?>
      </div>
    </div>
  	<div class="find-section"><!-- Find search section-->
    <div class="container">
      <div class="row">
        <div class="col-md-offset-1 col-md-10 finder-block">
          <div class="finderform">
            <form method="get" action="<?php echo $map_item_listing['url'];?>">
             <div class="row">
              <div class="form-group col-md-4">
				<?php 
					$item_cat='<select name="category_type" id="category_type" class="form-control selectpicker">';
					$terms = get_terms( 'itemcategory', array('orderby'    => 'name','hide_empty' => 0 ) );
					$item_cat.='<option value="">'.esc_html__('Select Category','weddingvendor').'</option>';
					foreach( $terms as $term ) {
						// output the term name in a heading tag                								
						$item_cat.='<option value="'.$term->term_id.'">'.$term->name.'</option>';
					}
					$item_cat.='</select>';
					echo $item_cat;
				?>                              
              </div>
              <div class="form-group col-md-4">
				<?php 
					$item_city='<select name="city" id="city" class="form-control selectpicker">';
					$terms_city = get_terms( 'itemcity', array('orderby'    => 'name','hide_empty' => 0	) );
					$item_city.='<option value="">'.esc_html__('Select City','weddingvendor').'</option>';
					foreach( $terms_city as $term ) {
					   
						// output the term name in a heading tag                								
						$item_city.='<option value="'.$term->term_id.'">'.$term->name.'</option>';						
					}
					$item_city.='</select>';
					echo $item_city;
                ?>                              
              </div>
              <div class="form-group col-md-4">
              <button class="btn tp-btn-primary btn-lg btn-block" type="submit"><?php esc_html_e('Find Vendors','weddingvendor');?></button>
              </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.Find search section-->
</div>
<?php 
}
while ( have_posts() ) : the_post(); 
	the_content();
endwhile; // End of the loop. 
get_footer(); ?>