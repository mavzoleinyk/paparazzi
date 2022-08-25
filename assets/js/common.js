
/**
 * Sticky navigation that sits on the right hand side of the page
 */
(function($){

	var navigation = $('[data-role=sticky-sidenav]');

	$(window).on('scroll', function(e){

		if($(window).scrollTop() > 0)
		{
			close_nav(navigation);
		}
		else
		{
			open_nav(navigation);
		}

		var offset = 200;

		$('[data-section]').each(function(){

			var self = $(this),
				self_height = self.height(),
				self_offset_top = self.offset().top - offset,
				self_offset_from_bottom = self.offset().top + self_height - offset,
				window_position = $(window).scrollTop(),
				this_section = self.data('section'),
				nav_control = navigation.find('[href="#' + this_section + '"]');

			if(self_offset_top < window_position && self_offset_from_bottom > window_position){
				nav_control.addClass('active');
			}
			else
			{
				nav_control.removeClass('active');
			}

		});

	});

	// Sticky nav hover
	navigation.hover(
		function(e){
			open_nav(navigation);
		},
		function(e){
			close_nav(navigation);
		}
	);

	// Sticky nav close
	function close_nav(navigation){
		if(navigation.css('right') == '0px')
		{
            var slideDistance = (0 - navigation.width()) + 33;

			navigation.animate({
				right: slideDistance
			}, 200);
		}
	}

	// Sticky nav open
	function open_nav(navigation){
		if(navigation.css('right') != '0px')
		{
			navigation.animate({
				right: '0px'
			}, 200);
		}
	}

})(jQuery);

(function($){

    affixContainerHeight();

    $(window).resize(function(){
       affixContainerHeight();
    });

    function affixContainerHeight(){
        var affixContainer = $('[data-role=affix-container]');

        if(affixContainer.length > 0)
        {
            affixContainer.each(function(){
                var self = $(this),
                    affix = self.find('[data-spy=affix]'),
                    height = affix.outerHeight();

                self.height(height);

            });
        }
    }

})(jQuery);

(function($){

    $(window).load(function(){

        $('[data-window-enable]').removeAttr('disabled');

    });


})(jQuery);


/**
 * @todo
 */
