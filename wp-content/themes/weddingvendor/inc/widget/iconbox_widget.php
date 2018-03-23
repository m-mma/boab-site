<?php
add_action( 'widgets_init', 'wedding_iconbox_widget' );
function wedding_iconbox_widget() {
	register_widget( 'Wedding_iconbox_widget' );
}


class Wedding_iconbox_widget extends WP_Widget {
	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'Iconbox Detail' );
	}
	function widget( $args, $instance ) {
	// Widget output
	extract($args);
	$icon_url = ($instance['icon_url']) ? $instance['icon_url'] : esc_html__('', 'weddingvendor');
	$title = ($instance['title']) ? $instance['title'] : esc_html__('Title', 'weddingvendor');
	$description = $instance['description'] ? $instance['description'] : esc_html__('Description', 'weddingvendor');
	$link = $instance['link'] ? $instance['link'] : esc_html__('', 'weddingvendor');
	echo $before_widget;
	if(isset($icon_url) && !empty($icon_url))
	{
		echo '<div class="feature-icon"><img class="img-responsive" alt="" src="'.esc_url($icon_url).'"></div>';
	}
	?>
    <h3><?php echo esc_html($title); ?></h3>
    <p><?php echo $description; ?></p>
	<?php 
	echo $link; 
	echo $after_widget; 
	}
	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['icon_url'] = $new_instance['icon_url'];
		$instance['title'] = $new_instance['title'];
		$instance['description'] = $new_instance['description'];
		$instance['link'] = $new_instance['link'];
		return $instance;
	}
	function form( $instance ) {		
		// Output admin widget options form
      if(!isset($instance['icon_url'])) $instance['icon_url'] = esc_html__('', 'weddingvendor');
      if(!isset($instance['title'])) $instance['title'] = esc_html__('Title Here', 'weddingvendor');
      if(!isset($instance['description'])) $instance['description'] = esc_html__('Description', 'weddingvendor');
	  if(!isset($instance['link'])) $instance['link'] = esc_html__('', 'weddingvendor');
  ?>
      <p>
     	<label for="<?php echo $this->get_field_id('icon_url'); ?>"><?php esc_html_e('Icon URL', 'weddingvendor') ?></label>
        <input  type="text" value="<?php echo esc_attr($instance['icon_url']); ?>" name="<?php echo $this->get_field_name('icon_url'); ?>" 
        id="<?php echo $this->get_field_id('icon_url'); ?>" class="widefat" />
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
     <p>
        <label for="<?php echo $this->get_field_id('link'); ?>"><?php esc_html_e('Email or Button', 'weddingvendor') ?></label>
		<textarea name="<?php echo $this->get_field_name('link'); ?>" class="widefat" ><?php echo $instance['link']; ?></textarea>
      </p>            
      <?php
	}
}
?>