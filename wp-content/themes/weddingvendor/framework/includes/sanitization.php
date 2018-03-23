<?php
/*-----------------------------------------------------------*
/* 		 TG	THEME OPTION VALIDATION ON FIELD TO SAVE
/*-----------------------------------------------------------*/

function tg_options_validate( $input ) {		
	global $tg_options;
	$valid_input = array();
	$default_options = tg_default_options();	
	$submit = ! empty($input['submit']) ? true : false;
	$reset = ! empty($input['reset']) ? true : false; 
	$options = get_option( 'tg_options' );
 
	if ( $submit ){
       foreach ( $tg_options as $value ) {						  
			if( $value['type'] != "section" && $value['type'] != 'typography' ) {
					$value['id'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($value['id']) );
					if ( isset(   $options[ ( $value['id']  ) ]   ) ) {
						$val = $options[ ( $value['id']  ) ];
					}												
			} // != "section" if loop		   				
			if ( $value['type'] == 'typography' ) {
				if(isset($value['id_1'])){
					$value['id_1'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower( esc_html($value['id_1']) ));
				}
				if(isset($value['id_2'])){
					$value['id_2'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower( esc_html($value['id_2']) ));
				}
				if(isset($value['id_3'])){
					$value['id_3'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower( esc_html($value['id_3']) ));
				}
			}		
			switch ( $value['type'] ) {
				case "text"      	  :		
				      $valid_input[(  esc_html($value['id'])  )] = empty($input[( esc_html($value['id']) )]) ? '' : $input[( esc_html($value['id']) )];  
				break;
				
				case "hidetext"       :		
					  $valid_input[(  esc_html($value['id'])  )] = empty($input[( esc_html($value['id']) )]) ? '' : $input[( esc_html($value['id']) )];  
				break;
				
				case "hidetextarea"   :		
					  $valid_input[(  esc_html($value['id'])  )] = empty($input[( esc_html($value['id']) )]) ? '' : $input[( esc_html($value['id']) )];
				break;
				
				case "textarea"  	  :	
					  $valid_input[(  esc_html($value['id'])  )] = empty($input[( esc_html($value['id']) )]) ? '' : $input[( esc_html($value['id']) )]; 
				break;
				
				case "radio"    	  :		
					  $valid_input[(  esc_html($value['id'])  )] = empty($input[( esc_html($value['id']) )]) ? '' : $input[( esc_html($value['id']) )]; 
				break;
				
				case "checkbox"  	  :     
					 $valid_input[(  esc_html($value['id'])  )] = empty($input[( esc_html($value['id']) )]) ? '' : $input[( esc_html($value['id']) )];	
				break;
				
				case "select"    	  :  	
					  $valid_input[(  esc_html($value['id'])  )] = empty($input[( esc_html($value['id']) )]) ? '' : $input[( esc_html($value['id']) )]; 
				break;
				
				case "multiselect" 	  :  	
					  $valid_input[(  esc_html($value['id'])  )] = empty($input[( esc_html($value['id']) )]) ? '' : implode(",", $input[( esc_html($value['id']) )]); 
				break;

				case "logo" 	 	  :  	
					 $valid_input[(  esc_html($value['id'])  )] = empty($input[( esc_html($value['id']) )]) ? '' : $input[( esc_html($value['id']) )]; 
				break;
				
				case "color" 	 	  :  	
					 $valid_input[(  esc_html($value['id'])  )] = empty($input[( esc_html($value['id']) )]) ? '' : $input[( esc_html($value['id']) )]; 
				break;
				
				case "editor"    	  : 	
				 	  $valid_input[(  esc_html($value['id'])  )] = empty($input[( esc_html($value['id']) )]) ? '' : $input[( esc_html($value['id']) )]; 
				break;
				
				case "typography" 	  :		
					  $valid_input[(  esc_html($value['id_1'])  )] = $input[(  esc_html($value['id_1'])  )];
					  $valid_input[(  esc_html($value['id_2'])  )] = $input[(  esc_html($value['id_2'])  )];
					  $valid_input[(  esc_html($value['id_3'])  )] = $input[(  esc_html($value['id_3']) )];		
				break;
				
				default 	  		  :	break;
			
			} // switch case ending				
	   } // foreach ending	   
	   add_settings_error( 'tg_framework', 'settings_updated' ,__( 'Successfully saved', 'weddingvendor' ), 'updated' );	   
	} // submit 
	
	elseif ( $reset ){

	   foreach ( $tg_options as $value ) {		   
			if( $value['type'] != "section" && $value['type'] != 'typography' ) {
					$value['id'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($value['id']) );
					if ( isset(   $options[ ( $value['id']  ) ]   ) ) {
						$val = $options[ ( $value['id']  ) ];
					}							
			} // != "section" if loop		   				
			if ( $value['type'] == 'typography' ) {
				if(isset($value['id_1'])){
					$value['id_1'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower( esc_html($value['id_1']) ));
				}
				if(isset($value['id_2'])){
					$value['id_2'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower( esc_html($value['id_2']) ));
				}
				if(isset($value['id_3'])){
					$value['id_3'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower( esc_html($value['id_3']) ));
				}
			}		
			switch ( $value['type'] ) {
			
				case "text"      	  :		
					  $valid_input[(  esc_html($value['id'])  )] = empty($default_options[( esc_html($value['id']) )]) ? '' : $default_options[( esc_html($value['id']) )];	
				break;
				
				case "hidetext"    	  :		
					 $valid_input[(  esc_html($value['id'])  )] = empty($default_options[( esc_html($value['id']) )]) ? '' : $default_options[( esc_html($value['id']) )];	
				break;
				
				case "hidetextarea"	  :		
					  $valid_input[(  esc_html($value['id'])  )] = empty($default_options[( esc_html($value['id']) )]) ? '' : $default_options[( esc_html($value['id']) )];	
				break;
				
				case "textarea"  	  :		
					  $valid_input[(  esc_html($value['id'])  )] = empty($default_options[( esc_html($value['id']) )]) ? '' : $default_options[( esc_html($value['id']) )];	
				break;
				
				case "radio"    	  :		
					  $valid_input[(  esc_html($value['id'])  )] = empty($default_options[( esc_html($value['id']) )]) ? '' : $default_options[( esc_html($value['id']) )]; 
				break;
				
				case "checkbox"  	  :  	
					  $valid_input[(  esc_html($value['id'])  )] = empty($default_options[( esc_html($value['id']) )]) ? '' : $default_options[( esc_html($value['id']) )]; 
				break;
				
				case "select"    	  :  	
	 				 $valid_input[(  esc_html($value['id'])  )] = empty($default_options[( esc_html($value['id']) )]) ? '' : $default_options[( esc_html($value['id']) )];	
				break;
				
				case "multiselect"    :  	
					  $valid_input[(  esc_html($value['id'])  )] = empty($default_options[( esc_html($value['id']) )]) ? '' : implode(",", $default_options[( esc_html($value['id']) )]); 
				break;
				
				case "logo" 	 	  :  	
					  $valid_input[(  esc_html($value['id'])  )] = empty($default_options[( esc_html($value['id']) )]) ? '' : $default_options[( esc_html($value['id']) )]; 
				break;
				
				case "color" 	 	  :  	
					  $valid_input[(  esc_html($value['id'])  )] = empty($default_options[( esc_html($value['id']) )]) ? '' : $default_options[( esc_html($value['id']) )]; 
				break;
				
				case "editor"    	  : 	
					  $valid_input[(  esc_html($value['id'])  )] = empty($default_options[( esc_html($value['id']) )]) ? '' : $default_options[( esc_html($value['id']) )]; 
				break;
				
				case "typography" 	  :		
					 $valid_input[(  esc_html($value['id_1'])  )] = $default_options[(  $value['id_1']  )];
					 $valid_input[(  esc_html($value['id_2'])  )] = $default_options[(  $value['id_2']  )];
					 $valid_input[(  esc_html($value['id_3'])  )] = $default_options[(  $value['id_3']  )];	
				break;

				default 	  		  :	break;
			
			} // switch case ending					
	   } // foreach ending
		
	   add_settings_error( 'tg_framework',  'settings_updated' , esc_html__( 'Default options restored.', 'weddingvendor' ), 'error' );
	} // else if
 return $valid_input;	
}	
?>