<?php
/**
 *  Template Name: Listing+Map
 *
 * @package weddingvendor
 */

get_header(); 

$meta_query				=	array();
$k						=	1;
$item_capacity			=	'';
$map_list				=	'';
$category_type_array	=	'';
$category_type_id		=	'';	
$city_id				=	'';	
$city_array				=	'';
$price_low 				=	'';
$price_max				=	'';
$currency_code			=	tg_get_option('currency_symbols');

if( isset($_GET['price_low']) && is_numeric($_GET['price_low'])){
	$price_low = intval($_GET['price_low']);
}

if( isset($_GET['price_max'])  && is_numeric($_GET['price_max']) ){
	$price_max          = intval($_GET['price_max']);
	$price['key']       = 'item_price';
	$price['value']     = array($price_low, $price_max);
	$price['type']      = 'numeric';
	$price['compare']   = 'BETWEEN';
	$meta_query[]       = $price;
}


if (isset($_GET['city']) && $_GET['city'] != '') {
	$city[]  = sanitize_title ( $_GET['city'] );
	$city_array = array(
		'taxonomy'  => 'itemcity',
		'field'     => 'id',
		'terms'     => $city
	);
	$city_id=$_GET['city'];
}
 //////////// end for city taxonomy

if (isset($_GET['category_type']) && $_GET['category_type'] != 'all' && $_GET['category_type'] != '' ) {
	$taxcity[]  = sanitize_title ( $_GET['category_type'] );
	$category_type_array = array(
		'taxonomy'  => 'itemcategory',
		'field'     => 'id',
		'terms'     => $taxcity
	);	
	$category_type_id=$_GET['category_type'];	
}

