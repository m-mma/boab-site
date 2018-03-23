<?php 
///////////////////////////////////////////////////////////////////////////////////////////
// dasboaord link
///////////////////////////////////////////////////////////////////////////////////////////

if( !function_exists('get_dashboard_link') ):
function get_dashboard_link(){
    $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/dashboard.php'
        ));	
	
    if( $pages ){
		$dash_link['id'] = $pages[0]->ID;
		$dash_link['name'] = $pages[0]->post_title;
		$dash_link['url'] = get_permalink($pages[0]->ID);
    }else{
		$dash_link['id'] = get_option( 'page_on_front' );
		$dash_link['name'] = get_the_title(get_option( 'page_on_front' ));
        $dash_link['url'] = esc_url(home_url());		
    }  
    
    return $dash_link;
}
endif; // end   get_dashboard_link 

///////////////////////////////////////////////////////////////////////////////////////////
// Edit profile link
///////////////////////////////////////////////////////////////////////////////////////////

if( !function_exists('get_user_profile_link') ):
function get_user_profile_link(){
    $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/user-profile.php'
        ));
		
    if( $pages ){
		$profile_link['id'] = $pages[0]->ID;
		$profile_link['name'] = $pages[0]->post_title;
		$profile_link['url'] = get_permalink($pages[0]->ID);
    }else{
		$profile_link['id'] = get_option( 'page_on_front' );
		$profile_link['name'] = get_the_title(get_option( 'page_on_front' ));
        $profile_link['url'] = esc_url(home_url());		
    }  
    
    return $profile_link;
}
endif; // end   get_user_profile_link  


///////////////////////////////////////////////////////////////////////////////////////////
// Change Password link
///////////////////////////////////////////////////////////////////////////////////////////

if( !function_exists('get_user_change_password') ):
function get_user_change_password(){
    $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/change-password.php'
        ));
		
    if( $pages ){
		$return_link['id'] = $pages[0]->ID;
		$return_link['name'] = $pages[0]->post_title;
		$return_link['url'] = get_permalink($pages[0]->ID);
    }else{
		$return_link['id'] = get_option( 'page_on_front' );
		$return_link['name'] = get_the_title(get_option( 'page_on_front' ));
        $return_link['url'] = esc_url(home_url());		
    }  
	    
    return $return_link;
}
endif; // end   get_user_change_password  


///////////////////////////////////////////////////////////////////////////////////////////
// Change Password link
///////////////////////////////////////////////////////////////////////////////////////////

if( !function_exists('get_add_listing') ):
function get_add_listing(){
    $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/add-listing.php'
        ));
		
    if( $pages ){
		$add_link['id'] = $pages[0]->ID;
		$add_link['name'] = $pages[0]->post_title;
		$add_link['url'] = get_permalink($pages[0]->ID);
    }else{
		$add_link['id'] = get_option( 'page_on_front' );
		$add_link['name'] = get_the_title(get_option( 'page_on_front' ));
        $add_link['url'] = esc_url(home_url());		
    } 
    
    return $add_link;
}
endif; // end   get_add_listing  


///////////////////////////////////////////////////////////////////////////////////////////
// Manage Listing link
///////////////////////////////////////////////////////////////////////////////////////////

if( !function_exists('get_manage_listing') ):
function get_manage_listing(){
    $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/manage-listing.php'
        ));
		
    if( $pages ){
		$return_link['id'] = $pages[0]->ID;
		$return_link['name'] = $pages[0]->post_title;
		$return_link['url'] = get_permalink($pages[0]->ID);
    }else{
		$return_link['id'] = get_option( 'page_on_front' );
		$return_link['name'] = get_the_title(get_option( 'page_on_front' ));
        $return_link['url'] = esc_url(home_url());		
    } 
    
    return $return_link;
}
endif; // end   get_manage_listing  

///////////////////////////////////////////////////////////////////////////////////////////
// Manage Listing link
///////////////////////////////////////////////////////////////////////////////////////////

if( !function_exists('map_item_listing') ):
function map_item_listing(){

	$home_search_template  = tg_get_option('home_search_template'); 
	
	if(isset($home_search_template) && !empty($home_search_template))
	{
		$template_name=$home_search_template;
	}
	else{
		$template_name='listing-map';
	}
	
    $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/'.$template_name.'.php'
        ));
		
    if( $pages ){
		$return_link['id'] = $pages[0]->ID;
		$return_link['name'] = $pages[0]->post_title;
		$return_link['url'] = get_permalink($pages[0]->ID);
    }else{
		$return_link['id'] = get_option( 'page_on_front' );
		$return_link['name'] = get_the_title(get_option( 'page_on_front' ));
        $return_link['url'] = esc_url(home_url());		
    } 
    
    return $return_link;
}
endif; // end   map_item_listing

