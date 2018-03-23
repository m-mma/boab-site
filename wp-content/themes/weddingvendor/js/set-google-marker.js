var geocoder;
var map;
var marker;

if(zoom_level!="")
{
	var zomm=zoom_level;
	var center_latitude=center_lati;
	var center_longitude=center_long; 
}
else
{
	var zomm=6;
	var center_latitude=51.751724;
	var center_longitude=-1.255284; 
}
 

// initialise the google maps objects, and add listeners
function gmaps_init(){
	var latlng = new google.maps.LatLng(center_latitude,center_longitude);
	var total_zomm=zomm;
	
	var options = {
	zoom: total_zomm,
	center: latlng,
	zoomControl: true,
	mapTypeId: google.maps.MapTypeId.ROADMAP
	};


  // create our map object
  map = new google.maps.Map(document.getElementById("gmaps-canvas"), options);

  // the geocoder object allows us to do latlng lookup based on address
  geocoder = new google.maps.Geocoder();

  // the marker shows us the position of the latest address
  marker = new google.maps.Marker({
    map: map,
    draggable: true
  });
 
  marker.setPosition( latlng );

  // event triggered when marker is dragged and dropped
  google.maps.event.addListener(marker, 'dragend', function() {
    geocode_lookup( 'latLng', marker.getPosition() );
  });

  // event triggered when map is clicked
  google.maps.event.addListener(map, 'click', function(event) {
    marker.setPosition(event.latLng)
    geocode_lookup( 'latLng', event.latLng  );
  });

  jQuery('#gmaps-error').hide();
}

// move the marker to a new position, and center the map on it
function update_map( geometry ) {
  map.fitBounds( geometry.viewport )
  marker.setPosition( geometry.location )
}

// fill in the UI elements with new position data
function update_ui( address, latLng ) {
  jQuery('#gmaps-input-address').autocomplete("close");
  jQuery('#gmaps-input-address').val(address);
  jQuery('#gmaps-output-latitude').val(latLng.lat());
  jQuery('#gmaps-output-longitude').val(latLng.lng());
}

// Query the Google geocode object
//
// type: 'address' for search by address
//       'latLng'  for search by latLng (reverse lookup)
//
// value: search query
//
// update: should we update the map (center map and position marker)?
function geocode_lookup( type, value, update ) {
  // default value: update = false
  update = typeof update !== 'undefined' ? update : false;

  request = {};
  request[type] = value;

  geocoder.geocode(request, function(results, status) {
    jQuery('#gmaps-error').html('');
    jQuery('#gmaps-error').hide();
    if (status == google.maps.GeocoderStatus.OK) {
      // Google geocoding has succeeded!
      if (results[0]) {
        // Always update the UI elements with new location data
        update_ui( results[0].formatted_address,
                   results[0].geometry.location )

        // Only update the map (position marker and center map) if requested
        if( update ) { update_map( results[0].geometry ) }
      } else {
        // Geocoder status ok but no results!?
        jQuery('#gmaps-error').html("Sorry, something went wrong. Try again!");
        jQuery('#gmaps-error').show();
      }
    } else {
      // Google Geocoding has failed. Two common reasons:
      //   * Address not recognised (e.g. search for 'zxxzcxczxcx')
      //   * Location doesn't map to address (e.g. click in middle of Atlantic)

      if( type == 'address' ) {
        // User has typed in an address which we can't geocode to a location
        jQuery('#gmaps-error').html("Sorry! We couldn't find " + value + ". Try a different search term, or click the map." );
        jQuery('#gmaps-error').show();
      } else {
        // User has clicked or dragged marker to somewhere that Google can't do a reverse lookup for
        // In this case we display a warning, clear the address box, but fill in LatLng
        jQuery('#gmaps-error').html("Woah... that's pretty remote! You're going to have to manually enter a place name." );
        jQuery('#gmaps-error').show();
        update_ui('', value)
      }
    };
  });
};

// initialise the jqueryUI autocomplete element
function autocomplete_init() {
  jQuery("#gmaps-input-address").autocomplete({

    // source is the list of input options shown in the autocomplete dropdown.
    // see documentation: http://jqueryui.com/demos/autocomplete/
    source: function(request,response) {

      // the geocode method takes an address or LatLng to search for
      // and a callback function which should process the results into
      // a format accepted by jqueryUI autocomplete
      geocoder.geocode( {'address': request.term }, function(results, status) {
        response(jQuery.map(results, function(item) {
          return {
            label: item.formatted_address, // appears in dropdown box
            value: item.formatted_address, // inserted into input element when selected
            geocode: item                  // all geocode data: used in select callback event
          }
        }));
      })
    },

    // event triggered when drop-down option selected
    select: function(event,ui){
      update_ui(  ui.item.value, ui.item.geocode.geometry.location )
      update_map( ui.item.geocode.geometry )
    }
  });

  // triggered when user presses a key in the address box
  jQuery("#gmaps-input-address").bind('keydown', function(event) {
    if(event.keyCode == 13) {
      geocode_lookup( 'address', jQuery('#gmaps-input-address').val(), true );

      // ensures dropdown disappears when enter is pressed
      jQuery('#gmaps-input-address').autocomplete("disable")
    } else {
      // re-enable if previously disabled above
      jQuery('#gmaps-input-address').autocomplete("enable")
    }
  });
}; // autocomplete_init

jQuery(document).ready(function() { 
  if( jQuery('#gmaps-canvas').length  ) {
    gmaps_init();
    autocomplete_init();
  }; 
});
