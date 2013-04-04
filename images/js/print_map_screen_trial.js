var mapPoints = [];
function initialize() {
    centerLat = minLatLng.lat + (maxLatLng.lat - minLatLng.lat)/2;
    centerLng = minLatLng.lng + (maxLatLng.lng - minLatLng.lng)/2;
    // create map
    var mapOptions = {
      center: new google.maps.LatLng(centerLat, centerLng),
      //zoom: 15,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    // not var b/c I want it to be public
    map = new google.maps.Map(
        document.getElementById("map"),
        mapOptions);

    

    update_map(locations, minLatLng, maxLatLng);
}
google.maps.event.addDomListener(window, 'load', initialize);

var animateMap = function(){
};

var update_map = function(locations, minLatLng, maxLatLng){
    if (!minLatLng || !maxLatLng){
        var minLat = Math.min.apply(Math, locations.map(function(v){return v[0];}));
        var maxLat = Math.max.apply(Math, locations.map(function(v){return v[0];}));
        var minLng = Math.min.apply(Math, locations.map(function(v){return v[1];}));
        var maxLng = Math.max.apply(Math, locations.map(function(v){return v[1];}));
        minLatLng = new google.maps.LatLng(minLat, minLng);
        maxLatLng = new google.maps.LatLng(maxLat, maxLng);
    }
    // set bounds for the map
    bounds = new google.maps.LatLngBounds();
    bounds.extend(minLatLng);
    bounds.extend(maxLatLng);
    map.fitBounds(bounds);

    // place points on map
    // locations is an array with following structure:
    // [ [lat, lng, radius, value, id, time], ... ]

    for (var i = 0; i < locations.length; i ++){
        var latLng = new google.maps.LatLng(locations[i][0], locations[i][1]);
        //var value = parseInt((locations[i][3])/((max+1))*255, 10);
        //var color = "#" + d2h(255 - value)  + d2h(value) + "00";
        var color = "rgb(" + h[clamp(parseInt(locations[i][3] * h.length, 10), 0, h.length - 1)] + ")";
        circle = new google.maps.Circle({
            'center': latLng,
            'clickable':false,
            'fillColor': color, //decimalToRGB(1.0 - locations[i][3]),
            'fillOpacity':0.7,
            'map':map,
            'radius':locations[i][2]/2,
            'strokeColor':'#0000A0',
            'strokeOpacity':'0.0'
        });
        circle.time = locations[i][5];
        mapPoints.push(circle);
    }

    var minTime = Math.min.apply(Math, mapPoints.map(function(v){return v.time;}));
    var maxTime = Math.max.apply(Math, mapPoints.map(function(v){return v.time;}));

    if (maxTime > minTime){
        var timeStep = (maxTime - minTime)/5;

        $("#play").button({icons: {primary:"ui-icon-play"}});
        $("#pause").button({icons: {primary:"ui-icon-pause"}});
        $("#slideshow").append('<div>Time Range: <input id="amount"/><div>');
        $("#slider").slider({
            range: true,
            values: [minTime, maxTime],
            min: minTime,
            max: maxTime,
            create:function(){
                $("#amount").val(minTime + " - " + maxTime);
            },
            slide: function(event, ui){
                for (var i = 0; i < mapPoints.length; i ++){
                    if (mapPoints[i].time >= ui.values[0] && mapPoints[i].time <= ui.values[1]){
                        mapPoints[i].setMap(map);
                    }else{
                        mapPoints[i].setMap(null);
                    }
                }
                $("#amount").val(ui.values[0] + " - " + ui.values[1]);
            }
        });
    }



};



var clamp = function(num, min, max){
    if (num < min){ return min; }
    if (num  > max){ return max; }
    return num;
};

var d2h = function d2h(d) {return d.toString(16);};
var h2d = function h2d(h) {return parseInt(h,16);};


// inpu tdec = number from 0 to 1
var decimalToRGB = function(dec){
    var max = h2d("9400D3");
    var min = h2d("8B0000");
    var scalingFactor = max - min;
    return "#" + d2h(min + parseInt(dec * scalingFactor, 10));
};
//define the colours from 0 to 100
var h = [];
//BLUEST
h.push( '0,0,255');
h.push( '0,1,255');
h.push( '0,2,255');
h.push( '0,4,255');
h.push( '0,5,255');
h.push( '0,7,255');
h.push( '0,9,255');
h.push( '0,11,255');
h.push( '0,13,255');
h.push( '0,15,255');
h.push( '0,18,253');
h.push( '0,21,251');
h.push( '0,24,250');
h.push( '0,27,248');
h.push( '0,30,245');
h.push( '0,34,243');
h.push( '0,37,240');
h.push( '0,41,237');
h.push( '0,45,234');
h.push( '0,49,230');
h.push( '0,53,226');
h.push( '0,57,222');
h.push( '0,62,218');
h.push( '0,67,214');
h.push( '0,71,209');
h.push( '0,76,204');
h.push( '0,82,199');
h.push( '0,87,193');
h.push( '0,93,188');
h.push( '0,98,182');
h.push( '0,104,175');
h.push( '0,110,169');
h.push( '0,116,162');
h.push( '7,123,155');
h.push( '21,129,148');
h.push( '34,136,141');
h.push( '47,142,133');
h.push( '60,149,125');
h.push( '71,157,117');
h.push( '83,164,109');
h.push( '93,171,100');
h.push( '104,179,91');
h.push( '113,187,92');
h.push( '123,195,73');
h.push( '132,203,63');
h.push( '140,211,53');
h.push( '148,220,43');
h.push( '156,228,33');
h.push( '163,237,22');
h.push( '170,246,11');
h.push( '176,255,0');
h.push( '183,248,0');
h.push( '188,241,0');
h.push( '194,234,0');
h.push( '199,227,0');
h.push( '204,220,0');
h.push( '209,214,0');
h.push( '213,207,0');
h.push( '217,200,0');
h.push( '221,194,0');
h.push( '224,188,0');
h.push( '227,181,0');
h.push( '230,175,0');
h.push( '233,169,0');
h.push( '236,163,0');
h.push( '238,157,0');
h.push( '240,151,0');
h.push( '243,145,0');
h.push( '244,140,0');
h.push( '246,134,0');
h.push( '248,129,0');
h.push( '249,123,0');
h.push( '250,118,0');
h.push( '251,112,0');
h.push( '252,107,0');
h.push( '253,102,0');
h.push( '254,97,0');
h.push( '255,92,0');
h.push( '255,87,0');
h.push( '255,82,0');
h.push( '255,78,0');
h.push( '255,73,0');
h.push( '255,68,0');
h.push( '255,64,0');
h.push( '255,59,0');
h.push( '255,55,0');
h.push( '255,51,0');
h.push( '255,47,0');
h.push( '255,43,0');
h.push( '255,39,0');
h.push( '255,35,0');
h.push( '255,31,0');
h.push( '255,27,0');
h.push( '255,23,0');
h.push( '255,20,0');
h.push( '255,16,0');
h.push( '255,13,0');
h.push( '255,10,0');
h.push( '255,8,0');
h.push( '255,3,0');
