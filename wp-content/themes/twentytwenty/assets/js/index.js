/*	-----------------------------------------------------------------------------------------------
	Namespace
--------------------------------------------------------------------------------------------------- */

var twentytwenty = twentytwenty || {};

// Set a default value for scrolled.
twentytwenty.scrolled = 0;

// polyfill closest
// https://developer.mozilla.org/en-US/docs/Web/API/Element/closest#Polyfill
if ( ! Element.prototype.closest ) {
	Element.prototype.closest = function( s ) {
		var el = this;

		do {
			if ( el.matches( s ) ) {
				return el;
			}

			el = el.parentElement || el.parentNode;
		} while ( el !== null && el.nodeType === 1 );

		return null;
	};
}

// polyfill forEach
// https://developer.mozilla.org/en-US/docs/Web/API/NodeList/forEach#Polyfill
if ( window.NodeList && ! NodeList.prototype.forEach ) {
	NodeList.prototype.forEach = function( callback, thisArg ) {
		var i;
		var len = this.length;

		thisArg = thisArg || window;

		for ( i = 0; i < len; i++ ) {
			callback.call( thisArg, this[ i ], i, this );
		}
	};
}

// event "polyfill"
twentytwenty.createEvent = function( eventName ) {
	var event;
	if ( typeof window.Event === 'function' ) {
		event = new Event( eventName );
	} else {
		event = document.createEvent( 'Event' );
		event.initEvent( eventName, true, false );
	}
	return event;
};

// matches "polyfill"
// https://developer.mozilla.org/es/docs/Web/API/Element/matches
if ( ! Element.prototype.matches ) {
	Element.prototype.matches =
		Element.prototype.matchesSelector ||
		Element.prototype.mozMatchesSelector ||
		Element.prototype.msMatchesSelector ||
		Element.prototype.oMatchesSelector ||
		Element.prototype.webkitMatchesSelector ||
		function( s ) {
			var matches = ( this.document || this.ownerDocument ).querySelectorAll( s ),
				i = matches.length;
			while ( --i >= 0 && matches.item( i ) !== this ) {}
			return i > -1;
		};
}

// Add a class to the body for when touch is enabled for browsers that don't support media queries
<<<<<<< HEAD
// for interaction media features. Adapted from <https://codepen.io/Ferie/pen/vQOMmO>.
=======
// for interaction media features. Adapted from <https://codepen.io/Ferie/pen/vQOMmO>
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
twentytwenty.touchEnabled = {

	init: function() {
		var matchMedia = function() {
<<<<<<< HEAD
			// Include the 'heartz' as a way to have a non-matching MQ to help terminate the join. See <https://git.io/vznFH>.
=======
			// Include the 'heartz' as a way to have a non matching MQ to help terminate the join. See <https://git.io/vznFH>.
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
			var prefixes = [ '-webkit-', '-moz-', '-o-', '-ms-' ];
			var query = [ '(', prefixes.join( 'touch-enabled),(' ), 'heartz', ')' ].join( '' );
			return window.matchMedia && window.matchMedia( query ).matches;
		};

		if ( ( 'ontouchstart' in window ) || ( window.DocumentTouch && document instanceof window.DocumentTouch ) || matchMedia() ) {
			document.body.classList.add( 'touch-enabled' );
		}
	}
}; // twentytwenty.touchEnabled

/*	-----------------------------------------------------------------------------------------------
	Cover Modals
--------------------------------------------------------------------------------------------------- */

