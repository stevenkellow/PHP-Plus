<?php
/**
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
*   map_deep
*   rawurlencode_deep
*   urlencode_deep
*   xml_encode
*   xml_decode
*   xssafe
*   xecho
*   zeroise
*   rept
*       repeat_string
*   proper
*       sentence_case
*   strcheck
*   sanitize_key
*   is_hex
*   starts_with
*   ends_with
*/

/**
*  	rand_string
*
*  	Create a cryptographically secure random string
*
*	Note: for passwords please use password_hash (PHP 7 or later)
*
*  	@since 0.1
*  	@last_modified 1.0.2
*
*  	@param int $length - number of characters for random string (default 36 character string)
*	@param array | bool $symbols - false for no symbols, true for default symbols or array of custom symbols to use
*
*	@return string - random string made up of the specified number of characters
*/

if( ! function_exists( 'rand_string' ) ){
function rand_string( $length = 36, $symbols = true ){

	$test = array( 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
				   'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
				   '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' );
				   
	$symbols_array = array( '!', '$', '(', ')', '-', '_', '{', '}', '@', '~', '^' );
	
	// If we're using symbols use our default list
	if( $symbols === true ){
		
		$test = array_merge( $test, $symbols_array );
		
	}
	
	// If we're passing through an array of symbols use this
	if( is_array( $symbols ) ){
		
		$test = array_merge( $test, $symbols );
		
	}
	
	// Create a default string
	$string = '';
	
	// Count the number of characters we've got available
	$total_chars = count( $test ) - 1;
	
	// For each of the length add a character to the string
	for( $x = 1; $x <= $length; $x++ ){
		
		if ( function_exists( 'random_int' ) ) {

			// Use random int if PHP 7 or random_compat installed
			$int = random_int( 0, $total_chars );

		} else {

			$int = mt_rand( 0, $total_chars );

		}
		
		$string .= $test[$int];
		
	}

	return $string;

}	
}

/**
*   validate_email
*
*   Verify if an email format is valid
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param string $email - email to validate
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

/**
*   is_email
*
*   Alias of validate_email
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param string $email - email to validate
*
*   @return true | false - true if email validates, false otherwise
*/
if( ! function_exists( 'is_email' ) ){
function is_email( $email ){

	return validate_email( $email );
	
}
}

/**
*   validate_url
*
*   Verify if a url format is valid
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param string $email - url to validate
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

/**
*   is_url
*
*   Alias of validate_url
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param string $url - url to validate
*
*   @return bool - true if url validates, false otherwise
*/
if( ! function_exists( 'is_email' ) ){
function is_url( $url ){

	return is_url( $url );
	
}
}

/**
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
*	@param string $text - the text to turn into a slug
*
*	@return string $slug - the slug text
*
*/
if( ! function_exists( 'slug') ){
function slug($string){
	$slug = strtolower( preg_replace('/[^A-Za-z0-9-]+/', '-', $string) );
	return $slug;
}
}

