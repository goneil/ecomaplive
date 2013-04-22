$(document).ready(function() {

    $.jqplot.config.enablePlutings = true;
    $.jsDate.config.defaultCentury = 2000;

    // jsPoints is array of arrays
    // [0] : lat        can ignore
    // [1] : lng        can ignore
    // [2] : radius     can ignore
    // [3] : value
    // [4] : ID         can ignore
    // [5] : time
    var plotValues = [];
    for (var i = 0; i < jsPoints.length; i ++){
        var x = jsPoints[i][5];
        var y = jsPoints[i][3];
        if (x !== undefined && y !== undefined){
            plotValues.push([x, y]);
        }
    }

    $.jqplot('plot', [plotValues], {
        title: "The Dependence of Value on Time",
        axes: {
            xaxis: {
                renderer: $.jqplot.DateAxisRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    formatString: '%m-%d-%Y %H:%M:%S',
                    angle: -60
                }
            }
        }
    });

    $("#plot-screen").hide();
    $("#plot-title").hide();

    $("#map-switch").click(function(){
        if ($(this).text() == "Show Plot"){
            $(this).text("Show Map");
            // Also should show plot
            // could do this by hiding map and showing plot
            $("#map-screen").hide();
            $("#map-title").hide();
            $("#plot-screen").show();
            $("#plot-title").show();
        } else{
            $(this).text("Show Plot");
            // Also should show map
            // could do this by hiding plot and showing map
            $("#plot-screen").hide();
            $("#plot-title").hide();
            $("#map-screen").show();
            $("#map-title").show();
        }
    });
});