(function($){

	/**
	 * Scrolling
	 */
	$(document).on('click', '[data-scroller]', function(e){
		e.preventDefault();
		var self = $(this);
		chapter = $(self.data('scroller'));
		animateTo(chapter);
	});

	/**
	 * Clicking on an element in the sticky nav
	 */
	function animateTo(el){
		$('html, body').animate({
			scrollTop : $(el).offset().top - 80
		}, 200);
	}

	var setViewPortSizesID;
	// When the window changes size lets re-set the view port sizes
	$(window).resize(function() {
		clearTimeout(setViewPortSizesID);
		setViewPortSizesID = setTimeout(setViewPortSizes, 500);
	});

	// Run on page load
	setViewPortSizes();

	// Setup gallery on page load
	setupGallery();

	// When the window changes size lets re-set the view port sizes
	var resizeVeilID;
	$(window).resize(function() {
		clearTimeout(resizeVeilID);
		resizeVeilID = setTimeout(function(){
            var veils = $('[data-frame] .veil');

            veils.each(function(){
                var veil = $(this);

                resizeVeil(veil);

            });

        }, 500);
	});

	/**
	 * When re-sizing the vail sets re-adjust some of the vales
	 */
	function resizeVeil(veil) {

        var frame = veil.parent('[data-frame]'),
            framed = frame.find('[data-framed]'),
            frameViewport = frame.find('.jumbotron-viewport'),
            frameWidth = frame.innerWidth();

        //console.log(frameWidth);

        /** Reset the width and height */
		veil.width(frameWidth);
        frameViewport.width(frameWidth);
        veil.height('auto');
        frame.height('auto');
        frameViewport.height('auto');

        /** Set the height */

        var newHeight = framed.height();

        //console.log(newHeight);

        framed.height(newHeight);
        veil.height(newHeight);
        frame.animate({
            height: newHeight + 'px'
        }, 250);



	}

	/**1
	 * init the packages collapse functionality
	 */
	$('[package-extra-section]').collapse({
		toggle: false,
		hide: true
	});

	/**
	 * Data Frame module
	 * data-frame ~ the element that will be the frame. This needs to have a unique id as it's value
	 * data-framed ~ The portion of the target page to load
	 * data-bgcolor ~ The optional background colour of the veil (default is black)
	 * data-extender ~ The multiplier with which to increase the veil's height if needed - can pass multiplier number or two special variables (viewport (height of available viewport) | self (height of target)).
	 */

	$('[data-frame]').on('click','[data-target]', function(e) {

		var self = $(this),
			target = self.data('target'),
			frame = self.parents('[data-frame=' + target + ']'),
            targetOffset = frame.offset(),
			frameHeight = frame.height() + 90,
			frameWidth = frame.width(),
			content = ($(this)[0].dataset['content']),
            navBarHeight = $('#main-nav-wrapper .navbar-header').outerHeight(),
            rootUrl = '//' + location.hostname,
            version = '1.2';

		if(frame.is('[data-bgcolor]'))
		{
			var bgcolor = frame.data('bgcolor');
		}

		if(frame.is('[data-extender]'))
		{
			var extender = frame.data('extender');
		}

		var point = $.parseJSON(mouseTouchHandler(e, frame));

		// Fix issue with console error logs
		if(point === null)
			return;

		// Hide the packages extra section
		if(target !== 'proposals') {
			frame.append('<div class="veil veil-transparent loader loader-white" style="left: ' + point["x"] + 'px; top: ' + point["y"] + 'px"><a href="#" data-action="close-frame" class="btn-back"><i class="fa fa-times-circle"></i></a><div data-target="veil-content" class="content"></div></div>');
			//$('[package-extra-section]').collapse('hide');
		} else {
			frame.append('<div class="veil veil-white loader loader-black" style="left: ' + point["x"] + 'px; top: ' + point["y"] + 'px"><a href="#" data-action="close-frame" class="btn-back btn-carousel"><i class="fa fa-times-circle"></i></a><div data-target="veil-content" class="content"></div></div>');
		}

		var veil = frame.find('.veil'),
			veilContent = veil.find('[data-target=veil-content]'),
			veilClose = veil.find('[data-action="close-frame"]');

		if(typeof bgcolor != 'undefined')
		{
			veil.css({
			   'background-color': bgcolor
			});
		}

		veil.animate({
			'top': 0,
			'left': 0,
			'height': frameHeight,
			'width': frameWidth
		}, 200, function(){

			veilContent.load( content + " [data-framed]", function() {

                var framed = veilContent.find('[data-framed]'),
                    jumbotronViewport = veilContent.find('.jumbotron-viewport'),
                    jumbotronNav = framed.find('.navbar');

				// Reset the selection, if they click on a different image to load then we should clear it
				//clearSelection();

				// hide the loading gif
				veil.removeClass('loader');

				if(typeof extender != 'undefined')
				{
                    if(extender == 'viewport')
                    {
                        var windowHeight = $(window).height(),
                            addThisMobileDock = $('.at4m-dock');

                        if(addThisMobileDock.length > 0)
                        {
                            var addThisMobileDockHeight = addThisMobileDock.outerHeight();

                            windowHeight = windowHeight - addThisMobileDockHeight;
                        }
                        frameHeight = windowHeight - navBarHeight;
                    }
                    else if(extender = 'self')
                    {
                        var framedHeight = framed.outerHeight();
                        if(framedHeight > frameHeight)
                        {
                            frameHeight = framed.outerHeight();
                        }

                    }
                    else
                    {
                        frameHeight = frameHeight * parseFloat(extender);
                    }

				}

				frame.animate({
					height: frameHeight
				});

				veil.animate({
					height: frameHeight
				});

				framed.animate({
					'width': 'auto',
                    'height': 'auto'
				}, 100, function(){

					var jumbotronNavHeight = jumbotronNav.outerHeight();

					jumbotronViewport.css({
						'width': frameWidth,
						'height': frameHeight - jumbotronNavHeight
					});

					veilContent.hide().css({
						'visibility': 'visible'
					});
                    // console.log(frameHeight, veilContent.height());

                    /**
                     * Load the relevant styles/scripts from single pages
                     */

                    if(target != 'proposals')
                    {

                        $('<link/>', {
                            rel: 'stylesheet',
                            type: 'text/css',
                            href: rootUrl + '/plugins/woocommerce/assets/css/prettyPhoto.css'
                        }).appendTo('head');

                        var scripts = [
                            rootUrl + '/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js?version=' + version,
                            rootUrl + '/plugins/woocommerce/assets/js/prettyPhoto/jquery.prettyPhoto.min.js?version=' + version,
                            rootUrl + '/plugins/woocommerce/assets/js/prettyPhoto/jquery.prettyPhoto.init.min.js?version=' + version,
                            rootUrl + '/plugins/woocommerce/assets/js/frontend/single-product.min.js?version=' + version,
                            rootUrl + '/plugins/woocommerce/assets/js/frontend/woocommerce.min.js?version=' + version,
                            rootUrl + '/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js?version=' + version,
                            rootUrl + '/themes/paparazzi-proposals/assets/js/woocommerce/add-to-cart-variation.js?version=' + version,
                            //rootUrl + '/plugins/woocommerce/assets/js/frontend/add-to-cart-variation.min.js?version=' + version,
                            rootUrl + '/plugins/woocommerce/assets/js/accounting/accounting.min.js?version=' + version,
                            //rootUrl + '/plugins/woocommerce-product-addons/assets/js/quickview.min.js?version=' + version,
                            rootUrl + '/plugins/woocommerce-product-addons/assets/js/addons.min.js?version=' + version
                        ];

                        $.ajaxSetup({
                            cache: true
                        });

                        $.getScript(scripts, function() {

                            showContent(veilContent, veil);
                            var data = {
                                hitType: 'pageView',
                                page: location.pathname + 'virtual/veil' + content.replace(location.protocol, '').replace(location.host, '').replace('//', '')
                            };

                            maybe_log_google_analytics(data);
                        });

                    }
                    else
                    {

                        var scripts = [
                            '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-553a6394550eee79'
                        ];

                        $.getScript(scripts, function() {

                            framed.find('[data-toggle=tooltip]').tooltip({
                                container: 'body'
                            });

                            var popovers = framed.find('[data-toggle=popover]');

                            if(popovers.length > 0)
                            {
                                popovers.on('click', function(e){
                                    e.preventDefault();
                                });

                                popovers.popover({
                                    html: true,
                                    container: '[data-framed]'
                                });
                            }

                            activeStates();

                            setupGallery();

                            showContent(veilContent, veil);

                            var data = {
                                hitType: 'pageView',
                                page: location.pathname + 'virtual/veil' + content.replace(location.protocol, '').replace(location.host, '').replace('//', '')
                            };

                            maybe_log_google_analytics(data);

                        });

                    }

				});

                function showContent(veilContent, veil)
                {
                    veilContent.fadeIn(function(){
                        veil.animate({
                            'opacity': 1
                        }, 100, function(){
                            $('body').animate({
                                scrollTop: targetOffset.top - navBarHeight
                            });
                        });
                    });
                }


				// Display the close button as we have called it within the modal
				$('#close-proposal').css('display', 'block');

			});
		});

        /**
         * Clicking on the close button on the veil
         */
        veil.on('click', '[data-action=close-frame]', function(e){
            closeVeil(e, false);
        });

        /**
         * Handle add-ons
         */
        veil.on('click', '.product-addon input, .product-addon select', function(e){
            resizeVeil(veil);
        });

		/**
		 * Close the veil function
		 */
		function closeVeil(e, addedExtra) {
			e.preventDefault();
			veilContent.fadeOut(function(){
				veil.animate({
					'top': point['y'],
					'left': point['x'],
					'opacity': 0,
					'height': 0,
					'width': 0
				}, 250, function(){

					// set the data-frame back to auto height on close
					$('[data-frame]').css('height', 'auto');

					veil.remove();

					/**
					 * If we are looking at packages
					 */
					if(target !== 'proposals' && addedExtra === true) {

						// Hide the packages extra section
						//$('[package-extra-section]').collapse('show');

						// Scroll down the page to the extra's section
						//animateTo($('[package-extra-section]'));
					}


				});
			});
		}

	});


	function mouseTouchHandler(e, frame){

		if($(frame).offset() === undefined)
			return;

		var touch = e.originalEvent && e.originalEvent.touches && e.originalEvent.touches[0];
		e = touch || e;
		var offset = $(frame).offset(),
			x = e.pageX  - offset.left,
			y = e.pageY  - offset.top;

		var point = {
			x: x,
			y: y
		};

		return JSON.stringify(point);
	}

	// On the single proposal clicking on 'Album will open the image gallery'
	function setupGallery() {

        var gallery = $('[data-action=blueimp]');

		if(gallery !== null){

            gallery.on('click', function(event) {

                event = event || window.event;

                var target = event.target || event.srcElement,
                    link = target.src ? target.parentNode : target,
                    options = {index: link, event: event},
                    links = this.getElementsByClassName('image-gallery');

                blueimp.Gallery(links, options);

            });

		}
	}

	// Set the viewport sizes
	function setViewPortSizes(){

		/**
		 * Set the height
		 */
		var jumbotronViewport = $('.jumbotron-viewport');

		if(!jumbotronViewport.length)
			return;

		/**
		 * Find role="navigation" and add them all up
		 */
		var navBarHeight = 0;
		$('[role="navigation"]').each(function(key, val) {
			navBarHeight = navBarHeight + $(this).outerHeight();
		});

		var viewPortSize = $(window).height();

//		navBarHeight = navBarHeight + 20; // add 20px as the el has 10px padding top and 10px padding bottom

		var newHeight = viewPortSize - navBarHeight;

		jumbotronViewport.css('min-height', newHeight);

		/**
		 * Set the width if needed (single pages)
		 */
		var jumbotronSingle = $('.jumbotron-single');

		if(!jumbotronSingle.length)
			return;

		jumbotronViewport.css('min-width', jumbotronSingle.width());

	}

})(jQuery);

