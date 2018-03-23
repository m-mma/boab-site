<?php 
$currency_code=tg_get_option('currency_symbols'); 
while ( have_posts() ) : the_post(); 

$images		= '';
$arguments 	= array(
	  'numberposts' => -1,
	  'post_type' => 'attachment',     
	  'post_parent' => $post->ID,
	  'post_status' => null,
	  'exclude' => get_post_thumbnail_id(),
	  'orderby' => 'menu_order',
	  'order' => 'ASC'
  );
$post_attachments = get_posts($arguments);
$post_thumbnail_id = $thumbid = get_post_thumbnail_id( $post->ID );

// Get thumb image
if(get_the_post_thumbnail($post->ID))
{
	$images .=  '<div class="item">'.get_the_post_thumbnail($post->ID,'weddingvendor_hero_thumb').'</div>';
}

foreach ($post_attachments as $attachment) {
	$preview =  wp_get_attachment_image_src($attachment->ID, 'weddingvendor_hero_thumb');    
	
	if($preview[0]!=''){
		$images .=  '<div class="item"><img src="'.$preview[0].'" alt="thumb" /></div>';
	}        
}	

$post_author_id 		= get_post_field( 'post_author', $post->ID );
$first_name      		= get_the_author_meta( 'first_name' , $post_author_id );
$last_name       		= get_the_author_meta( 'last_name' , $post_author_id );
$user_custom_picture    = get_the_author_meta( 'custom_picture' , $post_author_id );
$user_email 			= get_the_author_meta( 'user_email', $post_author_id);
$user_website 			= get_the_author_meta( 'website', $post_author_id);
$item_address 			= get_post_meta( $post->ID, 'item_address', true );
$item_capacity 			= get_post_meta( $post->ID, 'item_capacity', true );
$item_price 			= get_post_meta( $post->ID, 'item_price', true );
$item_maxprice 			= get_post_meta( $post->ID, 'item_maxprice', true) ;

$itemcategory        	= get_the_terms( $post->ID, 'itemcategory');	

if(!empty($itemcategory))
{
	foreach ($itemcategory as $item_category_each) {
		$total_categories[]=$item_category_each->name;
		$total_categories_link[]=$item_category_each->term_id;
	}
}		

//Find google map latitude and longitude
$locators		       =   get_post_meta($post->ID, 'locators', true);	
$item_google_latitude  =   $locators['latitude'];
$item_google_longitude =   $locators['longitude']; 

$marker_icon = wedding_default_marker($total_categories_link[0]);

if(count($post_attachments)!=0)
{
	echo '<div id="slider" class="owl-carousel owl-theme slider">'.$images.'</div>';
}
else
{
	if(get_the_post_thumbnail($post->ID))
	{
		echo  '<div class="slider-pic">'.get_the_post_thumbnail($post->ID,'weddingvendor_hero_thumb',array( 'class' => 'img-responsive' )).'</div>';
	}	
}

$marker_icon = wedding_default_marker($total_categories_link[0]);

if(function_exists('bcn_display'))
{	
?>
    <div class="tp-breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <ol class="breadcrumb listnone">
              <li><?php bcn_display(); ?></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
<?php 
}
?>
<div class="container venue-header">
  <div class="row venue-head">
    <div class="col-md-12 title"> <a href="<?php echo get_category_link($total_categories_link[0]); ?>" class="label-primary"><?php echo esc_html($total_categories[0]); ?></a>
      <h1 class="item_title"><?php the_title();?></h1>
      <?php echo wedding_item_address_html($item_address); ?>
    </div>   
    <div class="col-md-12 venue-action"> <a href="#googleMap" class="btn tp-btn-primary"><?php esc_html_e('VIEW MAP','weddingvendor'); ?></a> <a href="#inquiry" class="btn tp-btn-default"><?php esc_html_e('Inquire Now','weddingvendor'); ?></a> </div>
  </div>
