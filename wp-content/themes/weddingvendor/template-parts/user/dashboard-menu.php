<?php 
if (is_user_logged_in() ) {

wedding_check_user_login_vendor();	
global $current_user;
wp_get_current_user();
$userID          = $current_user->ID;
$user_login      = $current_user->user_login;
$first_name      = get_the_author_meta( 'first_name' , $userID );
$last_name       = get_the_author_meta( 'last_name' , $userID );


$user_custom_picture    =   get_the_author_meta( 'custom_picture' , $userID );
$image_id               =   get_the_author_meta( 'small_custom_picture',$userID); 

$free_listing_validity  = tg_get_option('free_listing_validity'); 

if($user_custom_picture==''){
    $user_custom_picture=get_template_directory_uri().'/images/default-user.png';
}
$id=get_the_id();
$user_profile_link 	= get_user_profile_link();
$manage_listing 	= get_manage_listing();
$add_listing 		= get_add_listing();
$package_price 		= package_price();
$dashboard_link 	= get_dashboard_link();
?>
<div class="tp-dashboard-head"><!-- page header -->
  <div class="container">
    <div class="row">
      <div class="col-md-12 profile-header">
        <div class="profile-pic col-md-2"><img src="<?php echo $user_custom_picture; ?>" alt="" class="img-responsive img-circle"></div>
        <div class="profile-info col-md-9">
          <h1 class="profile-title"><?php echo $first_name."  ".$last_name;?><small><?php esc_html_e('Welcome Back','weddingvendor'); ?> <?php echo $user_login; ?></small></h1>
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
	      <li <?php if($dashboard_link['id']==$id) echo 'class="active"';?>><a href="<?php echo $dashboard_link['url'];?>"><i class="flaticon-user144 db-icon"></i><?php echo $dashboard_link['name']; ?></a></li>
          <li <?php if($user_profile_link['id']==$id) echo 'class="active"';?>><a href="<?php echo $user_profile_link['url'];?>"><i class="flaticon-user144 db-icon"></i><?php echo $user_profile_link['name']; ?></a></li>
          <li <?php if($manage_listing['id']==$id) echo 'class="active"';?>><a href="<?php echo $manage_listing['url'];?>"><i class="flaticon-cube29 db-icon"></i><?php echo $manage_listing['name']; ?></a></li>
          <li <?php if($add_listing['id']==$id) echo 'class="active"';?>><a href="<?php echo $add_listing['url'];?>"><i class="flaticon-add149 db-icon"></i><?php echo $add_listing['name']; ?></a></li>
          <?php if($free_listing_validity!="lifetime"){ ?>
          <li><a <?php if($package_price['id']==$id) echo 'class="active"';?> href="<?php echo $package_price['url'];?>"><i class="flaticon-file69 db-icon"></i><?php echo $package_price['name']; ?></a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</div>    
<?php 
}
?>