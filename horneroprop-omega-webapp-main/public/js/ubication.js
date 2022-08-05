var geocoder;
var actualPosition = null;
function initialize() {
    $(function () {
        geocoder = new google.maps.Geocoder();
        var inputs = ['subsidiaryAddress', 'userAddress', 'peopleAddress', 'propertyAddress'];
        inputs.forEach(function(data) {
            var input = document.getElementById(data);

            if (!input)
                return;
            var options = {
                componentRestrictions: {country: 'ar'}
            };
            var searchBox = new google.maps.places.Autocomplete(input, options);
            // Listener para detectar un cambio de lugar
            searchBox.addListener('places_changed', function () {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Completo el marcador
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function (place) {
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };

                    actualPosition = place.geometry.location;

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
            });
        });

    });
}
