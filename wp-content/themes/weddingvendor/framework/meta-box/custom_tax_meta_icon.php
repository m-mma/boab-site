<?php 
// Add Upload fields to "Add New Taxonomy" icon form
function tg_add_itemcategory_icon_field() {
	// this will add the custom meta field to the add new term page
	if(isset($icon_image))	
	$itemcategory_icon=$icon_image;
	else 
	$itemcategory_icon='';
	
	?>
	<div class="form-field">
		<label for="itemcategory_icon"><?php esc_html_e( 'Category Icon:', 'weddingvendor' ); ?></label>
		<input type="text" name="itemcategory_icon[image]" id="itemcategory_icon[image]" class="categories-images text-upload" value="<?php echo $itemcategory_icon; ?>">
		<input class="upload_image_button button button-upload" name="_add_itemcategory_icon" id="_add_itemcategory_icon" type="button" value="<?php esc_html_e( 'Upload Icon', 'weddingvendor' ); ?>" />
        <div class="img-wrap" id="call_preview">
        </div>
	</div>
<?php
}
add_action( 'itemcategory_add_form_fields', 'tg_add_itemcategory_icon_field', 10, 2 );

// Add Upload fields to "Edit Taxonomy" form
function tg_icon_edit_meta_field($term) {
 
	// put the term ID into a variable
	$t_id = $term->term_id;
	$icon_image='';
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "icon_itemcategory_$t_id" ); ?>
	
	<tr class="form-field">
	<th scope="row" valign="top"><label for="_itemcategory_icon"><?php esc_html_e( 'Category Icon', 'weddingvendor' ); ?></label></th>
		<td>
			<?php
				$icon_image = esc_attr( $term_meta['image'] ) ? esc_attr( $term_meta['image'] ) : ''; 
				?>
			<input type="text" name="itemcategory_icon[image]" id="itemcategory_icon[image]" class="categories-images text-upload" value="<?php echo $icon_image; ?>">
			<input class="upload_image_button button button-upload" name="_itemcategory_icon" id="_itemcategory_icon" type="button" value="<?php esc_html_e( 'Upload Icon', 'weddingvendor' ); ?>" />
		</td>
	</tr>
	<tr class="form-field">
	<th scope="row" valign="top"></th>
		<td style="height: 150px;">
			<div class="img-wrap" id="call_preview">
				<img src="<?php echo $icon_image; ?>" id="icon-img" class="preview-upload">
			</div>
		</td>
	</tr>
<?php
}
add_action( 'itemcategory_edit_form_fields', 'tg_icon_edit_meta_field', 10, 2 );

// Save Taxonomy Image fields callback function.
function tg_save_icon_custom_meta( $term_id ) {
	if ( isset( $_POST['itemcategory_icon'] ) ) {
		$t_id = $term_id;
		$term_meta = get_option( "icon_itemcategory_$t_id" );
		$cat_keys = array_keys( $_POST['itemcategory_icon'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['itemcategory_icon'][$key] ) ) {
				$term_meta[$key] = $_POST['itemcategory_icon'][$key];
			}
		}
		// Save the option array.
		update_option( "icon_itemcategory_$t_id", $term_meta );
	}
}  
add_action( 'edited_itemcategory', 'tg_save_icon_custom_meta', 10, 2 );  
add_action( 'create_itemcategory', 'tg_save_icon_custom_meta', 10, 2 );
?>