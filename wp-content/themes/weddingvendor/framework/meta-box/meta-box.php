<?php 
/**
 * Meta-box Options.
 */  
$tg_meta_boxes = array(); 

/**
 * Slider meta box.
 */
$tg_meta_boxes[] = array(
    'id' => 'meta-box-slider',
    'title' => esc_html__('Slider More Details','weddingvendor'),
    'pages' => array('slider'), // custom post type
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => esc_html__('Content','weddingvendor'),
            'desc' => '',
            'id' =>  'slider_content',
            'type' => 'textarea',
            'std' => ''
        ),		
    )// field 
);

/**
 * Package meta box.
 */
$tg_meta_boxes[] = array(
    'id' => 'meta-box-package',
    'title' => esc_html__('Package Details','weddingvendor'),
    'pages' => array('package'), // multiple post types
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => esc_html__('How many listings are included?','weddingvendor'),
            'desc' => 'Here add number to user can add items likve 5,10,20',
            'id' =>  'package_items',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => esc_html__('Price','weddingvendor'),
            'desc' => 'Price as per currency code selection',
            'id' =>  'package_price',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => esc_html__('Package Period','weddingvendor'),
            'desc' => 'When item expired',
            'id' =>  'package_period',
            'type' => 'select',
            'std' => '',
			'options'=>array (
						'0' => array (
							'label' => '1 Month',
							'value'	=> '1 Month'
						),
						'1' => array (
							'label' => '2 Month',
							'value'	=> '2 Month'
						),
						'2' => array (
							'label' => '3 Month',
							'value'	=> '3 Month'
						),
						'3' => array (
							'label' => '6 Month',
							'value'	=> '6 Month'
						),
						'4' => array (
							'label' => '9 Month',
							'value'	=> '9 Month'
						),
						'5' => array (
							'label' => '1 Year',
							'value'	=> '1 Year'
						),
						'6' => array (
							'label' => '1 Year, 6 Month',
							'value'	=> '1 Year, 6 Month'
						),
						'7' => array (
							'label' => '2 Year',
							'value'	=> '2 Year'
						),
						'8' => array (
							'label' => '3 Year',
							'value'	=> '3 Year'
						))			
        ),	
        array(
            'name' => esc_html__('Is visible ?','weddingvendor'),
            'desc' => '',
            'id' =>  'package_status',
            'type' => 'select',
            'std' => '',
			'options'=>array (
						'0' => array (
							'label' => 'Yes',
							'value'	=> 'Yes'
						),
						'1' => array (
							'label' => 'No',
							'value'	=> 'No'
						))			
        ),					
    )// field
);



/**
 * Testimonial meta box.
 */
$tg_meta_boxes[] = array(
    'id' => 'tg-testimonial',
    'title' => esc_html__('Author Information','weddingvendor'),
    'pages' => array('testimonial'), // custom post type
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => esc_html__('Author Details','weddingvendor'),
            'desc' => '',
            'id' =>  'testimonials_details',
            'type' => 'textarea',
            'std' => ''
        ),
        array(
            'name' => esc_html__('Wedding Date','weddingvendor'),
            'desc' => '',
            'id' =>  'testimonials_date',
            'type' => 'date',
            'std' => ''
        ),		
  
    )// field 
);

/**
 * FAQS meta box.
 */
$tg_meta_boxes[] = array(
    'id' => 'tg-faq',
    'title' => esc_html__('Question and Answer Information','weddingvendor'),
    'pages' => array('faq'), // custom post type
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array( 
        array(
            'name' => esc_html__('Answer','weddingvendor'),
            'desc' => '',
            'id' =>  'answer_description',
            'type' => 'textarea',
            'std' => ''
        ),                     
    )// field 
);


/**
 * Item meta box.
 */
 
 $capacity =  array (
	'0' => array (
		'label' => '0',
		'value'	=> '0'
	),
	'1 - 50' => array (
		'label' => '1 - 50',
		'value'	=> '1 - 50'
	),
	'50 - 200' => array (
		'label' => '50 - 200',
		'value'	=> '50 - 200'
	),
	'200 - 500' => array (
		'label' => '200 - 500',
		'value'	=> '200 - 500'
	),
	'500 - 1000' => array (
		'label' => '500 - 1000',
		'value'	=> '500 - 1000'
	),
	'1000 - more' => array (
		'label' => '1000 - more',
		'value'	=> '1000 - more'
	),	
); 
 
