/**
 * Add any custom theme JavaScript to this file.
 */
( function ( document, $ ) {
	
	/**
	 * Add shrink class to header on scroll.
	 */
	$( window ).scroll( function () {
		var scroll = $( window ).scrollTop();
		var height = $( '.hero-section' ).outerHeight();
		var header = $( '.before-header' ).outerHeight();
		if ( scroll >= 40 ) {
			$( '.site-header' ).addClass( 'shrink' );
		} else {
			$( '.site-header' ).removeClass( 'shrink' );
		}
	} );

	/*
	 * Search form toggle.
	 */
	$( '.site-header .search-form' ).append( '<a href="javascript:document.getElementsByName(\"s\").focus()" class="search-toggle"></a>' );
	$( '.site-header .search-toggle' ).on( 'click', function () {
		$( this ).toggleClass( 'active' );
		$( '.nav-primary .menu-item' ).fadeToggle();
		$( '.site-header .search-form input[type="search"]' ).fadeToggle();
	} );

	/*
	 * Send icon button enews footer.
	 */
	$( '.site-footer .enews form' ).append( '<span class="send-icon"></span>' );

	/*
	 * Move before header into nav on mobile.
	 */
	$( window ).on( "resize", function () {
		if ( $( window ).width() < 896 ) {
			$( '.before-header' ).appendTo( '.nav-primary .menu' );
		} else {
			$( '.before-header' ).prependTo( '.site-header' );
			$( '.nav-primary .menu .before-header' ).remove();
		}
	} ).resize();

	/*
	 * Object fit fallback
	 */
	jQuery( document ).ready( function ( $ ) {
		if ( !Modernizr.objectfit ) {
			$( '.front-page-9' ).each( function () {
				var $container = $( this ),
					imgUrl = $container.find( 'img' ).prop( 'src' );
				if ( imgUrl ) {
					$container.css( 'backgroundImage', 'url(' + imgUrl + ')' ).addClass( 'no-object-fit' );
				}
				$container.find( 'img' ).css( 'display', 'none' );
			} );
		}
	} );

	/*
	 * Logo slider.
	 */
	jQuery( document ).ready( function ( $ ) {
		$( '.front-page-2 .gallery' ).slick( {
			dots: false,
			infinite: true,
			speed: 1000,
			arrows: false,
			autoplay: true,
			autoplaySpeed: 5000,
			fade: false,
			slidesToShow: 2,
			slidesToScroll: 1,
			mobileFirst: true,
			responsive: [ {
				breakpoint: 384,
				settings: {
					slidesToShow: 3,
				}
			}, {
				breakpoint: 768,
				settings: {
					slidesToShow: 4,
				}
			}, {
				breakpoint: 896,
				settings: {
					slidesToShow: 5,
				}
			}, {
				breakpoint: 1152,
				settings: {
					slidesToShow: 6,
				}
			} ]
		} )
	} );

	/**
	 * Smooth scrolling.
	 */

	 // Select all links with hashes
	$( 'a[href*="#"]' )

	// Remove links that don't actually link to anything
		.not( '[href="#"]' ).not( '[href="#0"]' )

		// Remove WooCommerce tabs
		.not( '[href*="#tab-"]' ).click( function ( event ) {

			// On-page links
			if ( location.pathname.replace( /^\//, '' ) == this.pathname.replace( /^\//, '' ) && location.hostname == this.hostname ) {

				// Figure out element to scroll to
				var target = $( this.hash );
				target = target.length ? target : $( '[name=' + this.hash.slice( 1 ) + ']' );

				// Does a scroll target exist?
				if ( target.length ) {

					// Only prevent default if animation is actually gonna happen
					event.preventDefault();
					$( 'html, body' ).animate( {
						scrollTop: target.offset().top
					}, 1000, function () {

						// Callback after animation, must change focus!
						var $target = $( target );
						$target.focus();

						// Checking if the target was focused
						if ( $target.is( ":focus" ) ) {

							return false;
						} else {

							// Adding tabindex for elements not focusable
							$target.attr( 'tabindex', '-1' );

							// Set focus again
							$target.focus();
						};
					} );
				}
			}
		} );
} )( document, jQuery );

