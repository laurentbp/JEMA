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
    $('.student-redirection').hover(
      function() {
          $(this).stop().css({'border':'10px solid white'});
          $(this).children('p').css({'opacity':'1'});
      },
      function() {
          $(this).stop().css({'border':'0px solid white'});
          $(this).children('p').css({'opacity':'0.2'});
    });
    $('.company-redirection').hover(
      function() {
          $(this).stop().css({'border':'10px solid white'});
          $(this).children('p').css({'opacity':'1'});
      },
      function() {
          $(this).stop().css({'border':'0px solid white'});
          $(this).children('p').css({'opacity':'0.2'});
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
});