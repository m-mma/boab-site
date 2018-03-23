<?php 
/**
 * Template Name: Dashboard
 */
get_header();
if (is_user_logged_in() ) {

global $current_user,$post;
wp_get_current_user();
$userID          = $current_user->ID;	

get_template_part( 'template-parts/user/dashboard', 'menu' );

$free_listing_validity  = tg_get_option('free_listing_validity'); 
?>
<div class="main-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
	<?php
    //Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
    if (isset($_GET["token"]) && isset($_GET["PayerID"]) && isset($_SESSION['package_id'])) {
        //we will be using these two variables to execute the "DoExpressCheckoutPayment"
        //Note: we haven't received any payment yet.

	    $PayPalApiUsername 		= tg_get_option('payment_paypal_api_username'); //PayPal API Username
        $PayPalApiPassword 		= tg_get_option('payment_paypal_api_password'); //Paypal API password
        $PayPalApiSignature 	= tg_get_option('payment_paypal_api_signature'); //Paypal API Signature
        $PayPalCurrencyCode 	= tg_get_option('payment_paypal_api_currency_code'); //Paypal Currency Code

		$paypal_api_mode	 	= tg_get_option('payment_paypal_api_mode');
		
	
		if(isset($paypal_api_mode) && !empty($paypal_api_mode))
		{
			$PayPalMode 		= 'sandbox'; // sandbox or live
		}
		else{
			$PayPalMode 		= 'live'; // sandbox or live		
		}	
        
        $token = $_GET["token"];
        $payer_id = $_GET["PayerID"];
    
        //get session variables
        $ItemName = get_the_title($_SESSION['package_id']); //Item Name
        $ItemPrice = get_post_meta( $_SESSION['package_id'], 'package_price', true );; //Item Price
        $ItemQty = 1; // Item Quantity
        $ItemTotalPrice = ($ItemPrice * $ItemQty);; //(Item Price x Quantity = Total) Get total amount of product; 
    
        $GrandTotal = $ItemTotalPrice;
    
        $package_items = get_post_meta( $_SESSION['package_id'], 'package_items', true );	
	
        $padata = '&TOKEN=' . urlencode($token) .
                '&PAYERID=' . urlencode($payer_id) .
                '&PAYMENTREQUEST_0_PAYMENTACTION=' . urlencode("SALE") .
                //set item info here, otherwise we won't see product details later	
                '&L_PAYMENTREQUEST_0_NAME0=' . urlencode($ItemName) .
                //'&L_PAYMENTREQUEST_0_NUMBER0='.urlencode($ItemNumber).
                //'&L_PAYMENTREQUEST_0_DESC0='.urlencode($ItemDesc).
                '&L_PAYMENTREQUEST_0_AMT0=' . urlencode($ItemPrice) .
                //'&L_PAYMENTREQUEST_0_QTY0='. urlencode($ItemQty).
    
                '&PAYMENTREQUEST_0_ITEMAMT=' . urlencode($ItemTotalPrice) .
                '&PAYMENTREQUEST_0_AMT=' . urlencode($GrandTotal) .
                '&PAYMENTREQUEST_0_CURRENCYCODE=' . urlencode($PayPalCurrencyCode);
    
        //We need to execute the "DoExpressCheckoutPayment" at this point to Receive payment from user.
        $paypal = new Wedding_Paypal();
        $httpParsedResponseAr = $paypal->wedding_paypal_http_post('DoExpressCheckoutPayment', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);
    
        //Check if everything went ok..
        if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
            echo '<p>'.esc_html__('Note your transaction number for future reference','weddingvendor').'&nbsp;<strong>'.urldecode($httpParsedResponseAr["PAYMENTINFO_0_TRANSACTIONID"]).'</strong></p>';		
            /*
              //Sometimes Payment are kept pending even when transaction is complete.
              //hence we need to notify user about it and ask him manually approve the transiction
             */
    
            if ('Completed' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"]) {
				echo '<div class="alert alert-success" role="alert"><button aria-label="Close" data-dismiss="alert" class="close" type="button">
							<span aria-hidden="true">&times;</span>
						</button>'.esc_html__('Your payment has been receive successfully','weddingvendor').'</div>';
    
            } elseif ('Pending' == $httpParsedResponseAr["PAYMENTINFO_0_PAYMENTSTATUS"]) {
    
				echo '<div class="alert alert-danger" role="alert"><button aria-label="Close" data-dismiss="alert" class="close" type="button">
							<span aria-hidden="true">&times;</span>
						</button>'.esc_html__('Transaction Complete, but payment is still pending!','weddingvendor').' <br />
						'.esc_html__('You need to manually authorize this payment in your','weddingvendor').'<a target="_new" href="http://www.paypal.com">Paypal Account</a></div>';
    
            }
    
            // we can retrive transection details using either GetTransactionDetails or GetExpressCheckoutDetails
            // GetTransactionDetails requires a Transaction ID, and GetExpressCheckoutDetails requires Token returned by SetExpressCheckOut
            $padata = '&TOKEN=' . urlencode($token);
            $paypal = new Wedding_Paypal();
            $httpParsedResponseAr = $paypal->wedding_paypal_http_post('GetExpressCheckoutDetails', $padata, $PayPalApiUsername, $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);
    
            if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
    
				$package_price 		= 	get_post_meta( $_SESSION['package_id'], 'package_price', true );
				$user_period 		= 	get_post_meta( $_SESSION['package_id'], 'package_period', true );	
				$amount 			= 	floatval($package_price);		
				$cur_date			= 	date('Y-m-d');
				$user_items 		= 	get_the_author_meta( 'user_items' , $userID );
			
				update_user_meta( $userID, 'user_items', $package_items ) ;
				update_user_meta( $userID, 'user_member_status', 'Paid' ) ;
				update_user_meta( $userID, 'user_payment_date', $cur_date ) ;
				update_user_meta( $userID, 'user_payment_amount', $amount ) ;
				
		
				wedding_package_expired_period($userID,$user_items,$package_items,$user_payment_expired_date,$user_period);

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

				$message['payer_email']		=	urldecode($httpParsedResponseAr['EMAIL']);
				$message['payer_plan']		=	$ItemName;
				$message['payer_listing']	=	$package_items;				
				$message['payer_amount']	=	urldecode($httpParsedResponseAr['AMT']);
				$message['payer_status']	=	esc_html__('Successfully Payment','weddingvendor');	
							
				wedding_payment_user_notification($userID,$message);
            } else {

				$message['payer_email']		=	urldecode($httpParsedResponseAr['EMAIL']);
				$message['payer_plan']		=	$ItemName;
				$message['payer_listing']	=	$package_items;				
				$message['payer_amount']	=	urldecode($httpParsedResponseAr['AMT']);
				$message['payer_status']	=	esc_html__('Get Transaction Details Failed','weddingvendor');	
							
				wedding_payment_user_notification($userID,$message);				
                echo '<div <div class="alert alert-danger" role="alert"><strong>'.esc_html__('Get Transaction Details Failed','weddingvendor').':</strong>' . urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]) . '</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert"><strong>'.esc_html__('Error','weddingvendor').':</strong>' . 
			urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]) . '</div>';
        }
		unset($_SESSION['package_id']);
    }
    ?>            
        <h1><?php esc_html_e('Welcome back to ','weddingvendor'); echo $user_login; ?></h1>
        <p><?php esc_html_e('We are happy to have you back.','weddingvendor');?></p>
        <?php
		$user_payment_expired_date  	= 	get_the_author_meta( 'user_payment_expired_date' , $userID );
		$user_member_items 				= 	get_the_author_meta( 'user_items' , $userID );
		if(empty($user_member_items))
		{
			$user_member_items=tg_get_option('free_items');
		}
		
		$user_member_status 				= 	get_the_author_meta( 'user_member_status' , $userID );
        $args = array( 'post_type' => 'item','post_status' => 'publish','posts_per_page' => -1,'author'=> $userID );
        $item = new WP_Query( $args );
        $total_items=$item->found_posts;	
        ?>
        <div class="row">
        	<div class="col-md-4">
            	<div class="well-box text-center">
                	<h2><?php esc_html_e('Your Plan','weddingvendor');?>: 
                    <?php 
					if($free_listing_validity=="lifetime")
					{
						esc_html_e('Life Time','weddingvendor');
					}
					else{
						echo $user_member_status;
					}					
					?></h2>
                </div>
            </div>
        	<div class="col-md-8">
            	<div class="well-box text-center">
                	<h2><?php esc_html_e('Package Expiry Date','weddingvendor');?>: 
                    <?php
					if($free_listing_validity=="lifetime")
					{
						esc_html_e('Life Time Free','weddingvendor');
					}
					else if(!empty($user_payment_expired_date))
					{
						echo get_the_author_meta( 'user_payment_expired_date' , $userID );
					}
					else{
						esc_html_e('You are on a free plan','weddingvendor');
					}
					?></h2>
                </div>
            </div>
        	<div class="col-md-4">
            	<div class="well-box text-center">
                	<h1 class="package_number"><?php echo $user_member_items; ?></h1>
                	<h3 class="package_title"><?php esc_html_e('Total package Listing','weddingvendor');?></h3>
                </div>            	
            </div>
        	<div class="col-md-4">
            	<div class="well-box text-center">
                	<h1 class="package_number">
                    <?php			
					if($user_member_status=='Expired')
					{
						echo '-';
					}
					else if(intval($user_member_items) >= intval($total_items))
					{
						echo intval($user_member_items)-intval($total_items); 	
					}
					else{
						echo '-';						
					}
					?>
                    </h1>
                	<h3 class="package_title"><?php esc_html_e('Remaining Listing','weddingvendor');?></h3>
                </div>            	
            </div>
            <div class="col-md-4">
            	<div class="well-box text-center">
                	<h1 class="package_number"><?php echo $total_items; ?></h1>
                	<h3 class="package_title"><?php esc_html_e('Total Listing you use','weddingvendor');?></h3>
                </div>            	
            </div>            
            <?php 
			if(empty($user_payment_expired_date) && intval($user_member_items) == intval($total_items))
			{
				$package_price = package_price();
			?>
            <div class="col-md-12">
            	<div class="well-box text-center">
					<h1><?php esc_html_e('Free Listing Over','weddingvendor');?></h1>
                    <p><?php esc_html_e('Please select your required package plan','weddingvendor');?></p>
                    <a href="<?php echo $package_price['url'];?>" class="btn tp-btn-primary mt20 mb20"><?php echo $package_price['name']; ?></a>
                </div>
            </div>
            <?php 					
			}
			?>
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