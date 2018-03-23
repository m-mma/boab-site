<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package weddingvendor
 */

get_header(); 
$item_capacity='';

global $post;
$terms_category = get_the_terms($post->id, 'itemcategory');
$taxcity[]  = sanitize_title ($terms_category[0]->term_id);
$category_type_array = array(
	'taxonomy'  => 'itemcategory',
	'field'     => 'id',
	'terms'     => $taxcity
);

$t_id = $terms_category[0]->term_id;
$term_meta 	= get_option( "icon_itemcategory_$t_id" );

if(!empty($term_meta))
{
	$icon_image = esc_attr( $term_meta['image'] ) ? esc_attr( $term_meta['image'] ) : ''; 
	$icon_html = '<div class="col-md-2 feature-icon"><img alt="" src="'.$icon_image.'"></div>'; 
	$sub_class='col-md-10 ';
}
else{
	$sub_class 	= 'col-md-12 ';
	$icon_html	= '';
}
$city_id = '';
$currency_code=tg_get_option('currency_symbols');
?>
<div class="main-container" >
<div class="container">
	<div class="row">
        <div class="col-md-3">
            <div class="filter-sidebar">
              <div class="col-md-12 form-title">
                <h2><?php esc_html_e('Refine Your Search','weddingvendor');?></h2>
              </div>
              <form method="get">
	            <div class="col-md-12 form-group">
                  <label class="control-label" for="city"><?php esc_html_e('City','weddingvendor');?></label>
                  <?php echo wedding_item_filter_city($city_id); ?>
                </div>
                <div class="col-md-12 form-group">
                  <label class="control-label" for="capacity"><?php esc_html_e('Capacity','weddingvendor');?></label>
                  <?php echo wedding_item_filter_capacity($item_capacity); ?>
                </div>
                <div class="col-md-12 form-group">
                  <label class="control-label" for="price"><?php esc_html_e('Price','weddingvendor');?></label>
                    <div class="amount_box"><?php echo $currency_code;?><span id="amount"></span></div>
                    <div id="price-range" class="pricing_range"></div>
                    <input type="hidden" id="min_price" />
                    <input type="hidden" id="max_price" />
                    <input type="hidden" id="category_type" name="category_type" value="<?php echo $terms_category[0]->term_id;?>" />
                    <input type="hidden" id="list_style" value="3grid"  />                  
                </div>
                <div class="col-md-12 form-group">
                  <button type="button" id="leftsidebar-search" class="btn tp-btn-primary tp-btn-lg btn-block"><?php esc_html_e('Refine Your Search','weddingvendor');?></button>
                </div>
              </form>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="well-box mb0">
                      <div class="row">
           				<?php echo $icon_html;?>          	
                        <div class="<?php echo esc_attr($sub_class);?>feature-info">
                        <?php
                        if(isset($terms_category[0]->name))
                        echo '<h1>'.esc_html($terms_category[0]->name).'</h1>';
                        
                        if(isset($terms_category[0]->description))
                        echo '<p>'.$terms_category[0]->description.'</p>';
                        
                        ?>
                        </div>
                      </div>
                    </div>
                </div>
            </div>    
            <div class="results" id="item_results"> 
                <div class="row">
				<?php 
				$k=1;
                $per_page=tg_get_option('items_per_page'); 
                $args = array( 'post_type' => 'item', 
                            'posts_per_page' => $per_page,
                            'post_status'  => 'publish',
                            'orderby' => 'menu_order ID',
                            'order'   => 'DESC',
                            'paged' => 1,
                            'tax_query' => array(
                                'relation' => 'AND',
                                $category_type_array,
                            ),
                             );
                             
                $item = new WP_Query( $args );	
                
                $total_element=$item->found_posts;
                
                echo '<div class="col-md-12 vendor-listing"><h2>';					
				printf( esc_html__( 'Total %s items in your search', 'weddingvendor' ),  esc_html(count($item->posts)) ); 
				echo '</h2></div>';
				
                while ( $item->have_posts() ) : $item->the_post(); 
                
                $item_address 	= get_post_meta( $post->ID, 'item_address', true );
                $item_price 	= get_post_meta( $post->ID, 'item_price', true );
                $item_maxprice 	= get_post_meta( $post->ID, 'item_maxprice', true );
                
				$itemcity    	= get_the_terms($post->ID, 'itemcity');
				if(!empty($itemcity))
				{
					$cityname = $itemcity[0]->name;	
				}
				else{
					$cityname = '';
				}				
                ?>
                <div class="col-md-4 vendor-box"><!-- venue box start-->
                <div class="vendor-image"><!-- venue pic --> 
                  <a href="<?php the_permalink(); ?>"><?php 
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                       the_post_thumbnail( 'weddingvendor_item_thumb' ,array( 'class' => 'img-responsive' )  );
                    }				
                    ?></a>
                    <?php echo wedding_wishlist_item_html($post->ID); ?>
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
				
				if(($k%3)==0  && $k<$total_element)
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
                    
                    $paginaiton_html.='<li class="'.esc_attr($class).'"  title='.$i.'><a href="javascript:void(0)" '.$calltofunction.'>'.$i.'</a></li>';		
                }
                
                echo '<div class="col-md-12 tp-pagination"><ul class="pagination">'.$paginaiton_html.'</ul></div>';			
                ?>
                </div>
            </div>
		</div>
    </div>
</div>
</div>
<?php
get_footer();
?>