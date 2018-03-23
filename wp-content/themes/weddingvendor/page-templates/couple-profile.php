<?php 
/**
 * Template Name: Couple Profile
 */

get_header();

if (is_user_logged_in() ) {

global $current_user;
wp_get_current_user();
$userID         = $current_user->ID;
$user_login     = $current_user->user_login;
$first_name     = get_the_author_meta( 'first_name' , $userID );
$last_name      = get_the_author_meta( 'last_name' , $userID );
$user_email     = get_the_author_meta( 'user_email' , $userID );

$about_me       = get_the_author_meta( 'description' , $userID );

$weddingdate   = get_the_author_meta( 'user_weddingdate' , $userID );
$weddingcity   = get_the_author_meta( 'user_weddingcity' , $userID );
$weddingstate  = get_the_author_meta( 'user_weddingstate' , $userID );

// Social Link
$facebook   	= get_the_author_meta( 'facebook' , $userID );
$googleplus 	= get_the_author_meta( 'googleplus' , $userID );
$twitter    	= get_the_author_meta( 'twitter' , $userID );
$youtube    	= get_the_author_meta( 'youtube' , $userID );
$linkedin   	= get_the_author_meta( 'linkedin' , $userID );
$pinterest   	= get_the_author_meta( 'pinterest' , $userID );
$instagram   	= get_the_author_meta( 'instagram' , $userID );

$user_custom_picture    =   get_the_author_meta( 'custom_picture' , $userID );
$image_id               =   get_the_author_meta( 'small_custom_picture',$userID); 

if($user_custom_picture==''){
    $user_custom_picture=get_template_directory_uri().'/images/default-user.png';
}

get_template_part( 'template-parts/user/coupledashboard', 'menu' );
?>
<div class="main-container">
  <div class="container">
    <div class="row">
      <div class="col-md-7 dashboard-form">
		<form id="couple-profile" class="ajax-auth form-horizontal" method="post">
              <div class="status"></div>  
              <?php wp_nonce_field('ajax-user-profile-nonce', 'security'); ?>
              <!-- Form Name -->
              <h2><?php esc_html_e('Upload Profile Photo','weddingvendor');?></h2>
              
              <!-- File Button -->
              <div class="form-group">
				<div class="profile_div" id="profile-div">
                        <div class="col-md-4">
                        <?php print '<img id="profile-image" src="'.$user_custom_picture.'" alt="user image" data-profileurl="'.$user_custom_picture.'" data-smallprofileurl="'.$image_id.'" class="img-circle">';
                        ?>
                        </div>
                        <div class="col-md-8">
                            <div id="upload-container">                 
                                <div id="aaiu-upload-container">                                          
                                    <button id="aaiu-uploader" class="btn tp-btn-primary"><?php esc_html_e('Upload Profile Image','weddingvendor');?></button>
                                    <div id="aaiu-upload-imagelist">
                                        <ul id="aaiu-ul-list" class="aaiu-upload-list"></ul>
                                    </div>
                                </div>  
                            </div>
	                        <span class="upload_explain"><?php esc_html_e('*minimum 400px x 400px','weddingvendor');?></span>
                        </div>
                    </div>
              </div>
              <!-- Text input-->
              <h2><?php esc_html_e('Couple Profile','weddingvendor');?></h2>
              <div class="form-group">
                <label for="firstname" class="col-md-4 control-label"><?php esc_html_e('First Name','weddingvendor');?><span class="required">*</span></label>
                <div class="col-md-8">
                  <input id="firstname" name="firstname" type="text" value="<?php echo $first_name; ?>" class="form-control input-md required" >
                </div>
              </div>
			  <div class="form-group">
                <label for="lastname" class="col-md-4 control-label"><?php esc_html_e('Last Name','weddingvendor');?><span class="required">*</span></label>
                <div class="col-md-8">
                  <input id="lastname" name="lastname" type="text" value="<?php echo $last_name;?>" class="form-control input-md required" >
                </div>
              </div>				
              <div class="form-group">
                <label for="email" class="col-md-4 control-label"><?php esc_html_e('Email','weddingvendor');?><span class="required">*</span></label>
                <div class="col-md-8">
                  <input id="email" name="email" type="text" value="<?php echo $user_email;?>" disabled="disabled" class="form-control input-md required" >
                </div>
              </div>              
              <!-- Textarea -->
              <div class="form-group mb30">
                <label for="description" class="col-md-4 control-label"><?php esc_html_e('Description','weddingvendor');?></label>
                <div class="col-md-8">
                  <textarea id="about" name="about" class="form-control" rows="6"><?php echo $about_me; ?></textarea>
                </div>
              </div>
              <h2><?php esc_html_e('Wedding Details','weddingvendor');?></h2>
              <div class="form-group">
                <label for="weddingdate" class="col-md-4 control-label"><?php esc_html_e('Wedding Date','weddingvendor');?><span class="required">*</span></label>
                <div class="col-md-8">
                  <input id="wedding_date" name="wedding_date" type="text" class="form-control input-md book_date check_book_date" value="<?php echo $weddingdate;?>" readonly="readonly">
                </div>
              </div>

              <div class="form-group">
                <label for="wedding_city" class="col-md-4 control-label"><?php esc_html_e('Wedding City','weddingvendor');?></label>
                <div class="col-md-8">
                  <input id="wedding_city" name="wedding_city" type="text" class="form-control input-md" value="<?php echo $weddingcity;?>">
                </div>
              </div>
              
               <div class="form-group mb30">
                <label for="wedding_state" class="col-md-4 control-label"><?php esc_html_e('Wedding State','weddingvendor');?></label>
                <div class="col-md-8">
                  <input id="wedding_state" name="wedding_state" type="text" class="form-control input-md" value="<?php echo $weddingstate;?>">
                </div>
              </div>             
              
              <h2><?php esc_html_e('Social Media Profile','weddingvendor');?></h2>
              <div class="form-group">
                <label for="facebook" class="col-md-4 control-label"><?php esc_html_e('Facebook URL','weddingvendor');?></label>
                <div class="col-md-8">
                  <input id="facebook" name="facebook" type="url" class="form-control input-md" value="<?php echo $facebook;?>">
                </div>
              </div>
              <div class="form-group">
                <label for="twitter" class="col-md-4 control-label"><?php esc_html_e('Twitter URL','weddingvendor');?></label>
                <div class="col-md-8">
                  <input id="twitter" name="twitter" type="url" class="form-control input-md" value="<?php echo $twitter;?>">
                </div>
              </div>
              <div class="form-group">
                <label for="googleplus" class="col-md-4 control-label"><?php esc_html_e('Google Plus URL','weddingvendor');?></label>
                <div class="col-md-8">
                  <input id="googleplus" name="googleplus" type="url" class="form-control input-md" value="<?php echo $googleplus;?>">
                </div>
              </div>
              <div class="form-group">
                <label for="youtube" class="col-md-4 control-label"><?php esc_html_e('Youtube URL','weddingvendor');?></label>
                <div class="col-md-8">
                  <input id="youtube" name="youtube" type="url" class="form-control input-md" value="<?php echo $youtube;?>">
                </div>
              </div>
              <div class="form-group">
                <label for="linkedin" class="col-md-4 control-label"><?php esc_html_e('Linkedin URL','weddingvendor');?></label>
                <div class="col-md-8">
                  <input id="linkedin" name="linkedin" type="url" class="form-control input-md" value="<?php echo $linkedin;?>">
                </div>
              </div>
              <div class="form-group">
                <label for="pinterest" class="col-md-4 control-label"><?php esc_html_e('Pintrest URL','weddingvendor');?></label>
                <div class="col-md-8">
                  <input id="pinterest" name="pinterest" type="url" class="form-control input-md" value="<?php echo $pinterest;?>">
                </div>
              </div>
              <div class="form-group">
                <label for="instagram" class="col-md-4 control-label"><?php esc_html_e('Instagram URL','weddingvendor');?></label>
                <div class="col-md-8">
                  <input id="instagram" name="instagram" type="url" class="form-control input-md" value="<?php echo $instagram;?>">
                </div>
              </div>              
              <!-- Button -->
              <div class="form-group">
                <label for="submit" class="col-md-4 control-label"></label>
                <div class="col-md-4">
                  <button id="couple-profile-on"  class="btn tp-btn-primary btn-lg" name="button"><?php esc_html_e('Update Profile','weddingvendor');?></button>
                </div>
              </div>
            </form>                    
      </div>
      <div class="col-md-5 dashboard-form">
            <form id="change-password" class="ajax-auth form-horizontal" method="post">
              <div class="status"></div>  	
              <?php wp_nonce_field('ajax-vendor-change-pwd-nonce', 'security'); ?>
              <!-- Form Name -->
              <h2><?php esc_html_e('Change Password','weddingvendor');?></h2>
              
              <!-- Text input-->
              <div class="form-group">
                <label for="old_pwd" class="col-md-4 control-label"><?php esc_html_e('Old Password','weddingvendor'); ?></label>
                <div class="col-md-8">
                  <input type="password" required="" class="form-control input-md" name="old_pwd" id="old_pwd">
                </div>
              </div>
              <div class="form-group">
                <label for="new_pwd" class="col-md-4 control-label"><?php esc_html_e('New Password','weddingvendor'); ?></label>
                <div class="col-md-8">
                  <input type="password" required="" class="form-control input-md" name="new_pwd" id="new_pwd">
                </div>
              </div>
              <div class="form-group">
                <label for="confirm_pwd" class="col-md-4 control-label"><?php esc_html_e('Confirm Password','weddingvendor'); ?></label>
                <div class="col-md-8">
                  <input type="password" required="" class="form-control input-md" name="confirm_pwd" id="confirm_pwd">
                </div>
              </div>
              
              <!-- Button -->
              <div class="form-group">
                <label for="submit" class="col-md-4 control-label"></label>
                <div class="col-md-4">
                  <button id="change-password-on" type="button" class="btn tp-btn-primary tp-btn-lg"><?php esc_html_e('Change Password','weddingvendor'); ?></button>
                </div>
              </div>
            </form>
          </div>
    </div>
  </div>
</div>
<?php 
} 
else
{
	wedding_check_logout_user();
}
get_footer();
?>