twentytwenty.coverModals = {

	init: function() {
		if ( document.querySelector( '.cover-modal' ) ) {
<<<<<<< HEAD
			// Handle cover modals when they're toggled.
			this.onToggle();

			// When toggled, untoggle if visitor clicks on the wrapping element of the modal.
			this.outsideUntoggle();

			// Close on escape key press.
			this.closeOnEscape();

			// Hide and show modals before and after their animations have played out.
=======
			// Handle cover modals when they're toggled
			this.onToggle();

			// When toggled, untoggle if visitor clicks on the wrapping element of the modal
			this.outsideUntoggle();

			// Close on escape key press
			this.closeOnEscape();

			// Hide and show modals before and after their animations have played out
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
			this.hideAndShowModals();
		}
	},

<<<<<<< HEAD
	// Handle cover modals when they're toggled.
=======
	// Handle cover modals when they're toggled
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
	onToggle: function() {
		document.querySelectorAll( '.cover-modal' ).forEach( function( element ) {
			element.addEventListener( 'toggled', function( event ) {
				var modal = event.target,
					body = document.body;

				if ( modal.classList.contains( 'active' ) ) {
					body.classList.add( 'showing-modal' );
				} else {
					body.classList.remove( 'showing-modal' );
					body.classList.add( 'hiding-modal' );

<<<<<<< HEAD
					// Remove the hiding class after a delay, when animations have been run.
=======
					// Remove the hiding class after a delay, when animations have been run
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
					setTimeout( function() {
						body.classList.remove( 'hiding-modal' );
					}, 500 );
				}
			} );
		} );
	},

<<<<<<< HEAD
	// Close modal on outside click.
=======
	// Close modal on outside click
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
	outsideUntoggle: function() {
		document.addEventListener( 'click', function( event ) {
			var target = event.target;
			var modal = document.querySelector( '.cover-modal.active' );

<<<<<<< HEAD
			// if target onclick is <a> with # within the href attribute
			if ( event.target.tagName.toLowerCase() === 'a' && event.target.hash.includes( '#' ) && modal !== null ) {
				// untoggle the modal
				this.untoggleModal( modal );
				// wait 550 and scroll to the anchor
				setTimeout( function() {
					var anchor = document.getElementById( event.target.hash.slice( 1 ) );
					anchor.scrollIntoView();
				}, 550 );
			}

=======
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
			if ( target === modal ) {
				this.untoggleModal( target );
			}
		}.bind( this ) );
	},

<<<<<<< HEAD
	// Close modal on escape key press.
=======
	// Close modal on escape key press
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
	closeOnEscape: function() {
		document.addEventListener( 'keydown', function( event ) {
			if ( event.keyCode === 27 ) {
				event.preventDefault();
				document.querySelectorAll( '.cover-modal.active' ).forEach( function( element ) {
					this.untoggleModal( element );
				}.bind( this ) );
			}
		}.bind( this ) );
	},

<<<<<<< HEAD
	// Hide and show modals before and after their animations have played out.
=======
	// Hide and show modals before and after their animations have played out
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
	hideAndShowModals: function() {
		var _doc = document,
			_win = window,
			modals = _doc.querySelectorAll( '.cover-modal' ),
			htmlStyle = _doc.documentElement.style,
			adminBar = _doc.querySelector( '#wpadminbar' );

		function getAdminBarHeight( negativeValue ) {
			var height,
				currentScroll = _win.pageYOffset;

			if ( adminBar ) {
				height = currentScroll + adminBar.getBoundingClientRect().height;

				return negativeValue ? -height : height;
			}

			return currentScroll === 0 ? 0 : -currentScroll;
		}

		function htmlStyles() {
			var overflow = _win.innerHeight > _doc.documentElement.getBoundingClientRect().height;

			return {
				'overflow-y': overflow ? 'hidden' : 'scroll',
				position: 'fixed',
				width: '100%',
				top: getAdminBarHeight( true ) + 'px',
				left: 0
			};
		}

<<<<<<< HEAD
		// Show the modal.
=======
		// Show the modal
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
		modals.forEach( function( modal ) {
			modal.addEventListener( 'toggle-target-before-inactive', function( event ) {
				var styles = htmlStyles(),
					offsetY = _win.pageYOffset,
					paddingTop = ( Math.abs( getAdminBarHeight() ) - offsetY ) + 'px',
					mQuery = _win.matchMedia( '(max-width: 600px)' );

				if ( event.target !== modal ) {
					return;
				}

				Object.keys( styles ).forEach( function( styleKey ) {
					htmlStyle.setProperty( styleKey, styles[ styleKey ] );
				} );

				_win.twentytwenty.scrolled = parseInt( styles.top, 10 );

				if ( adminBar ) {
					_doc.body.style.setProperty( 'padding-top', paddingTop );

					if ( mQuery.matches ) {
						if ( offsetY >= getAdminBarHeight() ) {
							modal.style.setProperty( 'top', 0 );
						} else {
							modal.style.setProperty( 'top', ( getAdminBarHeight() - offsetY ) + 'px' );
						}
					}
				}

				modal.classList.add( 'show-modal' );
			} );

<<<<<<< HEAD
			// Hide the modal after a delay, so animations have time to play out.
=======
			// Hide the modal after a delay, so animations have time to play out
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
			modal.addEventListener( 'toggle-target-after-inactive', function( event ) {
				if ( event.target !== modal ) {
					return;
				}

				setTimeout( function() {
					var clickedEl = twentytwenty.toggles.clickedEl;

					modal.classList.remove( 'show-modal' );

					Object.keys( htmlStyles() ).forEach( function( styleKey ) {
						htmlStyle.removeProperty( styleKey );
					} );

					if ( adminBar ) {
						_doc.body.style.removeProperty( 'padding-top' );
						modal.style.removeProperty( 'top' );
					}

					if ( clickedEl !== false ) {
						clickedEl.focus();
						clickedEl = false;
					}

					_win.scrollTo( 0, Math.abs( _win.twentytwenty.scrolled + getAdminBarHeight() ) );

					_win.twentytwenty.scrolled = 0;
				}, 500 );
			} );
		} );
	},

<<<<<<< HEAD
	// Untoggle a modal.
=======
	// Untoggle a modal
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
	untoggleModal: function( modal ) {
		var modalTargetClass,
			modalToggle = false;

<<<<<<< HEAD
		// If the modal has specified the string (ID or class) used by toggles to target it, untoggle the toggles with that target string.
		// The modal-target-string must match the string toggles use to target the modal.
=======
		// If the modal has specified the string (ID or class) used by toggles to target it, untoggle the toggles with that target string
		// The modal-target-string must match the string toggles use to target the modal
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
		if ( modal.dataset.modalTargetString ) {
			modalTargetClass = modal.dataset.modalTargetString;

			modalToggle = document.querySelector( '*[data-toggle-target="' + modalTargetClass + '"]' );
		}

<<<<<<< HEAD
		// If a modal toggle exists, trigger it so all of the toggle options are included.
		if ( modalToggle ) {
			modalToggle.click();

			// If one doesn't exist, just hide the modal.
=======
		// If a modal toggle exists, trigger it so all of the toggle options are included
		if ( modalToggle ) {
			modalToggle.click();

			// If one doesn't exist, just hide the modal
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
		} else {
			modal.classList.remove( 'active' );
		}
	}

}; // twentytwenty.coverModals

/*	-----------------------------------------------------------------------------------------------
	Intrinsic Ratio Embeds
--------------------------------------------------------------------------------------------------- */

twentytwenty.intrinsicRatioVideos = {

	init: function() {
		this.makeFit();

		window.addEventListener( 'resize', function() {
			this.makeFit();
		}.bind( this ) );
	},

	makeFit: function() {
		document.querySelectorAll( 'iframe, object, video' ).forEach( function( video ) {
			var ratio, iTargetWidth,
				container = video.parentNode;

<<<<<<< HEAD
			// Skip videos we want to ignore.
=======
			// Skip videos we want to ignore
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
			if ( video.classList.contains( 'intrinsic-ignore' ) || video.parentNode.classList.contains( 'intrinsic-ignore' ) ) {
				return true;
			}

			if ( ! video.dataset.origwidth ) {
<<<<<<< HEAD
				// Get the video element proportions.
=======
				// Get the video element proportions
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
				video.setAttribute( 'data-origwidth', video.width );
				video.setAttribute( 'data-origheight', video.height );
			}

			iTargetWidth = container.offsetWidth;

<<<<<<< HEAD
			// Get ratio from proportions.
			ratio = iTargetWidth / video.dataset.origwidth;

			// Scale based on ratio, thus retaining proportions.
=======
			// Get ratio from proportions
			ratio = iTargetWidth / video.dataset.origwidth;

			// Scale based on ratio, thus retaining proportions
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
			video.style.width = iTargetWidth + 'px';
			video.style.height = ( video.dataset.origheight * ratio ) + 'px';
		} );
	}

}; // twentytwenty.instrinsicRatioVideos

/*	-----------------------------------------------------------------------------------------------
	Modal Menu
--------------------------------------------------------------------------------------------------- */
twentytwenty.modalMenu = {

	init: function() {
<<<<<<< HEAD
		// If the current menu item is in a sub level, expand all the levels higher up on load.
=======
		// If the current menu item is in a sub level, expand all the levels higher up on load
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
		this.expandLevel();
		this.keepFocusInModal();
	},

	expandLevel: function() {
		var modalMenus = document.querySelectorAll( '.modal-menu' );

		modalMenus.forEach( function( modalMenu ) {
			var activeMenuItem = modalMenu.querySelector( '.current-menu-item' );

			if ( activeMenuItem ) {
				twentytwentyFindParents( activeMenuItem, 'li' ).forEach( function( element ) {
					var subMenuToggle = element.querySelector( '.sub-menu-toggle' );
					if ( subMenuToggle ) {
						twentytwenty.toggles.performToggle( subMenuToggle, true );
					}
				} );
			}
		} );
	},

	keepFocusInModal: function() {
		var _doc = document;

		_doc.addEventListener( 'keydown', function( event ) {
			var toggleTarget, modal, selectors, elements, menuType, bottomMenu, activeEl, lastEl, firstEl, tabKey, shiftKey,
				clickedEl = twentytwenty.toggles.clickedEl;

			if ( clickedEl && _doc.body.classList.contains( 'showing-modal' ) ) {
				toggleTarget = clickedEl.dataset.toggleTarget;
				selectors = 'input, a, button';
				modal = _doc.querySelector( toggleTarget );

				elements = modal.querySelectorAll( selectors );
				elements = Array.prototype.slice.call( elements );

				if ( '.menu-modal' === toggleTarget ) {
					menuType = window.matchMedia( '(min-width: 1000px)' ).matches;
					menuType = menuType ? '.expanded-menu' : '.mobile-menu';

					elements = elements.filter( function( element ) {
						return null !== element.closest( menuType ) && null !== element.offsetParent;
					} );

					elements.unshift( _doc.querySelector( '.close-nav-toggle' ) );

					bottomMenu = _doc.querySelector( '.menu-bottom > nav' );

					if ( bottomMenu ) {
						bottomMenu.querySelectorAll( selectors ).forEach( function( element ) {
							elements.push( element );
						} );
					}
				}

				lastEl = elements[ elements.length - 1 ];
				firstEl = elements[0];
				activeEl = _doc.activeElement;
				tabKey = event.keyCode === 9;
				shiftKey = event.shiftKey;

				if ( ! shiftKey && tabKey && lastEl === activeEl ) {
					event.preventDefault();
					firstEl.focus();
				}

				if ( shiftKey && tabKey && firstEl === activeEl ) {
					event.preventDefault();
					lastEl.focus();
				}
			}
		} );
	}
}; // twentytwenty.modalMenu

/*	-----------------------------------------------------------------------------------------------
	Primary Menu
--------------------------------------------------------------------------------------------------- */

twentytwenty.primaryMenu = {

	init: function() {
		this.focusMenuWithChildren();
	},

	// The focusMenuWithChildren() function implements Keyboard Navigation in the Primary Menu
	// by adding the '.focus' class to all 'li.menu-item-has-children' when the focus is on the 'a' element.
	focusMenuWithChildren: function() {
		// Get all the link elements within the primary menu.
		var links, i, len,
			menu = document.querySelector( '.primary-menu-wrapper' );

		if ( ! menu ) {
			return false;
		}

		links = menu.getElementsByTagName( 'a' );

		// Each time a menu link is focused or blurred, toggle focus.
		for ( i = 0, len = links.length; i < len; i++ ) {
			links[i].addEventListener( 'focus', toggleFocus, true );
			links[i].addEventListener( 'blur', toggleFocus, true );
		}

		//Sets or removes the .focus class on an element.
		function toggleFocus() {
			var self = this;

			// Move up through the ancestors of the current link until we hit .primary-menu.
			while ( -1 === self.className.indexOf( 'primary-menu' ) ) {
				// On li elements toggle the class .focus.
				if ( 'li' === self.tagName.toLowerCase() ) {
					if ( -1 !== self.className.indexOf( 'focus' ) ) {
						self.className = self.className.replace( ' focus', '' );
					} else {
						self.className += ' focus';
					}
				}
				self = self.parentElement;
			}
		}
	}
}; // twentytwenty.primaryMenu

/*	-----------------------------------------------------------------------------------------------
	Toggles
--------------------------------------------------------------------------------------------------- */

twentytwenty.toggles = {

	clickedEl: false,

	init: function() {
<<<<<<< HEAD
		// Do the toggle.
		this.toggle();

		// Check for toggle/untoggle on resize.
		this.resizeCheck();

		// Check for untoggle on escape key press.
=======
		// Do the toggle
		this.toggle();

		// Check for toggle/untoggle on resize
		this.resizeCheck();

		// Check for untoggle on escape key press
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
		this.untoggleOnEscapeKeyPress();
	},

	performToggle: function( element, instantly ) {
		var target, timeOutTime, classToToggle,
			self = this,
			_doc = document,
<<<<<<< HEAD
			// Get our targets.
=======
			// Get our targets
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
			toggle = element,
			targetString = toggle.dataset.toggleTarget,
			activeClass = 'active';

<<<<<<< HEAD
		// Elements to focus after modals are closed.
=======
		// Elements to focus after modals are closed
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
		if ( ! _doc.querySelectorAll( '.show-modal' ).length ) {
			self.clickedEl = _doc.activeElement;
		}

		if ( targetString === 'next' ) {
			target = toggle.nextSibling;
		} else {
			target = _doc.querySelector( targetString );
		}

<<<<<<< HEAD
		// Trigger events on the toggle targets before they are toggled.
=======
		// Trigger events on the toggle targets before they are toggled
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
		if ( target.classList.contains( activeClass ) ) {
			target.dispatchEvent( twentytwenty.createEvent( 'toggle-target-before-active' ) );
		} else {
			target.dispatchEvent( twentytwenty.createEvent( 'toggle-target-before-inactive' ) );
		}

<<<<<<< HEAD
		// Get the class to toggle, if specified.
		classToToggle = toggle.dataset.classToToggle ? toggle.dataset.classToToggle : activeClass;

		// For cover modals, set a short timeout duration so the class animations have time to play out.
=======
		// Get the class to toggle, if specified
		classToToggle = toggle.dataset.classToToggle ? toggle.dataset.classToToggle : activeClass;

		// For cover modals, set a short timeout duration so the class animations have time to play out
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
		timeOutTime = 0;

		if ( target.classList.contains( 'cover-modal' ) ) {
			timeOutTime = 10;
		}

		setTimeout( function() {
			var focusElement,
				subMenued = target.classList.contains( 'sub-menu' ),
				newTarget = subMenued ? toggle.closest( '.menu-item' ).querySelector( '.sub-menu' ) : target,
				duration = toggle.dataset.toggleDuration;

<<<<<<< HEAD
			// Toggle the target of the clicked toggle.
=======
			// Toggle the target of the clicked toggle
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
			if ( toggle.dataset.toggleType === 'slidetoggle' && ! instantly && duration !== '0' ) {
				twentytwentyMenuToggle( newTarget, duration );
			} else {
				newTarget.classList.toggle( classToToggle );
			}

<<<<<<< HEAD
			// If the toggle target is 'next', only give the clicked toggle the active class.
=======
			// If the toggle target is 'next', only give the clicked toggle the active class
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
			if ( targetString === 'next' ) {
				toggle.classList.toggle( activeClass );
			} else if ( target.classList.contains( 'sub-menu' ) ) {
				toggle.classList.toggle( activeClass );
			} else {
<<<<<<< HEAD
				// If not, toggle all toggles with this toggle target.
				_doc.querySelector( '*[data-toggle-target="' + targetString + '"]' ).classList.toggle( activeClass );
			}

			// Toggle aria-expanded on the toggle.
=======
				// If not, toggle all toggles with this toggle target
				_doc.querySelector( '*[data-toggle-target="' + targetString + '"]' ).classList.toggle( activeClass );
			}

			// Toggle aria-expanded on the toggle
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
			twentytwentyToggleAttribute( toggle, 'aria-expanded', 'true', 'false' );

			if ( self.clickedEl && -1 !== toggle.getAttribute( 'class' ).indexOf( 'close-' ) ) {
				twentytwentyToggleAttribute( self.clickedEl, 'aria-expanded', 'true', 'false' );
			}

<<<<<<< HEAD
			// Toggle body class.
=======
			// Toggle body class
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
			if ( toggle.dataset.toggleBodyClass ) {
				_doc.body.classList.toggle( toggle.dataset.toggleBodyClass );
			}

<<<<<<< HEAD
			// Check whether to set focus.
=======
			// Check whether to set focus
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
			if ( toggle.dataset.setFocus ) {
				focusElement = _doc.querySelector( toggle.dataset.setFocus );

				if ( focusElement ) {
					if ( target.classList.contains( activeClass ) ) {
						focusElement.focus();
					} else {
						focusElement.blur();
					}
				}
			}

<<<<<<< HEAD
			// Trigger the toggled event on the toggle target.
			target.dispatchEvent( twentytwenty.createEvent( 'toggled' ) );

			// Trigger events on the toggle targets after they are toggled.
=======
			// Trigger the toggled event on the toggle target
			target.dispatchEvent( twentytwenty.createEvent( 'toggled' ) );

			// Trigger events on the toggle targets after they are toggled
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
			if ( target.classList.contains( activeClass ) ) {
				target.dispatchEvent( twentytwenty.createEvent( 'toggle-target-after-active' ) );
			} else {
				target.dispatchEvent( twentytwenty.createEvent( 'toggle-target-after-inactive' ) );
			}
		}, timeOutTime );
	},

<<<<<<< HEAD
	// Do the toggle.
=======
	// Do the toggle
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
	toggle: function() {
		var self = this;

		document.querySelectorAll( '*[data-toggle-target]' ).forEach( function( element ) {
			element.addEventListener( 'click', function( event ) {
				event.preventDefault();
				self.performToggle( element );
			} );
		} );
	},

<<<<<<< HEAD
	// Check for toggle/untoggle on screen resize.
=======
	// Check for toggle/untoggle on screen resize
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
	resizeCheck: function() {
		if ( document.querySelectorAll( '*[data-untoggle-above], *[data-untoggle-below], *[data-toggle-above], *[data-toggle-below]' ).length ) {
			window.addEventListener( 'resize', function() {
				var winWidth = window.innerWidth,
					toggles = document.querySelectorAll( '.toggle' );

				toggles.forEach( function( toggle ) {
					var unToggleAbove = toggle.dataset.untoggleAbove,
						unToggleBelow = toggle.dataset.untoggleBelow,
						toggleAbove = toggle.dataset.toggleAbove,
						toggleBelow = toggle.dataset.toggleBelow;

<<<<<<< HEAD
					// If no width comparison is set, continue.
=======
					// If no width comparison is set, continue
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
					if ( ! unToggleAbove && ! unToggleBelow && ! toggleAbove && ! toggleBelow ) {
						return;
					}

<<<<<<< HEAD
					// If the toggle width comparison is true, toggle the toggle.
=======
					// If the toggle width comparison is true, toggle the toggle
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
					if (
						( ( ( unToggleAbove && winWidth > unToggleAbove ) ||
							( unToggleBelow && winWidth < unToggleBelow ) ) &&
							toggle.classList.contains( 'active' ) ) ||
						( ( ( toggleAbove && winWidth > toggleAbove ) ||
							( toggleBelow && winWidth < toggleBelow ) ) &&
							! toggle.classList.contains( 'active' ) )
					) {
						toggle.click();
					}
				} );
			} );
		}
	},

<<<<<<< HEAD
	// Close toggle on escape key press.
=======
	// Close toggle on escape key press
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
	untoggleOnEscapeKeyPress: function() {
		document.addEventListener( 'keyup', function( event ) {
			if ( event.key === 'Escape' ) {
				document.querySelectorAll( '*[data-untoggle-on-escape].active' ).forEach( function( element ) {
					if ( element.classList.contains( 'active' ) ) {
						element.click();
					}
				} );
			}
		} );
	}

}; // twentytwenty.toggles

