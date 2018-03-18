<?php
/**
*	Input / output functions
*
*	@package PHP Plus!
*
*
*/

/*  CONTENTS
*
*   html_mail
*   quick_curl
*   google_analytics
*   facebook_pixel
*   csv_to_array
*   array_to_csv
*   is_json
*   csv_to_json
*   json_to_csv
*   json_file_to_array
*   array_to_json_file
*   json_encode_utf8
*   pretty_json
*   xml_to_json
*   xml_to_array
*   get_gravatar
*   zip
*   unzip
*   hash_email
*       email_hash
*   comma_explode
*	comma_implode
*   is_serialized
*   maybe_unserialize
*   maybe_serialize
*   serialize_fix
*   pipe_decode
*   pipe_encode
*   delete_file
*   directory_size
*   get_file_extension
*/

/**
*   html_mail
*
*   Wrap the default PHP mail function to allow for formatted emails and multiple sending
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param string/array $to - string of email to be sent to (if 1) or array if multiple
*   @param string       $subject - string of email's subject
*   @param string       $message - string of email's message, can also be function to output email contents
*/

if( ! function_exists( 'html_mail' ) ){
function html_mail($to, $subject, $message, $from_email, $from_name){
    
    // If we're sending to multiple people, separate them and add to string list
    if( is_array( $to ) ){
        
        // Implode the array and create a string with it
        $to = implode( ',', $to );
        
    }
    
    // Add some inline styles to the email (won't overwrite if the user adds their own)
    $message = str_replace( '<p>', '<p style="color:#000;>"', $message );
    
    // In case any of our lines are larger than 70 characters, we should use wordwrap()
    $message = wordwrap($message, 70, "\r\n");
    
    // To send HTML mail, the Content-type header must be set
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=utf-8';
    
    // Set the from and reply-to addresses
	if( is_string( $from_email ) && is_string( $from_name ) ){
		$headers[] = 'From: ' . $from_name . '<' . $from_email . '>';
		$headers[] = 'Reply-To: ' . $from_name . '<' . $from_email . '>';
	}
    
    // Send the email
    mail($to, $subject, $message, implode("\r\n", $headers));
    
 
}
}

/**
*   quick_curl
*
*   Simplify using REST cURL requests in PHP
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param string $url - url to contact about the data
*	@param string $user_auth - user authorisation if needed
*	@param string $rest - 'GET' | 'PUT' | 'PATCH' | 'POST' - the REST verb for the data
*	@param string $input - the data we want to retrieve, update or send
*	@param string $type - 'XML' | 'JSON' - the type of data we're wanting to send
*
*	@return mixed $data - whatever is retrieved or a confirmation of send, or if curl isn't installed false
*/
if( ! function_exists( 'quick_curl' ) ){
function quick_curl($url, $user_auth = null, $rest = 'GET', $input = null, $type = 'JSON'){
    
    // Check if cURL is installed
    if ( function_exists('curl_init') ){

	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url); // The URL we're using to get/send data
    
	if( $user_auth ){
		curl_setopt($ch, CURLOPT_USERPWD, $user_auth); // Add the authentication
	}
    
    if( $rest == 'POST' ){
        curl_setopt($ch, CURLOPT_POST, true); // Send a post request to the server
    } elseif ( $rest == 'PATCH' ){
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH'); // Send a patch request to the server to update the listing
    } elseif ( $rest == 'PUT'){
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); // Send a put request to the server to update the listing
    } // If POST or PATCH isn't set then we're using a GET request, which is the default
    
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15); // Timeout when connecting to the server
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); // Timeout when retrieving from the server
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // We want to capture the data returned, so set this to true
    //curl_setopt($ch, CURLOPT_HEADER, true);  // Get the HTTP headers sent with the data
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // We don't want to force SSL incase a site doesn't use it
    
    if( $rest !== 'GET' ){
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: ' . mime_type( $type ), 'Content-Length: ' . strlen( $input ) ) ); // Tell server to expect the right application type and the content length
        curl_setopt($ch, CURLOPT_POSTFIELDS, $input); // Send the actual data
    }

    // Get the response
    $response = curl_exec($ch);
    
    // Check if there's an error in the header
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // If there's any cURL errors
    if (curl_errno($ch) || ( $httpcode < 200 || $httpcode >= 300 )  ) {
        $data = 'error';
    } else {
		// Turn response into stuff we can use
        $data = json_decode( $response, true );
		
        curl_close($ch);
        
    }

    // Send the data back to the function calling the cURL
    return $data;
        
    } else {
        
        // cURL not installed so leave
        return false;
        
    }

	
}
}

