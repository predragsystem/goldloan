
	$(document).keypress(function(event){

		 //var x = event.key;

		//well you need keep on mind that your browser use some keys 
         //to call some function, so we'll prevent this
         e.preventDefault();

         //now we caught the key code, yabadabadoo!!
         var keyCode = e.keyCode || e.which;

         //your keyCode contains the key code, F1 to F12 
         //is among 112 and 123. Just it.
         console.log(keyCode);       
		
		alert(keyCode);

		/*var keycode = (event.keyCode ? event.keyCode : event.which);
		alert(keycode);
		if(keycode == '13'){
			alert('You pressed a "enter" key in somewhere');	
		}*/
		
	});
	
	$(function(){
	    //Yes! use keydown 'cus some keys is fired only in this trigger,
	    //such arrows keys
	    $("body").keydown(function(e){
	         //well you need keep on mind that your browser use some keys 
	         //to call some function, so we'll prevent this
	         e.preventDefault();

	         //now we caught the key code, yabadabadoo!!
	         var keyCode = e.keyCode || e.which;

	         //your keyCode contains the key code, F1 to F12 
	         //is among 112 and 123. Just it.
	         console.log(keyCode);   
	         alert(keyCode);    
	    });
	});