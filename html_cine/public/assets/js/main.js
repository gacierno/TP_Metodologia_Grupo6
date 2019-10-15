//select the slider container for the movieList view
var moviesSlider = '.owl-carousel.owl-movielist';
//build the carousel with function
var builtCarousel = buildCarousel(moviesSlider,false);


//bind event to change action in cinema-form when delete button's clicked
$('#cinema-delete').on('click',function(){
    $('#cinema-form').attr('action','/cines/eliminar');
});

//on ready and resize event, executes a setMovieInfoCenter() to keep
//the movie info on hover centered dinamically
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




var placeholder;
//on document ready,hide filter input placeholder and to load
//new movies/create new slider with jquery.Load() method
$(document).ready(function(){
    if($('#inpt_search').length > 0){
        placeholder = $('#inpt_search').attr('placeholder');
        $('#inpt_search').attr('placeholder','');

    }

    //arrows functionality are binded one time only, as they are independent
    //of the slider creation
    bindArrows();

    $('form #moviefilter__select--genre').on('change',function(event){
        event.preventDefault();
        event.stopPropagation();
        var genre = $('#moviefilter__select--genre').val();
        $(moviesSlider).css("opacity","0.5");
        history.pushState({ genre : genre }, "Peliculas", "/peliculas?genero="+genre);
        $('#movielist-slider-container').load("/peliculas?genero="+genre+" #movielist-slider",function(data){
          var newSlider = $(data).find('#movielist-slider');
          if(newSlider.find('.item').length > 0){
            $('#movies__not-found-row').css('display','none');
            builtCarousel = buildCarousel(moviesSlider,true);
            setMovieInfoCenter();
            $(moviesSlider).css("opacity","1.0");
          }
          else{
            $('#movies__not-found-row').css('display','table');
          }
          
          checkArrowsVisibility();

        });

        return false;
    });
})


//bind filter functionality
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


//rebuild carousel function
function buildCarousel(selector,destroy){
    if(destroy){
        builtCarousel.trigger('destroy').removeClass('owl-carousel owl-loaded');
    }

    var carousel_settings = {
        center: true,
        items:1,
        loop:true,
        margin:30,
        nav: false,
        dots:false,
        responsive:{
            768:{
                items:2
            },
            1200:{
                items:4
            }
        }
    };

    return($(selector).owlCarousel( carousel_settings ));

}


//function to bind or hide arrows on slider creation
function bindArrows(){

        $(moviesSlider).closest('.movielist__row').find('.right-arrow').first().fadeIn('fast');
        $(moviesSlider).closest('.movielist__row').find('.left-arrow').first().fadeIn('fast');
        var rightArrow = $(moviesSlider).closest('.movielist__row').find('.right-arrow').first();
        rightArrow.on('click',function(){
            $(moviesSlider).trigger('next.owl.carousel');
        });
        
        var leftArrow = $(moviesSlider).closest('.movielist__row').find('.left-arrow').first();
        leftArrow.on('click',function(){
            $(moviesSlider).trigger('prev.owl.carousel');
        });
}


function checkArrowsVisibility(){
    var rightArrow = $(moviesSlider).closest('.movielist__row').find('.right-arrow').first();
    var leftArrow = $(moviesSlider).closest('.movielist__row').find('.left-arrow').first();
    rightArrow.fadeOut('fast');
    leftArrow.fadeOut('fast');

    var items = $(moviesSlider).find('.owl-item:not(.cloned)').length;
    console.log(items);
    if(items > 1){
        rightArrow.fadeIn('fast');
        leftArrow.fadeIn('fast');
    }

}