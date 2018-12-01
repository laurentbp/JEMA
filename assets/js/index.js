jQuery(document).ready(function($){

  //navbar

    if ($(this).scrollTop()>0){
      $('.navbar-default').addClass('navbar-default-min');
    }
    else{
      $('.navbar-default').removeClass('navbar-default-min');
    }

    $(window).scroll(function(){

      if ($(this).scrollTop()>0){
        $('.navbar-default').addClass('navbar-default-min');
      }
      else{
        $('.navbar-default').removeClass('navbar-default-min');
      }

    });
    
  //redirection

  $(window).scroll(function(){
    if ($(this).scrollTop()>1200){
      if(!$('.redirection a h2').hasClass('activated')){
        $('.redirection a h2').addClass('activated');
      }
    }
  });

  //numbers

  $(window).scroll(function(){
    if ($(this).scrollTop()>2100){
      if(!$('.numbers').hasClass('numbers-activated')){
        $('.numbers').addClass('numbers-activated');
        $('.count').each(function () {
          $(this).prop('Counter',0).animate({
              Counter: $(this).text()
          }, {
              duration: 3000,
              easing: 'swing',
              step: function (now) {
                  $(this).text(Math.ceil(now));
              }
          });
        });
      }
    }
  });

});