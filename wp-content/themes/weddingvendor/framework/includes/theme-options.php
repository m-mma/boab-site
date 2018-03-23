<?php
	/**
	 * Theme-options.
	 */
	$tg_options = array();
	/**
	 * Theme-options Field.
	 */ 
	$tg_options[] = array(
		'name' => esc_html__( 'Header Setting', 'weddingvendor' ),
		'description' => 'Configure Header Section to customize your to upload your preferred logo, favicon, contact number',
		'type' => 'section'
	);
	$tg_options[] =array(
		'name' => esc_html__( 'Plain Text Logo', 'weddingvendor' ),
		'description' => 'Check this box to enable a plain text logo rather than an image logo. Will use your site title.',				
		'type' => 'checkbox',
		'id' => 'checker',
		'options' => array(	'name' => 'Plain Text Logo' )
	);
	$tg_options[] = array(
		'name' => esc_html__( 'Custom Logo Upload', 'weddingvendor' ),
		'description' => 'Upload a logo for your theme.',		
		'type' => 'logo',
		'id' => 'logo'
	);
	$tg_options[] = array(
		'name' => esc_html__( 'Custom Favicon Upload', 'weddingvendor' ),
		'description' => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon. Use X-Icon Editor to easily create a favicon.",		
		'type' => 'logo',
		'id' => 'favicon'
	);

	$tg_options[] =array(
		'name' => esc_html__( 'Search Box Show/Hide', 'weddingvendor' ),
		'description' => 'Check this box to display Header Search Box',				
		'type' => 'checkbox',
		'id' => 'header_search_btn',
		'class' => 'btn',
		'options' => array(	'name' => 'Display Button' )
	);
	$tg_options[] = array(
		'name' => esc_html__( 'General Settings', 'weddingvendor' ),
		'description' => 'Configure general settings of your currency symbol of pricing and general setting of theme',
		'type' => 'section'
	);
	$tg_options[] = array(
		'name' => esc_html__( 'Currency Symbols', 'weddingvendor' ),
		'type' => 'select',
		'description' => "Currency Symbols for price table",
		'id' => 'currency_symbols',
		'type' => 'text'

	);
	$tg_options[] = array(
		'name' => esc_html__( 'Items Per Page', 'weddingvendor' ),
		'type' => 'select',
		'description' => "How many items display in each page",
		'id' => 'items_per_page',
		'options' => array(
			'3' 	=> esc_html__( '3', 'weddingvendor' ),
			'6' 	=> esc_html__( '6', 'weddingvendor' ),
			'9'   => esc_html__( '9','weddingvendor'),
			'12' => 	 esc_html__( '12','weddingvendor'),
	     )			
	);	

	$tg_options[] = array(
		'name' => esc_html__( 'With Map Column', 'weddingvendor' ),
		'type' => 'select',
		'description' => "How many columns display in one row on map listing",
		'id' => 'listing_map_col',
		'options' => array(
			'2col' 	=> esc_html__( '2 Columns', 'weddingvendor' ),
			'3col' 	=> esc_html__( '3 Columns', 'weddingvendor' ),
	     )			
	);		

	$tg_options[] = array(
		'name' => esc_html__( 'WithMap Style Box', 'weddingvendor' ),
		'type' => 'select',
		'description' => "Display style on map listing",
		'id' => 'listing_map_style',
		'options' => array(
			'3grid' 	=> esc_html__( 'Default', 'weddingvendor' ),
			'bubba' 	=> esc_html__( 'Bubba', 'weddingvendor' ),
			'oscar' 	=> esc_html__( 'Oscar', 'weddingvendor' ),
	     )			
	);	
	
	$tg_options[] = array(
		'name' => esc_html__( 'Free Listing', 'weddingvendor' ),
		'type' => 'select',
		'description' => "How many free listing for each user",
		'id' => 'free_items',
		'options' => array(
			'1' 	=> esc_html__( '1', 'weddingvendor' ),
			'2' 	=> esc_html__( '2', 'weddingvendor' ),
			'3'   => esc_html__( '3','weddingvendor'),
	     )			
	);		


	$tg_options[] = array(
		'name' => esc_html__( 'Validity of free listing', 'weddingvendor' ),
		'type' => 'select',
		'description' => "Select your option for free listing items",
		'id' => 'free_listing_validity',
		'options' => array(
			'30days' 	=> esc_html__( '30 Days', 'weddingvendor' ),
			'1year' 	=> esc_html__( '1 Year', 'weddingvendor' ),
			'lifetime'   => esc_html__( 'Lifetime','weddingvendor'),
	     )			
	);		



	$tg_options[] = array(
		'name' => esc_html__( 'Item Display Style', 'weddingvendor' ),
		'type' => 'select',
		'description' => "Select your item display style",
		'id' => 'items_display_style',
		'options' => array(
			'right' 	=> esc_html__( 'Right Side Inquiry', 'weddingvendor' ),
			'left'   => esc_html__( 'Left Side Inquiry','weddingvendor'),
			'tabbed' => 	 esc_html__( 'Tabbed Listing','weddingvendor'),
	     )			
	);
	
	$tg_options[] = array(
		'name' => esc_html__( 'Home Page Search Template', 'weddingvendor' ),
		'type' => 'select',
		'description' => "Select your template to target for search result",
		'id' => 'home_search_template',
		'options' => array(
			'listing-map' 	=> esc_html__( 'Listing + Map', 'weddingvendor' ),
			'top-map' 	=> esc_html__( 'TopMap + Listing', 'weddingvendor' ),
			'listing-bubba'   => esc_html__( 'Bubba','weddingvendor'),
			'listing-oscar' => 	 esc_html__( 'Oscar','weddingvendor'),
	     )			
	);					
	
	$tg_options[] = array(
		'name' => esc_html__( 'Styling Options', 'weddingvendor' ),
		'description' => 'Configure the visual appearance of your theme, or insert any custom CSS.',
		'type' => 'section'
	);
	$tg_options[] = array(
		'name' => esc_html__( 'Background Color', 'weddingvendor' ),
		'description' => 'Choose the background color of your site',		
		'type' => 'color',
		'id' => 'background_color'
	);

	$tg_options[] = array(
		'name' => esc_html__( 'Top Box Background Color', 'weddingvendor' ),
		'description' => 'Choose the Top Box background color of your section',		
		'type' => 'color',
		'id' => 'header_top_bk_color'
	);	
	$tg_options[] = array(
		'name' => esc_html__( 'Top Box Text Color', 'weddingvendor' ),
		'description' => 'Choose the Top Box text color of your section',		
		'type' => 'color',
		'id' => 'header_top_text_color'
	);	
	$tg_options[] = array(
		'name' => esc_html__( 'Top Box Text Hover Color', 'weddingvendor' ),
		'description' => 'Choose the Top Box text hover color of your section',		
		'type' => 'color',
		'id' => 'header_top_text_hover_color'
	);		
	
	$tg_options[] = array(
		'name' => esc_html__( 'Header Background Color', 'weddingvendor' ),
		'description' => 'Choose the Header background color of your header section',		
		'type' => 'color',
		'id' => 'header_bk_color'
	);

	$tg_options[] = array(
		'name' => esc_html__( 'Menubar Menu Text Color', 'weddingvendor' ),
		'description' => 'Choose menu text color of menubar',		
		'type' => 'color',
		'id' => 'menu_text_color'
	);	

	$tg_options[] = array(
		'name' => esc_html__( 'Menubar Sub Menu Background Color', 'weddingvendor' ),
		'description' => 'Choose sub menu Background color of menubar',		
		'type' => 'color',
		'id' => 'menu_sub_bg_color'
	);	

	$tg_options[] = array(
		'name' => esc_html__( 'Menubar Sub Menu Text Color', 'weddingvendor' ),
		'description' => 'Choose sub menu text color of menubar',		
		'type' => 'color',
		'id' => 'menu_sub_text_color'
	);	

	$tg_options[] = array(
		'name' => esc_html__( 'Menubar Sub Menu Background hover Color', 'weddingvendor' ),
		'description' => 'Choose sub menu Background hover color of menubar',		
		'type' => 'color',
		'id' => 'menu_sub_bg_hover_color'
	);	


	$tg_options[] = array(
		'name' => esc_html__( 'Menubar Sub Menu Text hover Color', 'weddingvendor' ),
		'description' => 'Choose sub menu text hover color of menubar',		
		'type' => 'color',
		'id' => 'menu_sub_text_hover_color'
	);	


	$tg_options[] = array(
		'name' => esc_html__( 'Breadcrumb Text Color', 'weddingvendor' ),
		'description' => 'Choose the Breadcrumb text color your section',		
		'type' => 'color',
		'id' => 'breadcrumb_text_color'
	);	
	
	$tg_options[] = array(
		'name' => esc_html__( 'Breadcrumb Background Color', 'weddingvendor' ),
		'description' => 'Choose the Breadcrumb background color of your section',		
		'type' => 'color',
		'id' => 'breadcrumb_bk_color'
	);	
	$tg_options[] = array(
		'name' => esc_html__( 'Breadcrumb Background Image', 'weddingvendor' ),
		'description' => 'Choose the Breadcrumb background image of your section',		
		'type' => 'logo',
		'id' => 'breadcrumb_bk_image'
	);	

	
	
	$tg_options[] = array(
		'name' => esc_html__( 'Footer Background Color', 'weddingvendor' ),
		'description' => 'Choose the background color of footer',		
		'type' => 'color',
		'id' => 'footer_bk_color'
	);	
	$tg_options[] = array(
		'name' => esc_html__( 'Footer Heading Color', 'weddingvendor' ),
		'description' => 'Choose the heading color of footer',		
		'type' => 'color',
		'id' => 'footer_heading_color'
	);	
	$tg_options[] = array(
		'name' => esc_html__( 'Footer Text Color', 'weddingvendor' ),
		'description' => 'Choose the text color of footer',		
		'type' => 'color',
		'id' => 'footer_text_color'
	);	
	$tg_options[] = array(
		'name' => esc_html__( 'Footer accent Color', 'weddingvendor' ),
		'description' => 'Choose the accent color of footer',		
		'type' => 'color',
		'id' => 'footer_accent_color'
	);		
	$tg_options[] = array(
		'name' => esc_html__( 'Footer accent hover Color', 'weddingvendor' ),
		'description' => 'Choose the accent hover color of footer',		
		'type' => 'color',
		'id' => 'footer_accent_hover_color'
	);		
	$tg_options[] = array(
		'name' => esc_html__( 'Accent Color', 'weddingvendor' ),
		'description' => 'Choose the accent color of your site',
		'type' => 'color',
		'id' => 'accent_color'
	);
	$tg_options[] = array(
		'name' => esc_html__( 'Accent Hover Color', 'weddingvendor' ),
		'description' => 'Choose the accent hover color of your site',
		'type' => 'color',
		'id' => 'accent_hover_color'
	);
	$tg_options[] = array(
		'name' => esc_html__( 'Tiny Footer background Color', 'weddingvendor' ),
		'description' => 'Choose tiny footer Background color of your site',
		'type' => 'color',
		'id' => 'tiny_footer_bk_color'
	);

	$tg_options[] = array(
		'name' => esc_html__( 'Tiny Footer Text Color', 'weddingvendor' ),
		'description' => 'Choose tiny footer text color of your site',
		'type' => 'color',
		'id' => 'tiny_footer_text_color'
	);
	
	

	$tg_options[] = array(
		'name' => esc_html__( 'Primary Button Background Color', 'weddingvendor' ),
		'description' => 'Choose the Primary Button Background color of your site',
		'type' => 'color',
		'id' => 'primary_btn_bg_color'
	);

	$tg_options[] = array(
		'name' => esc_html__( 'Primary Button Text Color', 'weddingvendor' ),
		'description' => 'Choose the Primary Button Text color of your site',
		'type' => 'color',
		'id' => 'primary_btn_color'
	);

	$tg_options[] = array(
		'name' => esc_html__( 'Hover Primary Button Background Color', 'weddingvendor' ),
		'description' => 'Choose the Hover Primary Button Background color of your site',
		'type' => 'color',
		'id' => 'primary_btn_hover_bg_color'
	);

	$tg_options[] = array(
		'name' => esc_html__( 'Hover Primary Button Text Color', 'weddingvendor' ),
		'description' => 'Choose the Hover Primary Button Text color of your site',
		'type' => 'color',
		'id' => 'primary_btn_hover_color'
	);


	$tg_options[] = array(
		'name' => esc_html__( 'Secondary Button Background Color', 'weddingvendor' ),
		'description' => 'Choose the Secondary Button Background color of your site',
		'type' => 'color',
		'id' => 'second_btn_bg_color'
	);

	$tg_options[] = array(
		'name' => esc_html__( 'Secondary Button Text Color', 'weddingvendor' ),
		'description' => 'Choose the Secondary Button Text color of your site',
		'type' => 'color',
		'id' => 'second_btn_color'
	);

	$tg_options[] = array(
		'name' => esc_html__( 'Hover Secondary Button Background Color', 'weddingvendor' ),
		'description' => 'Choose the Hover Secondary Button Background color of your site',
		'type' => 'color',
		'id' => 'second_btn_hover_bg_color'
	);

	$tg_options[] = array(
		'name' => esc_html__( 'Hover Secondary Button Text Color', 'weddingvendor' ),
		'description' => 'Choose the Hover Secondary Button Text color of your site',
		'type' => 'color',
		'id' => 'second_btn_hover_color'
	);



	$tg_options[] = array(
		'name' => esc_html__( 'Custom CSS', 'weddingvendor' ),
		'type' => 'textarea',
		'description' => 'Add custom CSS to here that affect in front',
		'id' => 'custome_css'
	);
	$tg_options[] = array(
		'name' => esc_html__( 'Typography', 'weddingvendor' ),
		'description' => 'Theme font typography',
		'type' => 'section'
	);
	$tg_options[] = array(
		'name' => esc_html__( 'Body Font', 'weddingvendor' ),
		'type' => 'select',
		'description' => "Quickly add a custom Google Font for body from Google Font Directory. Example font name: 
						 'Source Sans Pro', for including font weights type Source Sans Pro:300",
		'id' => 'google_font',
		'options' => array(		
			'Istok+Web:400,400italic,700,700italic' 	=> esc_html__( 'Istok+Web', 'weddingvendor' ),
			'Montserrat:400,700' 						=> esc_html__( 'Montserrat', 'weddingvendor' ),
			'Raleway:400,700'  							=> esc_html__( 'Raleway','weddingvendor'),
			'Roboto:400,700' 							=>  esc_html__( 'Roboto','weddingvendor'),
			'Open+Sans:400,700'							=> esc_html__('Open+Sans','weddingvendor')
	     )	
	);

	$tg_options[] = array(
		'name' => esc_html__( 'Heading Font', 'weddingvendor' ),
		'type' => 'select',
		'description' => "Quickly add a custom Google Font for Heading like h1,h2,h3.... from Google Font Directory. Example font name: 
						 'Source Sans Pro', for including font weights type Source Sans Pro:300",
		'id' => 'google_heading_font',
		'options' => array(
			'Montserrat:400,700' 						=> esc_html__( 'Montserrat', 'weddingvendor' ),
			'Istok+Web:400,400italic,700,700italic' 	=> esc_html__( 'Istok+Web', 'weddingvendor' ),
			'Raleway:400,700'   						=> esc_html__( 'Raleway','weddingvendor'),
			'Roboto:400,700' 							=>  esc_html__( 'Roboto','weddingvendor'),
			'Open+Sans:400,700' 						=> esc_html__( 'Open+Sans','weddingvendor')
	     )	
	);
	
	$tg_options[] = array(
		'name' 			=> esc_html__( 'H1 Headings', 'weddingvendor' ),
		'description' 	=> 'Choose Size and Style for h1 (This Styles Your Page Titles)',
		'type' 			=> 'typography',
		'id_1' 			=> 'font-size-h1',
		'label_1' 		=> 'Font Size',
		'id_2' 			=> 'font-weight-h1',
		'label_2' 		=> 'Font Weight',	
		'id_3' 			=> 'font-color-h1',
		'label_3' 		=> 'Font Color',		
	); 	
	$tg_options[] = array(
		'name' 			=> esc_html__( 'H2 Headings', 'weddingvendor' ),
		'description' 	=> 'Choose Size and Style for h2 (This Styles Your Page Titles)',
		'type' 			=> 'typography',
		'id_1' 			=> 'font-size-h2',
		'label_1' 		=> 'Font Size',
		'id_2' 			=> 'font-weight-h2',
		'label_2' 		=> 'Font Weight',	
		'id_3' 			=> 'font-color-h2',
		'label_3' 		=> 'Font Color',
	); 	
	$tg_options[] = array(
		'name' 			=> esc_html__( 'H3 Headings', 'weddingvendor' ),
		'description' 	=> 'Choose Size and Style for h3 (This Styles Your Page Titles)',
		'type' 			=> 'typography',
		'id_1' 			=> 'font-size-h3',
		'label_1' 		=> 'Font Size',
		'id_2' 			=> 'font-weight-h3',
		'label_2' 		=> 'Font Weight',	
		'id_3' 			=> 'font-color-h3',
		'label_3' 		=> 'Font Color',
	); 	
	$tg_options[] = array(
		'name' 			=> esc_html__( 'H4 Headings', 'weddingvendor' ),
		'description' 	=> 'Choose Size and Style for h3 (This Styles Your Page Titles)',
		'type' 			=> 'typography',
		'id_1' 			=> 'font-size-h4',
		'label_1' 		=> 'Font Size',
		'id_2' 			=> 'font-weight-h4',
		'label_2' 		=> 'Font Weight',	
		'id_3' 			=> 'font-color-h4',
		'label_3' 		=> 'Font Color',
	); 	
	$tg_options[] = array(
		'name' 			=> esc_html__( 'P Headings', 'weddingvendor' ),
		'description' 	=> 'Choose Size and Style for P (This Styles Your Page Titles)',
		'type' 			=> 'typography',
		'id_1' 			=> 'font-size-p',
		'label_1' 		=> 'Font Size',
		'id_2' 			=> 'font-weight-p',
		'label_2' 		=> 'Font Weight',	
		'id_3' 			=> 'font-color-p',
		'label_3' 		=> 'Font Color',
	); 	
	$tg_options[] = array(
		'name' 			=> esc_html__( 'Slider Setting', 'weddingvendor' ),
		'description' 	=> 'Slieder option customization.',
		'type' 			=> 'section'
	);
	$tg_options[] = array(
		'name' 			=> esc_html__( 'Slider Effect', 'weddingvendor' ),
		'type' 			=> 'select',
		'description' 	=> "Select your slider effect",
		'id' 			=> 'slider_effect',
		'options' 		=> array(
					'fade' 	=> esc_html__( 'fade', 'weddingvendor'),
					'slide' => esc_html__( 'slide', 'weddingvendor')			
	     )			
	);		
	$tg_options[] = array(
		'name' 			=> esc_html__( 'Animation Speed', 'weddingvendor' ),
		'description' 	=> 'Animation Speed of slider',		
		'id' 			=> 'animatespeed',
		'type' 			=> 'text'		
	);			
	$tg_options[] =array(
		'name' 			=> esc_html__( 'Pagination Speed', 'weddingvendor' ),
		'description' 	=> 'Pagination Speed of slider',				
		'id' 			=> 'paginationspeed',
		'type' 			=> 'text'
	);
	$tg_options[] =array(
		'name' 			=> esc_html__( 'Control Nav', 'weddingvendor' ),
		'description' 	=> 'Control pagination arrow',				
		'id' 			=> 'control_nav',
		'type' 			=> 'checkbox',
		'class' 		=> 'directionNav',
		'options' 		=> array(	'name' => 'direction' )
	);
	$tg_options[] = array(
		'name' 			=> esc_html__( 'Slider Heading Title Color', 'weddingvendor' ),
		'description' 	=> 'Select Slider Heading Title Color',		
		'type' 			=> 'color',
		'id' 			=> 'slider_title_color'
	);	
	$tg_options[] = array(
		'name' 			=> esc_html__( 'Slider Text Color', 'weddingvendor' ),
		'description' 	=> 'Slider Text Color',		
		'type' 			=> 'color',
		'id' 			=> 'slider_text_color'
	);		
	$tg_options[] = array(
		'name'			=> esc_html__( 'Pagination Color', 'weddingvendor' ),
		'description' 	=> 'Select slider pagination circle',		
		'type' 			=> 'color',
		'id' 			=> 'slider_pagination'
	);			
	$tg_options[] = array(
		'name' 			=> esc_html__( 'Pagination Active Color', 'weddingvendor' ),
		'description' 	=> 'Select slider arrow active color',		
		'type' 			=> 'color',
		'id' 			=> 'slider_pagination_hover'
	);		
		

	$tg_options[] = array(
		'name' => esc_html__( 'Google Map Setting', 'weddingvendor' ),
		'description' => 'Configure goole map settings of marker,defualt latitude and logitude',
		'type' => 'section'
	);

	$tg_options[] = array(
		'name' => esc_html__( 'Google Map API key', 'weddingvendor' ),
		'description' => 'Add Here Google Map API key',		
		'type' => 'text',
		'id' => 'google_map_key'
	);	
	$tg_options[] = array(
		'name' => esc_html__( 'Default center latitude', 'weddingvendor' ),
		'description' => 'Add Here Center Latitude',		
		'id' => 'center_latitude',
		'type' => 'text'		
	);
	$tg_options[] = array(
		'name' => esc_html__( 'Default center longitude', 'weddingvendor' ),
		'description' => 'Add Here Center Longitude',		
		'id' => 'center_longitude',
		'type' => 'text'		
	);			

	$tg_options[] = array(
		'name' => esc_html__( 'Default Marker', 'weddingvendor' ),
		'description' => 'Upload a default marker icon',		
		'type' => 'logo',
		'id' => 'default_marker'
	);
	
	$tg_options[] = array(
		'name' => esc_html__( 'Payment Setting', 'weddingvendor' ),
		'description' => 'Configure payment api details and setting',
		'type' => 'section'
	);

	$tg_options[] = array(
		'name' => esc_html__( 'Paypal Api User name', 'weddingvendor' ),
		'description' => 'Add Here paypal api user',		
		'type' => 'text',
		'id' => 'payment_paypal_api_username'
	);	
	$tg_options[] = array(
		'name' => esc_html__( 'Paypal Api User Password', 'weddingvendor' ),
		'description' => 'Add Here Paypal Api User Password',		
		'id' => 'payment_paypal_api_password',
		'type' => 'text'		
	);
	$tg_options[] = array(
		'name' => esc_html__( 'Paypal Api Signature', 'weddingvendor' ),
		'description' => 'Add here paypal api signature',		
		'id' => 'payment_paypal_api_signature',
		'type' => 'text'		
	);			

	$tg_options[] = array(
		'name' => esc_html__( 'Paypal Currency Code', 'weddingvendor' ),
		'description' => 'Select paypal api currency code',		
		'id' => 'payment_paypal_api_currency_code',
		'type' => 'select',
		'options' => array(
			'AUD' => __( 'Australian Dollars (A $)', 'weddingvendor' ),
			'BRL' => __( 'Brazilian Real','weddingvendor'),
			'CAD' => __( 'Canadian Dollars (C $)','weddingvendor'),
			'CZK' => __('Czech Koruna','weddingvendor'),
			'DKK' => __('Danish Krone','weddingvendor'),
			'EUR' => __('Euros (&euro;)','weddingvendor'),
			'HKD' => __('Hong Kong Dollar ($)','weddingvendor'),
			'HUF' => __('Hungarian Forint','weddingvendor'),
			'ILS' => __('Israeli New Shekel','weddingvendor'),
			'JPY' => __('Yen (&yen;)','weddingvendor'),
			'MYR' => __('Malaysian Ringgit','weddingvendor'),
			'MXN' => __('Mexican Peso','weddingvendor'),
			'NOK' => __('Norwegian Krone','weddingvendor'),
			'NZD' => __('New Zealand Dollar ($)','weddingvendor'),
			'PHP' => __('Philippine Peso','weddingvendor'),
			'PLN' => __('Polish Zloty','weddingvendor'),
			'GBP' => __('Pounds Sterling (&pound;)','weddingvendor'),
			'RUB' => __('Russian Ruble','weddingvendor'),
			'SGD' => __('Singapore Dollar ($)','weddingvendor'),
			'SEK' => __('Swedish Krona','weddingvendor'),
			'CHF' => __('Swiss Franc','weddingvendor'),
			'TWD' => __('Taiwan New Dollar','weddingvendor'),
			'THB' => __('Thai Baht','weddingvendor'),
			'TRY' => __('Turkish Lira','weddingvendor'),
			'USD' => __('U.S. Dollars ($)','weddingvendor')																	
	     )		
	);			

	$tg_options[] = array(
		'name' => esc_html__( 'Paypal Mode(Sandbox or Live)', 'weddingvendor' ),
		'description' => 'Set paypal eable sandbox ',		
		'id' => 'payment_paypal_api_mode',
		'type' => 'checkbox',
		'options' => array(	'name' => 'Enable Sandbox' )	
	);			
	
	
	if ( function_exists( 'tg_plugin_get_html_import' ) )
	{
		$tg_options[] = array(
			'name' => esc_html__( 'Import Data', 'weddingvendor' ),
			'description' => tg_plugin_get_html_import(),
			'type' => 'section'
		);	
	}
?>