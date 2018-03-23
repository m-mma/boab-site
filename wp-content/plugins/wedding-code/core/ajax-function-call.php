<?php
////////////////////////////////////////////////////////////////////////
////
////     wedding_ajax_auth_init  auth init function  
////
////////////////////////////////////////////////////////////////////////

function wedding_ajax_auth_init(){	

	global $current_user;
	wp_get_current_user();
	$userID         =   $current_user->ID;	
	
    wp_register_script('ajax-auth-script', get_template_directory_uri() . '/js/ajax-auth-script.js', array('jquery') ); 
    wp_enqueue_script('ajax-auth-script');
	
    wp_register_script('ajax-auth-script', get_template_directory_uri() . '/js/ajax-auth-script.js', array('jquery') ); 
    wp_enqueue_script('ajax-auth-script');	

	if(function_exists('get_dashboard_link'))
	{
		$dashboard_link=get_dashboard_link();
	}
	if(function_exists('get_couple_dashboard_link'))
	{
		$get_couple_dashboard_link=get_couple_dashboard_link();
	}	

    wp_localize_script( 'ajax-auth-script', 'ajax_auth_object', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => $dashboard_link['url'],
        'loadingmessage' => esc_html__('Sending user info, please wait.','weddingvendor')
    ));
	
    wp_localize_script( 'ajax-auth-script', 'ajax_couple_auth_object', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => $get_couple_dashboard_link['url'],
        'loadingmessage' => esc_html__('Sending user info, please wait.','weddingvendor')
    ));	

    // Enable the user with no privileges to run wedding_ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'wedding_ajax_login' );
	// Enable the user with no privileges to run wedding_ajax_register() in AJAX
	add_action( 'wp_ajax_nopriv_ajaxregister', 'wedding_ajax_register' );
	
    // Enable the user with no privileges to run wedding_ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxcouplelogin', 'wedding_ajax_couple_login' );
	// Enable the user with no privileges to run wedding_ajax_register() in AJAX
	add_action( 'wp_ajax_nopriv_ajaxcoupleregister', 'wedding_ajax_couple_register' );	


}

////////////////////////////////////////////////////////////////////////
////
////     wedding_ajax_auth_init  ajax call function  
////
////////////////////////////////////////////////////////////////////////

// Execute the action only if the user isn't logged in
add_action('init', 'wedding_ajax_auth_init');
  
function wedding_ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
  	// Call wedding_auth_user_login
	wedding_auth_user_login($_POST['username'], $_POST['password'], 'Login'); 
	
    die();
}


function wedding_ajax_couple_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-couple-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
  	// Call wedding_auth_user_login
	wedding_auth_user_login($_POST['username'], $_POST['password'], 'Login'); 
	
    die();
}



////////////////////////////////////////////////////////////////////////
////
////     wedding_ajax_register  ajax call function  
////
////////////////////////////////////////////////////////////////////////

function wedding_ajax_register(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-register-nonce', 'security' );
		
    // Nonce is checked, get the POST data and sign user on
    $info = array();
  	$info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($_POST['username']) ;
   // $info['user_pass'] = sanitize_text_field($_POST['password']);
    $info['user_pass'] = wp_generate_password( $length=12, $include_standard_special_chars=false );
	$info['user_email'] = sanitize_email( $_POST['email']);
	
	// Register the user
    $user_register = wp_insert_user( $info );

 	if ( is_wp_error($user_register) ){	
		$error  = $user_register->get_error_codes()	;
		
		if(in_array('empty_user_login', $error))
			echo json_encode(array('loggedin'=>false, 'message'=>$user_register->get_error_message('empty_user_login')));
		elseif(in_array('existing_user_login',$error))
			echo json_encode(array('loggedin'=>false, 'message'=> esc_html__('This username is already registered.','weddingvendor')));
		elseif(in_array('existing_user_email',$error))
        echo json_encode(array('loggedin'=>false, 'message'=> esc_html__('This email address is already registered.','weddingvendor')));
    } else {
	  wedding_wp_new_user_notification( $user_register, $info['user_pass'] ) ;
	  echo json_encode(array('loggedin'=>false, 'message'=> esc_html__('Please check your registerd email for password.','weddingvendor')));   
    }
	
    die();
}


////////////////////////////////////////////////////////////////////////
////
////     wedding_ajax_couple_register  ajax call function  
////
////////////////////////////////////////////////////////////////////////

function wedding_ajax_couple_register(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-couple-register-nonce', 'security' );
		
    // Nonce is checked, get the POST data and sign user on
    $info = array();
  	$info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($_POST['username']) ;
   // $info['user_pass'] = sanitize_text_field($_POST['password']);
    $info['user_pass'] = wp_generate_password( $length=12, $include_standard_special_chars=false );
	$info['user_email'] = sanitize_email( $_POST['email']);
	
	// Register the user
    $user_register = wp_insert_user( $info );

 	if ( is_wp_error($user_register) ){	
		$error  = $user_register->get_error_codes()	;
		
		if(in_array('empty_user_login', $error))
			echo json_encode(array('loggedin'=>false, 'message'=>$user_register->get_error_message('empty_user_login')));
		elseif(in_array('existing_user_login',$error))
			echo json_encode(array('loggedin'=>false, 'message'=> esc_html__('This username is already registered.','weddingvendor')));
		elseif(in_array('existing_user_email',$error))
        echo json_encode(array('loggedin'=>false, 'message'=> esc_html__('This email address is already registered.','weddingvendor')));
    } else {
	  update_user_meta( $user_register, 'user_weddingdate', $_POST['weddingdate'] ) ;
	  update_user_meta( $user_register, 'user_type', 'couple' ) ;		
	  wedding_wp_new_user_notification( $user_register, $info['user_pass'] ) ;
	  echo json_encode(array('loggedin'=>false, 'message'=> esc_html__('Please check your registerd email for password.','weddingvendor')));   
    }
	
    die();
}

////////////////////////////////////////////////////////////////////////
////
////     set_user_admin_bar_false_by_default  function  for default admin
////
////////////////////////////////////////////////////////////////////////


// Default Disable admin bar on user profile
add_action("user_register", "set_user_admin_bar_false_by_default", 10, 1);
function set_user_admin_bar_false_by_default($user_id) {
    update_user_meta( $user_id, 'show_admin_bar_front', 'false' );
}

////////////////////////////////////////////////////////////////////////
////
////       wedding_wp_new_user_notification  function  New user notification
////
////////////////////////////////////////////////////////////////////////


if( !function_exists('wedding_wp_new_user_notification') ):

function wedding_wp_new_user_notification( $user_id, $plaintext_pass = '' ) {

		$user = new WP_User( $user_id );
		
		update_user_meta( $user_id, 'user_member_status', 'Free' ) ;

		$user_login = stripslashes( $user->user_login );
		$user_email = stripslashes( $user->user_email );

		$message  = sprintf( __('New user registration on %s','weddingvendor'), get_option('blogname') ) . "\r\n\r\n";
		$message .= sprintf( __('Username: %s','weddingvendor'), $user_login ) . "\r\n\r\n";
		$message .= sprintf( __('E-mail: %s','weddingvendor'), $user_email ) . "\r\n";
		$headers = 'From: noreply  <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n".
				'Reply-To: noreply@'.$_SERVER['HTTP_HOST']."\r\n" .
				'X-Mailer: PHP/' . phpversion();
				
		@wp_mail(
			get_option('admin_email'),
			sprintf(__('[%s] New User Registration','weddingvendor'), get_option('blogname') ),
			$message,
                        $headers
		);

		if ( empty( $plaintext_pass ) )
			return;

		$message  = __('Hi there,','weddingvendor') . "\r\n\r\n";
		$message .= sprintf( __('Welcome to %s You can login now using the below credentials:','weddingvendor'), get_option('blogname')) . "\r\n\r\n";
		$message .= sprintf( __('Username: %s','weddingvendor'), $user_login ) . "\r\n";
		$message .= sprintf( __('Password: %s','weddingvendor'), $plaintext_pass ) . "\r\n\r\n";
		$message .= sprintf( __('If you have any problems, please contact me at %s.','weddingvendor'), get_option('admin_email') ) . "\r\n\r\n";
		$message .= __('Thank you.','weddingvendor');
                $headers = 'From: noreply  <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n".
                        'Reply-To: noreply@'.$_SERVER['HTTP_HOST']. "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
		wp_mail(
			$user_email,
			sprintf( __('[%s] Your username and password','weddingvendor'), get_option('blogname') ),
			$message,
                        $headers
		);
	}
        
endif; // end   wedding_wp_new_user_notification 

////////////////////////////////////////////////////////////////////////
////
////               wedding_ajax_forgot_pass  function 
////
////////////////////////////////////////////////////////////////////////

add_action( 'wp_ajax_nopriv_wedding_ajax_forgot_pass', 'wedding_ajax_forgot_pass' );  
add_action( 'wp_ajax_wedding_ajax_forgot_pass', 'wedding_ajax_forgot_pass' );  

