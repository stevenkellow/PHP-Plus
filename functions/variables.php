<?php
/**
*	Variables functions
*
*	@package PHP Plus!
*
*/

/*  CONTENTS
*
*   get_browser_info
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
*   is_datetime
*   is_iterable
*   is_countable
*   spaceship
*   __return_true
*   __return_false
*   __return_zero
*   __return_empty_string
*   __return_empty_array
*   getcheck
*/

/**
*   get_browser_info
*
*   Get details of the user's browser (works for major browsers and OS)
*
*   @see http://php.net/manual/en/function.get-browser.php#101125
*   @see https://stackoverflow.com/a/15497878/7956549
*
*   @param string $agent - a user agent to decode
*
*   @return array $user_agent - an array of user agenet info
*
*	@since	1.1
*	@modified	1.1
*/
if( ! function_exists( 'get_browser_info' ) ){
function get_browser_info( $u_agent = false ){
    
    if( $u_agent == false ){
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
    }
    
    // Set blank defaults
	$os_name = 'Unknown';
	$os_version = 'Unknown';
	
    $browser_name = 'Unknown';
    $browser_version = 'Unknown';
	
    // Set some defaults
    $os_array = array(
        '/windows nt 10/i'      =>  'Windows 10',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );

	// Search for the current platform
    foreach( $os_array as $regex => $value ){ 

        if( preg_match( $regex, $u_agent ) ){
            $os_name = $value;
        }

    }
	
	// Get the OS version
	$os_pattern = '#(?<browser>' . $os_name . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if( !preg_match_all( $os_pattern, $u_agent, $os_matches ) ){
        // we have no matching number just continue
    }
	// Set version if it exists
	if( isset( $os_matches['version'][0] ) ){
		$os_version = $os_matches['version'][0];
	}
    
    // Next get the name of the useragent yes seperately and for good reason
    if( strpos( $u_agent,'MSIE') && !strpos( $u_agent,'Opera') ) 
    { 
        $browser_name = 'Internet Explorer'; 
        $ub = 'MSIE'; 
    }
	elseif( strpos( $u_agent,'IE') ) 
    { 
        $browser_name = 'Internet Explorer'; 
        $ub = 'IE'; 
    } 
	elseif( strpos( $u_agent,'Edge') ) 
    { 
        $browser_name = 'Edge'; 
        $ub = 'Edge'; 
    } 
    elseif( strpos( $u_agent,'Firefox') ) 
    { 
        $browser_name = 'Mozilla Firefox'; 
        $ub = 'Firefox'; 
    } 
    elseif( strpos( $u_agent,'Chrome') ) 
    { 
        $browser_name = 'Google Chrome'; 
        $ub = 'Chrome'; 
    } 
    elseif( strpos( $u_agent, 'Safari') ) 
    { 
        $browser_name = 'Apple Safari'; 
        $ub = 'Safari'; 
    } 
    elseif( strpos( $u_agent,'Opera')|| strpos( $u_agent,'OPR') ) 
    { 
        $browser_name = 'Opera'; 
        $ub = 'Opera'; 
    } 
    elseif( strpos( $u_agent,'Netscape') ) 
    { 
        $browser_name = 'Netscape'; 
        $ub = 'Netscape'; 
    }
     
    
    // finally get the correct version number
	if( $ub !== 'IE' ){
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known ) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	} else {
		$pattern = '/(?<browser>IE )+(?<version>[\d]*)/';
	}
    if( !preg_match_all( $pattern, $u_agent, $matches ) ){
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count( $matches['browser']);
    if( $i != 1 ){
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if( strripos( $u_agent,'Version') < strripos( $u_agent, $ub ) ){
            $browser_version = $matches['version'][0];
        }
        else {
            $browser_version = $matches['version'][1];
        }
    }
    else {
        $browser_version = $matches['version'][0];
    }
    
    // check if we have a number
    if( $browser_version == null || $browser_version == ''){
		$browser_version = 'Unknown';
	}
    
    return array(
		'browser' => array(
			'name' => $browser_name,
			'version' => $browser_version
		),
		'OS' => array(
			'name' => $os_name,
			'version' => $os_version
		),
        'pattern'   => $pattern,
        'userAgent' => $u_agent
    );
}
}