/**
*   google_analytics
*
*   Output the Universal Analytics script for Google
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param string $tracking_code - standard Google Analytics tracking code, e.g. UA-xxxxxxxx-x
*
*	@return Analytics tracking code
*
*/
if( ! function_exists( 'google_analytics' ) ){
function google_analytics( $tracking_code = null ){
	
	if( $tracking_code ){
	
		ob_start();
		
		?>
		<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', '<?php echo $tracking_code; ?>', 'auto');
		ga('send', 'pageview');

		</script>
		<?php
		return ob_get_clean();
	
	} else {
		
		return false;
		
	}
}
}

/***
*   facebook_pixel
*
*   Output the Facebook Pixel
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param string $pixel_id - standard Facebook pixel ID
*
*	@return Facebook pixel code
*
*/
if( ! function_exists( 'facebook_pixel' ) ){
function facebook_pixel( $pixel_id ){
	
	// Check the pixel ID is an integer
	if( is_int( $pixel_id ) ){
	
        ob_start();

        ?>
        <script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '<?php echo $pixel_id; ?>');
        fbq('track', 'PageView');

        </script>
        <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?php echo $pixel_id; ?>&ev=PageView&noscript=1"/></noscript>
        <?php
        return ob_get_clean();
	
	} else {
		
		return false;
		
	}
	
}
}

/**
*   csv_to_array
*
*   Turn an uploaded CSV file into an array
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param file $file - a CSV file uploaded
*   @param bool $header_key - whether the first line is a header that can be used as a key
*
*	@return array $csv_array
*
*/
if( ! function_exists( 'csv_to_array') ){
function csv_to_array( $file, $header_key = true ){
	
	// Turn the file into an array
    $file_array = array_map( 'str_getcsv', file( $file ) );
    
    // Check that the CSV mapping worked
    if( is_array( $file_array ) ){
        
        // Check if we want to use the header row as a key
        if( $header_key == true ){
            
            // Create return and headers array
            $return_array = array();
            $headers = array();
            
            $row_count = 1;
            
            foreach( $file_array as $row ){
                
                // If it's the first row, then use this as the keys
                if( $row_count == 1 ){
                    
                    $headers = $row;
                    
                } else {
                    
                    // Go through each cell and use the key
                    $new_row = array_combine( $headers, $row );
                    
                    $return_array[] = $new_row;
                    
                }
                
                // Increment the row count
                $row_count++;
                
            }
            
            return $return_array;
            
        } else {
            
            return $file_array;
            
        }
		
	} else {
		
		return false;
		
	}
	
}
}


/**
*   array_to_csv
*
*   Turn an an array into a CSV
*
*	@author Richard
*	@source http://codecall.net/2014/03/13/9-most-useful-php-code-snippets-for-developers/
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param array $data - array to turn into CSV
*   @param file $file - place to save file to
*
*	@return file $contents - CSV to use
*
*/
if( ! function_exists( 'array_to_csv') ){
function array_to_csv( $data, $file = null, $delimiter = ',', $enclosure = '"') {
    
    if( $file == null ){
        $file = 'php://temp';
    }
    
    $handle = fopen($file, 'r+');
    foreach ($data as $line) {
           fputcsv($handle, $line, $delimiter, $enclosure);
    }
    rewind($handle);
    while (!feof($handle)) {
           $contents .= fread($handle, 8192);
    }
    fclose($handle);
    return $contents;
}
}

/**
*   is_json
*
*   Check if data is in JSON format
*
*	@author Henrik P. Hessel
*	@source http://stackoverflow.com/a/6041773/7956549
*
*   @since 0.1
*   @last_modified 1.0.2
*
*	@param array $data - data to check
*
*	@return bool true if it's json, false if not
*
*/
if( ! function_exists( 'is_json') ){
function is_json($string) {
    @json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}
}

