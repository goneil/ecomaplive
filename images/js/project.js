$(document).ready(function() {
    $(".button").click(function(){
        window.location = $(this).find("a").attr("href");
        return false;
    });
    $("#search-box").liveUpdate("#search-content").focus();
    $("#add").button({
        icons:{
            primary: "ui-icon-locked"
        }
    });

});

jQuery.fn.liveUpdate = function(list){
  list = jQuery(list);
 
  if ( list.length ) {
    var rows = list.children('li'),
      cache = rows.map(function(){
        console.log(this);
        return this.id.toLowerCase();
      });
     
    this
      .keyup(filter).keyup()
      .parents('form').submit(function(){
        return false;
      });
  }
   
  return this;
   
  function filter(){
    var term = jQuery.trim( jQuery(this).val().toLowerCase() ), scores = [];
   
    if ( !term ) {
      rows.show();
    } else {
      rows.hide();
 
      cache.each(function(i){
        var score = this.score(term);
        if (score > 0) { scores.push([score, i]); }
      });
 
      jQuery.each(scores.sort(function(a, b){return b[0] - a[0];}), function(){
        jQuery(rows[ this[1] ]).show();
      });
    }
  }
};
