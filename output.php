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
*   script
*   style
*   print_pre
*   random_color
*   copyright
*   qr_url
*   qr_image
*
*/

/*
*   script
*
*   Print a Javascript file into the HTML
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param string	$name - name of script
*   @param string	$file_location - where the file can be found
*   @param bool		$inline - whether the file should be included externally or printed inline
*   @param bool     $async - whether the script should load asynchronously - have this as false if the script has a child dependency
*   @param bool     $defer - whether the script should load after the DOM is loaded, normally better for speed if this is true
*/

$all_scripts = array();
if( ! function_exists( 'script' ) ){
function script( $name, $file_location, $inline = false, $async = false, $defer = true ){
    
    // Call in the global
    global $all_scripts;
	
	// Check that script doesn't already exist
	if( ! in_array( $name, $all_scripts ) ){

		// If we're wanting to print the script in the HTML and the file exists
		if( $inline == true && validate_url( $file_location ) ){
			
			// Check the file can be retrieved
			try {
				
                $content = file_get_contents( $file_location );

				if ($content === false) {
					// Handle the error
					return false;
				}
                
			} catch (Exception $e) {
				// Handle exception
				return false;
			}
            
            // Add the script name to the array
            $all_scripts[] = $name;
			
			// Output inline
			echo '<script type="text/javascript" id="' . $name . '"' . (($async == true)?' async="true"':'') . (($defer == true)?' defer="true"':'') . '>' . $content . '"</script>';
		
		}

		// If we want to include the file via source
		if( $inline == false && validate_url( $file_location ) ){
            
            // Add the script name to the array
            $all_scripts[] = $name;
			
			echo '<script type="text/javascript" id="' . $name . '" src="' . $file_location . '"></script>';
			
		}
	
	} else {
		
		return false;
		
	}


}
}

/*
*   style
*
*   Print a CSS file into the HTML
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param string	$name - name of style
*   @param string	$file_location - where the file can be found
*   @param bool		$inline - whether the file should be included externally or printed inline
*/

$all_styles = array();

if( ! function_exists( 'style') ){
function style( $name, $file_location, $inline = false ){
    
    // Call in the global
    global $all_styles;
	
	// Check that style doesn't already exist
	if( ! in_array( $name, $all_styles ) ){

		// If we're wanting to print the style in the HTML and the file exists
		if( $inline == true && validate_url( $file_location ) ){
			
			// Check the file can be retrieved
			try {
				
                $content = file_get_contents( $file_location );

				if ($content === false) {
					// Handle the error
					return false;
				}
                
			} catch (Exception $e) {
				// Handle exception
				return false;
			}
            
            // Add the style name to the array
            $all_styles[] = $name;
			
			// Output inline
			echo '<style type="text/css" id="' . $name . '">' . $content . '</style>';
		
		}

		// If we want to include the file via source
		if( $inline == false && validate_url( $file_location ) ){
            
            // Add the style name to the array
            $all_styles[] = $name;
			
			echo '<link type="text/css" rel="stylesheet" id="' . $name . '" href="' . $file_location . '" />';
			
		}
	
	} else {
		
		// File must already exist
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
*
*	@return string - copyright notice like (c) 2012 - 2017
*/
function copyright($year = false ){
	
    if(intval($year) == false ){
        $year = date('Y');
    }
    
	if(intval($year) == date('Y')){
        echo '&copy; ' . intval($year);
    }
    
	if(intval($year) < date('Y')){
        echo '&copy; ' . intval($year) . ' - ' . date('Y');
    }
    
	if(intval($year) > date('Y')){
        echo '&copy; ' . date('Y');
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
*	@params int $size - value for height and width of image
*   @params string $data - the info you want to encode
*
*	@return string - the URL of the QR code
*/
if( ! function_exists( 'qr_url' ) ){
function qr_url( $size, $data ){
  
  $qr_url = 'https://chart.googleapis.com/chart?cht=qr&chs=' . $size . 'x' . $size . '&chl=' . urlencode( $data );
  
  return $qr_url;
  
}
}

/*
*
*	qr_url
*
*	Generate a QR code image tag using Google Charts API
*
*   @author Google
*   @source https://developers.google.com/chart/infographics/docs/qr_codes
*
*	@params int $size - value for height and width of image
*   @params string $data - the info you want to encode
*
*	@return string - an image tag for the generated QR code
*/
if( ! function_exists( 'qr_image' ) ){
function qr_image( $size, $data ){
	
	$qr_rul = qr_url( $size, $data );
	
	echo '<img src="' . $qr_url . ' height="' . $size . '" width="' . $size . '" />';
	
}
}