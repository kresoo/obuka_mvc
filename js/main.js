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
    
    $('li a').mouseover(function(){
        $(this).css('color','#2CB7F2').css('font-size','18px');
    }).mouseout(function(){
        $(this).css('color','#ABABAB').css('font-size','16px');
    });
    
    $('input').focus(function(){
        $(this).css('border','2px solid #2CB7F2');
    }).blur(function(){
        $(this).css('border','1px solid #2CB7F2');
    });
    $('#search_string').html("Enter <span style=\"color:#2CB7F2\">  Order ID</span>");
    $('.searchRadio').click(function(){
        var search_string = $(this).attr('search_string');
        $('#search_string').html("Enter <span style=\"color:#2CB7F2\">" + search_string + "</span>");
    });
    
    $('input').focus(function(){
        $(this).css('-moz-box-shadow','0px 0px 5px #8BD7F7').css('-webkit-box-shadow','0px 0px 5px #8BD7F7').css('box-shadow','0px 0px 5px #8BD7F7')
    }).blur(function(){
        $(this).css('-moz-box-shadow','none').css('-webkit-box-shadow','none').css('box-shadow','none')
    });
});

