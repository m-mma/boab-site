<?php 
/**
 * 	Pagination 
 */
if ( ! function_exists( 'wedding_pagination' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Devote 1.0
 *
 * @global WP_Query   $wp_query   WordPress Query object.
 * @global WP_Rewrite $wp_rewrite WordPress Rewrite object.
 */
function wedding_pagination() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => 'NEXT',
		'next_text' => 'PREVIOUS',
	) );

	if ( $links ) :
	?>
        <div class="col-md-12 tp-pagination">
        	<div class="pagination">
           		<?php echo $links; ?>
            </div>
        </div><!-- .md 12 -->
	<?php
	endif;
}
endif; 


if ( ! function_exists( 'listing_pagination' ) ) :

function listing_pagination($total_element,$total_limit,$active_page) {


	$pagination_html = '';
	
	// How many adjacent pages should be shown on each side?
	$adjacents = 2;
	

	$total_pages = $total_element;
	
	$limit = $total_limit; 						//how many items to show per page
	$page = $active_page;
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	

		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.='<li class="'.$class.'"  title='.$prev.' id="paging_'.$prev.'"><a href="javascript:void(0)" onclick="call_paging_item('.$prev.')">PREV</a></li>';	
		else
			$pagination.= '';	

			//$pagination.= '<li><span class=\"disabled\"><i class="fa fa-arrow-left"></i></span></li>';	

		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= '<span class=\"current\">'.$counter.'</span>';
				else
					//$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
					
					$pagination.='<li class="'.$class.'"  title='.$counter.' id="paging_'.$counter.'"><a href="javascript:void(0)" onclick="call_paging_item('.$counter.')">'.$counter.'</a></li>';					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= '<li class="active"><span class="current">'.$counter.'</span><li>';
					else
						//$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
						$pagination.='<li class="'.$class.'"  title='.$counter.' id="paging_'.$counter.'"><a href="javascript:void(0)" onclick="call_paging_item('.$counter.')">'.$counter.'</a></li>';						
				}
				$pagination.= '<li><span class="disabled">...</span></li>';
				$pagination.='<li class="'.$class.'"  title='.$lpm1.' id="paging_'.$lpm1.'"><a href="javascript:void(0)" onclick="call_paging_item('.$lpm1.')">'.$lpm1.'</a></li>';
				$pagination.='<li class="'.$class.'"  title='.$lastpage.' id="paging_'.$lastpage.'"><a href="javascript:void(0)" onclick="call_paging_item('.$lastpage.')">'.$lastpage.'</a></li>';						

			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= '<li class="'.$class.'"  title="1" id="paging_1"><a href="javascript:void(0)" onclick="call_paging_item(1)">1</a></li>';
				$pagination.= '<li class="'.$class.'"  title="2" id="paging_2"><a href="javascript:void(0)" onclick="call_paging_item(2)">2</a></li>';
				$pagination.= '<li><span class="disabled">...</span></li>';

				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= '<li class="active"><span class=\"current\">'.$counter.'</span></li>';
					else
						$pagination.='<li class="'.$class.'"  title='.$counter.' id="paging_'.$counter.'"><a href="javascript:void(0)" onclick="call_paging_item('.$counter.')">'.$counter.'</a></li>';				
				}
				$pagination.= '<li><span class="disabled">...</span></li>';
				$pagination.= '<li class="'.$class.'"  title='.$lpm1.' id="paging_'.$lpm1.'"><a href="javascript:void(0)" onclick="call_paging_item('.$lpm1.')">'.$lpm1.'</a></li>';				
				$pagination.= '<li class="'.$class.'"  title='.$lastpage.' id="paging_'.$lastpage.'"><a href="javascript:void(0)" onclick="call_paging_item('.$lastpage.')">'.$lastpage.'</a></li>';	
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= '<li class="'.$class.'"  title="1" id="paging_1"><a href="javascript:void(0)" onclick="call_paging_item(1)">1</a></li>';
				$pagination.= '<li class="'.$class.'"  title="2" id="paging_2"><a href="javascript:void(0)" onclick="call_paging_item(2)">2</a></li>';
				$pagination.= '<li><span class="disabled">...</span></li>';

				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= '<li class="active"><span class="current">'.$counter.'</span></li>';
					else
						$pagination.= '<li class="'.$class.'"  title='.$counter.' id="paging_'.$counter.'"><a href="javascript:void(0)" onclick="call_paging_item('.$counter.')">'.$counter.'</a></li>';					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= '<li class="'.$class.'"  title='.$next.' id="paging_'.$next.'"><a href="javascript:void(0)" onclick="call_paging_item('.$next.')">NEXT</a></li>';					
		else
			$pagination.= '';
			//$pagination.= '<li><span class="disabled"><i class="fa fa-arrow-right"></i></span></li>';
		$pagination.= "</div>\n";
		
		$pagination_html='<ul class="pagination">'.$pagination.'</ul>';
	
	}
	return $pagination_html;	
	
}

