<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package weddingvendor
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
if(is_singular( 'item' ))
{
	$comment_class='single_item';	
}
else
{
	$comment_class='blog_item';
}
?>

	<div id="comments" class="comments-area post-comments <?php echo $comment_class;?>">
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'weddingvendor' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'weddingvendor' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'weddingvendor' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'weddingvendor' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ul class="comment-list listnone mb30">
			<?php
				wp_list_comments( array(
					'style'      => 'li',
					'callback' => 'wedding_shape_comment',
					'avatar_size' => 100
				) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'weddingvendor' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'weddingvendor' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'weddingvendor' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'weddingvendor' ); ?></p>
	<?php
	endif;

	/**
		Comment form.
	*/
	
	if(is_singular( 'item' ))
	{
		$comment_form = array(
			'title_reply' => esc_html__('User Review', 'weddingvendor'),
			'title_reply_to' => esc_html__('User Review Reply to %s', 'weddingvendor'),
			'comment_notes_before' => '',
			'fields' => array(
				'author' => '<div class="form-group"><div class="col-md-12"><label for="author" class="control-label">'.esc_html__('Name', 'weddingvendor').'</label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" aria-required="true"  class="form-control" /></div></div>',
				'email' => '' .
				'<div class="form-group"><div class="col-md-12"><label for="email" class="control-label">'.esc_html__('Email', 'weddingvendor').'</label><input class = "form-control" id = "email" name = "email" type = "text" value = "' . esc_attr($commenter['comment_author_email']) . '" aria-required = "true" /></div></div>',
				'url' => '<div class="form-group"><div class="col-md-12"><label for="subject" class="control-label">'.esc_html__('Name', 'weddingvendor').'</label><input class = "form-control" id="subject" name="subject" type="text" value = "'.esc_attr($commenter['comment_author_url']).'"  aria-required="true" /></div></div>',
			),
			'label_submit' => esc_html__('Comment', 'weddingvendor'),
			'class_submit' => 'btn tp-btn-primary tp-btn-lg',
			'logged_in_as' => '',
			'comment_field' => '',
			'comment_notes_after' => '',
			'class_form'=>'leave-comments',
			'label_submit' => esc_html__('Submit Review', 'weddingvendor'),
			
				)
		;

	}
	else{
		$comment_form = array(
			'title_reply' => esc_html__('Leave A Comment', 'weddingvendor'),
			'title_reply_to' => esc_html__('Leave a Reply to %s', 'weddingvendor'),
			'comment_notes_before' => '',
			'fields' => array(
				'author' => '<div class="form-group"><div class="col-md-3"><label for="author" class="control-label">'.esc_html__('Name', 'weddingvendor').'</label></div><div class="col-md-7"><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" aria-required="true"  class="form-control" /></div></div>',
				'email' => '' .
				'<div class="form-group"><div class="col-md-3"><label for="email" class="control-label">'.esc_html__('Email', 'weddingvendor').'</label></div><div class="col-md-7"><input class = "form-control" id = "email" name = "email" type = "text" value = "' . esc_attr($commenter['comment_author_email']) . '" aria-required = "true" /></div></div>',
				'url' => '<div class="form-group"><div class="col-md-3"><label for="subject" class="control-label">'.esc_html__('Name', 'weddingvendor').'</label></div><div class="col-md-7"><input class = "form-control" id="subject" name="subject" type="text" value = "'.esc_attr($commenter['comment_author_url']).'"  aria-required="true" /></div></div>',
			),
			'label_submit' => esc_html__('Comment', 'weddingvendor'),
			'class_submit' => 'col-md-offset-3 btn tp-btn-primary tp-btn-lg',
			'logged_in_as' => '',
			'comment_field' => '',
			'comment_notes_after' => '',
			'class_form'=>'form-horizontal leave-comments',
			'label_submit' => esc_html__('Leave Comment', 'weddingvendor'),
			
				)
		;

	}
	$comment_form['comment_field'].='<div class="form-group"><div class="col-md-3"><label for="comment" class="control-label">'.esc_html__('Comment', 'weddingvendor').'</label></div>
<div class="col-md-9"><textarea name = "comment" rows="8" id = "comment" class = "form-control-text form-control"></textarea></div></div>';	

	comment_form($comment_form);
	?>
	</div><!-- #comments -->
