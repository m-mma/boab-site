<?php 
/**
 * Template Name: Add Listing
 */
get_header();

if (is_user_logged_in() ) {

global $current_user;
wp_get_current_user();
$userID          = $current_user->ID;
$user_login      = $current_user->user_login;

if( isset( $_GET['item_edit'] ) && is_numeric( $_GET['item_edit'] ) ){
    
	$edit_id             =  intval ($_GET['item_edit']);
  
    $the_post= get_post( $edit_id); 
    if( $current_user->ID != $the_post->post_author ) {
        exit('You don\'t have the rights to edit this');
    }	

    $item_title            =   get_the_title($edit_id);
    $item_description      =   get_post_field('post_content', $edit_id);
    $item_price		       =   esc_html( get_post_meta($edit_id, 'item_price', true) );
    $item_maxprice		   =   esc_html( get_post_meta($edit_id, 'item_maxprice', true) );
	
    $item_capacity		   =   esc_html( get_post_meta($edit_id, 'item_capacity', true) );
    $item_maxcapacity	   =   esc_html( get_post_meta($edit_id, 'item_maxcapacity', true) );

    $item_address		   =   esc_html( get_post_meta($edit_id, 'item_address', true) );	
    $locators		       =   get_post_meta($edit_id, 'locators', true);
    $tab_item_video		   =   get_post_meta($edit_id, 'tab_item_video', true);
	
	$item_google_address   =   $locators['address'];
	$item_google_longitude =   $locators['longitude'];
	$item_google_latitude  =   $locators['latitude'];
	$images				   =   '';
	$attachid			   =   '';

	$total_amenities=array();
	$total_cities=array();
    $item_amenities        =  get_the_terms($edit_id, 'item_amenities');
	if(!empty($item_amenities))
	{
		foreach ($item_amenities as $item_amenity) {
			$total_amenities[]=$item_amenity->term_id;
		}
	}

    $itemcategory        =   get_the_terms($edit_id, 'itemcategory');	
	if(!empty($itemcategory))
	{
		foreach ($itemcategory as $item_category_each) {
			$total_categories[]=$item_category_each->term_id;
		}
	}

    $itemcity       	 =   get_the_terms($edit_id, 'itemcity');	
	if(!empty($itemcity))
	{
		foreach ($itemcity as $item_city_each) {
			$total_cities[]=$item_city_each->term_id;
		}
	}

    $arguments = array(
          'numberposts' => -1,
          'post_type' => 'attachment',     
          'post_parent' => $edit_id,
          'post_status' => null,
          'exclude' => get_post_thumbnail_id(),
          'orderby' => 'menu_order',
          'order' => 'ASC'
      );
    $post_attachments = get_posts($arguments);
    $post_thumbnail_id = $thumbid = get_post_thumbnail_id( $edit_id );
   
    foreach ($post_attachments as $attachment) {
        $preview =  wp_get_attachment_image_src($attachment->ID, array('290','290'));    
        
        if($preview[0]!=''){
            $images .=  '<div class="uploaded_images" data-imageid="'.$attachment->ID.'"><img src="'.$preview[0].'" alt="thumb" /><i class="fa  fa-trash-o"></i>';
            if($post_thumbnail_id == $attachment->ID){
                $images .='<i class="fa thumber fa-star"></i>';
            }
        }else{
            $images .=  '<div class="uploaded_images" data-imageid="'.$attachment->ID.'"><img src="'.get_template_directory_uri().'/img/pdf.png" alt="thumb" /><i class="fa fa-trash-o"></i>';
            if($post_thumbnail_id == $attachment->ID){
                $images .='<i class="fa thumber fa-star"></i>';
            }
        }        
        
        $images .='</div>';
        $attachid.= ','.$attachment->ID;
    }		
	
	$item_google_address   =   $locators['address'];
	$item_google_latitude  =   $locators['latitude'];
	$item_google_longitude =   $locators['longitude'];
	$item_date 				= get_the_date('Y-m-d', $edit_id );	
	$action 				= 'Edit';
}
else{
    $item_title            	=   '';
    $item_description      	=   '';
    $item_price		       	=   '';
    $item_maxprice		   	=   '';
	
    $item_capacity		   	=   '';
    $item_maxcapacity	   	=   '';

    $item_address		   	=   '';	
    $locators		       	=   '';
    $tab_item_video		   	=   '';
	
	$item_google_address   	=   '';
	$item_google_latitude  	=   '';
	$item_google_longitude 	=   '';	
	
	$images					=	'';
	$attachid				=	'';
	$thumbid				=	'';
	
	$item_date				= 	'';
	$action 				= 	'Add';
	$edit_id				=   null;
}
get_template_part( 'template-parts/user/dashboard', 'menu' );

$args = array( 'post_type' => 'item','posts_per_page' => -1,'post_status' => 'publish','author'=> $userID );
$item = new WP_Query( $args );
$total_items=$item->found_posts;	

$cur_date=date('Y-m-d');
$accessibility = wedding_check_expired_listing($edit_id,$action);
?>
<div class="main-container">
  <div class="container">
    <div class="row">
    	<div class="col-md-12"> 
		  <?php 
          if($accessibility=='On')
          {
          ?>                  
            <form id="add-listing" class="ajax-auth add-listing" method="post" enctype="multipart/form-data" >
            <div class="status"></div>  
            <?php wp_nonce_field('ajax-vendor-add-listing-nonce', 'security'); ?>
            <div class="row">
                <div class="col-md-12">
                    <h2><?php echo get_the_title(); ?></h2>                    
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="control-label" for="add_title"><?php esc_html_e('Title','weddingvendor');?><span class="required">*</span></label>
                        <input id="add_title" name="add_title" type="text" value="<?php echo $item_title; ?>" class="form-control input-md required" >
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="add_content"><?php esc_html_e('Content','weddingvendor');?><span class="required">*</span></label>
             <?php /*?>           <textarea name="add_content" id="add_content" rows="10" class="form-control input-md required" ><?php echo $item_description; ?></textarea><?php */?>

<?php wp_editor(  $item_description,'add_content');?>                        

                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="add_min_price"><?php esc_html_e('Price','weddingvendor');?><span class="required">*</span></label>
                                <input id="add_min_price" name="add_min_price" type="digits" class="form-control input-md required" value="<?php echo $item_price;?>" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="add_max_price"><?php esc_html_e('Maximum Price','weddingvendor');?></label>
                                <input id="add_max_price" name="add_max_price" type="digits" class="form-control input-md" value="<?php echo $item_maxprice; ?>" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label" for="add_min_capacity"><?php esc_html_e('Capacity','weddingvendor');?></label>
                                <select class="form-control" name="add_min_capacity" id="add_min_capacity">
                                    <option <?php if($item_capacity=="0") echo 'selected'; ?> value="0">0</option>
                                    <option <?php if($item_capacity=="1 - 50") echo 'selected'; ?> value="1 - 50">1 - 50</option>
                                    <option <?php if($item_capacity=="50 - 200") echo 'selected'; ?> value="50 - 200">50 - 200</option>
                                    <option <?php if($item_capacity=="200 - 500") echo 'selected'; ?> value="200 - 500">200 - 500</option>
                                    <option <?php if($item_capacity=="500 - 1000") echo 'selected'; ?> value="500 - 1000">500 - 1000</option>
                                    <option <?php if($item_capacity=="1000 - more") echo 'selected'; ?> value="1000 - more">1000 - more</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="add_address"><?php esc_html_e('Address','weddingvendor');?><span class="required">*</span></label>
                        <input id="add_address" name="add_address" type="text" class="form-control input-md required" value="<?php echo $item_address; ?>" >
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="add_google_marker_address"><?php esc_html_e('Google Map Address for select marker place','weddingvendor');?></label>
                        <input id="gmaps-input-address" name="add_google_marker_address" type="text" class="form-control input-md required" value="<?php echo $item_google_address; ?>" >
                        <div id="gmaps-canvas"></div>
                        <div id="gmaps-error"></div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="gmaps-output-latitude"><?php esc_html_e('Latitude (Google Map)','weddingvendor');?></label>
                                <input id="gmaps-output-latitude" type="text" class="form-control input-md required" value="<?php echo $item_google_latitude; ?>" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" for="gmaps-output-longitude"><?php esc_html_e('Longitude (Google Map)','weddingvendor');?></label>
                                <input id="gmaps-output-longitude" type="text" class="form-control input-md required"  value="<?php echo $item_google_longitude; ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="add_video_url"><?php esc_html_e('Video URL(youtube,vimeo etc)','weddingvendor');?></label>
                        <input id="add_video_url" name="add_video_url" type="text" class="form-control input-md" value="<?php echo $tab_item_video; ?>" >
                    </div>                
                    <div id="upload-container">                 
                        <div id="aaiu-upload-container">                 
                            <div id="aaiu-upload-imagelist">
                                <ul id="aaiu-ul-list" class="aaiu-upload-list"></ul>
                            </div>                    
                            <div id="imagelist">
                                <?php if($images!=''){ echo $images; }?>  
                            </div>                          
                            <button id="aaiu-uploader"  class="btn tp-btn-primary">
                                <?php esc_html_e('Select Media','weddingvendor');?>
                            </button>
                            <input type="hidden" name="attachid" id="attachid" value="<?php echo $attachid;?>">
                            <input type="hidden" name="attachthumb" id="attachthumb" value="<?php echo $thumbid;?>">
                            <p class="full_form full_form_image">
                            <?php esc_html_e('* At least 1 image is required for a valid submission.','weddingvendor');print '</br>';
                            esc_html_e('**After uploading your image you must select a featured image by clicking on you preferred photo.','weddingvendor');?>
                            </p>
                        </div>  
                    </div>                                                                        
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label" for="add_item_cat"><?php esc_html_e('Select Category','weddingvendor');?><span class="required">*</span></label>
                        <?php 
                        $item_cat='<select name="add_item_cat" id="add_item_cat" class="form-control input-md required">';
                        $terms = get_terms( 'itemcategory', array('orderby'    => 'name', 'hide_empty' => 0 ) );
                        foreach( $terms as $term ) {
                            
                        $selected_html='';
        
                        if(!empty($total_categories))
                        {
                            if(in_array($term->term_id,$total_categories))
                            {
                                $selected_html='selected';
                            }
                        }
                            
                            // output the term name in a heading tag                								
                            $item_cat.='<option value="'.$term->term_id.'" '.$selected_html.'>'.$term->name.'</option>';
                         
                        }
                        $item_cat.='</select>';
                        echo $item_cat;
                        ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="item_city"><?php esc_html_e('Select City','weddingvendor');?><span class="required">*</span></label>
                        <?php 
                        $item_city = '<select name="item_city" id="item_city" class="form-control input-md required">';
                        $terms_city = get_terms( 'itemcity', array('orderby' => 'name', 'hide_empty' => 0 ) );
                        foreach( $terms_city as $term ) {
                            
                            $selected_html='';
        
                            if(!empty($total_cities))
                            {
                                if(in_array($term->term_id,$total_cities))
                                {
                                    $selected_html='selected';
                                }
                            }								
                            // output the term name in a heading tag                								
                            $item_city.='<option value="'.$term->term_id.'" '.$selected_html.'>'.$term->name.'</option>';
                         
                        }
                        $item_city.='</select>';
                        echo $item_city;
                        ?>
                    </div>                        
                    <div class="form-group">
                        <label class="control-label" for="add_item_ami"><?php esc_html_e('Select Amenities','weddingvendor');?></label>
                        <?php 
                        $item_ami='';
                        $terms_amenities = get_terms( 'item_amenities', array('orderby'    => 'name','hide_empty' => 0 ) );							
                        
                        foreach( $terms_amenities as $term ) {
                        // output the term name in a heading tag     
                        $checked='';
        
                        if(!empty($total_amenities))
                        {
                            if(in_array($term->term_id,$total_amenities))
                            {
                                $checked=' checked="checked" ';
                            }
                        }
                    
                        $item_ami.='<label class="aminities_box"><input type="checkbox" name="add_item_ami" value="'.$term->term_id.'" '.$checked.' class="aminities">' . $term->name . '</label>';
                         
                        }
                        echo $item_ami;
                        ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    <?php 
                    if( isset( $_GET['item_edit'] ) && is_numeric( $_GET['item_edit'] ) ){
                    ?>
                       <input id="edit_id" name="edit_id" type="hidden" value="<?php echo $_GET['item_edit']; ?>" >                      
                       <button id="edit-listing-on" type="button" class="btn tp-btn-primary tp-btn-lg"><?php echo esc_html__('Save Listing','weddingvendor');?></button>
                    <?php 
                    }else{
                    ?>
                        <button id="add-listing-on" type="button" class="btn tp-btn-primary tp-btn-lg"><?php echo esc_html__('Add Listing','weddingvendor');?></button>
                    <?php 
                    }
                    ?>
                    </div>
                </div>
            </div>       
            </form>                     
          <?php 	  
          }
          else if($accessibility=='Off'){
          $package_price = package_price();
		  $user_member_status		 		= get_the_author_meta( 'user_member_status' , $userID );
		 
          echo '<div class="well-box text-center">';  
          if($user_member_status=='Free')
		  {
			echo '<h2>'.esc_html__('Free Listing Over','weddingvendor').'</h2>'; 
		  }
		  else if($user_member_status=='Paid')
		  {
			echo '<h2>'.esc_html__('Subscription Expired Or Item Listing Over','weddingvendor').'</h2>'; 
		  }
		  else if($user_member_status=='Expired')
		  {
			echo '<h2>'.esc_html__('Your All Item Expired Or Item Listing Over','weddingvendor').'</h2>'; 
		  }
 
			echo '<p>'.esc_html__('Please select your required package plan!','weddingvendor').'</p>';	  
			echo '<a  href="'.$package_price['url'].'" class="btn tp-btn-default">'.$package_price['name'].'</a>';
            echo '</div>';
          }
          ?>	
       </div>
	</div>
  </div>
</div>
<script>
<?php
if(isset($item_google_latitude) && !empty($item_google_latitude))
{
	$center_latitude=number_format($locators['latitude'],14);
	$center_longitude=number_format($locators['longitude'],14);
	$zoom=12;	
}
else{
	$center_latitude=number_format(tg_get_option('center_latitude'),14);
	$center_longitude=number_format(tg_get_option('center_longitude'),14);
	$zoom=5;	
}
?>
var center_lati=<?php echo $center_latitude;?>;
var center_long=<?php echo $center_longitude;?>;
var zoom_level=<?php echo $zoom;?>;
</script>
<?php 
}
else
{
	wedding_check_logout_user();
}
get_footer();
?>