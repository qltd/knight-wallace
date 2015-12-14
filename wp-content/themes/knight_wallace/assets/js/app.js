// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

$(document).ready(function(){
    
    $('#main_nav .primary').hover(function(){
        //on mouse in
        var menu = $(this).attr('data-sub-nav-menu');
        $('.sub-nav-wrap ul').addClass('disappear');
        $('.sub-nav-wrap .'+menu).removeClass('disappear');
    },function(){
        //on mouse out
        var menu = $('#main_nav .primary.active').attr('data-sub-nav-menu');
        $('.sub-nav-wrap ul').addClass('disappear');
        $('.sub-nav-wrap .'+menu).removeClass('disappear');
    });

});
