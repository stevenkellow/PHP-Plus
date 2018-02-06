<?php
/*
*	Output functions
*
*	@package PHP Plus!
*
*
*/

/*  CONTENTS
*
*   test_remote_file
*   script
*   style
*   print_pre
*   random_color
*   copyright
*   qr_url
*   qr_image
*   easter_date_orthodox
*   is_image
*   data_uri
*   mime_type
*
*/

/*
*   test_remote_file
*
*   Test if a remote file exists
*
*   @since 0.1
*   @last_modified 1.0.3
*
*   @param string	$file_location - the file to test
*
*   @return bool - true if file accessible, false if not
*/
if( ! function_exists( 'test_remote_file') ){
function test_remote_file( $file_location ){
	
	// Check URL is valid
	if( validate_url( $file_location ) === true ){
	
		// Check the file can be retrieved
		try {
			
			$content = @file_get_contents( $file_location );

			if ($content === false) {
				// Handle the error
				return false;
			} else {
				
				return $file_location;
				
			}
			
		} catch (Exception $e) {
			// Handle exception
			return false;
		}
		
	} else {
		
		return false;
		
	}

}
}

/*
*   print_pre
*
*   Send out a print_r request in a more readable format
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param array $data - array you want to output
*
*   @return organised array
*/
if( ! function_exists( 'print_pre' ) ){
function print_pre( $data ){
		
		echo '<pre>';
		print_r( $data );
		echo '</pre>';
		
}
}

/*
*   random_color
*
*   Generate random color
*
*   @author Jonas John
*   @source http://www.jonasjohn.de/snippets/php/random-color.htm
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param string $type - type of output: rgb or hex
*
*   @return string - color as hex, e.g. #ffffff , or rgb, e.g. rgb(0,0,0)
*/
if( ! function_exists( 'random_color') ){
function random_color( $type = 'hex'){
    
    if( $type == 'hex' ){
    
        $c = '#';
        while(strlen($c)<7){
            $c .= dechex( mt_rand( 0, 16 ) );
        }
   
        return $c;
    
        
    } else {
        
        $c = 'rgb(';
        $count = 1;
        while( $count < 4 ){
            
            $c .= mt_rand( 0, 255 );
            
            if( $count < 3 ){
                
                $c .= ',';
                
            }
            
            $count++;
            
        }
        
        $c .= ')';
        
        return $c;
        
        
    }
}
}

/*
*
*	copyright
*
*	Output an automatic copyright notice
*
*   @author Chris Coyier
*   @source https://css-tricks.com/snippets/php/automatic-copyright-year/
*
*   @since 0.1
*   @last_modified 0.1
*
*	@params int $year - a start year for copyright
*   @params bool $roman - use roman numerals for year
*
*	@return string - copyright notice like (c) 2017, (c) MMVII or (c) 2012 - 2017
*/
function copyright( $year = false, $roman = false ){
	
    if(intval($year) == false ){
        $year = date('Y');
    }
    
	if(intval($year) == date('Y')){
        // Output the copy symbol and either the year or the year in Roman numerals
        echo '&copy; ' . ($roman == false ? intval($year) : arabic2roman( intval($year) ));
    }
    
	if(intval($year) < date('Y')){
        // Output the copy symbol and either the year range or the year range in Roman numerals
        echo '&copy; ' . ($roman == false ? (intval($year) . ' - ' . date('Y')) : ( arabic2roman( intval($year) ) . ' - ' . arabic2roman( date('Y') )) );
    }
    
	if(intval($year) > date('Y')){
        // Output the copy symbol and the current year or the current year in Roman numerals
        echo '&copy; ' . ($roman == false ? date('Y') : arabic2roman( date('Y') ));
    } 
}

