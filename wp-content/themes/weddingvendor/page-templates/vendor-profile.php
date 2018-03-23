<?php 
/**
 * Template Name: Vendor Profile
 */


get_header();

global $current_user;
wp_get_current_user();

if(isset($_GET['userid']) && !empty($_GET['userid']))
{
	
$userID=$_GET['userid'];
$aux = get_userdata( $userID );

if($aux==true){

$currency_code	= tg_get_option('currency_symbols');

$first_name     = get_the_author_meta( 'first_name' , $userID );
$last_name      = get_the_author_meta( 'last_name' , $userID );
$user_email     = get_the_author_meta( 'user_email' , $userID );
$user_website   = get_the_author_meta( 'website' , $userID );

$phone       	= get_the_author_meta( 'phone' , $userID );
$address        = get_the_author_meta( 'address' , $userID );
$about_me       = get_the_author_meta( 'description' , $userID );

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

?>
<div class="vendor-page-header">
  <div class="vendor-profile-img"> </div>
  <div class="vendor-profile-info">
  <div class="container">
    <div class="row">
      <div class="col-md-3 hidden-xs"> 
        <div class="vendor-profile-block">
            <div class="vendor-profile"> <img src="<?php echo $user_custom_picture; ?>" alt="" class="img-responsive"> </div>
          </div>
        </div>
        <div class="col-md-9">
            <div class="profile-meta mb30">
            <div class="row">
              <div class="col-md-12">
                <h1 class="vendor-profile-title"><?php echo $first_name."&nbsp;&nbsp;".$last_name;?></h1>
              </div>
            </div>
            <div class="row">              
             <?php
			 if(!empty($address))
			 echo '<div class="col-md-4"><span class="meta-address"> <i class="fa fa-map-marker"></i> <span class="address">'.$address.'</span> </span> </div>';

			 if(!empty($user_email))
			 echo '<div class="col-md-4"><span class="meta-email"><i class="fa fa-envelope"></i><a href="mailto:'.$user_email.'">'.$user_email.'</a></span></div>';
			 
			 if(!empty($phone))
			 echo '<div class="col-md-4"><span class="meta-call"><i class="fa fa-phone"></i>'.$phone.'</span></div>';
			 ?>
            </div>
          </div>
          <div class="profile-meta">
            <div class="row">
             <?php
			 if(!empty($user_website))
			 echo '<div class="col-md-4"><span class="meta-website"><i class="fa fa-link"></i><a href="'.$user_website.'" target="_blank">'.$user_website.'</a></span></div>';
			 ?>
              
              <div class="col-md-6">
                <div class="vendor-profile-social"> <span>
                  <ul class="listnone">
				  <?php 
                  if(get_the_author_meta( 'facebook' , $userID,true ))
                  echo '<li><a href="'.esc_url(get_the_author_meta( 'facebook' , $userID )).'" target="_blank"><i class="fa fa-facebook-square"></i></a></li>';
                
                  if(get_the_author_meta( 'googleplus' , $userID ))
                  echo '<li><a href="'.esc_url(get_the_author_meta( 'googleplus' , $userID )).'" target="_blank"><i class="fa fa-google-plus-square"></i></a></li>';
                
                  if(get_the_author_meta( 'youtube' , $userID ))
                  echo '<li><a href="'.esc_url(get_the_author_meta( 'youtube' , $userID )).'" target="_blank"><i class="fa fa-youtube-square"></i></a></li>';
                
                  if(get_the_author_meta( 'linkedin' , $userID ))
                  echo '<li><a href="'.esc_url(get_the_author_meta( 'linkedin' , $userID )).'" target="_blank"><i class="fa fa-linkedin-square"></i></a></li>';
                
                  if(get_the_author_meta( 'twitter' , $userID ))
                  echo '<li><a href="'.esc_url(get_the_author_meta( 'twitter' , $userID )).'" target="_blank"><i class="fa fa-twitter-square"></i></a></li>';
                
                  if(get_the_author_meta( 'pinterest' , $userID ))
                  echo '<li><a href="'.esc_url(get_the_author_meta( 'pinterest' , $userID )).'" target="_blank"><i class="fa fa-pinterest-square"></i></a></li>';
				  
                  if(get_the_author_meta( 'instagram' , $userID ))
                  echo '<li><a href="'.esc_url(get_the_author_meta( 'instagram' , $userID )).'" target="_blank"><i class="fa fa-instagram"></i></a></li>';				  
                  ?>
                  </ul>
                  </span> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="main-container">
  <div class="container">
    <div class="row">
      <div class="venue-details">
        <div class="col-md-9">
          <div class="st-tabs"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active">
              <a href="#myListing" title="Gallery" aria-controls="myListing" role="tab" data-toggle="tab"> <i class="fa fa-list"></i><span class="tab-title">&nbsp;<?php esc_html_e('Vendor Listing','weddingvendor');?></span></a></li>
              <li role="presentation"> <a href="#about" title="about info" aria-controls="about" role="tab" data-toggle="tab"><i class="fa fa-info-circle"></i> <span class="tab-title"><?php esc_html_e('About Vendor','weddingvendor');?></span> </a> </li>
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content"><!-- tab content start-->
              <div role="tabpanel" class="tab-pane fade in active" id="myListing">
                 <div class="row">    
                    <?php         
					$k=1;
					$args = array( 'post_type' => 'item', 
									'post_status'  => 'publish',
									'author' => $userID,
									'posts_per_page' => -1,
									'orderby' => 'menu_order ID',
									'order'   => 'DESC');
									 
					$item = new WP_Query( $args );
					$total_element=$item->found_posts;

                    while ( $item->have_posts() ) : $item->the_post();
                    
                    $itemcity    	=   get_the_terms($post->ID, 'itemcity');
                    
                    if(!empty($itemcity))
                    {
                        $cityname = $itemcity[0]->name;	
                    }
                    else{
                        $cityname = '';
                    }
                    
                    $categories_term_id	= '';	
                    
                    $itemcategory    	=   get_the_terms($post->ID, 'itemcategory');	
                    if(!empty($itemcategory))
                    {
                        foreach ($itemcategory as $item_category_each) {
                            
                            $categories_term_id[]=$item_category_each->term_id;
                        }
                    }	
                    
                    $item_price 	= get_post_meta( $post->ID, 'item_price', true );
                    $item_maxprice 	= get_post_meta( $post->ID, 'item_maxprice', true );          
                    ?>
                    <div class="col-md-4 vendor-box"><!-- venue box start-->
                          <div class="vendor-image"><!-- venue pic --> 
                            <a href="<?php the_permalink();?>">
                                <?php 
                                if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                                   the_post_thumbnail( 'weddingvendor_item_thumb' ,array( 'class' => 'img-responsive' )  );
                                }				
                                ?>            
                            </a>      
                            <a href="<?php echo get_category_link($itemcategory[0]->term_id); ?>" class="label-primary"><?php echo $itemcategory[0]->name;?></a>
                            <?php
                            echo wedding_wishlist_item_html($post->ID);
                             ?>            
                            </div>
                          <!-- /.venue pic -->
                          <div class="vendor-detail"><!-- venue details -->
                            <div class="caption"><!-- caption -->
                              <h2><a class="title" href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                              <p class="location"><i class="fa fa-map-marker"></i>&nbsp; <?php echo $cityname;?></p>              
                            </div>
                            <!-- /.caption -->
                            <?php echo wedding_item_price_html($item_price,$item_maxprice,$currency_code); ?>              </div>
                          <!-- venue details --> 
                        </div>
                    <?php 
					if(($k%3)==0  && $k<$total_element)
					{
						echo '</div><div class="row">';
					}
					$k++;
                    endwhile; 
                    ?>
                    </div>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="about">
                <div class="venue-details">
					<?php echo wpautop($about_me); ?>                  
                </div>
              </div>
            </div>
            <!-- /.tab content start-->             
          </div>
        </div>        
        <div class="col-md-3">
        	<div class="row">
        	<?php 
		  		get_template_part( 'template-parts/item/vendor', 'contact');
		  	?> 
            </div>          
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
}else{
	echo '<div class="main-container"><div class="container"><div class="row"><div class="col-md-12"><div class="well-box">';
	echo esc_html_e('Your selected vendor profile not exits more','weddingvendor');
	echo '</div></div></div></div></div>';
}
}
else
{
	echo '<div class="main-container"><div class="container"><div class="row"><div class="col-md-12"><div class="well-box">';
	echo esc_html_e('Something goes wrong.Please go to home page','weddingvendor');
	echo '</div></div></div></div></div>';
}
get_footer();
?>