if( !function_exists('wedding_ajax_forgot_pass') ){
	
	function wedding_ajax_forgot_pass()
	{
	    global $wpdb;

        $allowed_html   =   array();
        $post_id        =   intval( $_POST['postid'] ) ;
        $forgot_email   =   wp_kses( $_POST['forgot_email'],$allowed_html ) ;
       	$type = 1;
	   
        check_ajax_referer( 'forgot_ajax_nonce',  'security-forgot' );

        
        if ($forgot_email==''){      
            echo _e('Email field is empty.','weddingvendor');   
            exit();
        }
   
        //We shall SQL escape the input
        $user_input = trim($forgot_email);
 
        if ( strpos($user_input, '@') ) {
                $user_data = get_user_by( 'email', $user_input );
                if(empty($user_data) || isset( $user_data->caps['administrator'] ) ) {
                    echo __('Invalid E-mail address.','weddingvendor');
                    exit();
                }                            
        }
        else {
            $user_data = get_user_by( 'login', $user_input );
            if( empty($user_data) || isset( $user_data->caps['administrator'] ) ) {
               echo __('Invalid Username.','weddingvendor');
               exit();
            }
        }
        $user_login = $user_data->user_login;
		$user_email = $user_data->user_email;
 
        $key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
        if(empty($key)) {
                //generate reset key
                $key = wp_generate_password(20, false);
                $wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));
        }
 
        //emailing password change request details to the user
        $headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        $message = __('Someone requested that the password be reset for the following account:','weddingvendor') . "\r\n";
        $message .= get_option('siteurl') . "\r\n";
        $message .= sprintf(__('Username: %s','weddingvendor'), $user_login) . "\r\n";
        $message .= __('If this was a mistake, just ignore this email and nothing will happen.','weddingvendor') . "\r\n\r\n";
        $message .= __('To reset your password, visit the following address:','weddingvendor') . "\r\n\r\n";
        $message .= wedding_tg_validate_url($post_id,$type) . "action=reset_pwd&key=$key&login=" . rawurlencode($user_login) . "";
        if ( $message && !wp_mail($user_email, __('Password Reset Request','weddingvendor'), $message,  $headers) ) {
                echo "<div class='error'>".__('Email failed to send for some unknown reason.','weddingvendor')."</div>";
                exit();
        }
        else {
            echo '<div>'.__('We have just sent you an email with Password reset instructions.','weddingvendor').'</div>';
        }
        die();               		
	}	
}

////////////////////////////////////////////////////////////////////////
////
////               wedding_tg_validate_url  function 
////
////////////////////////////////////////////////////////////////////////

if( !function_exists('wedding_tg_validate_url') ):

function wedding_tg_validate_url($post_id,$type) {
       
    $page_url = esc_url(home_url());     
    $urlget = strpos($page_url, "?");
    if ($urlget === false) {
            $concate = "?";
    } else {
            $concate = "&";
    }
    return $page_url.$concate;
}

endif; // end   wedding_tg_validate_url 


////////////////////////////////////////////////////////////////////////
////
////               wedding_auth_user_login  function 
////
////////////////////////////////////////////////////////////////////////

function wedding_auth_user_login($user_login, $password, $login)
{
	$info = array();
    $info['user_login'] = $user_login;
    $info['user_password'] = $password;
    $info['remember'] = true;
	
	$user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
		echo json_encode(array('loggedin'=>false, 'message'=> esc_html__('Wrong username or password.','weddingvendor')));
    } else {
		wp_set_current_user($user_signon->ID); 
        echo json_encode(array('loggedin'=>true, 'message'=> esc_html__('Successful, redirecting...','weddingvendor')));
    }	
	die();
}

////////////////////////////////////////////////////////////////////////
////
////               wedding_ajax_vendor_profile  function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_vendor_profile() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_vendor_profile', 'wedding_ajax_vendor_profile' );
add_action( 'wp_ajax_wedding_ajax_vendor_profile', 'wedding_ajax_vendor_profile' );  

function wedding_ajax_vendor_profile()
{
	global $current_user;
	wp_get_current_user();
	$userID         =   $current_user->ID;
	check_ajax_referer( 'ajax-user-profile-nonce', 'security' );
	$allowed_html   =   array();
	
	$firstname    =  wp_kses( $_POST['firstname'] ,$allowed_html) ;
	$lastname     =  wp_kses( $_POST['lastname'] ,$allowed_html) ;
	$website      =  wp_kses( $_POST['website'] ,$allowed_html) ;
	$phone  	  =  wp_kses( $_POST['phone'] ,$allowed_html) ;
	$address  	  =  wp_kses( $_POST['address'] ,$allowed_html) ;
	$description  =  $_POST['about'] ;

	$facebook     =  wp_kses( $_POST['facebook'] ,$allowed_html) ;
	$googleplus   =  wp_kses( $_POST['googleplus'] ,$allowed_html) ;
	$twitter      =  wp_kses( $_POST['twitter'] ,$allowed_html) ;
	$youtube      =  wp_kses( $_POST['youtube'] ,$allowed_html) ;
	$linkedin     =  wp_kses( $_POST['linkedin'] ,$allowed_html) ;
	$pinterest    =  wp_kses( $_POST['pinterest'] ,$allowed_html) ;		
	$instagram    =  wp_kses( $_POST['instagram'] ,$allowed_html) ;			
	
	$profile_image_url_small  = wp_kses($_POST['profile_image_url_small'],$allowed_html);
	$profile_image_url= wp_kses($_POST['profile_image_url'],$allowed_html);   
	
	update_user_meta( $userID, 'first_name', $firstname ) ;
	update_user_meta( $userID, 'last_name',  $lastname) ;
	update_user_meta( $userID, 'website' , $website) ;
	update_user_meta( $userID, 'phone' , $phone) ;	
	update_user_meta( $userID, 'description' , $description) ;
	update_user_meta( $userID, 'address' , $address) ;	

	update_user_meta( $userID, 'facebook', $facebook ) ;
	update_user_meta( $userID, 'googleplus', $googleplus) ;
	update_user_meta( $userID, 'twitter' , $twitter) ;
	update_user_meta( $userID, 'youtube' , $youtube) ;
	update_user_meta( $userID, 'linkedin' , $linkedin) ;
	update_user_meta( $userID, 'pinterest' , $pinterest) ;	
	update_user_meta( $userID, 'instagram' , $instagram) ;		

	update_user_meta( $userID, 'custom_picture',$profile_image_url);
	update_user_meta( $userID, 'small_custom_picture',$profile_image_url_small);     

	echo json_encode(array('loggedin'=>false, 'message'=>esc_html__('Profile Updated Successfully.','weddingvendor')));
	die();
}

////////////////////////////////////////////////////////////////////////
////
////               wedding_ajax_todolist  function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_couple_profile() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_todolist', 'wedding_ajax_todolist' );
add_action( 'wp_ajax_wedding_ajax_todolist', 'wedding_ajax_todolist' );  

function wedding_ajax_todolist()
{
	global $current_user,$wpdb;

	wp_get_current_user();
	$userID         =   $current_user->ID;
	check_ajax_referer( 'ajax-user-todolist-nonce', 'security' );
	$allowed_html   =   array();

	$todotitle  =  wp_kses( $_POST['todotitle'] ,$allowed_html) ;
	$tododate   =  wp_kses( $_POST['tododate'] ,$allowed_html) ;
	$tododetail =  $_POST['tododetail'] ;
	
    $todolist_table = $wpdb->prefix."todolist";
	
	$wpdb->insert( 
		$todolist_table, 
		array( 
			'todo_user' => $userID,
			'todo_title' => $todotitle, 
			'todo_date' => $tododate,
			'todo_details' => $tododetail 
		), 
		array( 
			'%d',
			'%s',	
			'%s', 
			'%s' 
		) 
	);

	if(function_exists('get_couple_todolist_link'))
	{
		$get_couple_todolist_link=get_couple_todolist_link();
	}

	echo json_encode(array('loggedin'=>false, 'message'=>esc_html__('Todo Item Added Successfully.','weddingvendor'),'todo_url'=>$get_couple_todolist_link['url']));
	die();
}

////////////////////////////////////////////////////////////////////////
////
////               wedding_ajax_edit_todolist  function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_edit_todolist() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_edit_todolist', 'wedding_ajax_edit_todolist' );
add_action( 'wp_ajax_wedding_ajax_edit_todolist', 'wedding_ajax_edit_todolist' );  

function wedding_ajax_edit_todolist()
{
	global $current_user,$wpdb;

	wp_get_current_user();
	$userID         =   $current_user->ID;
	check_ajax_referer( 'ajax-user-todolist-nonce', 'security' );
	$allowed_html   =   array();

	$todotitle  =  wp_kses( $_POST['todotitle'] ,$allowed_html) ;
	$tododate   =  wp_kses( $_POST['tododate'] ,$allowed_html) ;
	$tododetail =  $_POST['tododetail'];
	$todoid =  $_POST['todoid'];
	
    $todolist_table = $wpdb->prefix."todolist";
	
	$wpdb->update( 
		$todolist_table, 
		array( 
			'todo_title' => $todotitle, 
			'todo_date' => $tododate,
			'todo_details' => $tododetail 
		), 
		array( 
			'todo_id' => base64_decode($todoid) 
		), 
		array( 
			'%s',	
			'%s', 
			'%s' 
		),
		array( 
			'%d' 
		) 		 
	);

	if(function_exists('get_couple_todolist_link'))
	{
		$get_couple_todolist_link=get_couple_todolist_link();
	}

	echo json_encode(array('loggedin'=>false, 'message'=>esc_html__('Todo Item Edited Successfully.','weddingvendor'),'todo_url'=>$get_couple_todolist_link['url']));
	die();
}

////////////////////////////////////////////////////////////////////////
////
////               wedding_ajax_edit_budget  function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_edit_budget() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_edit_budget', 'wedding_ajax_edit_budget' );
add_action( 'wp_ajax_wedding_ajax_edit_budget', 'wedding_ajax_edit_budget' );  

function wedding_ajax_edit_budget()
{
	global $current_user,$wpdb;

	wp_get_current_user();
	$userID         =   $current_user->ID;
	check_ajax_referer( 'ajax-user-budget-nonce', 'security' );
	$allowed_html   =   array();

	$budget_category =  $_POST['budget_category'];
	$category_id =  $_POST['category_id'];
	
    $budget_category_table = $wpdb->prefix."budget_category";
	
	$wpdb->update( 
		$budget_category_table, 
		array( 
			'category_name' => $budget_category, 
		), 
		array( 
			'category_id' => base64_decode($category_id) 
		), 
		array( 
			'%s' 
		),
		array( 
			'%s' 
		) 		 
	);

	if(function_exists('get_couple_budget_link'))
	{
		$get_couple_budget_link=get_couple_budget_link();
	}

	echo json_encode(array('loggedin'=>false, 'message'=>esc_html__('Category Edited Successfully.','weddingvendor'),'budget_url'=>$get_couple_budget_link['url']));
	die();
}

////////////////////////////////////////////////////////////////////////
////
////               wedding_ajax_budget  function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_couple_profile() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_budget', 'wedding_ajax_budget' );
add_action( 'wp_ajax_wedding_ajax_budget', 'wedding_ajax_budget' );  

