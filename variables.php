<?php
/**
*	Variables functions
*
*	@package PHP Plus!
*
*/

/*  CONTENTS
*
*   is_ssl
*       is_https
*   protocol
*   get_user_ip
*   get_user_lang
*   is_windows
*   is_linux
*   is_iis
*   is_apache
*   is_nginx
*   is_mobile
*   spaceship
*   __return_true
*   __return_false
*   __return_zero
*   __return_empty_string
*   __return_empty_array
*/

/**
*   is_ssl
*
*   Check if the site uses SSL or note
*
*	@author WordPress
*   @source https://developer.wordpress.org/reference/functions/is_ssl/
*
*   @since 0.1
*   @last_modified 0.1
*
*	@return bool true|false - true if SSL, false otherwise
*
*/
if( ! function_exists( 'is_ssl' ) ){
function is_ssl() {
	
    if ( isset( $_SERVER['HTTPS'] ) ) {
		if ( 'on' == strtolower( $_SERVER['HTTPS'] ) ) {
			return true;
		}
		if ( '1' == $_SERVER['HTTPS'] ) {
			return true;
		}
	} elseif ( isset($_SERVER['SERVER_PORT'] ) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
		return true;
	}
	return false;
}
}

/**
*   is_https
*
*   Alias of is_ssl
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( 'is_https' ) ){
function is_https(){
    return is_ssl();
}
}

/**
*   protocol
*
*   Print the site's protocol
*
*   @since 0.1
*   @last_modified 0.1
*
*	@return string https:// | http://
*
*/
if( ! function_exists( 'protocol') ){
function protocol(){
    
    if( is_ssl() === true ){
        return 'https://';
    } else {
        return 'http://';
    }
    
}
}

/**
*   get_user_ip
*
*   Get the user's IP address
*
*	@author Mohit Modan - http://blog.koonk.com/2015/07/46-useful-php-code-snippets-that-can-help-you-with-your-php-projects/
*	@author Emil Vikström - http://stackoverflow.com/a/3003233/7956549
*
*   @since 0.1
*   @last_modified 0.1
*
*	@return string IP Address
*
*/
if( ! function_exists( 'get_user_ip' ) ){
function get_user_ip(){
	
	if( ! empty( $_SERVER['REMOTE_ADDR'] ) ){
		
		return $_SERVER['REMOTE_ADDR'];
		
	} elseif( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ){
		
		return $_SERVER['HTTP_CLIENT_IP'];
		
	} elseif( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ){
		
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
		
	}
	
	// If nothing's available return false
	return false;
	
}
}

/**
*   get_user_lang
*
*   Get the user's language
*
*	@author Mohit Modan
*	@source http://blog.koonk.com/2015/07/46-useful-php-code-snippets-that-can-help-you-with-your-php-projects/
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param array $availableLanguages - languages a site can use
*	@param string $default - the default language of the site
*
*	@return string language
*
*/
if( ! function_exists( 'get_user_lang') ){
function get_user_lang( $availableLanguages, $default = 'en' ){
	
	if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
		$langs=explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);

		foreach ($langs as $value){
			$choice=substr($value,0,2);
			if(in_array($choice, $availableLanguages)){
				return $choice;
			}
		}
	}
	return $default;
}
}


/**
*   is_windows
*
*   Checks if PHP is running on a Windows platform
*
*	@author Sander Marechal
*	@source https://stackoverflow.com/posts/5879078/edit
*
*   @since 0.1
*   @last_modified 0.1
*
*	@return bool - true if windows, false otherwise
*
*/
if( ! function_exists('is_windows') ){
function is_windows(){
    
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        return true;
    } else {
        return false;
    }
    
}
}

/**
*   is_linux
*
*   Checks if PHP is running on a Linux platform
*
*	@author Sander Marechal
*	@source https://stackoverflow.com/posts/5879078/edit
*
*   @since 0.1
*   @last_modified 0.1
*
*	@return bool - true if windows, false otherwise
*
*/
if( ! function_exists('is_linux') ){
function is_linux(){
    
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'LIN') {
        return true;
    } else {
        return false;
    }
    
}
}

