<?php 
/********************************************/
/*
/*		Plugin shortcode for p and br tags
/*
/********************************************/

function wedding_plugin_fix_shortcodes($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'wedding_plugin_fix_shortcodes');

/********************************************/
/*
/*		Row
/*
/********************************************/

add_shortcode( 'row', 'wedding_plugin_sc_row' );
function wedding_plugin_sc_row( $atts, $content ){	
    return sprintf( 
      '<div class="row">%s</div>',
      do_shortcode($content)
    );
}

/********************************************/
/*
/*		Inner Row
/*
/********************************************/

add_shortcode( 'inner-row', 'wedding_plugin_sc_inner_row' );
function wedding_plugin_sc_inner_row( $atts, $content ){	
    return sprintf( 
      '<div class="row">%s</div>',
      do_shortcode($content)
    );
}
/********************************************/
/*
/*		Container
/*
/********************************************/

add_shortcode( 'container', 'wedding_plugin_sc_container' );
function wedding_plugin_sc_container( $atts, $content ){	
    return sprintf( 
      '<div class="container">%s</div>',
      do_shortcode($content)
    );
}

/********************************************/
/*
/*		Icon
/*
/********************************************/

add_shortcode( 'icon', 'wedding_plugin_sc_icon' );
function wedding_plugin_sc_icon( $atts, $content ){	
    return sprintf( 
      '<div class="%s"><i class="%s" style="color:%s"></i></div>',
       $atts['class'],
       $atts['icon'],
       $atts['color'],      
      do_shortcode( $content )
    );
}


/********************************************/
/*
/*		TP BOX.
/*
/********************************************/

add_shortcode( 'tp-box', 'wedding_plugin_sc_tp_box' );
function wedding_plugin_sc_tp_box( $atts, $content = null ){	    
    return sprintf( 
      '<div class="%s">%s</div>',
       $atts['class'],
      do_shortcode($content)
    );
}

/********************************************/
/*
/*		TP INNER BOX.
/*
/********************************************/

add_shortcode( 'tp-inner-box', 'wedding_plugin_sc_tp_inner_box' );
function wedding_plugin_sc_tp_inner_box( $atts, $content = null ){	    
    return sprintf( 
      '<div class="%s">%s</div>',
       $atts['class'],
      do_shortcode($content)
    );
}

/********************************************/
/*
/*		COLUMN.
/*
/********************************************/

add_shortcode( 'column', 'wedding_plugin_sc_column' );
function wedding_plugin_sc_column( $atts, $content ){	
	$atts = shortcode_atts( array(
      "md" => false,
      "class" => false,	  
	), $atts );

	$class  = ( $atts['md'] ) ? $atts['md'] : '';
	$custom_class  = ( $atts['class'] ) ? ' '.$atts['class'] : '';	
	
    return sprintf( 
      '<div class="col-md-%s%s">%s</div>',
       esc_attr($class),
       esc_attr($custom_class),
      do_shortcode( str_replace("<br />", "", force_balance_tags($content)))
    );
}

/********************************************/
/*
/*		INNER COLUMN.
/*
/********************************************/

add_shortcode( 'inner-column', 'wedding_plugin_sc_inner_column' );
function wedding_plugin_sc_inner_column( $atts, $content ){	
	$atts = shortcode_atts( array(
      "md" => false,
      "class" => false,	  
	), $atts );

	$class  = ( $atts['md'] ) ? $atts['md'] : '';
	$custom_class  = ( $atts['class'] ) ? ' '.$atts['class'] : '';	
	
    return sprintf( 
      '<div class="col-md-%s%s">%s</div>',
       esc_attr($class),
       esc_attr($custom_class),	   
      do_shortcode( str_replace("<br />", "", force_balance_tags($content)))
    );
}

/********************************************/
/*
/*		UL.
/*
/********************************************/

add_shortcode( 'ul', 'wedding_plugin_sc_ul' );
function wedding_plugin_sc_ul( $atts, $content ){	
    return sprintf( 
      '<ul class="%s list-view">%s</ul>',
	  $atts['class'],
      do_shortcode($content )
    );
}

/********************************************/
/*
/*		OL.
/*
/********************************************/

add_shortcode( 'ol', 'wedding_plugin_sc_ol' );
function wedding_plugin_sc_ol( $atts, $content ){	
    return sprintf( 
      '<ol class="list-view listnone">%s</ol>',
      do_shortcode( $content )
    );
}

/********************************************/
/*
/*		LI.
/*
/********************************************/

add_shortcode( 'li', 'wedding_plugin_sc_li' );
function wedding_plugin_sc_li( $atts, $content ){ 
    return sprintf( 
      '<li>%s</li>',
      do_shortcode( str_replace("<br />", "", force_balance_tags($content)) )
    );
}

/********************************************/
/*
/*		DIVIDER.
/*
/********************************************/

add_shortcode( 'divi', 'wedding_plugin_sc_divi' );
function wedding_plugin_sc_divi( $atts, $content ){	
    
	if(!empty($atts['class']))
	{
		$classes=$atts['class'];
	}
	else
	{
		$classes="divi";
	}

    return sprintf( 
      '<div class="%s"> %s </div>',
      $classes,
      do_shortcode( $content )
    );
}

