// JavaScript Document
jQuery(document).ready(function($){


	//Add Class to widget area
	jQuery('.widget .well-box ul').addClass('listnone angle-double-right');
	jQuery('#commentform #comment,#pixrating_title').addClass('form-control');

	if($('.accordion').hasClass('st-accordion'))
	{
		  "use strict";
		var $active = $('.st-accordion .panel-collapse.in').prev().addClass('active');
		$active.find('a').prepend('<i class="fa fa-angle-double-up sign"></i>');
		$('.st-accordion .panel-heading').not($active).find('a').prepend('<i class="fa fa-angle-double-down sign"></i>');
		$('.st-accordion').on('show.bs.collapse', function (e) {
			$('.st-accordion .panel-heading.active').removeClass('active').find('.fa').toggleClass('fa-angle-double-down fa-angle-double-up');
			$(e.target).prev().addClass('active').find('.fa').toggleClass('fa-angle-double-down fa-angle-double-up');
		})
	}		
	if($('.book_date').hasClass('check_book_date'))
	{
		$('.book_date').datepicker({
			dateFormat : 'yy-mm-dd',
			minDate: 1
		});

	}
	// Display Password Modal Popuo
	$("#resetpassword").modal('show');
	
	// Display Percentage
	if(jQuery('#todo-percentage').hasClass('todo-percentage'))
	{
		jQuery('.todo-percentage').percentcircle({});
	}
	
	// Todo list show and hide form
    jQuery("#hide").click(function(){
        jQuery(".todo-form").hide(400);
    });
    jQuery("#show").click(function(){
        jQuery(".todo-form").show(400);
    });	

	// Todo list show and hide form
    jQuery("#budget_hide").click(function(){
        jQuery(".budget-form").hide(400);
    });
    jQuery("#budget_show").click(function(){
        jQuery(".budget-form").show(400);
    });		


	if($('#leftCol').hasClass('side-nav'))
	{
		/* activate sidebar */
		$('#sidebar').affix({
		  offset: {
			top: 180,
		  }
		});
		
		/* activate scrollspy menu */
		var $body   = $(document.body);
		var navHeight = $('.navbar').outerHeight(true) + 10;
		
		$body.scrollspy({
			target: '#leftCol',
			offset: navHeight
		});
		
		/* smooth scrolling sections */
		$('a[href*="#"]:not([href="#"])').click(function() {
			"use strict";
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			  var target = $(this.hash);
			  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			  if (target.length) {
				$('html,body').animate({
				  scrollTop: target.offset().top - 50
				}, 1000);
				return false;
			  }
			}
		});
	}
	
	$(window).bind('scroll', function() {
	  "use strict";
			if($(window).scrollTop() >= $('.footer').offset().top - window.innerHeight) {
			  
			  $(".hide-side").hide('fast');
			}
	  else{
		$(".hide-side").show('fast');
	  }
	});	


	if($('#price-range').hasClass('pricing_range'))
	{
		"use strict";	
		$( "#price-range" ).slider({
					range: true,
					min: 1,
					max: 900000,
					values: [ 1, 900000],
					slide: function( event, ui ) {
						$( "#amount" ).html( " " + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
						$("#min_price").val(ui.values[ 0 ]);
						$("#max_price").val(ui.values[ 1 ]);
						
					}
				});
				$( "#amount" ).html( " " + $( "#price-range" ).slider( "values", 0 ) + 	" - " + $( "#price-range" ).slider( "values", 1 ) );
					$("#min_price").val($( "#price-range" ).slider( "values", 0 ));
					$("#max_price").val($( "#price-range" ).slider( "values", 1 ));
				}	
	});		

	// Vendor AJAX user-profile on form submit
	jQuery('#user-profile-on').on('click', function (e) {

        if (!jQuery("#user-profile").valid()) return false;
        jQuery('#user-profile .status', this).show().text(ajax_auth_object.loadingmessage);
		action = 'wedding_ajax_vendor_profile';
		firstname = jQuery('#user-profile #firstname').val();
		lastname = jQuery('#user-profile #lastname').val();
		website = jQuery('#user-profile #website').val();
		phone = jQuery('#user-profile #phone').val();	
		address = jQuery('#user-profile #address').val();
		about = jQuery('#user-profile #about').val();		

		facebook = jQuery('#user-profile #facebook').val();
		googleplus = jQuery('#user-profile #googleplus').val();
		twitter = jQuery('#user-profile #twitter').val();
		youtube = jQuery('#user-profile #youtube').val();
		linkedin = jQuery('#user-profile #linkedin').val();
		pinterest = jQuery('#user-profile #pinterest').val();
		instagram = jQuery('#user-profile #instagram').val();				
		
		security = jQuery('#user-profile #security').val();
		ctrl = jQuery("#user-profile");
	
        profile_image_url  = jQuery('#profile-image').attr('data-profileurl');
        profile_image_url_small  = jQuery('#profile-image').attr('data-smallprofileurl');
		
		
		jQuery.ajax({
            type: 'POST',
            url: ajax_auth_object.ajaxurl,
			dataType: 'json',
            data: {
                'action': action,
                'firstname': firstname,
                'lastname': lastname,
				'website': website,
				'phone': phone,
				'address': address,
				'about': about,
                'facebook': facebook,
                'googleplus': googleplus,
				'twitter': twitter,
				'youtube': youtube,
				'linkedin': linkedin,
				'pinterest': pinterest,
				'instagram': instagram,				
                'profile_image_url' : profile_image_url,
                'profile_image_url_small' : profile_image_url_small,								
                'security': security
            },
            success: function (data) {
				jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
				jQuery('#user-profile .status').show();
				jQuery('#user-profile .status').text(data.message);
            }
        });
        e.preventDefault();
    });	


	// Couple AJAX user-profile on form submit
	jQuery('#couple-profile-on').on('click', function (e) {

        if (!jQuery("#couple-profile").valid()) return false;
        jQuery('#couple-profile .status', this).show().text(ajax_auth_object.loadingmessage);
		action = 'wedding_ajax_couple_profile';
		firstname = jQuery('#couple-profile #firstname').val();
		lastname = jQuery('#couple-profile #lastname').val();
		about = jQuery('#couple-profile #about').val();
		
		weddingdate = jQuery('#couple-profile #wedding_date').val();
		weddingcity = jQuery('#couple-profile #wedding_city').val();
		weddingstate = jQuery('#couple-profile #wedding_state').val();		

		facebook = jQuery('#couple-profile #facebook').val();
		googleplus = jQuery('#couple-profile #googleplus').val();
		twitter = jQuery('#couple-profile #twitter').val();
		youtube = jQuery('#couple-profile #youtube').val();
		linkedin = jQuery('#couple-profile #linkedin').val();
		pinterest = jQuery('#couple-profile #pinterest').val();
		instagram = jQuery('#couple-profile #instagram').val();				
		
		security = jQuery('#couple-profile #security').val();
		ctrl = jQuery("#couple-profile");
	
        profile_image_url  = jQuery('#profile-image').attr('data-profileurl');
        profile_image_url_small  = jQuery('#profile-image').attr('data-smallprofileurl');
		
		jQuery.ajax({
            type: 'POST',
            url: ajax_auth_object.ajaxurl,
			dataType: 'json',
            data: {
                'action': action,
                'firstname': firstname,
                'lastname': lastname,
				'about': about,
				'weddingdate': weddingdate,
				'weddingcity': weddingcity,
				'weddingstate': weddingstate,
                'facebook': facebook,
                'googleplus': googleplus,
				'twitter': twitter,
				'youtube': youtube,
				'linkedin': linkedin,
				'pinterest': pinterest,
				'instagram': instagram,				
                'profile_image_url' : profile_image_url,
                'profile_image_url_small' : profile_image_url_small,								
                'security': security
            },
            success: function (data) {
				
				jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
				jQuery('#couple-profile .status').show();
				jQuery('#couple-profile .status').text(data.message);
            }
        });
		
        e.preventDefault();
    });	

	// Perform AJAX change-password on form submit
	jQuery('#change-password-on').on('click', function (e) {
		
        if (!jQuery("#change-password").valid()) return false;
        jQuery('#change-password .status', this).show().text(ajax_auth_object.loadingmessage);
		action = 'wedding_ajax_change_password';
		old_pwd = jQuery('#change-password #old_pwd').val();
		new_pwd = jQuery('#change-password #new_pwd').val();
		confirm_pwd = jQuery('#change-password #confirm_pwd').val();
		security = jQuery('#change-password #security').val();
		ctrl = jQuery("#change-password");
		
		jQuery.ajax({
            type: 'POST',
            url: ajax_auth_object.ajaxurl,
            data: {
                'action': action,
                'old_pwd': old_pwd,
                'new_pwd': new_pwd,
				'confirm_pwd': confirm_pwd,
                'security': security
            },
            success: function (data) {
				jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
				jQuery('#change-password .status').show();
				jQuery('#change-password .status').html(data);
            }
        });
        e.preventDefault();
    });	

	// Perform AJAX change-password on form submit
	jQuery('#add-listing-on').on('click', function (e) {
        if (!$("form#add-listing").valid()) return false;
        jQuery('.status', this).show().text(ajax_auth_object.loadingmessage);
		action = 'wedding_ajax_add_listing';
		add_title = jQuery('#add-listing #add_title').val();		
		//add_content = jQuery('#add-listing #add_content').val();
		add_content = jQuery('#add-listing #add_content').html();		
		add_min_price = jQuery('#add-listing #add_min_price').val();
		add_max_price = jQuery('#add-listing #add_max_price').val();
		add_min_capacity = jQuery('#add-listing #add_min_capacity').val();
		add_address = jQuery('#add-listing #add_address').val();
		add_latitude = jQuery('#add-listing #gmaps-output-latitude').val();
		add_longitude = jQuery('#add-listing #gmaps-output-longitude').val();
		add_video_url = jQuery('#add-listing #add_video_url').val();
		add_item_cat = jQuery('#add-listing #add_item_cat').val();
		item_city = jQuery('#add-listing #item_city').val();														
		
		security = jQuery('#add-listing #security').val();
		ctrl = jQuery("#add-listing");

		attachid = jQuery('#add-listing #attachid').val();
		attachthumb = jQuery('#add-listing #attachthumb').val();

		var aminities='';
		jQuery('input[name="add_item_ami"]:checked').each(function() {
		   aminities=aminities+','+this.value;
		});	
	
		jQuery.ajax({
            type: 'POST',
            url: ajax_auth_object.ajaxurl,
            data: {
                'action': action,
                'add_title': add_title,
                'add_content': add_content,
				'add_min_price': add_min_price,
				'add_max_price': add_max_price,
				'add_min_capacity': add_min_capacity,
				'add_address': add_address,
				'add_latitude': add_latitude,
				'add_longitude': add_longitude,
				'add_video_url': add_video_url,
				'add_item_cat': add_item_cat,
				'attachid': attachid,
				'item_city': item_city,								
                'attachthumb': attachthumb,				
                'add_item_ami': aminities,												
                'security': security
            },
            success: function (data) {
				jQuery('#add-listing-on').remove();
				jQuery('#add-listing #add_title').val('');
				jQuery('#add-listing #add_content').val('');
				
				
				jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
				jQuery('.status').show();
				jQuery('.status').html(data);
				
            }
        });
        e.preventDefault();
    });	

	// Perform AJAX change-password on form submit
	jQuery('#edit-listing-on').on('click', function (e) {
        //if (!$("form#add-listing").valid()) return false;
        jQuery('.status', this).show().text(ajax_auth_object.loadingmessage);
		action = 'wedding_ajax_edit_listing';
		add_title = jQuery('#add-listing #add_title').val();
		//add_content = jQuery('#add-listing #add_content').val();
		//add_content = jQuery('#add-listing #add_content').html();	

		if (jQuery("#wp-add_content-wrap").hasClass("tmce-active")){
			add_content=tinyMCE.activeEditor.getContent();
		}else{
			add_content=jQuery('#add-listing #add_content').val();
		}		

		add_min_price = jQuery('#add-listing #add_min_price').val();
		add_max_price = jQuery('#add-listing #add_max_price').val();
		add_min_capacity = jQuery('#add-listing #add_min_capacity').val();
		add_address = jQuery('#add-listing #add_address').val();
		add_latitude = jQuery('#add-listing #gmaps-output-latitude').val();
		add_longitude = jQuery('#add-listing #gmaps-output-longitude').val();
		add_video_url = jQuery('#add-listing #add_video_url').val();
		add_item_cat = jQuery('#add-listing #add_item_cat').val();
		edit_id = jQuery('#add-listing #edit_id').val();
		item_city = jQuery('#add-listing #item_city').val();														
		
		security = jQuery('#add-listing #security').val();
		ctrl = jQuery("#add-listing");

		attachid = jQuery('#add-listing #attachid').val();
		attachthumb = jQuery('#add-listing #attachthumb').val();

		var aminities='';
		jQuery('input[name="add_item_ami"]:checked').each(function() {
		   aminities=aminities+','+this.value;
		});		
		jQuery.ajax({
            type: 'POST',
            url: ajax_auth_object.ajaxurl,
            data: {
                'action': action,
                'add_title': add_title,
                'add_content': add_content,
				'add_min_price': add_min_price,
				'add_max_price': add_max_price,
				'add_min_capacity': add_min_capacity,
				'add_address': add_address,
				'add_latitude': add_latitude,
				'add_longitude': add_longitude,
				'add_video_url': add_video_url,
				'add_item_cat': add_item_cat,								
                'add_item_ami': aminities,
				'attachid': attachid,
				'item_city': item_city,								
                'attachthumb': attachthumb,				
				'security': security,
				'edit_id': edit_id,
				
            },
            success: function (data) {
				jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
				jQuery('.status').show();
				jQuery('.status').html(data);
            }
        });
        e.preventDefault();
    });	

	// Perform AJAX delete on form submit
	jQuery('.delete-on').on('click', function (e) {

  	var strconfirm = confirm("Are you sure you want " +this.title + " to delete?");
	if (strconfirm == true)
    {
        jQuery('.status', this).show().text(ajax_auth_object.loadingmessage);
		action = 'wedding_ajax_delete_listing';
		delete_id = this.id;

		jQuery.ajax({
            type: 'POST',
            url: ajax_auth_object.ajaxurl,
            data: {
                'action': action,
				'delete_id': delete_id,				
            },
            success: function (data) {
				jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
				jQuery('.status').show();
				jQuery('.status').html(data);
				jQuery('#manage_'+delete_id).remove();
				
            }
        });	  
    }

		
		return false;
        e.preventDefault();
    });		


	jQuery('#wp_forgot').on('click', function (e){ 
    	"use strict";	
   
    	var  forgot_email, securityforgot, postid, ajaxurl;		

        forgot_email          =  jQuery('#forgot_email').val();
        securityforgot        =  jQuery('#security-forgot').val();
		
		postid                =  jQuery('#postid').val();
	
		jQuery.ajax({
			type: 'POST',
			url: ajax_auth_object.ajaxurl,
			data: {
				'action'            :   'wedding_ajax_forgot_pass',
				'forgot_email'      :   forgot_email,
				'security-forgot'   :   securityforgot,
				'postid'            :   postid
			},
	
			success: function (data) {
			
			jQuery('#forgot_email').val('');
			jQuery('#forgot_pass_area').empty().append('<div class="login-alert">' + data + '<div>');        
				
			},
			error: function (errorThrown) {
			}
		});


		return false;
        e.preventDefault();
    });

	jQuery( "#change-password" ).validate({
	  rules: {
		new_pwd : {
		   minlength : 6
		},	  
		confirm_pwd: {
		  minlength : 6,	
		  equalTo: "#new_pwd"
		}
	  }
	});
	
	
	// Perform AJAX wedding_ajax_sendme on form submit
	jQuery('#book-now-box').validate();
	jQuery('form#book-now-box').on('submit', function (e) {
		if (!$(this).valid()) return false;
		jQuery('.status', this).show().text(ajax_auth_object.loadingmessage);
		action = 'wedding_ajax_sendme';
		name = jQuery('#book-now-box #name').val();
		phone = jQuery('#book-now-box #phone').val();
		email = jQuery('#book-now-box #email').val();
		date = jQuery('#book-now-box #date').val();
		guest = jQuery('#book-now-box #guest').val();
		item_title = jQuery('.item_title').text();
		
		user_email_id = jQuery('#book-now-box #user_email_id').val();
		security = jQuery('#book-now-box #security').val();
	
		var sendme='';
		jQuery('input[name="sendme"]:checked').each(function() {
		   sendme=sendme+','+this.value;
		});	
		
		jQuery('.status').html('Loading..... ');
		jQuery.ajax({
			type: 'POST',
			url: ajax_auth_object.ajaxurl,
			data: {
				'action': action,
				'name': name,
				'phone': phone,
				'email': email,
				'date': date,
				'guest': guest,
				'sendme': sendme,
				'item_title':item_title,
				'user_email_id':user_email_id,
				'item_url':window.location.href,				
				'security': security,				
			},
			success: function (data) {
				jQuery('.status').show();
				jQuery('.status').html(data);
				jQuery('#book-now-box #name').val('');
				jQuery('#book-now-box #phone').val('');
				jQuery('#book-now-box #email').val('');
				jQuery('#book-now-box #date').val('');			
			}
		});
		e.preventDefault();
	});	
	

	// Perform AJAX Based Search
	jQuery('#btn-search-on').on('click', function (e) {	
		jQuery('#btn-search-on').hide();
		call_paging_item(1);
		e.preventDefault();
		
	});	


	function call_paging_item(paged)
	{
	
		if(paged!=1)
		{
			var clear_all = document.getElementById('paging_'+paged);
			google.maps.event.addDomListener(clear_all, 'click', clearClusters);
		}
		action = 'wedding_ajax_find_pins';
		category_type = jQuery('#category_type').val();
		capacity = jQuery('#capacity').val();
		city = jQuery('#city').val();
		min_price = jQuery('#min_price').val();
		max_price = jQuery('#max_price').val();
		jQuery('#item_results').html('<div class="mt60"><h1 class="text-center">Loading......</h1></div>');
		jQuery.ajax({
			type: 'POST',
			url: ajax_auth_object.ajaxurl,
			dataType: 'json',
			data: {
				'action': action,
				'category_type': category_type,
				'capacity': capacity,
				'min_price': min_price,
				'max_price': max_price,
				'city': city,
				'page_no':paged,
			},
			success: function (data) {
				var gmarkers = null;
				jQuery('#item_results').html(data.html_result); 			
				call_map(data.json_map,data.center_latitude,data.center_longitude);
				jQuery('#btn-search-on').show();
				console.log(data.json_map);
			}
		});	
	}

	// Perform AJAX change-password on form submit
	jQuery('#btn-todolist').on('click', function (e) {
		
        if (!jQuery("#form-todolist").valid()) return false;
        jQuery('#form-todolist .status', this).show().text(ajax_auth_object.loadingmessage);
		action = 'wedding_ajax_todolist';
		todotitle = jQuery('#form-todolist #todotitle').val();
		tododate = jQuery('#form-todolist #tododate').val();
		tododetail = jQuery('#form-todolist #tododetail').val();
		security = jQuery('#form-todolist #security').val();
		ctrl = jQuery("#form-todolist");
		
		jQuery.ajax({
            type: 'POST',
            url: ajax_auth_object.ajaxurl,
			dataType: 'json',
            data: {
                'action': action,
                'todotitle': todotitle,
                'tododate': tododate,
				'tododetail': tododetail,
                'security': security
            },
            success: function (data) {
				jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
				jQuery('#form-todolist .status').show();
				jQuery('#form-todolist .status').html('<div style="color:#3c763d;background-color:#dff0d8;padding:15px;margin-bottom:15px;">'+data.message+'</div>');
				document.location.href = data.todo_url;
            }
        });
        e.preventDefault();
    });	

	// Perform AJAX change-password on form submit
	jQuery('#edit-todolist').on('click', function (e) {
		
        if (!jQuery("#form-edit-todolist").valid()) return false;
        jQuery('#form-edit-todolist .status', this).show().text(ajax_auth_object.loadingmessage);
		action = 'wedding_ajax_edit_todolist';
		todotitle = jQuery('#form-edit-todolist #todotitle').val();
		tododate = jQuery('#form-edit-todolist #tododate').val();
		tododetail = jQuery('#form-edit-todolist #tododetail').val();
		todoid = jQuery('#form-edit-todolist #todoid').val();
		security = jQuery('#form-edit-todolist #security').val();
		ctrl = jQuery("#form-edit-todolist");
		
		jQuery.ajax({
            type: 'POST',
            url: ajax_auth_object.ajaxurl,
			dataType: 'json',
            data: {
                'action': action,
                'todotitle': todotitle,
                'tododate': tododate,
				'tododetail': tododetail,
				'todoid': todoid,
                'security': security
            },
            success: function (data) {
				jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
				jQuery('#form-edit-todolist .status').show();
				jQuery('#form-edit-todolist .status').html('<div style="color:#3c763d;background-color:#dff0d8;padding:15px;margin-bottom:15px;">'+data.message+'</div>');
				document.location.href = data.todo_url;
				
            }
        });
        e.preventDefault();
    });		

	// Perform AJAX change-password on form submit
	jQuery('#btn-budget-list').on('click', function (e) {
		
        if (!jQuery("#form-budget").valid()) return false;
        jQuery('#form-budget .status', this).show().text(ajax_auth_object.loadingmessage);
		action = 'wedding_ajax_budget';
		budget_category = jQuery('#form-budget #budget_category').val();
		security = jQuery('#form-budget #security').val();
		ctrl = jQuery("#form-budget");
		
		jQuery.ajax({
            type: 'POST',
            url: ajax_auth_object.ajaxurl,
			dataType: 'json',
            data: {
                'action': action,
                'budget_category': budget_category,
                'security': security
            },
            success: function (data) {
				jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
				jQuery('#form-budget .status').show();
				jQuery('#form-budget .status').html('<div style="color:#3c763d;background-color:#dff0d8;padding:15px;margin-bottom:15px;">'+data.message+'</div>');
				document.location.href = data.budget_url;
            }
        });
        e.preventDefault();
    });		


	// Perform AJAX change-password on form submit
	jQuery('#edit-budget-list').on('click', function (e) {
		
        if (!jQuery("#form-edit-budget").valid()) return false;
        jQuery('#form-edit-budget .status', this).show().text(ajax_auth_object.loadingmessage);
		action = 'wedding_ajax_edit_budget';
		budget_category = jQuery('#form-edit-budget #budget_category').val();
		category_id = jQuery('#form-edit-budget #category_id').val();
		security = jQuery('#form-edit-budget #security').val();
		ctrl = jQuery("#form-edit-budget");
		
		jQuery.ajax({
            type: 'POST',
            url: ajax_auth_object.ajaxurl,
			dataType: 'json',
            data: {
                'action': action,
                'budget_category': budget_category,
				'category_id': category_id,
                'security': security
            },
            success: function (data) {
				jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
				jQuery('#form-edit-budget .status').show();
				jQuery('#form-edit-budget .status').html('<div style="color:#3c763d;background-color:#dff0d8;padding:15px;margin-bottom:15px;">'+data.message+'</div>');
				document.location.href = data.budget_url;				
            }
        });
        e.preventDefault();
    });		


	function simple_paging_item(paged)
	{
		action = 'wedding_ajax_main_filter';
		category_type = jQuery('#category_type').val();
		capacity = jQuery('#capacity').val();
		city = jQuery('#city').val();
		min_price = jQuery('#min_price').val();
		max_price = jQuery('#max_price').val();
		list_style = jQuery('#list_style').val();
		
		jQuery('#item_results').html('<div class="mt60"><h1 class="text-center">Loading......</h1></div>');
		jQuery.ajax({
			type: 'POST',
			url: ajax_auth_object.ajaxurl,
			dataType: 'json',
			data: {
				'action': action,
				'category_type': category_type,
				'capacity': capacity,
				'min_price': min_price,
				'max_price': max_price,
				'city': city,
				'list_style': list_style,
				'page_no':paged,
			},
			success: function (data) {
				jQuery('#item_results').html(data.html_result); 			
				jQuery('#leftsidebar-search').show();
			}
		});	
	}

	function add_wishlist(itemid)
	{
		action = 'wedding_ajax_add_wishlist';
		jQuery.ajax({
			type: 'POST',
			url: ajax_auth_object.ajaxurl,
			dataType: 'json',
			data: {
				'action': action,
				'itemid':itemid,
			},
			success: function (data) {
				jQuery('#fav_'+itemid).html('<a class="fav-icon" href="javascript:void(0);" onclick=remove_wishlist('+itemid+')><i class="fa fa-close"></i></a>');
			}
		});					
	}
	
	function remove_wishlist(itemid)
	{
		action = 'wedding_ajax_remove_wishlist';
		jQuery.ajax({
			type: 'POST',
			url: ajax_auth_object.ajaxurl,
			dataType: 'json',
			data: {
				'action': action,
				'itemid':itemid,
			},
			success: function (data) {
				jQuery('#fav_'+itemid).html('<a class="fav-icon" href="javascript:void(0);" onclick=add_wishlist('+itemid+')><i class="fa fa-heart"></i></a>');
			}
		});					
	}	

	function read_todolist(itemid)
	{
		action = 'wedding_ajax_read_todolist';
		jQuery.ajax({
			type: 'POST',
			url: ajax_auth_object.ajaxurl,
			dataType: 'json',
			data: {
				'action': action,
				'itemid':itemid,
			},
			success: function (data) {
				jQuery('#todolist_'+itemid).html('<a class="btn-circle read-todo" href="javascript:void(0);" onclick=unread_todolist('+itemid+')><i class="fa fa-circle"></i></a>');         document.location.href = data.todo_url;
			}
		});					
	}	

	function unread_todolist(itemid)
	{
		action = 'wedding_ajax_unread_todolist';
		jQuery.ajax({
			type: 'POST',
			url: ajax_auth_object.ajaxurl,
			dataType: 'json',
			data: {
				'action': action,
				'itemid':itemid,
			},
			success: function (data) {
				jQuery('#todolist_'+itemid).html('<a class="btn-circle unread-todo" href="javascript:void(0);" onclick=read_todolist('+itemid+')><i class="fa fa-circle"></i></a>');         document.location.href = data.todo_url;
			}
		});					
	}	
	
	function delete_todolist(itemid)
	{
		var strconfirm = confirm("Are you sure you want to delete todolist?");
		if (strconfirm == true)
		{		
			action = 'wedding_ajax_delete_todolist';
			jQuery.ajax({
				type: 'POST',
				url: ajax_auth_object.ajaxurl,
				dataType: 'json',
				data: {
					'action': action,
					'itemid':itemid,
				},
				success: function (data) {
					document.location.href = data.todo_url;
				}
			});					
		}
	}		

	function delete_budget_list(itemid)
	{
		var strconfirm = confirm("Are you sure you want to delete budget list?");
		if (strconfirm == true)
		{		
			action = 'wedding_ajax_delete_budget_list';
			jQuery.ajax({
				type: 'POST',
				url: ajax_auth_object.ajaxurl,
				dataType: 'json',
				data: {
					'action': action,
					'itemid':itemid,
				},
				success: function (data) {
					document.location.href = data.budget_url;
				}
			});					
		}
	}

	function delete_budget(itemid)
	{
		var strconfirm = confirm("Are you sure you want to delete category?");
		if (strconfirm == true)
		{		
			action = 'wedding_ajax_delete_budget';
			jQuery.ajax({
				type: 'POST',
				url: ajax_auth_object.ajaxurl,
				dataType: 'json',
				data: {
					'action': action,
					'itemid':itemid,
				},
				success: function (data) {
					document.location.href = data.budget_url;
				}
			});					
		}
	}			

	function add_budget_list_row(id)
	{
		var now = new Date;
		var timestamp = now.getUTCDate()+''+now.getUTCHours()+''+now.getUTCMinutes()+''+now.getUTCSeconds()+''+now.getUTCMilliseconds();

		var add_row = '<tr id="'+timestamp+'"><th scope="row"><input type="text" placeholder="Enter Item" class="form-control input-md" id="'+timestamp+'row_input_item" ></th><td><input type="text" placeholder="Estimate" class="form-control input-md" id="'+timestamp+'row_input_estimate"  ></td><td><input type="text" placeholder="Actual" class="form-control input-md" id="'+timestamp+'row_input_actual" ></td><td><input type="text" placeholder="Paid" class="form-control input-md"  id="'+timestamp+'row_input_paid"></td><td></td><td id="'+timestamp+'row_save_action"><a href="javascript:void(0);" class="btn-edit" onclick="insert_budget_list_row('+timestamp+','+id+')"><i class="fa fa-save"></i></a></td></tr>';
		jQuery('#'+id+'_add_row').append(add_row);
	}

	function insert_budget_list_row(itemid,category)
	{
		var item_name		=	jQuery("#"+itemid+"row_input_item").val();
		var item_estimate	=	jQuery("#"+itemid+"row_input_estimate").val();
		var item_actual		=	jQuery("#"+itemid+"row_input_actual").val();
		var item_paid		=	jQuery("#"+itemid+"row_input_paid").val();
		
		if(!jQuery.isNumeric(item_estimate))
		{
			alert("Please enter Estimated value as Interger");
		}
		else if(!jQuery.isNumeric(item_actual))
		{
			alert("Please enter Actual Paid value as Interger");
		}
		else if(!jQuery.isNumeric(item_paid))
		{
			alert("Please enter Paid value as Interger");
		}
		else{
			action = 'wedding_ajax_insert_budget_list';
			jQuery.ajax({
				type: 'POST',
				url: ajax_auth_object.ajaxurl,
				dataType: 'json',
				data: {
					'action': action,
					'item_name':item_name,
					'item_estimate':item_estimate,
					'item_actual':item_actual,
					'item_paid':item_paid,
					'item_category':category,
				},
				success: function (data) {
					jQuery("#"+itemid+"row_save_action").html('<strong>Saved</strong>');
				}
			});	
		}
	}

	function sub_budget_edit(itemid)
	{

		var budget_name_val=jQuery("#"+itemid+"_sub_add_row .budget_name").text();
		jQuery("#"+itemid+"_sub_add_row .budget_name").html('<input placeholder="Name" class="form-control input-md" id="sub_name_'+itemid+'" type="text" value="'+budget_name_val+'">')

		var budget_estimate_val=jQuery("#"+itemid+"_sub_add_row .budget_estimate").text();
		jQuery("#"+itemid+"_sub_add_row .budget_estimate").html('<input placeholder="Estimate" class="form-control input-md" id="sub_estimate_'+itemid+'" type="text" value="'+budget_estimate_val+'">')
		
		var budget_cost_val=jQuery("#"+itemid+"_sub_add_row .budget_cost").text();
		jQuery("#"+itemid+"_sub_add_row .budget_cost").html('<input placeholder="Cost" class="form-control input-md" id="sub_cost_'+itemid+'" type="text" value="'+budget_cost_val+'">')

		var budget_paid_val=jQuery("#"+itemid+"_sub_add_row .budget_paid").text();
		jQuery("#"+itemid+"_sub_add_row .budget_paid").html('<input placeholder="Paid" class="form-control input-md" id="sub_paid_'+itemid+'" type="text" value="'+budget_paid_val+'">')	
		
		
		jQuery("#"+itemid+"_sub_add_row .action_perform").html('<a href="javascript:void(0);" onclick="sub_budget_list_edit('+itemid+')" class="btn-edit"><i class="fa fa-save"></i></a>')				
		
	}
	
	function sub_budget_list_edit(itemid)
	{
		var item_name		=	jQuery("#sub_name_"+itemid).val();
		var item_estimate	=	jQuery("#sub_estimate_"+itemid).val();
		var item_actual		=	jQuery("#sub_cost_"+itemid).val();
		var item_paid		=	jQuery("#sub_paid_"+itemid).val();

		if(!jQuery.isNumeric(item_estimate))
		{
			alert("Please enter Estimated value as Interger");
		}
		else if(!jQuery.isNumeric(item_actual))
		{
			alert("Please enter Actual Paid value as Interger");
		}
		else if(!jQuery.isNumeric(item_paid))
		{
			alert("Please enter Paid value as Interger");
		}
		else{
			action = 'wedding_ajax_edit_budget_list';
			jQuery.ajax({
				type: 'POST',
				url: ajax_auth_object.ajaxurl,
				dataType: 'json',
				data: {
					'action': action,
					'item_name':item_name,
					'item_estimate':item_estimate,
					'item_actual':item_actual,
					'item_paid':item_paid,
					'itemid':itemid,
				},
				success: function (data) {
					jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
					jQuery('#form-budget .status').show();
					jQuery('#form-budget .status').html(data.message);
					document.location.href = data.budget_list_url;
				}
			});	
		}				
	}
	

	// Perform AJAX Based Search
	jQuery('#leftsidebar-search').on('click', function (e) {	
		jQuery('#leftsidebar-search').hide();
		simple_paging_item(1);
		e.preventDefault();
		
	});	

	if(jQuery(window).width()>769){
		// Sticky Header
		jQuery(window).load(function(){
			"use strict";
		  jQuery("#headersticky").sticky({ topSpacing: 0 });
		});
	}
	
	jQuery('#select_forgot_pass').on('click', function (e) {
		jQuery("#home").hide();
		jQuery(".forgotpass_box").show();
	});
	jQuery('#return_login').on('click', function (e) {
		jQuery(".forgotpass_box").hide();
		jQuery("#home").show();
	
	});

	jQuery('#payment_box').validate();
	jQuery('form#payment_box').on('submit', function (e) {
		if (!$(this).valid()) return false;
		pay_package = jQuery('#payment_box #pay_package').val();
				
		if(pay_package=="")
		{
			alert("Please select package");
			return false;
		}
		else{
			
		jQuery('.status', this).show().text(ajax_auth_object.loadingmessage);
		action = 'wedding_ajax_credit_card_payment';
		card_no = jQuery('#payment_box #card_no').val();
		card_type = jQuery('#payment_box #card_type').val();
		card_expired_month = jQuery('#payment_box #expired_month').val();
		card_expired_year = jQuery('#payment_box #expired_year').val();
		card_cvv = jQuery('#payment_box #card_cvv').val();
		card_full_name = jQuery('#payment_box #full_name').val();
		card_address = jQuery('#payment_box #address').val();
		card_city = jQuery('#payment_box #city').val();
		card_state = jQuery('#payment_box #state').val();
		card_zip = jQuery('#payment_box #zip').val();
		
		security = jQuery('#payment_box #security').val();
	
		jQuery.ajax({
            type: 'POST',
            url: ajax_auth_object.ajaxurl,
            data: {
                'action': action,
                'card_no': card_no,
				'card_type': card_type,
				'card_expired_month': card_expired_month,
				'card_expired_year': card_expired_year,
				'card_cvv': card_cvv,
				'card_full_name': card_full_name,
				'card_address': card_address,
				'card_city': card_city,
				'card_state': card_state,								
                'card_zip': card_zip,
				'pay_package': pay_package,
				'security': security,
            },
            success: function (data) {
				jQuery('#card_payment').remove();
				jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
				jQuery('.status').show();
				jQuery('.status').html(data);
            }
        });
        e.preventDefault();
		}
    });	

	jQuery('#paypal_pack').on('click', function (e) {
        
		pay_package = jQuery('#pay_package').val();
				
		if(pay_package=="")
		{
			alert("Please select package");
			return false;
		}
		else{
			
		jQuery('.status', this).show().text(ajax_auth_object.loadingmessage);
		action = 'wedding_ajax_paypal_payment';
		
		security = jQuery('#security').val();
	
		jQuery.ajax({
            type: 'POST',
            url: ajax_auth_object.ajaxurl,
            data: {
                'action': action,
				'pay_package': pay_package,
				'security': security,
            },
            success: function (data) {
				//alert(data)				
				jQuery('#paypal_pack').after(data);			
				//jQuery('#card_payment').remove();
				//jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
				//jQuery('.status').show();
				//jQuery('.status').html(data);				
				
            }
        });
        e.preventDefault();
		}
    });		


  //jQuery to collapse the navbar on scroll
jQuery(window).scroll(function() {

	if(jQuery('.navbar-fixed-top').hasClass('header-v2'))
	{
		if (jQuery(".header-v2").offset().top > 50) {
			jQuery(".navbar-fixed-top").addClass("top-nav-collapse");
		} else {
			jQuery(".navbar-fixed-top").removeClass("top-nav-collapse");
		}
	}
});

jQuery("#cssmenu").menumaker({
	title: "Menu",
	format: "multitoggle"
});



function pricing(package)
{
	var package_val=jQuery('#pay_package').val();
	if(package_val=='')
	{
		jQuery('#payment_option_box').slideDown();
	}	

	jQuery('.pricing-btn').removeClass('tp-btn-primary');
	jQuery('#pricing_'+package).addClass('tp-btn-primary');	
	jQuery('#pay_package').val(package);
}