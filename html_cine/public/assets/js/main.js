$('.owl-carousel.owl-cinemaList').owlCarousel({
    center: true,
    items:2,
    loop:true,
    margin:10,
    responsive:{
        600:{
            items:4
        }
    }
});


$('#cinema-delete').on('click',function(){
    $('#cinema-form').attr('action','/cines/eliminar')
});