$tg_meta_boxes[] = array(
    'id' => 'tg-info',
    'title' => esc_html__('Item Information','weddingvendor'),
    'pages' => array('item'), // multiple post types
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => esc_html__('Address','weddingvendor'),
            'desc' => '',
            'id' =>  'item_address',
            'type' => 'textarea',
            'std' => ''
        ),
        array(
            'name' => esc_html__('Price','weddingvendor'),
            'desc' => '',
            'id' =>  'item_price',
            'type' => 'text',
            'std' => ''
        ),			
        array(
            'name' => esc_html__('Maximum Price','weddingvendor'),
            'desc' => 'Add maximum price (Optional) ',
            'id' =>  'item_maxprice',
            'type' => 'text',
            'std' => ''
        ),			

        array(
            'name' => esc_html__('Capacity','weddingvendor'),
            'desc' => '',
            'id' =>  'item_capacity',
            'type' => 'select',
            'std' => '',
			'options' => $capacity,
        ),
        array(
            'name' => esc_html__('Video URL','weddingvendor'),
            'desc' => 'Here you can add youtube or vimeo',
            'id' =>  'tab_item_video',
            'type' => 'text',
            'std' => ''
        ),			
		
        array(
            'name' => esc_html__('Featured Item','weddingvendor'),
            'desc' => 'This item will display on home page',
            'id' =>  'featured_item',
            'type' => 'checkbox',
            'std' => ''
        ),					
		
    )// field
);


/**
 * Post meta box.
 */
$tg_meta_boxes[] = array(
    'id' => 'tg-post-video',
    'title' => esc_html__('Show Video','weddingvendor'),
    'pages' => array('post'), // custom post type
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => esc_html__('Video URL','weddingvendor'),
            'desc' => '<i>For Blog Posts, make sure Video post format is chosen.Make sure to use EMBED SRC URL - not the url to the video itself.</i>',
            'id' =>  'show_video',
            'type' => 'text',
            'std' => ''
        ),                     
    )// field 
);
/** 
 * Post meta box.
 */
$tg_meta_boxes[] = array(
    'id' => 'tg-post-audio',
    'title' => esc_html__('Show Audio','weddingvendor'),
    'pages' => array('post'), // custom post type
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => esc_html__('Audio URL','weddingvendor'),
            'desc' => '<i>For Blog Posts, make sure Audio post format is chosen.</i>',
            'id' =>  'show_audio',
            'type' => 'text',
            'std' => ''
        ),                     
    )// field 
);

foreach ($tg_meta_boxes as $tg_meta_box) {
    $tg_meta_box_data = new Tg_Meta_Box($tg_meta_box);
}

