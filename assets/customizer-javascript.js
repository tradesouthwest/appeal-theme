(function($){
//"use strict";

	wp.customize( 'appeal_header_background_color_setting', function( value ) {
		value.bind( function( to ) {
            $( '.site-header' ).css( 'background', to );
		} );
	} );

})(jQuery);
 