/**
 * Maybe send ga event if ga exists
 * @param data
 */
function maybe_log_google_analytics(data)
{
    if(typeof(ga) !== 'undefined')
    {
        ga('send', data);
    }
}


/**
 * GA event and virtual page view tracking
 * @author john@hutchhouse.com
 */
(function($){

	if (typeof(ga) != 'undefined')
	{
		$('body').on('click', '[data-track]', function(event) {

			var self = $(this),
				category = self.data('track').category,
				label = self.data('track').label,
				action = event.type;
			ga('send', 'event', category, label, action);

		});
	}

})(jQuery);


/**
 * Formidable event tracker
 * @author john@hutchhouse.com
 */
(function($)
{

    /*function frmThemeOverride_frmAfterSubmit(fin,p,errObj, object)
    {

        if (typeof(fin) == 'undefined')
        {
            console.log(object);
            var data = {
                hitType: 'pageView',
                page: location.pathname + 'virtual/form-submission/' + target
            };
            //ga('send', data);
        }
    }*/

})(jQuery);

/**
 * Show / Hide sections, re-usable function
 *
 *
 * Useage;
 *
 * 1) Put the data attribute around a group 'data-show-group'
 * 2) Create a section to display on a element 'data-show-section="popular"'
 * 3) Put the hide / show section on a section 'data-section="popular"'
 *
 * @author Peter Ingram <peter.ingram@hutchhouse.com>
 */
