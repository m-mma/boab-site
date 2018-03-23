<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package weddingvendor
 */

get_header(); ?>
<div class="main-container">
  <div class="container">
  	<div class="row">
    	<div class="col-md-12 error-block">
        	<h1><?php esc_html_e( '404', 'weddingvendor' ); ?></h1>
            <h2><i class="fa fa-warning"></i><?php esc_html_e( 'oooopppss! page was not found, Sorry! it looks like that page has gone missing.', 'weddingvendor' ); ?></h2>
            <p><?php esc_html_e( 'Please use navigation above to browse wedding topics, or go back to', 'weddingvendor' ); ?> 
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a> </p>
        </div>
    </div>
  </div>
</div>
<?php
get_footer();
?>