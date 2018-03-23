<?php 
/**
 * Template Name: Manage Listing
 */

get_header();

if (is_user_logged_in() ) {

global $current_user;
wp_get_current_user();
$userID          = $current_user->ID;
$user_login      = $current_user->user_login;

$currency_code		= tg_get_option('currency_symbols');
$user_member_status = get_the_author_meta( 'user_member_status' , $userID );

get_template_part( 'template-parts/user/dashboard', 'menu' );

$add_listing = get_add_listing();

?>
<div class="main-container">
  <div class="container">
    <div class="row">
       <div class="col-md-12 my-listing-dashboard">   
		<?php while ( have_posts() ) : the_post(); ?>
            <div class="row">				
                <div class="col-md-12">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endwhile; // End of the loop. ?>	
		<div class="table-head">
          <div class="row">
            <div class="col-md-2"><?php esc_html_e('Image','weddingvendor');?></div>
            <div class="col-md-3"><?php esc_html_e('Title','weddingvendor');?></div>
            <div class="col-md-3"><?php esc_html_e('Address','weddingvendor');?></div>
            <div class="col-md-2"><?php esc_html_e('Price','weddingvendor');?></div>
            <div class="col-md-2"><?php esc_html_e('Action','weddingvendor');?></div>
          </div>
        </div>        	
		  <?php
            $listing='';
            $listing1='';
            $args = array( 'post_type' => 'item','post_status'  => 'publish', 'posts_per_page' => -1,'orderby' => 'menu_order ID','order'   => 'ASC','author'=> $userID );
            $item = new WP_Query( $args );
            if($item->have_posts())
            {
            while ( $item->have_posts() ) : $item->the_post();
            
            $listing1.='<div class="row" id="manage_'.get_the_id().'"><div class="col-md-10">'.get_the_title().'</div><div class="col-md-1"><a href="'.$add_listing['url'].'?item_edit='.get_the_id().'">Edit</a></div><div class="col-md-1"><a href="javascript:void();" title="'.get_the_title().'" class="delete-on" id="'.get_the_id().'">Delete</a></div></div><hr>';
            
            $item_id=get_the_id();
            if(wp_get_attachment_url( get_post_thumbnail_id($item_id) ))
            {
                $feature_img='<a href="'.get_permalink($item_id).'" target="_blank">'.wp_get_attachment_image( get_post_thumbnail_id($item_id),'weddingvendor_item_thumb',false ).'</a>';
            }
            else{
                $feature_img='';
            }
            
            $listing.= '<div class="listing-row">
              <div class="row" id="manage_'.$item_id.'">
                <div class="col-md-2 listing-thumb">'.$feature_img.'</div>
                <div class="col-md-3 listing-title"><h2>'.get_the_title().'</h2></div>
                <div class="col-md-3 listing-address">'.get_post_meta($item_id, 'item_address', true).'</div>
                <div class="col-md-2 listing-price">'.$currency_code.''.get_post_meta($item_id, 'item_price', true).'</div>
                <div class="col-md-2 listing-action">';
        
            $listing.= '<a class="btn btn-primary" href="'.$add_listing['url'].'?item_edit='.$item_id.'">'.__('Edit','weddingvendor').'</a> ';
			
			$listing.= '<a class="btn btn-danger delete-on" href="javascript:void();" title="'.get_the_title().'" id="'.get_the_id().'">'.__('Delete','weddingvendor').'</a>';
            $listing.='</div>
              </div>
            </div>';
            
            endwhile; 		
            wp_reset_postdata();			  
            }
            else{
            	$listing.='<div class="row"><div class="col-md-12">'.__('Sorry, no items found','weddingvendor').'</div></div>';
            }
           echo $listing
           ?>         
      </div>
    </div>
    </div>
  </div>
<?php 
}
else{
	wedding_check_logout_user();
}
get_footer();
?>