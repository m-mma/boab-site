<?php
add_action( 'widgets_init', 'wedding_popular_post_widget' );
function wedding_popular_post_widget() {
	register_widget( 'Wedding_Popular_Post' );
}

class Wedding_Popular_Post extends WP_Widget {
	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'Popular Post' );
	}
	function widget( $args, $instance ) {
		// Widget output
    	extract($args);
        $title = ($instance['title']) ? $instance['title'] : esc_html__('Popular Recent Posts', 'weddingvendor');
        $limit = ($instance['limit']) ? $instance['limit'] : 3;
    	$selected = $instance['selected'];
		echo $before_widget;
		echo $before_title;
		echo $title;
		echo $after_title;
	  ?>
	<div class="recent-widget">
	  <?php
		  $featured_args = array(
		     'posts_per_page' => -1,
   		  );      
	      $featured_query = new WP_Query($featured_args);
      	  $k=0;	
		  if($featured_query->have_posts()) : 
			 while($featured_query->have_posts()) : $featured_query->the_post();         
		if ( has_post_thumbnail() ) { 

			if($k<$limit)
			{
		?>
        	<div class="rc-post-holder row">
            		<div class="col-md-5">
                        <div class="post-image">
                            <a href="<?php the_permalink(); ?>">                
                            <?php
                                   the_post_thumbnail(array(100, 100) , array( 'class' => 'img-responsive' ));     
                            ?>              
                            </a>
                        </div>
                    </div>
                    <div class="rc-post col-md-7">
                      <h3><a href="<?php the_permalink(); ?>" class="link"><?php the_title(); ?></a></h3>
                      <div class="meta"> 
						<?php                        
                        if(  $instance['selected'] ) {                           
                         wedding_widget_date();  
                        } ?>
                      </div>
                    </div>
            </div>      
      <?php 
	  		$k++;
	  		} 
		}?>
      <?php endwhile; endif; wp_reset_postdata(); ?>
      <?php echo $after_widget; ?>      
</div>
	  <?php
	}
	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['limit'] = $new_instance['limit'];
		$instance['selected'] = $new_instance['selected'];
		return $instance;
	}
	function form( $instance ) {		
		// Output admin widget options form
      if(!isset($instance['title'])) $instance['title'] = esc_html__('Popular Posts', 'weddingvendor');
      if(!isset($instance['limit'])) $instance['limit'] = 3;  ?>

      <p>
     	<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title', 'weddingvendor') ?></label>
        <input  type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
        id="<?php echo $this->get_field_id('title'); ?>" class="widefat" />
      </p>
      <p>
      	<label for="<?php echo $this->get_field_id('limit'); ?>"><?php esc_html_e('Limit Posts Number', 'weddingvendor') ?></label>
        <input  type="text" value="<?php echo esc_attr($instance['limit']); ?>" name="<?php echo $this->get_field_name('limit'); ?>"
        id="<?php echo $this->get_field_id('limit'); ?>" class="widefat" />
      </p>
      <p>
        <input class="checkbox" type="checkbox" <?php checked($instance['selected'], 'on'); ?> id="<?php echo $this->get_field_id('selected'); ?>" 
        name="<?php echo $this->get_field_name('selected'); ?>" /> 
        <label for="<?php echo $this->get_field_id('selected'); ?>"> <?php esc_html_e('Display post date?', 'weddingvendor') ?></label>
      </p>
      <?php
	}
}
?>