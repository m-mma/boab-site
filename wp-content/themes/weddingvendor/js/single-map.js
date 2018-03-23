(function($) {
    "use strict";

    google.maps.event.addDomListener(window, 'load', init);

    var map;
	var maploaded=false;

    function init() {
        var mapOptions = {
            center: new google.maps.LatLng(center_point.lat, center_point.lng),
            zoom: 15,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.DEFAULT,
            },
            panControl: true,
            disableDoubleClickZoom: false,
            mapTypeControl: false,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            },
            scaleControl: true,
            scrollwheel: false,
            streetViewControl: false,
            draggable : true,
            overviewMapControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: []
        }

        var mapElement = document.getElementById('googleMap');
        map = new google.maps.Map(mapElement, mapOptions);

        var locations = [['', center_point.lat, center_point.lng]];

        for (var i = 0; i < locations.length; i++) {
            new google.maps.Marker({
                icon: center_point.marker,
                animation: google.maps.Animation.BOUNCE,
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });
        }
    }

	// Tabbled style google map displa on map click
	jQuery('a[href=#onmap]').bind('click',function() {
		
			if(!maploaded)
			{
			setTimeout(function(){  
					init();  
					google.maps.event.trigger(map, 'resize');},1000);		
				maploaded = true;
			}		
		});			
	
})(jQuery)