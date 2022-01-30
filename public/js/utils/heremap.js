$(document).ready(function () {

    var oldLat = <?= isset($lat) ? $lat : 'null' ?>;
    var oldLang = <?= isset($lang) ? $lang : 'null' ?>;

    var lat = oldLat;
    var lng = oldLang;

    if (!oldLang)
        lng = 116.525116;
    if (!oldLat)
        lat = -8.504970

    var data = initMap(oldLat, oldLang);
    setUpClickListener(data.map);

})

function initMap(lat = null, lang = null) {

    var apikey = 'H6XyiCT0w1t9GgTjqhRXxDMrVj9h78ya3NuxlwM7XUs';
    var platform = new H.service.Platform({
        apikey: apikey
    });
    var defaultLayers = platform.createDefaultLayers();

    //Step 2: initialize a map
    var map = new H.Map(document.getElementById('map'),
        defaultLayers.vector.normal.map, {
        center: { lat: 30.94625288456589, lng: -54.10861860580418 },
        zoom: 1,
        pixelRatio: window.devicePixelRatio || 1
    });
    // add a resize listener to make sure that the map occupies the whole container
    window.addEventListener('resize', () => map.getViewPort().resize());

    //Step 3: make the map interactive
    // MapEvents enables the event system
    // Behavior implements default interactions for pan/zoom (also on mobile touch environments)
    var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

    return { map: map, behavior: behavior };
}

/**
* An event listener is added to listen to tap events on the map.
* Clicking on the map displays an alert box containing the latitude and longitude
* of the location pressed.
* @param  {H.Map} map      A HERE Map instance within the application
*/
function setUpClickListener(map) {
    // Attach an event listener to map display
    // obtain the coordinates and display in an alert box.
    map.addEventListener('tap', function (evt) {
        var coord = map.screenToGeo(evt.currentPointer.viewportX,
            evt.currentPointer.viewportY);

        console.log(coord.lat, coord.lng);
    });
}