<?php
/*
*	String functions
*
*	@package PHP Plus!
*
*
*/

/*  CONTENTS
*
*   rand_string
*   validate_email
*   validate_url
*   slug
*   trailingslash
*   untrailingslash
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

/*
*   validate_email
*
*   Verify if an email format is valid
*
*   @since 0.1
*   @last_modified 0.1
*
*	@params string $email - email to validate
*
*   @return true | false - true if email validates, false otherwise
*/
if( ! function_exists( 'validate_email' ) ){
function validate_email( $email ){

	if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
	  return true;
	} else {
	  return false;
	}
	
}
}

/*
*   validate_url
*
*   Verify if a url format is valid
*
*   @since 0.1
*   @last_modified 0.1
*
*	@params string $email - url to validate
*
*   @return true | false - true if url validates, false otherwise
*/
if( ! function_exists( 'validate_url' ) ){
function validate_url( $url ){

	if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
	  return true;
	} else {
	  return false;
	}
	
}
}

/*
*   slug
*
*   Turn a string into a slug
*
*	@author Web Developer Plus
*	@source http://webdeveloperplus.com/php/21-really-useful-handy-php-code-snippets/
*
*   @since 0.1
*   @last_modified 0.1
*
*	@params string $text - the text to turn into a slug
*
*	@return string $slug - the slug text
*
*/
function slug($string){
	$slug= strtolower( preg_replace('/[^A-Za-z0-9-]+/', '-', $string) );
	return $slug;
}

/*
*   trailingslash
*
*   Appends a trailing slash.
*
*	@author WordPress
*	@source https://core.trac.wordpress.org/browser/tags/4.7.3/src/wp-includes/formatting.php
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param string $string What to add the trailing slash to.
*	@return string String with trailing slash added.
*
*/
if( ! function_exists( 'trailingslash' ) ){
function trailingslash( $string ) {
        return untrailingslash( $string ) . '/';
}
}

/*
*   untrailingslash
*
*   Removes trailing forward slashes and backslashes if they exist.
*
*	@author WordPress
*	@source https://core.trac.wordpress.org/browser/tags/4.7.3/src/wp-includes/formatting.php
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param string $string What to remove the trailing slashes from.
*	@return string String without the trailing slashes.
*
*/
if( ! function_exists( 'untrailingslash' ) ){
function untrailingslash( $string ) {
        return rtrim( $string, '/\\' );
}
}