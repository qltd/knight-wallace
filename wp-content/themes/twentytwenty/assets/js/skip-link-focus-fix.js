/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * This is the source file for what is minified in the twentytwenty_skip_link_focus_fix() PHP function.
 *
 * Learn more: https://git.io/vWdr2
<<<<<<< HEAD
 *
 * @since Twenty Twenty 1.0
=======
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
 */
( function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
}() );