(function($){
	$('[data-show-section]').on('click', function(e) {
		var showSection = e.target.dataset['showSection'];
		// Remove the active class from all the parents
		($('[data-show-group]').find('[data-show-section]')).each(function( index ) {
			$(this).parent().removeClass('active');
		});
		// Hide all the data-sections within data-show-group
		($('[data-show-group]').find('[data-section]')).each(function( index ) {
			$(this).hide();
		});
		// Show the one we want
		$('[data-show-section='+showSection+']').parent().addClass('active');
		// Add active class to the nav tab we selected
		$('[data-section='+showSection+']').show();
	})
})(jQuery);

/**
 * Initialise bootstrap options
 */
(function($){

	$('[data-toggle="tab"]').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});

    $('[data-toggle=tooltip]').tooltip({
        container: 'body'
    });

    $('[data-toggle=popover]').popover({
        html: true,
        container: 'body'
    });

    $('.modal').on('shown.bs.modal', function () {
        var self = $(this),
            selfID = self.attr('id'),
            data = {
                hitType: 'pageView',
                page: location.pathname + 'virtual/modal/' + selfID
            };

        maybe_log_google_analytics(data);

    });

})(jQuery);

/**
 * Add arrows in the right places
 */
(function($){

    // On slider init
    $('[data-slider]').on('init reInit', function(slick){
        var self = $(this),
            dots = self.find('.slick-dots'),
            containerWidth = self.outerWidth(),
            next = self.find('.slick-next'),
            prev = self.find('.slick-prev'),
            dotsWidth = 0;

        dots.find('li').each(function(){
            var dot = $(this),
                dotWidth = dot.outerWidth();

            dotsWidth = dotsWidth + dotWidth;

        });

        //console.log(dotsWidth + ' ' + containerWidth);

        var offset = (containerWidth / 2) - (dotsWidth + 30);

        prev.css('left', offset + 'px');
        next.css('right', offset + 'px');

    });

})(jQuery);

