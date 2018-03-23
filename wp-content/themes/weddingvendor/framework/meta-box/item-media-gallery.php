<?php 

add_action( 'admin_init', 'tg_metabox_add_item_media_gallery' );
add_action( 'admin_head-post.php', 'tg_metabox_media_print_scripts' );
add_action( 'admin_head-post-new.php', 'tg_metabox_media_print_scripts' );
add_action( 'save_post', 'tg_metabox_update_item_media', 10, 2 );

/**
 * Add custom Meta Box to Posts post type
*/
if ( ! function_exists( 'tg_metabox_add_item_media_gallery' ) ) : 

function tg_metabox_add_item_media_gallery()
{
	add_meta_box(
	'media_gallery',
	'Media Library',
	'tg_metabox_item_media_gallery',
	'item',// here you can set post type name
	'normal',
	'core');
}

endif;

/**
 * Print the Meta Box content
 */

if ( ! function_exists( 'tg_metabox_item_media_gallery' ) ) :  
function tg_metabox_item_media_gallery()
{
	global $post;


	// Use nonce for verification
    echo '<input type="hidden" name="media_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	?>
      <div id="property_media">
	<?php 

$arguments      = array(
    'numberposts' => -1,
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'post_parent' => $post->ID,
    'post_status' => null,
    'exclude' => get_post_thumbnail_id(),
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'order' => 'ASC'
    );

$already_in='';
$post_attachments   = get_posts($arguments);

print '<div class="property_uploaded_thumb_wrapepr" id="property_uploaded_thumb_wrapepr">';
foreach ($post_attachments as $attachment) {
    
    $already_in         =   $already_in.$attachment->ID.',';
    $preview            =   wp_get_attachment_image_src($attachment->ID, 'thumbnail');
    print '<div class="uploaded_thumb" data-imageid="'.$attachment->ID.'">
        <img  src="'.$preview[0].'"  alt="slider" />
        <a target="_blank" href="'.admin_url().'post.php?post='.$attachment->ID.'&action=edit" class="attach_edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <span class="attach_delete"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
    </div>';
}
  
print '<input type="hidden" id="image_to_attach" name="image_to_attach" value="'.$already_in.'"/>';
 

print '</div>';

print '<button class="upload_button button" id="button_new_image" data-postid="'.$post->ID.'">'.__('Upload new Image','wpestate').'</button>';	
	?>

    </div>
	<?php

	
}
endif;

/**
 * Print styles and scripts
 */
if ( ! function_exists( 'tg_metabox_media_print_scripts' ) ) : 
 
function tg_metabox_media_print_scripts()
{
	// Check for correct post_type
    global $post;
    if( 'item' != $post->post_type )// here you can set post type name
        return;

    ?>
    <style type="text/css">
	.attach_edit {
	  background-color: #04cccd;
	  color: #fff;
	  cursor: pointer;
	  font-size: 20px;
	  left: 0;
	  padding: 5px;
	  position: absolute;
	  top: 0;
	}

	.attach_delete {
	  background-color: #04cccd;
	  color: #fff;
	  cursor: pointer;
	  font-size: 20px;
	  padding: 5px;
	  position: absolute;
	  right: 0;
	  top: 0;
	}	
	.uploaded_thumb {
	  display: inline;
	  float: left;
	  margin: 10px 20px 10px 0;
	  position: relative;
	}  
	.property_uploaded_thumb_wrapepr {
	  float: left;
	  width: 100%;
	}
    </style>   
	<?php
	
	wp_enqueue_style( 'google-ui-jquery', get_template_directory_uri() .'/framework/css/jquery-ui-1.8.16.custom.css');	
	
	wp_enqueue_script( 'google-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', array(), null, true );
	
	wp_enqueue_script( 'google-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js', array(), null, true );
	
	//wp_enqueue_script( 'media-libs', get_template_directory_uri().'/framework/js/ajax-upload.js', array('jquery'), 1.0, true );
	
	wp_enqueue_script( 'media-libs', get_template_directory_uri().'/framework/js/media-libs.js', array('jquery'), 1.0, true );
	
	

    wp_localize_script('media-libs', 'admin_control_vars', 
        array( 'ajaxurl'            => admin_url('admin-ajax.php'),
                'plan_title'        =>  __('Plan Title','weddingvendor'),
                'admin_url'         =>  get_admin_url(),
        )
    );			
	
}



endif;
/**
 * Save post action, process fields
 */ 
if ( ! function_exists( 'tg_metabox_update_item_media' ) ) :  
  
function tg_metabox_update_item_media( $post_id, $post_object ) 
{
    // Doing revision, exit earlier **can be removed**
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;
 
    // Doing revision, exit earlier
    if ( 'revision' == $post_object->post_type )
        return;

    // Verify authenticity

    if ( !isset( $_POST['media_meta_box_nonce'] ) || !wp_verify_nonce($_POST['media_meta_box_nonce'] , basename(__FILE__))) {
       return;
    }

   // Correct post type
    if ( 'item' != $_POST['post_type'] ) // here you can set post type name
        return;

   if( isset( $_POST['image_to_attach'] ) &&  isset($post_id) ){
        $all_media = explode(',',$_POST['image_to_attach']);
       // print_r($all_media);
        
        if(is_array($all_media)){
            foreach($all_media as $value){
                $order++;
                $value=intval($value);
                if($value!=0){
                    wp_update_post( array(
                        'ID'            =>  $value,
                        'post_parent'   =>  $post_id,
                        'menu_order'    =>  $order
                ));

                }

            }
        }
    }
}
endif;


add_action('wp_ajax_weddingvendor_delete_file',        'weddingvendor_delete_file');
add_action('wp_ajax_nopriv_weddingvendor_delete_file', 'weddingvendor_delete_file');

if( !function_exists('weddingvendor_delete_file') ):
    function weddingvendor_delete_file(){

        $current_user = wp_get_current_user();
        $userID =   $current_user->ID;
      
        if ( !is_user_logged_in() ) {   
            exit('ko');
        }
        if($userID === 0 ){
            exit('out pls');
        }
     
        
        $attach_id = intval($_POST['attach_id']);
        
        $the_post= get_post( $attach_id); 

        if (!current_user_can('manage_options') ){
            if( $userID != $the_post->post_author ) {
                exit('you don\'t have the right to delete this');;
            }
        }

        wp_delete_attachment($attach_id, true);
        exit;
    }
endif;
?>