endif; 


add_filter('wp_nav_menu_items','add_search_box', 10, 2);
function add_search_box($items, $args) {
 
 		if( $args->theme_location == 'topbar' )
		{
			if (is_user_logged_in() ) {
				$items .= '<li><a href="'.wp_logout_url().'">'.esc_html__('Logout','weddingvendor').'</a></li>';
			}
			$header_search_btn=tg_get_option('header_search_btn');
			if(isset($header_search_btn) && !empty($header_search_btn))
			{
        		$items .= '<li><a role="button" data-toggle="collapse" href="#searcharea" aria-expanded="false" aria-controls="searcharea"> <i class="fa fa-search"></i> </a></li>';
			}

		}
 
    return $items;
}


if ( ! function_exists( 'wedding_shape_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Shape 1.0
 */
function wedding_shape_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body review-list">
	<?php endif; ?>
	<div class="row"><!-- row block start-->    
        <div class="col-md-2 col-sm-2 hidden-xs">      			
            <div class="user-pic">
                <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size'] ); ?>
            </div>
        </div>
        <div class="col-md-10 col-sm-10">
            <div class="panel panel-default arrow left">
                 <div class="panel-body">
                 	<div class="text-left">
                    <h3><?php 
                        printf(__('%s', 'weddingvendor'), sprintf('%s', get_comment_author_link())); ?>
                    </h3>
                    <div class="comment-date">
					<i class="fa fa-clock-o"></i> <?php comment_time('d, F,Y');	?>
                        <?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago'; ?>
                        <?php edit_comment_link( esc_html__( '(Edit)', 'weddingvendor' ), ' ' ); ?> 
                    </div> <!-- meta -->
                    </div>
                    <div class="comment-box">
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                        <em><?php esc_html_e( 'Your comment is awaiting moderation.', 'weddingvendor' ); ?></em>
                        <br />
                    <?php endif; ?>
                    <?php comment_text(); ?>
                    </div>										
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                 </div><!-- media-body -->
            </div>
        </div>
    </div><!-- row block end--> 
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; 
}
endif; // ends check for wedding_shape_comment()


/**
 * 	Related Post.
 */
if ( ! function_exists( 'wedding_related_post' ) ) :
 
function wedding_related_post() {

	global $post;
	$original_post ="";
	$categories = get_the_category($post->ID);
	
	if ($categories) {
	echo '<div class="related-post"> <h2 class="related-title">';
	esc_html__('Related Post','weddingvendor');
	echo '</h2> <div class="row">';	
	
			$category_ids = array();		
			foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;		
				$args=array(
					'category__in' => $category_ids,
					'post__not_in' => array($post->ID),
					'posts_per_page'=> 2, // Number of related posts that will be shown.
					'ignore_sticky_posts'=>1
				);				
				$related_post_query = new wp_query( $args );
				if( $related_post_query->have_posts() ) {	
					while( $related_post_query->have_posts() ) {
						$related_post_query->the_post(); 
						echo '<div class="col-md-6">';
						?>
                        <h3><a href="<?php the_permalink()?>" class="link" ><?php the_title(); ?></a></h3>  
						<div class="meta"><span class="tag-meta"><?php esc_html_e( 'IN', 'weddingvendor' ); ?> 
                        <?php 
						$categories = get_the_category();
						$separator = ' , ';
						$output = '';
						if ( ! empty( $categories ) ) {
							foreach( $categories as $category ) {
								$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( esc_html__( 'View all posts in %s', 'weddingvendor' ), $category->name ) ) . '" >"' . esc_html( $category->name ) . '"</a> ' . $separator;
							}
							echo trim( $output, $separator );
						}
						?></span>
						</div>
						<?php
						echo '</div>';
				} // if
			} // foreach
			echo '</div></div>';
	} // if			
	$post = $original_post;
	wp_reset_postdata();
}