class Tg_Meta_Box {
    protected $_meta_box;
	/**
	 * create meta box based on given data.
	 */
    function __construct($tg_meta_box) {
        $this->_meta_box = $tg_meta_box;
        add_action('admin_menu', array(&$this, 'add'));
        add_action('save_post', array(&$this, 'save'));
    }
 	/**
	 * Add meta box for multiple post types.
	 */
    function add() {
        foreach ($this->_meta_box['pages'] as $page) {
            add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
        }
    }
	/**
	 * Callback function to show fields in meta box.
	 */
    function show() {
        global $post;
 		/**
		 * Use nonce for verification.
		 */
        echo  '<input type="hidden" name="weddingvendor_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
        echo  '<table class="form-table">';
		
        foreach ($this->_meta_box['fields'] as $field) {            
			/**
			 *  get current post meta data.
			 */
            $meta = get_post_meta($post->ID, $field['id'], true);
			if( isset( $field['desc'] ) ) {
				$meta_description = $field['desc'];
			}
			
            echo  '<tr><th style="width:20%"><label for="',esc_attr($field['id']), '">', esc_html($field['name']), '</label></th><td>';
			
            switch ($field['type']) {
			    /**
				 *  Meta-box Text Field.
				 */	
                 case 'text':
                 	   echo  '<input type="text" name="',esc_html($field['id']), '" id="', esc_attr($field['id']), '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
                       '<br /><small>', $meta_description.'</small>';
                 break;	
	

			    /**
				 *  Meta-box date Field.
				 */	
                 case 'date':
                 	   echo  '<input type="text" name="',esc_html($field['id']), '" id="', esc_attr($field['id']), '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" class="check_date date" />',
                       '<br /><small>', $meta_description.'</small>';
                 break;					 				
			    /**
				 *  Meta-box Color Field.
				 */	
				case 'color':
				      echo '<input class="color-field" type="text" name="',esc_html($field['id']), '" id="', esc_attr($field['id']), '" value="', $meta ? $meta : $field['std'], '"  />',
                      '<br /><small>', $meta_description.'</small>';
				break;
			    /**
				 *  Meta-box Textarea Field.
				 */	
                case 'textarea':
                      echo  '<textarea name="',esc_html($field['id']), '" id="', esc_attr($field['id']), '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
                      '<br /><small>', $meta_description.'</small>';
                break;
			    /**
				 *  Meta-box Select Field.
				 */	
				case 'select':					
					  echo  '<select name="'.esc_attr($field['id']).'" id="'.esc_attr($field['id']).'">';
						     foreach ($field['options'] as $option) {
						  	    echo  '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
					 	     } 
					  echo  '</select><br /><span class="description">'.$meta_description.'</span>';
                break;
			    /**
				 *  Meta-box Radio Field.
				 */	
				case 'radio':
					  foreach ( $field['options'] as $option ) {
						       echo  '<input type="radio" name="'.esc_attr($field['id']).'" id="'.$option['value'].'" 
							   value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' />
							   <label for="'.$option['value'].'">'.$option['name'].'</label><br />';
					  }
					  echo  '<span class="description">'.$meta_description.'</span>';
				break;
			    /**
				 *  Meta-box Checkbox Field.
				 */	
	            case 'checkbox':
    	              echo  '<input type="checkbox" name="',esc_html($field['id']), '" id="', esc_attr($field['id']), '"', $meta ? ' checked="checked"' : '', ' />';
					   echo  '<span class="description">'.$meta_description.'</span>';
                break;
			    /**
				 *  Meta-box Checkbox-group Field.
				 */	
			    case 'checkbox_group':
					  foreach ($field['options'] as $option) {
					      echo  '<input type="checkbox" value="',$option['value'],'" name="',esc_html($field['id']),'[]" 
						  id="',$option['value'],'"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' />
						  <label for="'.$option['value'].'">'.$option['name'].'</label><br />';
					  }
					  echo  '<span class="description">'.$meta_description.'</span>';
					break;
			    /**
				 *  Meta-box Image Field.
				 */	
				case 'image':
					  echo   '<span class="upload">';
					  if( $meta ) {									
						   echo  '<input type="hidden" name="',esc_html($field['id']), '" id="', esc_attr($field['id']), '" 
								   class="regular-text form-control text-upload" value="',$meta,'"  />';							
						   echo  '<img style="width:150px; display:block;" src= "'.$meta.'"  class="preview-upload" />';
						   echo   '<input type="button" class="button button-upload" id="logo_upload" value="'.esc_html__('Upload an image','weddingvendor').'"/></br>';		
						   echo   '<input type="button" class="button-remove" id="remove" value="'.esc_html__('Remove','weddingvendor').'" /> ';
					  }else {
						   echo  '<input type="hidden" name="',esc_html($field['id']), '" id="', esc_attr($field['id']), '" 
									class="regular-text form-control text-upload" value="',$meta,'"  />';							
						   echo  '<img style="" src= "'.$meta.'"  class="preview-upload" />';
						   echo  '<input type="button" class="button button-upload" id="logo_upload" value="'.esc_html__('Upload an image','weddingvendor').'"/></br>';		
						   echo  '<input type="button" style="display:none;" id="remove" class="button-remove" value="" /> ';
					   }   echo  '</span><span class="description">'.$meta_description.'</span>';		
				break;
					
            }
            echo '<td></tr>';
        }
        echo  '</table>';
    }
 
 	/**
	 * Save data from meta box.
	 */
     function save($post_id) {
	 	/**
		 * Verify Nonce.
		 */
        if ( !isset( $_POST['weddingvendor_meta_box_nonce'] ) || !wp_verify_nonce($_POST['weddingvendor_meta_box_nonce'] , basename(__FILE__))) {
            return $post_id;
        }
		/**
		 * Check Autosave.
		 */
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
        /**
		 * Check Permissions.
		 */
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
        /**
	     * Set Field & Update meta.
		 */
        foreach ($this->_meta_box['fields'] as $field) {			
            $old = get_post_meta($post_id, $field['id'], true);
            $new =  isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '' ;
 
            if ( $new && $new != $old) {
                update_post_meta($post_id, $field['id'], $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        }
    }
} 
function tg_admin_script() {
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');	
  	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('script', get_template_directory_uri().'/framework/js/script.js');
	
	wp_enqueue_style('bootstrap-jquery-date', get_template_directory_uri().'/framework/css/jquery-ui-1.8.16.custom.css');
}

add_action( 'admin_enqueue_scripts', 'tg_admin_script' );	

// ONLY Package CUSTOM TYPE POSTS
add_filter('manage_package_posts_columns', 'tg_columns_head_package', 10);
add_action('manage_package_posts_custom_column', 'tg_columns_content_package', 10, 2);
 
// CREATE TWO FUNCTIONS TO HANDLE THE COLUMN
function tg_columns_head_package($defaults) {
    $defaults['package_items'] = esc_html__('Package Listing','weddingvendor');
	$defaults['package_price'] = esc_html__('Price','weddingvendor');
    return $defaults;
}
function tg_columns_content_package($column_name, $post_id) {
    if ($column_name == 'package_items') {
		echo get_post_meta( $post_id, 'package_items', true );
    }
    if ($column_name == 'package_price') {
		$package_price = get_post_meta( $post_id, 'package_price', true );
		$package_period = get_post_meta( $post_id, 'package_period', true );
		echo tg_get_option('currency_symbols').$package_price."&nbsp;/&nbsp;".$package_period;
    }	
	
}