/**
 * This file should contain frontend JavaScript that 
 * will be applied to individual module instances.
 *
 * You have access to three constiables in this file: 
 * 
 * $module An instance of your module class.
 * $id The module's ID.
 * $settings The module's settings.
 *
 * MMGoogleMap: 
 */

(function($){
  var js_locations = [
    <?php
    foreach($settings->mm_google_map_locations as $location){
      echo '["'.esc_html($location->location_name).'", '.esc_html($location->location_lon).', '.esc_html($location->location_lat).'],';
    }
    ?>
  ];

  function setMarkers(map, infowindow) {
    const latlngbounds = new google.maps.LatLngBounds();

    for (let i = 0; i < js_locations.length; i++) {
      const js_location = js_locations[i];

      const marker = new google.maps.Marker({
        position: { lat: js_location[1], lng: js_location[2] },
        map: map,
      });

      marker.addListener("click", () => {
        infowindow.setContent(js_location[0]);
        infowindow.open({
          anchor: marker,
          map,
          shouldFocus: false,
        });
      });

      if(js_locations.length > 1){
        const latlng = new google.maps.LatLng(js_location[1], js_location[2]);
        latlngbounds.extend(latlng);
        map.fitBounds(latlngbounds);
      }
    }
  }

  function initMap() {
    const map = new google.maps.Map(document.querySelector('.fl-node-<?php echo $id; ?> .mm-google-map'),{
      center: { lat: js_locations[0][1], lng: js_locations[0][2] },
      zoom: 12,
    });

    const infowindow = new google.maps.InfoWindow({
      content: '',
    });

    setMarkers(map, infowindow);
  }

  window.initMap = initMap;

  <?php
  if ( !empty($settings->google_maps_api_key_field)) {
    ?>

    var script = document.getElementById("mm_google_map_api_js");

    if(null == script){
      script = document.createElement('script');
      script.src = 'https://maps.googleapis.com/maps/api/js?key=<?php echo $settings->google_maps_api_key_field;?>&callback=initMap&v=weekly';
      script.async = true;
      script.setAttribute('id', 'mm_google_map_api_js');
      document.body.appendChild(script);
    }

    $( '.fl-builder-content' ).on( 'fl-builder.preview-rendered', initMap );
    $( '.fl-builder-content' ).on( 'fl-builder.layout-rendered', initMap );

    <?php
  }
  ?>
})(jQuery);