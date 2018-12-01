if($(window).width()>992){
  var show_per_page = 6; 
  var current_page = 0;
  var flag=1;
}
else if($(window).width()>768){
  var show_per_page = 4 ; 
  var current_page = 0;
  var flag=1;
}
else{
  var show_per_page = 3; 
  var current_page = 0;
  var flag=1;
}

function scroll(){
  $('html, body').animate({
    scrollTop: $('.news').offset().top
  }, 800);
}

function set_display(first, last) {
  $('.news').children(".posts").children("article").css('display', 'none');
  $('.news').children(".posts").children("article").slice(first, last).css('display', 'block');
}

function previous(){
  if($('.active-page').prev('.page_link').length) go_to_page(current_page - 1);
  scroll();
}

function next(){
  if($('.active-page').next('.page_link').length) go_to_page(current_page + 1);
  scroll();
}

function go_to_page(page_num){
  current_page = page_num;
  start_from = current_page * show_per_page;
  end_on = start_from + show_per_page;
  set_display(start_from, end_on);
  $('.active-page').removeClass('active-page');
  $('.id' + page_num).addClass('active-page');
  scroll();
} 

$(document).ready(function() {

  var number_of_pages = Math.ceil($('.news').children(".posts").children("article").length / show_per_page);

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

});