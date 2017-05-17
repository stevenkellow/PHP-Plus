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
*       is_email
*   validate_url
*       is_url
*   slug
*   trailingslash
*   untrailingslash
*   str2hex
*   hex2str
*   mbstring_binary_safe_encoding
*   reset_mbstring_encoding
*   seems_utf8
*   utf8_uri_encode
*
*/

/*
*   rand_string
*
*   Create a cryptographically secure random string
*
*	Note: for passwords please use password_hash (PHP 7 or later)
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param int $length - number of bytes for random string (default 27 for 36 character string)
*	@param string $type - type of string to produce ('hex' will produce a hex string)
*
*	@return string | false - random string made up of encoded number of bytes | false if PHP < 7 and openssl not installed
*/

if( ! function_exists( 'rand_string' ) ){
function rand_string( $length = 27, $type = 'all' ){

    if (version_compare(PHP_VERSION, '7.0.0') >= 0) {

        // Use random bytes if PHP 7 or above
        $data = random_bytes ( $length );

    } else {

        // Use openssl random bytes if below PHP 7
        if( function_exists( 'openssl_random_pseudo_bytes') ){
            $data = openssl_random_pseudo_bytes( $length );
        } else {
            return false;
        }

    }

	// Use all characters or use just hex
	if( $type !== 'hex' ){
		
		$string = base64_encode( $data );
		
	} else {
		$string = bin2hex( $data );
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
*   is_email
*
*   Alias of validate_email
*
*   @since 0.1
*   @last_modified 0.1
*
*	@params string $email - email to validate
*
*   @return true | false - true if email validates, false otherwise
*/
if( ! function_exists( 'is_email' ) ){
function is_email( $email ){

	return validate_email( $email );
	
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
*   @return bool - true if url validates, false otherwise
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
*   is_url
*
*   Alias of validate_url
*
*   @since 0.1
*   @last_modified 0.1
*
*	@params string $url - url to validate
*
*   @return bool - true if url validates, false otherwise
*/
if( ! function_exists( 'is_email' ) ){
function is_url( $url ){

	return is_url( $url );
	
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
if( ! function_exists( 'slug') ){
function slug($string){
	$slug= strtolower( preg_replace('/[^A-Za-z0-9-]+/', '-', $string) );
	return $slug;
}
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

/*
*   str2hex
*
*   Returns a hex containing a string
*
*	@author Alexander Rath
*	@source http://www.jonasjohn.de/snippets/php/hex-string.htm
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param string $func_string - string to turn into hex
*	@return string $func_retVal - returned hex
*
*/
if( ! function_exists( 'str2hex') ){
function str2hex($func_string) {
	$func_retVal = '';
	$func_length = strlen($func_string);
	for($func_index = 0; $func_index < $func_length; ++$func_index) $func_retVal .= ((($c = dechex(ord($func_string{$func_index}))) && strlen($c) & 2) ? $c : "0{$c}");

	return strtoupper($func_retVal);
}
}

/*
*   hex2str
*
*   Returns a string containing a hex
*
*	@author Alexander Rath
*	@source http://www.jonasjohn.de/snippets/php/hex-string.htm
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param string $func_string - hex to turn into string
*	@return string $func_retVal - returned string
*
*/
if( ! function_exists( 'hex2str') ){
function hex2str($func_string) {
	$func_retVal = '';
	$func_length = strlen($func_string);
	for($func_index = 0; $func_index < $func_length; ++$func_index) $func_retVal .= chr(hexdec($func_string{$func_index} . $func_string{++$func_index}));

	return $func_retVal;
}
}

/*
*   mbstring_binary_safe_encoding
*
*   Set the mbstring internal encoding to a binary safe encoding when func_overload is enabled.
*
*	@author WordPress
*	@source https://developer.wordpress.org/reference/functions/mbstring_binary_safe_encoding/
*
*   @since 0.1
*   @last_modified 0.1
*
*	@params bool $reset - Whether to reset the encoding back to a previously-set encoding.
*
*/
if( !function_exists( 'mbstring_binary_safe_encoding' ) ){
function mbstring_binary_safe_encoding( $reset = false ) {
  static $encodings = array();
  static $overloaded = null;

  if ( is_null( $overloaded ) )
    $overloaded = function_exists( 'mb_internal_encoding' ) && ( ini_get( 'mbstring.func_overload' ) & 2 );

  if ( false === $overloaded )
    return;

  if ( ! $reset ) {
    $encoding = mb_internal_encoding();
    array_push( $encodings, $encoding );
    mb_internal_encoding( 'ISO-8859-1' );
  }

  if ( $reset && $encodings ) {
    $encoding = array_pop( $encodings );
    mb_internal_encoding( $encoding );
  }
}
}

/*
*   reset_mbstring_encoding
*
*   Reset the mbstring internal encoding to a users previously set encoding.
*
*	@author WordPress
*	@source https://developer.wordpress.org/reference/functions/reset_mbstring_encoding/
*
*   @since 0.1
*   @last_modified 0.1
*
*
*/
if( !function_exists( 'reset_mbstring_encoding' ) ){
function reset_mbstring_encoding() {
  mbstring_binary_safe_encoding( true );
}
}

/*
*   seems_utf8
*
*   Checks to see if a string is utf8 encoded.
*
*	@author WordPress
*	@source https://developer.wordpress.org/reference/functions/seems_utf8/
*
*   @since 0.1
*   @last_modified 0.1
*
*	@params string $str - string to check for UTF8 encoding
*
*	@return bool True if $str fits a UTF-8 model, false otherwise.
*
*/
if( !function_exists( 'seems_utf8' ) ){
function seems_utf8( $str ) {
    mbstring_binary_safe_encoding();
    $length = strlen($str);
    reset_mbstring_encoding();
    for ($i=0; $i < $length; $i++) {
        $c = ord($str[$i]);
        if ($c < 0x80) $n = 0; // 0bbbbbbb
        elseif (($c & 0xE0) == 0xC0) $n=1; // 110bbbbb
        elseif (($c & 0xF0) == 0xE0) $n=2; // 1110bbbb
        elseif (($c & 0xF8) == 0xF0) $n=3; // 11110bbb
        elseif (($c & 0xFC) == 0xF8) $n=4; // 111110bb
        elseif (($c & 0xFE) == 0xFC) $n=5; // 1111110b
        else return false; // Does not match any model
        for ($j=0; $j<$n; $j++) { // n bytes matching 10bbbbbb follow ?
            if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
                return false;
        }
    }
    return true;
}
}

/*
*   utf8_uri_encode
*
*   Encode the Unicode values to be used in the URI.
*
*	@author WordPress
*	@source https://developer.wordpress.org/reference/functions/utf8_uri_encode/
*
*   @since 0.1
*   @last_modified 0.1
*
*	@params string $utf8_string - String to check.
*	@params int $length - max length of the string
*
*	@return string $string - String with Unicode encoded for URI.
*
*/
if( !function_exists( 'utf8_uri_encode' ) ){
function utf8_uri_encode( $utf8_string, $length = 0 ) {
	$unicode = '';
	$values = array();
	$num_octets = 1;
	$unicode_length = 0;
	mbstring_binary_safe_encoding();
	$string_length = strlen( $utf8_string );
	reset_mbstring_encoding();
	for ($i = 0; $i < $string_length; $i++ ) {
		$value = ord( $utf8_string[ $i ] );
		if ( $value < 128 ) {
			if ( $length && ( $unicode_length >= $length ) )
				break;
			$unicode .= chr($value);
			$unicode_length++;
		} else {
			if ( count( $values ) == 0 ) {
				if ( $value < 224 ) {
					$num_octets = 2;
				} elseif ( $value < 240 ) {
					$num_octets = 3;
				} else {
					$num_octets = 4;
				}
			}
			$values[] = $value;
			if ( $length && ( $unicode_length + ($num_octets * 3) ) > $length )
				break;
			if ( count( $values ) == $num_octets ) {
				for ( $j = 0; $j < $num_octets; $j++ ) {
					$unicode .= '%' . dechex( $values[ $j ] );
				}
				$unicode_length += $num_octets * 3;
				$values = array();
				$num_octets = 1;
			}
		}
	}
	return $unicode;
}
}