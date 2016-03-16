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


    //past winners filters show/hide
    $('.show-more').click(function(){
        if (open == false){
            $(this).html('More &raquo;');
            open = true;
        } else {
            $(this).html('Less &raquo;');
            open = false;
        }
        $('.years').toggleClass('open');


        return false;
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
    var id;

    $('.menu-item-has-children > a').each(function(){
        id = $(this).parent().attr('id');
        menu_item = $(this).html();
        $(this).html(menu_item+'</a><a href="#"><span class="nav-item-controller closed" id="sub-'+id+'"><i class="fa fa-plus-circle"></i></span>');
    });

    $('.nav-item-controller').click(function(){
        var pid = $(this).attr('id');
        var nid = pid.replace("sub-","");
        $('#'+nid+' .sub-menu').slideToggle();
        if($(this).hasClass('closed')){
            $(this).removeClass('closed').addClass('open').html('<i class="fa fa-minus-circle"></i>');
        }else{
            $(this).removeClass('open').addClass('closed').html('<i class="fa fa-plus-circle"></i>');
        }
    });

    $('.mobile-menu-trigger').click(function(){
        $('.mobile-menu-wrap').slideToggle();
    });

    //mobile search
    $('.mobile-search-icon').click(function(){
        $('.mobile-menu-wrap .search-form').submit(); 
    });

    //slider
    $('.bxslider').bxSlider({
        auto: true,
        autoHover: true,
        pause: 8000,
        pager: false,
        prevText: '',
        nextText: '',
        adaptiveHeight: true
    });

    //pager
    $('.display-page-action').click(function(event){
        event.preventDefault();
        //show the page
        var page = $(this).attr('data-page');
        $('.pager').slideUp();
        $('.page-'+page).slideDown();
        //update pager nav to active
        $('.pagination .current').removeClass('current');
        //$(this).parent().addClass('current');
        $('.page-control-'+page).addClass('current');
        //slide to the top
        var target = this.hash;
        var $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 900, 'swing', function () {
            window.location.hash = target;
        });
    });

    //back to top button
    $('.back-to-top-button').click(function(){
        var $target = $('body');
        $('html, body').stop().animate({
                'scrollTop': $target.offset().top
        }, 900, 'swing',function(){
            $('.back-to-top-button').fadeOut();
        });
    });

    $(window).scroll(function(){
        var t = $(window).scrollTop()
        if(t < 10){
            $('.back-to-top-button').fadeOut();
        }else{
            $('.back-to-top-button').fadeIn();
        }
    });

    //Search
    $('.search-form-trigger').click(function(){
        $('.search-form-wrap').toggleClass('open-search');
    });
});
