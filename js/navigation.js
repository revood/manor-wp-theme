( function() {

	var toggleButton  = document.getElementById( 'site-nav-toggle' ),
	    body          = document.body,
	    menuContainer = document.getElementById( toggleButton.getAttribute( 'aria-controls' ) );

	if ( ! menuContainer ) {
		return;
	}

	toggleButton.addEventListener( 'click', function( event ) {
		event.preventDefault();

		if ( 'true' === toggleButton.getAttribute( 'aria-expanded' ) ) {
			toggleButton.setAttribute( 'aria-expanded', 'false' );
			body.classList.remove( 'nav-toggled-on' );
		} else {
			toggleButton.setAttribute( 'aria-expanded', 'true' );
			body.classList.add( 'nav-toggled-on' );
		}
	});

	var itemsWithChildren = Array.prototype.slice.call( menuContainer.querySelectorAll( '.menu-item-has-children' ) );
	itemsWithChildren.forEach( function( menuItem ) {
		var subMenu = menuItem.querySelector( '.sub-menu' ),
			subMenuToggle = document.createElement( 'button' ),
			screenReaderText = document.createElement( 'span' );

		screenReaderText.className = 'screen-reader-text';
		screenReaderText.innerText = _btl10n.expand;

		subMenuToggle.className = 'dropdown-toggle';
		subMenuToggle.setAttribute( 'aria-expanded', 'false' );
		subMenuToggle.appendChild( screenReaderText );

		subMenuToggle.addEventListener( 'click', function( event ) {
			event.preventDefault();
			if ( 'true' === subMenuToggle.getAttribute( 'aria-expanded' ) ) {
				subMenuToggle.setAttribute( 'aria-expanded', 'false' );
				subMenu.classList.remove( 'toggled-on' );
				screenReaderText.innerText = _btl10n.expand;
			} else {
				subMenuToggle.setAttribute( 'aria-expanded', 'true' );
				subMenu.classList.add( 'toggled-on' );
				screenReaderText.innerText = _btl10n.collapse;
			}
		});

		menuItem.insertBefore( subMenuToggle, subMenu );
	});

})();
