(function($){ /* MENU */ 
	$(document).ready(function(){
  	$(window).scroll(function(){
      if($(window).scrollTop()>175){
        $(".navbar-primary .navbar-nav > li.dropdown.open").removeClass("open");
        $(".navbar-primary .navbar-collapse.in").removeClass("in");
       }
      if($(window).scrollTop()>180){
        $(".navbar-secondary-hide > .navbar").addClass("navbar-fixed-top container");
        $(".navbar-secondary").removeClass("navbar-secondary-hide");
      }else{
        $(".navbar-secondary > .navbar").removeClass("navbar-fixed-top container");
        $(".navbar-secondary").addClass("navbar-secondary-hide");
      }
    });
    $(".navbar-primary").clone().prependTo(".navbar-secondary");
    $(".navbar-secondary > .navbar").removeClass("navbar-primary");
    $(".navbar-secondary > .navbar .navbar-collapse").attr("id","bs-example-navbar-collapse-2");
    $(".navbar-secondary > .navbar .navbar-toggle").attr("data-target","#bs-example-navbar-collapse-2");
	});
}(jQuery));

(function($){
  $(document).ready(function(){ /* SCROLL TOP */
    $(".scrolltop").on("click",function(e){
      var t=$(this);
      $("html, body").stop().animate({scrollTop:$(t.attr("href")).offset().top},1500,"easeInOutExpo");
       e.preventDefault();
    });
  });
}(jQuery));

/*
$(document).ready(function(){
  $.backstretch(
    ["imgbg/bg-backstretch01.jpg","imgbg/bg-backstretch02.jpg","imgbg/bg-backstretch03.jpg","imgbg/bg-backstretch04.jpg"],
    {fade:2e3,duration:6e3}
  );
 
  $(".portfolio-image").magnificPopup({delegate:'[data-image="image-group"]',type:"image",gallery:{enabled:true}});
  $(".portfolio-image-alt").magnificPopup({type:"image",delegate:"a.image-zoom"});
  $(".scrolltop").on("click",function(e){
    var t=$(this);
    $("html, body").stop().animate({scrollTop:$(t.attr("href")).offset().top},1500,"easeInOutExpo");
     e.preventDefault();
  });
  var e=$(".container-blog");
  e.imagesLoaded(function(){
    e.masonry()}
  );
  $("#map").gmap3({
    map:{
      options:{
        center:[-7.866315,110.389574],
        zoom:12,
        scrollwheel:false
       }
    },
    infowindow:{
      latLng:[-7.866315,110.389574],
      options:{
        content:"<div class='map-infowindow'><h3>Templateninja Inc.</h3><span>Email: email@domain.com</span><span>Phone: +1 123 45-67-89</span><span>Fax: +1 123 45-67-89</span><span>Yogyakarta, Ina Jimg St. 55791</span></div>"
      }
    }
  });
});
*/

