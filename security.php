<?php
/*
*	Security functions
*
*	@package PHP Plus!
*
*
*/

/*  CONTENTS
*
*   csrf_token
*   csrf_verify
*
*/

/*
*   csrf_token
*
*   Create and output a CSRF token hidden input
*
*	@author Scott Arciszewski
*	@source http://stackoverflow.com/a/31683058/7956549
*
*   @since 0.1
*   @last_modified 0.1
*
*	@params string $name - form name that you want to validate (so each form has unique token)
*	@params int $length - length of the csrf_token in bytes
*
*   @return hidden input tag with the value of the hashed_token
*/
if( ! function_exists( 'csrf_token' ) ){
function csrf_token( $name = 'csrf_token', $length = 32 ){
	
	// Check PHP session exists and start one if it doesn't
	session_starter();
	
	// Generate a token - credit to Scott Arciszewski http://stackoverflow.com/a/31683058/7956549
	
	
	if (empty($_SESSION[$name])) {
		
		$_SESSION[$name] = rand_string( 32, 'hex' );
	
		$token = $_SESSION[$name];
			
	}
	
	// Hash the token so that it's unique to this form
	$hashed_token = hash_hmac('sha256', $name, $_SESSION[$name]);
	
	echo '<input type="hidden" name="' . $name . '" value="' . $hashed_token . '" />';
	
}
}

/*
*   csrf_verify
*
*   Verify a given CSRF token
*
*	@author Scott Arciszewski
*	@source http://stackoverflow.com/a/31683058/7956549
*
*   @since 0.1
*   @last_modified 0.1
*
*	@params string $name - form name that you want to validate (so each form has unique token)
*
*   @return true | false - true if csrf validates, false otherwise
*/
if( ! function_exists( 'csrf_verify' ) ){
function csrf_verify( $name = 'csrf_token' ){
	
	// If the token exits
	if (!empty($_POST[$name])) {
		
		// Hash the token so that it's unique to this form
		$hashed_token = hash_hmac('sha256', $name, $_SESSION[$name]);
	
		// Use hash_equals if we're on greater than 5.6+
		if (version_compare(PHP_VERSION, '5.6') >= 0) {
		
				if (hash_equals($hashed_token, $_POST[$name])) {
					 // Proceed to process the form data
					 return true;
				} else {
					 // Log this as a warning and keep an eye on these attempts
					 return false;
				}
			
		} else {
			
			if( $hashed_token === $_POST[$name] ){
				// Proceed to process the form data
				return true;
			} else {
				// Log this as a warning and keep an eye on these attempts
				return false;
			}
			
		}
	
	} else {
		
		// No post csrf token, so return false
		return false;
		
	}
}
}