endif; 


if ( ! function_exists( 'wedding_single_post_pre_next' ) ) :

function wedding_single_post_pre_next() {
	 $p = get_adjacent_post(false, '', true); 
	 $n = get_adjacent_post(false, '', false);
	 if(!empty($p) || !empty($n)){
 		echo '<div class="post-next-prev"><div class="row">';
		
        // previous post title with link 
        if(!empty($p))
		printf('<div class="col-md-6 col-sm-6 prev-post"><span><a href="%s" class="link-prev-next"><i class="fa fa-angle-double-left"></i>'.esc_html__('Previous','weddingvendor').' </a><h3><a href="%s" title="%s" class="link">%s</a></h3></span></div>', get_permalink($p->ID), get_permalink($p->ID) , $p->post_title , $p->post_title  );
	                
		// next post title with link 
		if(!empty($n))
		printf('<div class="col-md-6 col-sm-6 text-right next-post pull-right"><span><a href="%s" class="link-prev-next">'.esc_html__('Next','weddingvendor').' <i class="fa fa fa-angle-double-right"></i></a><h3><a href="%s" title="%s" class="link">%s</a></h3></span></div>', get_permalink($n->ID), get_permalink($n->ID), $n->post_title , $n->post_title ); 
				
 		echo '</div></div>';
	 }		
}

endif; 


/**
*  The Blog post video iframe support browser.
*/
if(!function_exists('wedding_video_embed')){
    function wedding_video_embed($embed_code){
		$embed_code=str_replace('webkitallowfullscreen','',$embed_code);
		$embed_code=str_replace('mozallowfullscreen','',$embed_code);
		$embed_code=str_replace('frameborder="0"','',$embed_code);
		$embed_code=str_replace('frameborder="no"','',$embed_code);
		$embed_code=str_replace('scrolling="no"','',$embed_code);
		$embed_code=str_replace('&','&amp;',$embed_code);
		return $embed_code;
	}
}


/**
*  Check Payment date Expired
*/

if(!function_exists('wedding_check_expired_listing')){
	function wedding_check_expired_listing($post_id,$action)
	{		
		global $current_user;
		wp_get_current_user();
		$cur_date						= date('Y-m-d');
		$result							= array();
		$userID         				= $current_user->ID; 
		$user_items 					= get_the_author_meta( 'user_items' , $userID );
		$user_payment_expired_date 		= get_the_author_meta( 'user_payment_expired_date' , $userID );
		$user_member_status		 		= get_the_author_meta( 'user_member_status' , $userID );
		$accessibility					= 'Off';
		$item_date 						= get_the_date('Y-m-d', $post_id );	
		$free_listing_validity  = tg_get_option('free_listing_validity'); 

		if(empty($user_items))
		{
			$user_items=tg_get_option('free_items');
		}

		$args = array( 'post_type' => 'item','posts_per_page' => -1,'post_status' => 'publish','author'=> $userID );
		$item = new WP_Query( $args );
		$total_items=$item->found_posts;
			
		
		if($free_listing_validity=="lifetime")
		{
			$accessibility = 'On';
		}		
		else if($user_member_status=='Free')
		{
			if($action=='Add')
			{
				if($user_items>$total_items)
				{
					$accessibility = 'On';
				}
				
			}
			else if($action=='Edit')
			{
				if($user_items>=$total_items)
				{
					$accessibility = 'On';
				}
			}
		}
		else if($user_member_status=="Paid")
		{
			if($action=="Add")
			{
				if($user_items>$total_items)
				{
					$accessibility = 'On';
				}

			}
			else if($action=="Edit")
			{
				if($user_items>=$total_items)
				{
					$accessibility = 'On';
				}

			}
		}		
		
		return $accessibility;		
	}
}


