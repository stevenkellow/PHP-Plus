<?php
/**
*	Sessions functions
*
*	@package PHP Plus!
*
*
*/

/*  CONTENTS
*
*   session_starter
*   session
*   redirect
*   current_url
*   timer_start
*   timer_end
*   set_content_type
*/

/**
*   session_starter
*
*   Start a PHP session if one doesn't exist already
*
*   @param string $name - the session name
*   @param array $options - options when creating the session
*
*   @since 0.1
*   @last_modified 1.0.4
*
*/
if( ! function_exists( 'session_starter') ){
function session_starter( $name = false, $options = array() ){
	
	// Set the session name if necessary
	if( $name !== false ){
	
		session_name( $name );
		
	}
	
	// Check if PHP session has started - credit to Meliza Ramos http://stackoverflow.com/a/18542272/7956549
	if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
		
		// If no session exists start one (use session_status after PHP7)
		if (session_status() == PHP_SESSION_NONE) {
			session_start( $options );
		}
		
	} else {
		
		// If no session exists start one
		if(session_id() == '') {
			session_start( $options );
		}
		
	}
	
}
}

/**
*   session
*
*   Use function to manipulate PHP sessions
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param string $key - session key to get/set
*	@param string $value - session value to set
*
*	@return mixed boolean or mixed - returns true if set successful, value if get successful
*/
if( ! function_exists( 'session' ) ){
function session( $key = null, $value = null ){
	
	// Make sure sessions are active
	session_starter();
	
	// If the key is given we can perform function
	if( $key ){
		
		// If the value is given we'll want to set it
		if( $value ){
			
			// Set the value for this session key
			$_SESSION[$key] = $value;
			
		} else {
			
			// No value, so want to return the session value
			return $_SESSION[$key];
			
		}
		
		
	} else {
		
		// No key given
		return false;
		
	}
	
}
}

/**
*
*	redirect
*
*	Send the user to another location
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param string $url - url to send the user to
*	@param int $response - default response code for the redirect
*
*	@return bool true | false - true if the url is valid, false otherwise
*/
if( ! function_exists( 'redirect') ){
function redirect( $url, $response = 301 ){
	
	// Check the the url is valid first
	if( validate_url( $url ) ){
	
		header("Location: $url", true, $response);
		
		return true;
	
	} else {
		
		return false;
		
	}
	
}
}

/**
*
*	current_url
*
*	Get the current URL
*
*   @author Chris Coyier et. al.
*   @source https://css-tricks.com/snippets/php/get-current-page-url/
*
*   @since 0.1
*   @last_modified 0.1
*
*	@return string $act_url - the current URL
*/
if( ! function_exists( 'current_url') ){
function current_url() {
    $act_url  = ( isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ) ? 'https' : 'http';
    $act_url .= '://' . $_SERVER['SERVER_NAME'];
    $act_url .= in_array( $_SERVER['SERVER_PORT'], array( '80', '443' ) ) ? '' : ":" . $_SERVER['SERVER_PORT'];
    $act_url .= $_SERVER['REQUEST_URI'];
    return $act_url;
}
}

/**
*   timer_start
*
*   Start a timer
*
*   @since 0.1
*   @last_modified 0.1
*
*   @returns time - time in microseconds
*
*/
if( ! function_exists( 'timer_start') ){
function timer_start(){
	
	return microtime(true);	
	
}
}

/**
*   timer_end
*
*   End a timer and get the difference from the time started
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param time $old_time - the time the timer started
*
*   @returns time - time between now and the time passed into function
*
*/
if( ! function_exists( 'timer_end') ){
function timer_end( $old_time ){
	
	$now = microtime(true);

	return $now - $old_time;
	
}
}

/**
*   set_content_type
*
*   Set content type of the output
*
*   @param string $type - the file type
*
*	@since	1.0.4
*	@last_modified	1.0.4
*/
if( ! function_exists( 'set_content_type' ) ){
function set_content_type( $type ){
    
    // Call in our mime type files
    $mime_type = mime_type( $type );
    
    // Set the header
    header( 'Content-type: ' . $mime_type );
    
}
}