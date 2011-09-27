/*
 * jdsharp.us (2007-03-06)
 *
 * Copyright (c) 2006,2007 Jonathan Sharp (http://jdsharp.us)
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 * http://jdsharp.us/
 *
 * This script works with the site
 */


// From: http://nemoweb.com.au/jquery/IEPNGHack/
jQuery.fn.IEPNGHack = function() {
	if (!$.browser.msie) {
		return false;
	}
	this.each(function(){
		var hack = "<span";
		hack += $(this).attr('id') ? " id=\""+$(this).attr('id')+"\"" : "";
		hack += $(this).attr('class') ? " class=\""+$(this).attr('class')+"\"" : "";
		hack += " style=\"display:inline-block;";
		if ($(this).parent().attr('href')) {
			hack += " cursor:pointer;";
		}
		hack += " width:"+$(this).width()+"px;height:"+$(this).height()+"px;";
		hack += " filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+$(this).attr('src')+"',sizingMethod='scale')";
		hack += " \"></span>";
			$(this).wrap(hack).hide();
	})
};
	
$(function(){
	$('img[@src$=.png]').IEPNGHack();
});