add_filter('get_avatar','wedding_add_gravatar_class');

function wedding_add_gravatar_class($class) {
    $class = str_replace("class='avatar", "class='avatar img-responsive img-circle", $class);
    return $class;
}


// Replace class on comment link
add_filter('comment_reply_link', 'wedding_replace_reply_link_class');

function wedding_replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='btn tp-btn-primary reply_box", $class);
    return $class;
}


///////////////////////////////////////////////////////////////////////////////////////////
// forgot pass action
///////////////////////////////////////////////////////////////////////////////////////////

add_action('wp_head','wedding_forgotpass_hook_javascript');

function wedding_forgotpass_hook_javascript(){
    global $wpdb;
    $allowed_html   =   array();
    if(isset($_GET['key']) && $_GET['action'] == "reset_pwd") {
        $reset_key  = wp_kses($_GET['key'],$allowed_html);
        $user_login = wp_kses($_GET['login'],$allowed_html);
        $user_data  = $wpdb->get_row($wpdb->prepare("SELECT ID, user_login, user_email FROM $wpdb->users 
                WHERE user_activation_key = %s AND user_login = %s", $reset_key, $user_login));

        if(!empty($user_data)){
                $user_login = $user_data->user_login;
                $user_email = $user_data->user_email;

                if(!empty($reset_key) && !empty($user_data)) {
                        $new_password = wp_generate_password(7, false); 
                        wp_set_password( $new_password, $user_data->ID );
                        //mailing the reset details to the user
                        $message = esc_html__('Your new password for the account at:','weddingvendor') . "\r\n\r\n";
                        $message .= get_bloginfo('name') . "\r\n\r\n";
                        $message .= sprintf(esc_html__('Username: %s','weddingvendor'), $user_login) . "\r\n\r\n";
                        $message .= sprintf(esc_html__('Password: %s','weddingvendor'), $new_password) . "\r\n\r\n";
                        $message .= esc_html__('You can now login with your new password at:','weddingvendor') . get_option('siteurl')."/" . "\r\n\r\n";

                        $headers = 'From: noreply  <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n".
                        'Reply-To: noreply@'.$_SERVER['HTTP_HOST']. "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                        if ( $message && !wp_mail($user_email, 'Your password was reset', $message,$headers) ) {
                                $mess= "<div class='alert alert-danger'>".esc_html__('Email sending has failed for some unknown reason','weddingvendor')."</div>";
                                //exit();
                        }
                        else {
                              $mess= '<div class="alert alert-success">'.esc_html__('A new password was sent via email!','weddingvendor').'</div>';
                              //exit();
                        }
                }
                else {
                    exit('Not a Valid Key.');
                }
        }// end if empty
    echo '<div id="resetpassword" class="modal newpassword fade">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
		                <h4 class="modal-title">'.esc_html__('Password reset','weddingvendor').'</h4>
		            </div>
		            <div class="modal-body">
						<p>'.esc_html__('We have just sent you a new password. Please check your email!','weddingvendor').'</p>
		            </div>
		        </div>
		    </div>
		</div>';
    } 

}

////////////////////////////////////////////////////////////////////////
////     wedding_go_home function  
////////////////////////////////////////////////////////////////////////

add_action('wp_logout','wedding_go_home');

if( !function_exists('wedding_go_home') ):
function wedding_go_home(){
    wp_redirect( esc_url(home_url()) );
    exit();
}
endif; // end   wedding_go_home 

if(!function_exists('wedding_check_logout_user')){
	function wedding_check_logout_user()
	{
		echo'<script> window.location="'.esc_url(home_url()).'"; </script> ';
	}
}

if(!function_exists('wedding_check_user_login_couple')){
	function wedding_check_user_login_couple()
	{
		global $current_user;
		wp_get_current_user();
		$userid     = $current_user->ID;	
	
		$user_type=get_user_meta( $userid, 'user_type',true) ;
		if($user_type!='couple')
		{
			$get_dashboard_link=get_dashboard_link();
			echo '<script> window.location="'.$get_dashboard_link['url'].'"; </script> ';
		}
	}
}
if(!function_exists('wedding_check_user_login_vendor')){
	function wedding_check_user_login_vendor()
	{
		global $current_user;
		wp_get_current_user();
		$userid     = $current_user->ID;	
	
		$user_type=get_user_meta( $userid, 'user_type',true) ;
		if($user_type=='couple')
		{
			$get_couple_dashboard_link=get_couple_dashboard_link();
			echo '<script> window.location="'.$get_couple_dashboard_link['url'].'"; </script> ';
		}
	}
}


if( !current_user_can('activate_plugins') ) {
    function wedding_admin_bar_render() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('edit-profile', 'user-actions');
       }
    
    add_action( 'wp_before_admin_bar_render', 'wedding_admin_bar_render' );

    add_action( 'admin_init', 'wedding_stop_access_profile' );
    if( !function_exists('wedding_stop_access_profile') ):
    function wedding_stop_access_profile() {
        global $pagenow;

        if( defined('IS_PROFILE_PAGE') && IS_PROFILE_PAGE === true ) {
            wp_die( esc_html__('Please edit your profile page from site interface.','weddingvendor') );
        }
       
        if($pagenow=='user-edit.php'){
            wp_die( esc_html__('Please edit your profile page from site interface.','weddingvendor') );
        } 
    }
    endif; // end   wedding_stop_access_profile 

}// end 