function wedding_ajax_budget()
{
	global $current_user,$wpdb;

	wp_get_current_user();
	$userID         =   $current_user->ID;
	check_ajax_referer( 'ajax-user-budget-nonce', 'security' );
	$allowed_html   =   array();

	$date  =  date('Y-m-d');
	$budget_category =  $_POST['budget_category'] ;
	
    $budget_category_table = $wpdb->prefix."budget_category";
	
	$wpdb->insert( 
		$budget_category_table, 
		array( 
			'category_user_id' => $userID,
			'category_name' => $budget_category,
			'category_date' => $date,
		), 
		array( 
			'%d',
			'%s', 
			'%s' 
		) 
	);

	if(function_exists('get_couple_budget_link'))
	{
		$get_couple_budget_link=get_couple_budget_link();
	}

	echo json_encode(array('loggedin'=>false, 'message'=>esc_html__('Category Added Successfully.','weddingvendor'),'budget_url'=>$get_couple_budget_link['url']));
	die();
}

////////////////////////////////////////////////////////////////////////
////
////               wedding_ajax_insert_budget_list  function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_insert_budget_list() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_insert_budget_list', 'wedding_ajax_insert_budget_list' );
add_action( 'wp_ajax_wedding_ajax_insert_budget_list', 'wedding_ajax_insert_budget_list' );  

function wedding_ajax_insert_budget_list()
{
	global $current_user,$wpdb;

	wp_get_current_user();
	$userid         =   $current_user->ID;
	//check_ajax_referer( 'ajax-user-budgetlist-nonce', 'security' );
	$allowed_html   =   array();

	$item_name  =  wp_kses( $_POST['item_name'] ,$allowed_html) ;
	$item_estimate   =  $_POST['item_estimate'];
	$item_actual =  $_POST['item_actual'] ;
	$item_paid =  $_POST['item_paid'] ;
	$item_category =  $_POST['item_category'] ;
	
    $budget_list_table = $wpdb->prefix."budget_list";
	
	$wpdb->insert( 
		$budget_list_table, 
		array( 
			'budget_list_category_id' => $item_category,
			'budget_list_user_id' => $userid,
			'budget_list_name' => $item_name, 
			'budget_list_estimate_cost' => $item_estimate,
			'budget_list_actual_cost' => $item_actual,
			'budget_list_paid_cost' => $item_paid,
			'budget_list_date' => date('Y-m-d')
		), 
		array( 
			'%d',
			'%d',
			'%s',
			'%d',
			'%d',	
			'%d',
			'%s'  
		) 
	);

/*	if(function_exists('get_couple_todolist_link'))
	{
		$get_couple_todolist_link=get_couple_todolist_link();
	}*/

	//echo json_encode(array('loggedin'=>false, 'message'=>esc_html__('Todo Item Added Successfully.','weddingvendor'),'todo_url'=>$get_couple_todolist_link['url']));
	die();
}


////////////////////////////////////////////////////////////////////////
////
////               wedding_ajax_edit_budget_list  function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_edit_budget_list() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_edit_budget_list', 'wedding_ajax_edit_budget_list' );
add_action( 'wp_ajax_wedding_ajax_edit_budget_list', 'wedding_ajax_edit_budget_list' );  

function wedding_ajax_edit_budget_list()
{
	global $current_user,$wpdb;

	wp_get_current_user();
	$userid         =   $current_user->ID;
	$allowed_html   =   array();

	$item_name  =  wp_kses( $_POST['item_name'] ,$allowed_html) ;
	$item_estimate   =  $_POST['item_estimate'];
	$item_actual =  $_POST['item_actual'] ;
	$item_paid =  $_POST['item_paid'] ;
	$itemid =  $_POST['itemid'] ;
	
    $budget_list_table = $wpdb->prefix."budget_list";

	$wpdb->update( 
		$budget_list_table, 
		array( 
			'budget_list_name' => $item_name, 
			'budget_list_estimate_cost' => $item_estimate,
			'budget_list_actual_cost' => $item_actual,
			'budget_list_paid_cost' => $item_paid,
		), 
		array( 'budget_list_id' => $itemid,'budget_list_user_id' => $userid ), 
		array( 
			'%s',
			'%s',
			'%s',
			'%s',	
		), 
		array( '%s','%s' ) 
	);
	
	if(function_exists('get_couple_budget_link'))
	{
		$get_couple_budget_link=get_couple_budget_link();
	}

	echo json_encode(array('loggedin'=>false, 'message'=>esc_html__('Budget Item Edited Successfully.','weddingvendor'),'budget_list_url'=>$get_couple_budget_link['url']));
	die();
}
////////////////////////////////////////////////////////////////////////
////
////               wedding_ajax_couple_profile  function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_couple_profile() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_couple_profile', 'wedding_ajax_couple_profile' );
add_action( 'wp_ajax_wedding_ajax_couple_profile', 'wedding_ajax_couple_profile' );  

function wedding_ajax_couple_profile()
{
	global $current_user;
	wp_get_current_user();
	$userID         =   $current_user->ID;
	check_ajax_referer( 'ajax-user-profile-nonce', 'security' );
	$allowed_html   =   array();
	
	$firstname    =  wp_kses( $_POST['firstname'] ,$allowed_html) ;
	$lastname     =  wp_kses( $_POST['lastname'] ,$allowed_html) ;
	$description  =  $_POST['about'] ;
	
	$weddingdate  =  wp_kses( $_POST['weddingdate'] ,$allowed_html) ;	
	$weddingcity  =  wp_kses( $_POST['weddingcity'] ,$allowed_html) ;	
	$weddingstate =  wp_kses( $_POST['weddingstate'] ,$allowed_html) ;			

	$facebook     =  wp_kses( $_POST['facebook'] ,$allowed_html) ;
	$googleplus   =  wp_kses( $_POST['googleplus'] ,$allowed_html) ;
	$twitter      =  wp_kses( $_POST['twitter'] ,$allowed_html) ;
	$youtube      =  wp_kses( $_POST['youtube'] ,$allowed_html) ;
	$linkedin     =  wp_kses( $_POST['linkedin'] ,$allowed_html) ;
	$pinterest    =  wp_kses( $_POST['pinterest'] ,$allowed_html) ;		
	$instagram    =  wp_kses( $_POST['instagram'] ,$allowed_html) ;			
	
	$profile_image_url_small  = wp_kses($_POST['profile_image_url_small'],$allowed_html);
	$profile_image_url= wp_kses($_POST['profile_image_url'],$allowed_html);   
	
	update_user_meta( $userID, 'first_name', $firstname ) ;
	update_user_meta( $userID, 'last_name',  $lastname) ;
	update_user_meta( $userID, 'description' , $description) ;

	update_user_meta( $userID, 'user_weddingdate' , $weddingdate) ;	
	update_user_meta( $userID, 'user_weddingcity' , $weddingcity) ;	
	update_user_meta( $userID, 'user_weddingstate' , $weddingstate) ;			

	update_user_meta( $userID, 'facebook', $facebook ) ;
	update_user_meta( $userID, 'googleplus', $googleplus) ;
	update_user_meta( $userID, 'twitter' , $twitter) ;
	update_user_meta( $userID, 'youtube' , $youtube) ;
	update_user_meta( $userID, 'linkedin' , $linkedin) ;
	update_user_meta( $userID, 'pinterest' , $pinterest) ;	
	update_user_meta( $userID, 'instagram' , $instagram) ;		

	update_user_meta( $userID, 'custom_picture',$profile_image_url);
	update_user_meta( $userID, 'small_custom_picture',$profile_image_url_small);     

	echo json_encode(array('loggedin'=>false, 'message'=>esc_html__('Profile Updated Successfully.','weddingvendor')));
	die();
}

////////////////////////////////////////////////////////////////////////
////
////               wedding_ajax_change_password ajax call function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_vendor_profile() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_change_password', 'wedding_ajax_change_password' );
add_action( 'wp_ajax_wedding_ajax_change_password', 'wedding_ajax_change_password' );  

function wedding_ajax_change_password()
{
	global $current_user;
	wp_get_current_user();
	$allowed_html   =   array();
	$userID         =   $current_user->ID;    
	$old_pwd        =   wp_kses( $_POST['old_pwd'] ,$allowed_html) ;
	$new_pwd        =   wp_kses( $_POST['new_pwd'] ,$allowed_html) ;
	$confirm_pwd    =   wp_kses( $_POST['confirm_pwd'] ,$allowed_html) ;
	
	if($new_pwd=='' || $confirm_pwd=='' ){
		echo '<div class="alert alert-danger" role="alert"><button aria-label="Close" data-dismiss="alert" class="close" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>'.esc_html__('The new password is blank','weddingvendor').'</div>';
		die();
	}
   
	if($new_pwd != $confirm_pwd){
		echo '<div class="alert alert-danger" role="alert"><button aria-label="Close" data-dismiss="alert" class="close" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>'.esc_html__('New Password and confirm password do not match','weddingvendor').'</div>';
		die();
	}
	check_ajax_referer( 'ajax-vendor-change-pwd-nonce', 'security' );
	
	$user = get_user_by( 'id', $userID );
	if ( $user && wp_check_password( $old_pwd, $user->data->user_pass, $user->ID) ){
		 wp_set_password( $new_pwd, $user->ID );
		echo '<div class="alert alert-success" role="alert"><button aria-label="Close" data-dismiss="alert" class="close" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>'.esc_html__('Password Updated.Please login again.','weddingvendor').'</div>';
	}else{
		echo '<div class="alert alert-danger" role="alert"><button aria-label="Close" data-dismiss="alert" class="close" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>'.esc_html__('Old Password is not correct','weddingvendor').'</div>';
	}
 
	die();    	
}

////////////////////////////////////////////////////////////////////////
////
////               wedding_ajax_add_listing ajax call function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_vendor_profile() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_add_listing', 'wedding_ajax_add_listing' );
add_action( 'wp_ajax_wedding_ajax_add_listing', 'wedding_ajax_add_listing' );  

