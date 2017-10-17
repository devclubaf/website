$(document).ready(function(){
    $(".alert").alert();
    // scripts for overlay window
    $('#trigger-overlay-contact').on('click', function(){
        $('#overlay-contact').toggleClass('open');
        $('.content').toggleClass('overlay-open');
    });
    $('#trigger-overlay-feedback').on('click', function(){
        $('#overlay-feedback').toggleClass('open');
        $('.content').toggleClass('overlay-open');
    });
    $('.overlay-close').on('click', function(){
        $(this).parent().toggleClass('open');
        $('.content').toggleClass('overlay-open');
    });
});

var markers = [];
function initMap() {
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        center: new google.maps.LatLng(34.299, 66.5175319),
        zoom: 7,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        styles:mapStyle // it is in map-style.js
    };
    map = new google.maps.Map(document.getElementById("map"), mapOptions);
    $.ajax({
        type:'get',
        url:'/registered/users',
        success:function(locations){
            for (var i = 0; i < locations.length; i++) {
                var location= locations[i].location.split(',');
                myLatLng = new google.maps.LatLng(location[0] , location[1]);
                var marker = new google.maps.Marker({
                    map: map,
                    position: myLatLng,
                    optimized:false,
                    url:locations[i].html_url,
                    title:locations[i].nickname,
                    icon: {
                        url: locations[i].avatar, // url
                        scaledSize: new google.maps.Size(50, 50), // scaled size
                        origin: new google.maps.Point(0,0), // origin
                        anchor: new google.maps.Point(10, 0) // anchor
                    }
                });
                marker.setMap(map);
                markers.push(marker);
                google.maps.event.addListener(marker, 'click', function() {
                    window.open(this.url, '_blank');
                });
                bounds.extend(markers[i].getPosition());
            } // end of for loop
            map.fitBounds(bounds);
            addMarkerCluster();
        }
    });
    inputSearch();
}

function inputSearch(){
    // Create the search box and link it to the UI element.
    var input = document.getElementById('find-location');
    var searchBox = new google.maps.places.SearchBox(input);
    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
    });
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();
        if (places.length == 0) {
            return;
        }
        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function(place) {
            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });
}

function addMarkerCluster(){
    var markerCluster = new MarkerClusterer(map, markers, {
        imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m',
        maxZoom: 18
    });
}