add_action('wedding_hourly_event', 'wedding_do_this_hourly');

function wedding_scheduled_activation() {
	if ( !wp_next_scheduled( 'wedding_hourly_event' ) ) {
		wp_schedule_event( current_time( 'timestamp' ), 'hourly', 'wedding_hourly_event');
	}
}
add_action('wp', 'wedding_scheduled_activation');

function wedding_do_this_hourly() {
	// do something every hour

	$free_listing_validity=wedding_check_free_listing_validity();

	$blogusers = get_users('role=subscriber');
	foreach ($blogusers as $user) {
		$user_id	= $user->ID;
	
		$user_payment_expired_date 		= get_the_author_meta( 'user_payment_expired_date' , $user_id );
		if(isset($user_payment_expired_date) && !empty($user_payment_expired_date))
		{
			wedding_check_paid_listing_status($user_id);
		}
		else
		{
			if($free_listing_validity!='lifetime')
			{
				wedding_check_free_listing_status($user_id);					
			}
		}
	}	
	
}

function wedding_add_new_intervals($schedules) 
{
	// add weekly and monthly intervals
	$schedules['hourly'] = array(
		'interval' => 3600,
		'display' => esc_html__('Once Hourly','weddingvendor')
	);

	$schedules['weekly'] = array(
		'interval' => 604800,
		'display' => esc_html__('Once Weekly','weddingvendor')
	);

	$schedules['monthly'] = array(
		'interval' => 2635200,
		'display' => esc_html__('Once a month','weddingvendor')
	);

	return $schedules;
}
add_filter( 'cron_schedules', 'wedding_add_new_intervals');

