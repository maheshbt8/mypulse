/**
 *  Document   : login.js
 *  Author     : redstar
 *  Description: login form script
 *
 **/

// Toggle Function
$(document).on('click','.toggle',function(){ 
	'use strict';
  // Switches the Icon and form
  if($(this).children('i').attr('class')=='fa fa-user-plus')
  {
	  $(this).children('i').removeClass('fa-user-plus');
	  $(this).children('i').addClass('fa-times');
	  $('.formLogin').slideUp("slow");
	  $('.formRegister').slideDown("slow");
  }
  else
  {
	  $(this).children('i').removeClass('fa-times');
	  $(this).children('i').addClass('fa-user-plus');
	  $('.formLogin').slideDown("slow");
	  if($('.formRegister').is(':visible'))
	     $('.formRegister').slideUp("slow");
	  else
		 $('.formReset').slideUp("slow");
	 $('.userVerification').slideUp("slow");
  }
  
});

$(document).on('click','.signup',function(){ 
	'use strict';
	// Switches the Icon and form
	var t = $(".toggle");
  if($(t).children('i').attr('class')=='fa fa-user-plus')
  {
	  $(t).children('i').removeClass('fa-user-plus');
	  $(t).children('i').addClass('fa-times');
	  $('.formLogin').slideUp("slow");
	  $('.formRegister').slideDown("slow");
  }
  else
  {
	  $(t).children('i').removeClass('fa-times');
	  $(t).children('i').addClass('fa-user-plus');
	  $('.formLogin').slideDown("slow");
	  if($('.formRegister').is(':visible'))
	     $('.formRegister').slideUp("slow");
	  else
		 $('.formReset').slideUp("slow");
		$('.userVerification').slideUp("slow");
  }
  
});

$(document).on('click','.forgetPassword a',function(){ 
	'use strict';
  // Switches the Icon and form
  $('.toggle').children('i').removeClass('fa-user-plus');
  $('.toggle').children('i').addClass('fa-times');
  $('.formLogin').slideUp("slow");
  $('.formReset').slideDown("slow");
});

$(document).on('click','.verifyaccount a',function(){ 
	'use strict';
  // Switches the Icon and form
  $('.toggle').children('i').removeClass('fa-user-plus');
  $('.toggle').children('i').addClass('fa-times');
  $('.formLogin').slideUp("slow");
  $('.userVerification').slideDown("slow");
});

