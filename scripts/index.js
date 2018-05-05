jQuery(document).ready(function($){
  var state=0;
  var isBreakPoint = function (bp) {
    var bps = [320, 480, 768, 1024],
    w = $(window).width(),
    min, max
    for (var i = 0, l = bps.length; i < l; i++) {
      if (bps[i] === bp) {
        min = bps[i-1] || 0
        max = bps[i]
        break
      }
    }
    return w > min && w <= max
  }
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
    $('.nav-main-link').hover(
      function() {
          $(this).children('span').stop().animate({'top':'-5px'},200);
          $(this).children('a').stop().css({'color':'white'});
          $(this).children('a').stop().css({'padding-top':'10px'});
      },
      function() {
        if($(this).children('span').height()=="80"){
          $(this).children('span').stop().animate({'top':'-80px'},200);
        }
        else{
          $(this).children('span').stop().animate({'top':'-50px'},200);
        }
          $(this).children('a').stop().css({'color':'#777'});
          $(this).children('a').stop().css({'padding-top':'15px'});
    });
    $('.nav-secondary-link').hover(
      function() {
          $(this).children('span').stop().animate({'top':'-5px'},200);
          $(this).children('a').stop().css({'color':'white'});
          $(this).children('a').stop().css({'padding-top':'10px'});
      },
      function() {
        if($(this).children('span').height()=="80"){
          $(this).children('span').stop().animate({'top':'-80px'},200);
        }
        else{
          $(this).children('span').stop().animate({'top':'-50px'},200);
        }
          $(this).children('a').stop().css({'color':'#777'});
          $(this).children('a').stop().css({'padding-top':'15px'});
    });
    $('.last-news').hover(
      function() {
          $(this).stop().css({'height':'60px'});
          $(this).children('p').stop().css({'margin-top':'10px'});
      },
      function() {
          $(this).stop().css({'height':'40px'});
          $(this).children('p').stop().css({'margin-top':'0px'});
    });
    $('.student-redirection').hover(
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
    $('.company-redirection').hover(
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
        scrollTop: $(this.hash).offset().top-185
      }, 800);
    });
  });
  $(function () {
    if ($(this).scrollTop() > 950){
      $('.about-redirection').css({'padding-left':'0%'});
      $('.description-container').show();
      state = 0;
    }
    else{
      $('.about-redirection').css({'padding-left':'32.5%'});
      $('.description-container').hide();
      state = 1;
    }
    $(window).scroll(function(){
      if ($(this).scrollTop() > 950) {
        if(state==1){
          $('.about-redirection').css({'padding-left':'0%'});
          $('.description-container').fadeIn("slow");
          $('.description-container').css({'webkit-transform':'translateY(-20px)'});
          state = 0;
        }
      }
      else {
        if(state==0){
          $('.about-redirection').css({'padding-left':'32.5%'});
          $('.description-container').fadeOut("slow");
          $('.description-container').css({'webkit-transform':'translateY(0px)'});
          state = 1;
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