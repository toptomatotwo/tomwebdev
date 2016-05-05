 jQuery(document).ready(function() {

  /* window size monitor */
  jQuery.windowWidth = jQuery(window).width();
	jQuery.windowHeight = jQuery(window).height();
	jQuery('#widthMonitor').html(jQuery.windowWidth);  //same logic that you use in the resize...

  jQuery(window).resize(function() {
  jQuery.windowWidth = jQuery(window).width();
	jQuery.windowHeight = jQuery(window).height();
	jQuery('#widthMonitor').html(jQuery.windowWidth);
                      });

  	/*
  	function showInfo(){
        var selectedEffect = 'slide';
        var options = {};
        $('#info').toggle(selectedEffect, options, 500);       
    } */
    /*
    jQuery('#info-icon').click(function(){
        //showInfo();
        alert('clicked');
        jQuery('.info-text').toggle(
          function(){alert('clicked 1');},
          function(){alert('clicked 2');}
          );
        
        }) */
  (function($) {
    $.fn.clickToggle = function(func1, func2) {
        var funcs = [func1, func2];
        this.data('toggleclicked', 0);
        this.click(function() {
            var data = $(this).data();
            var tc = data.toggleclicked;
            $.proxy(funcs[tc], this)();
            data.toggleclicked = (tc + 1) % 2;
        });
        return this;
    };
  }(jQuery));

  jQuery('#info-icon').clickToggle(
    function() {   
      jQuery('.info-text-wrapper').slideDown();
      console.log('clicked 1');
      jQuery('.more-info-icon').animate({top:"280", 'font-size':"14px", width:"30px", height:"30px",'margin-left':"-15px",'margin-top':"-15px","padding-top":"8px"},{ duration:300, queue: false });
      jQuery()
      /*jQuery('.icon').animate({'font-size':"14px"}, 500);
      jQuery('.icon').animate({width:"30px"}, 500);
      jQuery('.icon').animate({height:"30px"}, 500);
      jQuery('.icon').animate({margin-left:"-15px"}, 500);
      jQuery('.icon').animate({margin-top:"-15px"}, 500); */
    },
    function() {
      jQuery('.info-text-wrapper').slideUp();
      console.log('clicked 2');
      jQuery('.more-info-icon').animate({top:"280", 'font-size':"14px", width:"30px", height:"30px",'margin-left':"-15px",'margin-top':"-15px"},{ duration:300, queue: false });
      /*jQuery('.fa-info::before').animate({top:-17px;}); */
      /*jQuery('.icon').animate({'font-size':"70px"}, 500);
      jQuery('.icon').animate({width:"100px"}, 500);
      jQuery('.icon').animate({height:"100px"}, 500);
      jQuery('.icon').animate({'margin-left':"-50px"}, 500);
      jQuery('.icon').animate({'margin-top':"-50px"}, 500);*/
    });


})