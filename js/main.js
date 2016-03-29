(function($) {
	"use strict";
	$(document).ready(function() {

        /*  [ Main Menu ]
         - - - - - - - - - - - - - - - - - - - - */
        $( '.sub-menu' ).each(function() {
            $( this ).parent().addClass( 'has-child' ).find( '> a' ).append( '<span class="arrow"></span>' );
        });
        $( '.main-menu .arrow' ).on( 'click', function(e) {
            e.preventDefault();
            $( this ).parents( 'li' ).find( '> .sub-menu' ).slideToggle( 'fast' );
        });
        $( '.mobile-menu' ).on( 'click', function() {
            $( this ).parent().toggleClass('open');
        });

        /*  [ Cart Header ]
         - - - - - - - - - - - - - - - - - - - - */
        $( '.cart-control' ).on( 'click', function(e) {
            e.preventDefault();
            $(".shop-cart-v2 .shop-item").toggleClass('open');
        });

        /*  [ Drop Down ]
         - - - - - - - - - - - - - - - - - - - - */
        $( '.dropdown' ).each(function() {
            var _this = $( this );
            $( this ).find('a').on( 'click', function(e) {
                e.preventDefault();
                $( this ).parents( 'body' ).find( '.dropdown' ).not( _this ).removeClass('open');
                $( _this ).toggleClass( 'open' );
                var value = $( this ).text();
                $( _this ).find( '> ul > li > a' ).text( value );
            });

            $( 'html' ).on( 'click', function(e) {
                if( $( e.target ).closest( '.dropdown.open' ).length == 0 ) {
                    $( '.dropdown' ).removeClass( 'open' );
                }
            });
        });
        

        /*  [ Popup ]
        - - - - - - - - - - - - - - - - - - - - */
        $( '.popup-close' ).on( 'click', function(e) {
            e.preventDefault();
            $("body").css("overflow", "scroll");
            $( this ).parents( '.popup' ).removeClass( 'popup-open' );
        });

        /*  [ Burger Menu ]
         - - - - - - - - - - - - - - - - - - - - */
        $( '.burger-control' ).on( 'click', function(e) {
            e.preventDefault();
            $( '#popup-burger' ).addClass( 'popup-open' );
        });

        /*  [ Search box ]
        - - - - - - - - - - - - - - - - - - - - - - */
        $( '.searchbox > .icon' ).on( 'click', function(e) {
            $( '.search-popup' ).addClass( 'popup-open' );
        });

        /*  [ Style Switch ]
        - - - - - - - - - - - - - - - - - - - - */
        $( '.style-switch a' ).on( 'click', function(e) {
            e.preventDefault();
            var style = $( this ).attr( 'data-view' );
            $( this ).parent().find('a').not( this ).removeClass('active');
            $( this ).addClass('active');
            $( this ).parents( '.site-content' ).find( '.products' ).removeClass( 'list grid' ).addClass( style );      
        });

        /*  [ Quickview ]
        - - - - - - - - - - - - - - - - - - - - */
        $( '.quick-view' ).on( 'click', function(e) {
            e.preventDefault();
            $("body").css("overflow","hidden");
            var target = $(this).attr("href");
            var _this = $( ''+target );
            $( _this ).addClass( 'popup-open' );

            var sync1 = $( _this ).find( '.p-preview .slider' );
            var sync2 = $( _this ).find( '.thumb-slider' );

            sync1.owlCarousel({
                singleItem: true,
                slideSpeed: 1000,
                navigation: false,
                pagination: false,
                afterAction: syncPosition,
                responsiveRefreshRate: 200,
            });

            sync2.owlCarousel({
                items: 4,
                itemsDesktop: [1199, 4],
                itemsDesktopSmall: [979, 4],
                itemsTablet: [768, 4],
                itemsMobile: [479, 3],
                pagination: false,
                navigation: true,
                navigationText: [
                    '<i class="fa fa-angle-left"></i>',
                    '<i class="fa fa-angle-right"></i>'
                ],
                responsiveRefreshRate: 100,
                afterInit: function (el) {
                    el.find(".owl-item").eq(0).addClass("synced");
                }
            });

            function syncPosition(el) {
                var current = this.currentItem;
                $( sync2 )
                    .find(".owl-item")
                    .removeClass("synced")
                    .eq(current)
                    .addClass("synced")
                if ($(".slider-images").data("owlCarousel") !== undefined) {
                    center(current)
                };
            }

            $( sync2 ).on("click", ".owl-item", function (e) {
                e.preventDefault();
                var number = $(this).data("owlItem");
                sync1.trigger("owl.goTo", number);
            });

            function center(number) {
                var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
                var num = number;
                var found = false;
                for (var i in sync2visible) {
                    if (num === sync2visible[i]) {
                        var found = true;
                    }
                }

                if (found === false) {
                    if (num > sync2visible[sync2visible.length - 1]) {
                        sync2.trigger("owl.goTo", num - sync2visible.length + 2)
                    } else {
                        if (num - 1 === -1) {
                            num = 0;
                        }
                        sync2.trigger("owl.goTo", num);
                    }
                } else if (num === sync2visible[sync2visible.length - 1]) {
                    sync2.trigger("owl.goTo", sync2visible[1])
                } else if (num === sync2visible[0]) {
                    sync2.trigger("owl.goTo", num - 1)
                }
            }
        });

        /*  [ jQuery Countdown ]
        - - - - - - - - - - - - - - - - - - - - */
        var endDate = 'November 15, 2016';
        $( '.countdown ul' ).countdown({
            date: endDate,
            render: function(data) {
                $(this.el).html(
                    '<li><span>' + this.leadingZeros(data.days, 2) + '</span> Days</li>'
                    + '<li><span>' + this.leadingZeros(data.hours, 2) + '</span>Hours</li>'
                    + '<li><span>' + this.leadingZeros(data.min, 2) + '</span>Mins</li>'
                    + '<li><span>' + this.leadingZeros(data.sec, 2) + '</span>Secs</li>'
                );
            }
        });        

        /*  [ prettyPhoto ]
        - - - - - - - - - - - - - - - - - - - - */
        $("a[data-gal^='prettyPhoto']").prettyPhoto({
            hook: 'data-gal',
            animation_speed:'normal',
            theme:'light_square',
            slideshow:3000,
            social_tools: false
        });

        /*  [ Toogle ]
        - - - - - - - - - - - - - - - - - - - - */
        $( '.toggle' ).each(function() {
            $( this ).find( '.toggle-controls li:first-child a' ).addClass('active');
            $( this ).find( '.toggle-content:first' ).show();

            $( this ).find('.toggle-controls li a').on( 'click', function(e) {
                e.preventDefault();
                var selector = $(this).attr('href');
                $(this).parent().parent().find('a').not(this).removeClass('active');
                $(this).addClass('active');
                $(this).parents('.toggle').find('.toggle-content').not(selector).slideUp(300);
                $(this).parents('.toggle').find(selector).slideDown(300);
            });
        });

        /*  [ Set Bottom Position Post Info ]
        - - - - - - - - - - - - - - - - - - - - */
        $( '.home-blogs .post' ).each(function() {
            var post_info = $( this ).find( '.post-info' );
            var post_desc = $( this ).find( '.post-desc' );
            post_info.css({
                bottom: - post_desc.outerHeight() - 40,
            });
        });

        /*  [ Add minus and plus number quantity ]
        - - - - - - - - - - - - - - - - - - - - */
        if( $( '.quantity' ).length > 0 ) {
            var form_cart = $( 'form .quantity' );
            form_cart.prepend( '<span class="minus"><i class="fa fa-minus-square-o"></i></span>' );
            form_cart.append( '<span class="plus"><i class="fa fa-plus-square-o"></i></span>' );

            var minus = form_cart.find( $( '.minus' ) );
            var plus  = form_cart.find( $( '.plus' ) );

            // minus.on( 'click', function(){
            //     var qty = $( this ).parent().find( '.qty' );
            //     if ( qty.val() <= 1 ) {
            //         qty.val( 1 );
            //     } else {
            //         qty.val( ( parseInt( qty.val(), 10 ) - 1 ) );
            //     }
            // });
            // plus.on( 'click', function(){
            //     var qty = $( this ).parent().find( '.qty' );
            //     //qty.val( ( parseInt( qty.val(), 10 ) + 1 ) );
            //     qty.attr("value", ( parseInt( qty.val(), 10 ) + 1 ) );
            // });
        }

        /*  [ Testimonials Slider ]
        - - - - - - - - - - - - - - - - - - - - */
        var testi1 = $(".testimonials-slider .testimonial-content");
        var testi2 = $(".testimonials-slider .testimonial-images");

        testi1.owlCarousel({
            singleItem: true,
            slideSpeed: 1000,
            navigation: false,
            pagination: false,
            afterAction: syncPosition,
            responsiveRefreshRate: 200,
        });

        testi2.owlCarousel({
            items: 5,
            itemsDesktop: [1199, 5],
            itemsDesktopSmall: [979, 5],
            itemsTablet: [768, 4],
            itemsMobile: [479, 3],
            pagination: false,
            navigation: false,
            responsiveRefreshRate: 100,
            afterInit: function (el) {
                el.find(".owl-item").eq(0).addClass("synced");
            }
        });

        function syncPosition(el) {
            var current = this.currentItem;
            $( testi2 )
                .find(".owl-item")
                .removeClass("synced")
                .eq(current)
                .addClass("synced")
            if ($(".slider-images").data("owlCarousel") !== undefined) {
                center(current)
            };
        }

        $( testi2 ).on("click", ".owl-item", function (e) {
            e.preventDefault();
            var number = $(this).data("owlItem");
            testi1.trigger("owl.goTo", number);
        });

        function center(number) {
            var testi2visible = testi2.data("owlCarousel").owl.visibleItems;
            var num = number;
            var found = false;
            for (var i in testi2visible) {
                if (num === testi2visible[i]) {
                    var found = true;
                }
            }

            if (found === false) {
                if (num > testi2visible[testi2visible.length - 1]) {
                    testi2.trigger("owl.goTo", num - testi2visible.length + 2)
                } else {
                    if (num - 1 === -1) {
                        num = 0;
                    }
                    testi2.trigger("owl.goTo", num);
                }
            } else if (num === testi2visible[testi2visible.length - 1]) {
                testi2.trigger("owl.goTo", testi2visible[1])
            } else if (num === testi2visible[0]) {
                testi2.trigger("owl.goTo", num - 1)
            }
        }

        /*  [ Single Product V1 Slider ]
        - - - - - - - - - - - - - - - - - - - - */
        var preview_carousel = $( '.product-detail .images .p-preview' );
        var thumb_carousel = $( '.product-detail .images .p-thumb' );
        preview_carousel.owlCarousel({
            singleItem: true,
            pagination: false,
            navigation: false,
            afterAction: function(){
                this.$owlItems.removeClass('active');
                this.$owlItems.eq(this.currentItem).addClass('active');
                thumb_carousel.find( 'li' ).removeClass( 'active' );
                thumb_carousel.find( 'li' ).eq(this.currentItem).addClass( 'active' );
            }
        });
        thumb_carousel.find( 'li a' ).each(function(index) {
            $( this ).on( 'click', function(e) {
                e.preventDefault();
                preview_carousel.trigger('owl.goTo', index);
            });
        });

        
        /*  [ Main Slider ]
        - - - - - - - - - - - - - - - - - - - - */
        $( '.main-slider .slider' ).owlCarousel({
            singleItem: true,
            pagination: true,
            navigation: false,
            afterAction: function(){
                this.$owlItems.removeClass('active');
                this.$owlItems.eq(this.currentItem).addClass('active');
            }
        });

        /*  [ Main Carousel Slider ]
        - - - - - - - - - - - - - - - - - - - - */
        $( '.main-carousel .slider' ).owlCarousel({
            items: 4,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [989, 2],
            itemsTablet: [767, 2],
            itemsMobile: [480, 1],
            pagination: false,
            navigation: false,
            afterAction: function(){
                this.$owlItems.removeClass('active');
                this.$owlItems.eq(this.currentItem).addClass('active');
            }
        });

        /*  [ Product Slider ]
        - - - - - - - - - - - - - - - - - - - - */
        $( '.product-slider' ).owlCarousel({
            items: 6,
            itemsDesktop: [1366, 4],
            itemsDesktopSmall: [990, 3],
            itemsTablet: [767, 2],
            itemsMobile: [480, 1],
            pagination: false,
            navigation: true,
            navigationText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
        });

        /*  [ Set Value Custom Rating ]
        - - - - - - - - - - - - - - - - - - - - */
        $( '.comment-form-rating a' ).each(function(index) {
            $( this ).on( 'click', function(e) {
                e.preventDefault();
                $( this ).parents( '.custom-rating' ).find( '.stars' ).css({
                    width: (index + 1) * 20 + '%'
                });
                $( this ).parents( '.comment-form-rating' ).find( 'input' ).val(index+1);
            });
        });

        /*  [ Partner Slider ]
        - - - - - - - - - - - - - - - - - - - - */
        $( '.partners-slider .slider' ).owlCarousel({
            items: 6,
            itemsDesktop: [1199, 6],
            itemsDesktopSmall: [979, 4],
            itemsTablet: [768, 3],
            itemsMobile: [479, 2],
            pagination: false,
            navigation: false,
            autoPlay: 5000
        });

        /*  [ Tabs ]
        - - - - - - - - - - - - - - - - - - - - */
        $( '.tabs-container' ).each(function() {
            $( this ).find( '.tabs li:first-child a' ).addClass('active');
            $( this ).find( '.tab-content:first' ).show();

            $( this ).find('.tabs li a').on( 'click' , function(e) {
                e.preventDefault();
                var selector = $(this).attr('href');
                $(this).parent().parent().find('a').not(this).removeClass('active');
                $(this).addClass('active');
                $(this).parents('.tabs-container').find('.tab-content').not(selector).slideUp(300);
                $(this).parents('.tabs-container').find(selector).slideDown(300);
            });
        });

        /*  [ Home 7 Slide Controls ]
        - - - - - - - - - - - - - - - - - - - - */
        var count = $( '.parallax-section li' ).length;
        $( '.parallax-count .count' ).html( '<em>1/</em>' + count );
        $( '.parallax-section li' ).each(function(index) {
            var pos = $( this ).offset().top + $( this ).outerHeight();
            var _this = $( this );
             $( window ).scroll(function(event) {
                if ( $( window ).scrollTop() >= $( _this ).offset().top ) {
                    $( '.parallax-count .count' ).html('<em>' + (index + 1) + '</em>' + '/' + count);
                };
            });
        });        
        $( '.parallax-count .prev' ).on( 'click', function(e) {
            e.preventDefault();
            var _index = parseInt($( '.parallax-count .count em' ).text(), 10) - 1;
            if(_index != 0){
                var _posPrev = $( '.parallax-section li' ).eq(_index-1).offset().top;
                $("html, body").animate({
                    scrollTop: _posPrev
                }, 500);
            }
        });
        $( '.parallax-count .next' ).on( 'click', function(e) {
            e.preventDefault();
            var _index = parseInt($( '.parallax-count .count em' ).text(), 10) - 1;
            if(_index < count){
                var _posNext = $( '.parallax-section li' ).eq(_index+1).offset().top;
                $("html, body").animate({
                    scrollTop: _posNext
                }, 500);
            }
        });

        /*  [ Back to top ]
        - - - - - - - - - - - - - - - - - - - - */
        $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('.back-to-top').addClass('show');
            } else {
                $('.back-to-top').removeClass('show');
            }
        });
        $('.back-to-top').on( 'click', function(e) {
            e.preventDefault();
            $("html, body").animate({
                scrollTop: 0
            }, 500);
        });

        /*  [ Animate Elements ]
         - - - - - - - - - - - - - - - - - - - - */
        var $animation_elements_in = $('.animation-element.fade-in');
        var $animation_elements_left = $('.animation-element.fade-left');
        var $animation_elements_right = $('.animation-element.fade-right');
        var $window = $(window);

        function check_if_in_view() {
            var window_height = $window.height();
            var window_top_position = $window.scrollTop();
            var window_bottom_position = (window_top_position + window_height);

            $.each($animation_elements_in, function() {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + element_height);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position+100) &&
                    (element_top_position <= window_bottom_position)) {
                    $element.addClass('animated fadeInUp');
                }
            });

            $.each($animation_elements_left, function() {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + element_height);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position+100) &&
                    (element_top_position <= window_bottom_position)) {
                    $element.addClass('animated fadeInLeft');
                }
            });

            $.each($animation_elements_right, function() {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + element_height);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position+100) &&
                    (element_top_position <= window_bottom_position)) {
                    $element.addClass('animated fadeInRight');
                }
            });
        }
        $window.on('scroll resize', check_if_in_view);
        $window.trigger('scroll');


        $( window ).load(function() {
            /*  [ Sticky Header ]
             - - - - - - - - - - - - - - - - - - - - */
            if( $( 'body.header2' ).length == 0 ) {
                $( '.site-header' ).sticky({ topSpacing: 0 });
                $( window ).resize(function(event) {
                    $( '.sticky-wrapper' ).css( 'height', $( '.site-header' ).height() );
                    $( '.site-header' ).css( 'width', '100%' );
                });
            }
            $( '.header-sticky' ).each(function() {
                function bg_header() {
                    if( $(window).scrollTop() > 65 ) {
                        $( 'body' ).addClass('sticky-bg');
                    } else {
                        $( 'body' ).removeClass('sticky-bg');
                    }
                }
                bg_header();
                $ (window ).scroll(function (event) {
                    bg_header();
                });
                $( window ).resize(function(event) {
                    bg_header();
                });
            });

            /*  [ Page loader ]
            - - - - - - - - - - - - - - - - - - - - */
            $( 'body' ).addClass( 'loaded' );
            setTimeout(function () {
                $('#pageloader').fadeOut();
            }, 500);
        });
	});


    var min_val = parseInt($('#filternow').attr("data-min"));

    var max_val = parseInt($('#filternow').attr("data-max"));
    if (!min_val) {
        min_val=0;
    }
    if (!max_val) {
        max_val=0;
    }
    $('#slider-range').slider({

        range: true,

        min: min_val,

        max: max_val,

        values: [min_val, max_val],

        slide: function (event, ui) {

            $('#amount').text('₹' + ui.values[0] + ' - ₹' + ui.values[1]);
            $('#filternow').attr("data-min",ui.values[0]);
            $('#filternow').attr("data-max",ui.values[1]);
        }

    });

    $('#amount').text('₹' + $('#slider-range').slider('values', 0) + ' - ₹' + $('#slider-range').slider('values', 1));
    $('#filternow').attr("data-min",$('#slider-range').slider('values', 0));
    $('#filternow').attr("data-max",$('#slider-range').slider('values', 1));
})(jQuery);