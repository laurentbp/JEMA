var show_per_page = 6; 
var current_page = 0;
var flag=1;

function checkSize(){
    return $('.windows-size-check').css('opacity');
}

$.fn.moreLines = function () {

  this.each(function(){

    var element = $(this), 
      textelement = element.find("p"),
      baseclass = "b-description_readmore",
      basejsclass = "js-description_readmore",
      currentclass = "",
      singleline = parseFloat(element.css("line-height")),
      auto = 3,
      fullheight = element.innerHeight(),
      settings = {
        linecount: 3,
        baseclass: baseclass,
        basejsclass: basejsclass,
        classspecific: currentclass,
        buttontxtmore: "Voir plus",
        buttontxtless: "Réduire",
        animationspeed: 500
      },
      
      ellipsisclass = settings.baseclass+settings.classspecific+"_ellipsis",
      buttonclass = settings.baseclass+settings.classspecific+"_button",
      wrapcss = settings.baseclass+settings.classspecific+"_wrapper",
      wrapjs = settings.basejsclass+settings.classspecific+"_wrapper",
      wrapper = $("<div>").addClass(wrapcss+ ' ' +wrapjs),
      linescount = singleline * settings.linecount;

    element.wrap(wrapper);

    if (element.parent().not(wrapjs)) {
      
      element.addClass(ellipsisclass).css({'min-height': linescount+45, 'max-height': linescount+45, 'overflow': 'hidden'});

      if (fullheight > linescount) {

      var moreLinesButton = $("<div>", {
        "class": buttonclass,
        click: function() {

          element.toggleClass(ellipsisclass);
          $(this).toggleClass(buttonclass+'_active');

          if (element.css('max-height') !== 'none') {
            element.css({'height': linescount, 'max-height': ''}).animate({height:fullheight/2.5+130}, settings.animationspeed, function () {
              moreLinesButton.html(settings.buttontxtless);
            });

          } else {
            element.animate({height:linescount}, settings.animationspeed, function () {
              moreLinesButton.html(settings.buttontxtmore);
              element.css('max-height', linescount);
            });
          }
        },

        html: settings.buttontxtmore
      });

      element.after(moreLinesButton);

      }
    }
  });

  return this;
};

$(function() {
  $('.js-description_readmore').moreLines();
  });

/*function set_display() {
  $('.js-description_readmore').moreLines();
  if(flag==0){
    $('html, body').animate({
      scrollTop: $('.news-container').offset().top-50
    }, 800);
    flag=1;
    $('#news').children(".news").stop().animate({opacity: 0},500,function(){
      $('#news').children(".news").stop().hide();
      $(window).resize(function () {
        if (checkSize()!=0.2 && checkSize()!=0.3 && checkSize()!=0.4) {
          $('#news').children(".news").slice(current_page * show_per_page, (current_page * show_per_page) + show_per_page).stop().css({'display': 'block','width':'48.5%'});
        } 
        else {
          $('#news').children(".news").slice(current_page * show_per_page, (current_page * show_per_page) + show_per_page).stop().css({'display': 'block','width':'100%'});
        }
      }).resize();
      $('#news').children(".news").slice(current_page * show_per_page, (current_page * show_per_page) + show_per_page).stop().animate({opacity: 1},500);
      $('#news').children(".news").children('.news-content').children('.js-description_readmore').moreLines();
    });
  }
  else{
    $('#news').children(".news").stop().animate({opacity: 0},0,function(){
      $('#news').children(".news").stop().delay(10).hide();
      $(window).resize(function () {
        if (checkSize()!=0.2 && checkSize()!=0.3 && checkSize()!=0.4) {
          $('#news').children(".news").slice(current_page * show_per_page, (current_page * show_per_page) + show_per_page).stop().css({'display': 'block','width':'48.5%'});
        } 
        else {
          $('#news').children(".news").slice(current_page * show_per_page, (current_page * show_per_page) + show_per_page).stop().css({'display': 'block','width':'100%'});
        }
      }).resize();      
      $('#news').children(".news").slice(current_page * show_per_page, (current_page * show_per_page) + show_per_page).stop().animate({opacity: 1},500);
      $('#news').children(".news").slice(current_page * show_per_page, (current_page * show_per_page) + show_per_page).children('.news-content').children('.js-description_readmore').moreLines();
    });
  }
}*/

function previous(){
    if($('.active-page').prev('.page_link').length) go_to_page(current_page - 1);
}

function next(){
    if($('.active-page').next('.page_link').length) go_to_page(current_page + 1);
}

function go_to_page(page_num){
  current_page = page_num;
  flag=0;
  if(!$('.active-page').hasClass('id' + current_page)){
    set_display();
    $('.active-page').removeClass('active-page');
    $('.id' + current_page).addClass('active-page');
  }
} 

