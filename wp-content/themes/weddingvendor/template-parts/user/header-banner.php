<?php
$list_style=tg_get_option('items_display_style');
if(is_singular( 'item' ) && ($list_style=="right" || $list_style=="left"))
{
	// Not Display breadcum in single item right contact form
}
else if(!is_front_page() && !is_page_template('page-templates/page-slider.php'))
{
	$page_id					=	get_the_id();
	$get_dashboard_link			=	get_dashboard_link();
	$get_user_profile_link		=	get_user_profile_link();
	$get_add_listing			=	get_add_listing();
	$get_manage_listing			=	get_manage_listing();
	$package_price				=	package_price();
	$couple_dashboard_link 		= 	get_couple_dashboard_link();
	$couple_profile_link 		= 	get_couple_profile_link();
	$couple_wishlist_link 		= 	get_couple_wishlist_link();
	$couple_todolist_link 		= 	get_couple_todolist_link();
	$couple_budget_link 		= 	get_couple_budget_link();
	$vendor_profile_link 		= 	get_vendor_profile_link();
	$get_top_map_link	 		= 	get_top_map_link();
	
	
	if($get_dashboard_link['id']!=$page_id && $get_user_profile_link['id']!=$page_id && $get_add_listing['id']!=$page_id && $get_manage_listing['id']!=$page_id && $package_price['id']!=$page_id && $couple_dashboard_link['id']!=$page_id && $couple_profile_link['id']!=$page_id && $couple_todolist_link['id']!=$page_id && $couple_wishlist_link['id']!=$page_id && $vendor_profile_link['id']!=$page_id && $get_top_map_link['id']!=$page_id && $couple_budget_link['id']!=$page_id)
	{		
		if(!is_search())
		{
		?>  
		<div class="tp-page-head"><!-- page header -->
		  <div class="container blog-header">
			<div class="row">
			  <div class="col-md-12">
				<div class="page-header">
				  <h1><?php
					if(is_tax('itemcategory'))
						single_cat_title(); 
					else 
						the_title();
				  ?></h1>
				</div>
			  </div>
			</div>
		  </div>
		</div>
		<!-- ./ page header --> 
		<?php 
		}
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
	}
}
?>