/**
<<<<<<< HEAD
 * Is the DOM ready?
 *
 * This implementation is coming from https://gomakethings.com/a-native-javascript-equivalent-of-jquerys-ready-method/
 *
 * @since Twenty Twenty 1.0
=======
 * Is the DOM ready
 *
 * this implementation is coming from https://gomakethings.com/a-native-javascript-equivalent-of-jquerys-ready-method/
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
 *
 * @param {Function} fn Callback function to run.
 */
function twentytwentyDomReady( fn ) {
	if ( typeof fn !== 'function' ) {
		return;
	}

	if ( document.readyState === 'interactive' || document.readyState === 'complete' ) {
		return fn();
	}

	document.addEventListener( 'DOMContentLoaded', fn, false );
}

twentytwentyDomReady( function() {
<<<<<<< HEAD
	twentytwenty.toggles.init();              // Handle toggles.
	twentytwenty.coverModals.init();          // Handle cover modals.
	twentytwenty.intrinsicRatioVideos.init(); // Retain aspect ratio of videos on window resize.
	twentytwenty.modalMenu.init();            // Modal Menu.
	twentytwenty.primaryMenu.init();          // Primary Menu.
	twentytwenty.touchEnabled.init();         // Add class to body if device is touch-enabled.
=======
	twentytwenty.toggles.init();	// Handle toggles
	twentytwenty.coverModals.init();	// Handle cover modals
	twentytwenty.intrinsicRatioVideos.init();	// Retain aspect ratio of videos on window resize
	twentytwenty.modalMenu.init();	// Modal Menu
	twentytwenty.primaryMenu.init();	// Primary Menu
	twentytwenty.touchEnabled.init();	// Add class to body if device is touch-enabled
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
} );

