<?php   
function wedding_plugin_show_import_page()
{
	if(!is_admin()) return;
	
	global $plugin_domain;
	include WEDDING_PLUGIN_DIR .'/importer/xmldata.importer.php';
	Wedding_Plugin_Importer::wedding_add_css();
	
	if(isset($_REQUEST['start_import']) and $_REQUEST['start_import'])
	{
		if(class_exists('Wedding_Plugin_Importer'))
		{
		  Wedding_Plugin_Importer::init();
		  die();
		}
	}
}
add_action('admin_init','wedding_plugin_show_import_page');


function tg_plugin_get_html_import(){
		$html = 'The Demo content is a replication of the Live Content. By importing it, you could get several sliders, items, FAQ, testimonial, pages, posts, theme options, widgets, sidebars and other settings.
To be able to get them, make sure that you have installed and activated these plugins:  Contact form 7, Breadcrumb NavXT, Nav Menu Roles,MailChimp for WordPress Lite <br><br>
<span style="color:#f0ad4e">
WARNING: By clicking Import Demo Content button, your current theme options, sliders and widgets will be replaced. It can also take a minute to complete.Take back up your database before doing this.<br><u><strong>Please wait for 10 to 15 minutes to complete demo setup.</strong></u></span> <br><br><span style="color:red"><b>Take your database backup before import demo content.</b></span></span><br><br><br><br>
	<a id="btn_import" data_url="'.admin_url("themes.php?page=options_page&start_import=1&step=1").'" class="button button-primary btn_import dark" >Import Demo Content</a>
	<br>
	  <div class="console_iport">
	</div>';
	return $html;
}