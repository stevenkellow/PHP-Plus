<?php
/*
*	String functions
*
*	@package PHP Plus!
*
*
*/

/*
*   rand_string
*
*   Create a cryptographically secure random string
*
*	Note: for passwords please use password_hash (PHP 7 or later)
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param int $length - number of bytes for random string (default 27 for 36 character string)
*	@param string $type - type of string to produce ('hex' will produce a hex string)
*
*	@return string $string - random string made up of encoded number of bytes
*/

if( ! function_exists( 'rand_string' ) ){
function rand_string( $length = 27, $type = 'all' ){

if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
	
	// Use random bytes if PHP 7 or above
	$data = random_bytes ( $length );

	// Use all characters or use just hex
	if( $type !== 'hex' ){
		
		$string = base64_encode( $data );
		
	} else {
		$string = bin2hex( $data );
	}

} else {
	
	// Use openssl random bytes if below PHP 7
	$data = openssl_random_pseudo_bytes( $length );

	// Use all characters or use just hex
	if( $type !== 'hex' ){
		
		$string = base64_encode( $data );
		
	} else {
		$string = bin2hex( $data );
	}

}

	return $string;
		
}
}