jQuery(document).ready(function($){

  //navbar

    if ($(this).scrollTop()>($('#information').offset().top-200) && $(this).scrollTop()<($('#skills').offset().top-200)){
      $('.navbar-default .navbar-nav>li.active').removeClass('active');
      $('.navbar-default .navbar-nav>li:nth-child(2)').addClass('active');
    }
    else if($(this).scrollTop()>($('#skills').offset().top-200) && $(this).scrollTop()<($('#undertaking').offset().top-200)){
      $('.navbar-default .navbar-nav>li.active').removeClass('active');
      $('.navbar-default .navbar-nav>li:nth-child(3)').addClass('active');
    }
    else if($(this).scrollTop()>($('#undertaking').offset().top-200) && $(this).scrollTop()<($('#news').offset().top-200)){
      $('.navbar-default .navbar-nav>li.active').removeClass('active');
      $('.navbar-default .navbar-nav>li:nth-child(4)').addClass('active');
    }
    else if($(this).scrollTop()>($('#news').offset().top-200) && $(this).scrollTop()<($('#devis').offset().top-200)){
      $('.navbar-default .navbar-nav>li.active').removeClass('active');
      $('.navbar-default .navbar-nav>li:nth-child(5)').addClass('active');
    }
    else if($(this).scrollTop()>($('#devis').offset().top-200) && $(this).scrollTop()<($('#contact').offset().top-200)){
      $('.navbar-default .navbar-nav>li.active').removeClass('active');
      $('.navbar-default .navbar-nav>li:nth-child(6)').addClass('active');
    }
    else if($(this).scrollTop()>($('#contact').offset().top-200)){
      $('.navbar-default .navbar-nav>li.active').removeClass('active');
      $('.navbar-default .navbar-nav>li:nth-child(7)').addClass('active');
    }
    else{
      $('.navbar-default .navbar-nav>li.active').removeClass('active');
    }
    $(window).scroll(function(){
      if ($(this).scrollTop()>($('#information').offset().top-200) && $(this).scrollTop()<($('#skills').offset().top-200)){
        $('.navbar-default .navbar-nav>li.active').removeClass('active');
        $('.navbar-default .navbar-nav>li:nth-child(2)').addClass('active');
      }
      else if($(this).scrollTop()>($('#skills').offset().top-200) && $(this).scrollTop()<($('#undertaking').offset().top-200)){
        $('.navbar-default .navbar-nav>li.active').removeClass('active');
        $('.navbar-default .navbar-nav>li:nth-child(3)').addClass('active');
      }
      else if($(this).scrollTop()>($('#undertaking').offset().top-200) && $(this).scrollTop()<($('#news').offset().top-200)){
        $('.navbar-default .navbar-nav>li.active').removeClass('active');
        $('.navbar-default .navbar-nav>li:nth-child(4)').addClass('active');
      }
      else if($(this).scrollTop()>($('#news').offset().top-200) && $(this).scrollTop()<($('#devis').offset().top-200)){
        $('.navbar-default .navbar-nav>li.active').removeClass('active');
        $('.navbar-default .navbar-nav>li:nth-child(5)').addClass('active');
      }
      else if($(this).scrollTop()>($('#devis').offset().top-200) && $(this).scrollTop()<($('#contact').offset().top-200)){
        $('.navbar-default .navbar-nav>li.active').removeClass('active');
        $('.navbar-default .navbar-nav>li:nth-child(6)').addClass('active');
      }
      else if($(this).scrollTop()>($('#contact').offset().top-200)){
        $('.navbar-default .navbar-nav>li.active').removeClass('active');
        $('.navbar-default .navbar-nav>li:nth-child(7)').addClass('active');
      }
      else{
        $('.navbar-default .navbar-nav>li.active').removeClass('active');
      }
    });

  //skills

    $('.skills>.skills-container>.skills-titles>div').on('click', function(e) {
      $('.skills>.skills-container>.skills-titles>div.active').removeClass('active');
      $(this).addClass('active');
      $(".skills>.skills-container>.skills-descriptions>div.active").removeClass('active');
      $('.skills>.skills-container>.skills-descriptions>div>h4:contains('+$(this).children('h4').text()+')').parent().addClass('active');
    });

});