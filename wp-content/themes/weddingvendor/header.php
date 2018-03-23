<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package weddingvendor
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
$header_search_btn=tg_get_option('header_search_btn');
if(isset($header_search_btn) && !empty($header_search_btn))
{
?>
<div class="collapse" id="searcharea">
<form method="get" class="" action="<?php echo esc_url(home_url( '/' )); ?>">
  <div class="input-group">
    <input type="text" name="s" class="form-control" value="<?php echo esc_attr(get_search_query());?>" placeholder="<?php esc_html_e('Search for...','weddingvendor');?>">
    <span class="input-group-btn">
    <button class="btn tp-btn-primary" type="submit"><?php esc_html_e( 'Search', 'weddingvendor' ); ?></button>
    </span> </div>
</form>    
</div>
<?php 
}
?>
<!-- /.top search -->
<div class="top-bar">
  <div class="container">
    <div class="row">
      <div class="col-md-4 top-message">
        <p><?php esc_html_e( 'Welcome to Wedding Vendor', 'weddingvendor' ); ?></p>
      </div>
      <div class="col-md-8 top-links">
		<?php wp_nav_menu( array( 'theme_location' => 'topbar', 'menu_class' => 'listnone',  'fallback_cb' => false ) ); ?>              
      </div>
    </div>
  </div>
</div>    

<div class="tp-nav" id="headersticky"><!-- navigation start -->
  <div class="container">
    <nav class="navbar navbar-default navbar-static-top">       
      <!-- Brand and toggle get grouped for better mobile display -->      
      <div class="navbar-header">
		<?php 
        if(tg_get_option('checker')!=""){ ?>
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php } else{ ?>		
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <?php if(tg_get_option('logo')!=""){ 	?>
            <img src="<?php echo esc_url(tg_get_option('logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
        <?php 	
        } else {?>
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
        <?php } ?>
        </a>      
        <?php } ?> 
        </div>      
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="navigation">
            <div class="" id="cssmenu">
                <?php
                    if ( has_nav_menu( 'primary' ) ) {
                        wp_nav_menu( array( 
                            'theme_location' => 'primary',
                              'container'=>false,
                              'walker'=>new weddingvendor_Tg_Menu(),
                              'menu_class'=>'nav navbar-nav navbar-right',
                            ) 
                        );
                    }
                ?>              
            </div>      <!-- /.navbar-collapse -->       
        </div>
    </nav>
  </div>
  <!-- /.container-fluid -->   
</div>
<?php 
get_template_part( 'template-parts/user/header', 'banner' );
?>  