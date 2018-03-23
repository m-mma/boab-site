<?php 
/**
 * Enqueue scripts and styles.
 */
function weddingvendor_scripts() {
	wp_enqueue_style( 'weddingvendor-style', get_stylesheet_uri() );

	// Bootstrap 
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() .'/css/bootstrap.min.css','', '3.3.5' );	

	// Custom - style
	wp_enqueue_style( 'weddingvendor-custom-style', get_template_directory_uri() .'/css/custom-style.css');	

	// Menumaker - style
	wp_enqueue_style( 'weddingvendor-menumaker', get_template_directory_uri() .'/css/menumaker.css');	

	// animate - style
	wp_enqueue_style( 'weddingvendor-animate', get_template_directory_uri() .'/css/animate.css');			

	// Flaticon 
	wp_enqueue_style( 'flaticon', get_template_directory_uri() .'/css/flaticon.css','', '1.0.0' );
	
	// Fontello 
	wp_enqueue_style( 'fontello', get_template_directory_uri() .'/css/fontello.css','', '1.0.0' );		

	wp_enqueue_style( 'weddingvendor-owl-carousel', get_template_directory_uri() .'/css/owl.carousel.css');

	// Custom owl-min JS	
	wp_enqueue_script( 'owl-carousel-min', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), null, true );
	
	wp_enqueue_script('validate-script', get_template_directory_uri() . '/js/jquery.validate.js', array('jquery') ); 


	wp_enqueue_script('weddingvendor-menumaker-script', get_template_directory_uri() . '/js/menumaker.js', array('jquery') ); 
	
	// Jquery Sticky	
	wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array(), null, true );

	// Custom Script JS	
	if(is_rtl())
	{
		wp_enqueue_script( 'weddingvendor-owl-script-rtl', get_template_directory_uri() . '/js/owl-script-rtl.js', array(), null, true );	
	}
	else
	{
		wp_enqueue_script( 'weddingvendor-owl-script', get_template_directory_uri() . '/js/owl-script.js', array(), null, true );	
	}


	// Font Awesome
	wp_enqueue_style( 'font-awesome-min', get_template_directory_uri() .'/css/font-awesome.min.css','', '4.5.0' );	
	
	// Bootstrap JS
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), null, true );	

	wp_enqueue_script( 'weddingvendor-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if( is_page_template('page-templates/listing-oscar.php') || is_page_template('page-templates/listing-map') || 
	is_page_template('page-templates/listing-bubba') || taxonomy_exists( 'itemcategory' )){
		
		wp_enqueue_script('jquery-ui');
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_style('google-ui-jquery', get_template_directory_uri() .'/framework/css/jquery-ui-1.8.16.custom.css');			
	}

	if(is_page_template('page-templates/add-listing.php'))
	{
		wp_enqueue_script('jquery-ui');
		wp_enqueue_script('jquery-ui-draggable');
		wp_enqueue_script('jquery-ui-autocomplete');
	
		wp_enqueue_script('weddingvendor-google-locator', get_template_directory_uri().'/js/set-google-marker.js', array(), null, true );			
		wp_enqueue_script('googlemap-scripts', 'https://maps.google.com/maps/api/js?libraries=places&amp;sensor=true&amp;key='.tg_get_option('google_map_key').'', array('jquery'), 1.0, false );	

	}

	if(is_page_template('page-templates/listing-map.php') || is_page_template('page-templates/top-map.php'))
	{	
		wp_enqueue_style( 'leaflet-markercluster', get_template_directory_uri() .'/css/markercluster.css');	
		
		wp_enqueue_script( 'googlemap-scripts', 'https://maps.google.com/maps/api/js?libraries=places&amp;sensor=true&amp;key='.tg_get_option('google_map_key').'', array('jquery'), 1.0, false );	
		
		wp_enqueue_script( 'markerclusterer', get_template_directory_uri() . '/js/markerclusterer.js', array(), null, false );
		wp_enqueue_script( 'infobox', get_template_directory_uri() . '/js/infobox.js', array(), null, false );	
		wp_enqueue_script( 'weddingvendor-google-call', get_template_directory_uri() . '/js/google_map_script.js', array(), null, false );			
	}

	if(is_page_template('page-templates/couple-todolist.php'))
	{
		wp_enqueue_style('google-ui-jquery', get_template_directory_uri() .'/framework/css/jquery-ui-1.8.16.custom.css');
		wp_enqueue_script( 'weddingvendor-couple-circlechart', get_template_directory_uri() . '/js/jquery.circlechart.js', array(), null, true);	
	}
	if(is_page_template('page-templates/couple-budget.php'))
	{
		wp_enqueue_script( 'weddingvendor-couple-circlechart', get_template_directory_uri() . '/js/jquery.circlechart.js', array(), null, true);	
	}


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if(is_singular( 'item' ) )
	{
		wp_enqueue_script( 'dcsnt', 'https://maps.google.com/maps/api/js?libraries=places&amp;key='.tg_get_option('google_map_key').'', array('jquery'), 1.0, false);
		wp_enqueue_script( 'weddingvendor-single-map', get_template_directory_uri() . '/js/single-map.js', array(), null, true);	
			
	}
	wp_enqueue_script('jquery-ui-datepicker');


	// Custom Script JS	
	wp_enqueue_script( 'weddingvendor-custom-script', get_template_directory_uri() . '/js/custom-script.js', array(), null, true );	
	
}
add_action( 'wp_enqueue_scripts', 'weddingvendor_scripts' );
?>