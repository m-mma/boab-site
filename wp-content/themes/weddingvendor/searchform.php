<form method="get" class="" action="<?php echo esc_url(home_url( '/' )); ?>">
  	<div class="input-group">
    <input type="text" name="s" value="<?php echo esc_attr(get_search_query());?>" class="form-control" placeholder="<?php esc_html_e('Search for...','weddingvendor');?>">
    <span class="input-group-btn">
    <button class="btn tp-btn-primary tp-btn-lg" type="submit"><i class="fa fa-search"></i></button>
    </span> </div>
</form>