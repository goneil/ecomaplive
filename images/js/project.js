$(document).ready(function() {
    $(".button").click(function(){
        if ($(this).find("a").size() > 0){
            window.location = $(this).find("a").attr("href");
        }
        return false;
    });
    $("#search-box").liveUpdate("#search-content").focus();
    $(":button").button();
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

    var deleteFunc = function(){
        var form = $('<form>');
        form.attr('name', 'delete');
        form.attr('method', 'POST');
        form.css('display', 'hidden');
        var submit = $("<input name='delete' type='submit'/>");
        form.append(submit);
        submit.click();
    }


jQuery.fn.liveUpdate = function(list){
  list = jQuery(list);
 
  if ( list.length ) {
    var rows = list.children('li'),
      cache = rows.map(function(){
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
