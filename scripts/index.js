jQuery(document).ready(function($){
  $(function () {
    $('.nav-main-link').hover(
      function() {
          $(this).children('span').stop().animate({'top':'-5px'},200);
          $(this).children('a').stop().css({'color':'white'});
          $(this).children('a').stop().css({'padding-top':'10px'});
      },
      function() {
          $(this).children('span').stop().animate({'top':'-50px'},200);
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
          $(this).children('span').stop().animate({'top':'-50px'},200);
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
          $(this).children().children('p').css({'opacity':'1'});
          $(this).children().children('.big-glyphicon').css({'animation':'float 2s ease-in-out infinite'});
          $(".right-student").animate({'right':'30px'},200);
      },
      function() {
          $(this).stop().css({'border':'0px solid white'});
          $(this).children().children('p').css({'opacity':'0.2'});
          $(this).children().children('span').css({'animation':'none'});
          $(".right-student").stop().animate({'right':'-50px'},200);
    });
    $('.company-redirection').hover(
      function() {
          $(this).stop().css({'border':'10px solid white'});
          $(this).children().children('p').css({'opacity':'1'});
          $(this).children().children('span').css({'animation':'float 2s ease-in-out infinite'});
          $(".right-company").animate({'right':'30px'},200);
      },
      function() {
          $(this).stop().css({'border':'0px solid white'});
          $(this).children().children('p').css({'opacity':'0.2'});
          $(this).children().children('span').css({'animation':'none'});
          $(".right-company").stop().animate({'right':'-50px'},200);
    });
  });
  $(function () {
    $('.scrollspy').on('click', function(e) {
      e.preventDefault();
      var hash = this.hash;
      $('html, body').animate({
        scrollTop: $(this.hash).offset().top
      }, 800, function(){
        window.location.hash = hash;
      });
    });
  });
  $(function () {
    if ($(this).scrollTop() > 400){
      $(".top-anchor").show();
    }
    else{
      $(".top-anchor").hide();
    }
    $(window).scroll(function(){
      if ($(this).scrollTop() > 400) {
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
  });
});