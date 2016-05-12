$(function() {

    /* testimonial script starts here */
    $('.owl-carousel').owlCarousel({
        autoHeight:true,
        animateOut: 'slideOutDown',
        animateIn: 'zoomIn',
        items:1,
        margin:30,
        stagePadding:30,
        smartSpeed:450
    });
    /* testimonial script end here */


    /* csr script starts here */
    var owl1 = $('.owl-carousel-csr1');
    var owl2 = $('.owl-carousel-csr2');


    owl1.owlCarousel({
        autoHeight:true,
        items:1,
        smartSpeed:450
    });

    owl2.owlCarousel({
        autoHeight:true,
        animateOut: 'slideOutDown',
        animateIn: 'zoomIn',
        items:1,
        nav: true,
        dots: false,
        navText: [
          "<i class='fa fa-chevron-left tcolor'></i>",
          "<i class='fa fa-chevron-right tcolor'></i>",
          ]
    });

    owl2.on('changed.owl.carousel', function(property) {
        var current = property.item.index;
        owl1.trigger('to.owl.carousel', current);
    });



    $('.milestone-year').bind('mousewheel', function() {
         return false
    });

    var owl = $('.milestone-year');

    owl.owlCarousel({
        loop:true,
        dots: false,
        center: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1200:{
                items:7
            }
        }
    });
    owl.on('mousewheel', '.owl-stage', function (e) {
        if (e.deltaY>0) {
            owl.trigger('next.owl');
        } else {
            owl.trigger('prev.owl');
        }
        e.preventDefault();
    });
    owl.on('translate.owl.carousel', function(e){
        idx = e.item.index;
        $('.owl-item.big').removeClass('big');
        $('.owl-item.medium').removeClass('medium');
        $('.owl-item').eq(idx).addClass('big');
        $('.owl-item').eq(idx-1).addClass('medium');
        $('.owl-item').eq(idx+1).addClass('medium');
    });

    owl.on('changed.owl.carousel', function(e) {
        idx = e.item.index;
        var $value = $('.owl-item').eq(idx).find('h4').text();
        $(".milestone-content .item").css({"display":"none"});
        $(".milestone-"+$value).fadeIn();
    });

    /* get started script starts here */
    $('#back-to-top').bind('click', function(event) {
        var $anchor = $(this);
        $('body, html').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
    $('#started').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('point')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
    /* get started script ends here */

    /* arrow navigation starts here */
    $('.navigates').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
        scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
    /* arrow navigation ends here */

    /* nav transition starts here */
    jQuery(document).scroll(function () {
        var position = jQuery(document).scrollTop();
        var headerHeight = jQuery('#banner').outerHeight();

        if (position >= headerHeight - 300 ){
            jQuery('#back-to-top').addClass('moved');
        } else {
            jQuery('#back-to-top').removeClass('moved');
        }
    });
    /* nav transition ends here */


    /* blog img transition starts here */
    $( ".blog-holder" )
        .mouseenter(function() {
        $( this ).find( "p" ).removeClass("zoomOut").addClass("bounceIn display");
    })
        .mouseleave(function() {
        $( this ).find( "p" ).removeClass("bounceIn").addClass("zoomOut");
    });
    /* blog img transition ends here */

    /* paginates starts here */
    jQuery(function($) {
        // Grab whatever we need to paginate
        var pageParts = $(".content-holder");

        // How many parts do we have?
        var numPages = pageParts.length;
        // How many parts do we want per page?
        var perPage = 3;

        // When the document loads we're on page 1
        // So to start with... hide everything else
        pageParts.slice(perPage).hide();
        // Apply simplePagination to our placeholder
        $("#page-nav").pagination({
            items: numPages,
            itemsOnPage: perPage,
            prevText: 'PREV',
            nextText: 'NEXT',
            displayedPages: 3,
            // We implement the actual pagination
            //   in this next function. It runs on
            //   the event that a user changes page
            onPageClick: function(pageNum) {

                $("body").append('<div class="panel-disabled"><i class="ion-loading-c"></i></div>');
                var $pd = $("body").find('.panel-disabled');
                // Which page parts do we show?
                var start = perPage * (pageNum - 1);
                var end = start + perPage;

                // First hide all page parts
                // Then show those just for our page

                setTimeout(function () {
                    $pd.fadeOut('fast', function () {
                        $pd.remove();
                        pageParts.hide()
                         .slice(start, end).show();
                    });
                }, 500 + 300 * (Math.random() * 5));



            }
        });
    });
    /* paginates ends here */

    /* drives starts here */
    $('.drives a').bind('click', function(event) {
        var $anchor = $(this).attr('href');
        var $content_drives = $(".drives-content");
        var $content_list = $(".drives li");

        $content_list.removeClass("active").find("em").removeClass("fadeInRight animated").next().removeClass("fadeInRight animated");;
        $(this).parent().addClass("active").find("em").addClass("fadeInRight animated").next().addClass("fadeInRight animated");

        $($content_drives).css({"display":"none"});
        $($anchor).fadeIn("fast");

        event.preventDefault();
    });
    /* drives ends here */


    $('#trigger-overlay').click(function(){
<<<<<<< HEAD
        setTimeout(function(){
=======
        setTimeout(function(){ 
>>>>>>> 580f99df8172d1e20449c37652b533570e9d2464
            $('#anniv_video').fadeIn().get(0).play();
        }, 500);
    });
    $(".overlay-close").click(function(){
        $('#anniv_video').fadeOut();
<<<<<<< HEAD
        setTimeout(function(){

=======
        setTimeout(function(){ 
            
>>>>>>> 580f99df8172d1e20449c37652b533570e9d2464
            var video = document.getElementById('anniv_video');
                video.pause();
                video.currentTime = 0;
                video.load();
        }, 500);
    });

<<<<<<< HEAD
    $("#anniv_video").bind('ended', function(){
      $("#replay_button").fadeIn();
    });
    $("#anniv_video").bind('pause', function(){
      $("#play_button").show();
    });
    $("#anniv_video").bind('play', function(){
      $("#play_button").hide();
    });

    $("#replay_button").click(function(){
        $(this).fadeOut();
        setTimeout(function(){
=======
    $("#anniv_video").bind('ended', function(){ 
      $("#replay_button").fadeIn();
    });
    $("#anniv_video").bind('pause', function(){ 
      $("#play_button").show();
    });
    $("#anniv_video").bind('play', function(){ 
      $("#play_button").hide();
    });
    
    $("#replay_button").click(function(){
        $(this).fadeOut();
        setTimeout(function(){            
>>>>>>> 580f99df8172d1e20449c37652b533570e9d2464
            var video = document.getElementById('anniv_video');
                video.currentTime = 0;
                video.load();
                video.play();
        }, 500);
    });
    $("#play_button").click(function(){
        var video = document.getElementById('anniv_video');
<<<<<<< HEAD
        video.play();
    });

    $('video').click(function(){this.paused?this.play():this.pause();});

=======
        video.play();  
    });

    $('video').click(function(){this.paused?this.play():this.pause();});
    
>>>>>>> 580f99df8172d1e20449c37652b533570e9d2464
});