function wedding_ajax_add_listing()
{
	global $current_user;
	wp_get_current_user();
	$allowed_html   			=   array();
	$userID         			=   $current_user->ID;    
	$add_title        			=   wp_kses( $_POST['add_title'] ,$allowed_html) ;
	$add_content      			=   wp_filter_nohtml_kses( $_POST['add_content']) ;
	$add_min_price    			=   wp_kses( $_POST['add_min_price'] ,$allowed_html) ;
	$add_max_price    			=   wp_kses( $_POST['add_max_price'] ,$allowed_html) ;
	$add_address    			=   wp_kses( $_POST['add_address'] ,$allowed_html) ;
	
	$add_min_capacity   		=   wp_kses( $_POST['add_min_capacity'] ,$allowed_html) ;
	$add_video_url    			=   wp_kses( $_POST['add_video_url'] ,$allowed_html) ;

	$add_item_cat 				= 	$_POST['add_item_cat'];
	$item_city 					= 	$_POST['item_city'];	
	$add_item_ami 				= 	ltrim($_POST['add_item_ami'],',');
				
    $service_data 				= 	array();	
	$service_data['address']	= 	$_POST['add_address'];
	$service_data['latitude'] 	= 	$_POST['add_latitude'];
	$service_data['longitude']	= 	$_POST['add_longitude'];

	$service_data['add_item_cat'] = $_POST['add_item_cat'];

	check_ajax_referer( 'ajax-vendor-add-listing-nonce', 'security' );
	
    $new_status='publish';  
	
	$post = array(
		'post_title'	=> $add_title,
		'post_content'	=> $add_content,
		'post_status'	=> $new_status, 
		'post_type'     => 'item' ,
		'post_author'   => $current_user->ID 
	);
	$post_id =  wp_insert_post($post);  
		
 	if($post_id)
	{
		update_post_meta($post_id, 'item_price', $add_min_price);
		update_post_meta($post_id, 'item_maxprice', $add_max_price);
		update_post_meta($post_id, 'item_address', $add_address);
		
		update_post_meta($post_id, 'item_capacity', $add_min_capacity);
		
		update_post_meta( $post_id, 'locators', $service_data );
		update_post_meta($post_id, 'tab_item_video', $add_video_url);
		
		$cat_ids = array_map( 'intval', array($add_item_cat) );
		$cat_ids = array_unique( $cat_ids );
		
		wp_set_object_terms( $post_id, $cat_ids, 'itemcategory' );
		
		$city_ids = array_map( 'intval', array($item_city) );
		$city_ids = array_unique( $city_ids );
		
		wp_set_object_terms( $post_id, $city_ids, 'itemcity' );			
		
		$arr_ami=explode(",",$add_item_ami);
		$add_item_ami_ids = array_map( 'intval', $arr_ami );
		$add_item_ami_ids = array_unique( $add_item_ami_ids );
		
		wp_set_object_terms( $post_id, $add_item_ami_ids, 'item_amenities' );
		
		$attchs=explode(',',$_POST['attachid']);
		$last_id='';			
		
		// check for deleted images
		$arguments = array(
					'numberposts'   => -1,
					'post_type'     => 'attachment',
					'post_parent'   => $post_id,
					'post_status'   => null,
					'orderby'       => 'menu_order',
					'order'         => 'ASC'
		);
		
		$post_attachments = get_posts($arguments);
			  
		$new_thumb=0;
		$curent_thumb=get_post_thumbnail_id($post_id);
		foreach ($post_attachments as $attachment){
			if ( !in_array ($attachment->ID,$attchs) ){
				wp_delete_post($attachment->ID);
				if( $curent_thumb == $attachment->ID ){
					$new_thumb=1;
				}
			}
		}	
			
		foreach($attchs as $att_id){
			if( !is_numeric($att_id) ){
			 
			}else{
				if($last_id==''){
					$last_id  =  $att_id;  
				}					
				wp_update_post( array('ID' => $att_id,'post_parent' => $post_id	));                       					
			}
		}
			
		if( is_numeric($_POST['attachthumb']) && $_POST['attachthumb']!=''  ){
			set_post_thumbnail( $post_id, wp_kses($_POST['attachthumb'],$allowed_html )); 
		}else{
			set_post_thumbnail( $post_id, $last_id );                
		}
		
		$manage_listing=get_manage_listing();
		$args = array( 'post_type' => 'item', 'posts_per_page' => -1,'post_status' => 'publish','author'=> $userID );
		$item = new WP_Query( $args );			
		echo '<div class="alert alert-success" role="alert"><button aria-label="Close" data-dismiss="alert" class="close" type="button">
			<span aria-hidden="true">&times;</span>	</button>'.esc_html__('Item Inserted!.','weddingvendor').'</div>';		
		echo '<script> window.setTimeout(function () {	location.href = "'.$manage_listing['url'].'";	}, 3000);</script>';			
	}
	 
	die();    	
}

////////////////////////////////////////////////////////////////////////
////
////               wedding_ajax_edit_listing ajax call function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wp_ajax_nopriv_wedding_ajax_edit_listing() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_edit_listing', 'wedding_ajax_edit_listing' );
add_action( 'wp_ajax_wedding_ajax_edit_listing', 'wedding_ajax_edit_listing' );  

function wedding_ajax_edit_listing()
{
	global $current_user;
	wp_get_current_user();
	$allowed_html   			=   array();
	$userID         			=   $current_user->ID;    
	$add_title        			=   wp_kses( $_POST['add_title'] ,$allowed_html) ;
	//$add_content      			=   wp_filter_nohtml_kses( $_POST['add_content'] ) ;
	$add_content      			=   $_POST['add_content'] ;

	$add_min_price    			=   wp_kses( $_POST['add_min_price'] ,$allowed_html) ;
	$add_max_price    			=   wp_kses( $_POST['add_max_price'] ,$allowed_html) ;
	$add_address    			=   wp_kses( $_POST['add_address'] ,$allowed_html) ;
	
	$add_min_capacity    		=   wp_kses( $_POST['add_min_capacity'] ,$allowed_html) ;
	$add_video_url    			=   wp_kses( $_POST['add_video_url'] ,$allowed_html) ;

	$add_item_cat 				= 	$_POST['add_item_cat'];
	$item_city 					= 	$_POST['item_city'];	
	$add_item_ami 				= 	ltrim($_POST['add_item_ami'],',');
	$edit_id 					= 	$_POST['edit_id'];
				
    $service_data 				= 	array();
	$service_data['address'] 	= 	$_POST['add_address'];
	$service_data['latitude'] 	= 	$_POST['add_latitude'];
	$service_data['longitude']	= 	$_POST['add_longitude'];

	check_ajax_referer( 'ajax-vendor-add-listing-nonce', 'security' );
	
    $new_status='publish';  
	
	$post = array(
  	    'ID'            => $edit_id,
		'post_title'	=> $add_title,
		'post_content'	=> $add_content,
		'post_status'	=> $new_status, 
		'post_type'     => 'item' 
	);
	$post_id =  wp_update_post($post);  	

	$post_id = $edit_id ;

		update_post_meta($post_id, 'item_price', $add_min_price);
		update_post_meta($post_id, 'item_maxprice', $add_max_price);
		update_post_meta($post_id, 'item_address', $add_address);

		update_post_meta($post_id, 'item_capacity', $add_min_capacity);

		update_post_meta($post_id, 'locators', $service_data );
		update_post_meta($post_id, 'tab_item_video', $add_video_url);

		$cat_ids = array_map( 'intval', array($add_item_cat) );
		$cat_ids = array_unique( $cat_ids );

		wp_set_object_terms( $post_id, $cat_ids, 'itemcategory' );
		
		$city_ids = array_map( 'intval', array($item_city) );
		$city_ids = array_unique( $city_ids );

		wp_set_object_terms( $post_id, $city_ids, 'itemcity' );				
		
		$arr_ami=explode(",",$add_item_ami);
		$add_item_ami_ids = array_map( 'intval', $arr_ami );
		$add_item_ami_ids = array_unique( $add_item_ami_ids );

		wp_set_object_terms( $post_id, $add_item_ami_ids, 'item_amenities' );
		
		$attchs=explode(',',$_POST['attachid']);
		$last_id='';			

		// check for deleted images
		$arguments = array(
					'numberposts'   => -1,
					'post_type'     => 'attachment',
					'post_parent'   => $post_id,
					'post_status'   => null,
					'orderby'       => 'menu_order',
					'order'         => 'ASC'
		);
		$post_attachments = get_posts($arguments);
			  
		$new_thumb=0;
		$curent_thumb=get_post_thumbnail_id($post_id);
		foreach ($post_attachments as $attachment){
			if ( !in_array ($attachment->ID,$attchs) ){
				wp_delete_post($attachment->ID);
				if( $curent_thumb == $attachment->ID ){
					$new_thumb=1;
				}
			}
		}

			
		foreach($attchs as $att_id){
			if( !is_numeric($att_id) ){
			 
			}else{
				if($last_id==''){
					$last_id=  $att_id;  
				}
				
				wp_update_post( array('ID' => $att_id, 'post_parent' => $post_id ));                       
				
			}
		}
            
		if( is_numeric($_POST['attachthumb']) && $_POST['attachthumb']!=''  ){
			set_post_thumbnail( $post_id, wp_kses($_POST['attachthumb'],$allowed_html )); 
		}else{
			set_post_thumbnail( $post_id, $last_id );                
		}			

		echo '<div class="alert alert-success" role="alert"><button aria-label="Close" data-dismiss="alert" class="close" type="button">
				<span aria-hidden="true">&times;</span>
			</button>'.esc_html__('Item Updated.','weddingvendor').'</div>';
	 
	die();    	
}

////////////////////////////////////////////////////////////////////////
////
////               wedding_ajax_delete_listing ajax call function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wp_ajax_nopriv_wedding_ajax_delete_listing() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_delete_listing', 'wedding_ajax_delete_listing' );
add_action( 'wp_ajax_wedding_ajax_delete_listing', 'wedding_ajax_delete_listing' );  