</div>
<div class="main-container">
  <div class="container">
    <div class="row">
      <div class="col-md-4 page-sidebar">
        <div class="row">
		  <?php 
		  	get_template_part( 'template-parts/item/vendor', 'contact');
		  ?>	
        	<div class="col-md-12">
                <div class="profile-sidebar well-box"> 
                  <!-- SIDEBAR USERPIC -->
                  <?php
                  if(isset($user_custom_picture) && !empty($user_custom_picture)){
                   ?>
                  <div class="profile-userpic"> <img src="<?php echo esc_html($user_custom_picture); ?>" class="img-responsive img-circle" alt=""> </div>
                  <?php } ?>
                  <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                      <h2><?php echo $first_name.' '.$last_name;?></h2>
                    </div>
					<?php 
                    echo get_html_vendor_profile_button($post_author_id);
                    ?>                  
                  </div>
                </div>
            </div>          
        </div>
      </div>
      <div class="col-md-offset-1 col-md-7 page-description">
		<div class="venue-details">
          <?php the_content(); ?>
        </div>
		<?php 
        $item_ami='';
        $total_amenities	= array();
        $item_amenities     = get_the_terms($post->ID, 'item_amenities');
        if(!empty($item_amenities))
        {        
        ?>
        <div class="profile-feature">
          <div class="row">
            <div class="col-md-3">
              <h3 class="profile-feature-title"><?php esc_html_e('Facilities','weddingvendor'); ?>:</h3>
            </div>
            <div class="col-md-9">            
				<?php 	
                    foreach ($item_amenities as $item_amenity) {
                        $total_amenities[]=$item_amenity->term_id;
                    }
    
                    $terms_amenities = get_terms( 'item_amenities', array('orderby'    => 'name','hide_empty' => 0 ) );            
                    
                    if(count($terms_amenities)>1)
                    {
                        foreach( $terms_amenities as $term ) {
    
                            if(!empty($total_amenities))
                            {
                                if(in_array($term->term_id,$total_amenities))
                                {
                                    $item_ami.= ' '.$term->name.',';
                                }
                            } 
                        }
                    }
                    echo trim($item_ami,',');
                 ?>
                </div>
              </div>
            </div>              
		<?php
        }
        ?>        
        <div class="profile-feature">
          <div class="row">
            <div class="col-md-3">
              <h3 class="profile-feature-title"><?php esc_html_e('Capacity','weddingvendor'); ?>:</h3>
            </div>
            <div class="col-md-9"><?php echo $item_capacity; ?></div>
          </div>
        </div>
        <div class="profile-feature">
          <div class="row">
            <div class="col-md-3">
              <h3 class="profile-feature-title"><?php esc_html_e('Avg Price','weddingvendor') ?>:</h3>
            </div>
            <div class="col-md-9"><?php echo wedding_item_price_marker($item_price,$item_maxprice,$currency_code);?></div>
          </div>
        </div>
        <!-- comments -->
		<?php 
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template('', true );
			endif;
        ?>
        <!-- /.comments -->         
      </div>
    </div>
  </div>
</div>
<?php
endwhile;
?>
<div id="googleMap" class="map"></div>
<div class="spacer">
	<div class="container">
    	<div class="row">
        	<div class="col-md-12 tp-title">
            	<h1><?php esc_html_e('Recommended for','weddingvendor'); echo "&nbsp;".$total_categories[0]; ?> </h1>
            </div>
			<?php    
			$category_type_array = array(
				'taxonomy'  => 'itemcategory',
				'field'     => 'id',
				'terms'     => $total_categories_link[0]
			);				
			        
            $args = array( 'post_type' => 'item', 
                        'posts_per_page' => 3,
                        'post_status'  => 'publish',
						'post__not_in' => array($post->ID),
						'tax_query' => array('relation' => 'AND',$category_type_array),
                        'orderby' => 'rand',
                        'order'   => 'ASC',
                         );
                         
            $item = new WP_Query( $args );
            while ( $item->have_posts() ) : $item->the_post();	

			$item_address 		= get_post_meta( $post->ID, 'item_address', true );	
			$item_price 		= get_post_meta( $post->ID, 'item_price', true );
			$item_maxprice 		= get_post_meta( $post->ID, 'item_maxprice', true );			
            ?>
			<div class="col-md-4 vendor-box"><!-- venue box start-->
              <div class="vendor-image"><!-- venue pic --> 
                <a href="<?php the_permalink(); ?>">
                    <?php 
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                       the_post_thumbnail( 'weddingvendor_item_thumb' ,array( 'class' => 'img-responsive' )  );
                    }				
                    ?>             
                </a>            
              </div>
              <!-- /.venue pic -->
              <div class="vendor-detail"><!-- venue details -->
                <div class="caption"><!-- caption -->
                  <h2><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h2>
                  <?php echo wedding_item_address_html($item_address); ?>              
                </div>
                <!-- /.caption -->
                <?php echo wedding_item_price_html($item_price,$item_maxprice,$currency_code);?>
              </div>
              <!-- venue details --> 
            </div>
			<?php
            endwhile; 		
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>
<script>
// Data for the markers consisting of a name, a LatLng and a zIndex for the
// order in which these markers should display on top of each other.
var center_point =  {"lat":<?php echo esc_js($item_google_latitude); ?>,"lng":<?php echo esc_js($item_google_longitude);?>,"marker":'<?php echo esc_js($marker_icon);?>'};
</script>