/**
 * Sliders
 */
(function($){

	var sliders = $('[data-slider]');

	if(sliders.length > 0)
	{
		sliders.each(function(){

			var self = $(this),
				type = self.data('slider');

			if(type === 'proposals'){

				var slides = self.find('[data-slide]');


				if(slides.length === 1)
				{
					slidesToShowMD = 1;
				}
				else if(slides.length < 4)
				{
					slidesToShowMD = parseInt(slides.length - 1);
				}
				else
				{
					slidesToShowMD = 3;
				}

				slidesToShowSM = slidesToShowMD;

				if(slides.length > 2)
				{
					slidesToShowXS = 2;
				}
				else
				{
					slidesToShowXS = slidesToShowMD;
				}

				self.slick({
					arrows: true,
					dots: true,
					speed: 300,
					infinite: true,
                    initialSlide: 1,
					swipeToSlide: true,
					centerMode: true,
					slidesToShow: slidesToShowMD,
					slidesToScroll: 1,
					variableWidth: true,
					responsive: [
						{
							breakpoint: 1025,
							settings: {
								slidesToShow: slidesToShowSM,
								variableWidth: false
							}
						},
						{
							breakpoint: 769,
							settings: {
                                arrows: false,
                                dots: false,
								slidesToShow: slidesToShowXS,
								variableWidth: false
							}
						},
						{
							breakpoint: 481,
							settings: {
                                arrows: false,
                                dots: false,
								slidesToShow: 1,
                                initialSlide: 0,
								centerMode: true,
								variableWidth: false,
                                adaptiveHeight: true
							}
						}
					]

				});

			}
			else if(type == 'packages'){
				self.slick({
					arrows: true,
					speed: 300,
					dots: true,
					infinite: false,
					slidesToShow: 3,
					slidesToScroll: 1,
					adaptiveHeight: true,
					responsive: [
						{
							breakpoint: 1025,
							settings: {
								slidesToShow: 2
							}
						},
						{
							breakpoint: 769,
							settings: {
								arrows: false,
								slidesToShow: 2
							}
						},
						{
							breakpoint: 481,
							settings: {
								slidesToShow: 1
							}
						}
					]
				});

			}
		});
	}



})(jQuery);

/**
 * Google map functions
 *
 * @author Peter Ingram <peter.ingram@hutchhouse.com>
 */
