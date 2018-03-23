<?php 
/*
* List of custom post type for weddingvendor
*/

add_action('init', 'wedding_slider_register');

function wedding_slider_register() {
    register_post_type('slider', array(
        'label' => esc_html__('Slider','weddingvendor'),
        'description' => '',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'slider', 'with_front' => true),
        'query_var' => true,
        'menu_position' => '500',        
        'menu_icon'   => 'dashicons-images-alt2',
        'supports' => array('title', 'thumbnail',  'page-attributes'),
        'labels' => array(
            'name' => esc_html__('Slider','weddingvendor'),
            'singular_name' => esc_html__('Slider','weddingvendor'),
            'menu_name' => esc_html__('Slider','weddingvendor'),
            'add_new' => esc_html__('Add Slider','weddingvendor'),
            'add_new_item' => esc_html__('Add New Slider','weddingvendor'),
            'edit' => esc_html__('Edit Slider','weddingvendor'),
            'edit_item' => esc_html__('Edit Slider','weddingvendor'),
            'new_item' => esc_html__('New Slider','weddingvendor'),
            'view' => esc_html__('View Slider','weddingvendor'),
            'view_item' => esc_html__('View Slider','weddingvendor'),
            'search_items' => esc_html__('Search Slider','weddingvendor'),
            'not_found' => esc_html__('No Slider Found','weddingvendor'),
            'not_found_in_trash' => esc_html__('No Slider Found in Trash','weddingvendor'),
            'parent' => esc_html__('Parent Slider','weddingvendor'),
        )
    ));
}

/*
* List of custom post type for weddingvendor
*/

add_action('init', 'wedding_package_register');

function wedding_package_register() {
    register_post_type('package', array(
        'label' => esc_html__('Package','weddingvendor'),
        'description' => '',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'package', 'with_front' => true),
        'query_var' => true,
        'menu_position' => '500',        
        'menu_icon'   => 'dashicons-calendar-alt',
        'supports' => array('title','page-attributes'),
        'labels' => array(
            'name' => esc_html__('Package','weddingvendor'),
            'singular_name' => esc_html__('Package','weddingvendor'),
            'menu_name' => esc_html__('Package','weddingvendor'),
            'add_new' => esc_html__('Add Package','weddingvendor'),
            'add_new_item' => esc_html__('Add New Package','weddingvendor'),
            'edit' => esc_html__('Edit Package','weddingvendor'),
            'edit_item' => esc_html__('Edit Package','weddingvendor'),
            'new_item' => esc_html__('New Package','weddingvendor'),
            'view' => esc_html__('View Package','weddingvendor'),
            'view_item' => esc_html__('View Package','weddingvendor'),
            'search_items' => esc_html__('Search Package','weddingvendor'),
            'not_found' => esc_html__('No Package Found','weddingvendor'),
            'not_found_in_trash' => esc_html__('No Package Found in Trash','weddingvendor'),
            'parent' => esc_html__('Parent Package','weddingvendor'),
        )
    ));
}


// Custom Item post

add_action('init', 'wedding_item_register');

function wedding_item_register() {
	
    register_post_type('item', array(
        'label' => esc_html__('Item','weddingvendor'),
        'description' => '',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => array('slug' => 'item', 'with_front' => true),
        'query_var' => true,
        'menu_position' => '500',        
        'menu_icon'   => 'dashicons-list-view',
        'supports' => array('title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes','comments','revisions','author'),
        'labels' => array(
            'name' => esc_html__('Item','weddingvendor'),
            'singular_name' => esc_html__('Item','weddingvendor'),
            'menu_name' => esc_html__('Item','weddingvendor'),
            'add_new' => esc_html__('Add Item','weddingvendor'),
            'add_new_item' => esc_html__('Add New Item','weddingvendor'),
            'edit' => esc_html__('Edit Item','weddingvendor'),
            'edit_item' => esc_html__('Edit Item','weddingvendor'),
            'new_item' => esc_html__('New Item','weddingvendor'),
            'view' => esc_html__('View Item','weddingvendor'),
            'view_item' => esc_html__('View Item','weddingvendor'),
            'search_items' => esc_html__('Search Item','weddingvendor'),
            'not_found' => esc_html__('No Item Found','weddingvendor'),
            'not_found_in_trash' => esc_html__('No Item Found in Trash','weddingvendor'),
            'parent' => esc_html__('Parent Item','weddingvendor'),
        )
    ));
}


