$(document).ready(function() {
    $('#price_range').hide();
    var search_input = $('#search_input');
    var priceRadio = $('#price');
    var otherRadio = $('input[type=radio]').not(priceRadio);
    
    priceRadio.click(function() {
        $('#price_range').show();
        search_input.hide();
    });
    
    otherRadio.click(function() {
        $('#price_range').hide();
        search_input.show();
    });

    
    $('input').focus(function(){
        $(this).css('border','2px solid #2CB7F2');
    }).blur(function(){
        $(this).css('border','1px solid #2CB7F2');
    });
    $('#search_string').html("<h4>Enter <span style=\"color:#2CB7F2\">  Order ID</span></h4>");
    $('.searchRadio').click(function(){
        var search_string = $(this).attr('search_string');
        $('#search_string').html("<h4> Enter <span style=\"color:#2CB7F2\">" + search_string + "</span></h4>");
    });
    
    $('input').focus(function(){
        $(this).css('-moz-box-shadow','0px 0px 5px #8BD7F7').css('-webkit-box-shadow','0px 0px 5px #8BD7F7').css('box-shadow','0px 0px 5px #8BD7F7')
    }).blur(function(){
        $(this).css('-moz-box-shadow','none').css('-webkit-box-shadow','none').css('box-shadow','none')
    });
    
    //initial nav item select
    if($.cookie("activePage")){
        page = $.cookie("activePage");
        $.cookie("activePage", null);
        $('li[page=' + page + ']').addClass("active");
    }

    //add class to clicked nav item
    $('.nav li').click(function(){
        var thisLi = $(this);
        var otherLi = $('.nav li').not(thisLi);
        thisLi.addClass("active");
        otherLi.removeClass("active");
        var page = thisLi.attr('page');
        $.cookie("activePage",page);
    });
});

