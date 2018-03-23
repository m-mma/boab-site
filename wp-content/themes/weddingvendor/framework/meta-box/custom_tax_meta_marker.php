<?php 
// Add Upload fields to "Add New Taxonomy" marker form
function tg_add_itemcategory_image_field() {
	// this will add the custom meta field to the add new term page
	if(isset($icon_image))	
	$itemcategory_image=$icon_image;
	else 
	$itemcategory_image='';	
	?>
	<div class="form-field">
		<label for="itemcategory_image"><?php esc_html_e( 'Category Map Icon:', 'weddingvendor' ); ?></label>
		<input type="text" name="itemcategory_image[image]" id="itemcategory_image[image]" class="categories-images text-upload" value="<?php echo $itemcategory_image; ?>">
		<input class="upload_image_button button button-upload" name="_add_itemcategory_image" id="_add_itemcategory_image" type="button" value="<?php esc_html_e( 'Upload Icon', 'weddingvendor' ); ?>" />
        <div class="img-wrap" id="call_preview">
        </div>
	</div>
<?php
}
add_action( 'itemcategory_add_form_fields', 'tg_add_itemcategory_image_field', 10, 2 );

// Add Upload fields to "Edit Taxonomy" form
function tg_marker_edit_meta_field($term) {
 
	// put the term ID into a variable
	$t_id = $term->term_id;
	$icon_image='';
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "itemcategory_$t_id" ); ?>
	
	<tr class="form-field">
	<th scope="row" valign="top"><label for="_itemcategory_image"><?php esc_html_e( 'Google Map Icon', 'weddingvendor' ); ?></label></th>
		<td>
			<?php $icon_image = esc_attr( $term_meta['image'] ) ? esc_attr( $term_meta['image'] ) : ''; ?>
			<input type="text" name="itemcategory_image[image]" id="itemcategory_image[image]" class="categories-images text-upload" value="<?php echo $icon_image; ?>">
			<input class="upload_image_button button button-upload" name="_itemcategory_image" id="_itemcategory_image" type="button" value="<?php esc_html_e( 'Upload Icon', 'weddingvendor' ); ?>" />
		</td>
	</tr>
	<tr class="form-field">
	<th scope="row" valign="top"></th>
		<td style="height:70px;">
			<div class="img-wrap" id="call_preview">
				<img src="<?php echo $icon_image; ?>" id="icon-img" class="preview-upload">
			</div>
		</td>
	</tr>
<?php
}
add_action( 'itemcategory_edit_form_fields', 'tg_marker_edit_meta_field', 10, 2 );

// Save Taxonomy Image fields callback function.
function tg_save_marker_custom_meta( $term_id ) {
	if ( isset( $_POST['itemcategory_image'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "itemcategory_$t_id" );
		$cat_keys = array_keys( $_POST['itemcategory_image'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['itemcategory_image'][$key] ) ) {
				$term_meta[$key] = $_POST['itemcategory_image'][$key];
			}
		}
		// Save the option array.
		update_option( "itemcategory_$t_id", $term_meta );
	}
}  
add_action( 'edited_itemcategory', 'tg_save_marker_custom_meta', 10, 2 );  
add_action( 'create_itemcategory', 'tg_save_marker_custom_meta', 10, 2 );

/**
 * Load media files needed for Uploader
 */

function tg_load_admin_things() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	wp_enqueue_script( 'wedding-thege-upload', get_template_directory_uri() . '/js/thege-upload.js', array(), null, false );
}

add_action( 'admin_enqueue_scripts', 'tg_load_admin_things' );	?>