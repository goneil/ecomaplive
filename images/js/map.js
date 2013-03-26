$(document).ready(function() {
    // jsPoints is array of arrays
    // [0] : lat        can ignore
    // [1] : lng        can ignore
    // [2] : radius     can ignore
    // [3] : value
    // [4] : ID         can ignore
    // [5] : time
    
    var plotValues = []
    for (var i = 0; i < jsPoints.length; i ++){
        var x = jsPoints[i][5];
        var y = jsPoints[i][3]
        console.log("(" + x + ", " + y + ")");
        plotValues.push([x, y]);
    }

    $.jqplot('plot', [plotValues], {title: 'The Dependence of Value on Time',
                                  series: [{color: '#5FAB78'}]
                                 }
    );

    console.log(plotValues);
    //$.jqplot('plot',  [[[1, 2],[3,5.12],[5,13.1],[7,33.6],[9,85.9],[11,219.9]]],
    //{ title:'Exponential Line',
      //axes:{yaxis:{min:-10, max:240}},
        //series:[{color:'#5FAB78'}]
        //});
    $("#plot-screen").hide();

    
    $("#map-switch").click(function(){
        if ($(this).text() == "Show Plot"){
            $(this).button('option', 'label', 'Show Map');
            // Also should show plot
            // could do this by hiding map and showing plot
            $("#map-screen").hide();
            $("#plot-screen").show();
        } else{
            $(this).button('option', 'label', 'Show Plot');
            // Also should show map
            // could do this by hiding plot and showing map
            $("#plot-screen").hide();
            $("#map-screen").show();
        }
    });
});
