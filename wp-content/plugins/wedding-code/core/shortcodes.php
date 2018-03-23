<?php
/***********  SHORTCODE ******************/
define('BASE_URL',plugin_dir_url( __FILE__ ));
function wedding_plugin_load_admin_script() {
    wp_register_style( 'custom_wp_admin_css', BASE_URL . 'css/grid12.css');
    wp_enqueue_style( 'custom_wp_admin_css' );		
    wp_enqueue_script( 'jquery' );		
 	wp_enqueue_style( 'wedding-font-awesome', BASE_URL . 'css/font-awesome.css' );
 	wp_enqueue_style( 'wedding-panel', BASE_URL . 'css/panel.css' );				
   		
    wp_register_script( 'custom_wp_admin_js', BASE_URL . 'js/bootstrap.js', true, '1.0.0' );
    wp_enqueue_script( 'custom_wp_admin_js' );		

	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'plugin-color-script', BASE_URL.'js/color.js', array( 'wp-color-picker' ), '', true );


    wp_register_script( 'custom_script', BASE_URL . 'js/custom.js', true, '1.0.0' );
    wp_enqueue_script( 'custom_script' );
}


add_action( 'admin_enqueue_scripts', 'wedding_plugin_load_admin_script' );


function wedding_plugin_shortcode_style()
{
	wp_enqueue_style( 'custom-css', BASE_URL . 'css/custom.css');	

	if( is_page_template('page-templates/user-profile.php') || is_page_template('page-templates/couple-profile.php') ||  is_page_template('page-templates/add-listing.php') ){
	wp_enqueue_script('ajax-upload', BASE_URL.'/js/ajax-upload.js',array('jquery','plupload-handlers'), '2.0', true);  
		wp_localize_script('ajax-upload', 'ajax_vars', 
		array(  'ajaxurl'           => admin_url('admin-ajax.php'),
				'nonce'             => wp_create_nonce('aaiu_upload'),
				'remove'            => wp_create_nonce('aaiu_remove'),
				'number'            => 1,
				'upload_enabled'    => true,
				'path'              =>  BASE_URL,
				'confirmMsg'        => __('Are you sure you want to delete this?','weddingvendor'),
				'plupload'         => array(
										'runtimes'          => 'html5,flash,html4',
										'browse_button'     => 'aaiu-uploader',
										'container'         => 'aaiu-upload-container',
										'file_data_name'    => 'aaiu_upload_file',
										'max_file_size'     => '4mb',
										'url'               => admin_url('admin-ajax.php') . '?action=weddingvendor_upload_file&nonce=' . wp_create_nonce('aaiu_allow'),
										'flash_swf_url'     => includes_url('js/plupload/plupload.flash.swf'),
										'silverlight_xap_url' =>  includes_url('js/plupload/plupload.silverlight.xap'),
										'filters'           => array(array('title' => __('Allowed Files','weddingvendor'), 'extensions' => "jpeg,jpg,gif,png")),
										'multipart'         => true,
										'urlstream_upload'  => true,									   
					 
										)	)
				);	
	}

	if(is_page_template('page-templates/add-listing.php'))
	{
		wp_enqueue_script('ajax-upload', BASE_URL.'/js/ajax-upload.js',array('jquery','plupload-handlers'), '2.0', true);  
		wp_localize_script('ajax-upload', 'ajax_vars', 
		array(  'ajaxurl'           => admin_url('admin-ajax.php'),
				'nonce'             => wp_create_nonce('aaiu_upload'),
				'remove'            => wp_create_nonce('aaiu_remove'),
				'number'            => 1,
				'upload_enabled'    => true,
				'path'              =>  BASE_URL,
				'confirmMsg'        => __('Are you sure you want to delete this?','weddingvendor'),
				'plupload'         => array(
										'runtimes'          => 'html5,flash,html4',
										'browse_button'     => 'aaiu-uploader',
										'container'         => 'aaiu-upload-container',
										'file_data_name'    => 'aaiu_upload_file',
										'max_file_size'     => '4mb',
										'url'               => admin_url('admin-ajax.php') . '?action=weddingvendor_upload_file&nonce=' . wp_create_nonce('aaiu_allow'),
										'flash_swf_url'     => includes_url('js/plupload/plupload.flash.swf'),
										'silverlight_xap_url' => includes_url('js/plupload/plupload.silverlight.xap'),
										'filters'           => array(array('title' => __('Allowed Files','weddingvendor'), 'extensions' => "jpeg,jpg,gif,png")),
										'multipart'         => true,
										'urlstream_upload'  => true,									   
					 
										)	)
				);		
	}	

}

