//stellarnav
jQuery(document).ready(function ($) {
  jQuery('.stellarnav').stellarNav({
    theme: 'light',
    breakpoint: 991,
    position: 'right',
  });
});

// aos init

AOS.init({
  offset: 300,
});

// Go to Top
$(function () {
  // Scroll Event
  $(window).on('scroll', function () {
    var scrolled = $(window).scrollTop();
    if (scrolled > 600) $('.go-top').addClass('active');
    if (scrolled < 600) $('.go-top').removeClass('active');
  });
  // Click Event
  $('.go-top').on('click', function () {
    $('html, body').animate({ scrollTop: '0' }, 500);
  });
});

$(window).scroll(function () {
  $('.main-nav').toggleClass('scrolled', $(this).scrollTop() > 50);
});

//   preloader
$(window).on('load', function () {
  $('#preloader').fadeOut(1000);
});
