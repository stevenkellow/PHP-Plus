<?php
/**
*	Output functions
*
*	@package PHP Plus!
*
*/

/*  CONTENTS
*
*   test_remote_file
*   print_pre
*   random_color
*   qr_url
*   qr_image
*   is_image
*   data_uri
*   mime_type
*   html_table
*   dd
*   e
*	size_format
*   selected
*   checked
*   disabled
*   _checked_disabled_helper
*   table_row
*/

/**
*   test_remote_file
*
*   Test if a remote file exists
*
*   @param string	$file_location - the file to test
*
*   @return bool - true if file accessible, false if not
*
*   @since 0.1
*   @modified 1.0.3
*
*/
if( ! function_exists( 'test_remote_file') ){
function test_remote_file( $file_location ){
	
	// Check URL is valid
	if( validate_url( $file_location ) === true ){
	
		// Check the file can be retrieved
		try {
			
			$content = @file_get_contents( $file_location );

			if( $content === false ){
				// Handle the error
				return false;
			} else {
				
				return $file_location;
				
			}
			
		} catch ( Exception $e ){
			// Handle exception
			return false;
		}
		
	} else {
		
		return false;
		
	}

}
}

/**
*   print_pre
*
*   Send out a print_r request in a more readable format
*
*   @param array | object $data - array you want to output
*
*   @since 0.1
*   @modified 0.1
*
*/
if( ! function_exists( 'print_pre' ) ){
function print_pre( $data ){
		
    echo '<pre>';
    print_r( $data );
    echo '</pre>';
		
}
}

