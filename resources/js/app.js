/**
 * EcoCultures theme JavaScript.
 *
 * @package Ecocltr
 */

( function() {
    'use strict';

    /**
     * Initialize mobile navigation toggle.
     */
    function initMobileNav() {
        var mainNavigation = document.getElementById( 'primary-navigation' );
        var mainNavigationToggle = document.getElementById( 'primary-menu-toggle' );

        if ( mainNavigation && mainNavigationToggle ) {
            mainNavigationToggle.addEventListener( 'click', function( e ) {
                e.preventDefault();
                mainNavigation.classList.toggle( 'hidden' );

                // Update aria-expanded attribute.
                var isExpanded = ! mainNavigation.classList.contains( 'hidden' );
                mainNavigationToggle.setAttribute( 'aria-expanded', isExpanded );
            } );
        }
    }

    /**
     * Initialize FSLightbox for project galleries.
     * FSLightbox auto-initializes when loaded, but we ensure proper setup here.
     */
    function initLightbox() {
        // FSLightbox initializes automatically via data-fslightbox attributes.
        // This function can be used for any custom configuration if needed.
        if ( typeof refreshFsLightbox === 'function' ) {
            refreshFsLightbox();
        }
    }

    /**
     * DOM Ready handler.
     */
    function domReady() {
        initMobileNav();
        initLightbox();
    }

    // Initialize on DOMContentLoaded.
    if ( document.readyState === 'loading' ) {
        document.addEventListener( 'DOMContentLoaded', domReady );
    } else {
        domReady();
    }

} )();
