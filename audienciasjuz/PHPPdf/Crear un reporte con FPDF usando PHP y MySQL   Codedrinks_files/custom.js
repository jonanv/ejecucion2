$(document).ready(function(){$('#slider').nivoSlider({effect:'random',animSpeed:1000,pauseTime:7000,startSlide:0,directionNav:true,controlNav:true,controlNavThumbs:false,pauseOnHover:true,prevText:'Prev',nextText:'Next',});$('#back-top').click(function(){$('body, html').animate({scrollTop:0},800);});});