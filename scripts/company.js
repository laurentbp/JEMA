jQuery(document).ready(function($){
  $(function () {
    /*$('#branding').hover(
      function() {
          $(this).children('img').css({'box-shadow':'0px 3px 6px -4px #080808'});
          $(this).children('img').animate({'height':'80px'},200);
      },
      function() {
          $(this).children('img').css({'box-shadow':'0px 5px 9px -5px #080808'});
          $(this).children('img').animate({'height':'90px'},100);
    });*/
    $(window).resize(function () {
       if (checkSize()!=0.3 && checkSize()!=0.4) {
        $('.nav-main-link').on('mouseenter.large', function () {
              $(this).children('span').stop().css({'top':'-5px'});
              $(this).children('a').stop().css({'color':'white'});
              $(this).children('a').stop().css({'padding-top':'10px'});
          }).on('mouseleave.large', function () {
              $(this).children('span').stop().css({'top':'-50px'});
              $(this).children('a').stop().css({'color':'#777'});
              $(this).children('a').stop().css({'padding-top':'15px'});
        });
       } else {
           $('.nav-main-link').off('mouseenter.large mouseleave.large');
       }
    }).resize();
    $('#social-nav').hover(
      function() {
          $('#social-nav div:nth-child(2)').stop().css({"webkit-transform":"translateX(-40px)"});
          $('#social-nav div:nth-child(3)').stop().css({"webkit-transform":"translateX(-80px)"});
          $('#social-nav div:nth-child(4)').stop().css({"webkit-transform":"translateX(-120px)"});
      },
      function() {
          $('#social-nav div:nth-child(2)').stop().css({"webkit-transform":"translateX(0px)"});
          $('#social-nav div:nth-child(3)').stop().css({"webkit-transform":"translateX(0px)"});
          $('#social-nav div:nth-child(4)').stop().css({"webkit-transform":"translateX(0px)"});
    });
    $('.student-redirection').hover(
      function() {
          $(this).stop().css({'border':'10px solid white'});
          $(this).children().children('p').css({'opacity':'1'});
          $(this).children().children('.big-glyphicon').css({'animation':'float 2s ease-in-out infinite'});
          $(".right-student").animate({'right':'30px'},200);
      },
      function() {
          $(this).stop().css({'border':'0px solid white'});
          $(this).children().children('p').css({'opacity':'0.2'});
          $(this).children().children('.big-glyphicon').css({'animation':'none'});
          $(".right-student").stop().animate({'right':'-50px'},200);
    });
    $('.company-redirection').hover(
      function() {
          $(this).stop().css({'border':'10px solid white'});
          $(this).children().children('p').css({'opacity':'1'});
          $(this).children().children('.big-glyphicon').css({'animation':'float 2s ease-in-out infinite'});
          $(".right-company").animate({'right':'30px'},200);
      },
      function() {
          $(this).stop().css({'border':'0px solid white'});
          $(this).children().children('p').css({'opacity':'0.2'});
          $(this).children().children('.big-glyphicon').css({'animation':'none'});
          $(".right-company").stop().animate({'right':'-50px'},200);
    });
  });
  $(function () {
    $('.scrollspy').on('click', function(e) {
      e.preventDefault();
      var hash = this.hash;
      $('html, body').animate({
        scrollTop: $(this.hash).offset().top-50
      }, 800);
    });
  });
  $(function () {
    if($(this).scrollTop()>($('#about').offset().top-100)){
      $('.anchor-top').fadeIn(200);
    }
    else{
      $('.anchor-top').fadeOut(200);
    }
    $(window).scroll(function(){
      if ($(this).scrollTop() > ($('#about').offset().top-100)) {
        $('.anchor-top').fadeIn(200);
      }
      else{
        $('.anchor-top').fadeOut(200);
      }
    });
  });
  $(window).resize(function () {
    if (checkSize()!=0.3 && checkSize()!=0.4) {
      if ($(this).scrollTop()>($('#about').offset().top-100) && $(this).scrollTop()<($('#faq').offset().top-100)){
        $('#nav-active-link').children('span').stop().animate({'top':'-50px'},50);
        $('#nav-active-link').children('a').stop().css({'color':'#777'});
        $('#nav-active-link').children('a').stop().css({'padding-top':'15px'});
        $('.nav-main-link').attr('id', '');
        $(".navbar-nav .nav-main-link:nth-child(1)").attr('id', 'nav-active-link');
      }
      else if ($(this).scrollTop()>($('#faq').offset().top-100) && $(this).scrollTop()<($('#member').offset().top-100)){
        $('#nav-active-link').children('span').stop().animate({'top':'-50px'},50);
        $('#nav-active-link').children('a').stop().css({'color':'#777'});
        $('#nav-active-link').children('a').stop().css({'padding-top':'15px'});
        $('.nav-main-link').attr('id', '');
        $(".navbar-nav .nav-main-link:nth-child(2)").attr('id', 'nav-active-link');
      }
      else if ($(this).scrollTop()>($('#member').offset().top-100) && $(this).scrollTop()<($('#devis').offset().top-100)){
        $('#nav-active-link').children('span').stop().animate({'top':'-50px'},50);
        $('#nav-active-link').children('a').stop().css({'color':'#777'});
        $('#nav-active-link').children('a').stop().css({'padding-top':'15px'});
        $('.nav-main-link').attr('id', '');
        $(".navbar-nav .nav-main-link:nth-child(3)").attr('id', 'nav-active-link');
      }
      else if ($(this).scrollTop()>($('#devis').offset().top-100) && $(this).scrollTop()<($('#news').offset().top-100)){
        $('#nav-active-link').children('span').stop().animate({'top':'-50px'},50);
        $('#nav-active-link').children('a').stop().css({'color':'#777'});
        $('#nav-active-link').children('a').stop().css({'padding-top':'15px'});
        $('.nav-main-link').attr('id', '');
        $(".navbar-nav .nav-main-link:nth-child(4)").attr('id', 'nav-active-link');
      }
      else if ($(this).scrollTop()>($('#news').offset().top-100) && $(this).scrollTop()<($('#contact').offset().top-100)){
        $('#nav-active-link').children('span').stop().animate({'top':'-50px'},50);
        $('#nav-active-link').children('a').stop().css({'color':'#777'});
        $('#nav-active-link').children('a').stop().css({'padding-top':'15px'});
        $('.nav-main-link').attr('id', '');
        $(".navbar-nav .nav-main-link:nth-child(5)").attr('id', 'nav-active-link');
      }
      else if ($(this).scrollTop()>($('#news').offset().top-100)){
        $('#nav-active-link').children('span').stop().animate({'top':'-50px'},50);
        $('#nav-active-link').children('a').stop().css({'color':'#777'});
        $('#nav-active-link').children('a').stop().css({'padding-top':'15px'});
        $('.nav-main-link').attr('id', '');
        $(".navbar-nav .nav-main-link:nth-child(6)").attr('id', 'nav-active-link');
      }
      $(window).scroll(function(){
        if ($(this).scrollTop() < ($('#about').offset().top-100)) {
          $('#nav-active-link').children('span').stop().animate({'top':'-50px'},50);
          $('#nav-active-link').children('a').stop().css({'color':'#777'});
          $('#nav-active-link').children('a').stop().css({'padding-top':'15px'});
          $('.nav-main-link').attr('id', '');
        }
        else if ($(this).scrollTop()>($('#about').offset().top-100) && $(this).scrollTop()<($('#faq').offset().top-100)) {
          $('#nav-active-link').children('span').stop().animate({'top':'-50px'},50);
          $('#nav-active-link').children('a').stop().css({'color':'#777'});
          $('#nav-active-link').children('a').stop().css({'padding-top':'15px'});
          $('.nav-main-link').attr('id', '');
          $(".navbar-nav .nav-main-link:nth-child(1)").attr('id', 'nav-active-link');
        }
        else if ($(this).scrollTop()>($('#faq').offset().top-100) && $(this).scrollTop()<($('#member').offset().top-100)) {
          $('#nav-active-link').children('span').stop().animate({'top':'-50px'},50);
          $('#nav-active-link').children('a').stop().css({'color':'#777'});
          $('#nav-active-link').children('a').stop().css({'padding-top':'15px'});
          $('.nav-main-link').attr('id', '');
          $(".navbar-nav .nav-main-link:nth-child(2)").attr('id', 'nav-active-link');
        }
        else if ($(this).scrollTop()>($('#member').offset().top-100) && $(this).scrollTop()<($('#devis').offset().top-100)){
          $('#nav-active-link').children('span').stop().animate({'top':'-50px'},50);
          $('#nav-active-link').children('a').stop().css({'color':'#777'});
          $('#nav-active-link').children('a').stop().css({'padding-top':'15px'});
          $('.nav-main-link').attr('id', '');
          $(".navbar-nav .nav-main-link:nth-child(3)").attr('id', 'nav-active-link');
        }
        else if ($(this).scrollTop()>($('#devis').offset().top-100) && $(this).scrollTop()<($('#news').offset().top-100)){
          $('#nav-active-link').children('span').stop().animate({'top':'-50px'},50);
          $('#nav-active-link').children('a').stop().css({'color':'#777'});
          $('#nav-active-link').children('a').stop().css({'padding-top':'15px'});
          $('.nav-main-link').attr('id', '');
          $(".navbar-nav .nav-main-link:nth-child(4)").attr('id', 'nav-active-link');
        }
        else if ($(this).scrollTop()>($('#news').offset().top-100) && $(this).scrollTop()<($('#contact').offset().top-100)){
          $('#nav-active-link').children('span').stop().animate({'top':'-50px'},50);
          $('#nav-active-link').children('a').stop().css({'color':'#777'});
          $('#nav-active-link').children('a').stop().css({'padding-top':'15px'});
          $('.nav-main-link').attr('id', '');
          $(".navbar-nav .nav-main-link:nth-child(5)").attr('id', 'nav-active-link');
        }
        else if ($(this).scrollTop()>($('#news').offset().top-100)){
          $('#nav-active-link').children('span').stop().animate({'top':'-50px'},50);
          $('#nav-active-link').children('a').stop().css({'color':'#777'});
          $('#nav-active-link').children('a').stop().css({'padding-top':'15px'});
          $('.nav-main-link').attr('id', '');
          $(".navbar-nav .nav-main-link:nth-child(6)").attr('id', 'nav-active-link');
        }
      });
    }
  }).resize();
  $(function () {
    if ($(this).scrollTop() > 1300){
      $(".mot").css({"opacity":"1"});
    }
    else{
      $(".mot").css({"opacity":"0"});
    }
    $(window).scroll(function(){
      if ($(this).scrollTop() > 1300) {
        $(".mot").css({"opacity":"1"});
        $(".mot").css({"webkit-transform":"translateY(0px)"});
      }
      else {
        $(".mot").css({"opacity":"0"});
        $(".mot").css({"webkit-transform":"translateY(30px)"});
      }
    });
  });
  $(function () {
    $(window).scroll(function(){
      $(".header-blank").css("height", ($(this).scrollTop()) / 1.5);
      var wintop = $(this).scrollTop(), docheight = $('body').height(), winheight = $(this).height();
      var totalScroll = ((wintop/(docheight-winheight))*500);
      $(".nav-indicator").css({"height":totalScroll+"px"});
    });
    $(".header-blank").css("height", ($(window).scrollTop()) / 1.5);
    var wintop = $(window).scrollTop(), docheight = $('body').height(), winheight = $(window).height();
    var totalScroll = ((wintop/(docheight-winheight))*500);
    $(".nav-indicator").css({"height":totalScroll+"px"});

  });
  $(function () {
    if ($(this).scrollTop() > 850){
      $(".numbers-container").css({'opacity':'1'});
      state=1;
    }
    else{
      $(".numbers-container").css({'opacity':'0'});
      state=0;
    }
    $(window).scroll(function(){
      if ($(this).scrollTop() > 850) {
        if(state==0){
          $(".numbers-container").css({'opacity':'1'});
          $(".numbers").fadeIn();
          $('.count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            }, {
                duration: 2000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
          });
          state=1;
        }
      }
    });
  });
  $(function () {
    $(".about-titles ul li").click(function(){
      if($(this).attr('class')!='active-title'){
        if($(this).children('h2').hasClass('team-title')){
          $('.team').css({"webkit-transform":"translateX(0px)"});
          $('.team').css({"opacity":"1"});
          if($('.active-title').children('h2').hasClass('about-title')){
            $('.about-left').css({"opacity":"0"});
            $('.about-left').css({"webkit-transform":"translateX(500px)"});
            $('.about-right').css({"opacity":"0"});
            $('.about-right').css({"webkit-transform":"translateX(500px)"});
          }
          else{
            $('.history').css({"webkit-transform":"translateX(500px)"});
            $('.history').css({"opacity":"0"});
            $('.about-right').css({"webkit-transform":"translateX(500px)"});
          }
        }
        else if($(this).children('h2').hasClass('about-title')){
          if($('.active-title').children('h2').hasClass('team-title')){
            $('.team').css({"webkit-transform":"translateX(-500px)"});
            $('.team').css({"opacity":"0"});
            $('.about-right').css({"opacity":"1"});
            $('.about-right').css({"webkit-transform":"translateX(0px)"});
            $('.about-left').css({"webkit-transform":"translateX(0px)"});
          }
          else{
            $('.history').css({"webkit-transform":"translateX(500px)"});
            $('.history').css({"opacity":"0"});
            $('.about-left').css({"opacity":"1"});
            $('.about-left').css({"webkit-transform":"translateX(0px)"});
            $('.about-right').css({"webkit-transform":"translateX(0px)"});
          }
        }
        else{
          $('.history').css({"webkit-transform":"translateX(0px)"});
          $('.history').css({"opacity":"1"});
          if($('.active-title').children('h2').hasClass('team-title')){
            $('.team').css({"webkit-transform":"translateX(-500px)"});
            $('.team').css({"opacity":"0"});
            $('.about-left').css({"webkit-transform":"translateX(-500px)"});
          }
          else{
            $('.about-right').css({"opacity":"0"});
            $('.about-right').css({"webkit-transform":"translateX(-500px)"});
            $('.about-left').css({"opacity":"0"});
            $('.about-left').css({"webkit-transform":"translateX(-500px)"});
          }
        }
        $('.active-title').attr('class', '');
        $(this).attr('class','active-title');
      }
    });
  });
  $(function () {
    $(".year ul li h4").click(function(){
      if($(this).attr('class')!='active-year'){
        if($(this).text()=='09'){
          $('.year ul').stop().css({"webkit-transform":"translateY(0px)"});
          $(this).attr('class','active-year');
          $('h4:contains("15")').attr('class','');
          $('h4:contains("17")').attr('class','third');
          $('h4:contains("18")').attr('class','fourth');
          $('p').attr('class','');
          $('p:contains("Audrey Tardieu")').attr('class','active-description');
        }
        else if($(this).text()=='15'){
          $('.year ul').stop().css({"webkit-transform":"translateY(-66px)"});
          $(this).attr('class','active-year');
          $('h4:contains("09")').attr('class','third');
          $('h4:contains("17")').attr('class','');
          $('h4:contains("18")').attr('class','third');
          $('p').attr('class','');
          $('p:contains("25 octobre 2015")').attr('class','active-description');
        }
        else if($(this).text()=='17'){
          $('.year ul').stop().css({"webkit-transform":"translateY(-132px)"});
          $(this).attr('class','active-year');
          $('h4:contains("09")').attr('class','fourth');
          $('h4:contains("15")').attr('class','third');
          $('h4:contains("18")').attr('class','');
          $('p').attr('class','');
          $('p:contains("2017")').attr('class','active-description');
        }
        else if($(this).text()=='18'){
          $('.year ul').stop().css({"webkit-transform":"translateY(-198px)"});
          $(this).attr('class','active-year');
          $('h4:contains("09")').attr('class','fourth');
          $('h4:contains("15")').attr('class','fourth');
          $('h4:contains("17")').attr('class','third');
          $('p').attr('class','');
          $('p:contains("2018")').attr('class','active-description');
        }
      }
    });
  });
  $(function () {
    $(".skills-container-impair h4").click(function(){
      if($(this).attr('class')!='active-skill' && $(this).attr('class')!='blank-skill'){
        $('.active-skill').removeClass('active-skill');
        $(this).addClass('active-skill');
        $('.active-skill-description').removeClass('active-skill-description');
        $('.skills-description h5:contains('+$(this).children('.skill-text').text()+')').parent().addClass('active-skill-description');
      }
      else if($(this).attr('class')=='blank-skill'){
        $('.active-skill').removeClass('active-skill');
        $('.active-skill-description').removeClass('active-skill-description');
        $('.blank-skill-description').addClass('active-skill-description');
      }
    });
  });
});