<div id="markers" data-markers = '{{ $markers }}' class="livewire-map" style="position: relative; height: 600px; width: 600px; margin: 0; padding: 0">

    <div id="map" wire:ignore
         style="height: 100%; width: 100%; margin: 0; padding: 0"></div>
</div>

<script
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"
    defer>
</script>
<div>
<script>
    var map;
    var markers;
    var markersArray =[];
    // The following example creates complex markers to indicate beaches near
    // Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
    // to the base of the flagpole.
    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 3,
            center: { lat: {{ $firstLat }}, lng: {{ $firstLng }} },
        });
        setMarkers(map);
        google.maps.event.addListener(map, 'click', function(event) {
            Livewire.emit('setLat',  event.latLng.lat())
            Livewire.emit('setLng',  event.latLng.lng())
        });
    }
    function setMarkers(map) {
        markers = JSON.parse(document.getElementById("markers").getAttribute('data-markers'));
        // Adds markers to the map.
        // Marker sizes are expressed as a Size of X,Y where the origin of the image
        // (0,0) is located in the top left of the image.
        // Origins, anchor positions and coordinates of the marker increase in the X
        // direction to the right and in the Y direction down.
        const image = {
            url: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
            // This marker is 20 pixels wide by 32 pixels high.
            size: new google.maps.Size(20, 32),
            // The origin for this image is (0, 0).
            origin: new google.maps.Point(0, 0),
            // The anchor for this image is the base of the flagpole at (0, 32).
            anchor: new google.maps.Point(0, 32),
        };
        // Shapes define the clickable region of the icon. The type defines an HTML
        // <area> element 'poly' which traces out a polygon as a series of X,Y points.
        // The final coordinate closes the poly by connecting to the first coordinate.


        markers.forEach((i) => {
            let position = new google.maps.Marker({
                position: { lat: Number.parseFloat(i.lat), lng: Number.parseFloat(i.lng) },
                map,
            });
            markersArray.push(position);
        })
    }
    function deleteM()
    {
        for (var i = 0; i < markersArray.length; i++) {
            markersArray[i].setMap(null);
        }
        markersArray = [];
    }
    document.addEventListener('livewire:load', function () {
        window.initMap = initMap;
    })
</script>
</div>