/********************************************/
/*
/*		BUTTON.
/*
/********************************************/

add_shortcode( 'button', 'wedding_plugin_sc_button' );
function wedding_plugin_sc_button( $atts, $content ){	
    
	if(!empty($atts['class']))
	{
		$classes=$atts['class'];
	}
	else
	{
		$classes="btn-outline btn-outline-default";
	}
	

	if(!empty($atts['target']))
	{
		$target=$atts['target'];
	}
	else
	{
		$target="_self";
	}	

    return sprintf( 
      '<a href="%s" class="%s" target="%s"> %s </a>',
	  $atts['url'],
      $classes,
      $target,
      do_shortcode( $content )
    );
}

/********************************************/
/*
/*    Iconbox
/*
/********************************************/

add_shortcode( 'iconbox', 'wedding_plugin_sc_iconbox' );
function wedding_plugin_sc_iconbox( $atts, $content ){  
    if($atts['layout']=="icon-box-left")
    {
      return sprintf( 
        '<div class="feature-block"><div class="feature-icon"><img src="%s" alt="" /></div><h2 class="feature-title">%s</h2><p>%s</p></div>',
         $atts['icon'],
         $atts['title'],      
        do_shortcode( $content )
      );
    }
    else if($atts['layout']=="icon-box-center")
    {
      return sprintf( 
        '<div class="feature-block text-center"><div class="feature-icon"><img src="%s" alt="" /></div><h2 class="item-title">%s</h2><p>%s</p></div>',
         $atts['icon'],
         $atts['title'],      
        do_shortcode( $content )
      );
    }    
    else if($atts['layout']=="icon-box-right")
    {
      return sprintf( 
        '<div class="feature-block text-right"><div class="feature-icon pull-right"><img src="%s" class="img-responsive" alt="" /></div><h2 class="item-title">%s</h2><p>%s</p></div>',
         $atts['icon'],
         $atts['title'],      
        do_shortcode( $content )
      );
    } 
    else if($atts['layout']=="icon-box-main")
    {

		$button_html='';
		if(!empty($atts['button_text']) && !empty($atts['button_url']))
		{
		  $button_html='<a  href="'.$atts['button_url'].'" class="btn tp-btn-default">'.$atts['button_text'].'</a>';
		}	
				
      return sprintf( 
        '<div class="well-box"><div class="row"><div class="feature-icon col-md-2"><img src="%s" class="img-responsive" alt="" /></div><div class="feature-info col-md-10"><h3>%s</h3><p>%s</p>%s</div></div></div>',
         $atts['icon'],
         $atts['title'],      
        do_shortcode( $content ),
		$button_html
      );
    } 
    else if($atts['layout']=="icon-box-feature")
    {

		$button_html='';
		if(!empty($atts['button_text']) && !empty($atts['button_url']))
		{
		  $button_html='<a  href="'.$atts['button_url'].'" class="btn tp-btn-primary tp-btn-lg">'.$atts['button_text'].'</a>';
		}		
      return sprintf( 
        '<div class="couple-block"><div class="couple-icon"><img src="%s" alt="" /></div><h2>%s</h2><p>%s<p>%s</div>',
         $atts['icon'],
         $atts['title'],      
        do_shortcode( $content ),
		$button_html
      );
    } 		   
    else if($atts['layout']=="icon-box-font")
    {
      return sprintf( 
        '<div class="feature-block feature-center mb30"><div class="feature-icon"><i class="icon icon-size-60 %s icon-default"></i></div><h2>%s</h2><p>%s</p></div>',
         $atts['icon'],
         $atts['title'],      
        do_shortcode( $content )
      );
    } 	
    else if($atts['layout']=="icon-square-font")
    {
      return sprintf( 
        '<div class="well-box feature-block text-center"><div class="feature-icon"><i class="%s icon-size-60 icon-light"></i></div><div class="feature-info"><h3>%s</h3><p>%s</p></div></div>',
         $atts['icon'],
         $atts['title'],      
        do_shortcode( $content )
      );
    } 		
}

/********************************************/
/*
/*		Location
/*
/********************************************/


add_shortcode( 'location', 'wedding_plugin_sc_location' );
function wedding_plugin_sc_location( $atts, $content ){  	
	
	return sprintf( 
        '<div class="mb30"><div class="vendor-image"><a href="%s"><img class="img-responsive" alt="" src="%s"></a> <a class="venue-lable" href="%s"><span class="label label-default">%s</span></a></div></div>',
         $atts['url'],
         $atts['image'],
		 $atts['url'],
		 $atts['title'],		       
        do_shortcode( $content )
      );
}

/********************************************/
/*
/*		Category
/*
/********************************************/


add_shortcode( 'category', 'wedding_plugin_sc_category' );
function wedding_plugin_sc_category( $atts, $content ){  	
	
	return sprintf( 
		'<div class="vendor-total-list mb30">
          <div class="vendor-total-thumb"><a href="%s"><img src="%s" class="img-responsive" alt=""></a></div>
          <div class="well-box vendor-total-info">
            <h2 class="vendor-total-title"><a href="%s" class="title">%s </a><span class="badge badge-primary">%s+</span> </h2>
          </div>
        </div>',		
         $atts['url'],
         $atts['image'],
		 $atts['url'],
		 $atts['title'],
		 $atts['count'],		       
        do_shortcode( $content )
      );
}