function wedding_ajax_delete_listing()
{
	global $current_user;
	wp_get_current_user();
	$allowed_html   =   array();
	$userID         =   $current_user->ID;    
	$delete_id      =   $_POST['delete_id'];

	//check_ajax_referer( 'ajax-vendor-add-listing-nonce', 'security' );

	$post_id =  wp_trash_post($delete_id);  	

	echo '<div class="alert alert-success" role="alert"><button aria-label="Close" data-dismiss="alert" class="close" type="button">
			<span aria-hidden="true">&times;</span>
		</button>'.esc_html__('Deleted.','weddingvendor').'</div>';				
	 
	die();    	
}

////////////////////////////////////////////////////////////////////////
////
////               wedding_ajax_sendme ajax call function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_sendme() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_sendme', 'wedding_ajax_sendme' );
add_action( 'wp_ajax_wedding_ajax_sendme', 'wedding_ajax_sendme' );  

function wedding_ajax_sendme()
{
	global $current_user;
	wp_get_current_user();
	
	$allowed_html   =   array();
	$userID         =   $current_user->ID;    
	$name        	=   wp_kses( $_POST['name'] ,$allowed_html) ;
	$phone    		=   wp_kses( $_POST['phone'] ,$allowed_html) ;
	$email    		=   wp_kses( $_POST['email'] ,$allowed_html) ;
	$date    		=   wp_kses( $_POST['date'] ,$allowed_html) ;
	$guest    		=   wp_kses( $_POST['guest'] ,$allowed_html) ;
	$item_title 	=   wp_kses( $_POST['item_title'] ,$allowed_html) ;
	$sendme 		=	$_POST['sendme'];
	$item_url 		=	esc_url($_POST['item_url']);
	$user_email_id 	=	$_POST['user_email_id'];			

	check_ajax_referer( 'ajax-vendor-send-me', 'security' );

	$message 		=	'';
	$subject 		= 	esc_html__('Inquiry for','weddingvendor')." ".$item_title." ".esc_html__('Items','weddingvendor');

    $message 		.= 	esc_html__('Client Name','weddingvendor').": " . $name . "\r\n".esc_html__('Email','weddingvendor').": " . $email . "\r\n".__('Phone','weddingvendor').": " . $phone . "\r\n".__('Date','weddingvendor').": " . $date .  " \r\n".__('How to Contact','weddingvendor')." : " . $sendme . " \r\n".esc_html__('Selected Title','weddingvendor').": " . $item_title . "\r\n".esc_html__('Guest','weddingvendor').": " . $guest . "\r\n";
	
	$message 		.=	"\n\n ".esc_html__('Message sent from','weddingvendor')." " .$item_url;
	$headers 		= 	'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
	
	$mail = @wp_mail($user_email_id, $subject, $message, $headers);

	if($mail)
	{
		echo '<div class="alert alert-success" role="alert"><button aria-label="Close" data-dismiss="alert" class="close" type="button">
			<span aria-hidden="true">&times;</span>
		</button>'.esc_html__('Your request has been sent to the vendor.','weddingvendor').'</div>';	
	}
	else{
		echo '<div class="alert alert-warning" role="alert"><button aria-label="Close" data-dismiss="alert" class="close" type="button">
			<span aria-hidden="true">&times;</span>
		</button>'.esc_html__('Fail, Please try again.','weddingvendor').'</div>';			
	}	 
	die();    	
}

////////////////////////////////////////////////////////////////////////
////
////                  wedding_ajax_find_pins ajax call function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_find_pins() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_find_pins', 'wedding_ajax_find_pins' );
add_action( 'wp_ajax_wedding_ajax_find_pins', 'wedding_ajax_find_pins' );  

function wedding_ajax_find_pins()
{
	$result_arr 			= array();
	$capacity 				= array();
	$meta_query				= array();
	$category_type_array	= '';
	$city_array				= '';
	$min_price 				= '';
	$max_price				= '';
	$price					= '';
	$latitude				= '';
	$longitude				= '';
	$currency_code			= tg_get_option('currency_symbols');

	if (isset($_POST['category_type']) && $_POST['category_type'] != '') {
		$taxcity[]  = sanitize_title ( $_POST['category_type'] );
		$category_type_array = array(
			'taxonomy'  => 'itemcategory',
			'field'     => 'id',
			'terms'     => $taxcity
		);
	}

	if (isset($_POST['city']) && $_POST['city'] != '') {
		$city[]  = sanitize_title ( $_POST['city'] );
		$city_array = array(
			'taxonomy'  => 'itemcity',
			'field'     => 'id',
			'terms'     => $city
		);
	}	
		
	if( isset($_POST['min_price'])){
		$min_price = intval($_POST['min_price']);
	}	

	if( isset($_POST['max_price'])  && is_numeric($_POST['max_price']) ){
		$max_price          = intval($_POST['max_price']);
		$price['key']       = 'item_price';
		$price['value']     = array($min_price, $max_price);
		$price['type']      = 'numeric';
		$price['compare']   = 'BETWEEN';
		$meta_query[]       = $price;
	}	

	if (isset($_POST['capacity']) && !empty($_POST['capacity'])) {
		$capacity['key'] 	= 'item_capacity';
		$capacity['value'] 	= $_POST['capacity'];
		$meta_query[] 		= $capacity;
	}	
	
	$per_page	= tg_get_option('items_per_page');
	$paged		= $_POST['page_no'];

	$args = array( 'post_type' => 'item', 
					'posts_per_page' => $per_page,
					'post_status'       => 'publish',
					'orderby' => 'menu_order ID',
					'order'   => 'DESC',
					'paged' => $paged,
					'meta_query' => $meta_query,
					'tax_query' => array(
						'relation' => 'AND',
						$category_type_array,
						$city_array,
					),						
					 );

	$item = new WP_Query( $args );
	
	$total_element=$item->found_posts;
	$html='<div class="row"><div class="col-md-12 vendor-listing"><h2>'.esc_html__('Total','weddingvendor').' '.$total_element.' '.esc_html__('items in your search','weddingvendor').'</h2></div></div>';

	$i=0;
	$k=1;
	$html.='<div class="row">';

	while ( $item->have_posts() ) : $item->the_post();

	$post_id			= get_the_ID();

	$locators 			= get_post_meta($post_id,'locators', true );
	$map_address 		= $locators['address'];
	$latitude 			= $locators['latitude'];
	$longitude 			= $locators['longitude'];	

	$item_address 		= get_post_meta( $post_id, 'item_address', true );
	$featured_img 		= wp_get_attachment_image_src( get_post_thumbnail_id($post_id),'weddingvendor_item_thumb',false );
	$item_price 		= get_post_meta($post_id, 'item_price', true );
	$item_maxprice 		= get_post_meta( $post_id, 'item_maxprice', true );

	$categories_term_id	= '';
	$itemcategory       = get_the_terms($post_id, 'itemcategory');	
	if(!empty($itemcategory))
	{
		foreach ($itemcategory as $item_category_each) {
			
			$categories_term_id[]=$item_category_each->term_id;
		}
	}	

	$marker_icon 		= wedding_default_marker($categories_term_id[0]);
	$itemcity    		= get_the_terms($post->ID, 'itemcity');
	if(!empty($itemcity))
	{
		$cityname = $itemcity[0]->name;	
	}
	else{
		$cityname = '';
	}	

	$address_html		= wedding_item_address_html($cityname);
	$item_price_html	= wedding_item_price_html($item_price,$item_maxprice,$currency_code);;
	$item_price_marker	= wedding_item_price_marker($item_price,$item_maxprice,$currency_code);
	
	$result_arr[$i]["title"] 		= get_the_title();
	$result_arr[$i]["url"] 			= get_permalink($post_id);
	$result_arr[$i]["price"] 		= $item_price_marker;
	$result_arr[$i]["address"] 		= $item_address;
	$result_arr[$i]["featured_img"] = $featured_img[0];
	$result_arr[$i]["latitude"] 	= floatval($latitude);
	$result_arr[$i]["longitude"] 	= floatval($longitude);
	$result_arr[$i]["marker"] 		= $marker_icon;
	$result_arr[$i]["cat_name"] 	= $itemcategory[0]->name;
	$result_arr[$i]["cat_url"] 		= get_category_link($itemcategory[0]->term_id);
	
	$i++;

	$list_style = tg_get_option('listing_map_style');
	$list_col = tg_get_option('listing_map_col');
	
	if($list_col=="2col")
	{
		$col_class="col-md-6 2col-list";
		$row_col=2;
	}
	else if($list_col=="3col")
	{
		$col_class="col-md-4";
		$row_col=3;
	}
	else
	{
		$col_class="col-md-4";
		$row_col=3;
	}		

	if($list_style=='3grid')
	{
		$html.='<div class="'.$col_class.' vendor-box">
			  <div class="vendor-image"> 
				<a href="'.get_permalink($post_id).'"><img src="'.$featured_img[0].'" alt=""  /></a>
				<a href="'.get_category_link($itemcategory[0]->term_id).'" class="label-primary">'.esc_html($itemcategory[0]->name).'</a>
				'.wedding_wishlist_item_html($post_id).'
			  </div>
			  <div class="vendor-detail">
				<div class="caption">
				  <h2><a href="'.get_permalink($post_id).'" class="title">'.get_the_title().'</a></h2>'.$address_html.'
				</div>'.$item_price_html.'
			  </div>
			</div>';
	}
	else if($list_style=='bubba')
	{

		if($item_address)
		{
			$address_html = '<p>'.esc_html($item_address).'</p>';
		}
		$html.='<div class="'.$col_class.' vendor-box">
				<div class="grid">
				  <figure class="effect-bubba"> 
					<img src="'.$featured_img[0].'" alt="" class="img-responsive"  />
					<a href="'.get_permalink($post_id).'">
					<figcaption>
					  <h2>'.get_the_title().'</h2>'.$address_html.'
					</figcaption>
					</a>
				  </figure>
				</div>
			  </div>';
	}
	else if($list_style=='oscar')
	{
		if($item_address)
		{
			$address_html = '<p>'.esc_html($item_address).'</p>';
		}
		$html.='<div class="'.$col_class.' vendor-box">
				<div class="grid">
				  <figure class="effect-oscar"> 
					<img src="'.$featured_img[0].'" alt="" class="img-responsive"  />
				   
					<figcaption>
					  <h2>'.get_the_title().'</h2>'.$address_html.'
					   <a href="'.get_permalink($post_id).'">View More</a>
					</figcaption>
					
				  </figure>
				</div>
			  </div>';
	}
	else
	{
		$html.='<div class="col-md-4 vendor-box">
		  <div class="vendor-image"> 
			<a href="'.get_permalink($post_id).'"><img src="'.$featured_img[0].'" alt=""  /></a>
			<a href="'.get_category_link($itemcategory[0]->term_id).'" class="label-primary">'.esc_html($itemcategory[0]->name).'</a>
			'.wedding_wishlist_item_html($post_id).'
		  </div>
		  <div class="vendor-detail">
			<div class="caption">
			  <h2><a href="'.get_permalink($post_id).'" class="title">'.get_the_title().'</a></h2>'.$address_html.'
			</div>'.$item_price_html.'
		  </div>
		</div>';		
	}
		
	if(($k%$row_col)==0  && $k<count($item->posts))
	{
		$html.='</div><div class="row">';
	}
	$k++;
	endwhile; 		
	wp_reset_postdata();
	$html.='</div>';
	
	$paginaiton_html='';
	$end=ceil($total_element/$per_page);
	for($i=1;$i<=$end;$i++)
	{
		if($i == $paged )
		{
			$class = "active";
			$calltofunction='';
		}
		else{
			$class = "";
			$calltofunction='onclick="call_paging_item('.$i.')"';
		}
		
		$paginaiton_html.='<li class="'.$class.'"  title='.$i.' id="paging_'.$i.'" ><a href="javascript:void(0)" '.$calltofunction.' >'.$i.'</a></li>';		
	}
	
	$html.='<div class="col-md-12 tp-pagination"><ul class="pagination">'.$paginaiton_html.'</ul></div>';
	
	if(empty($latitude) && $longitude)
	{
		$latitude=tg_get_option('center_latitude');	
		$longitude=tg_get_option('center_longitude');
	}
			 
	echo json_encode(array('json_map'=>json_encode($result_arr), 'html_result'=>$html,'center_latitude'=>floatval($latitude),'center_longitude'=>floatval($longitude)));
	die();	 	
}