/**
*   is_ssl
*
*   Check if the site uses SSL or note
*
*	@author WordPress
*   @source https://developer.wordpress.org/reference/functions/is_ssl/
*
*	@return bool true|false - true if SSL, false otherwise
*
*   @since 0.1
*   @modified 0.1
*
*/
if( ! function_exists( 'is_ssl' ) ){
function is_ssl(){
	
    if( isset( $_SERVER['HTTPS'] ) ){
		if( 'on' == strtolower( $_SERVER['HTTPS'] ) ){
			return true;
		}
		if( '1' == $_SERVER['HTTPS'] ){
			return true;
		}
	} elseif( isset( $_SERVER['SERVER_PORT'] ) && ( '443' == $_SERVER['SERVER_PORT'] ) ){
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
*	@modified	1.1
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
*	@return string https:// | http://
*
*   @since 0.1
*   @modified 0.1
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
*	@return string IP Address
*
*   @since 0.1
*   @modified 0.1
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
*	@param array $availableLanguages - languages a site can use
*	@param string $default - the default language of the site
*
*	@return string language
*
*   @since 0.1
*   @modified 0.1
*
*/
if( ! function_exists( 'get_user_lang') ){
function get_user_lang( $availableLanguages, $default = 'en' ){
	
	if( isset( $_SERVER['HTTP_ACCEPT_LANGUAGE']) ){
		$langs=explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

		foreach( $langs as $value ){
			$choice=substr( $value,0,2 );
			if( in_array( $choice, $availableLanguages ) ){
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
*	@return bool - true if windows, false otherwise
*
*   @since 0.1
*   @modified 0.1
*
*/
if( ! function_exists('is_windows') ){
function is_windows(){
    
    if( strtoupper( substr( PHP_OS, 0, 3 ) ) === 'WIN'){
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
*	@return bool - true if windows, false otherwise
*
*   @since 0.1
*   @modified 0.1
*
*/
if( ! function_exists('is_linux') ){
function is_linux(){
    
    if( strtoupper( substr( PHP_OS, 0, 3 ) ) === 'LIN'){
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
*	@modified	1.1
*/
if( ! function_exists( 'is_iis' ) ){
function is_iis(){
    
    if( isset( $_SERVER['SERVER_SOFTWARE'] ) ){
    
        if( stripos( $_SERVER['SERVER_SOFTWARE'], 'microsoft-iis' ) ){
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
*	@modified	1.1
*/
if( ! function_exists( 'is_apache' ) ){
function is_apache(){
    
    if( isset( $_SERVER['SERVER_SOFTWARE'] ) ){
        
        if( stripos( $_SERVER['SERVER_SOFTWARE'], 'apache' ) ){
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
*	@modified	1.1
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
*   @return bool - true if mobile, false if not
*
*   @since 1.1
*   @modified  1.1
*
*/
if( ! function_exists( 'is_mobile') ){
function is_mobile(){
    if( empty( $_SERVER['HTTP_USER_AGENT'] ) ){
        $is_mobile = false;
    } elseif( strpos( $_SERVER['HTTP_USER_AGENT'], 'Mobile' ) !== false // many mobile devices (all iPhone, iPad, etc.)
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Android' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Silk/' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Kindle' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'BlackBerry' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mini' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mobi' ) !== false ){
            return true;
    } else {
        return false;
    }
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
*	@modified	1.1
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

/**
*   is_datetime
*
*   Checks if an element is a valid datetime
*
*   @param mixed $date - to check if the object is a datetime object, or can be converted into one
*
*   @return bool - true if it can be a datetime, false otherwise
*
*	@since	1.1
*	@modified	1.1
*/
if( ! function_exists( 'is_datetime' ) ){
function is_datetime( $date ){
    
    if( strtotime( $date ) || $date instanceof DateTime ){
        return true;
    } else {
        return false;
    }
    
}
}

/**
*   is_countable
*
*   Check if a variable can be used in count(), to check for errors in PHP 7.2+
*
*   @author Gabriel Caruso
*   @see https://wiki.php.net/rfc/is-countable
*
*   @param mixed $foo - the variable to check
*
*   @return bool - true if successful, false if not
*
*	@since	1.1
*	@modified	1.1
*/
if( ! function_exists( 'is_countable' ) ){
function is_countable( $foo ){
    if( is_array( $foo ) || $foo instanceof Countable ){
        // $foo is countable
        return true;
    } else {
        return false;
    }
}
}

/**
*   is_iterable
*
*   Checks if countable and count isn't zero
*
*   @author WordPress
*   @see https://make.wordpress.org/core/2018/05/17/new-php-polyfills-in-4-9-6/
*
*   @param mixed $foo - the variable to check
*
*   @return bool - true if successful, false if not
*
*	@since	1.1
*	@modified	1.1
*/
if( ! function_exists( 'is_iterable' ) ){
function is_iterable( $foo ){
    if( is_countable( $foo ) && count( $foo ) > 0 ){
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
*	@modified	1.1
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
*	@modified	1.1
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
*	@modified	1.1
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
*	@modified	1.1
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
*	@modified	1.1
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
*	@modified	1.1
*/
if( ! function_exists( '__return_empty_array' ) ){
function __return_empty_array(){
    return array();
}
}

/*
*   getcheck
*
*   Check if a $_GET particular get value is set
*
*   @param string $key - key to check for
*   @pram string $value - value to check for
*
*   @return bool - true if key-value exists, false otherwise
*
*	@since	1.1.2
*	@modified	1.1.2
*/
if( ! function_exists( 'getcheck' ) ){
function getcheck( $key, $value ){
    
    if( isset( $_GET[$key] ) && $_GET[$key] == $value ){
        return true;
    }
    return false;
    
}
}

/*
*   postcheck
*
*   Check if a $_POST particular value is set
*
*   @param string $key - key to check for
*   @pram string $value - value to check for
*
*   @return bool - true if key-value exists, false otherwise
*
*	@since	1.1.2
*	@modified	1.1.2
*/
if( ! function_exists( 'postcheck' ) ){
function postcheck( $key, $value ){
    
    if( isset( $_POST[$key] ) && $_POST[$key] == $value ){
        return true;
    }
    return false;
    
}
}