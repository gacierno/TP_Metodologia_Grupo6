var placeholder;
var height;
var myChart;
//on document ready,hide filter input placeholder and to load
//new movies/create new slider with jquery.Load() method
$(document).ready(function(){

    //bind events to movie list
    bindMoviesBehaviour();


    //bind btn behaviour to show filter on mobile on click
    if($('#mobile-filter-trigger').length > 0){
        $('#mobile-filter-trigger').on('click',function(){
            $('.movielist__filter--column').css('transform','translateX(0)');
        });

        $('.filter-back-btn--container').on('click',function(){
            $('.movielist__filter--column').css('transform','translateX(-100%)');
        })
    }

    //creates an empty chart for /admin/estadisticas and execute an AJAX callback for it to be filled,
    //and executes it everytime a filter value detect changes
    if($('#myChart').length > 0){
        var ctx = document.getElementById('myChart');
        myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [0, 0, 0, 0, 0, 0],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        statisticsUpdate();
        $('.charts__filter--container #chart-movies,#chart-cinemas,#chart-begin-date,#chart-final-date,#amount-btn,#tickets-btn,#leftover-btn').on('change',function(){
            statisticsUpdate();
        });
    }



    //qr code handling on tickets
    if($('.qr-button').length > 0){

        //create the qr code for the first time, empty
        var QrCode = new QRCode(document.getElementById("qrcode"), {
            text: "no-data",
            colorDark : "#000000",
            colorLight : "#ffffff"
        });

        //on each qr-code button click, fill the existant a QR code with the new data
        $('.qr-button').on('click',function(){
            if(!($(this).hasClass('open'))){
                QrCode.clear();
                var infoContainer = $(this).closest('.purchase__ticket--outer-container').find('.ticket__info--container');
                var info = $(infoContainer).first().find(' .ticket__movie-title').text() + " / " + $(infoContainer).first().find(' .ticket__movie--date-time').text() + " / " + $(infoContainer).first().find(' .ticket__movie-cinemaroom').text();
                QrCode.makeCode(info);
                $('body').css('overflow','hidden');
            }

            $('.qr-code--container').toggleClass('open');
        });

        //handler for closing QR popup
        $('.qr-code__close-btn').on('click',function(){
            $('.qr-code--container').toggleClass('open');
            $('body').css('overflow','visible');
        });
    }

    //bind event to change action in cinema-form when delete button's clicked
    $('#cinema-delete').on('click',function(){
        if($(this).attr('available') !== undefined){
            $('#cinema-form').attr('action','/admin/cines/desactivar');
        }
        else if($(this).attr('not-available') !== undefined){
            $('#cinema-form').attr('action','/admin/cines/activar');
        }
    });

    //bind event to change action in cinemaRoom-form when delete button's clicked
    $('#cinemaRoom-delete').on('click',function(){
        if($(this).attr('available') !== undefined){
            $('#cinemaRoom-form').attr('action','/admin/cines/salas/desactivar');
        }
        else if($(this).attr('not-available') !== undefined){
            $('#cinemaRoom-form').attr('action','/admin/cines/salas/activar');
        }
    });

    //disable "comprar" button when the ticket quantity is 0
    if($('.ticket_qty').length > 0){
        $('.ticket_qty').on('change',function(){
            var button = $(this).closest('.show-tickets--container').find('.pre-button button').first();

            if($(this).val() > 0){
                if($(button).hasClass('btn-secondary')){
                    $(button).removeClass('btn-secondary');
                    $(button).removeClass('button-disabled');
                    $(button).addClass('btn-danger');
                }
            }
            else{
                if($(button).hasClass('btn-danger')){
                    $(button).removeClass('btn-danger');
                    $(button).addClass('btn-secondary');
                    $(button).addClass('button-disabled');
                }
            }
        });
    }

    //listener to submit the form that contains the data for the purchase
    $('.pre-button').click(function(){
        var form = $(this).closest('.show-tickets--container').find('form').first();
        if($(form).find('.ticket_qty').first().val() > 0){
            $(form).submit();
        }
    });

    //give nav menu behaviour
    $(document).on('click',function(e){
        if(e.target.id === 'desktop__menu'){
            $('.some').toggleClass('open');
            $(".right-arrow").toggleClass("d-none");
        }
        else if($('.some').hasClass('open')){
            $('.some').removeClass('open');
            $(".right-arrow").toggleClass("d-none");
        }
    });

    //make body unscrollable when mobile menu deployed
    $('.sidebarIconToggle').on('click',function(){
        $('body').toggleClass('open');
    });

    //give show form endpoint behaviour on delete button click
    if($('#funcion-delete').length > 0){
        $('#funcion-delete').each(function(){
            if($(this).attr('available') == true){
                $(this).closest('.show-delete-form').attr('action','/admin/funciones/desactivar');
            }
            else{
                $(this).closest('.show-delete-form').attr('action','/admin/funciones/activar');
            }
        });

    }


    //show or hide user password listener
    if($('.user-detail__toggle-pass').length > 0){
        $('.user-detail__toggle-pass img').on('click',function(){
            var input = $(this).closest('label').find('.inputText').first();
            if($(this).hasClass('open')){
                $(this).removeClass('open');
                $(this).attr('src','/public/assets/images/eye.png');

                $(input).attr('type','password');
            }
            else{
                $(this).addClass('open');
                $(this).attr('src','/public/assets/images/slashed-eye.png');
                $(input).attr('type','text');
            }
        });
    }

    //change user form endpoint if erase button is confirmed clicked
    if($('#user-delete').length > 0){
        $('#user-delete').on('click',function(){
            if(confirm('Estas Seguro de querer eliminar el usuario?')){
                $('#user-detail-form').attr('action','/usuario/desactivar');
                $('#user-detail-form').submit();
            }
        });
    }

    //enable user detail form fields if user wants to update them, they are disabled by default
    if($('#user-update').length > 0){
        $('#user-update').on('click',function(){
            if($(this).hasClass('readyToSend')){
                $('#user-detail-form').submit();
            }
            else{
                $(this).text('Enviar');
                $(this).addClass('readyToSend');
                $('#user-detail-form input:not([type=hidden]):not(#user_email)').each(function(){
                    $(this).addClass('user-input__readyToSend');
                    $('.user-detail__toggle-pass img').css('background','white').css('border-radius','50%');
                    $(this).prop('disabled',false);
                });
            }
        });
    }


    if($('.movielist__filter--column').length > 0){
        $('form#genre-filter-form input, form#cinema-filter-form select,form#date-filter-form input').on('change',function(event){
            event.preventDefault();
            event.stopPropagation();
            var genreArray = $('#genre-filter-form input');
            var fGenreArray = [];

            genreArray.each(function(index,element){
                if($(element).is(':checked')){
                    fGenreArray.push($(element).val());
                }
            });


            if(fGenreArray.length == 0){
                fGenreArray = null;
            }
            var date = $('#date-filter-form input').val();
            var cinema = $('#cinema-filter-form select').val();

            var url = "/peliculas";

            if(fGenreArray || date || cinema){

                var first = true;
                if(fGenreArray){
                    url += "?";
                    url+= "genero=" + fGenreArray;
                    first = false;
                }
                if(date){
                    if(!first){
                        url+= "&";
                    }
                    else{
                        url+= "?";
                        first = false;
                    }
                    url+= "fecha=" + date;
                }
                if(cinema){
                    if(!first){
                        url+= "&";
                    }
                    else{
                        url+= "?";
                        first = false;
                    }
                    url+= "cine=" + cinema;
                }
            }

            history.pushState({ genre : fGenreArray , date : date , cinema : cinema}, "Peliculas", url );

            $('#movielist__movies--column').css('opacity','0.3');
            $('#movielist__movies--column').load( url +" #movies--inner-container",function(data){
              $('#movielist__movies--column').css('opacity','1.0');
              var newSlider = $(data).find('#movielist__movies--column');
              if(newSlider.find('.movie-item__container').length > 0){
                $('#movies__not-found-row').css('display','none');
              }
              else{
                $('#movies__not-found-row').css('display','table');
              }
              bindMoviesBehaviour();
            });

            return false;
        });
    }

});


