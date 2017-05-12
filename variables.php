<?php
/*
*	Variables functions
*
*	@package PHP Plus!
*
*
*/

/*  CONTENTS
*
*   is_ssl
*   protocol
*   get_user_ip
*   get_user_lang
*
*/

/*
*   is_ssl
*
*   Check if the site uses SSL or note
*
*   @since 0.1
*   @last_modified 0.1
*
*	@author WordPress - https://core.trac.wordpress.org/browser/trunk/src/wp-includes/load.php
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

/*
*   protocol
*
*   Print the site's protocol
*
*   @since 0.1
*   @last_modified 0.1
*
*
*	@return string https:// | http://
*
*/
function protocol(){
    
    if( is_ssl() === true ){
        echo 'https://';
    } else {
        echo 'http://';
    }
    
}

/*
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
if( ! function_exists( 'get_user_ip' ){
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

/*
*   get_user_lang
*
*   Get the user's language
*
*   @since 0.1
*   @last_modified 0.1
*
*	@author Mohit Modan
*	@source http://blog.koonk.com/2015/07/46-useful-php-code-snippets-that-can-help-you-with-your-php-projects/
*
*	@params array $availableLanguages - languages a site can use
*	@params string $default - the default language of the site
*
*	@return string language
*
*/
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