////////////////////////////////////////////////////////////////////////
////
////                  wedding_ajax_add_wishlist ajax call function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_add_wishlist() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_add_wishlist', 'wedding_ajax_add_wishlist' );
add_action( 'wp_ajax_wedding_ajax_add_wishlist', 'wedding_ajax_add_wishlist' );  

function wedding_ajax_add_wishlist()
{
	global $current_user;
	wp_get_current_user();
	$userid     = $current_user->ID;	
	$itemid 	= $_POST['itemid'];

    $user_wishlist=get_user_meta( $userid, 'user_wishlist',true) ;

	if(!empty($user_wishlist))
	{
		$user_wishlist_data=explode(",",$user_wishlist);
		if(!in_array($itemid,$user_wishlist_data))
		{
			array_push($user_wishlist_data,$itemid);
		}
	 	update_user_meta( $userid, 'user_wishlist', implode(",",$user_wishlist_data)) ;
	}
	else
	{
	 	update_user_meta( $userid, 'user_wishlist', $itemid ) ;
	}
	
}

////////////////////////////////////////////////////////////////////////
////
////                  wedding_ajax_add_wishlist ajax call function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_remove_wishlist() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_remove_wishlist', 'wedding_ajax_remove_wishlist' );
add_action( 'wp_ajax_wedding_ajax_remove_wishlist', 'wedding_ajax_remove_wishlist' );  

function wedding_ajax_remove_wishlist()
{
	global $current_user;
	wp_get_current_user();
	$userid     = $current_user->ID;	
	$itemid 	= $_POST['itemid'];

    $user_wishlist=get_user_meta( $userid, 'user_wishlist',true) ;

	$user_wishlist_data=explode(",",$user_wishlist);
	if(in_array($itemid,$user_wishlist_data))
	{
		foreach ($user_wishlist_data as $key => $value){
			if ($value == $itemid) {
				unset($user_wishlist_data[$key]);
			}
		}		
	}
	update_user_meta( $userid, 'user_wishlist', implode(",",$user_wishlist_data)) ;
}


////////////////////////////////////////////////////////////////////////
////
////                  wedding_ajax_read_todolist ajax call function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_read_todolist() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_read_todolist', 'wedding_ajax_read_todolist' );
add_action( 'wp_ajax_wedding_ajax_read_todolist', 'wedding_ajax_read_todolist' );  

function wedding_ajax_read_todolist()
{
	global $current_user,$wpdb;;
	wp_get_current_user();
	$userid     = $current_user->ID;	
	$itemid 	= $_POST['itemid'];

    $todolist_table = $wpdb->prefix."todolist";

	$wpdb->update( 
		$todolist_table, 
		array( 
			'todo_read' => 1	// integer (number) 
		), 
		array( 'todo_id' => $itemid ), 
		array( 
			'%s'	// value1
		), 
		array( '%s' ) 
	);

	if(function_exists('get_couple_todolist_link'))
	{
		$get_couple_todolist_link=get_couple_todolist_link();
	}
	
	echo json_encode(array('todo_url'=>$get_couple_todolist_link['url']));
	die();
}

////////////////////////////////////////////////////////////////////////
////
////                  wedding_ajax_unread_todolist ajax call function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_unread_todolist() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_unread_todolist', 'wedding_ajax_unread_todolist' );
add_action( 'wp_ajax_wedding_ajax_unread_todolist', 'wedding_ajax_unread_todolist' );  

function wedding_ajax_unread_todolist()
{
	global $current_user,$wpdb;;
	wp_get_current_user();
	$userid     = $current_user->ID;	
	$itemid 	= $_POST['itemid'];

    $todolist_table = $wpdb->prefix."todolist";

	$wpdb->update( 
		$todolist_table, 
		array( 
			'todo_read' => 0	// integer (number) 
		), 
		array( 'todo_id' => $itemid ), 
		array( 
			'%s'	
		), 
		array( '%s' ) 
	);

	if(function_exists('get_couple_todolist_link'))
	{
		$get_couple_todolist_link=get_couple_todolist_link();
	}
	
	echo json_encode(array('todo_url'=>$get_couple_todolist_link['url']));	
	die();
}


////////////////////////////////////////////////////////////////////////
////
////                  wedding_ajax_unread_todolist ajax call function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_delete_todolist() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_delete_todolist', 'wedding_ajax_delete_todolist' );
add_action( 'wp_ajax_wedding_ajax_delete_todolist', 'wedding_ajax_delete_todolist' );  

function wedding_ajax_delete_todolist()
{
	global $current_user,$wpdb;;
	wp_get_current_user();
	$userid     = $current_user->ID;	
	$itemid 	= $_POST['itemid'];

    $todolist_table = $wpdb->prefix."todolist";

	$wpdb->delete( $todolist_table, array( 'todo_id' => $itemid,'todo_user' => $userid ), array( '%s','%s' ) );	

	if(function_exists('get_couple_todolist_link'))
	{
		$get_couple_todolist_link=get_couple_todolist_link();
	}
	
	echo json_encode(array('todo_url'=>$get_couple_todolist_link['url']));	
	die();
}


////////////////////////////////////////////////////////////////////////
////
////                  wedding_ajax_unread_budget ajax call function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_delete_budget() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_delete_budget', 'wedding_ajax_delete_budget' );
add_action( 'wp_ajax_wedding_ajax_delete_budget', 'wedding_ajax_delete_budget' );  

function wedding_ajax_delete_budget()
{
	global $current_user,$wpdb;;
	wp_get_current_user();
	$userid     = $current_user->ID;	
	$itemid 	= $_POST['itemid'];

    $budget_category_table = $wpdb->prefix."budget_category";
	$budget_list_table = $wpdb->prefix."budget_list";

	$wpdb->delete( $budget_category_table, array( 'category_id' => $itemid,'category_user_id' => $userid ), array( '%s','%s' ) );
	$wpdb->delete( $budget_list_table, array( 'budget_list_category_id' => $itemid,'budget_list_user_id' => $userid ), array( '%s','%s' ) );	

	if(function_exists('get_couple_budget_link'))
	{
		$get_couple_budget_link=get_couple_budget_link();
	}
	
	echo json_encode(array('budget_url'=>$get_couple_budget_link['url']));	
	die();
}

////////////////////////////////////////////////////////////////////////
////
////                  wedding_ajax_unread_budget ajax call function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_delete_budget_list() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_delete_budget_list', 'wedding_ajax_delete_budget_list' );
add_action( 'wp_ajax_wedding_ajax_delete_budget_list', 'wedding_ajax_delete_budget_list' );  

function wedding_ajax_delete_budget_list()
{
	global $current_user,$wpdb;;
	wp_get_current_user();
	$userid     = $current_user->ID;	
	$itemid 	= $_POST['itemid'];

	$budget_list_table = $wpdb->prefix."budget_list";

	$wpdb->delete( $budget_list_table, array( 'budget_list_id' => $itemid,'budget_list_user_id' => $userid ), array( '%s','%s' ) );	

	if(function_exists('get_couple_budget_link'))
	{
		$get_couple_budget_link=get_couple_budget_link();
	}
	
	echo json_encode(array('budget_url'=>$get_couple_budget_link['url']));	
	die();
}
////////////////////////////////////////////////////////////////////////
////
////                  wedding_ajax_main_filter ajax call function 
////
////////////////////////////////////////////////////////////////////////

// Enable the user with privileges to run wedding_ajax_main_filter() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_main_filter', 'wedding_ajax_main_filter' );
add_action( 'wp_ajax_wedding_ajax_main_filter', 'wedding_ajax_main_filter' );  