add_action( 'wp_enqueue_scripts', 'wedding_plugin_shortcode_style' );

add_action('media_buttons','wedding_plugin_shortcode_button',11);

function wedding_plugin_shortcode_button(){
echo '<a class="thickbox button button-default" id="tb_column"> Columns </a>';
echo '<a class="thickbox button button-default" id="tb_open"> Shortcodes </a>';

	echo '<div id="my-column-id" style="display:none;">
			<div id="main-content-column">
				<div class="row">
					<div class="col-md-3">
						<a class="thickbox box-column" id="tb_box1"><img src="'.BASE_URL.'/icon/100.jpg"></a>
					</div>
					<div class="col-md-3">
						<a class="thickbox box-column" id="tb_box2"><img src="'.BASE_URL.'/icon/50.jpg"></a>
					</div>
					<div class="col-md-3">
						<a class="thickbox box-column" id="tb_box3"><img src="'.BASE_URL.'/icon/33.jpg"></a>
					</div>
					<div class="col-md-3">
						<a class="thickbox box-column" id="tb_box4"><img src="'.BASE_URL.'/icon/25.jpg"></a>
					</div>				
				</div>	
				<div class="row">
					<div class="col-md-3">
						<a class="thickbox box-column" id="tb_box5"><img src="'.BASE_URL.'/icon/25-75.jpg"></a>
					</div>
					<div class="col-md-3">
						<a class="thickbox box-column" id="tb_box6"><img src="'.BASE_URL.'/icon/75-25.jpg"></a>
					</div>
					<div class="col-md-3">
						<a class="thickbox box-column" id="tb_box7"><img src="'.BASE_URL.'/icon/50-25-25.jpg"></a>
					</div>
					<div class="col-md-3">
						<a class="thickbox box-column" id="tb_box8"><img src="'.BASE_URL.'/icon/25-25-50.jpg"></a>
					</div>				
				</div>	
				<div class="row">
					<div class="col-md-3">
						<a class="thickbox box-column" id="tb_box10"><img src="'.BASE_URL.'/icon/container.jpg"></a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h2>Inner Columns</h2>
					</div>
				</div>		
				<div class="row">
					<div class="col-md-3">
						<a class="thickbox box-column" id="tb_box21"><img src="'.BASE_URL.'/icon/50.jpg"></a>
					</div>
					<div class="col-md-3">
						<a class="thickbox box-column" id="tb_box22"><img src="'.BASE_URL.'/icon/33.jpg"></a>
					</div>
					<div class="col-md-3">
						<a class="thickbox box-column" id="tb_box23"><img src="'.BASE_URL.'/icon/25.jpg"></a>
					</div>				
					<div class="col-md-3">
						<a class="thickbox box-column" id="tb_box24"><img src="'.BASE_URL.'/icon/75-25.jpg"></a>
					</div>
				</div>													
				<div id="insert-html"></div>
			</div>  
		  </div>';
	
	echo '<div id="my-content-id" style="display:none;">
<div class="">
<div class="row">
  <div class="col-md-3">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs tabs-left" role="tablist">
    <li role="presentation"  class="active"><a href="#feature_block" aria-controls="settings" role="tab" data-toggle="tab">Feature Block</a></li>	    <li role="presentation"><a href="#list_view" aria-controls="settings" role="tab" data-toggle="tab">Icon Lists</a></li>   
    <li role="presentation"><a href="#accordion" aria-controls="home" role="tab" data-toggle="tab">Accordion</a></li>
    <li role="presentation"><a href="#tabs" aria-controls="profile" role="tab" data-toggle="tab">Tabs</a></li>
    <li role="presentation"><a href="#alert" aria-controls="messages" role="tab" data-toggle="tab">Alerts</a></li>
    <li role="presentation"><a href="#iconbox" aria-controls="settings" role="tab" data-toggle="tab">IconBox</a></li>
    <li role="presentation"><a href="#divider" aria-controls="settings" role="tab" data-toggle="tab">Divider</a></li>
    <li role="presentation"><a href="#buttons" aria-controls="settings" role="tab" data-toggle="tab">Button</a></li>
    <li role="presentation"><a href="#faq" aria-controls="settings" role="tab" data-toggle="tab">FAQs</a></li>
  </ul>
  </div>

<div class="col-md-9">
  <!-- Tab panes -->
  <div class="tab-content">   
	<!-- ACCORDION -->	
	<div role="tabpanel" class="tab-pane" id="accordion">
	<div class="col-md-12">
	<div class="row">
	  <ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#acc_preview" aria-controls="acc_preview" 
		role="tab" data-toggle="tab">Preview</a></li>
		<li role="presentation"><a href="#ACC_CODE" aria-controls="profile" role="tab" 
		data-toggle="tab">Code</a></li>
	  </ul>
	  <div class="col-md-12">
		<div class="tab-content">
		  <div role="tabpanel" class="tab-pane active" id="acc_preview">
			<div class="" id="acc_preview">
			  <div class="panel-group" id="accordion_inner">
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h4 class="panel-title"> 
					<span class="remove dashicons dashicons-no" style="float:right;"></span>
					<a data-toggle="collapse" id="title_acc_1" data-parent="#accordion" href="#yourtitle1" 
					class="collapsed panel_title" aria-expanded="false"> Your title #1 </a> 
					</h4>
				  </div>
				  <div id="yourtitle1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
					<div class="panel-body">
						<input id="acc_1" style="width:100%;" class="panel_input" onKeyPress="call_title(this.id)" 
						onKeyUp="call_title(this.id)" value="Your title here #1">
						<textarea style="width:100%;height:100px;" id="desc_acc_1" class="panel_textarea " onKeyPress="call_desc(this.id)" 
						onKeyUp="call_desc(this.id)">Your Description here #1</textarea>
					</div>
				  </div>
				</div>
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h4 class="panel-title"> 
					<span class="remove dashicons dashicons-no" style="float:right;"></span>
					<a data-toggle="collapse" id="title_acc_2" data-parent="#accordion" href="#yourtitle2" 
					class="collapsed panel_title" aria-expanded="false"> Your title #2 </a> </h4>
				  </div>
				  <div id="yourtitle2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
					<div class="panel-body">
						<input id="acc_2" style="width:100%;" class="panel_input" onKeyPress="call_title(this.id)" 
						onKeyUp="call_title(this.id)" value="Your title here #2">
						<textarea style="width:100%;height:100px;" id="desc_acc_2" class="panel_textarea" onKeyPress="call_desc(this.id)" 
						onKeyUp="call_desc(this.id)">Your Description here #2</textarea>
					</div>
				  </div>
				</div>
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h4 class="panel-title"> 
					<span class="remove dashicons dashicons-no" style="float:right;"></span>
					<a data-toggle="collapse" id="title_acc_3" data-parent="#accordion" href="#yourtitle3" 
					class="collapsed panel_title" aria-expanded="false"> Your title #3 </a> </h4>
				  </div>
				  <div id="yourtitle3" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
					<div class="panel-body">
						<input id="acc_3" style="width:100%;" class="panel_input" onKeyPress="call_title(this.id)" 
						onKeyUp="call_title(this.id)" value="Your title here #3">
						<textarea style="width:100%;height:100px;" id="desc_acc_3" class="panel_textarea " onKeyPress="call_desc(this.id)" 
						onKeyUp="call_desc(this.id)">Your Description here #3</textarea>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
			<div role="tabpanel" class="tab-pane" id="ACC_CODE">
				<pre><code>[accordion]<span id="acc_code_1">
				<span id="title_code_acc_1">[section title=&quot; Your title #1&quot; class=&quot;active&quot;]</span>
				<span id="code_desc_acc_1">Your Description here #1</span>
				[/section]</span><span id="acc_code_2">
				<span id="title_code_acc_2">[section title=&quot; Your title #2&quot;]</span>
				<span id="code_desc_acc_2">Your Description here #2</span>
				[/section]</span><span id="acc_code_3">
				<span id="title_code_acc_3">[section title=&quot; Your title #3&quot;]</span>
				<span id="code_desc_acc_3">Your Description here #3</span>
				[/section]</span><span id="acc_here"></span>
				[/accordion]</code></pre></div>
		</div>
		<p>
		  <button class="button button-primary insert-code">Insert Code</button>
		  <button class="add_accordion button button-primary">Add New Accordion</button>
		</p>
	  </div>
	</div>	
	</div>
	</div>
    <!-- ACCORDION_END -->	

<!-- TABS -->
    <div role="tabpanel" class="tab-pane" id="tabs">
	<div class="col-md-12">
		<div class="row">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#TAB_PREVIEW" aria-controls="TAB_PREVIEW" 
			role="tab" data-toggle="tab">Preview</a></li>
			<li role="presentation"><a href="#TAB_CODE" aria-controls="TAB_CODE" role="tab" 
			data-toggle="tab">Code</a></li>
		</ul>
  <div class="col-md-12">
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="TAB_PREVIEW">        
            <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist" id="tab_title">			    			    
                <li role="presentation" class="active">
				<a href="#tab1" id="title_tabs_1" aria-controls="tab1" role="tab" data-toggle="tab" aria-expanded="true">TAB #1</a>
				<span class="tab_remove dashicons dashicons-no" style="float:left;"></span>
				</li>				
                <li role="presentation">
				<a href="#tab2" aria-controls="tab2" id="title_tabs_2" role="tab" data-toggle="tab" aria-expanded="false">TAB #2</a>
				<span class="tab_remove dashicons dashicons-no" style="float:left;"></span>
				</li>				
                <li role="presentation">				
				<a href="#tab3" aria-controls="tab3" id="title_tabs_3" role="tab" data-toggle="tab" aria-expanded="false">TAB #3</a>
				<span class="tab_remove dashicons dashicons-no" style="float:left;"></span>
				</li>
              </ul>            
              <!-- Tab panes -->
              <div class="tab-content" id="tab_desc">
                <div role="tabpanel" class="tab-pane active" id="tab1"> 
					<input id="tabs_1" class="" style="width:100%;" onKeyPress="call_tab_title(this.id)" 
					onKeyUp="call_tab_title(this.id)" value="TAB #1">
					<textarea style="width:100%;height:100px;" id="desc_tabs_1" class="" onKeyPress="call_tab_desc(this.id)" 
					onKeyUp="call_tab_desc(this.id)">Description #1</textarea>
				</div>
                <div role="tabpanel" class="tab-pane" id="tab2"> 
					<input id="tabs_2" class="" style="width:100%;" onKeyPress="call_tab_title(this.id)" 
					onKeyUp="call_tab_title(this.id)" value="TAB #2">
					<textarea style="width:100%;height:100px;" id="desc_tabs_2" class="" onKeyPress="call_tab_desc(this.id)" 
					onKeyUp="call_tab_desc(this.id)">Description #2</textarea>
				</div>
                <div role="tabpanel" class="tab-pane" id="tab3"> 
					<input id="tabs_3" class="" style="width:100%;" onKeyPress="call_tab_title(this.id)" 
					onKeyUp="call_tab_title(this.id)" value="TAB #3">
					<textarea style="width:100%;height:100px;" id="desc_tabs_3" class="" onKeyPress="call_tab_desc(this.id)" 
					onKeyUp="call_tab_desc(this.id)">Description #3</textarea>
				</div>
           </div>          
      </div>
      <div role="tabpanel" class="tab-pane" id="TAB_CODE">
		<pre><code>  
		[tabgroup]<span id="tab_code_1"> 
		<span id="title_code_tabs_1">[tab title=&quot;Your title #1&quot; class=&quot;active&quot;]</span>
		<span id="code_desc_tabs_1">Your Description here #1</span>
		[/tab]</span><span id="tab_code_2"> 
		<span id="title_code_tabs_2">[tab title=&quot;Your title #2&quot;]</span>
		<span id="code_desc_tabs_2">Your Description here #2</span>
		[/tab]</span><span id="tab_code_3"> 
		<span id="title_code_tabs_3">[tab title=&quot;Your title #3&quot;]</span>
		<span id="code_desc_tabs_3">Your Description here #3</span>
		[/tab]</span><span id="tabs_add"></span>
		[/tabgroup]
		</code></pre>
      </div>
    </div>
    <p>
      <button class="button button-primary insert-code">Insert Code</button>
      <button class="add_tabs button button-primary">Add New Tabs</button>
    </p>
  </div>
</div>	
</div>
	</div>

    <div role="tabpanel" class="tab-pane" id="alert">
  	    <div class="row">
	    	<div class="col-md-12">
	    	<h2>Alerts</h2>
		    	<div class="row">
		    		<div class="col-md-3">
		    			<span class="call-alert"><img class="alert-success" src="'.BASE_URL.'/icon/alert-success.jpg"></span>
		    		</div>
		    		<div class="col-md-3">
		    			<span class="call-alert"><img class="alert-info" src="'.BASE_URL.'/icon/alert-info.jpg"></span>
		    		</div>
		    		<div class="col-md-3">
		    			<span class="call-alert"><img class="alert-warning" src="'.BASE_URL.'/icon/alert-creat.jpg"></span>
		    		</div>
		    		<div class="col-md-3">
		    			<span class="call-alert"><img class="alert alert-danger" src="'.BASE_URL.'/icon/alert-warning.jpg"></span>
		    		</div>
		    	</div>
	    	</div>			      
	    </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="iconbox">
  	    <div class="row">
	    	<div class="col-md-12">
	    	  <h2>IconBox</h2>
			  <ul class="nav nav-tabs" role="tablist">
				    <li role="presentation" class="active"><a href="#icon_box_preview" aria-controls="icon_box_preview" 
				    role="tab" data-toggle="tab">Section</a></li>
				    <li role="presentation"><a href="#icon_box_layout" aria-controls="icon_box_layout" role="tab" 
				    data-toggle="tab">Layout</a></li>
			   </ul> 
			     <div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="icon_box_preview">
				    <div class="box_margin_bottom"></div>
			    	 <div class="row">
				    	<div class="col-md-4 box_margin_bottom">
				    		<div class="icon_title">Icon URL/Icon Font <a href="http://thegenius.co//wedding/icons/" target="_blank">Here</a></div>
				    	</div>
				    	<div class="col-md-8 box_margin_bottom">
					    	<input type="text" name="icon_select" class="right-icon-box" id="icon_select" />		    	
				    	</div>
				    </div>	

				     <div class="row">
				    	<div class="col-md-4 box_margin_bottom">
				    		<div class="icon_title">Title</div>
				    	</div>
				    	<div class="col-md-8 box_margin_bottom">
				    	<input type="text" name="icon_title" id="icon_title" class="right-icon-box">				    	
				    	</div>
				    </div>	

				    <div class="row">	
				    	<div class="col-md-4 box_margin_bottom">
				    		<div class="icon_title">Description</div>
				    	</div>
				    	<div class="col-md-8 box_margin_bottom">
				    	<textarea name="icon_desc" id="icon_desc" class="right-icon-box"></textarea>
				    	</div>
				    </div>	
				
				     <div class="row">
				    	<div class="col-md-4 box_margin_bottom">
				    		<div class="icon_title">Button Text</div>
				    	</div>
				    	<div class="col-md-8 box_margin_bottom">
				    	<input type="text" name="button_text" id="button_text" class="right-icon-box">				    	
				    	</div>
				    </div>	

				     <div class="row">
				    	<div class="col-md-4 box_margin_bottom">
				    		<div class="icon_title">Button URL</div>
				    	</div>
				    	<div class="col-md-8 box_margin_bottom">
				    	<input type="text" name="button_url" id="button_url" class="right-icon-box">				    	
				    	</div>
				    </div>											

				    <div class="row">
				    	<div class="col-md-12 box_margin_bottom">
				    			  <button class="button button-primary insert-icon-box">Insert Code</button>
				    	</div>
				    </div>	
				    </div>

				    <div role="tabpanel" class="tab-pane" id="icon_box_layout">
				    	<div class="row">
				    		<div class="col-md-4">
				    			<span class="call-icon-box"><img id="icon-box-left" src="'.BASE_URL.'/icon/iconbox1.jpg"></span>
				    		</div>
				    		<div class="col-md-4">
				    			<span class="call-icon-box"><img id="icon-box-center" src="'.BASE_URL.'/icon/iconbox2.jpg"></span>
				    		</div>
				    		<div class="col-md-4">
				    			<span class="call-icon-box"><img id="icon-box-right" src="'.BASE_URL.'/icon/iconbox3.jpg"></span>
				    		</div>    		
				    	</div>	
				    	<div class="row">
				    		<div class="col-md-4">
				    			<span class="call-icon-box"><img id="icon-box-main" src="'.BASE_URL.'/icon/blue-left-icon.jpg"></span>
				    		</div>    		
				    		<div class="col-md-4">
				    			<span class="call-icon-box"><img id="icon-box-feature" src="'.BASE_URL.'/icon/green-center-icon.jpg"></span>
				    		</div>
				    		<div class="col-md-4">
				    			<span class="call-icon-box"><img id="icon-box-font" src="'.BASE_URL.'/icon/iconbox-font.jpg"></span>
				    		</div>							
				    	</div>	
				    	<div class="row">
				    		<div class="col-md-4">
				    			<span class="call-icon-box"><img id="icon-square-font" src="'.BASE_URL.'/icon/icon-square-font.jpg"></span>
				    		</div>   
						</div>																	
				    </div>
			     </div>			  
	    	</div>
	    </div>		
    </div>
    <div role="tabpanel" class="tab-pane" id="divider">
  	    <div class="row">
	    	<div class="col-md-12">
	    	<h2>Divider</h2>
		    	<div class="row">
		    		<div class="col-md-3">
		    			<span class="call-divider"><img class="divi-solid" src="'.BASE_URL.'/icon/solid_line.jpg"></span>
		    		</div>
		    		<div class="col-md-3">
		    			<span class="call-divider"><img class="divi-dashed" src="'.BASE_URL.'/icon/dashed_line.jpg"></span>
		    		</div>
		    		<div class="col-md-3">
		    			<span class="call-divider"><img class="divi-dotted" src="'.BASE_URL.'/icon/dotted_line.jpg"></span>
		    		</div>
		    		<div class="col-md-3">
		    			<span class="call-divider"><img class="divi-grove" src="'.BASE_URL.'/icon/grove_line.jpg"></span>
		    		</div>		    		
		    	</div>
	    	</div>			      
	    </div>
    </div>
	<div role="tabpanel" class="tab-pane" id="buttons">
	<div class="row">
		<div class="col-md-12">
			<h2>Buttons</h2>
			<hr>
			<div class="row">
				<div class="col-md-6">
					<span class="call-button"><img class="btn tp-btn-default" src="'.BASE_URL.'/icon/primary-btn.png"></span>
				</div>
				<div class="col-md-6">
					<span class="call-button"><img class="btn tp-btn-primary" src="'.BASE_URL.'/icon/second-btn.png"></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<span class="call-button"><img class="btn tp-btn-default tp-btn-lg" src="'.BASE_URL.'/icon/primary-btn-large.png"></span>
				</div>

				<div class="col-md-6">
					<span class="call-button"><img class="btn tp-btn-primary tp-btn-lg" src="'.BASE_URL.'/icon/second-btn-large.png"></span>
				</div>
			</div>
		</div>
	</div>
	</div>

	<!-- FAQ -->	
	<div role="tabpanel" class="tab-pane" id="faq">
	<div class="col-md-12">
	<div class="row">
	  <ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#faq_preview" aria-controls="faq_preview" 
		role="tab" data-toggle="tab">Preview</a></li>
		<li role="presentation"><a href="#faq_code" aria-controls="profile" role="tab" 
		data-toggle="tab">Code</a></li>
	  </ul>
	  <div class="col-md-12">
		<div class="tab-content">
		  <div role="tabpanel" class="tab-pane active" id="faq_preview">
			<div class="call_faq_class_main">
			  <div class="panel-group" id="call_faq_class">
				<div class="panel-faq">
					<input id="faq_1" style="width:100%;" class="panel_input" onKeyPress="faq_title(this.id)" 
					onKeyUp="faq_title(this.id)" value="Your Question here #1">
					<textarea style="width:100%;height:60px;" id="code_faq_1" class="panel_textarea " onKeyPress="faq_answer(this.id)" 
					onKeyUp="faq_answer(this.id)">Your Description here #1</textarea>
				</div>
				<div class="panel-faq">
					<input id="faq_2" style="width:100%;" class="panel_input" onKeyPress="faq_title(this.id)" 
					onKeyUp="faq_title(this.id)" value="Your Question here #2">
					<textarea style="width:100%;height:60px;" id="code_faq_2" class="panel_textarea" onKeyPress="faq_answer(this.id)" 
					onKeyUp="faq_answer(this.id)">Your Description here #2</textarea>
				</div>
				<div class="panel-faq">
					<input id="faq_3" style="width:100%;" class="panel_input" onKeyPress="faq_title(this.id)" 
					onKeyUp="faq_title(this.id)" value="Your Question here #3">
					<textarea style="width:100%;height:60px;" id="code_faq_3" class="panel_textarea " onKeyPress="faq_answer(this.id)" 
					onKeyUp="faq_answer(this.id)">Your Answer here #3</textarea>
				</div>
			  </div>
			</div>
		  </div>
		  <div role="tabpanel" class="tab-pane" id="faq_code">
			<pre><code>[faq]<span id="ques_code_1">
			<span id="ques_code_faq_1">[question title=&quot; Your Question #1&quot; ]
			</span><span id="ans_code_faq_1">Your Answer here #1</span>
			[/question]</span>
			<span id="ques_code_2"><span id="ques_code_faq_2">[question title=&quot; Your Question #2&quot;]</span>
			<span id="ans_code_faq_2">Your Answer here #2</span>
			[/question]</span><span id="ques_code_3">
			<span id="ques_code_faq_3">[question title=&quot; Your Question #3&quot;]</span>
			<span id="ans_code_faq_3">Your Answer here #3</span>
			[/question]</span><span id="faq_here"></span>
			[/faq]</code></pre>
		  </div>
		</div>
		<p>
		  <button class="button button-primary insert-code">Insert Code</button>
		  <button class="add_faq button button-primary">Add FAQ</button>
		</p>
	  </div>
	</div>	
	</div>
	</div>
    <!-- FAQ_END -->	

    <div role="tabpanel" class="tab-pane" id="list_view">
	    <div class="row">
	    	<div class="col-md-12">
	    	<h2>Icon Lists</h2>
		    	<div class="row">
		    		<div class="col-md-3">
		    			<span class="call-list-view"><img class="list-ol" src="'.BASE_URL.'/icon/list-number.jpg"></span>
		    		</div>
		    		<div class="col-md-3">
		    			<span class="call-list-view"><img class="circle-o listnone" src="'.BASE_URL.'/icon/list-circle-thin.jpg"></span>
		    		</div>
		    		<div class="col-md-3">
		    			<span class="call-list-view"><img class="angle-double-right listnone" src="'.BASE_URL.'/icon/list-double-arrow.jpg"></span>
		    		</div>
		    		<div class="col-md-3">
		    			<span class="call-list-view"><img class="long-arrow-right listnone" src="'.BASE_URL.'/icon/list-long-arrow.jpg"></span>
		    		</div>
		    	</div>
				<br>
		    	<div class="row">
		    		<div class="col-md-3">
		    			<span class="call-list-view"><img class="arrow-right listnone list-view" src="'.BASE_URL.'/icon/list-arrow-thick.jpg"></span>
		    		</div>
		    		<div class="col-md-3">
		    			<span class="call-list-view"><img class="checked listnone" src="'.BASE_URL.'/icon/list-right-tick.jpg"></span>
		    		</div>
		    	</div>
	    	</div>			      
	    </div>
    </div>   
	<div role="tabpanel" class="tab-pane active" id="feature_block">
		<div class="row">
			<div class="col-md-12">
				<h2>Feature Block</h2>
				<div class="row">
					<div class="col-md-4"><img class="feature-block" id="testimonial-block" src="'.BASE_URL.'/icon/testimonial.jpg">Testimonial [Title]</div>
					<div class="col-md-4"><img class="feature-block" id="location" src="'.BASE_URL.'/icon/location.jpg">Location</div>
					<div class="col-md-4"><img class="feature-block" id="space" src="'.BASE_URL.'/icon/space-60-tb.jpg">Space</div>
				</div>	
				<div class="row">

					<div class="col-md-4"><img class="feature-block" id="featured-block" src="'.BASE_URL.'/icon/featured-item.jpg">Featured Item</div>
					
					<div class="col-md-4"><img class="feature-block" id="register-block" id="space" src="'.BASE_URL.'/icon/register.png">Vendor Register[Title]</div>
					<div class="col-md-4"><img class="feature-block" id="login-block" id="featured-block" src="'.BASE_URL.'/icon/login.png">Vendor Login[Title]</div>

					
				</div>		
				<div class="row">
					<div class="col-md-4"><img class="feature-block" id="couple-register-block" id="space" src="'.BASE_URL.'/icon/register.png">Couple Register[Title]</div>
					<div class="col-md-4"><img class="feature-block" id="couple-login-block" id="featured-block" src="'.BASE_URL.'/icon/login.png">Couple Login[Title]</div>				
					<div class="col-md-4"><img class="feature-block" id="onepage" src="'.BASE_URL.'/icon/one-page.jpg">One Page</div>					
				</div>								
				<div class="row">
					<div class="col-md-4"><img class="feature-block" id="category" src="'.BASE_URL.'/icon/category.jpg">Category [Title]</div>
					<div class="col-md-4"><img class="feature-block" id="parallax" src="'.BASE_URL.'/icon/parallax.jpg">Parallax</div>
				</div>				
			</div>
		</div>		
	</div>
  </div>
</div>
</div>
</div>
</div>';
}