<?php 
$post_author_id 		= get_post_field( 'post_author', $post->ID );
$user_email 			= get_the_author_meta( 'user_email', $post_author_id);
?>
<div class="col-md-12" >
    <div class="well-box" id="inquiry">
      <h2><?php esc_html_e('Send inquiry to vendor','weddingvendor'); ?></h2>
      <p><?php esc_html_e('Fill in your details and the vendor will get back to you shortly.','weddingvendor'); ?></p>
      <form class="ajax-auth" id="book-now-box" method="post">
        <?php wp_nonce_field('ajax-vendor-send-me', 'security'); ?>
    
        <!-- Text input-->
        <div class="form-group">
          <label class="control-label" for="name"><?php esc_html_e('Name','weddingvendor'); ?>:<span class="required">*</span></label>
          <div class="">
            <input id="name" name="name" type="text" minlength="6" placeholder="<?php esc_html_e('Name','weddingvendor'); ?>" class="form-control input-md" required>
          </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="control-label" for="phone"><?php esc_html_e('Phone','weddingvendor'); ?>:<span class="required">*</span></label>
          <div class="">
            <input id="phone" name="phone" type="text" minlength="10" minlength="12"  placeholder="<?php esc_html_e('Phone','weddingvendor'); ?>" class="form-control input-md" required >
            <span class="help-block"> </span> </div>
        </div>
        
        <!-- Text input-->
        <div class="form-group">
          <label class="control-label" for="email"><?php esc_html_e('Email','weddingvendor'); ?>:<span class="required">*</span></label>
          <div class="">
            <input id="email" name="email" type="email" placeholder="<?php esc_html_e('Email','weddingvendor'); ?>" class="form-control input-md" required>
          </div>
        </div>
        
        <!-- Select Basic -->
        <!-- Text input-->
        <div class="form-group">
          <label class="control-label" for="date"><?php esc_html_e('Date','weddingvendor'); ?>:<span class="required">*</span></label>
          <div class="">
            <input id="date" name="date" type="text" readonly="readonly" placeholder="<?php esc_html_e('Select Date','weddingvendor'); ?>" class="form-control input-md check_book_date book_date" required>
          </div>
        </div>                
        <div class="form-group">
          <label class="control-label" for="guest"><?php esc_html_e('Number of Guests','weddingvendor'); ?>:<span class="required">*</span></label>
          <div class="">
            <select id="guest" name="guest" class="form-control">
              <option value="1 to 50">1 to 50</option>
              <option value="51 to 100">51 to 100</option>
              <option value="101 to 200">101 to 200</option>
              <option value="201 to 500">201 to 500</option>
              <option value="501 to more">501 to more</option>
            </select>
            <input type="hidden" id="user_email_id" value="<?php echo $user_email;?>"  />
          </div>
        </div>
        <!-- Multiple Radios -->
        <div class="form-group">
          <label class="control-label"><?php esc_html_e('Send me info via','weddingvendor'); ?></label>
          <div class="checkbox checkbox-success">
            <input type="checkbox" name="sendme" id="checkbox-0" value="Email"   class="styled">
            <label for="checkbox-0" class="control-label"><?php esc_html_e('Email','weddingvendor'); ?></label>
          </div>
          <div class="checkbox checkbox-success">
            <input type="checkbox" name="sendme" id="checkbox-1" value="Call" class="styled" >
            <label for="checkbox-1" class="control-label"> <?php esc_html_e('Need Call back','weddingvendor'); ?> </label>
          </div>
        </div>
        <div class="form-group">
          <input type="submit" name="book-now-on" id="book-now-on" value="<?php esc_html_e('Inquire now','weddingvendor'); ?>" class="btn tp-btn-default tp-btn-lg btn-block" />
        </div>
       <div class="status"></div>
      </form>
    </div>
</div>