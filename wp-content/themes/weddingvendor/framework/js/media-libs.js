
(function($) {
	$(document).ready( function() {
            $('.attach_delete').click(function(){
                var curent;
                var img_remove= jQuery(this).parent().attr('data-imageid');
                jQuery(this).parent().remove();
//                jQuery('#property_uploaded_thumb_wrapepr .uploaded_images').each(function(){
//                    remove  =   jQuery(this).attr('data-imageid');
//                    curent  =   curent+','+remove; 
//         
//                });
                
                jQuery('#property_uploaded_thumb_wrapepr .uploaded_thumb').each(function(){
                    remove  =   jQuery(this).attr('data-imageid');
                    curent  =   curent+','+remove; 
         
                });
                
                
                jQuery('#image_to_attach').val(curent); 
  
                jQuery.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        'action'        :   'weddingvendor_delete_file',
                        'attach_id'     :   img_remove,
                    },
                    success: function (data) {     
                       console.log(data);

                    },
                    error: function (errorThrown) {  console.log(errorThrown);}
                });//end ajax   
  
            });
         
                
            $('.attach_edit').click(function(event){
                return;
                   event.stopPropagation();
                    event.preventDefault();
                   var  metaBox = $('#media_gallery');
                    var imgContainer = metaBox.find( '.property_uploaded_thumb_wrapepr');
                    
                    var imgIdInput = metaBox.find( '#image_to_attach' ).val();
                    var post_id=$(this).attr('data-postid');
                    
                   
			var frame = new wp.media.view.MediaFrame.EditAttachments({
				// Modal title
				

				
                        });
                        frame.state();
      

			// Get an object representing the previous state.
                        frame.lastState();

			// Open the modal.
			frame.open();  
		
            });
            
            
            
		$('#button_new_image').on( 'click', function(event) {
                    event.stopPropagation();
                    event.preventDefault();
                   	var  metaBox = $('#media_gallery');
                    var imgContainer = metaBox.find( '.property_uploaded_thumb_wrapepr');
					var imgbox = $( '#property_uploaded_thumb_wrapepr');
                    
                    var imgIdInput = metaBox.find( '#image_to_attach' ).val();
                    var post_id=$(this).attr('data-postid');
                    
                 
			// Accepts an optional object hash to override default values.
			var frame = new wp.media.view.MediaFrame.Select({
				// Modal title
				title: 'Select Images',

				// Enable/disable multiple select
				multiple: true,

				// Library WordPress query arguments.
				library: {
					order: 'DESC',

					// [ 'name', 'author', 'date', 'title', 'modified', 'uploadedTo',
					// 'id', 'post__in', 'menuOrder' ]
					orderby: 'id',

					// mime type. e.g. 'image', 'image/jpeg'
					type: 'image',

					

					// Attached to a specific post (ID).
					//uploadedTo: post_id
				},

				button: {
					text: 'Set Image'
				}
			});

			// Fires after the frame markup has been built, but not appended to the DOM.
			// @see wp.media.view.Modal.attach()
			frame.on( 'ready', function() { } );

			// Fires when the frame's $el is appended to its DOM container.
			// @see media.view.Modal.attach()
			frame.on( 'attach', function() {} );

			// Fires when the modal opens (becomes visible).
			// @see media.view.Modal.open()
			frame.on( 'open', function() {} );

			// Fires when the modal closes via the escape key.
			// @see media.view.Modal.close()
			frame.on( 'escape', function() {} );

			// Fires when the modal closes.
			// @see media.view.Modal.close()
			frame.on( 'close', function() {} );

			// Fires when a user has selected attachment(s) and clicked the select button.
			// @see media.view.MediaFrame.Post.mainInsertToolbar()
			frame.on( 'select', function(arguments) {
                                var attachment = frame.state().get('selection').toJSON();
                               
                                var arrayLength = attachment.length;
								
                                for (var i = 0; i < arrayLength; i++) {
                                    imgIdInput = metaBox.find( '#image_to_attach' ).val();
                                    $( '#image_to_attach' ).val(imgIdInput+attachment[i].id+",");

                                    imgContainer.append( '<div class="uploaded_thumb" data-imageid="'+attachment[i].id+'"><img src="'+attachment[i].sizes.thumbnail.url+'" alt="" style="max-width:100%;"/><a target="_blank" href="'+admin_control_vars.admin_url+'post.php?post='+attachment[i].id+'&action=edit" class="attach_edit"><i class="fa fa-pencil" aria-hidden="true"></i></a><a class="attach_delete"><i class="fa fa-trash-o" aria-hidden="true"></i></span></div>' );

                                }
                            
                                //$( '#image_to_attach' ).val(imgIdInput+attachment.id+",")
                                //imgContainer.append( '<img src="'+attachment.sizes.thumbnail.url+'" alt="" style="max-width:100%;"/>' );

                                // Send the attachment id to our hidden input
                               // imgIdInput.val( attachment.id );
							   //alert(imgIdInput+attachment.id);
			} );

			// Fires when a state activates.
			frame.on( 'activate', function() {} );

			// Fires when a mode is deactivated on a region.
			frame.on( '{region}:deactivate', function() {} );
			// and a more specific event including the mode.
			frame.on( '{region}:deactivate:{mode}', function() {} );

			// Fires when a region is ready for its view to be created.
			frame.on( '{region}:create', function() {} );
			// and a more specific event including the mode.
			frame.on( '{region}:create:{mode}', function() {} );

			// Fires when a region is ready for its view to be rendered.
			frame.on( '{region}:render', function() {} );
			// and a more specific event including the mode.
			frame.on( '{region}:render:{mode}', function() {} );

			// Fires when a new mode is activated (after it has been rendered) on a region.
			frame.on( '{region}:activate', function() {} );
			// and a more specific event including the mode.
			frame.on( '{region}:activate:{mode}', function() {} );

			// Get an object representing the current state.
		frame.state();
             

			// Get an object representing the previous state.
		frame.lastState();

			// Open the modal.
			frame.open();  
		});
	});
})(jQuery);




jQuery(document).ready(function($) {
    
    /*admin tabs*/
    $("#property_uploaded_thumb_wrapepr" ).sortable({
        revert: true,
        update: function( event, ui ) {
            var all_id,new_id;
            all_id="";
            $( "#property_uploaded_thumb_wrapepr .uploaded_thumb" ).each(function(){

                new_id = $(this).attr('data-imageid'); 
                if (typeof new_id != 'undefined') {
                    all_id=all_id+","+new_id; 

                }

            });

            $('#image_to_attach').val(all_id);
        },
    });


// function for tab management
function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function clearimg(){
	$('#tabpat img').each(function(){
	$(this).css('border','none');
	})	
};

	
});