/********************************************/
/*
/*		Parallax
/*
/********************************************/

add_shortcode( 'parallax', 'wedding_plugin_sc_parallax' );
function wedding_plugin_sc_parallax( $atts, $content ){  	
	
	return sprintf( 
		'<section class="module parallax parallax-2" style="background-image:url(%s);">
		  <div class="container">
			<div class="row">
			  <div class="col-md-offset-2 col-md-8 parallax-caption">
				<h2>%s</h2>
				<p>%s</p>
				<a href="%s" class="btn tp-btn-primary">%s</a> </div>
			</div>
		  </div>
		</section>',		
         $atts['bg_img'],
         $atts['title'],
		 $atts['details'],
		 $atts['btn_url'],
		 $atts['btn_title'],		       
        do_shortcode( $content )
      );
}


/********************************************/
/*
/*		Alert
/*
/********************************************/

add_shortcode( 'alert', 'wedding_plugin_sc_alert' );
function wedding_plugin_sc_alert( $atts, $content ){	
    
	if(!empty($atts['class']))
	{
		$classes=$atts['class'];
	}
	else
	{
		$classes="alert-standard";
	}

    return sprintf( 
      '<div class="alert %s"> %s </div>',
      $classes,
      do_shortcode( $content )
    );
}

/********************************************/
/*
/*    Section
/*
/********************************************/

add_shortcode( 'section', 'wedding_plugin_sc_section' );
function wedding_plugin_sc_section( $atts, $content ){
   extract(shortcode_atts(array(
    'title' => 'Collapse',
    'id'  => false,
    'class' => false,
  ), $atts));
  

  $GLOBALS['section'][] = array( 
    'title'   =>  esc_attr($title) ,
    'id'    =>  esc_attr($id),
    'class'   =>  esc_attr($class) ,
    'content' =>  $content ,
  );

  $id  = "collapse-id-".$GLOBALS['collapsibles_count'];
  
    foreach( $GLOBALS['section'] as $tab ){     
    $class = ( !empty($tab['class']) && $tab['class']=="active" ) ? "panel-collapse collapse in"  : "panel-collapse collapse";    
    $__title = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($tab['title'])  );   
    $return = sprintf( "\n".'    
     <div class="panel panel-default">
      <div class="panel-heading">
          <h4 class="panel-title">    
            <a data-toggle="collapse" data-parent="#%s" href="#%s">%s </a>
          </h4>
      </div>      
      <div id="%s" class="%s">
          <div class="panel-body">             
          %s
          </div>
      </div>      
    </div>'."\n" , 
      $id, $__title, $tab['title'], $__title, $class, $tab['content']
    );    
    } // foreach    

  return do_shortcode($return);
  
}// function ending

/********************************************/
/*
/*    Accordion
/*
/********************************************/

add_shortcode( 'accordion', 'wedding_plugin_sc_accordion' );
function wedding_plugin_sc_accordion( $atts, $content ){ 
  
  if(isset( $GLOBALS['collapsibles_count'] )) {
    $GLOBALS['collapsibles_count']++;
  }else {
    $GLOBALS['collapsibles_count'] = 0; 
  }

  $id  = "collapse-id-".$GLOBALS['collapsibles_count'];

  return  do_shortcode(sprintf('<div class="accordion st-accordion"><div class="panel-group" id="%s"> %s </div></div> ', esc_attr($id), $content));
}

/********************************************/
/*
/*    Bootstrap Tabs.
/*
/********************************************/

add_shortcode( 'tab', 'wedding_plugin_sc_tabs' );
function wedding_plugin_sc_tabs( $atts, $content ){
  extract(shortcode_atts(array(
    'title' => 'Tab',
    'class' => false,
  ), $atts));
    
   $x = isset($GLOBALS['tab_count'])?$GLOBALS['tab_count']:0; 
   $GLOBALS['tab_count'] = isset($GLOBALS['tab_count'])?$GLOBALS['tab_count']:0;      

   $GLOBALS['tabs'][$GLOBALS['tabs_count']][$x] = array( 
      'title'   => esc_attr($title),
      'class'   => esc_attr($class),
      'content'   => $content,
   );
     
   $GLOBALS['tab_count']++;
}

/********************************************/
/*
/*    Tabgroup 
/*
/********************************************/

