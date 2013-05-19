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
    originalPlotValues = []; // purposely public
    plotValues = [];         // purposely public
    for (var i = 0; i < jsPoints.length; i ++){
        var x = jsPoints[i][5];
        var y = jsPoints[i][3];
        if (x !== undefined && y !== undefined){
            originalPlotValues.push([x, y]);
            plotValues.push([x, y]);
        }
    }

    drawPlot();

    $("#btnAbsolute").click(function(){
        $("#normalizedInput").hide();
    });

    $("#btnNormalized").click(function(){
        $("#normalizedInput").show();
    });

    $("#btnRefresh").click(function(){
        console.log("refresh clicked");
        if ($("#btnAbsolute").hasClass("active")){
            absoluteData();
        } else{
            var min = parseFloat($("#normMin").val());
            var max = parseFloat($("#normMax").val());
            normalizeData(min, max);
        }
        drawPlot();
    });
    $(document).keypress(function(e){
        if (e.which == 13){
            $("#btnRefresh").click();
        }
    });
});

var normalizeData = function(min, max){
    plotValues = [];
    for (var i = 0; i < originalPlotValues.length; i ++){
        if (originalPlotValues[i][1] < min){
            plotValues.push([originalPlotValues[i][0], min]);
        } else if (originalPlotValues[i][1] > max){
            plotValues.push([originalPlotValues[i][0], max]);
        } else{
            plotValues.push(originalPlotValues[i]);
        }
    }
};

var absoluteData = function(){
    plotValues = originalPlotValues;
};

var drawPlot = function(){
    $("#plot").empty();
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
};
