<?php 
/**
 * Template Name: Couple Wishlist
 */
get_header();
if (is_user_logged_in() ) {

global $current_user,$post;
wp_get_current_user();
$userID          = $current_user->ID;	

get_template_part( 'template-parts/user/coupledashboard', 'menu' );

$currency_code			=	tg_get_option('currency_symbols');
$wistlist_ids=get_user_meta( $userID, 'user_wishlist',true) ;
$wistlist_arr=explode(",",$wistlist_ids);	

$args = array( 'post_type' => 'item', 
				'post_status'  => 'publish',
				'post__in' => $wistlist_arr,
				'orderby' => 'menu_order ID',
				'order'   => 'DESC');
				 
$item = new WP_Query( $args );
$total_element=$item->found_posts;
?>
<div class="main-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12 dashboard-page-head">
      	<div class="page-header">
        <h1><?php the_title();?>&nbsp;&nbsp;&nbsp;&nbsp;<small><?php esc_html_e('Your selected vendor items','weddingvendor');?></small></h1>
      	</div>
      </div>
    </div>
	<div class="row">    
		<?php         
        while ( $item->have_posts() ) : $item->the_post();

		$itemcity    	=   get_the_terms($post->ID, 'itemcity');
		
		if(!empty($itemcity))
		{
			$cityname = $itemcity[0]->name;	
		}
		else{
			$cityname = '';
		}

		$categories_term_id	= '';	
		
		$itemcategory    	=   get_the_terms($post->ID, 'itemcategory');	
		if(!empty($itemcategory))
		{
			foreach ($itemcategory as $item_category_each) {
				
				$categories_term_id[]=$item_category_each->term_id;
			}
		}	
		

		$item_price 	= get_post_meta( $post->ID, 'item_price', true );
		$item_maxprice 	= get_post_meta( $post->ID, 'item_maxprice', true );           
		
        ?>
      	<div class="col-md-4 vendor-box"><!-- venue box start-->
              <div class="vendor-image"><!-- venue pic --> 
                <a href="<?php the_permalink();?>">
                    <?php 
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                       the_post_thumbnail( 'weddingvendor_item_thumb' ,array( 'class' => 'img-responsive' )  );
                    }				
                    ?>            
                </a>      
                <a href="<?php echo get_category_link($itemcategory[0]->term_id); ?>" class="label-primary"><?php echo $itemcategory[0]->name;?></a>
                <?php
				echo wedding_wishlist_item_html($post->ID);
				 ?>            
                </div>
              <!-- /.venue pic -->
              <div class="vendor-detail"><!-- venue details -->
                <div class="caption"><!-- caption -->
                  <h2><a class="title" href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                  <p class="location"><i class="fa fa-map-marker"></i>&nbsp; <?php echo $cityname;?></p>              
                </div>
                <!-- /.caption -->
                <?php echo wedding_item_price_html($item_price,$item_maxprice,$currency_code); ?>              </div>
                
              <!-- venue details --> 
            </div>
		<?php 
        endwhile; 
        ?>
     </div>  
  </div>
</div>  
<?php 
}
else{
	wedding_check_logout_user();
}
get_footer();
?>