add_shortcode( 'tabgroup', 'wedding_plugin_sc_tabgroup' );
function wedding_plugin_sc_tabgroup( $atts, $content ){
  
    if( isset( $GLOBALS['tabs_count'] ) )
      $GLOBALS['tabs_count']++;
    else
      $GLOBALS['tabs_count'] = 0;

  do_shortcode( $content ); 

  if( is_array( $GLOBALS['tabs'][$GLOBALS['tabs_count']] ) ){
    
    $tabs=array();
    $panes=array();
    
    foreach( $GLOBALS['tabs'][$GLOBALS['tabs_count']] as $tab ){

    $panes_class  = ( !empty($tab["class"]) &&  $tab['class'] == "active" ) ? 'tab-pane active' : 'tab-pane';
    $__title = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($tab['title'])  );   
    $tabs[] = '<li  role="presentation" class="'.$tab['class'].'" >
            <a href="#'.$__title.'" data-toggle="tab">'.$tab['title'].'</a>
          </li>';
    $panes[] = sprintf( '<div class="%s" id="%s"> %s </div>',esc_attr($panes_class),esc_attr($__title), $tab['content']  );
    }

    $return = "\n".'<div role="tabpanel">
              <ul role="tablist" class="nav nav-tabs listnone">'
                .implode( "\n", $tabs ).
              '</ul>'."\n".
              '<div class="tab-content product-tab">'
                  .implode( "\n", $panes ).
              '</div>
            </div>'."\n";   
  } 
  return do_shortcode( sprintf('<div class="st-tabs"> %s </div>',  str_replace("<br />","",$return)));
}

/********************************************/
/*
/*    Scroll page.
/*
/********************************************/

add_shortcode( 'scroll', 'wedding_plugin_sc_scroll' );
function wedding_plugin_sc_scroll( $atts, $content ){
  extract(shortcode_atts(array(
    'title' => 'Scroll',
    'class' => false,
  ), $atts));
    
   $x = isset($GLOBALS['scroll_count'])?$GLOBALS['scroll_count']:0; 
   $GLOBALS['scroll_count'] = isset($GLOBALS['scroll_count'])?$GLOBALS['scroll_count']:0;      

   $GLOBALS['scrolls'][$GLOBALS['scrolls_count']][$x] = array( 
      'title'   => esc_attr($title),
      'class'   => esc_attr($class),
      'content'   => $content,
   );
     
   $GLOBALS['scroll_count']++;
}

/********************************************/
/*
/*    Tabgroup 
/*
/********************************************/

add_shortcode( 'scrollgroup', 'wedding_plugin_sc_scrollgroup' );
function wedding_plugin_sc_scrollgroup( $atts, $content ){
  
    if( isset( $GLOBALS['scrolls_count'] ) )
      $GLOBALS['scrolls_count']++;
    else
      $GLOBALS['scrolls_count'] = 0;

  do_shortcode( $content ); 

  if( is_array( $GLOBALS['scrolls'][$GLOBALS['scrolls_count']] ) ){
    
    $scrolls=array();
    $panes=array();
    
    foreach( $GLOBALS['scrolls'][$GLOBALS['scrolls_count']] as $scroll ){

    $panes_class  = ( !empty($scroll["class"]) &&  $scroll['class'] == "active" ) ? 'scroll-pane active' : 'scroll-pane';
    $__title = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($scroll['title'])  );   
    $scrolls[] = '<li class="'.$scroll['class'].'" >
            <a href="#'.$__title.'" >'.$scroll['title'].'</a>
          </li>';
    $panes[] = sprintf( '<div class="%s" id="%s"> %s </div>',esc_attr($panes_class),esc_attr($__title), $scroll['content']  );
    }

    $return = "\n".'<div class="row"><div id="leftCol" class="col-md-3 side-nav"><div class="hide-side">
              <ul id="sidebar" class="nav listnone">'
                .implode( "\n", $scrolls ).
              '</ul>'."\n".
              '</div></div><div class="col-md-9 content-right">'
                  .implode( "\n", $panes ).
              '</div>
            </div></div>'."\n";   
  } 
  return do_shortcode( sprintf('<div class="st-scrolls"> %s </div>',  str_replace("<br />","",$return)));
}


/********************************************/
/*
/*    FAQs
/*
/********************************************/

add_shortcode( 'question', 'wedding_plugin_sc_question' );
function wedding_plugin_sc_question( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => 'Collapse',
	'id'  => false,
	'class' => false,
	), $atts));  

	$GLOBALS['question'][] = array( 
	'title'   =>  esc_attr($title) ,
	'id'    =>  esc_attr($id),
	'content' =>  $content ,
	);
	
	foreach( $GLOBALS['question'] as $faq ){     
	$faq_title = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($faq['title'])  );   
	$return = sprintf( "\n".'<div class="question-answer">    
	  <h2><span class="question-sign">Q</span> %s ?</h2>      
	  <p>%s</p></div>'."\n" , $faq['title'], str_replace("<br />","",$faq['content'])
	);    
	} // foreach    

  return do_shortcode($return);
  
}// function ending

add_shortcode( 'faq', 'wedding_plugin_sc_faq' );
function wedding_plugin_sc_faq( $atts, $content ){ 
  
  if(isset( $GLOBALS['faq_count'] )) {
    $GLOBALS['faq_count']++;
  }else {
    $GLOBALS['faq_count'] = 0; 
  }
  $id  = "faq-boxes-id-".$GLOBALS['faq_count'];

  return  do_shortcode(sprintf('<div class="question-block" id="%s"> %s </div>', esc_attr($id), $content));
}

/********************************************/
/*
/*		space
/*
/********************************************/


