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
});
