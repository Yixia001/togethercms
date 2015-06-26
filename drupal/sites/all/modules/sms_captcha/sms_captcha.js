(function($) {
Drupal.behaviors.myBehavior = {
  attach: function (context, settings) {

		var wait = 10;
		function settime() {
			if (wait == 1) {
				//jQuery('#callnow').removeAttr("disabled"); 
				//jQuery('#callnow').html('重新获取');
				wait = 10;
			} else {
				jQuery('#callnow').attr("disabled", "disabled");
				//jQuery('#callnow').html('重新获取' + wait);
				wait--;
				setTimeout(function() {
					settime()
				}, 1000)
			}
		}
    //code starts
    $("#callnow").mousedown(function() {
      settime();
    });
    //code ends


  }
};
})(jQuery);
