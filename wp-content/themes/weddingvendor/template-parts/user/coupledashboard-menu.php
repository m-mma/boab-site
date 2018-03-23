<?php 
if (is_user_logged_in() ) {

wedding_check_user_login_couple();	
global $current_user;
wp_get_current_user();
$userID          = $current_user->ID;
$user_login      = $current_user->user_login;
$first_name      = get_the_author_meta( 'first_name' , $userID );
$last_name       = get_the_author_meta( 'last_name' , $userID );


$user_custom_picture    = get_the_author_meta( 'custom_picture' , $userID );
$image_id               = get_the_author_meta( 'small_custom_picture',$userID); 


echo $free_listing_validity;

if($user_custom_picture==''){
    $user_custom_picture= get_template_directory_uri().'/images/default-user.png';
}
$id						= get_the_id();
$couple_dashboard_link 	= get_couple_dashboard_link();
$couple_profile_link 	= get_couple_profile_link();
$couple_wishlist_link 	= get_couple_wishlist_link();
$couple_todolist_link 	= get_couple_todolist_link();
$couple_budget_link 	= get_couple_budget_link();
?>
<div class="tp-dashboard-head"><!-- page header -->
  <div class="container">
    <div class="row">
      <div class="col-md-12 profile-header">
        <div class="profile-pic col-md-2"><img src="<?php echo $user_custom_picture; ?>" alt="" class="img-responsive img-circle"></div>
        <div class="profile-info col-md-9">
          <h1 class="profile-title"><?php echo $first_name."  ".$last_name;?><small><?php esc_html_e('Welcome Back','weddingvendor'); ?>  <?php echo $user_login; ?></small></h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.page header -->
<div class="tp-dashboard-nav">
  <div class="container">
    <div class="row">
      <div class="col-md-12 dashboard-nav">
        <ul class="nav nav-pills nav-justified listnone">
	      <li <?php if($couple_dashboard_link['id']==$id) echo 'class="active"';?>><a href="<?php echo $couple_dashboard_link['url'];?>"><i class="fa fa-dashboard db-icon"></i><?php echo $couple_dashboard_link['name']; ?></a></li>
          <li <?php if($couple_todolist_link['id']==$id) echo 'class="active"';?>><a href="<?php echo $couple_todolist_link['url'];?>"><i class="fa fa-list db-icon"></i><?php echo $couple_todolist_link['name']; ?></a></li>
          <li <?php if($couple_budget_link['id']==$id) echo 'class="active"';?>><a href="<?php echo $couple_budget_link['url'];?>"><i class="fa fa-calculator db-icon"></i><?php echo $couple_budget_link['name']; ?></a></li>                    
          <li <?php if($couple_wishlist_link['id']==$id) echo 'class="active"';?>><a href="<?php echo $couple_wishlist_link['url'];?>"><i class="fa fa-heart db-icon"></i><?php echo $couple_wishlist_link['name']; ?></a></li>
          <li <?php if($couple_profile_link['id']==$id) echo 'class="active"';?>><a href="<?php echo $couple_profile_link['url'];?>"><i class="fa fa-user db-icon"></i><?php echo $couple_profile_link['name']; ?></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>    
<?php 
}
?>