///////////////////////////////////////////////////////////////////////////////////////////
// package link
///////////////////////////////////////////////////////////////////////////////////////////

if( !function_exists('package_price') ):
function package_price(){
    $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/package.php'
        ));
		
    if( $pages ){
		$return_link['id'] = $pages[0]->ID;
		$return_link['name'] = $pages[0]->post_title;
		$return_link['url'] = get_permalink($pages[0]->ID);
    }else{
		$return_link['id'] = get_option( 'page_on_front' );
		$return_link['name'] = get_the_title(get_option( 'page_on_front' ));
        $return_link['url'] = esc_url(home_url());		
    } 
    
    return $return_link;
}
endif; // end   map_item_listing 

///////////////////////////////////////////////////////////////////////////////////////////
// couple dasboaord link
///////////////////////////////////////////////////////////////////////////////////////////

if( !function_exists('get_couple_dashboard_link') ):
function get_couple_dashboard_link(){
    $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/couple-dashboard.php'
        ));	
	
    if( $pages ){
		$dash_link['id'] = $pages[0]->ID;
		$dash_link['name'] = $pages[0]->post_title;
		$dash_link['url'] = get_permalink($pages[0]->ID);
    }else{
		$dash_link['id'] = get_option( 'page_on_front' );
		$dash_link['name'] = get_the_title(get_option( 'page_on_front' ));
        $dash_link['url'] = esc_url(home_url());		
    }  
    
    return $dash_link;
}
endif; // end   get_dashboard_link  

///////////////////////////////////////////////////////////////////////////////////////////
// Couple profile
///////////////////////////////////////////////////////////////////////////////////////////

if( !function_exists('get_couple_profile_link') ):
function get_couple_profile_link(){
    $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/couple-profile.php'
        ));
		
    if( $pages ){
		$profile_link['id'] = $pages[0]->ID;
		$profile_link['name'] = $pages[0]->post_title;
		$profile_link['url'] = get_permalink($pages[0]->ID);
    }else{
		$profile_link['id'] = get_option( 'page_on_front' );
		$profile_link['name'] = get_the_title(get_option( 'page_on_front' ));
        $profile_link['url'] = esc_url(home_url());		
    }  
    
    return $profile_link;
}
endif; // end   get_couple_profile_link  

///////////////////////////////////////////////////////////////////////////////////////////
// Couple wishlist
///////////////////////////////////////////////////////////////////////////////////////////

if( !function_exists('get_couple_wishlist_link') ):
function get_couple_wishlist_link(){
    $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/couple-wishlist.php'
        ));
		
    if( $pages ){
		$profile_link['id'] = $pages[0]->ID;
		$profile_link['name'] = $pages[0]->post_title;
		$profile_link['url'] = get_permalink($pages[0]->ID);
    }else{
		$profile_link['id'] = get_option( 'page_on_front' );
		$profile_link['name'] = get_the_title(get_option( 'page_on_front' ));
        $profile_link['url'] = esc_url(home_url());		
    }  
    
    return $profile_link;
}
endif; // end   get_couple_wishlist_link  

///////////////////////////////////////////////////////////////////////////////////////////
// Couple todolist
///////////////////////////////////////////////////////////////////////////////////////////

if( !function_exists('get_couple_todolist_link') ):
function get_couple_todolist_link(){
    $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/couple-todolist.php'
        ));
		
    if( $pages ){
		$profile_link['id'] = $pages[0]->ID;
		$profile_link['name'] = $pages[0]->post_title;
		$profile_link['url'] = get_permalink($pages[0]->ID);
    }else{
		$profile_link['id'] = get_option( 'page_on_front' );
		$profile_link['name'] = get_the_title(get_option( 'page_on_front' ));
        $profile_link['url'] = esc_url(home_url());		
    }  
    
    return $profile_link;
}
endif; // end   get_couple_todoist_link  

///////////////////////////////////////////////////////////////////////////////////////////
// Couple budget
///////////////////////////////////////////////////////////////////////////////////////////

if( !function_exists('get_couple_budget_link') ):
function get_couple_budget_link(){
    $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/couple-budget.php'
        ));
		
    if( $pages ){
		$profile_link['id'] = $pages[0]->ID;
		$profile_link['name'] = $pages[0]->post_title;
		$profile_link['url'] = get_permalink($pages[0]->ID);
    }else{
		$profile_link['id'] = get_option( 'page_on_front' );
		$profile_link['name'] = get_the_title(get_option( 'page_on_front' ));
        $profile_link['url'] = esc_url(home_url());		
    }  
    
    return $profile_link;
}
endif; // end   get_couple_budget_link  

///////////////////////////////////////////////////////////////////////////////////////////
// get_vendor_profile_link
///////////////////////////////////////////////////////////////////////////////////////////

