$(document).ready(function() {
    $(".button").click(function(){
        if ($(this).find("a").size() > 0){
            window.location = $(this).find("a").attr("href");
        }
        return false;
    });
    $("#delete").click(deleteFunc);
});

var deleteFunc = function(){
    console.log("delete");
    var link = $("#delete");
    var linkHref = link.attr("loc");
    var div = $("<div>");
    var btnYes = $("<button class='btn'>").text("Yes");
    var btnNo = $("<button class='btn'>").text("No");

    btnYes.click(function(){window.location.href = linkHref;});
    btnNo.click(function(){div.hide();});

    div.text("Are you sure you want to delete this project?");
    div.append(btnYes);
    div.append(btnNo);

    link.after(div);
};

var addMap = function(){
    var form = $('<form>');
    form.attr('name', 'delete');
    form.attr('method', 'GET');
    form.css('display', 'hidden');
    var submit = $("<input name='addMap' type='submit'/>");
    var backHref = $("#back").text();
    var backHrefInput = $("<input name='backHref' type='text'/>");
    backHrefInput.attr("value", backHref);
    form.append(submit);
    submit.click();
};

var addPlot = function(){
    var form = $('<form>');
    form.attr('name', 'delete');
    form.attr('method', 'GET');
    form.css('display', 'hidden');
    var submit = $("<input name='addPlot' type='submit'/>");
    form.append(submit);
    submit.click();
};
