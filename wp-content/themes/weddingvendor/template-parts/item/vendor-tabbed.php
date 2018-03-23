<?php 
$currency_code=tg_get_option('currency_symbols'); 
while ( have_posts() ) : the_post(); 

$images		= '';
$thumb_images = '';
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
	$images .=  '<div class="projectitem">'.get_the_post_thumbnail($post->ID,'weddingvendor_hero_thumb').'</div>';
	$thumb_images .=  '<div class="projectitem">'.get_the_post_thumbnail($post->ID,'weddingvendor_item_thumb').'</div>';
}

foreach ($post_attachments as $attachment) {
	$preview =  wp_get_attachment_image_src($attachment->ID, 'weddingvendor_hero_thumb');    
	
	if($preview[0]!=''){
		$images .=  '<div class="projectitem"><img src="'.$preview[0].'" alt="thumb" /></div>';
	}        

	$thumb_preview =  wp_get_attachment_image_src($attachment->ID, 'weddingvendor_item_thumb');    
	
	if($thumb_preview[0]!=''){
		$thumb_images .=  '<div class="projectitem"><img src="'.$thumb_preview[0].'" alt="thumb" /></div>';
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

$item_capacity_html		= '';
$item_ami				= '';


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
?>
<div class="main-container">
  <div class="container tabbed-page st-tabs">
    <div class="row tab-page-header">
      <div class="col-md-8 title"> <a href="<?php echo get_category_link($itemcategory[0]->term_id);?>" class="label-primary"><?php echo esc_html($itemcategory[0]->name);?></a>
        <h1><?php the_title(); ?></h1>
        <?php echo wedding_item_address_html($item_address); ?>
        <hr>
      </div>
      <div class="col-md-4 venue-data">
        <div class="venue-info"><!-- venue-info-->
          <?php 
			if($item_capacity)
			{
				printf('<div class="capacity"><div>'.esc_html__('Capacity','weddingvendor').':</div><span class="cap-people">%s</span></div>', $item_capacity);
			}
			
			if($item_price)
			{
				printf('<div class="pricebox"><div>'.esc_html__('Avg Price','weddingvendor').':</div><span class="price">%s</span></div>',wedding_item_price_marker($item_price,$item_maxprice,$currency_code));
			}
		  ?>
        </div>
        <a href="#inquiry" class="btn tp-btn-default tp-btn-lg btn-block"><?php esc_html_e('Book Now','weddingvendor');?></a> </div>
    </div>
    <div class="row">
      <div class="col-md-12"> 
        <!-- Nav tabs -->
        <ul class="nav nav-tabs listnone" role="tablist">
          <li role="presentation" class="active"><a href="#photo" title="Gallery" aria-controls="photo" role="tab" data-toggle="tab"> <i class="fa fa-photo"></i> <span class="tab-title"><?php esc_html_e('Photo','weddingvendor');?></span></a></li>
          <li role="presentation">
          <a href="#about" title="about info" aria-controls="about" role="tab" data-toggle="tab">
          <i class="fa fa-info-circle"></i>
          <span class="tab-title"><?php esc_html_e('About','weddingvendor');?></span>
          </a>
          </li>
          <li role="presentation"><a href="#onmap" title="Location" aria-controls="onmap" role="tab" data-toggle="tab"> <i class="fa fa-map-marker"></i> <span class="tab-title"><?php esc_html_e('On map','weddingvendor');?></span></a></li>
          <li role="presentation"><a href="#video" title="Video" aria-controls="video" role="tab" data-toggle="tab"> <i class="fa fa-youtube-play"></i> <span class="tab-title"><?php esc_html_e('Video','weddingvendor');?></span></a></li>
          <li role="presentation"><a href="#amenities" title="Amenities" aria-controls="amenities" role="tab" data-toggle="tab"> <i class="fa fa-asterisk"></i> <span class="tab-title"><?php esc_html_e('Amenities','weddingvendor');?></span></a></li>
          <li role="presentation"><a href="#reviews" title="Review" aria-controls="reviews" role="tab" data-toggle="tab"> <i class="fa fa-commenting"></i> <span class="tab-title"><?php esc_html_e('Reviews','weddingvendor');?></span></a></li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content"><!-- tab content start-->
          <div role="tabpanel" class="tab-pane fade in active" id="photo">
            <div id="sync1" class="owl-carousel">
              <?php echo $images; ?>
            </div>
            <div id="sync2" class="owl-carousel">
              <?php echo $images; ?>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="about">
            <?php the_content(); ?>            
          </div>
          <div role="tabpanel" class="tab-pane fade" id="onmap">
            <div id="googleMap" class="map"></div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="video"> 
            <!-- 16:9 aspect ratio -->
            <div class="embed-responsive embed-responsive-16by9"> 
			<?php 			  
            $media_url = get_post_meta($post->ID, 'tab_item_video', true);			            
            if($media_url)
            {
                echo '<div class="videoWrapper">'.wedding_video_embed(wp_oembed_get( $media_url )).'</div>';
            }
            ?>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="amenities">
            <div class="row">
              <div class="col-md-6 venue-amenities">
               <?php
			     $total_amenities	= array();
				$item_amenities     = get_the_terms($post->ID, 'item_amenities');
				if(!empty($item_amenities))
				{
					foreach ($item_amenities as $item_amenity) {
						$total_amenities[]=$item_amenity->term_id;
					}
				}
					
				$terms_amenities = get_terms( 'item_amenities', array('orderby' => 'name','hide_empty' => 0 ) );
				
				if(count($total_amenities)>1)
				{
					$item_ami.= '<ul class="check-circle list-group listnone">';
					foreach( $terms_amenities as $term ) {
	 
						if(!empty($total_amenities))
						{
							if(in_array($term->term_id,$total_amenities))
							{
								$item_ami.='<li class="list-group-item">'.$term->name.'</li>';
							}
						} 
					}
					$item_ami.='</ul>';
				}
				echo $item_ami;
			    ?>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="reviews"> 
            <!-- comments -->
            <?php 
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template('', true );
			endif;
        	?>            
          </div>
        </div>
        <!-- /.tab content start--> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-8" >
        <div class="row">
        	<?php  get_template_part( 'template-parts/item/vendor', 'contact'); ?>
        </div>        
      </div>
      <div class="col-md-4">
        <div class="profile-sidebar side-box"> 
          <!-- SIDEBAR USERPIC -->
          <?php if(isset($user_custom_picture) && !empty($user_custom_picture)){  ?>
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
</div>
<?php
endwhile;
?>
<script>
// Data for the markers consisting of a name, a LatLng and a zIndex for the
// order in which these markers should display on top of each other.
var center_point =  {"lat":<?php echo esc_js($item_google_latitude); ?>,"lng":<?php echo esc_js($item_google_longitude);?>,"marker":'<?php echo esc_js($marker_icon);?>'};
</script>