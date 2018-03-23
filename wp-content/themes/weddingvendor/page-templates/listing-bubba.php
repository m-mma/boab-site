<?php
/**
 *  Template Name: Bubba Listing
 *
 * @package weddingvendor
 */

get_header(); 

$item_capacity		= '';
$meta_query			= array();

$category_type_array= '';
$category_type_id	= '';	
$city_id			= '';	
$city_array			= '';
$price_low 			= '';

$k					= 1;
$currency_code		= tg_get_option('currency_symbols');

if( isset($_GET['price_low'])){
	$price_low = intval($_GET['price_low']);
}

$price_max='';
if( isset($_GET['price_max'])  && is_numeric($_GET['price_max']) ){
	$price_max          = intval($_GET['price_max']);
	$price['key']       = 'item_price';
	$price['value']     = array($price_low, $price_max);
	$price['type']      = 'numeric';
	$price['compare']   = 'BETWEEN';
	$meta_query[]       = $price;
}
 //////////// end for price

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
<div class="filter-box collapse in" id="searchform">
	<div class="container">
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
                        <input type="hidden" id="list_style" value="bubba"  />
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
                      <button type="button" id="leftsidebar-search" class="btn tp-btn-default tp-btn-lg btn-block"><?php esc_html_e('Search','weddingvendor');?></button>
                    </div>
                  </form>
                </div>
    </div>
</div>
<div class="container">
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
						'tax_query' => array(
							'relation' => 'AND',
							$city_array,
							$category_type_array,
						),
						 );
						 
		$item = new WP_Query( $args );
		$total_element=$item->found_posts;
		?>
            <div class="col-md-12 vendor-listing">
              <h2><?php 
			  printf( esc_html__( 'Total %s items in your search', 'weddingvendor' ),  esc_html($total_element) );
			  ?></h2>
            </div>
        <?php 
		while ( $item->have_posts() ) : $item->the_post();
		
		$item_address = get_post_meta( $post->ID, 'item_address', true );
		?>
        <div class="col-md-4 vendor-box">
            <div class="grid">
              <figure class="effect-bubba"> 
                <?php 
                if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                    the_post_thumbnail( 'weddingvendor_item_thumb' ,array( 'class' => 'img-responsive' )  );
                }				
                ?> 
                <?php echo wedding_wishlist_item_html($post->ID); ?>
                <a href="<?php the_permalink(); ?>">
                <figcaption>
                  <h2><?php the_title(); ?></h2>
                  <p><?php echo esc_html($item_address);?></p>
                </figcaption>
                </a>
              </figure>
            </div>
          </div>    
		<?php 		
		if(($k%3)==0  && $k<count($item->posts))
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
				$calltofunction='onclick="simple_paging_item('.$i.')"';
			}			
			
			$paginaiton_html.='<li class="'.esc_attr($class).'"  title='.$i.' id="paging_'.$i.'"><a href="javascript:void(0)" '.$calltofunction.'>'.$i.'</a></li>';		
		}
		
		echo '<div class="col-md-12 tp-pagination"><ul class="pagination">'.$paginaiton_html.'</ul></div>';
		?>
        </div>
  </div>      
</div>
<?php get_footer(); ?>