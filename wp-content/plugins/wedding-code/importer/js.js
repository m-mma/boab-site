jQuery(document).ready(function($){
	$('.btn_import').click(function(){
	   var comf = confirm ('WARNING: Importing data is recommended on fresh installs only once. Importing on sites with content or importing twice will duplicate menus, pages and all posts.');
	   if(comf == true){
			$('.console_iport').show().html('Working ... <br><img class="loding_import" src="images/wpspin_light.gif">');
			function start_loop_import(url){
				$.ajax({
						url: url,
						type: "POST",
						data: { 
							  },
						dataType: "json",
						beforeSend: function() {
							   
						}
				}).done(function( html ) {
					                       console.log(html);
										   if(html){
											  if(html.status == "ok"){ 
											    $('.loding_import').remove();
										        $('.console_iport').append(html.messenger);
												$('.console_iport').append('<img class="loding_import" src="images/wpspin_light.gif">')
											  }
											  if(html.next_url != ""){
												  start_loop_import(html.next_url) ;
											  }else{
												  $('.loding_import').remove();
											  }
										   }
			                             });
			}
			// start fist
			start_loop_import( $(this).attr('data_url') );
	   }
	});
});