(function($){

	/**
	 * Init google map
	 */
	function initialize(mapId) {

		var mapOptionsProvided = getMapOptions(mapId);

		var mapOptions = {
			center: {
				lat: Number(mapOptionsProvided.lat),
				lng: Number(mapOptionsProvided.lon)
			},
			zoom: Number(mapOptionsProvided.zoom),
			scrollwheel: false,
			streetViewControl: 0,
			overviewMapControl: 0,
			mapTypeControl: 0
		};

		// load the map
		var map = new google.maps.Map(document.getElementById(mapId), mapOptions);

        //Prevent pinterest from pinning map segments
        google.maps.event.addListener(map, 'tilesloaded', function() {
            $('#' + mapId).find('img').attr('nopin','nopin');
        });

        var infoWindow = new google.maps.InfoWindow({
            maxWidth: 250
        });

		/**
		 * Add each of the locations to the map
		 */
		for (var i = 0; i < mapOptionsProvided.pins.length; i++) {

			addLocations(mapOptionsProvided.pins[i], infoWindow, map);

        }

	}

    function addLocations(mapLocation, infoWindow, map){

        var marker = addMarker(mapLocation.title, mapLocation.lat,mapLocation.lon, map)

        google.maps.event.addListener(marker, 'click', function() {

            //console.log(mapLocation);

            var infoTitle = mapLocation.title,
                infoContent = mapLocation.desc,
                infoUrl = mapLocation.url;

            if(infoContent.length < 1)
            {
                infoContent = 'Paparazzi Proposals offer a full range of services in ' + infoTitle;
            }

            /**
             * Build the content string that will be displayed within the info box
             */
            var contentString = '<div id="content">'+
                '<div id="siteNotice">'+
                '</div>'+
                '<h4>Propose in '+infoTitle+'</h4>'+
                '<div id="bodyContent"><p>'+infoContent+'</p>'+
                '<p><a class="btn btn-sm btn-primary" href="'+infoUrl+'">Find out more</a></p>'+
                '</div>'+
                '</div>';

            infoWindow.setContent(contentString);

            infoWindow.open(map, marker);

        });
    }

	/**
	 * Add a location marker onto the map
	 *
	 * @author Peter Ingram <peter.ingram@hutchhouse.com>
	 *
	 * @param infoTitle - The title you wish to display
	 * @param infoContent - the content info you wish to display
	 * @param infoUrl - the URL to the page
	 * @param {Array} extrasArray - An array of Extra's available
	 * @param positionLng
	 * @param positionLat
	 * @param map - The map object itself
	 * @param currentCity - true or false, if true will use a diffrent color pin
     * @return Google maps marker
	 */
	function addMarker(infoTitle, positionLng, positionLat, map) {

		var pin = '';

		var position = new google.maps.LatLng(positionLng,positionLat);
		var marker = new google.maps.Marker({
			position: position,
			map: map,
			title: infoTitle,
			icon: pin
		});

		return marker;

	}

	/**
	 * From the map ID specified this function will select that dom EL then
	 * get the map options provided and return
	 */
	function getMapOptions(mapID) {
		var map = $('#'+mapID);
		var options = {
			lon: map.attr('map-lon'),
			lat: map.attr('map-lat'),
			zoom: map.attr('map-zoom'),
			pins: map.data('pins')
		};
		return options
	}

	// if the map is enabled on the page
	if($('#map-locations').length > 0){
		google.maps.event.addDomListener(window, 'load', initialize('map-locations'));
	}

})(jQuery);

/**
 * Equal Module
 */
(function($){

	$(window).load(function(){
        equalHeights('init');
	});

    // When the window changes size lets re-set the view port sizes
    var resizeVailID;
    $(window).resize(function(e) {
        clearTimeout(resizeVailID);
        setTimeout(function(){
            equalHeights('reInit');
        }, 250);
    });

    function equalHeights(event)
    {
        var equalParent = $('[data-equal]');

        if(!equalParent.length)
        {
            return;
        }

        equalParent.each(function(){
            var self =  $(this),
                dimension = self.data('equal'),
                group = self.find('[data-compare]');

            if(event == 'reInit')
            {
                group.removeAttr('style');
            }

            if(!group.length)
            {
                return;
            }
            equalElement(dimension, group);
        });
    }

})(jQuery);

/**
 * Equal an element's dimensions function
 * @param group
 */