/*
*
*	qr_url
*
*	Generate a QR code URL using Google Charts API
*
*   @author Google
*   @source https://developers.google.com/chart/infographics/docs/qr_codes
*
*   @since 0.1
*   @last_modified 0.1
*
*   @params string $data - the info you want to encode
*	@params int $size - value for height and width of image in pixels
*
*
*	@return string - the URL of the QR code
*/
if( ! function_exists( 'qr_url' ) ){
function qr_url( $data, $size = '300' ){
  
  $qr_url = 'https://chart.googleapis.com/chart?cht=qr&chs=' . $size . 'x' . $size . '&chl=' . rawurlencode( $data );
  
  return $qr_url;
  
}
}

/*
*
*	qr_image
*
*	Generate a QR code image tag using Google Charts API
*
*   @author Google
*   @source https://developers.google.com/chart/infographics/docs/qr_codes
*
*   @params string $data - the info you want to encode
*	@params int $size - value for height and width of image in pixels
*
*	@return string - an image tag for the generated QR code
*/
if( ! function_exists( 'qr_image' ) ){
function qr_image( $data, $size = '300' ){
	
	$qr_url = qr_url( $data, $size );
	
	echo '<img src="' . $qr_url . '" height="' . $size . '" width="' . $size . '" />';
	
}
}

/*
*
*	easter_date_orthodox
*
*	Output the date of Easter for Easter Orthodox churches in the UNIX epoch (1970 to 2037)
*
*   @author maxie
*   @source http://php.net/manual/en/function.easter-date.php#83794
*
*	@params int $year - year to calculate easter for (default: current year)
*
*	@return int - timestamp of Easter (may want to use date to format)
*/
if( ! function_exists( 'easter_date_orthodox') ){
function easter_date_orthodox( $year = false ) { 
    
    if( $year === false ){
        $year = date( 'Y' );
    }
    
    $a = $year % 4; 
    $b = $year % 7; 
    $c = $year % 19; 
    $d = (19 * $c + 15) % 30; 
    $e = (2 * $a + 4 * $b - $d + 34) % 7; 
    $month = floor(($d + $e + 114) / 31); 
    $day = (($d + $e + 114) % 31) + 1; 
    
    $de = mktime(0, 0, 0, $month, $day + 13, $year); 
    
    return $de; 
}
}


/*
*
*	is_image
*
*	Check if a given resource is a GIF, JPEF, PNG or BMP image
*
*   @author Silver Moon
*   @source http://www.binarytides.com/php-check-if-file-is-an-image/
*
*	@params string - path or URL of file to check
*
*	@return bool - true if image, false if not
*/
function is_image($path){
    $a = getimagesize($path);
    $image_type = $a[2];
     
    if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP))){
        return true;
    }
    return false;
}
           
/*
*
*	data_uri
*
*	Create a data URI for a file for embedding in code
*
*   @author Chris Coyier
*   @source https://css-tricks.com/snippets/php/create-data-uris/
*
*	@params string - path or URL of file to encode
*   @params string - mime type of file (Maybe need to change that)
*
*	@return string - data uri of the file
*/
if(! function_exists( 'data_uri') ){
function data_uri($file) {
	
	if( is_image( $file ) ){
		
		  $contents=file_get_contents($file);
		  
		  //$mime = mime_content_type( $contents );
		  $base64=base64_encode($contents);
		  return "data:';base64,$base64";
  
	} else {
		
		// Likely a string, so just encode that
		return $base64_encode( $file );
		
	}
}
}

/*
*   mime_type
*
*   Returns the mime type of a file given the extension
*
*   @param string $ext - the file extension
*
*   @return string - the mime type
*
*	@since	1.02
*	@last_modified	1.0.2
*/
if( ! function_exists( 'mime_type' ) ){
function mime_type( $ext ){
    
    // Call in the list of mime types
    require_once( PATH_TO_PHP_PLUS . '/data/mime-types.php' );
    
    if( array_key_exists( $ext, $mime_types ) ){
		
		return $mime_types[$ext];
		
	} else {
		
		return false;
		
	}
    
}
}