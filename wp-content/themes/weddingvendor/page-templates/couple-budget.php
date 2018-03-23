<?php 
/**
 * Template Name: Couple Budget
 */
get_header();
if (is_user_logged_in() ) {

global $current_user,$post,$wpdb;
wp_get_current_user();
$userID          = $current_user->ID;	

get_template_part( 'template-parts/user/coupledashboard', 'menu' );

$currency_code			=	tg_get_option('currency_symbols');

if(function_exists('get_couple_budget_link'))
{
	$get_couple_budget_link=get_couple_budget_link();
}

$budget_category_table = $wpdb->prefix."budget_category";

$get_budget_category = $wpdb->get_results( "SELECT * FROM ".$budget_category_table. " where category_user_id=".$userID." ORDER BY category_name ASC"  );	
?>
<div class="main-container">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="dashboard-page-head page-header">
          <div class="row">
            <div class="col-md-8">
              <div class="page-title">
                <h1><?php the_title();?>&nbsp;&nbsp;&nbsp;<small><?php esc_html_e('Create your wedding to do and start planning.','weddingvendor');?></small></h1>
              </div>
            </div>
            <div class="col-md-4">
            	<div class="action-block">
				  <?php if(!isset($_GET['edit'])){ ?>
                  <a href="javascript:void(0);" class="btn tp-btn-default" id="show"><?php esc_html_e('Add Category','weddingvendor');?></a>
                  <?php }else{ ?>
                  <a href="<?php echo $get_couple_bugdet_link['url'];?>" class="btn tp-btn-default" id="show"><?php esc_html_e('Add Category','weddingvendor');?></a>
                  <?php } ?>
              </div>	
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="couple-board">
          <div class="row">
            <div class="col-md-12">
              <?php
			  if(isset($_GET['edit']) && !empty($_GET['edit']))
			  {
				$get_row = $wpdb->get_results( "SELECT * FROM ".$budget_category_table. " where category_id=".base64_decode($_GET['edit'])." "  );				  
			 ?> 
              <div class="bg-white pinside40 mb30">
                <h2 class="form-title"><?php esc_html_e('Edit Category','weddingvendor');?></h2>
                 <form id="form-edit-budget" method="post">
                 <div class="status"></div>  
              		<?php wp_nonce_field('ajax-user-budget-nonce', 'security'); ?>
                   <div class="row"> 
                      <div class="col-md-6"> 
                        <!-- Text input-->
                        <div class="form-group">
                          <label class="control-label" for="budget_category"><?php esc_html_e('Category Name','weddingvendor');?></label>
                          <div class="">
                            <input id="budget_category" name="budget_category" type="text" placeholder="<?php esc_html_e('Category Name','weddingvendor');?>" class="form-control input-md" value="<?php echo stripslashes_deep($get_row[0]->category_name);?>" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="text-right">
                            <input id="category_id" name="category_id" type="hidden" value="<?php echo $_GET['edit']; ?>" /> 
                            <button id="edit-budget-list" name="edit-budget-list"  class="btn tp-btn-primary"><?php esc_html_e('Edit Category','weddingvendor');?></button>
                          </div>
                        </div>
                      </div>
                   </div>
                </form>
              </div>
              <?php 
			  }else{
			  ?>
              <div class="bg-white pinside40 todo-form mb30">
                <h2 class="form-title"><?php esc_html_e('Create New Category','weddingvendor');?></h2>
                 <form id="form-budget" method="post">
                 <div class="status"></div>  
				 <?php wp_nonce_field('ajax-user-budget-nonce', 'security'); ?>
                 <div class="close-sign"><a href="javascript:void(0);" id="hide"><i class="fa fa-close"></i></a></div>
                   <div class="row"> 
                      <div class="col-md-6"> 
                        <!-- Text input-->
                        <div class="form-group">
                          <label class="control-label" for="budget_category"><?php esc_html_e('Category Name','weddingvendor');?></label>
                          <div class="">
                            <input id="budget_category" name="budget_category" type="text" placeholder="<?php esc_html_e('Category Name','weddingvendor');?>" class="form-control input-md" required="">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="text-right">
                            <button id="btn-budget-list" name="btn-budget-list"  class="btn tp-btn-primary"> <?php esc_html_e('Add Category','weddingvendor');?> </button>
                          </div>
                        </div>
                      </div>
                   </div>
                </form>
              </div>
              <?php } ?> 	
            </div>
          </div>
        </div>
        <div class="budget-board">
          <div class="list-group">
            <div href="#" class="list-group-item active">
              <div class="row">
                <div class="col-md-4"><?php esc_html_e('Budget Category','weddingvendor');?></div>
                <div class="col-md-2"><?php esc_html_e('Estimated Cost','weddingvendor');?></div>
                <div class="col-md-2"><?php esc_html_e('Actual Cost','weddingvendor');?></div>
                <div class="col-md-1"><?php esc_html_e('Paid','weddingvendor');?></div>
                <div class="col-md-1"><?php esc_html_e('Due','weddingvendor');?></div>
                <div class="col-md-2"><?php esc_html_e('Edit / Delete','weddingvendor');?></div>
              </div>
            </div>
            <?php 
			 for($i=0;$i<count($get_budget_category);$i++)
             {
				 $category_name=stripslashes_deep($get_budget_category[$i]->category_name);
				 $collaspan_id=$get_budget_category[$i]->category_id."_collaspan";
				 $addrow_id=$get_budget_category[$i]->category_id."_add_row";
				 $id=$get_budget_category[$i]->category_id;
				 
				 $budget_list_table = $wpdb->prefix."budget_list";
				 
				 $get_rows = $wpdb->get_results( "SELECT * FROM ".$budget_list_table. " where budget_list_category_id=".$id." AND budget_list_user_id=".$userID." order by budget_list_name ASC"  );

				 $toatl_budget_estimate_cost=0;
				 $toatl_budget_actual_cost=0;
				 $toatl_budget_paid_cost=0;				 
				 $toatl_budget_due_cost=0;

				 for($j=0;$j<count($get_rows);$j++)
				 {
					 $toatl_budget_estimate_cost=$toatl_budget_estimate_cost+$get_rows[$j]->budget_list_estimate_cost;
					 $toatl_budget_actual_cost=$toatl_budget_actual_cost+$get_rows[$j]->budget_list_actual_cost;
					 $toatl_budget_paid_cost=$toatl_budget_paid_cost+$get_rows[$j]->budget_list_paid_cost;
					 
					 $toatl_budget_due_cost=$toatl_budget_actual_cost-$toatl_budget_paid_cost;
				 }
			?>
            <div class="list-group-item">
              <div class="row">
                <div class="col-md-4"><a data-toggle="collapse" href="#<?php echo $collaspan_id;?>" aria-expanded="false" aria-controls="<?php echo $collaspan_id;?>"><?php echo $category_name; ?></a> </div>
                <div class="col-md-2"><?php echo $currency_code.$toatl_budget_estimate_cost;?></div>
                <div class="col-md-2"><?php echo $currency_code.$toatl_budget_actual_cost;?></div>
                <div class="col-md-1"><?php echo $currency_code.$toatl_budget_paid_cost;?></div>
                <div class="col-md-1"><?php echo $currency_code.$toatl_budget_due_cost;?></div>
                <div class="col-md-2"><a href="<?php echo $get_couple_bugdet_link; ?>?edit=<?php echo base64_encode($id);?>" class="btn-edit"><i class="fa fa-edit"></i></a><a href="javascript:void();" class="btn-delete" onclick="delete_budget(<?php echo $id;?>)"><i class="fa fa-trash"></i></a></div>
                  <div class="collapse col-md-12 item-title" id="<?php echo $collaspan_id;?>">
                    <div class="row">
                    <div class="table-responsive">
                      <table class="table <?php echo $collaspan_id;?>">
                        <thead>
                          <tr>
                            <th class="col-md-4"><?php esc_html_e('Ceremony Item','weddingvendor');?></th>
                            <th class="col-md-2"><?php esc_html_e('Estimated Cost','weddingvendor');?></th>
                            <th class="col-md-2"><?php esc_html_e('Actual','weddingvendor');?></th>
                            <th class="col-md-1"><?php esc_html_e('Paid','weddingvendor');?></th>
                            <th class="col-md-1"><?php esc_html_e('Due','weddingvendor');?></th>
                            <th class="col-md-2"><?php esc_html_e('Edit / Delete','weddingvendor');?></th>
                          </tr>
                        </thead>
                        <tbody id="<?php echo $addrow_id;?>">
                         <?php
						 for($k=0;$k<count($get_rows);$k++)
						 {
							   $budget_list_id=$get_rows[$k]->budget_list_id;
							   $sub_add_row_id=$budget_list_id."_sub_add_row";
							   
						  ?>
                           <tr id="<?php echo $sub_add_row_id;?>">
                            <th scope="row" class="budget_name"><?php echo $get_rows[$k]->budget_list_name;?></th>
                            <td class="budget_estimate"><?php echo $get_rows[$k]->budget_list_estimate_cost;?></td>
                            <td class="budget_cost"><?php echo $get_rows[$k]->budget_list_actual_cost;?></td>
                            <td class="budget_paid"><?php echo $get_rows[$k]->budget_list_paid_cost;?></td>
                            <td><?php 
									if(isset($get_rows[$k]->budget_list_actual_cost) && isset($get_rows[$k]->budget_list_paid_cost))
									echo $get_rows[$k]->budget_list_actual_cost-$get_rows[$k]->budget_list_paid_cost;?></td>
                            <td class="action_perform"><a href="javascript:void();" onclick="sub_budget_edit(<?php echo $budget_list_id;?>)" class="btn-edit"><i class="fa fa-edit"></i></a><a href="javascript:void();" class="btn-delete" onclick="delete_budget_list(<?php echo $budget_list_id;?>)"><i class="fa fa-trash"></i></a></td>
                          </tr>
                          <?php 
						   }
						   ?>	
                        </tbody>
                      </table>
                      <a href="javascript:void();" title="<?php esc_html_e('Add New','weddingvendor');?>" class="btn tp-btn-primary add-item" onclick="add_budget_list_row(<?php echo $id;?>)">+ <?php esc_html_e('Add New','weddingvendor');?></a> 
                      <?php wp_nonce_field('ajax-user-budgetlist-nonce', 'security'); ?>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <?php 
			 }
			 ?>
          </div>
    	</div>
      </div>
    </div>
  </div>
</div>  
<?php 
}
else{
	wedding_check_logout_user();
}
get_footer();
?>