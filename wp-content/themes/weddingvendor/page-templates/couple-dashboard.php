<?php 
/**
 * Template Name: Couple Dashboard
 */
get_header();
if (is_user_logged_in() ) {

global $current_user,$post;
wp_get_current_user();
$userID          = $current_user->ID;	

get_template_part( 'template-parts/user/coupledashboard', 'menu' );

$weddingdate   = get_the_author_meta( 'user_weddingdate' , $userID );


if(!empty($weddingdate))
{
$currnt_date	= date('Y-m-d');
$datetime1 		= date_create($currnt_date);
$datetime2 		= date_create($weddingdate);
$interval 		= date_diff($datetime1, $datetime2);
$count_dwon_days= $interval->format('%a');
}

$wistlist_ids=get_user_meta( $userID, 'user_wishlist',true) ;
$wistlist_arr=explode(",",$wistlist_ids);	

$args = array( 'post_type' => 'item', 
				'post_status'  => 'publish',
				'post__in' => $wistlist_arr,
				'orderby' => 'menu_order ID',
				'order'   => 'DESC');
				 
$item = new WP_Query( $args );
$total_element=$item->found_posts;
?>
<div class="main-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1><?php esc_html_e('Welcome back to ','weddingvendor'); echo $user_login; ?></h1>
        <p><?php esc_html_e('We are happy to have you back.','weddingvendor');?></p>
      </div>
      <div class="col-md-6">
      	<div class="well-box text-center">
        	<h3 class="package_title"><?php esc_html_e('Count Down Days','weddingvendor');?>&nbsp;&nbsp;<small>[<?php echo date("D, d F Y", strtotime($weddingdate));?>]</small></h3>
        	<h1 class="package_number"><?php echo $count_dwon_days; ?></h1>
        	<h3 class="package_title"></h3>
        </div>
      </div>
      <div class="col-md-6">  
      	<div class="well-box text-center">
        	<h3 class="package_title"><?php esc_html_e('Your Wishlist Items','weddingvendor');?></h3>
        	<h1 class="package_number"><?php echo $total_element; ?></h1>
        </div>        
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