function wedding_ajax_main_filter()
{
	$capacity 				= $meta_query= array();
	$category_type_array	= '';
	$city_array				= '';
	$min_price 				= '';
	$max_price				= '';
	$price					= '';
	$currency_code			= tg_get_option('currency_symbols');

	if (isset($_POST['category_type']) && $_POST['category_type'] != '') {
		$taxcity[]  = sanitize_title ( $_POST['category_type'] );
		$category_type_array = array(
			'taxonomy'  => 'itemcategory',
			'field'     => 'id',
			'terms'     => $taxcity
		);
	}

	if (isset($_POST['city']) && $_POST['city'] != '') {
		$city[]  = sanitize_title ( $_POST['city'] );
		$city_array = array(
			'taxonomy'  => 'itemcity',
			'field'     => 'id',
			'terms'     => $city
		);
	}	
		
	if( isset($_POST['min_price'])){
		$min_price = intval($_POST['min_price']);
	}	

	if( isset($_POST['max_price'])  && is_numeric($_POST['max_price']) ){
		$max_price          = intval($_POST['max_price']);
		$price['key']       = 'item_price';
		$price['value']     = array($min_price, $max_price);
		$price['type']      = 'numeric';
		$price['compare']   = 'BETWEEN';
		$meta_query[]       = $price;
	}	

	if (isset($_POST['capacity']) && !empty($_POST['capacity'])) {
		$capacity['key'] 	= 'item_capacity';
		$capacity['value'] 	= $_POST['capacity'];
		$meta_query[] 		= $capacity;
	}	
	
	$per_page=tg_get_option('items_per_page');	
	$paged=$_POST['page_no'];
	$list_style=$_POST['list_style'];

	$args = array( 'post_type' => 'item', 
					'posts_per_page' => $per_page,
					'post_status'       => 'publish',
					'orderby' => 'menu_order ID',
					'order'   => 'DESC',
					'paged' => $paged,
					'meta_query'       => $meta_query,
					'tax_query' => array(
						'relation' => 'AND',
						$category_type_array,
						$city_array,
					),						
					 );
					 
	$item = new WP_Query( $args );

	$html='<div class="row">';	
	$total_element=$item->found_posts;
	$html.='<div class="col-md-12 vendor-listing">
			  <h2>'.esc_html('Total ','weddingvendor').' '.$total_element.' '.esc_html('items in your search','weddingvendor').'</h2>
			</div>';

	$i=0;
	$k=1;

	while ( $item->have_posts() ) : $item->the_post();

	$post_id			= get_the_ID();

	$item_address 		= get_post_meta( $post_id, 'item_address', true );
	$featured_img 		= wp_get_attachment_image_src( get_post_thumbnail_id($post_id),'weddingvendor_item_thumb',false );
	$item_price 		= get_post_meta($post_id, 'item_price', true );
	$item_maxprice 		= get_post_meta( $post_id, 'item_maxprice', true );

	$itemcity    		= get_the_terms($post_id, 'itemcity');
	if(!empty($itemcity))
	{
		$cityname = $itemcity[0]->name;	
	}
	else{
		$cityname = '';
	}	

	$address_html		= wedding_item_address_html($cityname);
	$item_price_html	= wedding_item_price_html($item_price,$item_maxprice,$currency_code);

	$i++;	
	if($list_style=='3grid')
	{
		$html.='<div class="col-md-4 vendor-box">
			  <div class="vendor-image"> 
				<a href="'.get_permalink($post_id).'"><img src="'.$featured_img[0].'" alt=""  /></a>
				'.wedding_wishlist_item_html($post_id).'
			  </div>
			  <div class="vendor-detail">
				<div class="caption">
				  <h2><a href="'.get_permalink($post_id).'" class="title">'.get_the_title().'</a></h2>'.$address_html.'
				</div>'.$item_price_html.'
			  </div>
			</div>';
	}
	else if($list_style=='bubba')
	{

		if($item_address)
		{
			$address_html = '<p>'.esc_html($item_address).'</p>';
		}
		$html.='<div class="col-md-4 vendor-box">
				<div class="grid">
				  <figure class="effect-bubba"> 
				  '.wedding_wishlist_item_html($post_id).'
					<img src="'.$featured_img[0].'" alt="" class="img-responsive"  />
					<a href="'.get_permalink($post_id).'">
					<figcaption>
					  <h2>'.get_the_title().'</h2>'.$address_html.'
					</figcaption>
					</a>
				  </figure>
				</div>
			  </div>';
	}
	else if($list_style=='oscar')
	{
		if($item_address)
		{
			$address_html = '<p>'.esc_html($item_address).'</p>';
		}
		$html.='<div class="col-md-4 vendor-box">
				<div class="grid">
				  <figure class="effect-oscar">
				  '.wedding_wishlist_item_html($post_id).' 
					<img src="'.$featured_img[0].'" alt="" class="img-responsive"  />
				   
					<figcaption>
					  <h2>'.get_the_title().'</h2>'.$address_html.'
					   <a href="'.get_permalink($post_id).'">View More</a>
					</figcaption>
					
				  </figure>
				</div>
			  </div>';
	}
	else {
		$html.='<div class="col-md-4 vendor-box">
			  <div class="vendor-image"> 
				<a href="'.get_permalink($post_id).'"><img src="'.esc_url($featured_img[0]).'" alt=""  /></a>
				'.wedding_wishlist_item_html($post_id).'
			  </div>
			  <div class="vendor-detail">
				<div class="caption">
				  <h2><a href="'.get_permalink($post_id).'" class="title">'.get_the_title().'</a></h2>'.$address_html.'
				</div>'.$item_price_html.'
			  </div>
			</div>';
	}
	
	if(($k%3)==0  && $k<count($item->posts))
	{
		$html.='</div><div class="row">';
	}
	$k++;
	endwhile; 		
	wp_reset_postdata();

	
	$paginaiton_html='';
	$end=ceil($total_element/$per_page);
	for($i=1;$i<=$end;$i++)
	{
		if($i == $paged )
		{
			$class = "active";
			$calltofunction='';
		}
		else{
			$class = "";
			$calltofunction='onclick="simple_paging_item('.$i.')"';
		}
		
		$paginaiton_html.='<li class="'.$class.'"  title='.$i.' id="paging_'.$i.'" ><a href="javascript:void(0)" '.$calltofunction.' >'.$i.'</a></li>';		
	}
	
	$html.='<div class="col-md-12 tp-pagination"><ul class="pagination">'.$paginaiton_html.'</ul></div>';

	$html.='</div>';
				 
	echo json_encode(array('html_result'=>$html));
	die();	 	
}


////////////////////////////////////////////////////////////////////////
////
////               wedding_ajax_credit_card_payment ajax call function 
////
////////////////////////////////////////////////////////////////////////


// Enable the user with privileges to run wedding_ajax_credit_card_payment() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_credit_card_payment', 'wedding_ajax_credit_card_payment' );
add_action( 'wp_ajax_wedding_ajax_credit_card_payment', 'wedding_ajax_credit_card_payment' );  


function wedding_ajax_credit_card_payment()
{
	global $current_user,$post;
	wp_get_current_user();
	$allowed_html   			=   array();
	$userID         			=   $current_user->ID;    

	// Paypal API Varialbe	
	$API_USERNAME 	=  	tg_get_option('payment_paypal_api_username');
	$API_PASSWORD 	= 	tg_get_option('payment_paypal_api_password');
	$API_SIGNATURE 	=	tg_get_option('payment_paypal_api_signature');

	check_ajax_referer( 'ajax-credit-card-payment-nonce', 'security' );

	$full_name = $_POST['full_name'];
	$name = explode(' ', $full_name);
	if(count($name)!=1)
	{
		$first_name = $name[0];
		$last_name = $name[1];
	}
	else{
		$first_name = $full_name;
		$last_name = '';
	}

	$creditCardType 	= $_POST['card_type'];
	$creditCardNumber 	= $_POST['card_no'];


	$package_items 		= get_post_meta( $_POST['pay_package'], 'package_items', true );
	$package_price 		= get_post_meta( $_POST['pay_package'], 'package_price', true );
	
	$user_period 		= get_post_meta( $_POST['pay_package'], 'package_period', true );	

	$ItemName 			= get_the_title($_POST['pay_package']); //Item Name
		
	$amount 			= floatval($package_price);
	$card_expire_month 	= $_POST['card_expired_month'];
	$card_expire_yr 	= $_POST['card_expired_year'];
	$card_verfi_no 		= $_POST['card_cvv'];//CVV
	$address 			= $_POST['card_address'];
	$city 				= $_POST['card_city'];
	$state 				= $_POST['card_state'];
	$zip_code 			= $_POST['card_zip'];

	$currencyCode 		= tg_get_option('payment_paypal_api_currency_code');
	$paymentAction 		= "Sale";
	$methodToCall 		= 'doDirectPayment';
	
	$nvpstr='&PAYMENTACTION='.$paymentAction.'&AMT='.$amount.'&CREDITCARDTYPE='.$creditCardType.'&ACCT='.$creditCardNumber.'&EXPDATE='.$card_expire_month.$card_expire_yr.'&CVV2='.$card_verfi_no.'&FIRSTNAME='.$first_name.'&LASTNAME='.$last_name.'&STREET='.$address.'&CITY='.$city.'&STATE='.$state.'&ZIP='.$zip_code.'&COUNTRYCODE=US&CURRENCYCODE='.$currencyCode;
	
	$paypalPro = new Wedding_Paypal_Pro($API_USERNAME, $API_PASSWORD, $API_SIGNATURE, '', '', FALSE, FALSE );
	$resArray = $paypalPro->wedding_paypal_pro_call($methodToCall,$nvpstr);
	
	$ack = strtoupper($resArray["ACK"]);
	
	//if payment done successfully
	if($ack == "SUCCESS")
	{
		$cur_date		=	date('Y-m-d');	
		$user_items 	= 	get_the_author_meta( 'user_items' , $userID );

		update_user_meta( $userID, 'user_items', $package_items ) ;
		update_user_meta( $userID, 'user_member_status', 'Paid' ) ;
		update_user_meta( $userID, 'user_payment_date', $cur_date ) ;
		update_user_meta( $userID, 'user_payment_amount', $amount ) ;
		
		$user_payment_expired_date  	= 	get_the_author_meta( 'user_payment_expired_date' , $userID );
		

		wedding_package_expired_period($userID,$user_items,$package_items,$user_payment_expired_date,$user_period);

		$user = new WP_User( $userID );
		$user_email = stripslashes( $user->user_email );		

		$message['payer_email']		=	$user_email;
		$message['payer_plan']		=	$ItemName;
		$message['payer_listing']	=	$package_items;				
		
		if ( ! is_null( $package_price ) ) {
		  $message['payer_amount']	=	number_format( $package_price, 2, '.', '' );
        }
		
		$message['payer_status']	=	esc_html__('Successfully Payment','weddingvendor');	
					
		wedding_payment_user_notification($userID,$message);				

		$args = array(
			   'post_type' 		=> 'item',
			   'author'    		=> $userID,
			   'post_status'   	=> 'expired' 
		);
		$item = new WP_Query( $args );
		while ( $item->have_posts() ) { $item->the_post();
			$prop = array(
					'ID'            => $post->ID,
					'post_type'     => 'item',
					'author'    	=> $userID,
					'post_status'   => 'publish'
			);
		   
			wp_update_post($prop ); 
		}	
		wp_reset_query();
		
		echo '<div class="alert alert-success" role="alert"><button aria-label="Close" data-dismiss="alert" class="close" type="button">
					<span aria-hidden="true">&times;</span>
				</button>'.esc_html__('Your payment has been received successfully.','weddingvendor').'!<br />'.esc_html__('Note your transaction ID for future reference','weddingvendor').' == '.$resArray["TRANSACTIONID"].'</div>';
	}
	else
	{
		echo '<div class="alert alert-warning" role="alert"><button aria-label="Close" data-dismiss="alert" class="close" type="button">
			<span aria-hidden="true">&times;</span>
		</button>'.esc_html__('Fail.Please try again or contact administrator.','weddingvendor').'</div>';
	}
	die();    	
}


