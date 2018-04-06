<?php
/**
*	String functions
*
*	@package PHP Plus!
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
*   str_to_bool
*   str_contains
*   parse_email
*   html_atts_string
*   make_clickable
*   http_build_url
*   proper_parse_str
*   mb_strcasecmp
*   ucnames
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

	$characters = array( 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
				   'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
				   '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' );
				   
	$symbols_array = array( '!', '$', '(', ')', '-', '_', '{', '}', '@', '~', '^' );
	
	// If we're using symbols use our default list
	if( $symbols === true ){
		
		$characters = array_merge( $characters, $symbols_array );
		
	}
	
	// If we're passing through an array of symbols use this
	if( is_array( $symbols ) ){
		
		$characters = array_merge( $characters, $symbols );
		
	}
	
	// Create a default string
	$string = '';
	
	// Count the number of characters we've got available
	$total_chars = count( $characters ) - 1;
	
	// For each of the length add a character to the string
	for( $x = 1; $x <= $length; $x++ ){
		
		if ( function_exists( 'random_int' ) ) {

			// Use random int if PHP 7 or random_compat installed
			$int = random_int( 0, $total_chars );

		} else {

			$int = mt_rand( 0, $total_chars );

		}
		
		$string .= $characters[$int];
		
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
*   @last_modified 1.1
*
*	@param string $email - url to validate
*   @param bool $ssl - whether to validate that the URL is HTTPS or not
*
*   @return bool - true if url validates, false otherwise
*/
if( ! function_exists( 'validate_url' ) ){
function validate_url( $url, $ssl = false ){

	if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
	  
        if( $ssl == false ){
            return true;
        } else {
            
            // Check that the URL is HTTPS
            $parsed_url = parse_url( $url );

            if( $parsed_url['scheme'] !== 'https' ){

                // URL isn't HTTPS
                return false;

            } else {
                
                return true;
                
            }
            
        }
        
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
*   @last_modified 1.1
*
*	@param string $url - url to validate
*   @param bool $ssl - whether to validate that the URL is HTTPS or not
*
*   @return bool - true if url validates, false otherwise
*/
if( ! function_exists( 'is_email' ) ){
function is_url( $url, $ssl = false ){

	return validate_url( $url, $ssl );
	
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
*	@source https://developer.wordpress.org/reference/functions/trailingslashit/
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
*	@source https://developer.wordpress.org/reference/functions/untrailingslashit/
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
*	@since	0.1
*	@last_modified	0.1
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
*	@since	0.1
*	@last_modified	0.1
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
*	@since	0.1
*	@last_modified	0.1
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
*	@since	0.1
*	@last_modified	0.1
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
*	@since	0.1
*	@last_modified	0.1
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
*   @since 1.1
*   @last_modified 1.1
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
*   @author WordPress
*   @see https://developer.wordpress.org/reference/functions/sanitize_key/
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param string $key String key
*
*   @return string Sanitized key
*/
if( ! function_exists( 'sanitize_key' ) ){
function sanitize_key( $key ) {
	
	$key     = strtolower( $key );
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
*	@since	1.1
*	@last_modified	1.1
*
*   @param string $string - the string to check
*
*   @return bool - true if hexadecimal, false if not
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
*	@since	1.1
*	@last_modified	1.1
*
*   @param string $haystack - string to search in
*   @param string $needle - string to search for
*   @param bool $insensitive - whether to make the comparison case insensitive
*
*   @return bool - true if it does, false if it doesn't
*/
if( ! function_exists( 'starts_with' ) ){
function starts_with( $haystack, $needle, $insensitive = false ){
    
    if( $insensitive == true ){
        
        $haystack = strtolower( $haystack );
        $needle = strtolower( $needle );
        
    }
    
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
    
}
}

/**
*   ends_with
*
*   Check if a string ends with a given value
*
*   @author MrHus
*   @see https://stackoverflow.com/a/4312630/7956549
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param string $haystack - string to search in
*   @param string $needle - string to search for
*   @param bool $insensitive - whether to make the comparison case insensitive
*
*   @return bool - true if it does, false if it doesn't
*/
if( ! function_exists( 'ends_with' ) ){
function ends_with( $haystack, $needle, $insensitive = false ){
    
    if( $insensitive == true ){
        
        $haystack = strtolower( $haystack );
        $needle = strtolower( $needle );
        
    }
    
    return substr($haystack, -strlen($needle))===$needle;
    
}
}

/**
*   str_to_bool
*
*   Converts many english words that equate to true or false to boolean.
*
*   Supports 'y', 'n', 'yes', 'no' and a few other variations.
*
*   @author brandonwamboldt
*   @see https://github.com/brandonwamboldt/utilphp/blob/master/src/utilphp/util.php
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param  string $string  The string to convert to boolean
*   @param  bool   $default The value to return if we can't match any
*                          yes/no words
*   @return boolean
*/
if( ! function_exists( 'str_to_bool' ) ){
function str_to_bool($string, $default = false){
    $yes_words = 'affirmative|all right|aye|indubitably|most assuredly|ok|of course|okay|sure thing|y|yes+|yea|yep|sure|yeah|true|t|on|1|oui|vrai|tha';
    $no_words = 'no*|no way|nope|nah|na|never|absolutely not|by no means|negative|never ever|false|f|off|0|non|faux|chan eil';
    if (preg_match('/^(' . $yes_words . ')$/i', $string)) {
        return true;
    } elseif (preg_match('/^(' . $no_words . ')$/i', $string)) {
        return false;
    }
    return $default;
}
}

/**
*   str_contains
*
*   Check if a string contains another string.
*
*   @author brandonwamboldt
*   @see https://github.com/brandonwamboldt/utilphp/blob/master/src/utilphp/util.php
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param  string $haystack - string to check
*   @param  string $needle - string to find
*
*   @return boolean
*/
if( ! function_exists( 'str_contains' ) ){
function str_contains($haystack, $needle, $insensitive = false ){
    
    if( $insensitive == false ){
        return strpos($haystack, $needle) !== false;
    } else {
        return stripos($haystack, $needle) !== false;
    }
}
}

/**
*   parse_email
*
*   Get information from an email address
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param string $email - the email address to parse
*   @param array $delimiters - additional delimiters to use when parsing names
*
*   @return array $output - details of the email
*/
if( ! function_exists( 'parse_email' ) ){
function parse_email( $email, $delimiters = array() ){
    
    // Check that the email is valid
    if( ! validate_email( $email ) ){
        return false;
    }
    
    // Create an output array
    $output = array();
    
    $parts = explode('@',$email); // Splits the email at the @ symbol
    $username = $parts[0]; // Can be used as a username if you'd like, but we'll use it to find names anyway
    
    // Add the items to the array
    $output['username'] = $username;
    $output['domain'] = $parts[1];

    $delimiters = array_merge( $delimiters, array('.', '-', '_') ); // List of common email name delimiters, feel free to add to it

    foreach ($delimiters as $delimiter){ // Checks all the delimiters
        if ( strpos($username, $delimiter) ){ // If the delimiter is found in the string
          $parts_name = preg_replace("/\d+$/","", $username); // Remove numbers from string
          $parts_name = explode( $delimiter, $parts_name); // Split the username at the delimiter
          break; // If we've found a delimiter we can move on
        }
    }

    if ( $parts_name ){ // If we've found a delimiter we can use it
        $output['first_name'] = ucfirst( strtolower( $parts_name[0] ) ); // Lets tidy up the names so the first letter is a capital and rest lower case
        $output['last_name'] = ucfirst( strtolower( $parts_name[1] ) );
    }
    
    return $output;
    
}
}

/**
*   html_atts_string
*
*   Create a string of attributes that can be used for a HTML element
*
*	@since	1.1
*	@last_modified 1.1
*
*   @param array $atts - the element attributes
*
*   @return string $atts_string - the string of HTMl attributes
*/
if( ! function_exists( 'html_atts_string' ) ){
function html_atts_string( $atts ){
    
    $atts_string = '';

    foreach( $atts as $key => $value ){
        
        // Check for an array (might be used for classes)
        if( is_array( $value ) ){
            $atts_string .= $key . '="' . implode( $value, ' ') . '" ';
        } else {
            $atts_string .= $key . '="' . $value . '" ';
        }

    }
    
    return( trim( $atts_string ) );
}
}

/**
*   make_clickable
*
*   Parse a string and format anything that looks like a link as a link
*
*   @author WordPress
*   @see https://developer.wordpress.org/reference/functions/make_clickable/
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param string $ret - the original string
*   @param array $atts - any attributes to add to the final link
*
*   @return string - the string with new links
*/
if( ! function_exists( 'make_clickable' ) ){
function make_clickable($ret, $atts = array() ) {
    $ret = ' ' . $ret;
    // in testing, using arrays here was found to be faster
    
    // For normal links
	$ret = preg_replace_callback('#([\s>])([\w]+?://[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]*)#is', function( $matches ) use ( $atts ){
		
		$ret = '';
		$url = $matches[2];

		if ( empty($url) )
			return $matches[0];
		// removed trailing [.,;:] from URL
		if ( in_array(substr($url, -1), array('.', ',', ';', ':')) === true ) {
			$ret = substr($url, -1);
			$url = substr($url, 0, strlen($url)-1);
		}
		
		if( empty( $atts ) ){
			return $matches[1] . "<a href=\"$url\">$url</a>" . $ret;
		} else {
			
			$atts_string = html_atts_string( $atts );
			
			return $matches[1] . "<a href=\"$url\" $atts_string >$url</a>" . $ret;
		}
		
		
		
	}, $ret);
	
    // For FTP links
    $ret = preg_replace_callback('#([\s>])((www|ftp)\.[\w\\x80-\\xff\#$%&~/.\-;:=,?@\[\]+]*)#is', function( $matches ) use ( $atts ){
		
		$ret = '';
		$dest = $matches[2];
		$dest = 'http://' . $dest;

		if ( empty($dest) )
			return $matches[0];
		// removed trailing [,;:] from URL
		if ( in_array(substr($dest, -1), array('.', ',', ';', ':')) === true ) {
			$ret = substr($dest, -1);
			$dest = substr($dest, 0, strlen($dest)-1);
		}
		
		if( empty( $atts ) ){
			
			return $matches[1] . "<a href=\"$dest\">$dest</a>" . $ret;
			
		} else {
			
			$atts_string = html_atts_string( $atts );
			
			return $matches[1] . "<a href=\"$dest\" $atts_string >$dest</a>" . $ret;
			
		}
		
		
		
	}, $ret);
   
    // For email links
   $ret = preg_replace_callback('#([\s>])([.0-9a-z_+-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,})#i', function( $matches ) use ( $atts ){
	   
	   $email = $matches[2] . '@' . $matches[3];
	   
	   if( empty( $atts ) ){ 
		return $matches[1] . "<a href=\"mailto:$email\">$email</a>";
	   } else {
		   
		   $atts_string = html_atts_string( $atts );
		   
		   return $matches[1] . "<a href=\"mailto:$email\" $atts_string >$email</a>";
	   }
	   
	   
   }, $ret);

    // this one is not in an array because we need it to run last, for cleanup of accidental links within links
    $ret = preg_replace("#(<a( [^>]+?>|>))<a [^>]+?>([^>]+?)</a></a>#i", "$1$3</a>", $ret);
    $ret = trim($ret);
    return $ret;
}
}

/**
*   http_build_url
*
*   Reverses parse_url
*
*   @author Thomas Gielfeldt
*   @see http://php.net/manual/en/function.parse-url.php#106731
*
*   @param array $parsed_url - a parsed url
*
*   @return string - the url
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( 'http_build_url' ) ){
function http_build_url( $parsed_url ){
    
    $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : ''; 
	$host     = isset($parsed_url['host']) ? $parsed_url['host'] : ''; 
	$port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : ''; 
	$user     = isset($parsed_url['user']) ? $parsed_url['user'] : ''; 
	$pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : ''; 
	$pass     = ($user || $pass) ? "$pass@" : ''; 
	$path     = isset($parsed_url['path']) ? $parsed_url['path'] : ''; 
	$query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : ''; 
	$fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : ''; 
	
	return "$scheme$user$pass$host$port$path$query$fragment";
    
}
}

/**
*   proper_parse_str
*
*   Parse a query string avoiding a PHP bug when the same paramater is set multiple times
*   Also has the benefit of returning an array rather than a void, which is more predictable behaviour
*
*   @author Evan K
*   @see http://php.net/manual/en/function.parse-str.php#76792
*
*   @param string $str - the string to parse (normally query string)
*
*   @return array $arr - the returned array
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( 'proper_parse_str' ) ){
function proper_parse_str( $str ){
 
    # result array
    $arr = array();

    # split on outer delimiter
    $pairs = explode('&', $str);

    # loop through each pair
    foreach ($pairs as $i) {
    # split into name and value
    list($name,$value) = explode('=', $i, 2);

    # if name already exists
    if( isset($arr[$name]) ) {
      # stick multiple values into an array
      if( is_array($arr[$name]) ) {
        $arr[$name][] = $value;
      }
      else {
        $arr[$name] = array($arr[$name], $value);
      }
    }
    # otherwise, simply stick it in a scalar
    else {
      $arr[$name] = $value;
    }
    }

    # return result array
    return $arr;
}
}

/**
*   mb_strcasecmp
*
*   A multibyte safe case-insensitive string comparison function
*
*   @author Chris Buckley
*   @see http://php.net/manual/en/function.strcasecmp.php#107016
*
*   @param string $str1 - the first string to consider
*   @param string $str2 - the second string to consider
*   @param bool $encoding - whether the strings have been encoded
*
*   @return int - Returns < 0 if str1 is less than str2; > 0 if str1 is greater than str2, and 0 if they are equal.
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( 'mb_strcasecmp' ) ){
function mb_strcasecmp($str1, $str2, $encoding = null) {
    if (null === $encoding) { $encoding = mb_internal_encoding(); }
    return strcmp(mb_strtoupper($str1, $encoding), mb_strtoupper($str2, $encoding));
}
}

/**
*   ucnames
*
*   Put a string into name case
*
*   @author Antonio Max
*   @see http://php.net/manual/en/function.ucwords.php#112795
*
*   @param string $string - the string to normalize
*   @param array $delimiters - items where a capital letter would come after
*   @param array $exceptions - strings that aren't to be capitalised
*
*   @return string $string - the fixed string
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( 'ucnames' ) ){
function ucnames($string, $delimiters = array(" ", "-", ".", "'", "O'", "Mc"), $exceptions = array("de", "da", "dos", "das", "do", "I", "II", "III", "IV", "V", "VI", "van")){
	/*
	 * Exceptions in lower case are words you don't want converted
	 * Exceptions all in upper case are any words you don't want converted to title case
	 *   but should be converted to upper case, e.g.:
	 *   king henry viii or king henry Viii should be King Henry VIII
	 */
	$string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
	foreach ($delimiters as $dlnr => $delimiter) {
		$words = explode($delimiter, $string);
		$newwords = array();
		foreach ($words as $wordnr => $word) {
			if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
				// check exceptions list for any words that should be in upper case
				$word = mb_strtoupper($word, "UTF-8");
			} elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
				// check exceptions list for any words that should be in upper case
				$word = mb_strtolower($word, "UTF-8");
			} elseif (!in_array($word, $exceptions)) {
				// convert to uppercase (non-utf8 only)
				$word = ucfirst($word);
			}
			array_push($newwords, $word);
		}
		$string = join($delimiter, $newwords);
   }//foreach
   return $string;
}
}