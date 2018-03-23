<?php 
/**
 * Template Name: Package
 */


get_header();

if (is_user_logged_in() ) {

get_template_part( 'template-parts/user/dashboard', 'menu' );

$currentYear = date("Y");
$currency_code=tg_get_option('currency_symbols');
?>
<div class="main-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      	<div class="row">
        <?php 
		$args 		= array( 'post_type' => 'package', 
							'posts_per_page' => -1,
							'post_status'  => 'publish',
							'orderby' => 'menu_order ID',
							'order'   => 'ASC');
		$package 	= new WP_Query( $args );
		while ( $package->have_posts() ) : $package->the_post();
		
		$package_items 	= get_post_meta( $post->ID, 'package_items', true );
		$package_price 	= get_post_meta( $post->ID, 'package_price', true );
		$package_period = get_post_meta( $post->ID, 'package_period', true );		
		?>
        <div class="col-md-4 pricing-box pricing-box-regualr">
        <div class="well-box">
          <h2 class="price-title"><?php the_title(); ?></h2>
          <h1 class="price-plan"><span class="dollor-sign"><?php echo $currency_code;?></span><?php echo $package_price; ?><span class="permonth">/
		  
		  <?php 
		  if(isset($package_period) && !empty($package_period))
		  {
			  echo $package_period;
		  }
		  else{
			  esc_html_e('Year','weddingvendor'); 
		  }
		  ?></span></h1>
          
          <a href="javascript:void(0)" class="btn tp-btn-default pricing-btn" id="pricing_<?php echo $post->ID; ?>" onclick="javascript:pricing('<?php echo $post->ID; ?>')"><?php esc_html_e('Select Plan','weddingvendor');?></a> </div>
            <ul class="check-circle list-group listnone">
              <li class="list-group-item"><?php echo $package_items." "; esc_html_e('Listing','weddingvendor');?></li>
            </ul>
      </div>
        <?php 
		endwhile; 		
		wp_reset_postdata();
		?>	        
        </div>
      </div>
      <div class="col-md-12" id="payment_option_box">
      		<div class="row">
            	<div class="col-md-3">
                	<div class="paypal_pack" id="paypal_pack"></div>   
                </div>
                <div class="col-md-1">
                     <h1 class="text-center mt30"><?php esc_html_e('OR','weddingvendor'); ?></h1>   
                </div>
                <div class="col-md-8">
                	<div class="mb30 mt10">
                	<img src="<?php echo get_template_directory_uri(); ?>/images/credit_card.png" class="img-responsive" alt="" />
                	</div>
                    <form id="payment_box" class="ajax-auth" method="post">
                    <div id="payment_box_new">
                    <div class="status"></div>
                    <?php wp_nonce_field('ajax-credit-card-payment-nonce', 'security'); ?>
                     <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                            <label for="card_no" class="control-label"><?php esc_html_e('Credit Card','weddingvendor');?><span class="required">*</span></label>
                            <input type="text" name="card_no" id="card_no" class="form-control input-md" minlength="15" maxlength="18" required />
                        </div>	
                        </div>
                        <div class="col-md-4">	
                             <label for="card_no" class="control-label"><?php esc_html_e('Credit Type','weddingvendor');?></label>
                            <select name="card_type" id="card_type" class="form-control selectpicker">
                                <option value="Mastercard"><?php esc_html_e('Mastercard','weddingvendor');?></option>
                                <option value="Visa"><?php esc_html_e('Visa','weddingvendor');?></option>
                                <option value="Amex"><?php esc_html_e('American Express','weddingvendor');?></option>
                                <option value="Discover"><?php esc_html_e('Discover','weddingvendor');?></option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                    <div class="col-md-8">	
                        <div class="form-group">
                        <label for="email" class="control-label"><?php esc_html_e('Expiration Date','weddingvendor');?><span class="required">*</span></label>
                        <div class="row">
                            <div class="col-md-6">
                                <select name="expired_month" id="expired_month" class="form-control selectpicker" >
                                <?php
								for($iM =1;$iM<=12;$iM++){
										echo '<option value="'.str_pad($iM, 2, "0", STR_PAD_LEFT).'">'.date("F", strtotime("$iM/12/10")).'</option>';
								}
								?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="expired_year" id="expired_year" class="form-control selectpicker" >
                                    <?php 
                                    $i = $currentYear;
                                    while ($i <= ($currentYear+20)) // this gives you twenty years in the future
                                    {
										echo '<option value="'.$i.'">'.$i.'</option>';
	                                    $i++;
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label for="card_cvv" class="control-label"><?php esc_html_e('CVV','weddingvendor');?><span class="required">*</span></label>
                        <input type="text" name="card_cvv" id="card_cvv" class="form-control input-md" minlength="3" required  />
                    </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="full_name" class="control-label"><?php esc_html_e('Full Name','weddingvendor');?><span class="required">*</span></label>
                        <input type="text" name="full_name" id="full_name" class="form-control input-md" minlength="6" required />
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label"><?php esc_html_e('Address','weddingvendor');?><span class="required">*</span></label>
                        <input type="text" name="address" id="address" class="form-control input-md"  minlength="10" required  />
                    </div>  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                        <label for="city" class="control-label"><?php esc_html_e('City','weddingvendor');?><span class="required">*</span></label>
                        <input type="text" name="city" id="city" class="form-control input-md"  required />
                    </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="state" class="control-label"><?php esc_html_e('State','weddingvendor');?><span class="required">*</span></label>
                                <input type="text" name="state" id="state"  class="form-control input-md" minlength="4" required />
                            </div>
                        </div>
                        
                    </div>
        
                    <div class="form-group">
                        <label for="zip" class="control-label"><?php esc_html_e('Zip','weddingvendor');?><span class="required">*</span></label>
                        <input type="text" name="zip" id="zip" class="form-control input-md" minlength="4" required />
                    </div>     
                        <input type="hidden" id="pay_package" name="pay_package"  />
                        <input type="submit" name="card_payment" id="card_payment" class="btn tp-btn-default" value="<?php esc_html_e('Pay','weddingvendor');?>" />
                    </div>
            		</form>
                </div>
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