//resizes dropdown size in case one line turns into two
$(window).resize(function(){
    if(($('.dropdown').length > 0)&&(!($('.dropdown').hasClass('movielist__filter--container')))){
        $('.dropdown').each(function(){
            var dropId = '#' + $(this).attr('id');
            if(!($(this).hasClass('movielist__filter--container'))){
                height = $(dropId + ' ul.dropdown-list li').outerHeight();
                $(dropId).height(height);
                $(dropId + ' .selLabel').height(height);
            }
            if($(dropId).hasClass('active')){
                var index = 1;
                var amountofSels = $(dropId + ' li').length + 1;
                var finale = (height * amountofSels) + 'px';
                $(dropId + '.dropdown:not(.height-non-mod)').css('height',finale);
                $(dropId + ' li').each(function(){
                    var amount = (height * index) + 'px' ;
                    $(this).css('transform','translateY(' + amount + ')');
                    index++;
                });
            }
        });
    }
});


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



//variables and functions to give behaviour to nav when scrolled, not handled
//by classes because the mobile nav is position fixed too, and they
//relocate on base on the other if both are position fixed when the page loads

if($('#nav').length > 0){
    window.onscroll = function() {headerReadapt();closeMenu();};
    var header = document.getElementById("nav");

    var sticky = header.offsetTop;
}