add_shortcode( 'custom-box', 'wedding_plugin_sc_custom_box' );
function wedding_plugin_sc_custom_box( $atts, $content = null ){	    

	if(!empty($atts['class']))
	{
		$class=$atts['class'];
	}
	else{
		$class='default';
	}

    return sprintf( 
      '<div class="%s">%s</div>',
       $class,
      do_shortcode($content)
    );
}


/********************************************/
/*
/*		space
/*
/********************************************/

add_shortcode( 'space', 'wedding_plugin_sc_tp_space60' );
function wedding_plugin_sc_tp_space60( $atts, $content ){	
	$atts = shortcode_atts( array(
      "class" => "light",
	  "title" => "",
	  "sub-title" => false,	  
	), $atts );

	if(!empty($atts['title']))
	{
		$main_title=$atts['title'];

		$title_box='<div class="row"><div class="col-md-12 tp-title-center"><h1>'.$main_title.'</h1>';
				if(isset($atts['sub-title']) && !empty($atts['sub-title']))
				{
					$title_box.='<p>'.esc_html($atts['sub-title']).'</p>';
				}

		$title_box .='</div></div>';
	}
	else
	{
		$title_box='';
	}

    return sprintf( 
      '<div class="spacer '.$atts['class'].'"><div class="container">%s%s</div></div>',$title_box,
      do_shortcode( $content )
    );
}


/********************************************/
/*
/*    blog-block shorcode.
/*
/********************************************/

