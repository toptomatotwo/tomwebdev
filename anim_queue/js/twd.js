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
      console.log('clicked 1');
      jQuery('.more-info-icon').animate({top:"280", 'font-size':"14px", width:"30px", height:"30px",'margin-left':"-15px",'margin-top':"-15px","padding-top":"8px"}, { duration:1000, complete: function(){jQuery('.info-text-wrapper').animate({opacity:1}, {duration:1000, queue: true }); } });
      
    },
    function() {
      console.log('clicked 2');
      jQuery('.info-text-wrapper').animate({opacity:0}, {duration:1000, complete: function(){jQuery('.more-info-icon').animate({top:"50%", 'font-size':"70px", width:"100px", height:"100px",'margin-left':"-50px",'margin-top':"-50px", "padding-top":"15px"},{duration:1000, queue: true });} });
      
    });
})