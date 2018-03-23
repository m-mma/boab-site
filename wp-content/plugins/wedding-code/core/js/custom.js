function call_title(id){
  var edValue = document.getElementById(id);
  var s = edValue.value;

  jQuery('#title_'+id).text(s);
  jQuery('#title_code_'+id).text('[section title="'+s+'"]');
}

function call_tab_title(id){
  var edValue = document.getElementById(id);
  var s = edValue.value;

  jQuery('#title_'+id).text(s);
  jQuery('#title_code_'+id).text('[tab title="'+s+'"]');
}
function call_script_tabs_title(id){
  var edValue = document.getElementById(id);
  var s = edValue.value;

  jQuery('#title_'+id).text(s);
  jQuery('#title_code_'+id).text('\n[tab title="'+s+'"]\n');
} 
function call_desc(id)
{
    var edValue = document.getElementById(id);
    var s = edValue.value;
    jQuery('#code_'+id).text(s);    
} 
function call_tab_desc(id)
{
    var edValue = document.getElementById(id);
    var s = edValue.value;
    jQuery('#code_'+id).text(s);  
} 
function faq_title(id){
	var edValue = document.getElementById(id);
	var s = edValue.value;
	jQuery('#ques_code_'+id).text('[question title="'+s+'"]');
}
function faq_answer(id){
	var edValue = document.getElementById(id);
	var s = edValue.value;
	jQuery('#ans_'+id).text('\n'+s);
}

  jQuery(document).ready(function() {
               
      var count = 3; 
      var tab = 3;
      var faq = 3;
      var total_width=jQuery(document).width();
      var frame_width=((total_width*70)/100);

      jQuery('#tb_open').click(function() {
        tb_show('Shortcode','#TB_inline?width=780&height=550&inlineId=my-content-id');
        jQuery('.sub_content').hide();
        ajustamodal();
        return false;
      });
   
      jQuery('#tb_column').click(function() {
        tb_show('Select Your Column','#TB_inline?width=780&height=580&inlineId=my-column-id');
        jQuery('#main-content-column').show();
        jQuery('.sub_content').hide();
        ajustamodal();
        return false;
      });

      /**
       *   Accordion  
       */
      jQuery('.add_accordion').click(function() {
         count = count + 1;             
          jQuery('#acc_here').append('<span id="acc_code_'+count+'"><span id="title_code_acc_'+count+'">[section title=&quot; Your title #'+count+'&quot;]</span><br/><span id="code_desc_acc_'+count+'">Your Description here #'+count+'</span><br/>[/section]<br/></span>');
          jQuery('#accordion_inner').append('<div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"><span class="remove dashicons dashicons-no" style="float:right;"></span><a data-toggle="collapse" id="title_acc_'+count+'" data-parent="#accordion" href="#yourtitle'+count+'" class="collapsed" aria-expanded="false"> Your title #'+count+' </a></h4></div><div id="yourtitle'+count+'" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;"><div class="panel-body"><input style="width:100%;" id="acc_'+count+'" class="panel_input" onKeyPress="call_title(this.id)" onKeyUp="call_title(this.id)" value="Your title here #'+count+'"><textarea style="width:100%;height:100px;" id="desc_acc_'+count+'" class="panel_textarea " onKeyPress="call_desc(this.id)" onKeyUp="call_desc(this.id)">Your Description here #'+count+'</textarea></div></div></div>');           
          ajustamodal();
          return false;
        });
    
        jQuery(".remove").live('click', function() {
            jQuery(this).parent().parent().parent().remove();
            var id = jQuery(this).parent().find('a').attr('id').replace('title_acc_','');
                  jQuery('#acc_code_'+id).remove();
        });

        /**
          *  TABS
          */

       jQuery('.add_tabs').click(function(){
         tab = tab + 1; 
         jQuery('#tab_title').append('<li role="presentation" class=""><a href="#tab'+tab+'" id="title_tabs_'+tab+'" role="tab" aria-controls="tab'+tab+'"  data-toggle="tab"> TAB #'+tab+' </a><span class="tab_remove dashicons dashicons-no" style="float:left;"></span></li>');
         
         jQuery('#tab_desc').append('<div role="tabpanel" class="tab-pane" id="tab'+tab+'"><input style="width:100%;" id="tabs_'+tab+'" class="" onKeyPress="call_script_tabs_title(this.id)" onKeyUp="call_script_tabs_title(this.id)" value="TAB #'+tab+'"><textarea style="width:100%;height:100px;" id="desc_tabs_'+tab+'" class="" onKeyPress="call_tab_desc(this.id)" onKeyUp="call_tab_desc(this.id)">Description #'+tab+'</textarea></div>');        
         jQuery('#tabs_add').append('<span id="tab_code_'+tab+'"><span id="title_code_tabs_'+tab+'"> \n [tab title=&quot;Your title #'+tab+'&quot;]</span> \n <span id="code_desc_tabs_'+tab+'"> Your Description here #'+tab+'</span> \n [/tab]</span>');
         
         return false;
        });
       
        jQuery(".tab_remove").live('click', function() {
            jQuery(this).parent().remove();
			var id = jQuery(this).parent().find('a').attr('id').replace('title_tabs_','');
			jQuery('#tab_code_'+id).remove();
			jQuery('#tab'+id).remove();
        });

         /* FAQ */ 
        jQuery('.add_faq').click(function() {
          faq = faq + 1;             
          jQuery('#faq_here').append('<span id="ques_code_'+faq+'"><span id="ques_code_faq_'+faq+'">[question title=&quot; Your Question #'+faq+'&quot;]</span><br/><span id="ans_code_faq_'+faq+'">Your Answer here #'+faq+'</span>\n[/question]\n</span>');

          jQuery('#call_faq_class').append('<div class="panel-faq"><input style="width:100%;" id="faq_'+faq+'" class="panel_input" onKeyPress="faq_title(this.id)" onKeyUp="faq_title(this.id)" value="Your Question here #'+faq+'"><textarea style="width:100%;height:60px;" id="code_faq_'+faq+'" class="panel_textarea " onKeyPress="faq_answer(this.id)" onKeyUp="faq_answer(this.id)">Your Anwser here #'+faq+'</textarea></div>');           

          ajustamodal();
          return false;
          });
      
      /**
       *  wp_editor edit shortcode.
       */

      jQuery(".insert-code").click(function() {
        var example = jQuery( this ).parent().prev().find("code").text();
        var lines = example.split("\n");
        var paras = "";
        jQuery.each(lines, function(i, line) {
          if (line) {
            paras += line + "<br />";
          }
        });
        var win = window.dialogArguments || opener || parent || top;
        win.send_to_editor(paras);
      });
	  
 
      jQuery(".insert-icon").click(function() {
        
        var icon=jQuery(".selected_icon").find("i").attr('class');
        var icon_class=jQuery(".selected_icon").attr('class');
        icon_class=icon_class.replace('col-md-3','');
        icon_class=icon_class.replace('icon_box','');
        icon_class=icon_class.replace(' selected_icon','');

        var icon_color=jQuery(".selected_icon").find("i").attr('ref');
        var call_code='[icon class="'+icon_class+'" icon="'+icon+'" color="'+icon_color+'"]';
        var win = window.dialogArguments || opener || parent || top;
        win.send_to_editor(call_code);
      });
      
      
      jQuery(".insert-column").click(function() {
        var example = jQuery("#insert-html").find("code").text();
        var lines = example.split("\n");
        var paras = "";
        jQuery.each(lines, function(i, line) {
          if (line) {
            paras += line + "<br />";
          }
        });
        var win = window.dialogArguments || opener || parent || top;
        win.send_to_editor(paras);
      });

      jQuery(".icon_box").click(function() {  
        jQuery(".icon_box").removeClass("selected_icon"); 
        jQuery(".icon_box").removeClass("icon_left");
        jQuery(".icon_box").removeClass("icon_right"); 
        jQuery(".icon_box").removeClass("icon_center");                  

        var color_icon = jQuery("#color_icon").val();
        if(color_icon!="")
        {
          jQuery( ".icon_box" ).find("i").css({"color":"#444444"});
          jQuery( this ).find("i").css({"color":color_icon});
          jQuery( this ).find("i").attr('ref',color_icon);
        }

        jQuery( ".icon_box" ).find("i").removeClass('fa-4x');
        jQuery( ".icon_box" ).find("i").removeClass('fa-5x');
        jQuery( ".icon_box" ).find("i").removeClass('fa-3x'); 

        jQuery( ".icon_box" ).find("i").addClass('fa-3x');          
              
        var icon_size = jQuery("#icon_size").val();      
        jQuery( this).find("i").addClass(icon_size);  

        jQuery(".icon_box").removeClass("icon_center");     

        var alinment= jQuery("#alinment").val();
        jQuery( this ).addClass(alinment);
        jQuery( this ).addClass("selected_icon");
      }); 

      jQuery(".call-list-view").click(function() {    
        var htmlString = jQuery( this ).html(); 
        var icon_class=jQuery( this ).find("img").attr('class');  
        var ul_ol="";
        if(icon_class=="list-ol")
        {
          ul_ol="ol";
        }
        else
        { 
          ul_ol="ul";
        }

        var call_code='['+ul_ol+' class="'+icon_class+'"]<br />[li].......[/li]<br />[li].......[/li]<br />[li].....[/li]<br />[/'+ul_ol+']';
        var win = window.dialogArguments || opener || parent || top;
        win.send_to_editor(call_code);
      });

      jQuery(".call-icon-box img").click(function() {  
        jQuery(".call-icon-box img").removeClass("box_actived")
        jQuery( this ).addClass("box_actived");
      });

      jQuery(".insert-icon-box").click(function() {  
        var layout = jQuery(".box_actived").attr('id');  
        var icon = jQuery("#icon_select").val();
        var title = jQuery("#icon_title").val();
        var desc =  jQuery("#icon_desc").val();
        var button_text =  jQuery("#button_text").val();	
        var button_url =  jQuery("#button_url").val();				

        if(!jQuery(".call-icon-box img").hasClass('box_actived'))
        {
          alert("Layout: Please choose your iconbox layout");
          return false;
        }
        else if(title=="")
        {
          alert("Please enter the title !");
          return false;
        }
        else{
          var call_code='[iconbox icon="'+icon+'" layout="'+layout+'" title="'+title+'" button_text="'+button_text+'" button_url="'+button_url+'"]'+desc+'[/iconbox]';
          var win = window.dialogArguments || opener || parent || top;
          win.send_to_editor(call_code); 
        }
      });

      jQuery(".call-divider").click(function() {  
	  
        var htmlString = jQuery( this ).html(); 
        var divi_class=jQuery( this ).find("img").attr('class');  

        var call_code='[divi class="'+divi_class+'"][/divi]';
        var win = window.dialogArguments || opener || parent || top;
        win.send_to_editor(call_code);        
      });
	  

      jQuery(".call-button").click(function() {  
        var htmlString = jQuery( this ).html(); 
        var button_class=jQuery( this ).find("img").attr('class');  

        var call_code='[button class="'+button_class+'" url="http://www.yourwebsite.com"]Add Your Title[/button]';
        var win = window.dialogArguments || opener || parent || top;
        win.send_to_editor(call_code);        
      });	  
	  
      jQuery(".feature-block").click(function() {  	  
		var block_id = jQuery(this).attr('id');  
		var call_code='['+block_id+']';
		
    	if(block_id=="testimonial-block")
		{
		  call_code="["+block_id+" title='Add Title Here' class='tp-section']";
		  var win = window.dialogArguments || opener || parent || top;
		  win.send_to_editor(call_code);  
		}
    	else if(block_id=="featured-block")
		{
		  call_code="["+block_id+" title='Add Title Here' class='tp-section']";
		  var win = window.dialogArguments || opener || parent || top;
		  win.send_to_editor(call_code);  
		}				
    	else if(block_id=="register-block" || block_id=="login-block" || block_id=="couple-register-block" || block_id=="couple-login-block"  )
		{
		  call_code="["+block_id+" title='Add Title Here']";
		  var win = window.dialogArguments || opener || parent || top;
		  win.send_to_editor(call_code);  
		}				
		else if(block_id=="space")
		{
		  call_code="["+block_id+" class='feature-section' title='Title Goes Here'][/"+block_id+"]";
		  var win = window.dialogArguments || opener || parent || top;
		  win.send_to_editor(call_code);  
		}
		else if(block_id=="location")
		{
		  call_code="["+block_id+" image='image-url-here' title='title goes here' url='redirect url'][/"+block_id+"]";
		  var win = window.dialogArguments || opener || parent || top;
		  win.send_to_editor(call_code);  
		}
		else if(block_id=="category")
		{
		  call_code="["+block_id+" image='image-url-here' title='title goes here' url='redirect url' count='number of items'][/"+block_id+"]";
		  var win = window.dialogArguments || opener || parent || top;
		  win.send_to_editor(call_code);  
		}	
		else if(block_id=="parallax")
		{
		  call_code="["+block_id+" bg_img='bg-img-here' title='title goes here' details='add details here' btn_title='add btn title' btn_url='#'][/"+block_id+"]";
		  var win = window.dialogArguments || opener || parent || top;
		  win.send_to_editor(call_code);  
		}				
		else if(block_id=="onepage")
		{
		  call_code='[scrollgroup] \n [scroll title="Title1" class="active"] \n ... \n [/scroll] \n [scroll title="Title2"] \n ... \n [/scroll] \n [scroll title="Title3"] \n ... \n [/scroll] \n [/scrollgroup]';
		  var lines = call_code.split("\n");
		  var paras = "";
		  jQuery.each(lines, function(i, line) {
			if (line) {
			  paras += line + "<br />";
			}
		  });
		  
		  var win = window.dialogArguments || opener || parent || top;
		  win.send_to_editor(paras);  		
		}		
		else
		{
		  var win = window.dialogArguments || opener || parent || top;
		  win.send_to_editor(call_code);            
		}      
      });	 

      jQuery(".call-alert").click(function() {  

        var htmlString = jQuery( this ).html(); 
        var alert_class= jQuery( this ).find("img").attr('class');  

        var call_code='[alert class="'+alert_class+'"].............[/alert]';
        var win = window.dialogArguments || opener || parent || top;
        win.send_to_editor(call_code);        
      });

      jQuery('.box-column').click(function(){
        ajustamodal();        
        if(this.id=="tb_box1")
        {
          jQuery('#insert-html').html('<pre><code> [row] \n [column md="12"] \n ... \n [/column] \n [/row] </code></pre>');
        }
        if(this.id=="tb_box2")
        {
          jQuery('#insert-html').html('<pre><code> [row] \n [column md="6"] \n ... \n [/column] \n [column md="6"] \n ... \n [/column] \n [/row] </code></pre>');
        }
        if(this.id=="tb_box3")
        {
          jQuery('#insert-html').html('<pre><code> [row] \n [column md="4"] \n ... \n [/column] \n [column md="4"] \n ... \n [/column] \n [column md="4"] \n ... \n [/column] \n [/row] </code></pre>');
        }
        if(this.id=="tb_box4")
        {
          jQuery('#insert-html').html('<pre><code> [row] \n [column md="3"] \n ... \n [/column] \n [column md="3"] \n ... \n [/column] \n [column md="3"] \n ... \n [/column] \n [column md="3"] \n ... \n [/column] \n [/row] </code></pre>');
        }

        if(this.id=="tb_box5")
        {
          jQuery('#insert-html').html('<pre><code> [row] \n [column md="3"] \n ... \n [/column] \n [column md="9"] \n ... \n [/column] \n [/row] </code></pre>');
        }       

        if(this.id=="tb_box6")
        {
          jQuery('#insert-html').html('<pre><code> [row] \n [column md="9"] \n ... \n [/column] \n [column md="3"] \n ... \n [/column] \n [/row] </code></pre>');
        }       

        if(this.id=="tb_box7")
        {
          jQuery('#insert-html').html('<pre><code> [row] \n [column md="6"] \n ... \n [/column] \n [column md="3"] \n ... \n [/column] \n [column md="3"] \n ... \n [/column] \n [/row] </code></pre>');
        }       

        if(this.id=="tb_box8")
        {
          jQuery('#insert-html').html('<pre><code> [row] \n [column md="3"] \n ... \n [/column] \n [column md="3"] \n ... \n [/column] \n [column md="6"] \n ... \n [/column] \n [/row] </code></pre>');
        } 

             
        if(this.id=="tb_box10")
        {
          jQuery('#insert-html').html('<pre><code>[container]\n[/container]</code></pre>');
        }   
		            
 		if(this.id=="tb_box21")
        {
          jQuery('#insert-html').html('<pre><code> [inner-row] \n [inner-column md="6"] \n ... \n [/inner-column] \n [inner-column md="6"] \n ... \n [/inner-column] \n [/inner-row] </code></pre>');
        }
        if(this.id=="tb_box22")
        {
          jQuery('#insert-html').html('<pre><code> [inner-row] \n [inner-column md="4"] \n ... \n [/inner-column] \n [inner-column md="4"] \n ... \n [/inner-column] \n [inner-column md="4"] \n ... \n [/inner-column] \n [/inner-row]</code></pre>');
        }
        if(this.id=="tb_box23")
        {
          jQuery('#insert-html').html('<pre><code> [inner-row] \n [inner-column md="3"] \n ... \n [/inner-column] \n [inner-column md="3"] \n ... \n [/inner-column] \n [inner-column md="3"] \n ... \n [/inner-column] \n [inner-column md="3"] \n ... \n [/inner-column] \n [/inner-row]</code></pre>');
        }
        if(this.id=="tb_box24")
        {
          jQuery('#insert-html').html('<pre><code> [inner-row] \n [inner-column md="9"] \n ... \n [/inner-column] \n [inner-column md="3"] \n ... \n [/inner-column] \n [/inner-row]</code></pre>');
        }


        jQuery('#insert-html').append('<button class="button button-primary insert-column" onclick="insert()">Insert Code</button>'); 
      });

      jQuery('ul.nav-tabs li a[href="#icons"]').click(function (e) {
        ajustamodal();
      })    
      jQuery('ul.nav-tabs li a[href="#list_view"]').click(function (e) {
        ajustamodal();
      })          
      jQuery('ul.nav-tabs li a[href="#divider"]').click(function (e) {
        ajustamodal();
      })   

      jQuery('ul.nav-tabs li a[href="#acc_preview"]').click(function (e) {
        ajustamodal();
      })       

      jQuery('ul.nav-tabs li a[href="#acc_preview"]').click(function (e) {
        ajustamodal();
      })                      

      jQuery('ul.nav-tabs li a[href="#iconbox"]').click(function (e) {
        ajustamodal();
      })                
  });



function insert()
{
  var example = jQuery("#TB_ajaxContent").find("code").text();
  var lines = example.split("\n");
  var paras = "";
  jQuery.each(lines, function(i, line) {
    if (line) {
      paras += line + "<br />";
    }
  });
  var win = window.dialogArguments || opener || parent || top;
  win.send_to_editor(paras);
}
jQuery(document).ready(ajustamodal);
jQuery(window).resize(ajustamodal);
function ajustamodal() {
  var altura = jQuery(window).height()-150; 
  jQuery("#TB_ajaxContent").css({"height":altura,"overflow-y":"auto"});
}