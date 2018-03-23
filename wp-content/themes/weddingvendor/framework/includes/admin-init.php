<?php
	/*-----------------------------------------------------------*
	/* 			DEFAULT THEME OPTIONS
	/*-----------------------------------------------------------*/
	add_action( 'after_setup_theme', 'tg_default_options' );
	
	function tg_default_options() {
		$options = array(
			'logo'     							=> get_template_directory_uri().'/images/logo.png',
			'favicon'  							=> get_template_directory_uri().'/images/favicon.ico',
			'header_search_btn'					=> 'searchboxshowhide',	
			'items_display_style'				=> 'right',
			'home_search_template'				=> 'listing-map',			
			'background_color'  				=> '#faf9f5',
			'accent_color' 						=> '#00aeaf',
			'accent_hover_color' 				=> '#f9a630',				
			'google_font'						=> 'Istok+Web:400,400italic,700,700italic',
			'google_heading_font'				=> 'Montserrat:400,700',
			'custome_css' 						=> '',
			'font-size-h1'  					=> '30',
			'font-weight-h1' 					=> '400',
			'font-color-h1' 					=> '#3c3634',
			'font-size-h2'  					=> '22',
			'font-weight-h2' 					=> '400',
			'font-color-h2' 					=> '#323634',
			'font-size-h3'  					=> '18',
			'font-weight-h3' 					=> '400',
			'font-color-h3' 					=> '#323634',
			'font-size-h4'  					=> '16',
			'font-weight-h4' 					=> '400',
			'font-color-h4' 					=> '#323634',			
			'font-size-p'  						=> '16',
			'font-weight-p' 					=> '400',
			'font-color-p' 						=> '#706a68',
			'header_top_bk_color'  				=> '#00797A',
			'header_top_text_color'  			=> '#25c7c8',
			'header_top_text_hover_color'		=> '#ffffff',
			'header_bk_color'   				=> '#00aeaf',
			'menu_text_color'					=> '#faf9f5',
			'menu_sub_bg_color'					=> '#faf9f5',					
			'menu_sub_text_color'				=> '#3c3634',
			'menu_sub_bg_hover_color'			=> '#ffffff',
			'menu_sub_text_hover_color'			=> '#00aeaf',			
			'breadcrumb_text_color'				=> '#ffffff',
			'breadcrumb_bk_color'				=> '#0BC4C4',
			'breadcrumb_bk_image'				=> get_template_directory_uri().'/images/page-header-img.jpg',
			'footer_bk_color'					=> '#322e2c',
			'footer_heading_color'				=> '#fff',	
			'footer_accent_color'       		=> '#706a68',			
			'footer_accent_hover_color' 		=> '#f9a630',			
			'footer_text_color'					=> '#706a68',
			'tiny_footer_bk_color'      		=> '#292624',
			'tiny_footer_text_color'    		=> '#403d3b',
			'currency_symbols'					=> '&#36;',
			'items_per_page'					=> '6',
			'listing_map_col'					=> '3col',	
			'listing_map_style'					=> '3grid',					
			'free_items'						=> '2',			
			'free_listing_validity'				=> '30days',			
			'items_display_style'				=> 'right',
			'animatespeed'						=> '7000',
			'paginationspeed'					=> '1000',
			'control_nav'						=> 'controlnav',
			'slider_title_color'        		=> '#ffffff',
			'slider_text_color'         		=> '#ffffff',			
			'slider_pagination'					=> '#f9a630',
			'slider_pagination_hover'			=> '#00aeaf',			
			'slider_effect'						=> 'fade',
			'primary_btn_bg_color'				=> '#04d7d8',
			'primary_btn_color'					=> '#ffffff',
			'primary_btn_hover_bg_color'		=> '#04cccd',
			'primary_btn_hover_color'			=> '#ffffff',	
			'second_btn_bg_color'				=> '#f9a630',
			'second_btn_color'					=> '#ffffff',
			'second_btn_hover_bg_color' 		=> '#ffb751',
			'second_btn_hover_color'			=> '#ffffff',	
			'google_map_key'					=> '',											 
			'center_latitude'					=> '21.95',	
			'center_longitude'					=> '72.215',							
			'default_marker'					=> get_template_directory_uri().'/images/marker.png',	
			'payment_paypal_api_currency_code' 	=> 'USD',
			'payment_paypal_api_mode' 			=> 'paypalmodesandboxorlive',		
			'payment_paypal_api_username' 		=> '',		
			'payment_paypal_api_password' 		=> '',		
			'payment_paypal_api_signature' 		=> ''																		
	    );
	    return $options;				
	}

	/*-----------------------------------------------------------*
	/* 			THEME OPTION PAGE
	/*-----------------------------------------------------------*/

	add_action( 'admin_init', 'tg_add_options' );
	function tg_add_options() {
		// Register new options
		register_setting( 'tg_options', 'tg_options', 'tg_options_validate' );
	}

	/*-----------------------------------------------------------*
	/* 			THEME OPTION ADMIN IN MENU
	/*-----------------------------------------------------------*/

	add_action( 'admin_menu', 'tg_add_page' );
	function tg_add_page() {
		$tg_options_page = add_theme_page( 'Theme Options', 'Theme Options', 'manage_options', 'options_page', 'tg_options_page' );
		add_action( 'admin_print_scripts-' . $tg_options_page, 'tg_print_scripts' );
	}
	
	function tg_get_option($key)
	{
		$arr=get_option( 'tg_options' );
		if( isset( $arr[$key])) {
			return $arr[$key];
		}
	}
	
	function tg_print_scripts() {
		wp_enqueue_style('thickbox'); // Stylesheet used by Thickbox
		wp_enqueue_script('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thege-upload', get_template_directory_uri().'/framework/js/thege-upload.js', array( 'thickbox', 'media-upload' ) );
		wp_enqueue_script('bootstrap', get_template_directory_uri().'/framework/js/bootstrap.js');	

		wp_enqueue_style('bootstrap', get_template_directory_uri().'/framework/css/bootstrap.css');
		wp_enqueue_style('bootstrap.vertical-tabs', get_template_directory_uri().'/framework/css/bootstrap.vertical-tabs.css');		
	}	
	add_action( 'admin_enqueue_scripts', 'tg_enqueue_color_picker' );
	
	function tg_enqueue_color_picker( ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'framework-custom-js', get_template_directory_uri().'/framework/js/custom.js', array('wp-color-picker'),true);
	}

	add_action( 'wp_head', 'tg_action_head_hook' );
	function tg_action_head_hook() {
		
		// background color  
		$background_color 				= tg_get_option('background_color');		
		$accent_color 					= tg_get_option('accent_color');
		$accent_hover_color 			= tg_get_option('accent_hover_color');
		 
		//Topbar
		$top_h_bk 						= tg_get_option('header_top_bk_color');		 
		$header_top_text_color 			= tg_get_option('header_top_text_color');
		$header_top_text_hover_color 	= tg_get_option('header_top_text_hover_color');

		//Header 
		$h_bk 							= tg_get_option('header_bk_color');		
		$menu_text 						= tg_get_option('menu_text_color');		
		$menu_sub_bg_color 				= tg_get_option('menu_sub_bg_color');
		$menu_sub_text_color 			= tg_get_option('menu_sub_text_color');
		$menu_sub_text_hover_color 		= tg_get_option('menu_sub_text_hover_color');
		$menu_sub_bg_hover_color 		= tg_get_option('menu_sub_bg_hover_color');		
				
		// Breadcrumb 
		$breadcrumb_bk_color 			= tg_get_option('breadcrumb_bk_color');
		$breadcrumb_bk_image 			= tg_get_option('breadcrumb_bk_image');
		$breadcrumb_text_color 			= tg_get_option('breadcrumb_text_color');	
		
		//Footer 
		$footer_bk 						= tg_get_option('footer_bk_color');	
		$footer_heading_color 			= tg_get_option('footer_heading_color');	
		$footer_text 					= tg_get_option('footer_text_color');	
		$footer_accent 					= tg_get_option('footer_accent_color');			 
		$footer_accent_hover_color 		= tg_get_option('footer_accent_hover_color');
		
		$tiny_footer_bk 				= tg_get_option('tiny_footer_bk_color');	
		$tiny_footer_text 				= tg_get_option('tiny_footer_text_color');
		
		//Primary Button
		$primary_btn_bg_color 			= tg_get_option('primary_btn_bg_color');
		$primary_btn_color 				= tg_get_option('primary_btn_color');		 
		$hover_primary_btn_bg_color 	= tg_get_option('primary_btn_hover_bg_color');
		$hover_primary_btn_color 		= tg_get_option('primary_btn_hover_color');	
		
		//Secondary Button
		$second_btn_bg_color 			= tg_get_option('second_btn_bg_color');
		$second_btn_color 				= tg_get_option('second_btn_color');		 
		$hover_second_btn_bg_color 		= tg_get_option('second_btn_hover_bg_color');
		$hover_second_btn_color 		= tg_get_option('second_btn_hover_color');			 	 		 		 		 
		
		//Slider Option		 
		$slider_text_color 				= tg_get_option('slider_text_color');
		$slider_title_color 			= tg_get_option('slider_title_color');

		$slider_pagination 				= tg_get_option('slider_pagination');
		$slider_pagination_hover 		= tg_get_option('slider_pagination_hover');	
		
		$slider_effect 					= tg_get_option('slider_effect');		 		 
		$control_nav 					= tg_get_option('control_nav');
		
		$custome_css 					= tg_get_option('custome_css');

		 /*  favicon upload */
		 $style = '';
		 $favicon = tg_get_option('favicon');
		 
		 if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
			 if( $favicon != '' ) {
				$style .= '<link rel="icon" type="image/png" href="'. esc_url( $favicon ) .'" > ' . "\n";		 
			 } else {
				$style .= '<link rel="icon" type="image/png" href="'.get_template_directory_uri().'/image/favicon.ico">'."\n";
			 } 	 
		 }
		 
		 /* google font [ font-family ] */
		 $google_font = tg_get_option('google_font');		 
		 $google_font_family = "";
		 $google_font_family = isset($google_font)?$google_font:'';

		 if( $google_font_family != '') {
			 $style .= '<link href="http://fonts.googleapis.com/css?family='.$google_font_family.'" rel="stylesheet" type="text/css">'. "\n";
		 }else {
			 $style .= '<link href="http://fonts.googleapis.com/css?family=Istok+Web:400,400italic,700,700italic" rel="stylesheet" type="text/css">'. "\n";
		 }
		 

		$google_font_explode = "";
		$font_family_google = explode( ':', $google_font_family );
		$google_font_explode = isset($font_family_google)?$font_family_google:'';

		$font_family = isset($google_font_explode[0])?$google_font_explode[0]:'';
		$font_weight = isset($google_font_explode[1])?$google_font_explode[1]:'';
		
		$font_family = str_replace("+"," ",$font_family);


		 /* google heading font [ font-family ] */
		 $google_heading_font = tg_get_option('google_heading_font');		 
		 $google_heading_font_family = "";
		 $google_heading_font_family = isset($google_heading_font)?$google_heading_font:'';

		 if( $google_font_family != '') {
			 $style .= '<link href="http://fonts.googleapis.com/css?family='.$google_heading_font_family.'" rel="stylesheet" type="text/css">';
		 }else {
			 $style .= '<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">';
		 }
		 
		$style .= '<style type="text/css">';
		$style .= 'html body { background-color: '.$background_color.'; font-family: '.$font_family.' !important; font-weight : '.$font_weight.';  } ' . "\n";


		$google_heading_font_explode = "";
		$font_heading_family_google = explode( ':', $google_heading_font_family );
		$google_heading_font_explode = isset($font_heading_family_google)?$font_heading_family_google:'';

		$font_heading_family = isset($google_heading_font_explode[0])?$google_heading_font_explode[0]:'';
		$font_heading_weight = isset($google_heading_font_explode[1])?$google_heading_font_explode[1]:'';
		
		$font_heading_family = str_replace("+"," ",$font_heading_family);

		$style .= '<style type="text/css" >';
		$style .= 'html body { background-color: '.$background_color.'; font-family: '.$font_family.' !important; font-weight : '.$font_weight.';  } ' . "\n";		
		
		$style .= 'h1,h2,h3,h4,h5,h6{ font-family	: '.$font_heading_family.';}';

		 /*   font h1,h2,h3,h4 typogrphy  */
		$style .= 'h1 { font-size 	: '.tg_get_option('font-size-h1').'px;
					 font-weight	: '.tg_get_option('font-weight-h1').';
					 color			: '.tg_get_option('font-color-h1').';
				}';
		$style .= 'h2 { font-size 	: '.tg_get_option('font-size-h2').'px;
					 font-weight	: '.tg_get_option('font-weight-h2').';
					 color			: '.tg_get_option('font-color-h2').';		
				}';		
		$style .= 'h3 { font-size 	: '.tg_get_option('font-size-h3').'px;
					 font-weight	: '.tg_get_option('font-weight-h3').';
					 color			: '.tg_get_option('font-color-h3').';
				}';		
		$style .= 'h4 { font-size 	: '.tg_get_option('font-size-h4').'px;
				 font-weight	: '.tg_get_option('font-weight-h4').';
				 color			: '.tg_get_option('font-color-h4').';
			}';					
		$style .= 'p { font-size 	: '.tg_get_option('font-size-p').'px;
					 font-family	: '.$font_family.';		 
					 font-weight	: '.tg_get_option('font-weight-p').';
					 color			: '.tg_get_option('font-color-p').';
				}';
		
		if(tg_get_option('main_layout')=="boxed")
		{
			$style .= 'body { background-color:#e6e6e1; } ' . "\n";		
		}
		
		$style .= 'a { color:'.$accent_color.'; text-decoration: none; } ' . "\n";
		$style .= 'a:hover { color:'.$accent_hover_color.';   text-decoration: none; } ' . "\n";	
		$style .= '.top-bar { background-color:'.$top_h_bk.';} ' . "\n";	
		$style .= '.tp-nav,.tp-nav .navbar-default { background-color:'.$h_bk.';border-color:'.$h_bk.';} ' . "\n";	
		
		$style .= '.top-message p { color:'.$header_top_text_color.';} ' . "\n";		 
	
		$style .= '.top-links li a { color:'.$header_top_text_color.';} ' . "\n";
		
		$style .= '.top-links li a:hover { color:'.$header_top_text_hover_color.';} ' . "\n";		
	
		
	
		$style .='.tp-nav .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover,#cssmenu > ul > li > a{background-color: transparent;	color:'.$menu_text.';}';
		
		$style .='#cssmenu ul ul li a{
		background: '.$menu_sub_bg_color.';	color: '.$menu_sub_text_color.';}';
		
	
		$style .='.tp-nav .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover,#cssmenu ul ul li:hover > a, #cssmenu ul ul li a:hover { color: '.$menu_sub_text_hover_color.' !important;background-color: '.$menu_sub_bg_hover_color.'; }';
		$style .='.tp-nav .navbar-default .navbar-nav>li>a { color: '.$menu_text.';}';
		
		$style .='.tp-nav .navbar-right .dropdown-menu { background-color: '.$menu_sub_bg_color.';}';
		
		$style .='.tp-nav .dropdown-menu>.active>a, .tp-navigation .dropdown-menu>.active>a:focus, .tp-navigation .dropdown-menu>.active>a:hover { background-color: '.$menu_sub_bg_color.';}';
		
		$style .='#cssmenu ul ul li.has-sub > a:before,#cssmenu ul ul li.has-sub > a:after {background:'.$menu_sub_text_color.';}';

		$style .='.top-nav-collapse {background:'.$h_bk.';}';


		
		
		$style .= '.tp-btn-default{ color:'.$primary_btn_color.';background-color:'.$primary_btn_bg_color.'; }' ."\n";	
		$style .= '.tp-btn-default:hover { color:'.$hover_primary_btn_color.';background-color:'.$hover_primary_btn_bg_color.'; }' ."\n";	

		$style .= '.tp-btn-primary{ color:'.$second_btn_color.';background-color:'.$second_btn_bg_color.'; }' ."\n";	
		$style .= '.tp-btn-primary:hover { color:'.$hover_second_btn_color.';background-color:'.$hover_second_btn_bg_color.'; }' ."\n";	
				
		$style .= '.footer { background-color:'.$footer_bk.';  }' ."\n";
		$style .= '.footer h2 { color:'.$footer_heading_color.';  }' ."\n";
		$style .= '.footer p { color:'.$footer_text.';  }' ."\n";
		$style .= '.footer .ft-link ul li a,.social-icon ul li a { color:'.$footer_accent.';  }' ."\n";	
		$style .= '.footer .ft-link ul li a:hover,.social-icon ul li a:hover { color:'.$footer_accent_hover_color.';  }' ."\n";	

		if(!empty($breadcrumb_bk_image))
		{
		$style .= '.tp-page-head{background:url("'.$breadcrumb_bk_image.'");background-position: center; -webkit-background-size: cover; -moz-background-size: cover; background-size: cover; -o-background-size: cover;  }' ."\n";
		}
		else{
		$style .= '.tp-page-head{ background-color:'.$breadcrumb_bk_color.';}' ."\n";

		}
				
		$style .= '.tp-page-head .page-header h1{ color:'.$breadcrumb_text_color.';}' ."\n";		


		$breadcrumb_bk_image = tg_get_option('breadcrumb_bk_image');
		
		if( $breadcrumb_bk_image != '' ) {
			$style .= '.tp-page-header{ background-image:url("'. esc_url( $breadcrumb_bk_image ) .'");} ' . "\n";		 
		} 	

		if( $control_nav == '' ) {
			$style .= '#slider .owl-pagination{ display:none;} ' . "\n";		 
		} 					
		
		$style .= '.tiny-footer { background-color:'.$tiny_footer_bk.';color:'.$tiny_footer_text.';  }' ."\n";
		$style .= '.tiny-footer p { color:'.$tiny_footer_text.';  }' ."\n";
		
		$style .= '.caption h1{ color:'.$slider_title_color.';  }' ."\n";
		$style .= '.caption p{ color:'.$slider_text_color.';  }' ."\n";		
		
		
		$style .= '.owl-theme .owl-dots .owl-dot span{ background:'.$slider_pagination.';}'. "\n";

		$style .= '.owl-theme .owl-dots .owl-dot.active span,.owl-theme .owl-dots .owl-dot:hover span { background-color:'.$slider_pagination_hover.'; }'. "\n";
		
		
		$style .= '.tp-footer .ft-links ul li a:hover,.tp-tiny-footer .tp-social-icon ul li a:hover,.tp-tiny-footer .tp-social-icon ul li a:active { color:'.$footer_accent_hover_color.';  }' ."\n";			
		
		$style .= $custome_css . "\n";
		
		$style .= '</style>';
		echo $style;	 
	}

	function tg_enqueue_inline_script( $handle, $js, $deps = array(), $in_footer = false ){
		// Callback for printing inline script.
		$cb = function()use( $handle, $js ){
			// Ensure script is only included once.
			if( wp_script_is( $handle, 'done' ) )
				return;
	
		   // Print script & mark it as included.
			$speed 					=  tg_get_option('animatespeed');
			$paginationSpeed  		=  tg_get_option('paginationSpeed');
			$control_nav 			=  tg_get_option('control_nav');
			$slider_effect 			=  tg_get_option('slider_effect');			
	
			if( $control_nav != '' ) {
				$control_nav_check = 'true';
			}else {
				$control_nav_check = 'false';
			}
	
	
			if($slider_effect=="fade")
			{
				$slider_effect_call= "animateIn : 'fadeIn',animateOut : 'fadeOut',";
			}
			else{
				$slider_effect_call= "";
			}		
	
			if( is_rtl() ) {
				$rtl_check = 'true';
			}else {
				$rtl_check = 'false';
			}			

			echo "<script type=\"text/javascript\">
					var $ = jQuery.noConflict();
					if($('.owl-theme').hasClass('main-slider'))
					{
						$(document).ready(function() {
						  $('.main-slider').owlCarousel({
								rtl:".$rtl_check.",	
								loop:true,
								dots : ".$control_nav_check.", 
								autoplayTimeout:'".esc_js($speed)."',
								responsive:{
								0:{
									items:1
								},
								600:{
									items:1
								},
								1000:{
									items:1
								}
								},	
								addClassActive: true,
								autoplay:true,	
								$slider_effect_call	
							  });
						});
					}		
				  </script>\n";
			
				  
			global $wp_scripts;
			$wp_scripts->done[] = $handle;
		};
		// (`wp_print_scripts` is called in header and footer, but $cb has re-inclusion protection.)
		$hook = $in_footer ? 'wp_print_footer_scripts' : 'wp_print_scripts';
	
		// If no dependencies, simply hook into header or footer.
		if( empty($deps)){
			add_action( $hook, $cb );
			return;
		}
	
		// Delay printing script until all dependencies have been included.
		$cb_maybe = function()use( $deps, $in_footer, $cb, &$cb_maybe ){
			foreach( $deps as &$dep ){
				if( !wp_script_is( $dep, 'done' ) ){
					// Dependencies not included in head, try again in footer.
					if( ! $in_footer ){
						add_action( 'wp_print_footer_scripts', $cb_maybe, 11 );
					}
					else{
						// Dependencies were not included in `wp_head` or `wp_footer`.
					}
					return;
				}
			}
			call_user_func( $cb );
		};
		add_action( $hook, $cb_maybe, 0 );
	}

	// Usage
	tg_enqueue_inline_script('slider','',array( 'jquery'));	

	/*-----------------------------------------------------------*
	/* 			THEME OPTION PAGE
	/*-----------------------------------------------------------*/
	
	function tg_options_page() {
	global $tg_options;
	?>
	<div class='wrap'>
	  <div class="container-fluid">
	   <?php settings_errors( 'tg_framework' ); ?>
	    <div class="page-header">
	      <h1><?php esc_html_e('Theme Options','weddingvendor'); ?></h1>
	    </div>
	    <div class="row to-wrapper">
	      <div id="to-wrapper">
	        <div class="col-md-2 sidebar">
	          <!-- required for floating -->
	          <!-- Nav tabs -->
	          <ul class="nav nav-tabs tabs-left">
			  	<?php  echo tg_theme_tab_menu();?>
	          </ul>
	        </div>
	        <div class="col-md-10">
	          <div class="to-content">
	            <!-- Tab panes --> 
	            <form action='options.php' method='post' class="form-horizontal"> 
	              <?php settings_fields( 'tg_options' ); ?>
	              <?php do_settings_sections( 'options_page' ); ?>
	              <div class="tab-content">
	                <?php  echo tg_theme_tab_page();   ?>
	              </div>
	              <!-- tab-content -->
	              <p class="submit">
	                <input name="tg_options[submit]" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'weddingvendor'); ?>" />
	                <input name="tg_options[reset]"  type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'weddingvendor'); ?>" onclick="return confirm('<?php esc_html_e('Are you sure to reset default theme setting?','weddingvendor'); ?>')" />
	              </p>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
<?php  
} 

add_action( 'after_switch_theme', 'tg_default_setting_option' );

function tg_default_setting_option() {
	$default_check=get_option( 'tg_options' );
	if(count($default_check)==1)
	{
		$tg_default = tg_default_options();
		update_option( 'tg_options', $tg_default); 
	}
}
?>