/**
*   csv_to_json
*
*   Turn an uploaded CSV file into a json file
*
*   @since 0.1
*   @last_modified 1.1
*
*	@param file $file - a CSV file uploaded
*   @param string $location - path to create JSON file or null to return as json_encoded array
*
*	@return mixed - either a json file, json array or false
*
*/
if( ! function_exists( 'csv_to_json') ){
function csv_to_json( $file, $location = null ){
    
    // Turn the file into an array
    $data_array = csv_to_array( $file );
	
    // If data was turned into an array correctly
    if( $data_array !== false ){
        
        // Turn the data into JSON
        $json_array = json_encode( $data_array );
        
        if( $location !== null ){
            
            // Send the data to the location
            file_put_contents( $location, $data_array );
            
        } else {
            
            // Send out the array
            return $json_array;
            
        }
        
    } else {
        
        // Couldn't convert the CSV
        return false;
        
    }
	
}
}

/**
*   json_to_csv
*
*   Turn an a JSON file into a CSV
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param array $data - json array or file to turn into CSV
*   @param file $file - place to save file to
*
*	@return file $contents - CSV to create
*
*/
if( ! function_exists( 'json_to_csv') ){
function json_to_csv( $data, $file, $delimiter = ',', $enclosure = '"') {
    
    // If we're passed a file then get the data from a file
    if( is_file( $data ) ){
        $data = file_get_contents( $data );
    }
    
    // Check the data is in JSON format
    if( is_json( $data ) ){
        
        // Turn the JSON into an array
        $json_as_array = json_decode( $data );
        
        return array_to_csv( $json_as_array, $file, $delimiter, $enclosure );
        
    } else {
        
        // Not in JSON format
        return false;
        
    }
    
    
}
}

/**
*   json_file_to_array
*
*   Get data from a json file and turn it into an array
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param path $path - string of URL or path to get data from
*
*	@return array	- json file in array form
*/
if( ! function_exists( 'json_file_to_array') ){
function json_file_to_array( $path ){
	
	return json_decode( file_get_contents( $path ), true);
	
}
}

/**
*   array_to_json_file
*
*   Create or update a json file with data from an array
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param array 	$array - array of data to put to file
*   @param string	$path - path of file to create/update
*   @param bool		$update - whether to update existing values or update them (default true)
*   @param bool     $delete - whether to replace a file with new data (default false)
*
*	@reutrn bool	true if file was created, false if not
*/
if( ! function_exists( 'array_to_json_file') ){
function array_to_json_file( $array, $path, $update = true, $delete = false ){
	
	// Change the file completely, deleting old data
	if( $delete == true ){
		
		return file_put_contents( $path, $array );
		
	} else {
		
		// Add new data to the old file
		
		// Get the old array at that path
		$old_array = json_file_to_array( $path );
		
		if( is_array( $old_array ) ){
			
			// We want to replace old values with new ones, but keep any other data that's unchanged
			if( $update == true ){
			
				// Update the file with new elements
				$new_array = array_merge( $old_array, $array );
				
			} else {
				
				// We want to want to preserve any data that was already there, just changing new info
				$new_array = $old_array + $array;
				
			}
			
			// Send to the file
			return file_put_contents( $path, $new_array );
			
		} else {
			
			// The file isn't in array format so we can't do anything
			return false;
			
			
		}
		
		
	}
	
	
}
}

/**
*   json_encode_utf8
*
*   Encode a JSON item in UTF8
*
*   @author guilhenfsu
*   @source http://php.net/manual/en/function.json-encode.php#112020
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param array $data - array to turn into JSON
*
*	@return string $json - JSON string
*
*/
if( ! function_exists( 'json_encode_utf8') ){
function json_encode_utf8( $data ){
    
    $array = array_map( 'htmlentities', $data );

    $json = html_entity_decode( json_encode( $array ) );
    
    return $json;
}
}

/**
*	pretty_json
*
*	Output JSON in a formatted way
*
*	@since 1.0.2
*	@last_modified 1.1
*
*	@param array | object - json element
*   @param string $file - a file to send the output to
*
*	@return string - pretty json string or false if it isn't JSON
*/
if( ! function_exists( 'pretty_json' ) ){
function pretty_json( $json, $file = null ){
    
    // Check incase a JSON string is supplied
    if( is_string( $json ) && is_json( $json ) ){
	
		$json = json_decode( $json );
		
	} elseif( ! is_array( $json ) || ! is_object( $json ) ){
        
        // If it's not a JSON string, or an array/object then return false
        return false;
        
    }
    
    // Create the output
    $output = json_encode( $json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE );

    // Check whether to send to a file
    if( $output !== null ){
        return file_put_contents( $file, $output );
    } else {
        return $output;
    }

}
}