$(document).ready(function() {

  var number_of_pages = Math.ceil($('#news').children(".news").length / show_per_page);

  var nav = '<ul class="pagination"><li class="pagination-nav"><a href="javascript:previous();">&laquo;</a>';

  var i = -1;

  while(number_of_pages > ++i){
    nav += '<li class="page_link'
    if(!i) nav += ' active-page';
    nav += ' id' + i +'">';
    nav += '<a href="javascript:go_to_page(' + i +')">'+ (i + 1) +'</a>';
  }
  nav += '<li class="pagination-nav"><a href="javascript:next();">&raquo;</a></ul>';

  $('.page_navigation').html(nav);

  set_display(0, show_per_page);

  /*$("#news").on('click','.b-description_readmore_button',function(){
    if($(this).parent().children('.js-description_readmore').children('.news-img').height()==100){
      $('.pagination').stop().animate({'opacity':'0'},200,function(){
        $('.pagination a').stop().hide();
      });
      $(this).parent().children('.js-description_readmore').children('.news-img').stop().css({'width':'250px','height':'188px'});
      $('.active-news').removeClass('active-news');
      $(this).parent().parent().parent().addClass('active-news');
      $('#news').children(".news").slice(current_page * show_per_page, (current_page * show_per_page) + show_per_page).not($('.active-news')).stop().animate({opacity:0},500,function(){
          $('#news').children(".news").slice(current_page * show_per_page, (current_page * show_per_page) + show_per_page).not($('.active-news')).stop().slideToggle(500,function(){
          $('.active-news').stop().animate({'width':'100%'},500);
        });
      });
    }
    else{
      $(this).parent().children('.js-description_readmore').children('.news-img').stop().css({'width':'133px','height':'100px'});
      $('.pagination a').stop().show(function(){
        $('.pagination').stop().animate({'opacity':'1'},200);
      });
      if (checkSize()==0 || checkSize()==0.1) {
        $(this).parent().parent().parent().stop().animate({'width':'48.5%'},500,function(){
          $('#news').children(".news").slice(current_page * show_per_page,  (current_page * show_per_page) + show_per_page).not($('.active-news')).stop().slideToggle(500,function(){
            $('#news').children(".news").slice(current_page * show_per_page,  (current_page * show_per_page) + show_per_page).not($('.active-news')).stop().animate({opacity:1},500);
            $('.active-news').removeClass('active-news');
            $('#news').children(".news").slice(current_page * show_per_page,  (current_page * show_per_page) + show_per_page).css({'height':'auto'});
          });
        });
      } 
      else {
        $('#news').children(".news").slice(current_page * show_per_page,  (current_page * show_per_page) + show_per_page).not($('.active-news')).delay(500).stop().slideToggle(500,function(){
          $('#news').children(".news").slice(current_page * show_per_page,  (current_page * show_per_page) + show_per_page).not($('.active-news')).stop().css({'margin-bottom':'3%','padding':'20px 30px 20px 30px'});
          $('#news').children(".news").slice(current_page * show_per_page,  (current_page * show_per_page) + show_per_page).not($('.active-news')).stop().animate({opacity:1},500);
          $('.active-news').removeClass('active-news');
          $('#news').children(".news").slice(current_page * show_per_page,  (current_page * show_per_page) + show_per_page).css({'height':'auto'});
        });      
      }
    }
  });
  $("#news").on('click','.edit',function(){
    $('.pagination').stop().animate({'opacity':'0'},200,function(){
      $('.pagination a').stop().hide();
    });
    $(this).parent().parent().parent().parent().children('.news-content').stop().slideToggle(500);
    $(this).parent().parent().parent().parent().children('.news-edit').stop().slideToggle(500);
    /*$(this).parent().children('.js-description_readmore').children('.news-img').stop().css({'width':'250px','height':'188px'});*/
    /*$('.active-news').removeClass('active-news');
    $(this).parent().parent().parent().parent().addClass('active-news');
    $('#news').children(".news").slice(current_page * show_per_page, (current_page * show_per_page) + show_per_page).not($('.active-news')).stop().animate({opacity:0},500,function(){
        $('#news').children(".news").slice(current_page * show_per_page, (current_page * show_per_page) + show_per_page).not($('.active-news')).stop().slideToggle(500,function(){
          $('.active-news').stop().animate({'width':'100%'},500);
      });
    });
  });
  $("#news").on('click','.news-edit-cancel',function(){
    $('.pagination a').stop().show(function(){
        $('.pagination').stop().animate({'opacity':'1'},200);
      });
    $(this).parent().parent('.news-edit').stop().slideToggle(500);
    $(this).parent().parent().parent().children('.news-content').stop().slideToggle(500);
    /*$(this).parent().children('.js-description_readmore').children('.news-img').stop().css({'width':'133px','height':'100px'});*/
    /*$(this).parent().parent().parent().stop().animate({'width':'48.5%'},500,function(){
      $('#news').children(".news").slice(current_page * show_per_page,  (current_page * show_per_page) + show_per_page).not($('.active-news')).stop().slideToggle(500,function(){
        $('#news').children(".news").slice(current_page * show_per_page,  (current_page * show_per_page) + show_per_page).not($('.active-news')).stop().animate({opacity:1},500);
        $('.active-news').removeClass('active-news');
        $('#news').children(".news").slice(current_page * show_per_page,  (current_page * show_per_page) + show_per_page).css({'height':'auto'});
      });
    });
  });*/
});