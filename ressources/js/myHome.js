$(document).ready(function () {
    $('.bedroom,.kitchen,.bath,.living').hide();
   $('.iconBed').click(function(){
       $('.kitchen,.bath,.living').hide();
       $('.bedroom').slideToggle();
   });
    $('.iconKitchen').click(function(){
        $('.bedroom,.bath,.living').hide();
        $('.kitchen').slideToggle();
    });
    $('.iconBath').click(function(){
        $('.bedroom,.kitchen,.living').hide();
        $('.bath').slideToggle();
    });
    $('.iconSofa').click(function(){
        $('.bedroom,.kitchen,.bath').hide();
        $('.living').slideToggle();
    });
});