add_shortcode( 'blog-block', 'wedding_plugin_sc_blog_block' );
function wedding_plugin_sc_blog_block($atts)
{
	if(!empty($atts['title']))
	{
		$main_title=$atts['title'];

		$title_box='<div class="row"><div class="col-md-12 text-center mbtm-3"><h1>'.$main_title.'</h1>';
				if(!empty($atts['sub-title']))
				{
					$title_box.='<p>'.esc_html($atts['sub-title']).'</p>';
				}

		$title_box .='</div></div>';
	}
	else
	{
		$title_box='';
	}

	$args = array( 'post_type' => 'post' , 'posts_per_page' => -1 , 'orderby' => 'menu_order ID','order' => 'DESC','post_status'=> 'publish' );
	$loop = new WP_Query( $args );

	$content= "";
	$i=0;

	if($loop->have_posts())		
	{
		while ( $loop->have_posts() ) : $loop->the_post();
		
		$postid = get_the_ID();
		if(get_the_post_thumbnail($postid))
		{
		
			if($i<3)	
			{
			$byline = sprintf(
				esc_html_x( '%s', 'post author', 'weddingvendor' ),
				'<span class="meta-author">Posted By: <a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);
		
			if (( comments_open() || get_comments_number() ) ) {
			$comments= (get_comments_number()==1 || get_comments_number()==0?(esc_html__( ' Comment', 'weddingvendor' )):( esc_html__( ' Comments', 'weddingvendor' )));
			$comments_meta='<span class="meta-comment">('.get_comments_number().') <a href="'.get_comments_link().'">'.$comments.'</a></span>';
			}
		
			
			$content .= '<div class="col-md-4 mbtm-3 post-holder">
			<h2><a href="'.get_permalink($postid).'">'.get_the_title($postid).'</a></h2>
        <div class="post-img"><a href="'.get_permalink($postid).'">'.get_the_post_thumbnail($postid,'full',array('class'=>'img-responsive img-radius')).'</a> </div>
        <div class="post-meta"> <span class="meta-author">'.$byline.'</span> <span class="meta-comment">'.$comments_meta.'</span></div>
	    <p>'.get_the_excerpt().'</p>
        <a href="'.get_permalink($postid).'" class="btn-outline btn-outline-default">'.__( 'Read More', 'weddingvendor').'</a> </div>';
			$i++;
			}
		
		}
		endwhile;
		wp_reset_postdata();		
	}
    return  do_shortcode(sprintf('<div class="spacer"><div class="container">%s<div class="row"> %s </div></div></div>', $title_box, $content));		
}


/********************************************/
/*
/*    blog-block without img shorcode.
/*
/********************************************/

add_shortcode( 'faq-block', 'wedding_plugin_sc_faq_block' );
function wedding_plugin_sc_faq_block($atts)
{
	$args = array( 'post_type' => 'faq' , 'posts_per_page' => -1 , 'orderby' => 'menu_order ID','order' => 'DESC','post_status'=> 'publish' );
	$loop = new WP_Query( $args );

	$content = '';

	if($loop->have_posts())		
	{
		while ( $loop->have_posts() ) : $loop->the_post();
		
		$postid = get_the_ID();
		
		$answer_description = get_post_meta( $postid, 'answer_description', true );
		
		if(!empty($answer_description))
		{
			$answer_description='<p>'.$answer_description.'</p>';
		}
		
		$content .='<li class="list-group-item"><h2><span class="question-sign">Q</span>'.get_the_title($postid).'</h2>'.$answer_description.'</li>';
		

		endwhile;
		wp_reset_postdata();		
	}
    return  do_shortcode(sprintf('<div class="help-page"><ul class="list-group listnone"> %s </ul></div>', $content));		
}


/********************************************/
/*
/*    testimonial block shortcode.
/*
/********************************************/

add_shortcode( 'testimonial-block', 'wedding_testimonial_block' );
function wedding_testimonial_block($atts,$content)
{	   
	$content= '';

	$args = array( 'post_type' => 'testimonial','posts_per_page' => -1,'orderby' => 'menu_order ID','order'   => 'ASC');	
	$service = new WP_Query( $args );

	if(!empty($atts['title']))
	{
		$main_title=$atts['title'];

		$title_box='<div class="row"><div class="col-md-12 tp-title-center"><h1>'.$main_title.'</h1>';
				if(!empty($atts['sub-title']))
				{
					$title_box.='<p>'.esc_html($atts['sub-title']).'</p>';
				}

		$title_box .='</div></div>';
	}
	else
	{
		$title_box='';
	}

		while ( $service->have_posts() ) : $service->the_post();
		
		$postid = get_the_ID();
 
		$testimonials_date = get_post_meta( $postid, 'testimonials_date', true );
		if($testimonials_date)
		{
			$testimonials_date_string=date("D, dS M, Y", strtotime($testimonials_date));
		}

		$content .=	'<div class="item testimonial-block">
            <div class="couple-pic">'.get_the_post_thumbnail($postid,'full',array('class'=>'img-circle')).'</div>
            <div class="feedback-caption">
              <p>"'.get_post_meta( $postid, 'testimonials_details', true ).'"</p>
            </div>
            <div class="couple-info">
              <div class="name">'.get_the_title($postid).'</div>
              <div class="date">'.$testimonials_date_string.'</div>
            </div>
          </div>';

		endwhile;
		//wp_reset_postdata();		
	
	if(!empty($atts['class']))
	{
		$classes=" ".$atts['class'];
	}	
	else
	{
		$classes="";
	}

    return  do_shortcode(sprintf('<div class="spacer%s"><div class="container">%s<div class="row"><div class="col-md-12 tp-testimonial"><div class="owl-carousel owl-theme testimonial">%s</div></div></div></div></div>',$classes, $title_box, $content));		
}


/********************************************/
/*
/*    Featured Item shorcode.
/*
/********************************************/

add_shortcode( 'featured-block', 'wedding_featured_block' );
function wedding_featured_block($atts,$content)
{	   
	$content= '';

	$args = array( 'post_type' => 'item','post_status' => 'publish','posts_per_page' => -1,'orderby' => 'menu_order ID','order'   => 'ASC');	
	$service = new WP_Query( $args );

	if(!empty($atts['title']))
	{
		$main_title=$atts['title'];

		$title_box='<div class="row"><div class="col-md-12 tp-title-center"><h1>'.$main_title.'</h1>';
				if(!empty($atts['sub-title']))
				{
					$title_box.='<p>'.esc_html($atts['sub-title']).'</p>';
				}

		$title_box .='</div></div>';
	}
	else
	{
		$title_box='';
	}

		
		while ( $service->have_posts() ) : $service->the_post();
		
		$item_price_html='';
		
		$postid = get_the_ID(); 		
 		$item_address = get_post_meta( $postid, 'item_address', true );
		$item_price = get_post_meta( $postid, 'item_price', true );
        $item_maxprice = get_post_meta( $postid, 'item_maxprice', true );
		
		
		$featured_item = get_post_meta( $postid, 'featured_item', true );
		
		if(function_exists('tg_get_option'))
		{
			$currency_code = tg_get_option('currency_symbols');
		}
		else{
			$currency_code = '$';
		}
		
        if($item_maxprice)
		{
			$item_maxprice_html = ' - '.$currency_code.' '.$item_maxprice;
		}
		else{
			$item_maxprice_html = '';
		}

        if($item_price)
		{
			$item_price_html = '<div class="vendor-price"><div class="price">'.$currency_code.' '.$item_price.$item_maxprice_html.'</div></div>';
		}

		if($featured_item=="on")
		{
			$content .=	'<div class="col-md-4 vendor-box">
			<div class="vendor-image">
			  <a href="'.get_permalink($postid).'">'.get_the_post_thumbnail($postid,'weddingvendor_item_thumb',array('class'=>'img-responsive')).'</a>
			  <div class="feature-label"></div>
			</div>		
			<div class="vendor-detail">
			  <div class="caption">
				<h2><a class="title" href="'.get_permalink($postid).'">'.get_the_title($postid).'</a></h2>
				<p class="location"><i class="fa fa-map-marker"></i> '.$item_address.'</p>
			  </div>
			  '.$item_price_html.'
			</div></div>';
		}

		endwhile;
		//wp_reset_postdata();		
	
		if(!empty($atts['class']))
		{
			$classes=" ".$atts['class'];
		}
		else
		{
			$classes="";
		}

    return  do_shortcode(sprintf('<div class="spacer%s"><div class="container">%s<div class="row">%s</div></div></div>',$classes, $title_box, $content));		
}


/********************************************/
/*
/*    Login block shortcode.
/*
/********************************************/

add_shortcode( 'couple-login-block', 'wedding_couple_login_block' );
function wedding_couple_login_block($atts,$content)
{	

	if(!empty($atts['title']))
	{
		$main_title='<h2>'.$atts['title'].'</h2>';
	}
	else
	{
		$main_title='';
	}
	$content = '';
	if (!is_user_logged_in() ) {
	$ajax_login_nonce = wp_nonce_field('ajax-couple-login-nonce', 'security');
	$forgot_ajax_nonce = wp_nonce_field('forgot_ajax_nonce', 'security-forgot');
	$content = '<div class="vendor-login" id="home">
				  	'.$main_title.'
                    <form id="couplelogin" class="ajax-auth" method="post">
                      <p class="status"></p>  
                      '.$ajax_login_nonce.'
                      <!-- Text input-->
                      <div class="form-group">
                        <label class="control-label" for="email">'.__('Username','weddingvendor').'<span class="required">*</span></label>
                        <input id="username" name="username" type="text" placeholder="'.__('Username','weddingvendor').'" class="form-control input-md" required>
                      </div>
                      
                      <!-- Text input-->
                      <div class="form-group">
                        <label class="control-label" for="password">'.__('Password','weddingvendor').'<span class="required">*</span></label>
                        <input id="password" name="password" type="password" placeholder="'.__('Password','weddingvendor').'" class="form-control input-md" required>
                      </div>
                      
                      <!-- Button -->
                      <div class="form-group">
                        <button id="submit" name="submit"  type="submit" class="btn tp-btn-primary tp-btn-lg">'.__('Login','weddingvendor').'</button>
                        <a href="javascript:void(0);" id="select_forgot_pass" class="pull-right"> <small>'.__('Forgot Password','weddingvendor').'</small></a> </div>
                    </form>
                  </div>                  
                <div class="forgotpass_box">             
					<div class="form-group">
						<div class="loginalert" id="forgot_pass_area"></div>
						 <label class="control-label" for="password">'.__('Email','weddingvendor').'<span class="required">*</span></label>
						<input type="text" id="forgot_email" name="forgot_email" class="form-control input-md" required  />
						<input type="hidden" id="postid" name="postid" value="'.get_the_ID().'" /> 
					</div>
					<div class="form-group">
					'.$forgot_ajax_nonce.'
							<button id="wp_forgot" name="wp_forgot"  type="button" class="btn tp-btn-primary tp-btn-lg">'.__('Reset Password','weddingvendor').'</button>
							<a href="javascript:void(0);" id="return_login" class="pull-right"> <small>'.__('Return to Login','weddingvendor').'</small></a> </div>
				  </div>
                ';
	}
	else{
		$content = '<div class="vendor-login" id="home">
				  	'.$main_title.'	<p>'.__('You have already login','weddingvendor').'</p>
					<a class="btn tp-btn-default" href="'.home_url().'">'.__('Go to Home','weddingvendor').'</a>
					</div>
					';
	}

 return  do_shortcode(sprintf('<div class="login-boxes"><div class="well-box">%s</div></div>',$content));	

}


/********************************************/
/*
/*    Login block shortcode.
/*
/********************************************/

add_shortcode( 'login-block', 'wedding_login_block' );
function wedding_login_block($atts,$content)
{	

	if(!empty($atts['title']))
	{
		$main_title='<h2>'.$atts['title'].'</h2>';
	}
	else
	{
		$main_title='';
	}
	$content = '';
	if (!is_user_logged_in() ) {
	$ajax_login_nonce = wp_nonce_field('ajax-login-nonce', 'security');
	$forgot_ajax_nonce = wp_nonce_field('forgot_ajax_nonce', 'security-forgot');
	$content = '<div class="vendor-login" id="home">
				  	'.$main_title.'
                    <form id="login" class="ajax-auth" action="login" method="post">
                      <p class="status"></p>  
                      '.$ajax_login_nonce.'
                      <!-- Text input-->
                      <div class="form-group">
                        <label class="control-label" for="email">'.__('Username','weddingvendor').'<span class="required">*</span></label>
                        <input id="username" name="username" type="text" placeholder="Username" class="form-control input-md" required>
                      </div>
                      
                      <!-- Text input-->
                      <div class="form-group">
                        <label class="control-label" for="password">'.__('Password','weddingvendor').'<span class="required">*</span></label>
                        <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md" required>
                      </div>
                      
                      <!-- Button -->
                      <div class="form-group">
                        <button id="submit" name="submit"  type="submit" class="btn tp-btn-primary tp-btn-lg">'.__('Login','weddingvendor').'</button>
                        <a href="javascript:void(0);" id="select_forgot_pass" class="pull-right"> <small>'.__('Forgot Password','weddingvendor').'</small></a> </div>
                    </form>
                  </div>                  
                <div class="forgotpass_box">             
					<div class="form-group">
						<div class="loginalert" id="forgot_pass_area"></div>
						 <label class="control-label" for="password">'.__('Email','weddingvendor').'<span class="required">*</span></label>
						<input type="text" id="forgot_email" name="forgot_email" class="form-control input-md" required  />
						<input type="hidden" id="postid" name="postid" value="'.get_the_ID().'" /> 
					</div>
					<div class="form-group">
					'.$forgot_ajax_nonce.'
							<button id="wp_forgot" name="wp_forgot"  type="button" class="btn tp-btn-primary tp-btn-lg">'.__('Reset Password','weddingvendor').'</button>
							<a href="javascript:void(0);" id="return_login" class="pull-right"> <small>'.__('Return to Login','weddingvendor').'</small></a> </div>
				  </div>
                ';
	}
	else{
		$content = '<div class="vendor-login" id="home">
				  	'.$main_title.'	<p>'.__('You have already login','weddingvendor').'</p>
					<a class="btn tp-btn-default" href="'.home_url().'">'.__('Go to Home','weddingvendor').'</a>
					</div>
					';
	}

 return  do_shortcode(sprintf('<div class="login-boxes"><div class="well-box">%s</div></div>',$content));	

}
/********************************************/
/*
/*    Register block shortcode.
/*
/********************************************/
add_shortcode( 'register-block', 'wedding_register_block' );
function wedding_register_block($atts,$content)
{	
	if(!empty($atts['title']))
	{
		$main_title='<h2>'.$atts['title'].'</h2>';
	}
	else
	{
		$main_title='';
	}

	$content = '';

	if (!is_user_logged_in() ) {
	$ajax_register_nonce = wp_nonce_field('ajax-register-nonce', 'signonsecurity');
	$content = '<div class="register-form">
          		'.$main_title.'
			  <form id="register" class="ajax-auth"  action="register" method="post">
				'.$ajax_register_nonce.'    
				<p class="status"></p>     
				<!-- Text input-->
				<div class="form-group">
				  <label class="control-label" for="signonname">'.__('Username','weddingvendor').'<span class="required">*</span></label>
				  <input id="signonname" name="signonname" type="text" maxlength="15" minlength="4" placeholder="'.__('Username','weddingvendor').'" class="form-control input-md required">
				</div>
				
				<!-- Text input-->
				<div class="form-group mb30">
				  <label class="control-label" for="email">'.__('Email','weddingvendor').'<span class="required">*</span></label>
				  <input id="email" name="email" type="text" placeholder="'.__('Email','weddingvendor').'" class="form-control input-md required email">
				</div>
				
				<!-- Button -->
				<div class="form-group">
				  <input id="submit" name="submit" type="submit" class="submit_button btn tp-btn-primary tp-btn-lg" value="'.__('Create Account','weddingvendor').'">
				</div>
			  </form>
        	</div>';	
	}
	else{
		$content = '<div class="vendor-login" id="home">
				  	'.$main_title.'	<p>'.__('You have already login','weddingvendor').'</p>
					<a class="btn tp-btn-default" href="'.home_url().'">'.__('Go to Home','weddingvendor').'</a>
					</div>
					';		
	}

	return  do_shortcode(sprintf('<div class="register-boxes"><div class="well-box">%s</div></div>',$content));	
}

/********************************************/
/*
/*    Register block shortcode.
/*
/********************************************/
add_shortcode( 'couple-register-block', 'wedding_couple_register_block' );
function wedding_couple_register_block($atts,$content)
{	
	if(!empty($atts['title']))
	{
		$main_title='<h2>'.$atts['title'].'</h2>';
	}
	else
	{
		$main_title='';
	}

	$content = '';

	if (!is_user_logged_in() ) {
	$ajax_register_nonce = wp_nonce_field('ajax-couple-register-nonce', 'signonsecurity');
	$content = '<div class="register-form">
          		'.$main_title.'
			  <form id="coupleregister" class="ajax-auth"  action="coupleregister" method="post">
				'.$ajax_register_nonce.'    
				<p class="status"></p>     
				<!-- Text input-->
				<div class="form-group">
				  <label class="control-label" for="signonname">'.__('Username','weddingvendor').'<span class="required">*</span></label>
				  <input id="signonname" name="signonname" type="text" maxlength="15" minlength="4" placeholder="'.__('Username','weddingvendor').'" class="form-control input-md required">
				</div>
				
				<!-- Text input-->
				<div class="form-group mb30">
				  <label class="control-label" for="email">'.__('Email','weddingvendor').'<span class="required">*</span></label>
				  <input id="email" name="email" type="text" placeholder="'.__('Email','weddingvendor').'" class="form-control input-md required email">
				</div>

				<!-- Text input-->
				<div class="form-group mb30">
				  <label class="control-label" for="weddingdate">'.__('Wedding Date','weddingvendor').'<span class="required">*</span></label>
				  <input id="weddingdate" name="weddingdate" type="text" placeholder="'.__('Wedding Date','weddingvendor').'" class="form-control input-md book_date check_book_date required" readonly="readonly">
				</div>				
				
				<!-- Button -->
				<div class="form-group">
				  <input id="submit" name="submit" type="submit" class="submit_button btn tp-btn-primary tp-btn-lg" value="'.__('Create Account','weddingvendor').'">
				</div>
			  </form>
        	</div>';	
	}
	else{
		$content = '<div class="vendor-login" id="home">
				  	'.$main_title.'	<p>'.__('You have already login','weddingvendor').'</p>
					<a class="btn tp-btn-default" href="'.home_url().'">'.__('Go to Home','weddingvendor').'</a>
					</div>
					';		
	}

	return  do_shortcode(sprintf('<div class="register-boxes"><div class="well-box">%s</div></div>',$content));	
}
?>