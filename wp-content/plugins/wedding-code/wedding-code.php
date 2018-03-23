<?php     
/**
 * Plugin Name:     Wedding Code
 * Plugin URI:      #
 * Github URI:      #
 * Description:     Wedding Code plugin is used for Custom post type,short code and import data for Physio theme integration
 * Author:          Udayraj Khatri
 * Author URI:      http://thegenius.co
 * Version:         1.0.0
 * Text Domain:
 * License:         #   
 * License URI:     #
 * Domain Path:     #
 *
 * @package         Code
 * @author          #
 * @license         #
 * @copyright       #
 */
global $plugin_domain;
$plugin_domain = 'wedding';
define( 'WEDDING_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
 
class Wedding_Plugin_Setup_Plan
{
    static $detect;
    static function  init()
    {
        require_once(WEDDING_PLUGIN_DIR.'/plugin.importer.php');
		require_once(WEDDING_PLUGIN_DIR.'/core/custom-post.php');
		require_once(WEDDING_PLUGIN_DIR.'/core/shortcodes.php');
        require_once(WEDDING_PLUGIN_DIR.'/core/shortcode-function.php');
		require_once(WEDDING_PLUGIN_DIR.'/core/ajax-function-call.php');
		require_once(WEDDING_PLUGIN_DIR.'/core/paypal/paypal.class.php');
		require_once(WEDDING_PLUGIN_DIR.'/core/paypal/paypal_proinc.php');
    }
    static  function wedding_plugin_setup_url($u=false)
    {
        if($u){
            $u='/'.$u;
        }
        return plugin_dir_url(__FILE__).$u;
    }
    static  function wedding_plugin_setup_dir($u=false){
        if($u){
            $u='/'.$u;
        }
        return plugin_dir_path(__FILE__).$u;
    }
}

add_action( 'plugins_loaded', array('Wedding_Plugin_Setup_Plan','init'));

global $setup_go;
$setup_go=new Wedding_Plugin_Setup_Plan();
function Wedding_Plugin_Setup_Plan(){
    return new Wedding_Plugin_Setup_Plan();
}


add_action( 'init', 'wedding_plugin_load_textdomain' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */
function wedding_plugin_load_textdomain() {
  load_plugin_textdomain( 'weddingvendor', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

global $wedding_db_version;
$wedding_db_version = '1.0';

function wedding_install() {
	global $wpdb;
	global $wedding_db_version;

	$table_budget_category = $wpdb->prefix . 'budget_category';
	$table_budget_list = $wpdb->prefix . 'budget_list';
	$table_todo_list = $wpdb->prefix . 'todolist';
	
	$charset_collate = $wpdb->get_charset_collate();

	$sql_category = "CREATE TABLE IF NOT EXISTS $table_budget_category (
  category_id int(10) NOT NULL AUTO_INCREMENT,
  category_user_id int(10) NOT NULL,
  category_name varchar(255) NOT NULL,
  category_date date NOT NULL,
  PRIMARY KEY (category_id)
) $charset_collate AUTO_INCREMENT=1;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql_category );

	$sql_budget_list = "CREATE TABLE IF NOT EXISTS $table_budget_list (
  budget_list_id int(10) NOT NULL AUTO_INCREMENT,
  budget_list_category_id int(10) NOT NULL,
  budget_list_user_id int(10) NOT NULL,
  budget_list_name varchar(255) NOT NULL,
  budget_list_estimate_cost int(10) NOT NULL,
  budget_list_actual_cost int(10) NOT NULL,
  budget_list_paid_cost int(10) NOT NULL,
  budget_list_date date NOT NULL,
  PRIMARY KEY (budget_list_id)
) $charset_collate AUTO_INCREMENT=1;";

	dbDelta( $sql_budget_list );	
	

	$sql_todo_list = "CREATE TABLE IF NOT EXISTS $table_todo_list (
  todo_id int(11) NOT NULL AUTO_INCREMENT,
  todo_user int(100) NOT NULL,
  todo_title varchar(255) NOT NULL,
  todo_date date NOT NULL,
  todo_details text NOT NULL,
  todo_read int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`todo_id`)
)  $charset_collate AUTO_INCREMENT=1;";

	dbDelta( $sql_todo_list );		

	add_option( 'wedding_db_version', $wedding_db_version );
}

register_activation_hook( __FILE__, 'wedding_install' );