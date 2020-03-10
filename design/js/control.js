$(function(){

'use strict';
//Astreisk on required filed
$('input').each(function(){

if($(this).attr('required')==='required'){


	$(this).after("<span class='Astreisk'>*</span>");
}

})




//conver password field to text field on hover

var passfield= $('.password');
$('.showpass').hover(function(){
passfield.attr('type','text');

},function(){
passfield.attr('type','password');


});

//confirmation message do you admin delete user
$('.confirm').click(function(){

return confirm('Are You Sure To Delete This Object ...?');

});


//category view option

$('.card-body .strong').click(function(){
	$('this').next('.full-view').fadeToggle();
});


$('.live-name').keyup(function(){

$('.LIVE-PREVIWE .caption h3').text($(this).val());
//console.log($(this).val());

});


$('.live-Price').keyup(function(){

$('.LIVE-PREVIWE .price').text('$'+$(this).val());
//console.log($(this).val());

});

$('.live-Description').keyup(function(){

$('.LIVE-PREVIWE .caption p').text($(this).val());
//console.log($(this).val());

});


});