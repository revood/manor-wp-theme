( function( $ ) {

	var cssTemplate = _.template( _manorColorschemeCSS, {
		evaluate:    /<#([\s\S]+?)#>/g,
		interpolate: /\{\{\{([\s\S]+?)\}\}\}/g,
		escape:      /\{\{([^\}]+?)\}\}(?!\})/g,
	});

	function darkenColor( hex, percentage ) {
		var i, j, regexp, rgb, newHex = '#';

		if ( hex.length < 6 ) {
			rgb = hex.toLowerCase().match( /^#?([0-9a-f])([0-9a-f])([0-9a-f])$/ );
			rgb[1] += rgb[1];
			rgb[2] += rgb[2];
			rgb[3] += rgb[3];
		} else {
			rgb = hex.toLowerCase().match( /^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/ );
		}

		for ( i = 1; i <= 3; i++ ) {
			rgb[ i ] = parseInt( rgb[ i ], 16 );
			rgb[ i ] = Math.round( rgb[ i ] * ( 100 - ( percentage / 2 ) ) / 100 );
			j = rgb[ i ].toString( 16 );
			if ( j.length < 2 ) {
				j += '0';
			}
			newHex += j;
		}

		return newHex;
	}

	wp.customize( 'blogname', function( value ) {
		value.bind( function( to) {
			$( '.site-title a' ).text( to );
		});
	});

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to) {
			$( '.site-tagline' ).text( to );
		});
	});

	wp.customize( 'primary_color', function( value ) {
		value.bind( function( to ) {
			var style = $( '#manor-color-scheme-css' );

			if ( ! style.length ) {
				style = $( '<style type="text/css" id="manor-color-scheme-css"></style>' );
				$( 'head' ).append( style );
			}

			style.html( cssTemplate({
				primary_color: to,
				primary_color_dark: darkenColor( to, 15 ),
			}) );
		});
	});

})( jQuery );
