// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

$(document).ready(function(){

    //grab original active menu
    var active_menu = $('.primary.active').attr('data-sub-nav-menu');

    $('#main_nav .primary').hover(function(){
        //on mouse in
        var menu = $(this).attr('data-sub-nav-menu');
        $('#main_nav .primary').removeClass('active'); 
        $(this).addClass('active');
        $('.sub-nav-wrap ul').addClass('disappear');
        $('.sub-nav-wrap .'+menu).removeClass('disappear');
    },function(){
        //on mouse out
        var menu = $('#main_nav .primary.active').attr('data-sub-nav-menu');
        $('.sub-nav-wrap ul').addClass('disappear');
        $('.sub-nav-wrap .'+menu).removeClass('disappear');
    });
    
    $('#main_nav').hover(function(){
        //on mouse in 
    },function(){
        //on mouse out 
        $('#main_nav .primary').removeClass('active'); 
        $('#main_nav .primary.'+active_menu).addClass('active');
        $('.sub-nav-wrap ul').addClass('disappear');
        $('.sub-nav-wrap .'+active_menu).removeClass('disappear');
    });

    //ajax request for past winners
    $('.la-past-winner-control-form-action').click(function(){
        var year = [];
        var award = [];
        $('input[name="year"]').each(function(){
            if($(this).is(":checked")){
                year.push($(this).val());
            } 
        });
        $('input[name="award"]').each(function(){
            if($(this).is(":checked")){
                award.push($(this).val()); 
            }
        });
        $.ajax({
            url: '/wp-content/themes/knight_wallace/ajax.php', 
            type: 'GET',
            data: {action: 'past_winners',year: year, award: award},
            beforeSend: function(){
                $(".winners-list").html('<p class="center-text"><img src="/wp-content/themes/knight_wallace/assets/images/load.gif" /></p>');
            },
            success: function(res){
                $(".winners-list").html(res);
            },
            error: function(){
                $(".winners-list").html('<p class="alert-box alert">Sorry, we were not able to do that right now</p>');
            }
        });  
    });

    //mobile menu
    var menu_item;
    $('.menu-item-has-children > a').each(function(){
        menu_item = $(this).html();
        $(this).html(menu_item+'</a><a href="#"><span class="nav-item-controller"><i class="fa fa-plus-circle"></i></span>');
    });

});