/**
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

/**
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

/**
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

/**
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

/**
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
*	@param bool $reset - Whether to reset the encoding back to a previously-set encoding.
*
*/
if( ! function_exists( 'mbstring_binary_safe_encoding' ) ){
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

/**
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

/**
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
*	@param string $str - string to check for UTF8 encoding
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

/**
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
*	@param string $utf8_string - String to check.
*	@param int $length - max length of the string
*
*	@return string $string - String with Unicode encoded for URI.
*
*/
if( ! function_exists( 'utf8_uri_encode' ) ){
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

/**
*
*	map_deep
*
*	Maps a function to all non-iterable elements of an array or an object.
*
*	@author WordPress
*	@source https://developer.wordpress.org/reference/functions/map_deep/
*
*	@param mixed $value The array, object, or scalar.
*	@param callback $callback The function to map onto $value.
*	@return mixed $value The value with the callback applied to all non-arrays and non-objects inside it.
*/
if( ! function_exists( 'map_deep') ){
function map_deep( $value, $callback ) {
    if ( is_array( $value ) ) {
        foreach ( $value as $index => $item ) {
            $value[ $index ] = map_deep( $item, $callback );
        }
    } elseif ( is_object( $value ) ) {
        $object_vars = get_object_vars( $value );
        foreach ( $object_vars as $property_name => $property_value ) {
            $value->$property_name = map_deep( $property_value, $callback );
        }
    } else {
        $value = call_user_func( $callback, $value );
    }
 
    return $value;
}
}

/**
*
*	rawurlencode_deep
*
*	Navigates through an array, object, or scalar, and raw-encodes the values to be used in a URL.
*
*	@author WordPress
*	@source https://developer.wordpress.org/reference/functions/rawurlencode_deep/
*
*	@param mixed $value The array or string to be encoded.
*	@return mixed $value The encoded value.
*/
if( ! function_exists( 'rawurldecode_deep') ){
function rawurlencode_deep( $value ) {
	return map_deep( $value, 'rawurlencode' );
}
}

/**
*
*	urldecode_deep
*
*	Navigates through an array, object, or scalar, and decodes URL-encoded values
*
*	@author WordPress
*	@source https://developer.wordpress.org/reference/functions/urldecode_deep/
*
*	@param mixed $value The array or string to be decoded.
*	@return mixed $value The decoded value.
*/
if( ! function_exists( 'urldecode_deep') ){
function urldecode_deep( $value ) {
	return map_deep( $value, 'urldecode' );
}
}


/**
*
*	xml_encode
*
*	Encode XML using xml_encode(); similar to json_encode().
*
*	@author Dark Launch
*	@source https://www.darklaunch.com/2009/05/23/php-xml-encode-using-domdocument-convert-array-to-xml-json-encode
*
*	@param mixed $mixed - data to encode-using-domdocument-convert-array-to-xml-json-encode
*	@param mixed $domElement -
*	@param mixed $DOMDocument -
*
*	@return mixed XML encoded data
*/
if( ! function_exists( 'xml_encode') ){
function xml_encode($mixed, $domElement=null, $DOMDocument=null) {
    if (is_null($DOMDocument)) {
        $DOMDocument =new DOMDocument;
        $DOMDocument->formatOutput = true;
        xml_encode($mixed, $DOMDocument, $DOMDocument);
        return $DOMDocument->saveXML();
    }
    else {
        // To cope with embedded objects 
        if (is_object($mixed)) {
          $mixed = get_object_vars($mixed);
        }
        if (is_array($mixed)) {
            foreach ($mixed as $index => $mixedElement) {
                if (is_int($index)) {
                    if ($index === 0) {
                        $node = $domElement;
                    }
                    else {
                        $node = $DOMDocument->createElement($domElement->tagName);
                        $domElement->parentNode->appendChild($node);
                    }
                }
                else {
                    $plural = $DOMDocument->createElement($index);
                    $domElement->appendChild($plural);
                    $node = $plural;
                    if (!(rtrim($index, 's') === $index)) {
                        $singular = $DOMDocument->createElement(rtrim($index, 's'));
                        $plural->appendChild($singular);
                        $node = $singular;
                    }
                }

                xml_encode($mixedElement, $node, $DOMDocument);
            }
        }
        else {
            $mixed = is_bool($mixed) ? ($mixed ? 'true' : 'false') : $mixed;
            $domElement->appendChild($DOMDocument->createTextNode($mixed));
        }
    }
}
}

/**
*
*	xml_decode
*
*	Decode XML data to an array
*
*	@author user1398287
*	@source http://stackoverflow.com/questions/6578832/how-to-convert-xml-into-array-in-php
*
*	@param string $xmlstring - XML data to convert to array
*
*	@return array | bool - $array if successful, false if not
*/
if( ! function_exists( 'xml_decode') ){
function xml_decode( $xmlstring ){
	
	if( function_exists( 'simplexml_load_string' ) ){
		
		$xml = simplexml_load_string($xmlstring, "SimpleXMLElement", LIBXML_NOCDATA);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);

		return $array;
	
	} else {
		
		return false;
	}
}
}

/**
*   xssafe
*
*   Create a string that's safe from XSS attacks
*
*	@author OWASP
*	@source https://www.owasp.org/index.php/PHP_Security_Cheat_Sheet#No_tags
*
*   @since 0.1
*   @last_modified 1.0.2
*
*   @param string $data - data to secure
*	@param string $encoding - how you want to encode the data
*
*	@return string - XSS-safe string
*/
if( ! function_exists( 'xssafe') ){
function xssafe($data,$encoding='UTF-8'){
	
	$data = strip_tags( $data );
	
   	return htmlspecialchars($data,ENT_QUOTES | ENT_HTML401,$encoding);
}
}

/**
*   xecho
*
*   Echoes an XSS-safe string
*
*	@author OWASP
*	@source https://www.owasp.org/index.php/PHP_Security_Cheat_Sheet#No_tags
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param string $data - data to secure
*
*	@return string - XSS-safe string
*/
if( ! function_exists( 'xecho') ){
function xecho($data){
   echo xssafe($data);
}
}

/**
*   zeroise
*
*   Pad a string with zeros if needed
*
*	@author WordPress
*	@source https://developer.wordpress.org/reference/functions/zeroise/
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param int $number - number to pad
*   @param int $length - max length of the string
*
*   @return string - string with leading zeros
*/
if( ! function_exists( 'zeroise') ){
function zeroise($number, $length){
    return sprintf( '%0' . $threshold . 's', $number );
}
}

/**
*   rept
*
*   Alias of str_repeat()
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param string $string - string to repeat
*   @param int $number - number of times to repeat the string
*
*   @return string $new_string - string repeated
*/
if( ! function_exists( 'rept') ){
function rept( $string, $number ){
	
	return str_repeat( $string, $number );
	
	
}
}

/**
*   repeat_string
*
*   Alias of str_repeat()
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param string $string - string to repeat
*   @param int $number - number of times to repeat the string
*
*	@return string $new_string - string repeated
*/
if( ! function_exists( 'repeat_string') ){
function repeat_string( $string, $number ){
	
	return str_repeat( $string, $number );
	
}
}

/**
*   proper
*
*   Makes first character upper case and rest lower case for each word in a string - similar to same function in Excel
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param string $string - string to check
*   @param array $split_chars - array of characters to use when splitting a string
*
*   @return string $string - updaed string
*/
if( ! function_exists( 'proper' ) ){
function proper( $string, $split_chars = array( '-', ' ' ) ){

// Check through for each character we've specified
foreach( $split_chars as $char ){

	// If the character is found
	if( strpos( $string, $char ) !== false ){

		// Split the string at this character
		$arrayed = explode( $char, $string );

		// Get the total number of string parts
		$array_count = count( $arrayed );

		// Set up a new sting to return
		$new_string = '';

		// Create a counter to check if we're on the last string part
		$i = 0;

		// For each part of the string
		foreach( $arrayed as $part ){

			// Capitalise the first letter but leave the rest lower case
			$new_string .= ucfirst( strtolower( $part ) );

			// If this is not the last string part
			if(++$i !== $array_count) {

				// Add the split character back in
				$new_string .= $char;

			}
		}

		// Reset the string to the new one
		$string = $new_string;


	}

}

return $string;
	
}
}	

/**
*   sentence_case
*
*   Alias of proper
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param string $string - string to check
*   @param array $split_chars - array of characters to use when splitting a string
*
*   @return string $string - updaed string
*/
if( ! function_exists( 'sentence_case' ) ){
function sentence_case( $string, $split_chars = null ){
	
	return proper( $string, $split_chars );
	
}
}

/**
*   strcheck
*
*   Check that passed arguments have a string length of 1 or more
*
*   @since 1.0.4
*   @last_modified 1.0.4
*
*   @return bool - true if all arguments are strings of length greater than 1, else false
*/
if( ! function_exists( 'strcheck' ) ){
function strcheck(){
	
	$args = func_get_args();

	foreach( $args as $arg ){

		if( strlen( $arg ) < 1 ){

			return false;

		}

	}

	return true;
	
}
}

/**
*   sanitize_key
*
*   Keys are used as internal identifiers. Lowercase alphanumeric characters, dashes and underscores are allowed.
*
*   @param string $key String key
*
*   @return string Sanitized key
*
*	@since	1.0.4
*	@last_modified	1.0.4
*/
if( ! function_exists( 'sanitize_key' ) ){
function sanitize_key( $key ) {
	
	$key     = strtolower( $raw_key );
	$key     = preg_replace( '/[^a-z0-9_\-]/', '', $key );

	return $key;
}
}

/**
*   is_hex
*
*   Alias of ctype_xdigit
*
*   @see http://php.net/manual/en/function.ctype-xdigit.php
*
*   @param string $string - the string to check
*
*   @return bool - true if hexadecimal, false if not
*
*	@since	1.0.4
*	@last_modified	1.0.4
*/
if( ! function_exists( 'is_hex' ) ){
function is_hex( $string ){
    
    return ctype_xdigit( $string );
    
}
}

/**
*   starts_with
*
*   Check if a string starts with a given value
*
*   @author MrHus
*   @see https://stackoverflow.com/a/4312630/7956549
*
*   @param string $haystack - string to search in
*   @param string $needle - string to search for
*
*   @return bool - true if it does, false if it doesn't
*
*	@since	1.0.4
*	@last_modified	1.0.4
*/
function starts_with( $haystack, $needle ){
    
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
    
}

/**
*   ends_with
*
*   Check if a string ends with a given value
*
*   @author MrHus
*   @see https://stackoverflow.com/a/4312630/7956549
*
*   @param string $haystack - string to search in
*   @param string $needle - string to search for
*
*   @return bool - true if it does, false if it doesn't
*
*	@since	1.0.4
*	@last_modified	1.0.4
*/
function starts_with( $haystack, $needle ){
    
   return substr($haystack, -strlen($needle))===$needle;
    
}