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
*   print_pretty
*   random_color
*   copyright
*   qr_url
*   qr_image
*   easter_date_orthodox
*
*/

/*
*   test_remote_file
*
*   Test if a remote file exists
*
*   @since v. 0.1
*   @last_modified v 0.1
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
			
			$content = file_get_contents( $file_location );

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
*   script
*
*   Print a Javascript file into the HTML
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param string	$name - name of script
*   @param string | array	$file_location - where the file can be found, or array if there's fallbacks
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
		
		// Check if file location has fallbacks or not
		if( is_array( $file_location ){
			
			foreach( $file_location as $file ){
				
				$test = test_remote_file( $file );
				
				if( $test !== false ){
					
					break;
					
				}
				
			}
		
		} else {
			
			$test = test_remote_file( $file );
			
		}
		
		if( $test !== false ){
			
			// Add the script name to the array
			$all_scripts[] = $name;
			
			// If we're wanting to print the script in the HTML and the file exists
			if( $inline == true ){
				
				// Get the content for output
				$content = file_get_contents( $test );
				
				// Output inline
				echo '<script type="text/javascript" id="' . $name . '"' . (($async == true)?' async="true"':'') . (($defer == true)?' defer="true"':'') . '>' . $content . '"</script>';
				
				
			} else {
			
				// Output the SRC
				echo '<script type="text/javascript" id="' . $name . '" src="' . $test . '"></script>';
			
			}
			
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
*   @param string | array	$file_location - where the file can be found, or array if there's fallbacks
*   @param bool		$inline - whether the file should be included externally or printed inline
*/

$all_styles = array();

if( ! function_exists( 'style') ){
function style( $name, $file_location, $inline = false ){
    
    // Call in the global
    global $all_styles;
	
	// Check that style doesn't already exist
	if( ! in_array( $name, $all_styles ) ){
		
		// Check if file location has fallbacks or not
		if( is_array( $file_location ){
			
			foreach( $file_location as $file ){
				
				$test = test_remote_file( $file );
				
				if( $test !== false ){
					
					break;
					
				}
				
			}
		
		} else {
			
			$test = test_remote_file( $file );
			
		}
		
		
		if( $test !== false ){
			
			// Add the style name to the array
            $all_styles[] = $name;
			
			if( $inline == true ){
				
				// Get the contents fo the file
				$content = file_get_contents( $test );
				
				// Output inline
				echo '<style type="text/css" id="' . $name . '">' . $content . '</style>';				
				
			} else {
				
				// Output SRC
				echo '<link type="text/css" rel="stylesheet" id="' . $name . '" href="' . $test . '" />';
				
				
			}
			
			
			
		} else {
			
			return false;
			
		}
	
	} else {
		
		// File must already exist
		return false;
		
	}


}
}

/*
*   print_pretty
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
if( ! function_exists( 'print_pretty' ) ){
function print_pretty( $data ){
		
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
*	@params int $size - value for height and width of image
*
*
*	@return string - the URL of the QR code
*/
if( ! function_exists( 'qr_url' ) ){
function qr_url( $data, $size = '300px' ){
  
  $qr_url = 'https://chart.googleapis.com/chart?cht=qr&chs=' . $size . 'x' . $size . '&chl=' . urlencode( $data );
  
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
*	@params int $size - value for height and width of image
*
*	@return string - an image tag for the generated QR code
*/
if( ! function_exists( 'qr_image' ) ){
function qr_image( $data, $size = '300px' ){
	
	$qr_rul = qr_url( $size, $data );
	
	echo '<img src="' . $qr_url . ' height="' . $size . '" width="' . $size . '" />';
	
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
function easter_date_orthodox( $year = date( 'Y')) { 
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