(function ($, elementor) {
    'use strict';
    var HashElements = {

        init: function () {

            var widgets = {
                'he-carousel-module-one.default': HashElements.carousel,
                'he-ticker-module.default': HashElements.ticker,
                'square-plus-slider.default': HashElements.squareSlider,
                'square-plus-elastic-gallery.default': HashElements.squareElasticGallery,
                'square-plus-tab-block.default': HashElements.squareTab,
                'square-plus-logo-carousel.default': HashElements.squareLogoCarousel,
                'total-slider.default': HashElements.totalSlider,
                'total-service-block.default': HashElements.totalServices,
                'total-portfolio-masonary.default': HashElements.totalPortfolio,
                'total-counter-block.default': HashElements.totalCounter,
                'total-testimonial-slider.default': HashElements.totalTestimonialSlider,
                'total-logo-carousel.default': HashElements.totalLogoSlider
            };
            $.each(widgets, function (widget, callback) {
                elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
            });
        },
        ticker: function ($scope) {
            var $element = $scope.find('.he-ticker');
            if ($element.length > 0) {
                var params = JSON.parse($element.find('.owl-carousel').attr('data-params'));
                $element.find('.owl-carousel').owlCarousel({
                    items: 1,
                    margin: 10,
                    loop: true,
                    mouseDrag: false,
                    autoplay: params.autoplay,
                    autoplayTimeout: parseInt(params.pause) * 1000,
                    nav: true,
                    dots: false,
                    navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>']
                });
            }
        },
        carousel: function ($scope) {
            var $element = $scope.find('.he-carousel-block-wrap');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
                    loop: true,
                    autoplay: JSON.parse(params.autoplay),
                    autoplayTimeout: params.pause,
                    nav: JSON.parse(params.nav),
                    dots: JSON.parse(params.dots),
                    navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
                    responsive: {
                        0: {
                            items: params.items_mobile,
                            margin: params.margin_mobile,
                            stagePadding: params.stagepadding_mobile
                        },
                        580: {
                            items: params.items_tablet,
                            margin: params.margin_tablet,
                            stagePadding: params.stagepadding_tablet
                        },
                        860: {
                            items: params.items,
                            margin: params.margin,
                            stagePadding: params.stagepadding
                        }
                    }
                })
            }
        },
        squareLogoCarousel: function ($scope) {
            var $element = $scope.find('.he-client-logo-slider');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
                    autoplay: JSON.parse(params.autoplay),
                    loop: true,
                    nav: false,
                    dots: JSON.parse(params.dots),
                    autoplayTimeout: params.pause,
                    responsive: {
                        0: {
                            items: params.items_mobile,
                            margin: params.margin_mobile,
                        },
                        480: {
                            items: params.items_tablet,
                            margin: params.margin_tablet,
                        },
                        768: {
                            items: params.items,
                            margin: params.margin,
                        }
                    }
                });
            }
        },
        squareTab: function ($scope) {
            var $element = $scope.find('.he-tab-wrapper');
            if ($element.length > 0) {
                $element.find('.he-tab-pane:first').show();
                $element.find('.he-tab li:first').addClass('he-active');
                $element.find('.he-tab li a').on('click', function () {
                    var tab = $(this).attr('href');
                    $(this).closest('.he-tab-wrapper').find('.he-tab li').removeClass('he-active');
                    $(this).parent('li').addClass('he-active');
                    $(this).closest('.he-tab-wrapper').find('.he-tab-pane').hide();
                    $(this).closest('.he-tab-wrapper').find(tab).show();
                    return false;
                });
            }
        },
        squareElasticGallery: function ($scope) {
            var $id = $scope.data('id');
            var $element = $scope.find('#he-elasticstack-' + $id);
            if ($element.length > 0) {
                new ElastiStack(document.getElementById('he-elasticstack-' + $id), {
                    // distDragBack: if the user stops dragging the image in a area that does not exceed [distDragBack]px 
                    // for either x or y then the image goes back to the stack 
                    distDragBack: 200,
                    // distDragMax: if the user drags the image in a area that exceeds [distDragMax]px 
                    // for either x or y then the image moves away from the stack 
                    distDragMax: 450,
                    // callback
                    onUpdateStack: function (current) {
                        return false;
                    }
                });
            }
        },
        squareSlider: function ($scope) {
            var $element = $scope.find('.he-bx-slider');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
                    autoplay: JSON.parse(params.autoplay),
                    items: 1,
                    loop: true,
                    nav: JSON.parse(params.nav),
                    dots: false,
                    autoplayTimeout: params.pause,
                    animateOut: 'fadeOut',
                    navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>']
                });
            }
        },
        totalSlider: function ($scope) {
            var $element = $scope.find('.het-bx-slider');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
                    autoplay: JSON.parse(params.autoplay),
                    items: 1,
                    loop: true,
                    nav: JSON.parse(params.nav),
                    dots: JSON.parse(params.dots),
                    autoplayTimeout: params.pause,
                    animateOut: 'fadeOut',
                    navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>']
                });
            }
        },
        totalPortfolio: function ($scope) {
            var $element = $scope.find('.het-portfolio-container');
            var $id = $scope.data('id');

            //$element.find('.het-portfolio-image').nivoLightbox();

            if ($element.length > 0) {

                var active_tab = $element.find('.het-portfolio-cat-name-list').data('active');
                if ($element.find('.het-portfolio-cat-name[data-filter="' + active_tab + '"]').length == 0) {
                    var active_tab = $element.find('.het-portfolio-cat-name:first').data('filter');
                }

                $element.find('.het-portfolio-cat-name[data-filter="' + active_tab + '"]').addClass('active');

                var $container = $('.het-portfolio-posts-' + $id).imagesLoaded(function () {
                    $container.isotope({
                        itemSelector: '.het-portfolio',
                        filter: active_tab
                    });

                    HashSetMasonary($container);

                    $container.isotope({
                        itemSelector: '.het-portfolio',
                        filter: active_tab,
                    });

                    $(window).on('resize', function () {
                        HashGetMasonary($container);
                    }).resize();
                });

                $element.find('.het-portfolio-cat-name-list').on('click', '.het-portfolio-cat-name', function () {
                    var filterValue = $(this).attr('data-filter');
                    $container.isotope({filter: filterValue});

                    HashSetMasonary($container);
                    HashGetMasonary($container);

                    $container.isotope({filter: filterValue});

                    $element.find('.het-portfolio-cat-name').removeClass('active');
                    $(this).addClass('active');
                });
            }
        },
        totalLogoSlider: function ($scope) {
            var $element = $scope.find('.het-client-logo-slider');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
                    autoplay: JSON.parse(params.autoplay),
                    loop: true,
                    nav: false,
                    dots: JSON.parse(params.dots),
                    autoplayTimeout: params.pause,
                    navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
                    responsive: {
                        0: {
                            items: params.items_mobile,
                            margin: params.margin_mobile,
                        },
                        480: {
                            items: params.items_tablet,
                            margin: params.margin_tablet,
                        },
                        768: {
                            items: params.items,
                            margin: params.margin,
                        }
                    }
                });
            }
        },
        totalTestimonialSlider: function ($scope) {
            var $element = $scope.find('.het-testimonial-slider');
            if ($element.length > 0) {
                var params = JSON.parse($element.attr('data-params'));
                $element.owlCarousel({
                    items: 1,
                    autoplay: JSON.parse(params.autoplay),
                    loop: true,
                    nav: JSON.parse(params.nav),
                    dots: JSON.parse(params.dots),
                    autoplayTimeout: params.pause,
                    navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>']
                });
            }
        },
        totalCounter: function ($scope) {
            var $element = $scope.find('.het-counter');
            if ($element.length > 0) {
                $element.waypoint(function () {
                    var $odometer = $element.find('.odometer');
                    $odometer.html($odometer.data('count'));
                    this.destroy();
                }, {
                    offset: '90%',
                });
            }
        },
        totalServices: function ($scope) {
            $scope.find('.het-service-excerpt h5').click(function () {
                $(this).next('.het-service-text').slideToggle();
                $(this).parents('.het-service-post').toggleClass('het-active');
            });
            $scope.find('.het-service-icon').click(function () {
                $(this).next('.het-service-excerpt').find('.het-service-text').slideToggle();
                $(this).parent('.het-service-post').toggleClass('het-active');
            });
        },
    };
    $(window).on('elementor/frontend/init', HashElements.init);
}(jQuery, window.elementorFrontend));

function HashGetMasonary($container) {
    var winWidth = window.innerWidth;
    if (winWidth > 580) {
        $container.find('.het-portfolio').each(function () {
            var image_width = jQuery(this).find('img').width();
            if (jQuery(this).hasClass('wide')) {
                jQuery(this).find('.het-portfolio-wrap').css({
                    height: (image_width * 2) + 15 + 'px'
                });
            } else {
                jQuery(this).find('.het-portfolio-wrap').css({
                    height: image_width + 'px'
                });
            }
        });
    } else {
        $container.find('.het-portfolio').each(function () {
            var image_width = jQuery(this).find('img').width();
            jQuery(this).find('.het-portfolio-wrap').css({
                height: image_width + 'px'
            });
        });
    }
}

function HashSetMasonary($container) {
    var elems = $container.isotope('getFilteredItemElements');
    elems.forEach(function (item, index) {
        if (index == 0 || index == 4) {
            jQuery(item).addClass('wide');
            var bg = jQuery(item).find('.het-portfolio-image').attr('href');
            jQuery(item).find('.het-portfolio-wrap').css('background-image', 'url(' + bg + ')');
        } else {
            jQuery(item).removeClass('wide');
        }
    });
}