function wedding_check_free_listing_status($user_id)
{
	global $post;	
	$curr_date=date('Y-m-d');				
	$args = array(
		   'post_type' 		=> 'item',
		   'author'    		=> $user_id,
		   'post_status'   	=> 'publish' 
	);

	$item = new WP_Query( $args );
	$free_listing_validity=wedding_check_free_listing_validity();
	
	while ( $item->have_posts() ) { $item->the_post();

			$created_date	=	mysql2date('Y-m-d', $post->post_date);
			if($free_listing_validity=='1year')
			{
				$added_date 	= 	strtotime("+365 days", strtotime($created_date));
			}
			else if($free_listing_validity=='30days'){
				$added_date 	= 	strtotime("+30 days", strtotime($created_date));
			}
			else {
				$added_date 	= 	strtotime("+30 days", strtotime($created_date));
			}

			
			$final_date		=	date('Y-m-d', $added_date);
			
			if($final_date<=$curr_date)
			{
				$prop = array(
						'ID'            => $post->ID,
						'post_type'     => 'item',
						'author'    	=> $user_id,
						'post_status'   => 'expired'
				);
				wp_update_post($prop ); 
				update_user_meta( $user_id, 'user_member_status', 'Expired' ) ;
				wedding_user_item_expired_email($user_id,__('Your item','weddingvendor').' '.$post->post_title.' '.__('is expired','weddingvendor'));					
			}
			
	  }				
}

function wedding_check_paid_listing_status($user_id)
{
	global $post;				
	$user_payment_expired_date 		= get_the_author_meta( 'user_payment_expired_date' , $user_id );
	$curr_date						= date('Y-m-d');	
	$args = array(
		   'post_type' 		=> 'item',
		   'author'    		=> $user_id,
		   'post_status'   	=> 'publish' 
	);

	$item = new WP_Query( $args );    

	
	if($user_payment_expired_date<$curr_date)
	{					
		if($item->found_posts>0)
		{
			update_user_meta( $user_id, 'user_member_status', 'Expired' ) ;
			wedding_user_item_expired_email($user_id,__('Your Package is expired','weddingvendor'));		
		}

		while ( $item->have_posts() ) { $item->the_post();
			$prop = array(
					'ID'            => $post->ID,
					'post_type'     => 'item',
					'author'    	=> $user_id,
					'post_status'   => 'expired'
			);
		   
			wp_update_post($prop ); 
		}
	}
}

function wedding_user_item_expired_email($user_id,$mail_title)
{
		$user_email     = get_the_author_meta( 'user_email' , $user_id );
		$message  = sprintf( esc_html__('Please buy package to active your items %s:','weddingvendor'), get_option('blogname') ) . "\r\n\r\n";
		
		$message  .= esc_html__('Your wedding items no longer display on our website','weddingvendor') . "\r\n\r\n";
		$message  .= esc_html__('Thanks','weddingvendor') . "\r\n\r\n";

		$headers = 'From: noreply  <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n".
				'Reply-To: noreply@'.$_SERVER['HTTP_HOST']."\r\n" .
					'X-Mailer: PHP/' . phpversion();
		@wp_mail(
			$user_email,
			get_option('blogname').' '.$mail_title,
			$message,
			$headers
		);
}

////////////////////////////////////////////////////////////////////////////////
/// Add new profile fields for user
////////////////////////////////////////////////////////////////////////////////

add_filter('user_contactmethods', 'wedding_modify_contact_methods');     
if( !function_exists('wedding_modify_contact_methods') ):

function wedding_modify_contact_methods($profile_fields) {

	// Add new fields
        $profile_fields['facebook']                     = 'Facebook';
        $profile_fields['googleplus']                   = 'Google Plus';
        $profile_fields['youtube']                      = 'Youtube';
        $profile_fields['linkedin']                     = 'Linkedin';
        $profile_fields['twitter']                      = 'Twitter';
        $profile_fields['pinterest']                    = 'Pinterest';
		$profile_fields['instagram']                    = 'Instagram';

		$profile_fields['firstname']                    = 'Firstname';
		$profile_fields['lastname']                     = 'Lastname';
		$profile_fields['website']                      = 'Website';
		
		
		
        $profile_fields['custom_picture']               = 'Picture Url';
        $profile_fields['small_custom_picture']         = 'Small Picture Url';
        $profile_fields['user_payment_amount']          = 'User Payment Amount';
        $profile_fields['user_payment_expired_date']    = 'User Payment Expired Date';
        $profile_fields['user_payment_date']   			= 'User Payment Date';
        $profile_fields['user_member_status']           = 'User Member Status';
        $profile_fields['user_items']                	= 'User Items';
		$profile_fields['user_weddingdate']             = 'Couple Wedding Date';
		$profile_fields['user_type']             		= 'User Type';
		
	return $profile_fields;
}

