jQuery(document).ready(function($){

  //loader

    $(".se-pre-con").fadeOut("slow");

  //navbar

    $('.navbar-toggle').on('click', function(e) {
      if($('.navbar-default').hasClass('navbar-default-active')){
        $('.navbar-default').removeClass('navbar-default-active');
        $('.social-nav').removeClass('social-nav-active');
      }
      else{
        $('.navbar-default').addClass('navbar-default-active');
        $('.social-nav').addClass('social-nav-active');
      }
    });

    $('.main-link').on('click', function(e) {
      if($('.main-link').hasClass('main-link-clicked')){
        $('.main-link').removeClass('main-link-clicked');
      }
      else{
        $('.main-link').addClass('main-link-clicked');
      }
    });

    $('.navbar-default .navbar-nav>li>a.scrollspy').on('click', function(e) {
      $('.navbar-toggle').trigger('click');
    });

  //Smooth navigation links

  $('.scrollspy').on('click', function(e) {
    e.preventDefault();
    var hash = this.hash;
    $('html, body').animate({
      scrollTop: $(this.hash).offset().top
    }, 800);
  });

  //Top anchor

  	if ($(this).scrollTop()>($('.main-content>section:first-child').offset().top-200)){
      $('.anchor-top').fadeIn();
    }
	else{
	  $('.anchor-top').fadeOut();
	}

    $(window).scroll(function(){

		if ($(this).scrollTop()>($('.main-content>section:first-child').offset().top-200)){
		  $('.anchor-top').fadeIn();
		}
		else{
		  $('.anchor-top').fadeOut();
		}

    });

  //Image preview

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('.image-preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    $('.image-news').change(function() {
      readURL(this);
    });

  //information

    $('.team>.content>.pictures-container>div').on('click', function(e) {
      $('.team>.content>.pictures-container>div.active').removeClass('active');
      $(this).addClass('active');
    });

    if ($(window).width()>768){
      $('.information>div').on('click', function(e) {
        $('.information>div.active').removeClass('active');
        $(this).addClass('active');
      });
    }

    else if ($(window).width()<=768){
      $('.information>div:not(.about)>.header>h2').on('click', function(e) {
        $(this).parent().next('.content').slideToggle();
      });
    }


    $('.history ul li h4').on('click', function(e) {
      $(this).next('.image').slideToggle();
    });

  //numbers

    $(window).scroll(function(){
      if ($(this).scrollTop()>($('.numbers').offset().top-200)){
        if(!$('.numbers').hasClass('numbers-activated')){
          $('.numbers').addClass('numbers-activated');
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
        }
      }
    });

});