$(document).ready(function() {
    $("#search-box").liveUpdate("#search-content").focus();
    $("#back-button").button({
        icons:{
            primary: "ui-icon-triangle-1-w"
        }
    });

    $("#add").button({
        icons:{
            primary: "ui-icon-plusthick"
        }
    });

    $("#add-plot").button({
        icons:{
            primary: "ui-icon-plusthick"
        }
    });

    $("#search-button").button({
        icons:{
            primary: "ui-icon-search"
        }
    });

    $("#settings").button({
        icons:{
            primary: "ui-icon-gear"
        }
    });
});