/**
*   random_color
*
*   Generate random color
*
*   @author Jonas John
*   @source http://www.jonasjohn.de/snippets/php/random-color.htm
*
*   @param string $type - type of output: rgb or hex
*
*   @return string - color as hex, e.g. #ffffff , or rgb, e.g. rgb(0,0,0)
*
*   @since 0.1
*   @modified 0.1
*
*/
if( ! function_exists( 'random_color') ){
function random_color( $type = 'hex'){
    
    if( $type == 'hex' ){
    
        $c = '#';
        while( strlen( $c )<7 ){
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

/**
*
*	qr_url
*
*	Generate a QR code URL using Google Charts API
*
*   @author Google
*   @source https://developers.google.com/chart/infographics/docs/qr_codes
*
*   @param string $data - the info you want to encode
*	@param int $size - value for height and width of image in pixels
*
*	@return string - the URL of the QR code
*
*   @since 0.1
*   @modified 0.1
*
*/
if( ! function_exists( 'qr_url' ) ){
function qr_url( $data, $size = '300' ){
  
    $qr_url = 'https://chart.googleapis.com/chart?cht=qr&chs=' . $size . 'x' . $size . '&chl=' . rawurlencode( $data );
  
    return $qr_url;
  
}
}

/**
*
*	qr_image
*
*	Generate a QR code image tag using Google Charts API
*
*   @author Google
*   @source https://developers.google.com/chart/infographics/docs/qr_codes
*
*   @param string $data - the info you want to encode
*	@param int $size - value for height and width of image in pixels
*
*	@return string - an image tag for the generated QR code
*
*   @since  0.1
*   @modified  0.1
*/
if( ! function_exists( 'qr_image' ) ){
function qr_image( $data, $size = '300' ){
	
    $qr_url = qr_url( $data, $size );
	
	return '<img src="' . $qr_url . '" height="' . $size . '" width="' . $size . '" />';
	
}
}

/**
*
*	is_image
*
*	Check if a given resource is a GIF, JPEF, PNG or BMP image
*
*   @author Silver Moon
*   @source http://www.binarytides.com/php-check-if-file-is-an-image/
*
*	@param string - path or URL of file to check
*
*	@return bool - true if image, false if not
*
*	@since	0.1
*	@modified	0.1
*
*/
if( ! function_exists( 'is_image' ) ){
function is_image( $path ){
    $a = getimagesize( $path );
    $image_type = $a[2];
     
    if( in_array( $image_type , array( IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP ) )){
        return true;
    }
    return false;
}
}
           
/**
*
*	data_uri
*
*	Create a data URI for a file for embedding in code
*
*   @author Chris Coyier
*   @source https://css-tricks.com/snippets/php/create-data-uris/
*
*	@param string - path or URL of file to encode
*   @param string - mime type of file (Maybe need to change that)
*
*	@return string - data uri of the file
*
*	@since	0.1
*	@modified	1.1
*
*/
if( ! function_exists( 'data_uri') ){
function data_uri( $file ){
    
    try{
	
        $contents=file_get_contents( $file );

        //$mime = mime_content_type( $contents );
        $base64=base64_encode( $contents );
        return "data:';base64, $base64";
        
    } catch( Exception $e ){
        
        return false;
        
    }
}
}

/**
*   mime_type
*
*   Returns the mime type of a file given the extension
*
*   @param string $ext - the file extension
*
*   @return string - the mime type
*
*	@since	1.0.2
*	@modified	1.1
*
*/
if( ! function_exists( 'mime_type' ) ){
function mime_type( $ext ){
    
    // Call in the list of mime types
    include_once( PATH_TO_PHP_PLUS . '/data/mime-types.php' );
    
    if( array_key_exists( $ext, $mime_types ) ){
		
		return $mime_types[$ext];
		
	} else {
		
		return false;
		
	}
    
}
}

/**
*   html_table
*
*   Print a HTML table
*
*   @param array $headers - an array where each item is a header title
*   @param array $data - an array, where each item is an array containing cells
*   @param array $atts - an array of attributes to add to the table
*
*	@since	1.1
*	@modified	1.1.1
*
*/
if( ! function_exists( 'create_table' ) ){
function create_table( $headers, $data, $atts = array() ){
	
	// Create the table
    if( empty( $atts ) ){
	   
        $output = '<table>';
        
    } else {
        
        $output = '<table ' . html_atts_string( $atts ) . '>';
        
    }
	
	// If there are header rows then add them here
	if( ! empty( $headers ) && $headers !== false ){
		
		$output .= '<thead><tr>';
		
		foreach( $headers as $head ){
			
			$output .= '<th>' . $head . '</th>';
			
		}
		
		$output .= '</tr></thead>';
		
	}
	
	// Open the body of the table
	$output .= '<tbody>';
	
	// Go through each row
	foreach( $data as $row ){
		
		// Create the row
		$output .= '<tr>';
		
		// Create a cell for each row
		foreach( $row as $cell ){
			
			$output .= '<td>' . $cell . '</td>';
			
		}
		
		$output .= '</tr>';
		
	}
	
	// Close the table
	$output .= '</tbody></table>';
	
	echo $output;
	
	
}
}

/**
*   dd
*
*   Dump the variable and end execution of the script
*
*   @param mixed $variable - the variable to dump
*
*	@since	1.1
*	@modified	1.1
*
*/
if( ! function_exists( 'dd' ) ){
function dd( $variable ){
    
    var_dump( $variable );
    exit();
    
}
}

/**
*   e
*
*   Shorthand to run htmlentities over a string
*
*   @param string $string - string to sanitise
*
*   @return string - sanitised string
*
*	@since	1.1
*	@modified	1.1
*
*/
if( ! function_exists( 'e' ) ){
function e( $string ){
    
    return htmlentities( $string );
    
}
}

/**
*   size_format
*
*   Convert number of bytes largest unit bytes will fit into.
*
*   It is easier to read 1 KB than 1024 bytes and 1 MB than 1048576 bytes. Converts
*   number of bytes to human readable number by taking the number of that unit
*   that the bytes will go into it. Supports TB value.
*
*   Please note that integers in PHP are limited to 32 bits, unless they are on
*   64 bit architecture, then they have 64 bit size. If you need to place the
*   larger size then what PHP integer type will hold, then use a string. It will
*   be converted to a double, which should always have 64 bit length.
*
*   Technically the correct unit names for powers of 1024 are KiB, MiB etc.
*
*   @author WordPress
*   @see https://developer.wordpress.org/reference/functions/size_format/
*
*   @param int|string $bytes    Number of bytes. Note max integer size for integers.
*   @param int        $decimals Optional. Precision of number of decimal places. Default 0.
*   @return string|false False on failure. Number string on success.
*
*   @since 1.1
*   @modified 1.1
*/
if( ! function_exists( 'size_format' ) ){
function size_format( $bytes, $decimals = 0 ){
	
    $quant = array(
		'TB' => TB_IN_BYTES,
		'GB' => GB_IN_BYTES,
		'MB' => MB_IN_BYTES,
		'KB' => KB_IN_BYTES,
		'B'  => 1,
	);

	if( 0 === $bytes ){
		return number_format( 0, $decimals ) . ' B';
	}

	foreach( $quant as $unit => $mag ){
		if( doubleval( $bytes ) >= $mag ){
			return number_format( $bytes / $mag, $decimals ) . ' ' . $unit;
		}
	}

	return false;
    
}
}

/**
*   selected
*
*   Outputs 'selected' if the value matches
*
*   @param mixed $one - the first value to compare
*   @param mixed $two - the second value to compare - defaults to 'selected'
*   @param bool $echo - whether to echo the result
*
*   @return string - either 'selected' if equal, or empty string otherwise
*
*	@since	1.1
*	@modified	1.1
*/
if( ! function_exists( 'selected' ) ){
function selected( $one, $two = 'selected', $echo = true ){
    
    return __checked_selected_helper( $one, $two, $echo, 'selected');
    
}
}

/**
*   checked
*
*   Outputs 'checked' if the value matches
*
*   @param mixed $one - the first value to compare
*   @param mixed $two - the second value to compare - defaults to 'checked
*   @param bool $echo - whether to echo the result
*
*   @return string - either 'checked' if equal, or empty string otherwise
*
*	@since	1.1
*	@modified	1.1
*/
if( ! function_exists( 'checked' ) ){
function checked( $one, $two = 'checked', $echo = true ){
    
    return __checked_selected_helper( $one, $two, $echo, 'checked');
    
}
}

/**
*   disabled
*
*   Outputs 'disabled' if the value matches
*
*   @param mixed $one - the first value to compare
*   @param mixed $two - the second value to compare - defaults to disabled
*   @param bool $echo - whether to echo the result
*
*   @return string - either 'disabled' if equal, or empty string otherwise
*
*	@since	1.1
*	@modified	1.1
*/
if( ! function_exists( 'disabled' ) ){
function disabled( $one, $two = 'disabled', $echo = true ){
    
    return __checked_selected_helper( $one, $two, $echo, 'disabled');
    
}
}

/**
*   __checked_selected_helper
*
*   Outputs attribute if the value matches
*
*   @param mixed $helper - the first value to compare
*   @param mixed $current - the second value to compare
*   @param bool $echo - whether to echo the result
*   @param string $type - the attribute to output
*
*   @return string - either 'disabled' if equal, or empty string otherwise
*
*	@since	1.1
*	@modified	1.1
*/
if( ! function_exists( '__checked_selected_helper' ) ){
function __checked_selected_helper( $helper, $current, $echo, $type ){
    
    if ( (string) $helper === (string) $current ){
        $output = $type . '="' . $type . '"';
    } else {
        $output = '';
    }
    
    if( $echo ){
        echo $output;
    }
    return $output;
    
}
}

/**
*   remove_utf8_bom
*
*   Remove the UTF-8 byte-order marker which can cause issues when converting text
*
*   @param string $text - text to fix
*
*   @return string $text - the fixed text
*
*	@since	1.1.1
*
*/
if( ! function_exists( 'remove_utf8_bom' ) ){
function remove_utf8_bom( $text ){
        
    $bom = pack('H*','EFBBBF');
    $text = preg_replace("/^$bom/", '', $text);
    return $text;
        
}
}

/**
*   add_utf8_bom
*
*   Add the UTF-8 byte-order marker
*
*   @param string $text - text to fix
*
*   @return string $text - the fixed text
*
*	@since	1.1.1
*
*/
if( ! function_exists( 'add_utf8_bom' ) ){
function add_utf8_bom( $text ){
    
    $bom = pack('H*','EFBBBF');
    
    return $bom.$text;
    
}

/**
 * table_row
 * 
 * Output a table row from arguments
 * 
 * @param string for a table row
 * 
 * @since 1.1.4
 * 
 */
 if( ! function_exists( 'table_row') ){
 function table_row(){

    $cols = func_get_args();

    $output = '<tr>';

    foreach( $cols as $col ){

        $output .= '<td>' . $col . '</td>';

    }

    echo $output . '</tr>';

 }
 }

}