function headerReadapt() {
    if(header !== null){

        if (window.pageYOffset > sticky) {
            header.style.position = 'fixed';
            header.style.zIndex = '9999';
            header.style.width = '100%';
            header.style.top = 0;
            $('body').css('padding-top', $('#nav').innerHeight() + 'px');
        } else {
            $('body').css('padding-top', '0px');
            header.style.position = 'static';
            header.style.zIndex = 10;
        }
    }

}
//close the menu when the user scrolls
function closeMenu(){
    if($('.some').hasClass('open')){
        $('.some').toggleClass('open');
    }
}




function statisticsUpdate(){

    var movie = $('#chart-movies').val();
    var cinema = $('#chart-cinemas').val();
    var beginDate = ($('#chart-begin-date').val() === "") ? null : $('#chart-begin-date').val();
    var finalDate = ($('#chart-final-date').val() === "") ? null : $('#chart-final-date').val();
    var amount = $('#amount-btn').is(':checked');
    var tickets = $('#tickets-btn').is(':checked');
    var leftover = $('#leftover-btn').is(':checked');

    var values = {};

    values["movie"] = movie;
    values["cinema"] = cinema;
    values["beginDate"] = beginDate;
    values["finalDate"] = finalDate;
    values["amount"] = amount;
    values["tickets"] = tickets;
    values["leftover"] = leftover;

    $.ajax({
        url: "/admin/estadisticas",
        data : values,
        // method : 'POST',
        success : function(data){
          buildChart(data);
        },
        error : function(){
          $('#chart-container').html("<h1 style='text-align:center;'>No Results Found<h1>");
        }
    });

    buildChart();

}


function buildChart(data){
    //ejemplo a borrar cuando este hecho
    var data = {
        output : "tickets o monto",
        shows : [
            show1 = {
                name : "PELICULA 1 , SALA 1, 23/11/2019 - 21:00hs",
                value : 2000
            },
            show2 = {
                name : "PELICULA 2 , SALA 2, 24/12/2020 - 09:00hs",
                value : 500
            }
        ]
    }

    var ds = data["output"];
    var finalLabels = [];
    var d = [];
    data["shows"].forEach((element) => {
        finalLabels.push(element.name);
        d.push(element.value);
    });



    var bgColor = [];
    var borderColors = [];


    d.forEach(() => {
        bgColor.push(random_rgba());
    });


    bgColor.forEach((element,index) => {
        borderColors[index] = element.replace("0.2","1");
    });


    myChart.data.datasets.forEach((dataset) => {
        dataset.label = ds;
        dataset.backgroundColor = bgColor;
        dataset.borderColor = borderColors;
    });

    myChart.data.labels = finalLabels;

    myChart.data.datasets.forEach((dataset) => {
        dataset.data = d;
    });


    myChart.update();
}


function random_rgba() {
    var o = Math.round, r = Math.random, s = 255;
    return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ', 0.2)';
}

function bindMoviesBehaviour(){
    if($('.movielist__movies--column').length > 0){

        $('.movie-item__container').hover(function(){
            if($(window).outerWidth() > 768){
                var movieItems =  $('.movie-item__container').not(this);
                movieItems.each(function(index,element){
                    $(element).find('.movies__overlay').first().stop().fadeIn(200);
                });
                var infoId = "#" + $(this).attr('movieId');
                $(infoId).css('display','block');
                $('.movies__info-bar').css('display','flex');
            }
        },function(){
            if($(window).outerWidth() > 768){
                var movieItems =  $('.movie-item__container').not(this);
                movieItems.each(function(index,element){
                    $(element).find('.movies__overlay').first().stop().fadeOut(200);
                });
                var infoId = "#" + $(this).attr('movieId');
                $(infoId).css('display','none');
                $('.movies__info-bar').css('display','none');
            }
        });
    }
}
