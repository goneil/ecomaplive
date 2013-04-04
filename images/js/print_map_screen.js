// This file included the javascript for creating the google map screen
// location, bounds and max must be set prior to using this file
// currently, these parameters are set in functions.inc.php (as of 4/2/2013)

var map;

function d2h(d) {
    hex = d.toString(16);
    if (d < 10) hex = "0" + hex;
    return hex;
}

function initialize() {
    //Creates the map
    map = new GMap2(document.getElementById("map"),{mapTypes:[G_NORMAL_MAP,G_HYBRID_MAP, G_SATELLITE_MAP, G_PHYSICAL_MAP]});
    //Finds the zoom level to show all points
    var zoom = map.getBoundsZoomLevel(bounds)-1;
    //Repositions to center of all points
    map.setCenter(bounds.getCenter(), zoom);
    map.enableContinuousZoom();
    map.enableScrollWheelZoom();
    //add gui stuff
    map.addControl(new GLargeMapControl());
    map.addControl(new GMapTypeControl());
    map.addControl(new GScaleControl());
    
    var min = 0;
    var colors = "";
    //plot all the points
    for (i = 0;i < locations.length; i++) {
        //drawCircle(map, new GLatLng(locations[i][0],locations[i][1]), 360, locations[i][2], locations[i][3]);
        var value = parseInt((locations[i][3])/((max+1))*255, 10);
        var color = "#" + d2h(value) + "00" + d2h(255-value);
        colors = colors + " " + color;
        map.addOverlay(new BDCCCircle(new GLatLng(locations[i][0],locations[i][1]), locations[i][2]/1600,color,0.00000001,0.0000001,true,color,new Array(0.001,value)));
    }
    //document.write(colors);
}

$(document).ready(function(){
    initialize();
});
