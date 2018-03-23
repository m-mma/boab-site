<?php
add_action( 'widgets_init', 'wedding_image_widget' );
function wedding_image_widget() {
	register_widget( 'Wedding_image_widget' );
}


class Wedding_image_widget extends WP_Widget {
	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'Image Ads' );
	}
	function widget( $args, $instance ) {
	// Widget output
	extract($args);
	$image_url = ($instance['image_url']) ? $instance['image_url'] : esc_html__('', 'weddingvendor');
	$image_link = $instance['image_link'] ? $instance['image_link'] : esc_html__('', 'weddingvendor');
	
	$title = ($instance['title']) ? $instance['title'] : esc_html__('', 'weddingvendor');
	$description = $instance['description'] ? $instance['description'] : esc_html__('', 'weddingvendor');

	echo $before_widget;
	if(isset($image_url) && !empty($image_url) && isset($image_link) && !empty($image_link))
	{		
		echo '<div class="feature-box-ads">';
		echo '<a href="'.esc_url($image_link).'" target="_blank">';
		
		echo '<img class="img-responsive" alt="" src="'.esc_url($image_url).'">';
		
		echo '</a>';
		echo '</div>';
		
	}
	else if(isset($image_url) && !empty($image_url))
	{
		echo '<div class="feature-box-ads">';		
		echo '<img class="img-responsive" alt="" src="'.esc_url($image_url).'">';		
		echo '</div>';
	}

	if(isset($title) && !empty($title))
	{
		echo '<h3 class="feature-image-ads">'.esc_html($title).'</h3>';
	}
	if(isset($description) && !empty($description))
	{
		echo '<p>'.$description.'</p>';
	}
	?>    

	<?php 
	echo $link; 
	echo $after_widget; 
	}
	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['image_url'] = $new_instance['image_url'];
		$instance['image_link'] = $new_instance['image_link'];

		$instance['title'] = $new_instance['title'];
		$instance['description'] = $new_instance['description'];
		return $instance;
	}
	function form( $instance ) {		
		// Output admin widget options form
      if(!isset($instance['image_url'])) $instance['image_url'] = esc_html__('Ads Image with http:', 'weddingvendor');
	  if(!isset($instance['image_link'])) $instance['image_link'] = esc_html__('Ads Redirect URL http:', 'weddingvendor');
	  
      if(!isset($instance['title'])) $instance['title'] = esc_html__('Ads Title', 'weddingvendor');
      if(!isset($instance['description'])) $instance['description'] = esc_html__('Ads Description', 'weddingvendor');
  ?>
      <p>
     	<label for="<?php echo $this->get_field_id('image_url'); ?>"><?php esc_html_e('Image URL', 'weddingvendor') ?></label>
        <input  type="text" value="<?php echo esc_attr($instance['image_url']); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" 
        id="<?php echo $this->get_field_id('image_url'); ?>" class="widefat" />
      </p>
     <p>
        <label for="<?php echo $this->get_field_id('image_link'); ?>"><?php esc_html_e('Image Redirect URL', 'weddingvendor') ?></label>
        <input  type="text" value="<?php echo esc_attr($instance['image_link']); ?>" name="<?php echo $this->get_field_name('image_link'); ?>" 
        id="<?php echo $this->get_field_id('image_link'); ?>" class="widefat" />       
      </p>           
      <p>
     	<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title', 'weddingvendor') ?></label>
        <input  type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
        id="<?php echo $this->get_field_id('title'); ?>" class="widefat" />
      </p>
     <p>
        <label for="<?php echo $this->get_field_id('description'); ?>"><?php esc_html_e('Description', 'weddingvendor') ?></label>
		<textarea name="<?php echo $this->get_field_name('description'); ?>" class="widefat" ><?php echo $instance['description']; ?></textarea>
      </p>            
      <?php
	}
}
?>