/**
*	xml_to_json
*
*   Turn XML (file or string) into JSON.
*
*   @author Antonio Max
*	@source https://stackoverflow.com/a/19391553
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param string | file  $xml_input - string or file path in XML format
*	@param bool       $file - whether a file or string
*
*	@return array
*
*/
if( ! function_exists('xml_to_array') ){
function xml_to_json( $xml_input, $file = true ){
    
    if( $file == true ){
        $xml_string = file_get_contents( $xml_input );
    } else {
        $xml_string = $xml_input;
    }
    $xml = simplexml_load_string($xml_string);
    return json_encode($xml);
    
}
}

/**
*	xml_to_array
*
*   Turn XML (file or string) into an array.
*
*   @author Antonio Max
*	@source https://stackoverflow.com/a/19391553
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param string | file  $xml_input - string or file path in XML format
*	@param bool       $file - whether a file or string
*
*	@return array
*
*/
if( ! function_exists('xml_to_array') ){
function xml_to_array( $xml_input, $file = true ){
    
    $json = xml_to_json( $xml_input, $file );
    return json_decode($json,TRUE);

    
}
}
    
/**
*	get_gravatar
*
*   Get either a Gravatar URL or complete image tag for a specified email address.
*
*   Turn a string into a slug
*
*	@see https://gravatar.com/site/implement/images/php/
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param string $email The email address
*	@param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
*	@param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
*	@param string $r Maximum rating (inclusive) [ g | pg | r | x ]
* 	@param bool $img True to return a complete IMG tag False for just the URL
*	@param array $atts Optional, additional key/value attributes to include in the IMG tag
*
*	@return String containing either just a URL or a complete image tag
*
*/
if( ! function_exists( 'get_gravatar') ){
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}
}

/**
*   zip
*
*   Zip a folder contents to a compressed file
*
*   @author Dador
*   @see https://stackoverflow.com/a/4914807/7956549
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param string $folder - the path to the folder you want to zip
*   @param string $destination_path - where you want to save the zip file
*
*   @return string $destination_path - where to find the zip file
*/
if( ! function_exists( 'zip' ) ){
function zip( $folder, $destination_path ){
    
    // Get real path for our folder
    $rootPath = realpath($folder);

    // Initialize archive object
    $zip = new ZipArchive();
    $zip->open($destination_path, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    // Create recursive directory iterator
    /** @var SplFileInfo[] $files */
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($rootPath),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $name => $file){
        
        // Skip directories (they would be added automatically)
        
        if (!$file->isDir()){
            // Get real and relative path for current file
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($rootPath) + 1);

            // Add current file to archive
            $zip->addFile($filePath, $relativePath);
        }
    }

    // Zip archive will be created only after closing object
    $zip->close();
	
	// Return the location of the file
	return $destination_path;
}
}

/**
*   unzip
*
*   Unzip a file to a specified location
*
*   @see http://php.net/manual/en/ziparchive.extractto.php
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param string $file - path to the file that you want to unzip
*   @param string $extractPath - path to the folder where you want to extract the contents
*
*	@return bool - true if it works, false if it doesn't
*
*/
if( ! function_exists( 'unzip') ){
function unzip( $file, $extractPath ){

	$zip = new ZipArchive;
	
	if ($zip->open($file) === true) {
		$zip->extractTo($extractPath);
		$zip->close();
		return true;
	} else {
		return false;
	}
	
	
}
}

/**
*	hash_email
*
*	Return the md5 hash of an email
*
*	@since 1.0.2
*	@last_modified 1.0.2
*
*	@param string $email - an email to hash
*
*	@return string | bool - either the md5 hash or false if it's not an email
*/
if( ! function_exists( 'hash_email' ) ){
function hash_email( $email ){
	
	$formatted_email = strtolower( trim( $email ) );

	if( ! validate_email( $formatted_email ) ){
		
		return false;
			
	}
	
	return md5( $formatted_email );
	
}
}

