window.addEvent('domready', function() {  
var isExtended = 0;
var sliders = $$(".slide");

var triggers = $$(".slide_trigger") ;

triggers.each(function( o, x ){ 	
 
	var sl = new Fx.Slide( sliders[x], { } );	
 
		$(triggers[x]).addEvent('click',function(e){ 
		e = new Event(e);			 
		sl.toggle();
		
		if(isExtended == 0) { 				 
		this.style.backgroundImage='url("components/com_jaccounts/images/config_bullet_active.png")';
		isExtended = 1;
		} else { 
		this.style.backgroundImage='url("components/com_jaccounts/images/config_bullet.png")';
		isExtended = 0;
		}
		
		e.stop(); 				  
		})					  
		sl.hide(); 
		});	
 
}  )