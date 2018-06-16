function checkSize(){
    return $('.windows-size-check').css('opacity');
}

jQuery(document).ready(function($){
  var state=0;
  var state2=0;
  $(window).resize(function () {
     if (checkSize()!=0.3 && checkSize()!=0.4) {
      $('.nav-main-link').on('mouseenter.large', function () {
            $(this).children('span').stop().css({'top':'-5px'});
            $(this).children('a').stop().css({'color':'white'});
            $(this).children('a').stop().css({'padding-top':'10px'});
        }).on('mouseleave.large', function () {
            $(this).children('span').stop().css({'top':'-85px'});
            $(this).children('a').stop().css({'color':'#777'});
            $(this).children('a').stop().css({'padding-top':'15px'});
      });
     } else {
         $('.nav-main-link').off('mouseenter.large mouseleave.large');
     }
  }).resize();

  $(function () {
    
    $(window).resize(function () {
      if (checkSize()!=0 && checkSize()!=0.1) {
        $('#social-nav').on('mouseenter.large', function () {
            $('#social-nav div:nth-child(3)').stop().css({"webkit-transform":"translateX(-40px)"});
            $('#social-nav div:nth-child(2)').stop().css({"webkit-transform":"translateX(-80px)"});
            $('#social-nav div:nth-child(1)').stop().css({"webkit-transform":"translateX(-120px)"});
          }).on('mouseleave.large', function () {
            $('#social-nav div:nth-child(3)').stop().css({"webkit-transform":"translateX(0px)"});
            $('#social-nav div:nth-child(2)').stop().css({"webkit-transform":"translateX(0px)"});
            $('#social-nav div:nth-child(1)').stop().css({"webkit-transform":"translateX(0px)"});
        });
      }else{
        $('#social-nav').off('mouseenter.large mouseleave.large');
      }
    }).resize();
    $('.student-redirection-hover').hover(
      function() {
          $(this).stop().css({'border':'10px solid white'});
          $(".left-student").children('p').css({'opacity':'1'});
          $(".left-student").children('.big-glyphicon').css({'animation':'float 2s ease-in-out infinite'});
          $(".right-student").animate({'right':'30px'},200);
      },
      function() {
          $(this).stop().css({'border':'0px solid white'});
          $(".left-student").children('p').css({'opacity':'0.2'});
          $(".left-student").children('.big-glyphicon').css({'animation':'none'});
          $(".right-student").stop().animate({'right':'-50px'},200);
    });
    $('.company-redirection-hover').hover(
      function() {
          $(this).stop().css({'border':'10px solid white'});
          $(".left-company").children('p').css({'opacity':'1'});
          $(".left-company").children('.big-glyphicon').css({'animation':'float 2s ease-in-out infinite'});
          $(".right-company").animate({'right':'30px'},200);
      },
      function() {
          $(this).stop().css({'border':'0px solid white'});
          $(".left-company").children('p').css({'opacity':'0.2'});
          $(".left-company").children('.big-glyphicon').css({'animation':'none'});
          $(".right-company").stop().animate({'right':'-50px'},200);
    });
  });
  $(function () {
    $('.scrollspy').on('click', function(e) {
      e.preventDefault();
      var hash = this.hash;
      $('html, body').animate({
        scrollTop: $(this.hash).offset().top+50
      }, 800);
    });
  });
  $(function () {
    $('.scrollspy-minus').on('click', function(e) {
      e.preventDefault();
      var hash = this.hash;
      $('html, body').animate({
        scrollTop: $(this.hash).offset().top-220
      }, 800);
    });
  });
  $(window).resize(function () {
    if (checkSize()!=0.3 && checkSize()!=0.4) {
      if ($(this).scrollTop() > 0){
        $('.navbar-default').stop().css({'height':'50px'});
        $('.navbar-collapse .navbar-nav:first-child').stop().css({'margin-left':'85px'});
        $('.last-news').stop().css({'top':'0px'});
        $('.nav-main-link').stop().css({'padding-top':'0px'});
        $('.main-link-background').stop().css({'height':'50px'});
        $('.navbar-default .navbar-header .branding').hide();
        $('#social-nav').css({'margin-top':'0px'});
        $('#plaquette').css({'margin-top':'0px'});
        $('#devis').css({'margin-top':'0px'});
        $('#disconnect').stop().css({'margin-top':'0px'});
        $('#branding').stop().css({'width':'90px'});
      }
      else{
        $('.navbar-default').stop().css({'height':'85px'});
        $('.navbar-collapse .navbar-nav:first-child').stop().css({'margin-left':'155px'});
        $('.last-news').stop().css({'top':'35px'});
        $('.nav-main-link').stop().css({'padding-top':'17.5px'});
        $('.main-link-background').stop().css({'height':'85px'});
        $('.navbar-default .navbar-header .branding').show();
        $('#social-nav').css({'margin-top':'17.5px'});
        $('#plaquette').css({'margin-top':'17.5px'});
        $('#devis').css({'margin-top':'17.5px'});
        $('#disconnect').stop().css({'margin-top':'17.5px'});
        $('#branding').stop().css({'width':'160px'});
      }
      $(window).scroll(function(){
        if ($(this).scrollTop() > 0) {
          $('.navbar-default').stop().css({'height':'50px'});
          $('.navbar-collapse .navbar-nav:first-child').stop().css({'margin-left':'85px'});
          $('.last-news').stop().css({'top':'0px'});
          $('.nav-main-link').stop().css({'padding-top':'0px'});
          $('.main-link-background').stop().css({'height':'50px'});
          $('.navbar-default .navbar-header .branding').slideUp(200);
          $('#social-nav').css({'margin-top':'0px'});
          $('#plaquette').stop().css({'margin-top':'0px'});
          $('#devis').stop().css({'margin-top':'0px'});
          $('#disconnect').stop().css({'margin-top':'0px'});
          $('#branding').stop().css({'width':'90px'});
        }
        else {
          $('.navbar-default').stop().css({'height':'85px'});
          $('.navbar-collapse .navbar-nav:first-child').stop().css({'margin-left':'155px'});
          $('.last-news').stop().css({'top':'35px'});
          $('.nav-main-link').stop().css({'padding-top':'17.5px'});
          $('.main-link-background').stop().css({'height':'85px'});
          $('.navbar-default .navbar-header img').stop().css({'box-shadow':'none'});
          $('.navbar-default .navbar-header .branding').slideDown(200);
          $('#social-nav').css({'margin-top':'17.5px'});
          $('#plaquette').stop().css({'margin-top':'17.5px'});
          $('#devis').stop().css({'margin-top':'17.5px'});
          $('#disconnect').stop().css({'margin-top':'17.5px'});
          $('#branding').stop().css({'width':'160px'});
        }
      });
    }
    else{
      if ($(this).scrollTop() > 0){
        $('.navbar-default').stop().css({'height':'50px'});
        $('.nav-main-link').stop().css({'padding-top':'0px'});
        $('.last-news').stop().css({'top':'0px'});
        $('#social-nav').css({'margin-top':'0px'});
        $('#plaquette').css({'margin-top':'0px'});
        $('#devis').css({'margin-top':'0px'});
        $('#disconnect').stop().css({'margin-top':'0px'});
        $('.navbar-default .navbar-header .branding').hide();
      }
      else{
        $('.navbar-default').stop().css({'height':'50px'});
        $('.nav-main-link').stop().css({'padding-top':'0px'});
        $('.last-news').stop().css({'top':'0px'});
        $('#social-nav').css({'margin-top':'0px'});
        $('#plaquette').css({'margin-top':'0px'});
        $('#devis').css({'margin-top':'0px'});
        $('#disconnect').stop().css({'margin-top':'0px'});
        $('.navbar-default .navbar-header .branding').hide();
      }
      $(window).scroll(function(){
        if ($(this).scrollTop() > 0) {
          $('.navbar-default').stop().css({'height':'50px'});
          $('.nav-main-link').stop().css({'padding-top':'0px'});
          $('.last-news').stop().css({'top':'0px'});
          $('#social-nav').css({'margin-top':'0px'});
          $('#plaquette').css({'margin-top':'0px'});
          $('#devis').css({'margin-top':'0px'});
          $('#disconnect').stop().css({'margin-top':'0px'});
          $('.navbar-default .navbar-header .branding').slideUp(200);
        }
        else {
          $('.navbar-default').stop().css({'height':'50px'});
          $('.nav-main-link').stop().css({'padding-top':'0px'});
          $('.last-news').stop().css({'top':'0px'});
          $('#social-nav').css({'margin-top':'0px'});
          $('#plaquette').css({'margin-top':'0px'});
          $('#devis').css({'margin-top':'0px'});
          $('#disconnect').stop().css({'margin-top':'0px'});
          $('.navbar-default .navbar-header .branding').hide();
        }
      });
    }
  }).resize();
  $(function () {
    if ($(this).scrollTop() > 950){
      $('.about-redirection').stop().css({'padding-left':'0%'});
      $('.description-container').stop().css({"opacity":"1"});
      $('.description-container').stop().css({'webkit-transform':'translateY(0px)'});
      $('.description img').stop().css({"opacity":"1"});
      $('.description img').stop().css({'webkit-transform':'translateY(0px)'});

      $('.student-redirection').removeClass('student-redirection-hover');
      $('.company-redirection').removeClass('company-redirection-hover');
      state = 0;
    }
    else{
      $('.about-redirection').stop().css({'padding-left':'32.5%'});
      $('.description-container').stop().css({"opacity":"0"});
      $('.description-container').stop().css({'webkit-transform':'translateY(50px)'});
      $('.description img').stop().css({"opacity":"0"});
      $('.description img').stop().css({'webkit-transform':'translateX(50px)'});

      $('.student-redirection').addClass('student-redirection-hover');
      $('.company-redirection').addClass('company-redirection-hover');
      state = 1;
    }
    $(window).scroll(function(){
      if ($(this).scrollTop() > 950) {
        if(state==1){
          $('.about-redirection').stop().css({'padding-left':'0%'});
          $('.description-container').stop().css({"opacity":"1"});
          $('.description-container').stop().css({'webkit-transform':'translateY(0px)'});
          $('.description img').stop().css({"opacity":"1"});
          $('.description img').stop().css({'webkit-transform':'translateY(0px)'});

          $('.student-redirection').removeClass('student-redirection-hover');
          $('.company-redirection').removeClass('company-redirection-hover');
          state = 0;
        }
      }
      else {
        if(state==0){
          $('.about-redirection').stop().css({'padding-left':'32.5%'});
          $('.description-container').stop().css({"opacity":"0"});
          $('.description-container').stop().css({'webkit-transform':'translateY(50px)'});
          $('.description img').stop().css({"opacity":"0"});
          $('.description img').stop().css({'webkit-transform':'translateX(50px)'});

          $('.student-redirection').addClass('student-redirection-hover');
          $('.company-redirection').addClass('company-redirection-hover');
          state = 1;
        }
      }
    });
  });
  $(function () {
    if ($(this).scrollTop() > 1500){
          $('.our-school-container').stop().css({"opacity":"1"});
          $('.our-school-container').stop().css({'webkit-transform':'translateY(0px)'});
          $('.our-school img').stop().css({"opacity":"1"});
          $('.our-school img').stop().css({'webkit-transform':'translateY(0px)'});
      state2 = 0;
    }
    else{
          $('.our-school-container').stop().css({"opacity":"0"});
          $('.our-school-container').stop().css({'webkit-transform':'translateY(50px)'});
          $('.our-school img').stop().css({"opacity":"0"});
          $('.our-school img').stop().css({'webkit-transform':'translateX(-50px)'});
      state2 = 1;
    }
    $(window).scroll(function(){
      if ($(this).scrollTop() > 1500) {
        if(state2==1){
          $('.our-school-container').stop().css({"opacity":"1"});
          $('.our-school-container').stop().css({'webkit-transform':'translateY(0px)'});
          $('.our-school img').stop().css({"opacity":"1"});
          $('.our-school img').stop().css({'webkit-transform':'translateY(0px)'});
          state2 = 0;
        }
      }
      else {
        if(state2==0){
          $('.our-school-container').stop().css({"opacity":"0"});
          $('.our-school-container').stop().css({'webkit-transform':'translateY(50px)'});
          $('.our-school img').stop().css({"opacity":"0"});
          $('.our-school img').stop().css({'webkit-transform':'translateX(-50px)'});
          state2 = 1;
        }
      }
    });
  });
  $(function () {
    $(window).scroll(function(){
      $(".header-blank").css("height", ($(window).scrollTop()) / 1.5);
    });
    $(".header-blank").css("height", ($(this).scrollTop()) / 1.5);
  });
  /*$(function () {
    if ($(this).scrollTop() > 950){
      $(".top-anchor").show();
    }
    else{
      $(".top-anchor").hide();
    }
    $(window).scroll(function(){
      if ($(this).scrollTop() > 950) {
        $(".top-anchor").show(10,function(){
          $(".top-anchor").stop().css({'-webkit-transform':'translateX(0px)'});
        });
      }
      else {
        $(".top-anchor").stop().css({'-webkit-transform':'translateX(100px)'});
        if($('.top-anchor').is(':visible')){
          ('.top-anchor').hide();
        }
      }
    });
  });*/
});