/*	-----------------------------------------------------------------------------------------------
	Helper functions
--------------------------------------------------------------------------------------------------- */

/* Toggle an attribute ----------------------- */

function twentytwentyToggleAttribute( element, attribute, trueVal, falseVal ) {
<<<<<<< HEAD
	if ( element.classList.contains( 'close-search-toggle' ) ) {
		return;
	}
=======
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
	if ( trueVal === undefined ) {
		trueVal = true;
	}
	if ( falseVal === undefined ) {
		falseVal = false;
	}
	if ( element.getAttribute( attribute ) !== trueVal ) {
		element.setAttribute( attribute, trueVal );
	} else {
		element.setAttribute( attribute, falseVal );
	}
}

/**
 * Toggle a menu item on or off.
 *
<<<<<<< HEAD
 * @since Twenty Twenty 1.0
 *
=======
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
 * @param {HTMLElement} target
 * @param {number} duration
 */
function twentytwentyMenuToggle( target, duration ) {
	var initialParentHeight, finalParentHeight, menu, menuItems, transitionListener,
		initialPositions = [],
		finalPositions = [];

	if ( ! target ) {
		return;
	}

	menu = target.closest( '.menu-wrapper' );

	// Step 1: look at the initial positions of every menu item.
	menuItems = menu.querySelectorAll( '.menu-item' );

	menuItems.forEach( function( menuItem, index ) {
		initialPositions[ index ] = { x: menuItem.offsetLeft, y: menuItem.offsetTop };
	} );
	initialParentHeight = target.parentElement.offsetHeight;

	target.classList.add( 'toggling-target' );

	// Step 2: toggle target menu item and look at the final positions of every menu item.
	target.classList.toggle( 'active' );

	menuItems.forEach( function( menuItem, index ) {
		finalPositions[ index ] = { x: menuItem.offsetLeft, y: menuItem.offsetTop };
	} );
	finalParentHeight = target.parentElement.offsetHeight;

	// Step 3: close target menu item again.
	// The whole process happens without giving the browser a chance to render, so it's invisible.
	target.classList.toggle( 'active' );

<<<<<<< HEAD
	/*
	 * Step 4: prepare animation.
	 * Position all the items with absolute offsets, at the same starting position.
	 * Shouldn't result in any visual changes if done right.
	 */
=======
	// Step 4: prepare animation.
	// Position all the items with absolute offsets, at the same starting position.
	// Shouldn't result in any visual changes if done right.
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
	menu.classList.add( 'is-toggling' );
	target.classList.toggle( 'active' );
	menuItems.forEach( function( menuItem, index ) {
		var initialPosition = initialPositions[ index ];
		if ( initialPosition.y === 0 && menuItem.parentElement === target ) {
			initialPosition.y = initialParentHeight;
		}
		menuItem.style.transform = 'translate(' + initialPosition.x + 'px, ' + initialPosition.y + 'px)';
	} );

<<<<<<< HEAD
	/*
	 * The double rAF is unfortunately needed, since we're toggling CSS classes, and
	 * the only way to ensure layout completion here across browsers is to wait twice.
	 * This just delays the start of the animation by 2 frames and is thus not an issue.
	 */
	requestAnimationFrame( function() {
		requestAnimationFrame( function() {
			/*
			 * Step 5: start animation by moving everything to final position.
			 * All the layout work has already happened, while we were preparing for the animation.
			 * The animation now runs entirely in CSS, using cheap CSS properties (opacity and transform)
			 * that don't trigger the layout or paint stages.
			 */
=======
	// The double rAF is unfortunately needed, since we're toggling CSS classes, and
	// the only way to ensure layout completion here across browsers is to wait twice.
	// This just delays the start of the animation by 2 frames and is thus not an issue.
	requestAnimationFrame( function() {
		requestAnimationFrame( function() {
			// Step 5: start animation by moving everything to final position.
			// All the layout work has already happened, while we were preparing for the animation.
			// The animation now runs entirely in CSS, using cheap CSS properties (opacity and transform)
			// that don't trigger the layout or paint stages.
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
			menu.classList.add( 'is-animating' );
			menuItems.forEach( function( menuItem, index ) {
				var finalPosition = finalPositions[ index ];
				if ( finalPosition.y === 0 && menuItem.parentElement === target ) {
					finalPosition.y = finalParentHeight;
				}
				if ( duration !== undefined ) {
					menuItem.style.transitionDuration = duration + 'ms';
				}
				menuItem.style.transform = 'translate(' + finalPosition.x + 'px, ' + finalPosition.y + 'px)';
			} );
			if ( duration !== undefined ) {
				target.style.transitionDuration = duration + 'ms';
			}
		} );

		// Step 6: finish toggling.
		// Remove all transient classes when the animation ends.
		transitionListener = function() {
			menu.classList.remove( 'is-animating' );
			menu.classList.remove( 'is-toggling' );
			target.classList.remove( 'toggling-target' );
			menuItems.forEach( function( menuItem ) {
				menuItem.style.transform = '';
				menuItem.style.transitionDuration = '';
			} );
			target.style.transitionDuration = '';
			target.removeEventListener( 'transitionend', transitionListener );
		};

		target.addEventListener( 'transitionend', transitionListener );
	} );
}

/**
<<<<<<< HEAD
 * Traverses the DOM up to find elements matching the query.
 *
 * @since Twenty Twenty 1.0
=======
 * traverses the DOM up to find elements matching the query
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
 *
 * @param {HTMLElement} target
 * @param {string} query
 * @return {NodeList} parents matching query
 */
function twentytwentyFindParents( target, query ) {
	var parents = [];

<<<<<<< HEAD
	// Recursively go up the DOM adding matches to the parents array.
=======
	// recursively go up the DOM adding matches to the parents array
>>>>>>> 4f5257590d2e7c22bdac7a915861fa8f02a12394
	function traverse( item ) {
		var parent = item.parentNode;
		if ( parent instanceof HTMLElement ) {
			if ( parent.matches( query ) ) {
				parents.push( parent );
			}
			traverse( parent );
		}
	}

	traverse( target );

	return parents;
}