function wedding_item_category() {
	register_taxonomy(
		'itemcategory',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'item',   	 //post type name
		array(
			'hierarchical' 		=> true,
			'label' 			=> esc_html__('Category','weddingvendor'),  //Display name
			'query_var' 		=> true,
			'rewrite'			=> array(
					'slug' 			=> 'itemcategory', // This controls the base slug that will display before each term
					'with_front' 	=> false // Don't display the category base before
					)
			)
		);
}
add_action( 'init', 'wedding_item_category');

function wedding_item_cities() {
	register_taxonomy(
		'itemcity',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'item',   	 //post type name
		array(
			'hierarchical' 		=> true,
			'label' 			=> esc_html__('City','weddingvendor'),  //Display name
			'query_var' 		=> true,
			'rewrite'			=> array(
					'slug' 			=> 'itemcity', // This controls the base slug that will display before each term
					'with_front' 	=> false // Don't display the category base before
					)
			)
		);
}
add_action( 'init', 'wedding_item_cities');


function wedding_amenities_taxonomy() {
	register_taxonomy(
		'item_amenities',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'item',   	 //post type name
		array(
			'hierarchical' 		=> true,
			'label' 			=> 'Amenity',  //Display name
			'labels' => array(
				'name'              => esc_html__('Amenity','weddingvendor'),
				'singular_name'     => esc_html__('Amenity','weddingvendor'),
				'search_items'      => esc_html__('Search Amenity','weddingvendor'),
				'all_items'         => esc_html__('All Amenity','weddingvendor'),
				'edit_item'         => esc_html__('Edit Amenity','weddingvendor'),
				'update_item'       => esc_html__('Update Amenity','weddingvendor'),
				'add_new_item'      => esc_html__('Add New Amenity','weddingvendor'),
				'new_item_name'     => esc_html__('New Amenity','weddingvendor'),
				'menu_name'         => esc_html__('Amenity','weddingvendor'),
  	            'not_found'			=> esc_html__('No Amenity Found','weddingvendor'),				
			),			
			'query_var' 		=> true,
			'rewrite'			=> array(
					'slug' 			=> 'item', // This controls the base slug that will display before each term
					'with_front' 	=> false // Don't display the category base before
					)
			)
		);
}
add_action( 'init', 'wedding_amenities_taxonomy');

// Custom FAQ post

add_action('init', 'wedding_faq_register');

function wedding_faq_register() {

    register_post_type('faq', array(
        'label' => esc_html__('FAQ','weddingvendor'),
        'description' => '',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,         
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => false,
        'rewrite' => array('slug' => 'faq', 'with_front' => true),
        'query_var' => true,
        'menu_position' => '5',
        'menu_icon'   => 'dashicons-editor-help',
        'supports' => array('title', 'page-attributes'),
		'has_archive' => 'faq',		
        'labels' => array(
            'name' => esc_html__('FAQ','weddingvendor'),
            'singular_name' => esc_html__('FAQ','weddingvendor'),
            'menu_name' => esc_html__('FAQ','weddingvendor'),
            'add_new' => esc_html__('Add FAQ','weddingvendor'),
            'add_new_item' => esc_html__('Add New FAQ','weddingvendor'),
            'edit' => esc_html__('Edit FAQ','weddingvendor'),
            'edit_item' =>esc_html__('Edit FAQ','weddingvendor'),
            'new_item' => esc_html__('Add FAQ','weddingvendor'),
            'view' => esc_html__('View FAQ','weddingvendor'),
            'view_item' => esc_html__('View FAQ','weddingvendor'),
            'search_items' => esc_html__('Search FAQ','weddingvendor'),
            'not_found' => esc_html__('No FAQ Found','weddingvendor'),
            'not_found_in_trash' => esc_html__('No FAQ Found in Trash','weddingvendor'),
            'parent' => esc_html__('Parent FAQ','weddingvendor'),
        )
    ));
}

