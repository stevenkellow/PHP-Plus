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
*   is_mobile
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
	
	if( isset( $_SERVER['REMOTE_ADDR'] ) && !empty( $_SERVER['REMOTE_ADDR'] ) ){
		
		return $_SERVER['REMOTE_ADDR'];
		
	} elseif( isset( $_SERVER['HTTP_CLIENT_IP'] ) && !empty( $_SERVER['HTTP_CLIENT_IP'] ) ){
		
		return $_SERVER['HTTP_CLIENT_IP'];
		
	} elseif( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) && !empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ){
		
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