function equalElement(dimension, group)
{
	var biggest = 0;

	group.each(function() {

		var self = jQuery(this);

		if(dimension == 'height')
		{
			var thisDimension = parseInt(self.outerHeight());
		}
		else if(dimension == 'width')
		{
			var thisDimension = parseInt(self.outerWidth());
		}

		self.siblings('[data-extra]').each(function(){

			var extra = jQuery(this);

			if(dimension == 'height')
			{
				var extraDimension = parseInt(extra.outerHeight());
			}
			else if(dimension == 'width')
			{
				var extraDimension = parseInt(extra.outerWidth());
			}

			thisDimension = thisDimension + extraDimension;

			//console.log('This is the extra: ' + extraDimension);
		});

		if(biggest < thisDimension) {
			biggest = thisDimension;
			group.not(self).attr('data-compare', '');
			self.attr('data-compare', 'biggest');

			//console.log('This is the biggest: ' + biggest);
		}

	});

	//console.log('This is the biggest: ' + biggest);

	if(dimension == 'height')
	{
		group.outerHeight(biggest);
	}
	else if(dimension == 'width')
	{
		group.outerWidth(biggest);
	}

}

(function($){

    $('body').on('added_to_cart', function(){
        $('[data-action="merchandise"] a.add_to_cart_button.added').attr('disabled', true);
    });

})(jQuery);

/**
 * Active state handler
 */
(function($){

    activeStates();

})(jQuery);

function activeStates()
{
    var activeStateContainer = jQuery('[data-role=active-states]');

    if(activeStateContainer.length > 0)
    {
        activeStateContainer.on('click', '[data-state]', function(){
            var self = jQuery(this),
                selfState = self.data('state');

            if(selfState == 'active')
            {
                return;
            }
            else
            {
                var currActive = activeStateContainer.find('[data-state=active]');
                currActive.attr('data-state', '');
                currActive.removeClass('active');

                self.attr('data-state', 'active');
                self.addClass('active');

            }
        });
    }
}


/**
 * Datepicker Module
 */
(function($){

    $('.datepicker').datepicker({
        startDate: '+1d'
    });

})(jQuery);

/**
 * Select link Module
 */
(function($){

    $('select[data-action=link]').on('change', function(){
        var self = $(this),
            target = self.val();

        if(target.length > 0)
        {
            window.location = target;
        }

    });

})(jQuery);

/**
 * Datepicker Module
 */
(function($){

    setDataOffsetTop();

    // When the window changes size lets re-set the view port sizes
    var dataOffsetTop;
    $(window).resize(function(e) {
        clearTimeout(dataOffsetTop);
        setTimeout(changeDataOffsetTop, 250);
    });

    function setDataOffsetTop()
    {
        var affix = $('[data-offset-top]');

        if(affix.length > 0)
        {
            affix.each(function(){
                var self = $(this),
                    parent = self.parent(),
                    uber = $('body').find('.navbar-uber:visible'),
                    uberHeight = uber.outerHeight();

                self.attr('data-offset-top', uberHeight);
            });
        }
    }

    function changeDataOffsetTop()
    {
        var affix = $('[data-offset-top]');

        if(affix.length > 0)
        {
            affix.each(function(){
                var self = $(this),
                    parent = self.parent(),
                    uber = $('body').find('.navbar-uber:visible'),
                    uberHeight = uber.outerHeight();

                self.data('bs.affix').options.offset.top = uberHeight;
            });
        }
    }

})(jQuery);

/**
 *  Adapt $.getScript to handle multiple scripts
 */

var getScript = jQuery.getScript;

jQuery.getScript = function( resources, callback ) {

    var length = resources.length,
        amountDone = 0;

    function nextScript()
    {
        if (amountDone === length)
        {
            callback && callback();
        }
        else
        {
            safleyGetScript(resources[amountDone]);
        }
    }

    function safleyGetScript(scriptName)
    {
        var deferred = getScript(scriptName);
        (function (deferred, scriptName)
        {
            deferred.fail(function(){
                safleyGetScript(scriptName);
            });
            deferred.done(function(){
                amountDone++;
                nextScript();
            });
        })(deferred, scriptName);
    }

    nextScript();
};