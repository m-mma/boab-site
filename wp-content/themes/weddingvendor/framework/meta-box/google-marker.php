<?php 
add_action( 'admin_init', 'tg_metabox_add_google_locator' );
add_action( 'admin_head-post.php', 'tg_metabox_locator_print_scripts' );
add_action( 'admin_head-post-new.php', 'tg_metabox_locator_print_scripts' );
add_action( 'save_post', 'tg_metabox_update_locator', 10, 2 );

/**
 * Add custom Meta Box to Posts post type
*/
if ( ! function_exists( 'tg_metabox_add_google_locator' ) ) : 

function tg_metabox_add_google_locator()
{
	add_meta_box(
	'post_locators',
	'Google Locator',
	'tg_metabox_update_google_locator',
	'item',// here you can set post type name
	'normal',
	'core');
}

endif;

/**
 * Print the Meta Box content
 */

if ( ! function_exists( 'tg_metabox_update_google_locator' ) ) :  
function tg_metabox_update_google_locator()
{
	global $post;
	$locators = get_post_meta( $post->ID, 'locators', true );

	// Use nonce for verification
    echo '<input type="hidden" name="locators_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	?>
    <div id="dynamic_form">
      <div id="field_wrap">
        <?php 
        if ( isset( $locators['address'] ) ) 
        {
        ?>
        <div class="field_row">
            <div class="form_field">
              <label>Address</label>
              <input class="meta_image_url" type="text" id='gmaps-input-address' name="locators[address]" value="<?php echo $locators['address']; ?>" />
            </div>
        <div class="clear"></div>
       </div>      
		<div id="gmaps-canvas"></div>
        Latitude:  <input type="text"  id="gmaps-output-latitude" name="locators[latitude]" value="<?php echo $locators['latitude']; ?>" /> 
        Longitude:  <input type="text"  id="gmaps-output-longitude" name="locators[longitude]" value="<?php echo $locators['longitude']; ?>" />
	    <div id="gmaps-error"></div>
        <?php
        }
        else
        { 
		?>
		<div class="field_row">
            <div class="form_field">
              <label>Address</label>
              <input class="meta_image_url" value="" type="text" id='gmaps-input-address' name="locators[address]" />
            </div>
			<div class="clear"></div>
		</div>
		<div id="gmaps-canvas"></div>
        Latitude:  <input type="text"  id="gmaps-output-latitude" name="locators[latitude]"  /> 
        Longitude:  <input type="text"  id="gmaps-output-longitude" name="locators[longitude]" />
	    <div id="gmaps-error"></div>        
		<?php
        }
        ?>

    </div>
    </div>
	<?php
}
endif;

/**
 * Print styles and scripts
 */
if ( ! function_exists( 'tg_metabox_locator_print_scripts' ) ) : 
 
function tg_metabox_locator_print_scripts()
{
	// Check for correct post_type
    global $post;
    if( 'item' != $post->post_type )// here you can set post type name
        return;

	$locators = get_post_meta( $post->ID, 'locators', true );
    ?>
    <style type="text/css">
	#post_locators  { clear:both; }	
	.field_row{
		width:95%;
		margin-bottom:5px;
	}
	.clear {
		clear:both;
	}
	#dynamic_form label {
		padding:0 6px;
	}
	#gmaps-canvas {
		height: 250px;	
		border: 1px solid #999;
		-moz-box-shadow:    0px 0px 5px #ccc;
		-webkit-box-shadow: 0px 0px 5px #ccc;
		box-shadow:         0px 0px 5px #ccc;
		margin-bottom:5px;
	}
	#gmaps-input-address{
		width:80%;
	}
	#gmaps-error {
		color: #cc0000;
	}	  
    </style>
    <script language="javascript">
    <?php 
    if ( isset( $locators['longitude'] ) && $locators['longitude']!="" ) 
    {?>
    var center_lati=<?php echo $locators['latitude']?>;
	var center_long=<?php echo $locators['longitude']?>;
	var center_zoom=13;
    <?php }else{?>
    var center_lati=51.751724;
	var center_long=-1.255284;
	var center_zoom=5;    
    <?php } ?>
    </script>      
	<?php
	
	wp_enqueue_style( 'google-ui-jquery', get_template_directory_uri() .'/framework/css/jquery-ui-1.8.16.custom.css');	
	
	wp_enqueue_script( 'google-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', array(), null, true );
	
	wp_enqueue_script( 'google-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js', array(), null, true );
	
	wp_enqueue_script( 'google-locator', get_template_directory_uri().'/framework/js/google-locator.js', array(), null, true );		
	
	wp_enqueue_script( 'google-map', 'https://maps.google.com/maps/api/js?sensor=false&amp;key='.tg_get_option('google_map_key').'', array(), null, true );

}



endif;
/**
 * Save post action, process fields
 */ 
if ( ! function_exists( 'tg_metabox_update_locator' ) ) :  
  
function tg_metabox_update_locator( $post_id, $post_object ) 
{
    // Doing revision, exit earlier **can be removed**
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;
 
    // Doing revision, exit earlier
    if ( 'revision' == $post_object->post_type )
        return;

    // Verify authenticity

    if ( !isset( $_POST['locators_meta_box_nonce'] ) || !wp_verify_nonce($_POST['locators_meta_box_nonce'] , basename(__FILE__))) {
       return;
    }

   // Correct post type
    if ( 'item' != $_POST['post_type'] ) // here you can set post type name
        return;

    if ( $_POST['locators'] ) 
    {
        // Build array for saving post meta
        $service_data = array();

		if ($_POST['locators']['address'] != '') 
		{
			$service_data['address'] = $_POST['locators']['address'];
			$service_data['latitude'] = $_POST['locators']['latitude'];
			$service_data['longitude'] = $_POST['locators']['longitude'];
		}
        if ( $service_data ) 
           update_post_meta( $post_id, 'locators', $service_data );
       else 
           delete_post_meta( $post_id, 'locators' );
   } 
   // Nothing received, all fields are empty, delete option
   else 
   {
        delete_post_meta( $post_id, 'locators' );
    }
}
endif;
?>