// Custom Testimonial post

add_action('init', 'wedding_testimonial_register');

function wedding_testimonial_register() {
    register_post_type('testimonial', array(
        'label' => esc_html__('Testimonial','weddingvendor'),
        'description' => '',
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'map_meta_cap' => true,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'testimonial', 'with_front' => true),
        'query_var' => true,
        'menu_position' => '600',        
        'menu_icon'   => 'dashicons-testimonial',
        'supports' => array('title', 'page-attributes','thumbnail',),		
        'labels' => array(
            'name' => esc_html__('Testimonial','weddingvendor'),
            'singular_name' => esc_html__('Testimonial','weddingvendor'),
            'menu_name' => esc_html__('Testimonial','weddingvendor'),
            'add_new' => esc_html__('Add Testimonial','weddingvendor'),
            'add_new_item' => esc_html__('Add New Testimonial','weddingvendor'),
            'edit' => esc_html__('Edit Testimonial','weddingvendor'),
            'edit_item' => esc_html__('Edit Testimonial','weddingvendor'),
            'new_item' => esc_html__('New Testimonial','weddingvendor'),
            'view' => esc_html__('View Testimonial','weddingvendor'),
            'view_item' => esc_html__('View Testimonial','weddingvendor'),
            'search_items' => esc_html__('Search Testimonial','weddingvendor'),
            'not_found' => esc_html__('No Testimonial Found','weddingvendor'),
            'not_found_in_trash' => esc_html__('No Testimonial Found in Trash','weddingvendor'),
            'parent' => esc_html__('Parent Testimonial','weddingvendor'),
        )
    ));
}

add_action( 'init', 'wedding_member_expired_post_status' );
if( !function_exists('wedding_member_expired_post_status') ):
function wedding_member_expired_post_status(){
	register_post_status( 'expired', array(
		'label'                     => esc_html__( 'expired', 'weddingvendor' ),
		'public'                    => true,
		'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Membership Expired <span class="count">(%s)</span>', 'Membership Expired <span class="count">(%s)</span>' ),
	) );
}
endif; // end   wedding_member_expired_post_status 

// ONLY ITEM CUSTOM TYPE POSTS
add_filter('manage_item_posts_columns', 'weddding_columns_head_item', 10);
add_action('manage_item_posts_custom_column', 'weddding_columns_content_item', 10, 2);
 
// CREATE TWO FUNCTIONS TO HANDLE THE COLUMN
function weddding_columns_head_item($defaults) {
    $defaults['item_user'] = esc_html__('User','weddingvendor');
	$defaults['item_catetory'] = esc_html__('Category','weddingvendor');
	$defaults['item_city'] = esc_html__('City','weddingvendor');
	$defaults['item_price'] = esc_html__('Price','weddingvendor');
    return $defaults;
}

function weddding_columns_content_item($column_name, $post_id) {
    if ($column_name == 'item_user') {
        // show content of 'item_user' column
		$post_tmp 			= get_post($post_id);
		$author_id 			= $post_tmp->post_author;
		echo get_the_author_meta('display_name', $author_id);
    }
    if ($column_name == 'item_catetory') {
		$itemcategory    	= get_the_terms( $post_id, 'itemcategory');	
		if(isset($itemcategory[0]->name) && !empty($itemcategory[0]->name))
		echo $itemcategory[0]->name;
    }	
    if ($column_name == 'item_price') {
		$item_price    	= get_post_meta($post_id, 'item_price', true) ;			
		echo $item_price;
    }	
}
?>