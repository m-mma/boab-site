<?php
/*
 * The template for displaying Author bios
 *
 * @package weddingvendor
 */
?>  
<div class="post-author">
    <div class="row">
        <div class="author-pic col-md-3">
            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>"><?php echo get_avatar(get_the_author_meta('ID'),200); ?></a>
        </div>
        <div class="author-info col-md-9">
            <div class="author-bio">                  
            <div class="author-name"><!-- author name -->
              <h2><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo get_the_author_meta('display_name');?></a> <strong class="author-role">( <?php esc_html_e( 'Author', 'weddingvendor' ); ?> )</strong></h2>
            </div>              
             <?php
                $author_content = get_the_author_meta('description');
                if(!empty($author_content))
                {
                    echo '<p>'.esc_html($author_content).'</p>'; 
                }
                if(!get_the_author_meta('description')) 
                {
                    echo '<p>'.esc_html__('No description.Please update your profile.','weddingvendor').'</p>'; 
                }
             ?>     
          <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID')));?>" class="btn tp-btn-default"><?php esc_html_e( 'view all post', 'weddingvendor' ); ?></a>
          </div>
        </div>
    </div>
</div>