/**
*	email_hash
*
*	Alias of hash_email
*
*	@since 1.0.2
*	@last_modified 1.0.2
*
*	@param string $email - an email to hash
*
*	@return string | bool - either the md5 hash or false if it's not an email
*/
if( ! function_exists( 'email_hash' ) ){
function email_hash( $email ){
	
	return hash_email( $email );
	
}
}

/**
*   comma_explode
*
*   Turns a comma separated item into an array
*
*	@since	0.1
*	@last_modified	0.1
*
*   @param string $array_string - the comma separated array
*
*   @return array $output - the array
*/
if( ! function_exists( 'comma_explode' ) ){
function comma_explode( $array_string ){
	
    // Turn the string into an array
	$new_arr = explode( ',', $array_string );

	$output = array();

    // Clean each item
	foreach( $new_arr as $item ){
		
        // Trim whitespace
		$new_item = trim( $item );
		
        // Check the item is not blank
		if( strlen( $new_item ) > 0 ){
			
			$output[] = $new_item;	
			
		}
		
	}
	
    // Return array
	return $output;
	
	
}
}

/**
*   comma_implode
*
*   Turns an array into a comma separated string
*
*	@since	1.0.3
*	@last_modified	1.0.3
*
*   @param array $array - an array
*
*   @return string $array - a comma delimited string
*/
if( ! function_exists( 'comma_implode' ) ){
function comma_implode( $array ){
	
    // Clean each item
	$output = array();
	foreach( $array as $item ){
		
        // Trim whitespace
		$new_item = trim( $item );
		
        // Check the item is not blank
		if( strlen( $new_item ) > 0 ){
			
			$output[] = $new_item;	
			
		}
		
	}
	
    // Return string
	return implode( ',', $output );
	
	
}
}

/**
*   is_serialized
*
*   Tests if an input is valid PHP serialized string.
*
*   Checks if a string is serialized using quick string manipulation
*   to throw out obviously incorrect strings. Unserialize is then run
*   on the string to perform the final verification.
*
*   Valid serialized forms are the following:
*   <ul>
*   <li>boolean: <code>b:1;</code></li>
*   <li>integer: <code>i:1;</code></li>
*   <li>double: <code>d:0.2;</code></li>
*   <li>string: <code>s:4:"test";</code></li>
*   <li>array: <code>a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}</code></li>
*   <li>object: <code>O:8:"stdClass":0:{}</code></li>
*   <li>null: <code>N;</code></li>
*   </ul>
*
*   @author		Chris Smith <code+php@chris.cs278.org>
*   @copyright	Copyright (c) 2009 Chris Smith (http://www.cs278.org/)
*   @license		http://sam.zoy.org/wtfpl/ WTFPL
*
*   @since 0.1
*   @last_modified  0.1
*
*   @param		string	$value	Value to test for serialized form
*   @param		mixed	$result	Result of unserialize() of the $value
*   @return		boolean			True if $value is serialized data, otherwise false
*/
if( ! function_exists( 'is_serialized' ) ){
function is_serialized($value, &$result = null){
	// Bit of a give away this one
	if (!is_string($value)){
		return false;
	}

	// Serialized false, return true. unserialize() returns false on an
	// invalid string or it could return false if the string is serialized
	// false, eliminate that possibility.
	if ($value === 'b:0;')
	{
		$result = false;
		return true;
	}

	$length	= strlen($value);
	$end	= '';

	switch ($value[0])	{
		case 's':
			if ($value[$length - 2] !== '"'){
				return false;
			}
		case 'b':
		case 'i':
		case 'd':
			// This looks odd but it is quicker than isset()ing
			$end .= ';';
		case 'a':
		case 'O':
			$end .= '}';

			if ($value[1] !== ':'){
				return false;
			}

			switch ($value[2]){
				case 0:
				case 1:
				case 2:
				case 3:
				case 4:
				case 5:
				case 6:
				case 7:
				case 8:
				case 9:
				break;

				default:
					return false;
			}
		case 'N':
			$end .= ';';

			if ($value[$length - 1] !== $end[0]){
				return false;
			}
		break;

		default:
			return false;
	}

	if (($result = @unserialize($value)) === false)	{
		$result = null;
		return false;
	}
	return true;
}
}