//////////// end for category_type taxonomy		
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-7 listing-wrap"><!-- listing wrap -->
      <div class="row"> <a class="btn tp-btn-link pull-right" role="button" data-toggle="collapse" href="#searchform" aria-expanded="false" aria-controls="searchform">+<?php esc_html_e('Filter','weddingvendor');?></a></div>
        <div class="row">        
            <div class="filter-box collapse" id="searchform">
              <div class="container-fluid">
                <div class="row filter-form">
                  <div class="col-md-12">
                    <h2><?php esc_html_e('Refine Your Search','weddingvendor');?></h2>
                  </div>
                  <form method="get">
                    <div class="col-md-12">
                        <div class="amount_box"><?php echo $currency_code;?><span id="amount"></span></div>
                        <div id="price-range" class="pricing_range"></div>
                        <input type="hidden" id="min_price" />
                        <input type="hidden" id="max_price" />
                    </div>
                    <div class="col-md-3">
                      <label class="control-label" for="category_type"><?php esc_html_e('Category','weddingvendor');?></label>
                      <?php echo wedding_item_filter_category($category_type_id); ?>   
                    </div>
                    <div class="col-md-3">
                      <label class="control-label" for="price"><?php esc_html_e('City','weddingvendor');?></label>
                      <?php echo wedding_item_filter_city($city_id); ?>            
                    </div>            
                    <div class="col-md-3">
                      <label class="control-label" for="capacity"><?php esc_html_e('Capacity','weddingvendor');?></label>
                      <?php echo wedding_item_filter_capacity($item_capacity); ?>             
                    </div>
                    
                    <div class="col-md-3">
                      <button type="button" id="btn-search-on" class="btn tp-btn-default tp-btn-lg btn-block"><?php esc_html_e('Search','weddingvendor');?></button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
        <div id="item_results">
          <div class="row">
            <?php
            $per_page=tg_get_option('items_per_page');
            $args = array( 'post_type' => 'item', 
                            'posts_per_page' => $per_page,
                            'post_status'  => 'publish',
                            'orderby' => 'menu_order ID',
                            'order'   => 'DESC',
                            'paged' => 1,
                            'meta_query'  => $meta_query,
                            'tax_query' => array('relation' => 'AND', $city_array, $category_type_array));
            $item = new WP_Query( $args );
            $total_element=$item->found_posts;
            ?>
                <div class="col-md-12 vendor-listing">
                  <h2><?php  printf( esc_html__( 'Total %s items in your search', 'weddingvendor' ),  $total_element );?></h2>
                </div>
            </div>      
            <div class="row">   
            <?php         
            while ( $item->have_posts() ) : $item->the_post();
            
            $item_address 	= get_post_meta( $post->ID, 'item_address', true );
            $item_price 	= get_post_meta( $post->ID, 'item_price', true );
            $item_maxprice 	= get_post_meta( $post->ID, 'item_maxprice', true );
            
            $locators 		= get_post_meta( $post->ID, 'locators', true );
            $map_address 	= $locators['address'];
            $latitude 		= $locators['latitude'];
            $longitude 		= $locators['longitude'];		
            
			$item_price_marker	= wedding_item_price_marker($item_price,$item_maxprice,$currency_code);

            $categories_term_id	= '';	
			
            $itemcategory    	=   get_the_terms($post->ID, 'itemcategory');	
            if(!empty($itemcategory))
            {
                foreach ($itemcategory as $item_category_each) {
                    
                    $categories_term_id[]=$item_category_each->term_id;
                }
            }	
		
            $itemcity    	=   get_the_terms($post->ID, 'itemcity');
			
			if(!empty($itemcity))
			{
				$cityname = $itemcity[0]->name;	
			}
			else{
				$cityname = '';
			}
           
			$marker_icon = wedding_default_marker($categories_term_id[0]);

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
				
            ?>            
            <div class="<?php echo $col_class;?> vendor-box"><!-- venue box start-->
             
              <div class="vendor-image"><!-- venue pic --> 
                <a href="<?php the_permalink(); ?>">
                    <?php 
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                       the_post_thumbnail( 'weddingvendor_item_thumb' ,array( 'class' => 'img-responsive' )  );
                    }				
                    ?>             
                </a>      
                <a href="<?php echo get_category_link($itemcategory[0]->term_id); ?>" class="label-primary"><?php echo $itemcategory[0]->name;?></a>      			 <?php echo weddlist_wishlist_item_html($post->ID); ?>
              </div>
              <!-- /.venue pic -->
              <div class="vendor-detail"><!-- venue details -->
                <div class="caption"><!-- caption -->
                  <h2><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h2>
                  <?php echo wedding_item_address_html($cityname); ?>              
                </div>
                <!-- /.caption -->
                <?php echo wedding_item_price_html($item_price,$item_maxprice,$currency_code); ?>
              </div>
              <!-- venue details --> 
            </div>
            <?php 
			}
			else if($list_style=='bubba')
			{
			?>
 			<div class="<?php echo $col_class;?> vendor-box">
				<div class="grid">
				  <figure class="effect-bubba"> 
					<?php 
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                       the_post_thumbnail( 'weddingvendor_item_thumb' ,array( 'class' => 'img-responsive' )  );
                    }				
                    ?> 
					<a href="<?php the_permalink()?>">
					<figcaption>
					  <h2><?php the_title()?></h2><?php echo wedding_item_address_html($item_address);?>
					</figcaption>
					</a>
				  </figure>
				</div>
			  </div>          
			<?php }
			else if($list_style=='oscar')
			{
			?>
 			<div class="<?php echo $col_class;?> vendor-box">
				<div class="grid">
				  <figure class="effect-oscar"> 
					<?php 
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                       the_post_thumbnail( 'weddingvendor_item_thumb' ,array( 'class' => 'img-responsive' )  );
                    }				
                    ?> 
					<a href="<?php the_permalink()?>">
					<figcaption>
					  <h2><?php the_title()?></h2><?php echo wedding_item_address_html($item_address);?>
					</figcaption>
					</a>
				  </figure>
				</div>
			  </div>          
			<?php } else { 	?>	
            <div class="<?php echo $col_class;?> vendor-box"><!-- venue box start-->
              <div class="vendor-image"><!-- venue pic --> 
                <a href="<?php the_permalink(); ?>">
                    <?php 
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                       the_post_thumbnail( 'weddingvendor_item_thumb' ,array( 'class' => 'img-responsive' )  );
                    }				
                    ?>             
                </a>      
                <a href="<?php echo get_category_link($itemcategory[0]->term_id); ?>" class="label-primary"><?php echo $itemcategory[0]->name;?></a>      
              </div>
              <!-- /.venue pic -->
              <div class="vendor-detail"><!-- venue details -->
                <div class="caption"><!-- caption -->
                  <h2><a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a></h2>
                  <?php echo wedding_item_address_html($cityname); ?>              
                </div>
                <!-- /.caption -->
                <?php echo wedding_item_price_html($item_price,$item_maxprice,$currency_code); ?>
              </div>
              <!-- venue details --> 
            </div>			
            <?php 
			}
				
            $postid = get_the_ID();		
            $featured_img = wp_get_attachment_image_src( get_post_thumbnail_id($postid),'weddingvendor_item_thumb',false );
            $map_list .= '{ "title": "'.get_the_title().'","longitude": '.floatval($longitude).',"latitude": '.floatval($latitude).', "url": "'.get_permalink($postid).'","featured_img": "'.$featured_img[0].'","marker": "'.$marker_icon.'","id": '.$postid.',"address": "'.$item_address.'", "price": "'.$item_price_marker.'","cat_name": "'.$itemcategory[0]->name.'","cat_url": "'.get_category_link($itemcategory[0]->term_id).'" }
            ,';
            
            if(($k%$row_col)==0  && $k<count($item->posts))
            {
                echo '</div><div class="row">';
            }
            
            $k++;
            endwhile; 		
            wp_reset_postdata();        
			
            $paginaiton_html='';
            $end=ceil($total_element/$per_page);

			
			
            for($i=1;$i<=$end;$i++)
            {
                if($i == 1 )
                {
                    $class = "active";
                    $calltofunction='';
                }
                else{
                    $class = "";
                    $calltofunction='onclick="call_paging_item('.$i.')"';
                }			
                
                $paginaiton_html.='<li class="'.$class.'"  title='.$i.' id="paging_'.$i.'"><a href="javascript:void(0)" '.$calltofunction.'>'.$i.'</a></li>';		
            }
            
            echo '<div class="col-md-12 tp-pagination"><ul class="pagination">'.$paginaiton_html.'</ul></div>';
			
            ?>
            </div>
        </div>      
        <!-- /.Pagination -->
    </div><!-- /.Listing wrap -->
    <div class="col-md-5 map-wrap"><!-- map wrap-->
      <div id="map" class="maping"></div>
    </div><!-- map wrap-->
  </div>
</div>
<script>
var markers = [<?php echo $map_list; ?>];
var clustor= '<?php echo get_template_directory_uri();?>/images/clustor.png';
var center_point_lati = [<?php map_center_point_latitude(); ?>];
var center_point_long = [<?php map_center_point_longitude(); ?>];
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?php 
get_footer(); 
?>