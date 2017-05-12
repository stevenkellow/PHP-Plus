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
			
			// Output inline
			echo '<script type="text/javascript" id="' . $name . '"' . (($async == true)?' async="true"':'') . (($defer == true)?' defer="true"':'') . '>' . $content . '"</script>';
		
		}

		// If we want to include the file via source
		if( $inline == false && validate_url( $file_location ) ){
			
			echo '<script type="text/javascript" id="' . $name . '" src="' . $file_location . '"></script>';
			
		}
	
	} else {
		
		return false;
		
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
			
			// Output inline
			echo '<style type="text/css" id="' . $name . '">' . $content . '</style>';
		
		}

		// If we want to include the file via source
		if( $inline == false && validate_url( $file_location ) ){
			
			echo '<link type="text/css" id="' . $name . '" href="' . $file_location . '" />';
			
		}
	
	} else {
		
		// File must already exist
		return false;
		
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
*   @output Organised array
*/
if( ! function_exists( 'print_pre' ) ){
function print_pre( $data ){
		
		echo '<pre>';
		print_r( $data );
		echo '</pre>';
		
}
}