/**
*   maybe_unserialize
*
*   Return unserialized value of item
*
*	@since	0.1
*	@last_modified	0.1
*
*   @param mixed $item - item to check
*
*   @return mixed $mixed - item ( unserialized if array or object )
*/
if( ! function_exists( 'maybe_unserialize' ) ){
function maybe_unserialize( $item ){
    
    if( is_serialized( $item ) ){
        return unserialize( $item );
    } else {
        return $item;
    }
}
}

/**
*   maybe_serialize
*
*   Return serialized value of array or object, skip others
*
*	@since	0.1
*	@last_modified	0.1
*
*   @param mixed $item - item to check
*
*   @return mixed $tiem - item (serialized if array or object )
*/
if( ! function_exists( 'maybe_serialize' ) ){
function maybe_serialize( $item ){
    
    if( is_array( $item ) || is_object( $item ) ){
        return serialize( $item );
    } else {
        return $item;
    }
    
}
}

/**
*   serialize_fix
*
*   Unserializes partially-corrupted arrays that occur sometimes. Addresses
*   specifically the `unserialize(): Error at offset xxx of yyy bytes` error.
*
*   NOTE: This error can *frequently* occur with mismatched character sets
*   and higher-than-ASCII characters.
*
*   @author Theodore R. Smith of PHP Experts, Inc. <http://www.phpexperts.pro/>
*   @see https://github.com/brandonwamboldt/utilphp/blob/master/src/utilphp/util.php
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param string $brokenSerializedData - serialized string to fix
*
*   @return string $fixdSerializedData - fixed serialized string
*/
if( ! function_exists( 'serialize_fix' ) ){
function serialize_fix($brokenSerializedData){
    $fixdSerializedData = preg_replace_callback('!s:(\d+):"(.*?)";!', function ($matches) {
        $snip = $matches[2];
        return 's:' . strlen($snip) . ':"' . $snip . '";';
    }, $brokenSerializedData);
    return $fixdSerializedData;
}
}

/**
*   pipe_decode
*
*   Create an array from a pipe separated string
*
*	@since	0.1
*	@last_modified	0.1
*
*   @param string $string - pipe separated string
*
*   @return array - array
*/
if( ! function_exists( 'pipe_decode' ) ){
function pipe_decode( $string ){
	
	if( is_string( $string ) && strstr( $string, '|'  ) ){
		
		return explode( '|', trim( $string, '|' ) );
		
	} else {
        
        return $string;
    }
	
}
}

/**
*   pipe_encode
*
*   Converts an array into a pipe separated string
*
*	@since	0.1
*	@last_modified	0.1
*
*   @param array $array - an array
*
*   @return string - pipe separated string
*/
if( ! function_exists( 'pipe_encode' ) ){
function pipe_encode( $array ){
	
	if( is_array( $array ) ){
		
		return '|' . implode( '|', $array ) . '|';	
		
	} else {
        
        return $array;
        
    }
	
	
}
}

/**
*   delete_file
*
*   Alias of unlink
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param string $file - path to the file to delete
*
*   @return type $return - what comes out
*/
if( ! function_exists( 'delete_file' ) ){
function delete_file( $file ){
    
    return unlink( $file );
    
}
}

/**
*   directory_size
*
*   Returns size of a given directory in bytes.
*
*   @author brandonwamboldt
*   @see https://github.com/brandonwamboldt/utilphp/blob/master/src/utilphp/util.php
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param string $dir - the directory to check
*   @param string $format - whether to return the bytes as integer or formatted
*
*   @return integer | string - the size of the directory
*/
if( ! function_exists( 'directory_size' ) ){
function directory_size($dir, $format = 'int' ){
    $size = 0;
    foreach(new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir, \FilesystemIterator::CURRENT_AS_FILEINFO | \FilesystemIterator::SKIP_DOTS)) as $file => $key) {
        if ($key->isFile()) {
            $size += $key->getSize();
        }
    }
    
    // Check how to format the size
    if( $format == 'int' || $format == 'integer' ){
        return $size;
    } else {
        return size_format( $size );
    }
}
}

/**
*   get_file_extension
*
*   Get the file type
*
*   @author Paulund
*   @see https://paulund.co.uk/get-the-file-extension-in-php
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param string $file - the file path
*
*   @return string - the file extension
*/
if( ! function_exists( 'get_file_extension' ) ){
function get_file_extension( $file ){
    return pathinfo($file, PATHINFO_EXTENSION);
}
}