<?php
/**
*	Security functions
*
*	@package PHP Plus!
*
*/

/*  CONTENTS
*
*   csrf_token
*   csrf_verify
*   antispambot
*   sha256
*   sha384
*   sha512
*   create_guid
*/

/**
*   csrf_token
*
*   Create and output a CSRF token hidden input
*
*	@author Scott Arciszewski
*	@source http://stackoverflow.com/a/31683058/7956549
*
*	@param string $name - form name that you want to validate (so each form has unique token)
*	@param int $length - length of the csrf_token in bytes
*
*   @return hidden input tag with the value of the hashed_token
*
*   @since 0.1
*   @modified 1.0.2
*
*/
if( ! function_exists( 'csrf_token' ) ){
function csrf_token( $name = 'csrf_token', $length = 32 ){
	
	// Check PHP session exists and start one if it doesn't
	session_starter();
	
	// Generate a token
	
	if( empty( $_SESSION[$name]) ){
		
		$_SESSION[$name] = rand_string( $length, false );
	
		$token = $_SESSION[$name];
			
	}
	
	// Hash the token so that it's unique to this form
	$hashed_token = hash_hmac('sha256', $name, $_SESSION[$name]);
	
	echo '<input type="hidden" name="' . $name . '" value="' . $hashed_token . '" />';
	
}
}

/**
*   csrf_verify
*
*   Verify a given CSRF token
*
*	@author Scott Arciszewski
*	@source http://stackoverflow.com/a/31683058/7956549
*
*	@param string $name - form name that you want to validate (so each form has unique token)
*
*   @return true | false - true if csrf validates, false otherwise
*
*   @since 0.1
*   @modified 0.1
*
*/
if( ! function_exists( 'csrf_verify' ) ){
function csrf_verify( $name = 'csrf_token' ){
	
	// If the token exits
	if( !empty( $_POST[$name]) ){
		
		// Hash the token so that it's unique to this form
		$hashed_token = hash_hmac('sha256', $name, $_SESSION[$name]);
	
		// Use hash_equals if we're on greater than 5.6+
		if( version_compare( PHP_VERSION, '5.6') >= 0 ){
		
			if( hash_equals( $hashed_token, $_POST[$name]) ){
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

/**
*   antispambot
*
*   Converts email addresses characters to HTML entities to block spam bots.
*
*   @author WordPress
*   @see https://developer.wordpress.org/reference/functions/antispambot/
*
*   @param string $email_address Email address.
*   @param int    $hex_encoding  Optional. Set to 1 to enable hex encoding.
*   @return string Converted email address.
*
*   @since 1.1
*   @modified 1.1
*
*/
if( ! function_exists( 'antispambot' ) ){
function antispambot( $email_address, $hex_encoding = 0 ){
	$email_no_spam_address = '';
	for ( $i = 0, $len = strlen( $email_address ); $i < $len; $i++ ){
		$j = rand( 0, 1 + $hex_encoding );
		if( $j == 0 ){
			$email_no_spam_address .= '&#' . ord( $email_address[ $i ] ) . ';';
		} elseif( $j == 1 ){
			$email_no_spam_address .= $email_address[ $i ];
		} elseif( $j == 2 ){
			$email_no_spam_address .= '%' . zeroise( dechex( ord( $email_address[ $i ] ) ), 2 );
		}
	}

	return str_replace( '@', '&#64;', $email_no_spam_address );
}
}

/**
*   sha256
*
*   Return the sha256 hash of an input
*
*   @param mixed $input - the item to hash
*   @param bool $raw_data - When set to TRUE, outputs raw binary data. FALSE outputs lowercase hexits.
*
*   @return string - the hashed data
*
*	@since  1.1
*	@modified   1.1
*/
if( ! function_exists( 'sha256' ) ){
function sha256( $data, $raw_data = false ){
    
    return hash( 'sha256', $data, $raw_data );
    
}
}

/**
*   sha384
*
*   Return the sha384 hash of an input
*
*   @param mixed $input - the item to hash
*   @param bool $raw_data - When set to TRUE, outputs raw binary data. FALSE outputs lowercase hexits.
*
*   @return string - the hashed data
*
*	@since  1.1
*	@modified   1.1
*/
if( ! function_exists( 'sha384' ) ){
function sha384( $data, $raw_data = false ){
    
    return hash( 'sha384', $data, $raw_data );
    
}
}

/**
*   sha512
*
*   Return the sha512 hash of an input
*
*   @param mixed $input - the item to hash
*   @param bool $raw_data - When set to TRUE, outputs raw binary data. FALSE outputs lowercase hexits.
*
*   @return string - the hashed data
*
*	@since  1.1
*	@modified   1.1
*/
if( ! function_exists( 'sha512' ) ){
function sha512( $data, $raw_data = false ){
    
    return hash( 'sha512', $data, $raw_data );
    
}
}

/**
*   create_guid
*
*   Generates a UUID v4
*
*   @author Danny Beckett
*   @see https://stackoverflow.com/a/55439684/7956549
*
*   @return string - UUID v4
*
*	@since  1.1.1
*	@modified   1.1.1
*/
if( ! function_exists( 'create_guid' ) ){
function create_guid(){
    $data = PHP_MAJOR_VERSION < 7 ? openssl_random_pseudo_bytes(16) : random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // Set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // Set bits 6-7 to 10
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
}