/**
*   is_iis
*
*   Checks if running on an iis server
*
*   @author Gabriel Ryan Nahmias
*   @see https://stackoverflow.com/questions/9486261/check-if-php-is-installed-on-apache-or-iis-server
*
*   @return bool - true if apache, false if not
*   @return null - if server software variable not set
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( 'is_iis' ) ){
function is_iis(){
    
    if( isset( $_SERVER['SERVER_SOFTWARE'] ) ){
    
        if( stripos( $_SERVER['SERVER_SOFTWARE'], 'microsoft-iss' ) ){
            return true;
        } else {
            return false;
        }
        
    } else {
        
        return null;
        
    }
}
}

/**
*   is_apache
*
*   Checks if running on an apache server
*
*   @author untill
*   @see https://stackoverflow.com/questions/9486261/check-if-php-is-installed-on-apache-or-iis-server
*
*   @return bool - true if apache, false if not
*   @return null - if server software variable not set
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( 'is_apache' ) ){
function is_apache(){
    
    if( isset( $_SERVER['SERVER_SOFTWARE'] ) ){
        
        if( stripos( $_SERVER['SERVER_SOFTWARE'], 'microsoft-apache' ) ){
            return true;
        } else {
            return false;
        }
        
    } else {
        
        return null;
        
    }
    
}
}

/**
*   is_nginx
*
*   Checks if running on an nginx server
*
*   @return bool - true if nginx, false if not
*   @return null - if server software variable not set
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( 'is_nginx' ) ){
function is_nginx(){
    
    if( isset( $_SERVER['SERVER_SOFTWARE'] ) ){
        
        if( stripos( $_SERVER['SERVER_SOFTWARE'], 'nginx' ) ){
            return true;
        } else {
            return false;
        }
        
    } else {
        
        return null;
        
    }
    
}
}

/**
*   is_mobile
*
*   Test if the current browser runs on a mobile device (smart phone, tablet, etc.)
*
*   @author WordPress
*   @see https://developer.wordpress.org/reference/functions/wp_is_mobile/
*
*   @since 1.1
*   @last_modified  1.1
*
*   @return bool - true if mobile, false if not
*/
if( ! function_exists( 'is_mobile') ){
function is_mobile() {
    if ( empty( $_SERVER['HTTP_USER_AGENT'] ) ) {
        $is_mobile = false;
    } elseif ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Mobile' ) !== false // many mobile devices (all iPhone, iPad, etc.)
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Android' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Silk/' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Kindle' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'BlackBerry' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mini' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mobi' ) !== false ) {
            return true;
    } else {
        return false;
    }
}
}

/**
*   __return_true
*
*   A callback function that simply returns true
*
*   @author WordPress
*   @see https://codex.wordpress.org/Function_Reference/_return_true
*
*   @return bool true
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( '__return_true' ) ){
function __return_true(){
    return true;
}
}

/**
*   __return_false
*
*   A callback function that simply returns false
*
*   @author WordPress
*   @see https://codex.wordpress.org/Function_Reference/_return_false
*
*   @return bool false
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( '__return_false' ) ){
function __return_false(){
    return false;
}
}

/**
*   __return_zero
*
*   A callback function that simply returns zero
*
*   @author WordPress
*   @see https://codex.wordpress.org/Function_Reference/_return_zero
*
*   @return int 0
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( '__return_zero' ) ){
function __return_zero(){
    return 0;
}
}

/**
*   __return_null
*
*   A callback function that simply returns null
*
*   @author WordPress
*   @see https://codex.wordpress.org/Function_Reference/_return_null
*
*   @return null
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( '__return_null' ) ){
function __return_null(){
    return null;
}
}

/**
*   __return_empty_string
*
*   A callback function that simply returns an empty string
*
*   @author WordPress
*   @see https://codex.wordpress.org/Function_Reference/_return_empty_string
*
*   @return string ''
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( '__return_empty_string' ) ){
function __return_empty_string(){
    return '';
}
}

/**
*   __return_empty_array
*
*   A callback function that simply returns an empty array
*
*   @author WordPress
*   @see https://codex.wordpress.org/Function_Reference/_return_empty_array
*
*   @return array
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( '__return_empty_array' ) ){
function __return_empty_array(){
    return array();
}
}

/**
*   spaceship
*
*   Mimics the native spaceship operator in PHP7+ ( <=> )
*
*   @param mixed $one - item one
*   @param mixed $two - item two
*
*   @return return int - the result of the comparison
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( 'spaceship' ) ){
function spaceship( $one, $two ){
    
    // Use native PHP7 if available
    if( version_compare( PHP_VERSION, '7.0', '>=' ) ){
        
        return $one <=> $two;
        
    } else {
        
        // If less than PHP 7 then mimic it
    
        if( $one > $two ){

            return 1;

        } elseif( $one == $two ){

            return 0;

        } elseif( $one < $two ){

            return -1;

        }
        
    }
    
}
}