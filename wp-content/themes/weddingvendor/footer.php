<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package weddingvendor
 */

?>
<div class="footer"><!-- Footer -->
  <div class="container">
    <div class="row">
      <div class="col-md-5 ft-aboutus">
		<?php if ( is_active_sidebar( 'footer-1' ) ) 	{ dynamic_sidebar( 'footer-1' ); } ?>
      </div>
      <div class="col-md-3 ft-link">
        <?php if ( is_active_sidebar( 'footer-2' ) ) 	{ dynamic_sidebar( 'footer-2' ); } ?>
      </div>
      <div class="col-md-4 newsletter">
       <?php if ( is_active_sidebar( 'footer-3' ) ) 	{ dynamic_sidebar( 'footer-3' ); } ?>
      </div>
    </div>
  </div>
</div><!-- /.Footer -->
<div class="tiny-footer"><!-- Tiny footer -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <?php printf( __( 'Copyright &copy; 2018. %s', 'weddingvendor' ), 'All Rights Reserved' ); ?>
	</div>
    </div>
  </div>
</div><!-- /. Tiny Footer -->
<?php wp_footer(); ?>
</body>
</html>