if( !function_exists('get_vendor_profile_link') ):
function get_vendor_profile_link(){
    $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/vendor-profile.php'
        ));
		
    if( $pages ){
		$profile_link['id'] = $pages[0]->ID;
		$profile_link['name'] = $pages[0]->post_title;
		$profile_link['url'] = get_permalink($pages[0]->ID);
    }else{
		$profile_link['id'] = get_option( 'page_on_front' );
		$profile_link['name'] = get_the_title(get_option( 'page_on_front' ));
        $profile_link['url'] = esc_url(home_url());		
    }  
    
    return $profile_link;
}
endif; // end   get_vendor_profile_link  

///////////////////////////////////////////////////////////////////////////////////////////
// get_top_map_link
///////////////////////////////////////////////////////////////////////////////////////////

if( !function_exists('get_top_map_link') ):
function get_top_map_link(){
    $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'page-templates/top-map.php'
        ));
		
    if( $pages ){
		$profile_link['id'] = $pages[0]->ID;
		$profile_link['name'] = $pages[0]->post_title;
		$profile_link['url'] = get_permalink($pages[0]->ID);
    }else{
		$profile_link['id'] = get_option( 'page_on_front' );
		$profile_link['name'] = get_the_title(get_option( 'page_on_front' ));
        $profile_link['url'] = esc_url(home_url());		
    }  
    
    return $profile_link;
}
endif; // end   get_top_map_link  



///////////////////////////////////////////////////////////////////////////////////////////
// HTML wedding get_html_vendor_profile
///////////////////////////////////////////////////////////////////////////////////////////

function get_html_vendor_profile_button($user_id)
{
	$get_vendor_profile_link=get_vendor_profile_link();
	$vendor_profile_url=$get_vendor_profile_link['url'].'?userid='.$user_id;
	return '<a href="'.$vendor_profile_url.'" class="btn tp-btn-default tp-btn-lg btn-block">'.esc_html__('View Vendor Profile','weddingvendor').'</a>';
}

///////////////////////////////////////////////////////////////////////////////////////////
// HTML wedding item_address
///////////////////////////////////////////////////////////////////////////////////////////

function wedding_item_address_html($item_address)
{
	$html_address='';
	if(!empty($item_address))
	{
		$html_address = '<p class="location"><i class="fa fa-map-marker"></i> '.esc_html($item_address).'</p>';
	}
	return $html_address;
}

///////////////////////////////////////////////////////////////////////////////////////////
// HTML wedding item_price
///////////////////////////////////////////////////////////////////////////////////////////

function wedding_item_price($item_price,$item_maxprice,$currency_code)
{
	$item_price_array=array();
	if($item_maxprice)
	{
		$item_maxprice_html = ' - '.$currency_code.' '.$item_maxprice;
	}
	else{
		$item_maxprice_html = '';
	}
	
	if($item_price)
	{
		$item_price_array['html'] 	= '<div class="vendor-price"><div class="price">'.$currency_code.' '.$item_price.$item_maxprice_html.'</div></div>';
		$item_price_array['marker'] = $currency_code.' '. $item_price.$item_maxprice_html;
	}
	else{
		$item_price_array['html'] 	= '';
		$item_price_array['marker'] = '';
	}

	return $item_price_array;	
}

///////////////////////////////////////////////////////////////////////////////////////////
// HTML wedding item_price marker
///////////////////////////////////////////////////////////////////////////////////////////

function wedding_item_price_marker($item_price,$item_maxprice,$currency_code)
{
	if($item_maxprice)
	{
		$item_maxprice_html = ' - '.$currency_code.' '.$item_maxprice;
	}
	else{
		$item_maxprice_html = '';
	}
	
	if($item_price)
	{
		$item_price_marker = $currency_code.' '. $item_price.$item_maxprice_html;
	}
	else{
		$item_price_marker = '';
	}

	return $item_price_marker;	
}


///////////////////////////////////////////////////////////////////////////////////////////
// HTML wedding item_price
///////////////////////////////////////////////////////////////////////////////////////////

function wedding_item_price_html($item_price,$item_maxprice,$currency_code)
{
	if($item_maxprice)
	{
		$item_price_value = $currency_code.' '.$item_price.' - '.$currency_code.' '.$item_maxprice;
	}
	else{
		$item_price_value = $currency_code.' '.$item_price;
	}
	
	if($item_price)
	{
		$item_price_html = '<div class="vendor-price"><div class="price">' . esc_html($item_price_value).'</div></div>'; 
	}
	else
	{
		$item_price_html = '';
	}
	return $item_price_html;
}


///////////////////////////////////////////////////////////////////////////////////////////
// Google Default marker icon
///////////////////////////////////////////////////////////////////////////////////////////

