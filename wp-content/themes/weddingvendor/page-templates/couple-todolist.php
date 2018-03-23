<?php 
/**
 * Template Name: Couple Todo List
 */
get_header();
if (is_user_logged_in() ) {

global $current_user,$post,$wpdb;
wp_get_current_user();
$userID          = $current_user->ID;	

get_template_part( 'template-parts/user/coupledashboard', 'menu' );

$currency_code			=	tg_get_option('currency_symbols');
$wistlist_ids=get_user_meta( $userID, 'user_wishlist',true) ;
$wistlist_arr=explode(",",$wistlist_ids);	

if(function_exists('get_couple_todolist_link'))
{
	$get_couple_todolist_link=get_couple_todolist_link();
}

$todolist_table = $wpdb->prefix."todolist";

$get_month_year = $wpdb->get_results( "SELECT MONTH(todo_date) as mon,YEAR(todo_date) as yea  FROM ".$todolist_table. " where todo_user=".$userID." GROUP BY YEAR(todo_date), MONTH(todo_date)"  );	

$get_count_unread = $wpdb->get_results( "SELECT count(*) as counter FROM ".$todolist_table. " where todo_user=".$userID." AND  todo_read=0");	
$get_count_read = $wpdb->get_results( "SELECT count(*) as counter FROM ".$todolist_table. " where todo_user=".$userID." AND  todo_read=1");	

$get_count_unread_counter=$get_count_unread[0]->counter;
$get_count_read_counter=$get_count_read[0]->counter;

if(!empty($get_count_read_counter) || !empty($get_count_unread_counter))
$todo_percentage=(($get_count_read_counter)*100)/($get_count_unread_counter+$get_count_read_counter);

$total_todo_percentage=round($todo_percentage);
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
                  <a href="javascript:void(0);" class="btn tp-btn-default" id="show"><?php esc_html_e('Add To Do','weddingvendor');?></a>
                  <?php }else{ ?>
                  <a href="<?php echo $get_couple_todolist_link['url'];?>" class="btn tp-btn-default" id="show"><?php esc_html_e('Add Task','weddingvendor');?></a>
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
				$get_row = $wpdb->get_results( "SELECT * FROM ".$todolist_table. " where todo_id=".base64_decode($_GET['edit'])." "  );				  
			 ?> 
              <div class="bg-white pinside40 mb30">
                <h2 class="form-title"><?php esc_html_e('Edit Task','weddingvendor');?></h2>
                 <form id="form-edit-todolist" method="post">
                 <div class="status"></div>  
              		<?php wp_nonce_field('ajax-user-todolist-nonce', 'security'); ?>
                   <div class="row"> 
                      <div class="col-md-6"> 
                        <!-- Text input-->
                        <div class="form-group">
                          <label class="control-label" for="tasktitle"><?php esc_html_e('Task Title','weddingvendor');?></label>
                          <div class="">
                            <input id="todotitle" name="todotitle" type="text" placeholder="<?php esc_html_e('Task Title','weddingvendor');?>" class="form-control input-md" required="" value="<?php echo $get_row[0]->todo_title;?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label" for="taskdate"><?php esc_html_e('Task Date','weddingvendor');?></label>
                          <div class="">
                            <input id="tododate" name="tododate" type="text" placeholder="<?php esc_html_e('Task Date','weddingvendor');?>" class="form-control book_date check_book_date input-md" required="" value="<?php echo $get_row[0]->todo_date;?>">
                            <span class="help-block"> </span> </div>
                        </div>
                      </div>
                      <!-- Text input-->
                      <div class="col-md-6"> 
                        <!-- Textarea -->
                        <div class="form-group">
                          <label class="control-label" for="taskdescriptions"><?php esc_html_e('Task Descriptions','weddingvendor');?></label>
                          <div class="">
                            <textarea class="form-control" id="tododetail" name="tododetail" rows="6"><?php echo $get_row[0]->todo_details;?></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="text-right">
                            <input id="todoid" name="todoid" type="hidden" value="<?php echo $_GET['edit']; ?>" /> 
                            <button id="edit-todolist" name="edit-todolist"  class="btn tp-btn-primary"><?php esc_html_e('Edit Task','weddingvendor');?></button>
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
                <h2 class="form-title"><?php esc_html_e('Create New Task','weddingvendor');?></h2>
                 <form id="form-todolist" method="post">
                 <div class="status"></div>  
              		<?php wp_nonce_field('ajax-user-todolist-nonce', 'security'); ?>
                	<div class="close-sign"><a href="javascript:void(0);" id="hide"><i class="fa fa-close"></i></a></div>
                   <div class="row"> 
                      <div class="col-md-6"> 
                        <!-- Text input-->
                        <div class="form-group">
                          <label class="control-label" for="tasktitle"><?php esc_html_e('Task Title','weddingvendor');?></label>
                          <div class="">
                            <input id="todotitle" name="todotitle" type="text" placeholder="<?php esc_html_e('Task Title','weddingvendor');?>" class="form-control input-md" required="">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label" for="taskdate"><?php esc_html_e('Task Date','weddingvendor');?></label>
                          <div class="">
                            <input id="tododate" name="tododate" type="text" placeholder="<?php esc_html_e('Task Date','weddingvendor');?>" class="form-control book_date check_book_date input-md" required="">
                            <span class="help-block"> </span> </div>
                        </div>
                      </div>
                      <!-- Text input-->
                      <div class="col-md-6"> 
                        <!-- Textarea -->
                        <div class="form-group">
                          <label class="control-label" for="taskdescriptions"><?php esc_html_e('Task Descriptions','weddingvendor');?></label>
                          <div class="">
                            <textarea class="form-control" id="tododetail" name="tododetail" rows="6"></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="text-right">
                            <button id="btn-todolist" name="btn-todolist"  class="btn tp-btn-primary"><?php esc_html_e('Save Task','weddingvendor');?></button>
                          </div>
                        </div>
                      </div>
                   </div>
                </form>
              </div>
              <?php } ?> 	
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <div class="st-accordion"> <!-- shortcode -->
                <div class="panel-group" role="tablist" aria-multiselectable="true">
					<?php
                    for($i=0;$i<count($get_month_year);$i++)
                    {
						$month=$get_month_year[$i]->mon;
						$year=$get_month_year[$i]->yea;
						$ids=$month."__".$year;
						
						$panel_active = $i==0 ? 'in' : '';
						
						$get_rows = $wpdb->get_results( "SELECT * FROM ".$todolist_table. " where todo_user=".$userID. " and (Month(todo_date)='".$month."' && YEAR(todo_date)='".$year."') order by todo_date  ASC"  );
                    ?>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                      <h4 class="panel-title"> <a class="title" role="button" data-toggle="collapse" href="#<?php echo $ids;?>" aria-expanded="true" aria-controls="<?php echo $ids;?>"><i class="fa fa-angle-double-up sign"></i> <?php echo $monthName = date('F', mktime(0, 0, 0, $month, 10))." ".$year;  ?></a> </h4>
                    </div>
                    <div id="<?php echo $ids;?>" class="panel-collapse collapse <?php echo $panel_active;?>" role="tabpanel" aria-labelledby="headingOne">
                      <div class="todo-list-group">                         
                        <!-- List group -->
                        <ul class="listnone">
                           <?php
						   for($k=0;$k<count($get_rows);$k++)
						   {
							   $id=$get_rows[$k]->todo_id;
							?>
                            <li class="todo-list-item">
                            <div class="todo-list">
                              <div class="row">
                                <div class="col-md-8">
                                  <div class="todo-task">
                                    <h3 class="todo-title"><a  class="title" data-toggle="collapse" href="#<?php echo sanitize_title($get_rows[$k]->todo_title).$ids;?>" aria-expanded="false" aria-controls="collapseExample"><?php echo $get_rows[$k]->todo_title;?></a> </h3>
                                    <span class="todo-date"><?php echo date('d M, Y',strtotime($get_rows[$k]->todo_date));?></span> </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="todo-action"> 
                                  <span id="todolist_<?php echo $id;?>">
                                  <?php	  
								  if($get_rows[$k]->todo_read==0) {
								  ?>
                                  <a href="javascript:void(0)" class="btn-circle unread-todo" onclick="read_todolist(<?php echo $id;?>)"><i class="fa fa-circle"></i></a>
                                  <?php }else{ ?>
                                  <a href="javascript:void(0)" class="btn-circle read-todo" onclick="unread_todolist(<?php echo $id;?>)"><i class="fa fa-circle"></i></a>                                  <?php }?>
                                  </span> 					
                                  <a href="?edit=<?php echo base64_encode($id);?>" class="btn-circle" title="Edit"><i class="fa fa-edit"></i></a> 
                                  <a href="javascript:void(0)" class="btn-circle" title="Delete" onclick="delete_todolist(<?php echo $id;?>)"><i class="fa fa-trash-o"></i></a> </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="collapse" id="<?php echo sanitize_title($get_rows[$k]->todo_title).$ids;?>">
                                  <div class="todo-notes pinside30">
                                    <p><?php echo $get_rows[$k]->todo_details;?></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                           <?php 	   
						   }
						   ?>	
                        </ul>
                      </div>
                    </div>
                  </div>
                  	<?php
					}
					?>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="bg-white pinside30 widget-todo">
                    <h3><?php esc_html_e('Summary of To Dos','weddingvendor'); ?></h3>
                    <div id="todo-percentage" class="todo-percentage" data-percent="<?php echo $total_todo_percentage;?>"> </div>
                    <div class="todo-value"> <span class="todo-done"><?php echo $get_count_read_counter." "; esc_html_e('Done','weddingvendor');?> </span> <span class="todo-pending"><?php echo $get_count_unread_counter." "; esc_html_e('To-Dos','weddingvendor');?></span> </div>
                  </div>
                </div>
              </div>
            </div>
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