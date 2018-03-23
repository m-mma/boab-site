<?php
// Ajax Upload action
add_action('wp_ajax_weddingvendor_upload_file',             'weddingvendor_upload_file');
add_action('wp_ajax_weddingvendor_upload_delete',           'weddingvendor_upload_delete_file');
add_action('wp_ajax_nopriv_weddingvendor_upload_file',      'weddingvendor_upload_file');
add_action('wp_ajax_nopriv_weddingvendor_upload_delete',    'weddingvendor_upload_delete_file');

function weddingvendor_upload_delete_file(){
    $attach_id = intval($_POST['attach_id']);
    wp_delete_attachment($attach_id, true);
    exit;
}

function weddingvendor_upload_file()
{
    $file = array(
        'name'      => $_FILES['aaiu_upload_file']['name'],
        'type'      => $_FILES['aaiu_upload_file']['type'],
        'tmp_name'  => $_FILES['aaiu_upload_file']['tmp_name'],
        'error'     => $_FILES['aaiu_upload_file']['error'],
        'size'      => $_FILES['aaiu_upload_file']['size']
    );
    $file = weddingvendor_fileupload_process($file);
}  
        
    
function weddingvendor_fileupload_process($file){

    $attachment = weddingvendor_upload_handle_file($file);

    if (is_array($attachment)) {
        $html = weddingvendor_upload_getHTML($attachment);

        $response = array(
            'success'   => true,
            'html'      => $html,
            'attach'    => $attachment['id']
        );

        echo json_encode($response);
        exit;
    }

    $response = array('success' => false);
    echo json_encode($response);
    exit;
}
    
    
function weddingvendor_upload_handle_file($upload_data){

    $return = false;
    $uploaded_file = wp_handle_upload($upload_data, array('test_form' => false));

    if (isset($uploaded_file['file'])) {
        $file_loc   =   $uploaded_file['file'];
        $file_name  =   basename($upload_data['name']);
        $file_type  =   wp_check_filetype($file_name);

        $attachment = array(
            'post_mime_type' => $file_type['type'],
            'post_title' => preg_replace('/\.[^.]+$/', '', basename($file_name)),
            'post_content' => '',
            'post_status' => 'inherit'
        );

        $attach_id      =   wp_insert_attachment($attachment, $file_loc);
        $attach_data    =   wp_generate_attachment_metadata($attach_id, $file_loc);
        wp_update_attachment_metadata($attach_id, $attach_data);

        $return = array('data' => $attach_data, 'id' => $attach_id);

        return $return;
    }

    return $return;
}
    
    
function weddingvendor_upload_getHTML($attachment){
    $attach_id  =   $attachment['id'];
    $file='';
    $html='';

    if( isset($attachment['data']['file'])){

		global $current_user;
		wp_get_current_user();
	
        $file       =   explode('/', $attachment['data']['file']);
        $file       =   array_slice($file, 0, count($file) - 1);
        $path       =   implode('/', $file);
   
        if(is_page_template('page-templates/add-listing.php') ){
            $image      =   $attachment['data']['sizes']['weddingvendor_item_thumb']['file'];
        }else{
            $image      =   $attachment['data']['sizes']['weddingvendor_user_profile']['file'];
        }
        $post       =   get_post($attach_id);
        $dir        =   wp_upload_dir();
        $path       =   $dir['baseurl'] . '/' . $path;
        $html       =   '';

        $userID  =   $current_user->ID;
        $html   .=   $path.'/'.$image; 

    }       
    
    return $html;
}
?>