////////////////////////////////////////////////////////////////////////
////
////               wedding_ajax_paypal_payment ajax call function 
////
////////////////////////////////////////////////////////////////////////


// Enable the user with privileges to run wedding_ajax_paypal_payment() in AJAX
add_action( 'wp_ajax_nopriv_wedding_ajax_paypal_payment', 'wedding_ajax_paypal_payment' );
add_action( 'wp_ajax_wedding_ajax_paypal_payment', 'wedding_ajax_paypal_payment' );  
function wedding_ajax_paypal_payment(){

	global $current_user;
	wp_get_current_user();
	$allowed_html   		= array();
	$userID         		= $current_user->ID;    

	check_ajax_referer( 'ajax-credit-card-payment-nonce', 'security' );

	$dashboard_link 		= get_dashboard_link();
	$paypal_api_mode 		= tg_get_option('payment_paypal_api_mode');

	if(isset($paypal_api_mode) && !empty($paypal_api_mode))
	{
		$PayPalMode 		= 'sandbox'; // sandbox or live
	}
	else{
		$PayPalMode 		= 'live'; // sandbox or live		
	}

	$PayPalApiUsername 		= tg_get_option('payment_paypal_api_username'); //PayPal API Username
	$PayPalApiPassword 		= tg_get_option('payment_paypal_api_password'); //Paypal API password
	$PayPalApiSignature 	= tg_get_option('payment_paypal_api_signature'); //Paypal API Signature
	$PayPalCurrencyCode 	= tg_get_option('payment_paypal_api_currency_code'); //Paypal Currency Code
	$PayPalReturnURL 		= $dashboard_link['url']; //Point to process.php page
	$PayPalCancelURL 		= esc_url(home_url()); //Cancel URL if user clicks cancel

	$_SESSION['package_id'] = $_POST['pay_package'];

	$package_items 			= get_post_meta( $_POST['pay_package'], 'package_items', true );
	$package_price 			= get_post_meta( $_POST['pay_package'], 'package_price', true );	

	 //Post Data received from product list page.

    $ItemName 				= get_the_title($_POST['pay_package']); //Item Name
    $ItemPrice				= $package_price; //Item Price
    $ItemQty 				= 1; // Item Quantity
    $ItemTotalPrice 		= ($ItemPrice * $ItemQty); //(Item Price x Quantity = Total) Get total amount of product; 
    $GrandTotal 			= $ItemTotalPrice; // $ItemTotalPrice 

    //Parameters for SetExpressCheckout, which will be sent to PayPal
    $padata = '&METHOD=SetExpressCheckout' .
            '&RETURNURL=' . urlencode($PayPalReturnURL) .
            '&CANCELURL=' . urlencode($PayPalCancelURL) .
            '&PAYMENTREQUEST_0_PAYMENTACTION=' . urlencode("SALE") .
            '&L_PAYMENTREQUEST_0_NAME0=' . urlencode($ItemName) .
            //'&L_PAYMENTREQUEST_0_NUMBER0='.urlencode($ItemNumber).
            //'&L_PAYMENTREQUEST_0_DESC0='.urlencode($ItemDesc).
            '&L_PAYMENTREQUEST_0_AMT0=' . urlencode($ItemPrice) .
            '&L_PAYMENTREQUEST_0_QTY0=' . urlencode($ItemQty) .

            '&NOSHIPPING=1' . //set 1 to hide buyer's shipping address, in-case products that does not require shipping

            '&PAYMENTREQUEST_0_ITEMAMT=' . urlencode($ItemTotalPrice) .
            '&PAYMENTREQUEST_0_AMT=' . urlencode($GrandTotal) .
            '&PAYMENTREQUEST_0_CURRENCYCODE=' . urlencode($PayPalCurrencyCode) .
            '&LOCALECODE=GB' . //PayPal pages to match the language on your website.
            '&LOGOIMG=' .tg_get_option('logo'). //site logo
            '&CARTBORDERCOLOR=FFFFFF' . //border color of cart
            '&ALLOWNOTE=1';

    //We need to execute the "SetExpressCheckOut" method to obtain paypal token
    $paypal = new Wedding_Paypal();
    $httpParsedResponseAr = $paypal->wedding_paypal_http_post('SetExpressCheckout', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);


    //Respond according to message we receive from Paypal
    if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {

		$paypalmode = ($PayPalMode=='sandbox') ? '.sandbox' : '';
        //Redirect user to PayPal store with Token received.
        $paypalurl = 'https://www'.$paypalmode.'.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token='.$httpParsedResponseAr["TOKEN"] ;
		echo '<script> window.setTimeout(function () {	location.href = "'.$paypalurl.'";	}, 500);</script>';			
		exit;
	} else {
        //Show error message
        echo '<div class="alert alert-danger"><strong>'.esc_html__('Error','weddingvendor').':</strong>' . urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]) . '</div>';
		exit;
   }
}

////////////////////////////////////////////////////////////////////////////////
/// Payment notification
////////////////////////////////////////////////////////////////////////////////

if( !function_exists('wedding_payment_user_notification') ):

function wedding_payment_user_notification( $user_id,$body) {
	
		$user = new WP_User( $user_id );
		$currency_code=tg_get_option('currency_symbols');

		$user_login = stripslashes( $user->user_login );
		$user_email = stripslashes( $user->user_email );
		
		$payer_email 	=	$body['payer_email'];
		$payer_plan 	=	$body['payer_plan'];
		$payer_listing 	=	$body['payer_listing'];
		$payer_amount 	=	$body['payer_amount'];
		$payer_status 	=	$body['payer_status'];				

		$message  = sprintf( __('Payment Notification on %s:','weddingvendor'), get_option('blogname')) . "\r\n\r\n";
		$message .= sprintf( __('Username:     	%s','weddingvendor'), $user_login ) . "\r\n";
		$message .= sprintf( __('E-mail:    	%s','weddingvendor'), $user_email ) . "\r\n";
		$message .= sprintf( __('Payer E-mail: 	%s','weddingvendor'), $payer_email ) . "\r\n";
		$message .= sprintf( __('Plan Name: 	%s','weddingvendor'), $payer_plan ) . "\r\n";
		$message .= sprintf( __('Plan Price: 	%s','weddingvendor'), $currency_code.$payer_amount ) . "\r\n";		
		$message .= sprintf( __('Plan Listing: 	%s','weddingvendor'), $payer_listing ) . "\r\n";
		$message .= sprintf( __('Status: %s','weddingvendor'), $payer_status ) . "\r\n";		
		$headers = 'From: noreply  <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n".
				'Reply-To: noreply@'.$_SERVER['HTTP_HOST']."\r\n" .
				'X-Mailer: PHP/' . phpversion();
				
		// Email to administrator 		
		@wp_mail(
			get_option('admin_email'),
			sprintf(__('[%s] User Payment Notification','weddingvendor'), get_option('blogname') ),
			$message,
                        $headers
		);

		$message  = __('Hi,','weddingvendor') . "\r\n\r\n";
		$message .= sprintf( __("Welcome to %s! Thanks for your payment and your payment plan information as below: ",'weddingvendor'), get_option('blogname')) . "\r\n\r\n";

		$message .= sprintf( __('Username:     	%s','weddingvendor'), $user_login ) . "\r\n";
		$message .= sprintf( __('E-mail:    	%s','weddingvendor'), $user_email ) . "\r\n";
		$message .= sprintf( __('Payer E-mail: 	%s','weddingvendor'), $payer_email ) . "\r\n";
		$message .= sprintf( __('Plan Name: 	%s','weddingvendor'), $payer_plan ) . "\r\n";
		$message .= sprintf( __('Plan Price: 	%s','weddingvendor'), $currency_code.$payer_amount ) . "\r\n";		
		$message .= sprintf( __('Plan Listing: 	%s','weddingvendor'), $payer_listing ) . "\r\n";
		
		$message .= sprintf( __('If you have any problems, please contact us at %s.','weddingvendor'), get_option('admin_email') ) . "\r\n\r\n";
		$message .= __('Thank you!','weddingvendor');
                $headers = 'From: noreply  <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n".
                        'Reply-To: noreply@'.$_SERVER['HTTP_HOST']. "\r\n" .
        
		                'X-Mailer: PHP/' . phpversion();
						
		// Email to user
		wp_mail(
			$user_email,
			sprintf( __('[%s] Payment Notification','weddingvendor'), get_option('blogname') ),
			$message,
                        $headers
		);
	}
        
endif; // end   wedding_payment_user_notification

/*add_filter( 'wp_mail_content_type', function( $content_type ) {
	return 'text/html';
}); */
