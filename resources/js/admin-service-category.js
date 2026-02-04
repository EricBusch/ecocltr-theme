/**
 * Convert Service Category checkboxes to radio buttons in Block Editor.
 *
 * @package Ecocltr
 */

( function( wp ) {
	'use strict';

	if ( ! wp || ! wp.data ) {
		return;
	}

	const { subscribe, select, dispatch } = wp.data;
	const { getEditedPostAttribute } = select( 'core/editor' );
	const { editPost } = dispatch( 'core/editor' );

	let previousCategories = [];

	// Subscribe to post changes.
	subscribe( function() {
		const postType = select( 'core/editor' ).getCurrentPostType();

		// Only run on service post type.
		if ( 'service' !== postType ) {
			return;
		}

		const categories = getEditedPostAttribute( 'service_category' ) || [];

		// If more than one category selected, keep only the most recent.
		if ( categories.length > 1 ) {
			const newCategory = categories.find( function( cat ) {
				return -1 === previousCategories.indexOf( cat );
			} );

			if ( newCategory ) {
				editPost( { service_category: [ newCategory ] } );
			}
		}

		previousCategories = categories;
	} );

	// Convert checkboxes to radio buttons in the UI.
	const convertCheckboxesToRadio = function() {
		const categoryPanel = document.querySelector( '.editor-post-taxonomies__hierarchical-terms-list[aria-label*="Categories"]' );

		if ( ! categoryPanel ) {
			return;
		}

		const checkboxes = categoryPanel.querySelectorAll( 'input[type="checkbox"]' );

		checkboxes.forEach( function( checkbox ) {
			if ( 'radio' !== checkbox.type ) {
				checkbox.type = 'radio';
				checkbox.name = 'service_category_radio';
			}
		} );
	};

	// Run conversion on load and on mutations.
	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', convertCheckboxesToRadio );
	} else {
		convertCheckboxesToRadio();
	}

	// Watch for DOM changes to catch dynamically loaded content.
	const observer = new MutationObserver( convertCheckboxesToRadio );
	observer.observe( document.body, {
		childList: true,
		subtree: true,
	} );

} )( window.wp );
