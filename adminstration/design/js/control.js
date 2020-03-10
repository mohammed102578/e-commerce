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
	$(this).next('.full-view').fadeToggle();
});


$('.child-link').hover(
function(){$(this).find('.show-Delete').fadeIn(400);},
function(){$(this).find('.show-Delete').fadeOut(400);});



});
















