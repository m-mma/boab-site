		
		// global "map" variable
		var map = null;

		// marker cluster variable
		var markerclusterer = null;

		var myOptions = {
			disableAutoPan: true
			,maxWidth: 0
			,pixelOffset: new google.maps.Size(-135,-45)
			,zIndex: null
			,boxStyle: { 
			  width: "260px"
			  ,height: "auto"
			  ,background: "#fff"
			 }
			,closeBoxMargin: "0px 0px 0px 0px"
			,closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif"
			,infoBoxClearance: new google.maps.Size(1, 1)
			,isHidden: false
			,pane: "floatPane"
			,boxClass: "marketbox"
			,alignBottom:true
			,enableEventPropagation: true
		};

		// define infowindow
		var infowindow = new InfoBox(myOptions);

		// arrays to hold copies of the markers
		var gmarkers = []; 

		// -----------------------------------------------------------------------
		// A function to create the marker and set up the event window function 
		// -----------------------------------------------------------------------
		function createMarker(latlng, info,market_icon) {


		var imageUrl = market_icon;
		var markerImage = new google.maps.MarkerImage(imageUrl);
			
			var marker = new google.maps.Marker({
				position: latlng,
				'icon': markerImage				
			});

			google.maps.event.addListener(marker, 'click', function() {
				infowindow.setContent(info); 
				infowindow.open(map,marker);
				});

			// save the info (not used here)
			gmarkers.push(marker);
		}
		 
		// -----------------------------------------------------------------------
		// This function picks up the click and opens the corresponding info window
		// -----------------------------------------------------------------------
		/*function myclick(i) {
		  google.maps.event.trigger(gmarkers[i], "click");
		}*/


		function initialize()
		{
			var myOptions = {
				zoom: 8,
				center: new google.maps.LatLng(center_point_lati,center_point_long),
				mapTypeControl: true,
				navigationControl: true,
				scrollwheel: false,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			
			map = new google.maps.Map(document.getElementById("map"), myOptions);
			google.maps.event.addListener(map, 'click', function() {
				infowindow.close();
			});
			  
			  
			// define array of locations
			
			// extract data and  create markers
			for (var i = 0; i < markers.length; i++) {
			  var point = new google.maps.LatLng( markers[i].latitude,  markers[i].longitude);
			  var marker = createMarker( point, "<div class='main_box'><h3>"+ markers[i].title + "</h3><div class='marker_box'><a href='"+markers[i].url+"'><img src='"+markers[i].featured_img + "' class='map_img' /></a><a href='"+markers[i].cat_url+"' class='label-primary'>"+markers[i].cat_name+"</a></div><h4 class='marker_pricing'>"+ markers[i].price +"</h4><p><i class='fa fa-map-marker'></i>  "+markers[i].address+"</p> </div>",markers[i].marker);  
			  
			}				

			mcOptions = {styles: [{
				height: 50,
				url: clustor,
				width: 50,
				textColor: '#FFF',
				textSize: 12
				}
			]}				
				
			// create a Marker Clusterer that clusters markers
			markerCluster = new MarkerClusterer(map, gmarkers,mcOptions);

        	var clear = document.getElementById('btn-search-on');
        	google.maps.event.addDomListener(clear, 'click', clearClusters);	
		}

		function call_map(data,center_latitude,center_longitude)
		{	
			var markers_total = JSON.parse(data);
	
			if(center_latitude!="" && center_latitude!="")
			{
				var myOptions = {
						zoom: 8,
						center: new google.maps.LatLng(center_latitude,center_longitude),
						mapTypeControl: true,
						navigationControl: true,
						scrollwheel: false,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					}
			}
			else{
				var myOptions = {
						zoom: 8,
						center: new google.maps.LatLng(23.95,72.215),
						mapTypeControl: true,
						navigationControl: true,
						scrollwheel: false,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					}
				
			}
			
			map = new google.maps.Map(document.getElementById("map"), myOptions);
			google.maps.event.addListener(map, 'click', function() {
				infowindow.close();
			});
			  
			// define array of locations
			
			// extract data and  create markers
			for (var i = 0; i < markers_total.length; i++) {
			  var point = new google.maps.LatLng( markers_total[i].latitude,  markers_total[i].longitude);

			  var marker = createMarker( point, "<div class='main_box'><h3>"+ markers_total[i].title + "</h3><div class='marker_box'><a href='"+markers_total[i].url+"' class='marker_box'><img src='"+markers_total[i].featured_img + "' class='map_img' /> </a><a href='"+markers_total[i].cat_url+"' class='label-primary'>"+markers_total[i].cat_name+"</a></div> <h4 class='marker_pricing'>"+ markers_total[i].price +"</h4><p><i class='fa fa-map-marker'></i>  "+markers_total[i].address+"</p> </div>",markers_total[i].marker) ;
			}

			mcOptions = {styles: [{
			height: 50,
			url: clustor,
			width: 50,
			textColor: '#FFF',
			textSize: 12
			}
			]}				
				
			// create a Marker Clusterer that clusters markers
			markerCluster = new MarkerClusterer(map, gmarkers,mcOptions);
		}

		function clearClusters(e) {
			e.preventDefault();
			e.stopPropagation();
			markerCluster.clearMarkers();
			gmarkers=[];
		}		