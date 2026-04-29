/* Alpine Treatment Builder — Public JS */
/* jshint esversion: 6 */
jQuery( document ).ready( function ( $ ) {

	/* ----------------------------------------------------------------
	 * VH fix for mobile browsers
	 * -------------------------------------------------------------- */
	function setVh() {
		var vh = window.innerHeight * 0.01;
		document.documentElement.style.setProperty( '--llvcVh', vh + 'px' );
	}
	setVh();
	$( window ).on( 'resize', setVh );

	/* ----------------------------------------------------------------
	 * Step management
	 * -------------------------------------------------------------- */
	var currentStep = 1;
	var $steps      = $( '.llvc__step' );

	function changeFocus( direction ) {
		if ( direction === 'next' ) {
			$steps.each( function () {
				var step = $( this ).data( 'step' );
				if ( step === 'vc-' + currentStep )        this.inert = true;
				if ( step === 'vc-' + ( currentStep + 1 ) ) this.inert = false;
			} );
			currentStep++;
		} else if ( direction === 'prev' ) {
			$steps.each( function () {
				var step = $( this ).data( 'step' );
				if ( step === 'vc-' + currentStep )        this.inert = true;
				if ( step === 'vc-' + ( currentStep - 1 ) ) this.inert = false;
			} );
			currentStep--;
		}
	}

	function updateAlert( msg ) {
		$( '.llvc__alert' ).text( msg );
	}

	/* ----------------------------------------------------------------
	 * STEP 1 → STEP 2: Start consultation
	 * -------------------------------------------------------------- */
	$( document ).on( 'click', '.llvc__start-btn', function () {
		$( '.llvc__intro' ).removeClass( 'is-active' );
		$( '.llvc__concerns' ).addClass( 'is-active' );
		changeFocus( 'next' );
		$( '.llvc__how-to-use__toggle' ).trigger( 'focus' );
	} );

	/* ----------------------------------------------------------------
	 * Gender toggle
	 * -------------------------------------------------------------- */
	var totalSelections = 0;

	function switchGender() {
		var $btn = $( '.llvc__gender-choice' );
		$( '.llvc__body--female, .llvc__turn-female' ).toggleClass( 'is-active' );
		$( '.llvc__body--male,   .llvc__turn-male'   ).toggleClass( 'is-active' );
		if ( $btn.hasClass( 'is-switched' ) ) {
			$btn.find( '.llvc__gender-choice-text' ).text( 'Switch to Male' );
		} else {
			$btn.find( '.llvc__gender-choice-text' ).text( 'Switch to Female' );
		}
		$btn.toggleClass( 'is-switched' );
	}

	$( '.llvc__gender-choice' ).on( 'click', function () {
		if ( totalSelections > 0 ) {
			openPopup( '#llvc__popup--switch' );
		} else {
			switchGender();
		}
	} );

	// Confirmed switch
	$( '#llvc__popup--switch' ).on( 'click', '.llvc__popup__switch-genders', function () {
		clearAllConcerns();
		switchGender();
		closePopup( '#llvc__popup--switch' );
	} );

	/* ----------------------------------------------------------------
	 * Front / Back toggle (turn buttons)
	 * -------------------------------------------------------------- */
	$( '.llvc__turn.llvc__turn-female' ).on( 'click', function () {
		var $back = $( '.llvc__body__main.llvc__body__back--female' );
		var isBack = $back.hasClass( 'is-active' );
		if ( isBack ) {
			$( '.llvc__turn.llvc__turn-female .llvc__turn-text' ).text( 'View back concern areas' );
		} else {
			$( '.llvc__turn.llvc__turn-female .llvc__turn-text' ).text( 'View front concern areas' );
		}
		$( '.llvc__body__main.llvc__body__front--female, .llvc__body__main.llvc__body__back--female' ).toggleClass( 'is-active' );
		$( '.llvc__body--female .llvc__face-toggle, .llvc__body--female .llvc__mouth-toggle' ).toggleClass( 'is-back' );
	} );

	$( '.llvc__turn.llvc__turn-male' ).on( 'click', function () {
		var $back = $( '.llvc__body__main.llvc__body__back--male' );
		var isBack = $back.hasClass( 'is-active' );
		if ( isBack ) {
			$( '.llvc__turn.llvc__turn-male .llvc__turn-text' ).text( 'View back concern areas' );
		} else {
			$( '.llvc__turn.llvc__turn-male .llvc__turn-text' ).text( 'View front concern areas' );
		}
		$( '.llvc__body__main.llvc__body__front--male, .llvc__body__main.llvc__body__back--male' ).toggleClass( 'is-active' );
		$( '.llvc__body--male .llvc__face-toggle, .llvc__body--male .llvc__mouth-toggle' ).toggleClass( 'is-back' );
	} );

	/* ----------------------------------------------------------------
	 * Face / full body toggle
	 * -------------------------------------------------------------- */
	$( '.llvc__face-toggle' ).on( 'click', function () {
		$( '.llvc__body__main, .llvc__body__face, .llvc__turn, .llvc__face-toggle' ).toggleClass( 'is-showing-face' );
		if ( $( this ).hasClass( 'llvc__face-toggle--back' ) ) {
			$( '.llvc--concerns .llvc__body.is-active .llvc__face-toggle--main' ).trigger( 'focus' );
		} else {
			$( '.llvc__body__face.is-showing-face' ).trigger( 'focus' );
		}
	} );

	/* ----------------------------------------------------------------
	 * Concern area: open panel on hotspot click
	 * -------------------------------------------------------------- */
	$( document ).on( 'click', '.llvc__concern-area__circle', function () {
		var termId = $( this ).data( 'term-id' );
		openConcernPanel( termId );
	} );

	function openConcernPanel( termId ) {
		$( '.llvc__body-column' ).addClass( 'is-choosing' );
		$( '.llvc__concerns__main' ).removeClass( 'is-active' );
		$( '.llvc__concerns-column, .llvc__concerns__open-form' ).addClass( 'is-active is-concern' );
		$( '.llvc__body-column' ).get( 0 ).inert = true;

		var $panel = $( '.llvc__concerns__area[data-term-id="' + termId + '"]' );
		$( '.llvc__concerns__area' ).removeClass( 'is-active' );
		$panel.addClass( 'is-active' );
		$panel.find( '.llvc__all-concerns-toggle' ).trigger( 'focus' );

		// Update checkbox states to reflect already-chosen concerns
		$panel.find( 'input[type="checkbox"]' ).each( function () {
			var cid   = $( this ).attr( 'id' );
			var active = $( '.llvc__chosen-concern[data-term="' + cid + '"]' ).hasClass( 'is-active' );
			$( this ).prop( 'checked', active );
		} );
		updateAreaCount( $panel );
	}

	/* ----------------------------------------------------------------
	 * Concern area: back to selections (without saving)
	 * -------------------------------------------------------------- */
	$( document ).on( 'click', '.llvc__all-concerns-toggle', function () {
		var $panel  = $( this ).closest( '.llvc__concerns__area' );
		var termId  = $panel.data( 'term-id' );

		// Restore checkboxes to current selection state (discard changes)
		$panel.find( 'input[type="checkbox"]' ).each( function () {
			var cid   = $( this ).attr( 'id' );
			var active = $( '.llvc__chosen-concern[data-term="' + cid + '"]' ).hasClass( 'is-active' );
			$( this ).prop( 'checked', active );
		} );

		backToMainContent();
	} );

	function backToMainContent() {
		$( '.llvc__body-column' ).removeClass( 'is-choosing' );
		$( '.llvc__concerns__main' ).addClass( 'is-active' );
		$( '.llvc__concerns__area' ).removeClass( 'is-active' );
		$( '.llvc__body-column' ).get( 0 ).inert = false;

		if ( window.innerWidth <= 1024 ) {
			$( '.llvc__concerns-column, .llvc__concerns__open-form' ).removeClass( 'is-concern' );
		}
	}

	/* ----------------------------------------------------------------
	 * Concern area: add to treatment plan
	 * -------------------------------------------------------------- */
	$( document ).on( 'click', '.llvc__add-concerns', function () {
		var $panel = $( this ).closest( '.llvc__concerns__area' );

		$panel.find( 'input:checked' ).each( function () {
			$( '.llvc__chosen-concern[data-term="' + $( this ).attr( 'id' ) + '"]' ).addClass( 'is-active' );
		} );
		$panel.find( 'input:not(:checked)' ).each( function () {
			$( '.llvc__chosen-concern[data-term="' + $( this ).attr( 'id' ) + '"]' ).removeClass( 'is-active' );
		} );

		// Show / hide section headers
		$( '.llvc__chosen-concern-area' ).each( function () {
			var hasActive = $( this ).find( '.llvc__chosen-concern.is-active' ).length > 0;
			$( this ).toggle( hasActive );
		} );

		updateTotalSelections();
		backToMainContent();

		if ( window.innerWidth <= 1024 ) {
			$( '.llvc__concerns-column, .llvc__concerns__open-form' ).removeClass( 'is-concern' );
			$( '.llvc__concerns-chosen--container' ).addClass( 'is-open' );
			toggleEmptyMessage();
		}
	} );

	/* ----------------------------------------------------------------
	 * Concern area: live checkbox count update
	 * -------------------------------------------------------------- */
	$( document ).on( 'change', '.llvc__concerns__area.is-active input', function () {
		updateAreaCount( $( this ).closest( '.llvc__concerns__area' ) );
	} );

	function updateAreaCount( $panel ) {
		var count = $panel.find( 'input:checked' ).length;
		$panel.find( '.llvc__area-selections' ).text( count );
	}

	/* ----------------------------------------------------------------
	 * Remove individual concern from sidebar
	 * -------------------------------------------------------------- */
	$( document ).on( 'click', '.llvc__clear-concern', function () {
		var $item = $( this ).closest( '.llvc__chosen-concern' );
		var cid   = $item.data( 'term' );
		$item.removeClass( 'is-active' );
		$( '#' + cid ).prop( 'checked', false );

		// Hide section if empty
		var $section = $item.closest( '.llvc__chosen-concern-area' );
		if ( $section.find( '.llvc__chosen-concern.is-active' ).length === 0 ) {
			$section.hide();
		}

		updateTotalSelections();
		toggleEmptyMessage();
	} );

	/* ----------------------------------------------------------------
	 * Clear all
	 * -------------------------------------------------------------- */
	$( document ).on( 'click', '.llvc__concerns__clear', function () {
		clearAllConcerns();
	} );

	function clearAllConcerns() {
		$( '.llvc__concerns__area input' ).prop( 'checked', false );
		$( '.llvc__chosen-concern' ).removeClass( 'is-active' );
		$( '.llvc__chosen-concern-area' ).hide();
		updateTotalSelections();
		toggleEmptyMessage();
	}

	/* ----------------------------------------------------------------
	 * Totals and empty state
	 * -------------------------------------------------------------- */
	function updateTotalSelections() {
		totalSelections = $( '.llvc__chosen-concern.is-active' ).length;
		$( '.llvc__total-selections' ).text( '(' + totalSelections + ')' );

		if ( totalSelections > 0 ) {
			$( '.llvc__concerns__clear' ).show();
			$( '.llvc__concerns-list--empty' ).hide();
			$( '.llvc__finish-consultation' ).addClass( 'has-concerns' );
		} else {
			$( '.llvc__concerns__clear' ).hide();
			$( '.llvc__concerns-list--empty' ).show();
			$( '.llvc__finish-consultation' ).removeClass( 'has-concerns' );
		}
		toggleEmptyMessage();
	}

	function toggleEmptyMessage() {
		var hasAny = $( '.llvc__chosen-concern.is-active' ).length > 0;
		$( '.llvc__concerns-list--empty__instructions' ).toggle( ! hasAny );
	}

	/* ----------------------------------------------------------------
	 * Mobile: expand / collapse concerns panel
	 * -------------------------------------------------------------- */
	$( '.llvc__concerns__open-form' ).on( 'click', function () {
		var isOpen = $( this ).hasClass( 'is-active' );
		if ( isOpen ) {
			$( this ).attr( 'aria-expanded', false ).removeClass( 'is-active' );
			$( '.llvc__body-column' ).get( 0 ).inert = false;
			$( '.llvc__concerns-chosen--container' ).removeClass( 'is-open' );
			backToMainContent();
			if ( window.innerWidth <= 1023 ) {
				$( '.llvc__concerns-column, .llvc__concerns__open-form' ).removeClass( 'is-active is-concern' );
			}
		} else {
			$( '.llvc__body-column' ).get( 0 ).inert = true;
			$( this ).attr( 'aria-expanded', true ).addClass( 'is-active' );
			$( '.llvc__concerns-column' ).addClass( 'is-active' );
			$( '.llvc__concerns-chosen--container' ).addClass( 'is-open' );
		}
	} );

	$( '.llvc__select-more-concerns' ).on( 'click', function () {
		$( '.llvc__concerns__open-form' ).trigger( 'click' ).trigger( 'focus' );
	} );

	/* ----------------------------------------------------------------
	 * Desktop finish button (outside the form)
	 * -------------------------------------------------------------- */
	$( '#atb-finish-desktop' ).on( 'click', function () {
		$( '.llvc__concerns-form' ).trigger( 'submit' );
	} );

	/* ----------------------------------------------------------------
	 * STEP 2 → STEP 3: Finish / proceed to form
	 * -------------------------------------------------------------- */
	$( '.llvc__concerns-form' ).on( 'submit', function ( e ) {
		e.preventDefault();

		// Collect selected concerns
		var concerns = [];
		$( '.llvc__chosen-concern.is-active' ).each( function () {
			concerns.push( $( this ).text().trim().replace( /\s+/g, ' ' ) );
		} );

		// Close any open concern panel
		$( '.llvc__concerns__area.is-active .llvc__all-concerns-toggle' ).trigger( 'click' );

		// Pass concerns to Gravity Forms hidden field.
		// In your GF form, add a Hidden field type and set its CSS Class Name to: atb-concerns
		// GF places that class on the <li class="gfield …"> wrapper; the input is inside it.
		var concernsJson = JSON.stringify( concerns );
		$( '.llvc__form .gfield.atb-concerns input[type="hidden"]' ).val( concernsJson );
		// Fallback: also write to any visible atb-concerns input (future-proofing)
		$( '.llvc__form input.atb-concerns' ).val( concernsJson );

		// Advance to step 3
		changeFocus( 'next' );
		$( '.llvc__screen' ).toggleClass( 'is-active' );
		$( '.llvc-navbar__back' ).toggleClass( 'is-showing' );
		$( '.llvc__form-content' ).trigger( 'focus' );
		updateAlert( 'Your concerns have been submitted' );
	} );

	/* Back from step 3 */
	$( '.llvc-navbar__back' ).on( 'click', function () {
		changeFocus( 'prev' );
		$( '.llvc-navbar__back' ).toggleClass( 'is-showing' );
		$( '.llvc__screen' ).toggleClass( 'is-active' );
		$( '.llvc__how-to-use__toggle' ).trigger( 'focus' );
	} );

	/* ----------------------------------------------------------------
	 * STEP 3: Form submission is handled by Gravity Forms natively.
	 * Concerns JSON was already written into the GF hidden field
	 * (CSS class: atb-concerns) during the step 2 → 3 transition above.
	 * -------------------------------------------------------------- */

	/* ----------------------------------------------------------------
	 * Popups (generic open / close)
	 * -------------------------------------------------------------- */
	function openPopup( selector ) {
		$( selector ).addClass( 'is-active' );
		$( selector ).find( 'button, a' ).first().trigger( 'focus' );
	}

	function closePopup( selector ) {
		$( selector ).removeClass( 'is-active' );
	}

	// Exit popup: intercept the exit link
	$( document ).on( 'click', '.llvc-navbar__exit', function ( e ) {
		if ( currentStep > 1 ) {
			e.preventDefault();
			openPopup( '#llvc__popup--leaving' );
		}
	} );

	$( document ).on( 'click', '.llvc__popup-close', function () {
		closePopup( $( this ).closest( '.llvc__popup' ) );
	} );

	// Escape key closes open popup
	$( document ).on( 'keydown', function ( e ) {
		if ( e.key === 'Escape' ) {
			$( '.llvc__popup.is-active' ).each( function () {
				closePopup( $( this ) );
			} );
		}
	} );

	/* ----------------------------------------------------------------
	 * Tooltip: show label on button hover / focus
	 * -------------------------------------------------------------- */
	$( document ).on( 'mouseenter focus', '[data-ll-tooltip-trigger]', function () {
		$( this ).closest( '[data-ll-tooltip]' ).addClass( 'show-tooltip' );
	} ).on( 'mouseleave blur', '[data-ll-tooltip-trigger]', function () {
		$( this ).closest( '[data-ll-tooltip]' ).removeClass( 'show-tooltip' );
	} );

	/* ----------------------------------------------------------------
	 * How to use panel (modal)
	 * -------------------------------------------------------------- */
	$( '.llvc__how-to-use__toggle' ).on( 'click', function () {
		$( '.llvc__how-to-use' ).addClass( 'is-active' );
		$( '.llvc__how-to-use__close' ).trigger( 'focus' );
	} );

	$( '.llvc__how-to-use__close' ).on( 'click', function () {
		$( '.llvc__how-to-use' ).removeClass( 'is-active' );
		$( '.llvc__how-to-use__toggle' ).trigger( 'focus' );
	} );

} );
