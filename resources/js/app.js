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
     * Initialize contact form validation and enhancement.
     */
    function initContactForm() {
        var contactForm = document.getElementById( 'contact-form' );

        if ( ! contactForm ) {
            return;
        }

        // Add real-time validation feedback.
        var inputs = contactForm.querySelectorAll( 'input[required], textarea[required]' );

        inputs.forEach( function( input ) {
            input.addEventListener( 'blur', function() {
                validateField( input );
            } );

            input.addEventListener( 'input', function() {
                if ( input.classList.contains( 'border-burgundy' ) ) {
                    validateField( input );
                }
            } );
        } );

        // Form submission handling.
        contactForm.addEventListener( 'submit', function( e ) {
            var isValid = true;

            inputs.forEach( function( input ) {
                if ( ! validateField( input ) ) {
                    isValid = false;
                }
            } );

            if ( ! isValid ) {
                e.preventDefault();
                // Focus on first invalid field.
                var firstInvalid = contactForm.querySelector( '.border-burgundy' );
                if ( firstInvalid ) {
                    firstInvalid.focus();
                }
            }
        } );
    }

    /**
     * Validate a single form field.
     *
     * @param {HTMLElement} field The field to validate.
     * @return {boolean} True if valid, false otherwise.
     */
    function validateField( field ) {
        var isValid = true;
        var errorMessage = '';

        // Check if required field is empty.
        if ( field.hasAttribute( 'required' ) && ! field.value.trim() ) {
            isValid = false;
            errorMessage = 'This field is required.';
        }

        // Email validation.
        if ( field.type === 'email' && field.value.trim() ) {
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if ( ! emailPattern.test( field.value ) ) {
                isValid = false;
                errorMessage = 'Please enter a valid email address.';
            }
        }

        // Update field styling and error message.
        if ( ! isValid ) {
            field.classList.add( 'border-burgundy' );
            field.classList.remove( 'border-dark/20' );
            showFieldError( field, errorMessage );
        } else {
            field.classList.remove( 'border-burgundy' );
            field.classList.add( 'border-dark/20' );
            removeFieldError( field );
        }

        return isValid;
    }

    /**
     * Show error message for a field.
     *
     * @param {HTMLElement} field The field with the error.
     * @param {string} message The error message.
     */
    function showFieldError( field, message ) {
        var errorId = field.id + '-error';
        var existingError = document.getElementById( errorId );

        if ( existingError ) {
            existingError.textContent = message;
            return;
        }

        var errorElement = document.createElement( 'p' );
        errorElement.id = errorId;
        errorElement.className = 'text-burgundy text-sm mt-1';
        errorElement.textContent = message;
        errorElement.setAttribute( 'role', 'alert' );

        field.setAttribute( 'aria-describedby', errorId + ' ' + ( field.getAttribute( 'aria-describedby' ) || '' ) );
        field.parentNode.appendChild( errorElement );
    }

    /**
     * Remove error message for a field.
     *
     * @param {HTMLElement} field The field to remove error from.
     */
    function removeFieldError( field ) {
        var errorId = field.id + '-error';
        var errorElement = document.getElementById( errorId );

        if ( errorElement ) {
            errorElement.remove();
            var ariaDescribedBy = field.getAttribute( 'aria-describedby' );
            if ( ariaDescribedBy ) {
                ariaDescribedBy = ariaDescribedBy.replace( errorId, '' ).trim();
                if ( ariaDescribedBy ) {
                    field.setAttribute( 'aria-describedby', ariaDescribedBy );
                } else {
                    field.removeAttribute( 'aria-describedby' );
                }
            }
        }
    }

    /**
     * DOM Ready handler.
     */
    function domReady() {
        initMobileNav();
        initLightbox();
        initContactForm();
    }

    // Initialize on DOMContentLoaded.
    if ( document.readyState === 'loading' ) {
        document.addEventListener( 'DOMContentLoaded', domReady );
    } else {
        domReady();
    }

} )();
