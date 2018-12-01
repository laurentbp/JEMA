jQuery(document).ready(function($){

  //navbar

    if ($(this).scrollTop()>($('#information').offset().top-200) && $(this).scrollTop()<($('#faq').offset().top-200)){
      $('.navbar-default .navbar-nav>li.active').removeClass('active');
      $('.navbar-default .navbar-nav>li:nth-child(2)').addClass('active');
    }
    else if($(this).scrollTop()>($('#faq').offset().top-200) && $(this).scrollTop()<($('#member').offset().top-200)){
      $('.navbar-default .navbar-nav>li.active').removeClass('active');
      $('.navbar-default .navbar-nav>li:nth-child(3)').addClass('active');
    }
    else if($(this).scrollTop()>($('#member').offset().top-200) && $(this).scrollTop()<($('#news').offset().top-200)){
      $('.navbar-default .navbar-nav>li.active').removeClass('active');
      $('.navbar-default .navbar-nav>li:nth-child(4)').addClass('active');
    }
    else if($(this).scrollTop()>($('#news').offset().top-200) && $(this).scrollTop()<($('#contact').offset().top-200)){
      $('.navbar-default .navbar-nav>li.active').removeClass('active');
      $('.navbar-default .navbar-nav>li:nth-child(5)').addClass('active');
    }
    else if($(this).scrollTop()>($('#contact').offset().top-200)){
      $('.navbar-default .navbar-nav>li.active').removeClass('active');
      $('.navbar-default .navbar-nav>li:nth-child(6)').addClass('active');
    }
    else{
      $('.navbar-default .navbar-nav>li.active').removeClass('active');
    }
    $(window).scroll(function(){
      if ($(this).scrollTop()>($('#information').offset().top-200) && $(this).scrollTop()<($('#faq').offset().top-200)){
        $('.navbar-default .navbar-nav>li.active').removeClass('active');
        $('.navbar-default .navbar-nav>li:nth-child(2)').addClass('active');
      }
      else if($(this).scrollTop()>($('#faq').offset().top-200) && $(this).scrollTop()<($('#member').offset().top-200)){
        $('.navbar-default .navbar-nav>li.active').removeClass('active');
        $('.navbar-default .navbar-nav>li:nth-child(3)').addClass('active');
      }
      else if($(this).scrollTop()>($('#member').offset().top-200) && $(this).scrollTop()<($('#news').offset().top-200)){
        $('.navbar-default .navbar-nav>li.active').removeClass('active');
        $('.navbar-default .navbar-nav>li:nth-child(4)').addClass('active');
      }
      else if($(this).scrollTop()>($('#news').offset().top-200) && $(this).scrollTop()<($('#contact').offset().top-200)){
        $('.navbar-default .navbar-nav>li.active').removeClass('active');
        $('.navbar-default .navbar-nav>li:nth-child(5)').addClass('active');
      }
      else if($(this).scrollTop()>($('#contact').offset().top-200)){
        $('.navbar-default .navbar-nav>li.active').removeClass('active');
        $('.navbar-default .navbar-nav>li:nth-child(6)').addClass('active');
      }
      else{
        $('.navbar-default .navbar-nav>li.active').removeClass('active');
      }
    });

  //faq

    $('.faq>.content>h4').on('click', function(e) {
      $(this).next('p').slideToggle();
    });

});