endif; // end   wedding_modify_contact_methods 

////////////////////////////////////////////////////////////////////////////////
/// Map center point latitude
////////////////////////////////////////////////////////////////////////////////

if( !function_exists('map_center_point_latitude') ):

function map_center_point_latitude() {
	$center_latitude  = tg_get_option('center_latitude'); 
	
	if(!empty($center_latitude))
	{
		$center_point=(double)$center_latitude;
	}
	else
	{
		$center_point=21.95;
	}
	echo $center_point;
}

endif; // end    


////////////////////////////////////////////////////////////////////////////////
/// Map center point latitude
////////////////////////////////////////////////////////////////////////////////

if( !function_exists('map_center_point_longitude') ):

function map_center_point_longitude() {
	
	$center_longitude = tg_get_option('center_longitude'); 
	
	if(!empty($center_longitude))
	{
		$center_point=(double)$center_longitude;
	}
	else
	{
		$center_point=72.215;
	}
	echo $center_point;
}

endif; // end   wedding_modify_contact_methods


////////////////////////////////////////////////////////////////////////////////
/// wedding_check_free_listing_validity
////////////////////////////////////////////////////////////////////////////////

if( !function_exists('wedding_check_free_listing_validity') ):

function wedding_check_free_listing_validity() {
	
	$free_listing_validity = tg_get_option('free_listing_validity'); 
	
	if(!empty($free_listing_validity))
	{
		$free_listing=$free_listing_validity;
	}
	else
	{
		$free_listing='30days';
	}
	return $free_listing;
}

endif; // end   wedding_check_free_listing_validity


////////////////////////////////////////////////////////////////////////////////
///  wedding_package_expired_period
////////////////////////////////////////////////////////////////////////////////

if( !function_exists('wedding_package_expired_period') ):

function wedding_package_expired_period($userID,$user_items,$package_items,$user_payment_expired_date,$user_period) {


	$cur_date			= 	date('Y-m-d');
	
	if($user_period=="1 Month")
	{
		$set_time="+1 month";
	}
	else if($user_period=="2 Month")
	{
		$set_time="+2 month";
	}	
	else if($user_period=="3 Month")
	{
		$set_time="+3 month";
	}	
	else if($user_period=="6 Month")
	{
		$set_time="+6 month";
	}	
	else if($user_period=="9 Month")
	{
		$set_time="+9 month";
	}	
	else if($user_period=="1 Year")
	{
		$set_time="+1 year";
	}	
	else if($user_period=="1 Year, 6 Month")
	{
		$set_time="+18 month";
	}	
	else if($user_period=="2 Year")
	{
		$set_time="+2 year";
	}	
	else if($user_period=="3 Year")
	{
		$set_time="+3 year";
	}	
	else{
		$set_time="+1 year";		
	}

	if(isset($user_payment_expired_date) && !empty($user_payment_expired_date) && $package_items==$user_items)
	{
		$expired_date= date('Y-m-d', strtotime($set_time, strtotime($user_payment_expired_date)));
		update_user_meta( $userID, 'user_payment_expired_date', $expired_date ) ;								
	}
	else if(isset($user_payment_expired_date) && !empty($user_payment_expired_date) && $package_items!=$user_items)
	{
		$expired_date= date('Y-m-d', strtotime($set_time, strtotime($cur_date)));
		update_user_meta( $userID, 'user_payment_expired_date', $expired_date ) ;		
	}
	else{
		$expired_date= date('Y-m-d', strtotime($set_time, strtotime($cur_date)));
		update_user_meta( $userID, 'user_payment_expired_date', $expired_date ) ;
	}  

}

endif; 