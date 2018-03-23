<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package weddingvendor
 */

$post_format = get_post_format();
if ($post_format === false) {
	$post_format = 'image';
}
$data = '';

switch ($post_format) {
	case 'standard':
		$style = 0;
		$data = '';
	break;
	case 'image':
		if (wp_get_attachment_url(get_post_thumbnail_id($post->ID))) {
			$thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
			$data .= '<div class="post-image"><a href="'.get_permalink().'"><img alt="" class="img-responsive img-radius" src="' . esc_url($thumbnail_url). '"/></a></div>';
		}
	break;
	case 'gallery':
		$values = get_post_custom();
		if(isset($values['product_gallery'])) {
			// The json decode and base64 decode return an array of image ids
			$ids = json_decode($values['product_gallery'][0]);								
		}
		else {
			$ids = array();								
		}												
		if (get_post_meta(get_the_ID(), 'product_gallery', true)) {
			$st_gallery_blog = get_post_meta(get_the_ID(), 'product_gallery', true);
		}															
		$data .= '<div class="owl-gallery-slide owl-carousel mb30">';  // owl-corsol
		foreach ($ids as $item) {
			$thumbnail_url = wp_get_attachment_url($item);
			$data .= '<div class="item post-img">';
			$data .= '<img src="'.esc_url($thumbnail_url).'" class="img-responsive img-radius" alt="" />';
			$data .= '</div>';
		}
		$data .= '</div>';							
	break;
	case 'video':			    	
		if (get_post_meta(get_the_ID(), 'show_video', true)) {
			$media_url = get_post_meta(get_the_ID(), 'show_video', true);			            
			$data .= '<div class="videoWrapper">';
			$data .= wedding_video_embed(wp_oembed_get( $media_url ));
			$data .= '</div>';
		}
	break;
	case 'audio':
		if (get_post_meta(get_the_ID(), 'show_audio', true)) {
			$media_url = get_post_meta(get_the_ID(), 'show_audio', true);
			$data .= '<div class="videoWrapper">';
			$data .= '<div class="audio">'. wedding_video_embed(wp_oembed_get($media_url )) .'</div>';
			$data .= '</div>';
		}
	break;
	default:
		if (wp_get_attachment_url(get_post_thumbnail_id($post->ID))) {
			$thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
			$data .= '<div class="post-image"><a href="'.get_permalink().'"><img alt="" class="img-responsive img-radius" src="' . $thumbnail_url . '"/></a></div>';
		}
	break;
}
?>
<div class="well-box">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php
		echo $data;
			if ( is_single() ) {
				the_title( '<h1 class="post-title">', '</h1>' );
			} else {
				the_title( '<h1 class="post-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php weddingvendor_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>

	<div class="entry-content">
		<?php
			if($post_format=="quote")
            the_content();
            else
            the_excerpt(); 

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'weddingvendor' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<a class="btn tp-btn-primary" href="<?php the_permalink();?>"><?php echo esc_html__('Read More', 'weddingvendor'); ?></a>
	</div><!-- #post-## -->
</div>
