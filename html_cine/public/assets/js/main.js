var moviesSlider = $('.owl-carousel.owl-movielist');

moviesSlider.owlCarousel({
    center: true,
    items:2,
    loop:true,
    margin:30,
    onInitialized:hideArrows,
    nav: false,
    dots:false,
    responsive:{
        768:{
            items:3
        },
        1200:{
            items:4
        }
    }
});

if($('.owl-movielist').length > 0){
    var rightArrow = $('.owl-movielist').closest('.movielist__row').find('.right-arrow').first();
    rightArrow.on('click',function(){
        moviesSlider.trigger('next.owl.carousel');
    });

    var leftArrow = $('.owl-movielist').closest('.movielist__row').find('.left-arrow').first();
    leftArrow.on('click',function(){
        moviesSlider.trigger('prev.owl.carousel');
    });
}


$('#cinema-delete').on('click',function(){
    $('#cinema-form').attr('action','/cines/eliminar');
});

if($('.moviecard__info--container').length > 0){
    $(document).ready(setMovieInfoCenter);
    $(window).on('resize',function(){
        setMovieInfoCenter();
    });
}


function setMovieInfoCenter(){
    setTimeout(function(){
        $('.moviecard__info--container').each(function(){
            var infoWidth = parseInt($(this).width());
            var containerWidth = parseInt($(this).closest('.movielist__card--overlay').outerWidth());
            if(containerWidth>0){
                var leftPercentage = ((infoWidth*100)/containerWidth);
                leftPercentage = (100 - leftPercentage)/2;
                leftPercentage += '%';
                $(this).css('left',leftPercentage);
            } 
        });
    },300);
}

function hideArrows(event){
    if(event.item.count > 1){
        $('.owl-movielist').closest('.movielist__row').find('.right-arrow').first().fadeIn('fast');
        $('.owl-movielist').closest('.movielist__row').find('.left-arrow').first().fadeIn('fast');
    }
}

var placeholder;

$(document).ready(function(){
    if($('#inpt_search').length > 0){
        placeholder = $('#inpt_search').attr('placeholder');
        $('#inpt_search').attr('placeholder','');

    }
})

$("#inpt_search,#inpt_search_label").on('focus mouseover', function () {
    $('#inpt_search').attr('placeholder',placeholder);
    $(this).parent('label').addClass('active');
});

$("#inpt_search,#inpt_search_label").on('blur mouseout', function () {
	if($(this).val().length == 0){
        $('#inpt_search').attr('placeholder','');
        $(this).parent('label').removeClass('active');
    }
});