function wedding_default_marker($cat_link_id)
{
	if(!empty($cat_link_id))
	{
		$t_id		= $cat_link_id;
		$term_meta 	= get_option( "itemcategory_$t_id" );
		if(!empty($term_meta))
			$marker_icon = esc_attr( $term_meta['image'] ) ? esc_attr( $term_meta['image'] ) : ''; 
		else
			$marker_icon = tg_get_option('default_marker');
	}
	else{
		$marker_icon = tg_get_option('default_marker');
	}
	return $marker_icon;
}

///////////////////////////////////////////////////////////////////////////////////////////
// Filter Capacity Item list
///////////////////////////////////////////////////////////////////////////////////////////

function wedding_item_filter_capacity($item_capacity)
{
	$item_capacity0 	=	($item_capacity == '0') ? 'selected' : '';
	$item_capacity50 	=	($item_capacity == '1 - 50') ? 'selected' : '';
	$item_capacity200 	=	($item_capacity == '50 - 200') ? 'selected' : '';
	$item_capacity500 	=	($item_capacity == '200 - 500') ? 'selected' : '';
	$item_capacity1000 	=	($item_capacity == '500 - 1000') ? 'selected' : '';
	$item_capacitymore 	=	($item_capacity == '1000 - more') ? 'selected' : '';
	
	$html_content='<select class="form-control" name="capacity" id="capacity">
					<option '.$item_capacity0.' value="0">0</option>
					<option '.$item_capacity50.' value="1 - 50">1 - 50</option>
					<option '.$item_capacity200.' value="50 - 200">50 - 200</option>
					<option '.$item_capacity500.' value="200 - 500">200 - 500</option>
					<option '.$item_capacity1000.' value="500 - 1000">500 - 1000</option>
					<option '.$item_capacitymore.' value="1000 - more">1000 - more</option>
                  </select>';
	return $html_content;
}

///////////////////////////////////////////////////////////////////////////////////////////
// Filter City Item
///////////////////////////////////////////////////////////////////////////////////////////

function wedding_item_filter_city($city_id)
{
	$itemcity='<select name="city" id="city" class="form-control input-md">';
	$terms = get_terms( 'itemcity', array(
	'orderby'    => 'name',
	'hide_empty' => 0
	) );
	$itemcity.='<option value="">'.esc_html__('Select City','weddingvendor').'</option>';
	foreach( $terms as $term ) {
	
	$selected_html='';
	
	if(!empty($city_id))
	{
	if($term->term_id==$city_id)
	{
		$selected_html='selected';
	}
	else{
		$selected_html='';
	}
	}
	
	// output the term name in a heading tag                								
	$itemcity.='<option value="'.$term->term_id.'" '.$selected_html.'>'.$term->name.'</option>';
	
	}
	$itemcity.='</select>';
	
	return $itemcity;
}

///////////////////////////////////////////////////////////////////////////////////////////
// Filter Category Item
///////////////////////////////////////////////////////////////////////////////////////////

function wedding_item_filter_category($category_type_id)
{
	$terms = get_terms( 'itemcategory', array('orderby'    => 'name','hide_empty' => 0	) );
	
	$item_cat='<select name="category_type" id="category_type" class="form-control input-md">';
	$item_cat.='<option value="">'.esc_html__('Select Category','weddingvendor').'</option>';
	foreach( $terms as $term ) {
	
	$selected_html='';
	
	if(!empty($category_type_id))
	{
		if($term->term_id==$category_type_id)
		{
			$selected_html='selected';
		}
		else{
			$selected_html='';
		}
	}
	
	// output the term name in a heading tag                								
	$item_cat.='<option value="'.$term->term_id.'" '.$selected_html.'>'.$term->name.'</option>';
	
	}
	$item_cat.='</select>';
	return $item_cat;
}

function wedding_wishlist_item_html($item_id)
{

	if (is_user_logged_in() ) {
		global $current_user;
		wp_get_current_user();
		$userid     = $current_user->ID;		
		$wistlist_exp=get_user_meta( $userid, 'user_wishlist',true) ;	
		$wistlist_arr=explode(",",$wistlist_exp);

		if(in_array($item_id,$wistlist_arr))
		{
				$wishlist_html='<div class="favorite-action" id="fav_'.$item_id.'"> <a class="fav-icon" href="javascript:void(0)" onclick=remove_wishlist('.$item_id.')><i class="fa fa-close"></i></a> </div>';
		}
		else
		{
			$wishlist_html='<div class="favorite-action" id="fav_'.$item_id.'"> <a class="fav-icon" href="javascript:void(0)" onclick=add_wishlist('.$item_id.')><i class="fa fa-heart"></i></a> </div>';		
		}
	}
	else
	{		
		$wishlist_html='';
	}
	return $wishlist_html;
}
?>