$(function(){
   'use strict';

   //dashboard
   $('.toggle-info').click(function(){
       $(this).toggleClass('ashrakt').parent().next('.panel-body').fadeToggle(100);
         if($(this).hasClass('ashrakt')){
            $(this).html('<i class="fa fa-minus" ></i>');
         }else{
            $(this).html('<i class="fa fa-plus" ></i>');

         }
   });

    //trigger the selectbox
    $("select").selectBoxIt({
        autoWidth:false
    });
   
    $('[placeholder]').focus(function(){
        $(this).attr('data', $(this).attr('placeholder'));
        $(this).attr('placeholder' ,'');
    }).blur(function(){
        $(this).attr( 'placeholder', $(this).attr('data'));
        /*$(function(){
    'use strict';
     $('[placeholder]').focus(function(){
         $(this).attr('data','username');
         $(this).attr('placeholder' ,'');
     }).blur(function(){
         $(this).attr( 'placeholder','username');
     });
 });*/

    });


 //add asterisk on required field
 //use each to check all inputs in page

 $('input').each(function () {

    if ($(this).attr('required') === 'required') {

        $(this).after('<span class="asterisk">*</span>');

    }

});
//convert password field to text field on hover
var pass =$('.password');
$('.show-pass').hover(function(){
  pass.attr('type','text');
},function(){
    pass.attr('type','password');

});

$('.confirm').click(function(){
  return confirm("are you sure");
});


 //categories
 //هبدل منهم fadeToggle
 $('.cat h3').click(function(){
     $(this).next('.full-view').fadeToggle(200);
 });


 //siblings باقي الاخوه من السبان مثلا
 $('.option span').click(function(){
   $(this).addClass('active').siblings('span').removeClass('active');
      if($('this').data('view')=== 'full'){
       $('.cat .full-view').fadeIn(200);
      }else if($('this').data('view')=== 'classic'){
        $('.cat .full-view').fadeOut(200);

      }
 });


 
 $('.child').hover(function(){ 
     $(this).find('.del').fadeIn(400); },
     function(){ 
         $('.del').fadeOut(400); 
        });








});
