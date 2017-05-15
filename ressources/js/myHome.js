$(document).ready(function () {
    $('.bedroom,.kitchen,.bath,.living').hide();
   $('.iconBed').click(function(){
       $('.kitchen,.bath,.living').hide("slow");
       $('.bedroom').slideToggle();
   });
    $('.iconKitchen').click(function(){
        $('.bedroom,.bath,.living').hide("slow");
        $('.kitchen').slideToggle();
    });
    $('.iconBath').click(function(){
        $('.bedroom,.kitchen,.living').hide("slow");
        $('.bath').slideToggle();
    });
    $('.iconSofa').click(function(){
        $('.bedroom,.kitchen,.bath').hide("slow");
        $('.living').slideToggle();
    });
});


