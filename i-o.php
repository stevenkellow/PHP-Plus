<?php
/*
*	Input / output functions
*
*	@package PHP Plus!
*
*
*/

/*  CONTENTS
*
*   send_mail
*   quick_curl
*   google_analytics
*   facebook_pixel
*   csv_to_array
*   array_to_csv
*   get_gravatar
*   unzip
*
*/

/*
*   send_mail
*
*   Wrap the default PHP mail function to allow for formatted emails and multiple sending
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param string/array $to - string of email to be sent to (if 1) or array if multiple
*   @param string       $subject - string of email's subject
*   @param string       $message - string of email's message, can also be function to output email contents
*/

if( ! function_exists( 'send_mail' ) ){
function send_mail($to, $subject, $message, $from_email, $from_name){
    
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

/*
*   quick_curl
*
*   Simplify using REST cURL requests in PHP
*
*   @since 0.1
*   @last_modified 0.1
*
*	@params string $url - url to contact about the data
*	@params string $user_auth - user authorisation if needed
*	@params string $rest - 'GET' | 'PUT' | 'PATCH' | 'POST' - the REST verb for the data
*	@params string $input - the data we want to retrieve, update or send
*	@params string $type - 'XML' | 'JSON' - the type of data we're wanting to send
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
		
		// Change to XML if need be
		if( $type == 'XML' || $type == 'xml' ){
			$type = 'xml';
		}
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/' . $type, 'Content-Length: ' . strlen( $input ) ) ); // Tell server to expect the right application type and the content length
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

/*
*   google_analytics
*
*   Output the Universal Analytics script for Google
*
*   @since 0.1
*   @last_modified 0.1
*
*	@params string $tracking_code - standard Google Analytics tracking code, e.g. UA-xxxxxxxx-x
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

/*
*   facebook_pixel
*
*   Output the Facebook Pixel
*
*   @since 0.1
*   @last_modified 0.1
*
*	@params string $pixel_id - standard Facebook pixel ID
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

/*
*   csv_to_array
*
*   Turn an uploaded CSV file into an array
*
*   @since 0.1
*   @last_modified 0.1
*
*	@params file $file - a CSV file uploaded
*
*	@return array $csv_array
*
*/
if( ! function_exists( 'csv_to_array') ){
function csv_to_array( $file ){
	
	// Turn the file into an array
    $file_array = array_map( 'str_getcsv', file( $file ) );
    
    // Check that the CSV mapping worked
    if( is_array( $file_array ) ){
		
		return $file_array;
		
	} else {
		
		return false;
		
	}
	
}
}


/*
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
*	@params array $data - array to turn into CSV
*
*	@return file $contents - CSV to use
*
*/
if( ! function_exists( 'array_to_csv') ){
function array_to_csv( $data, $delimiter = ',', $enclosure = '"') {
   $handle = fopen('php://temp', 'r+');
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
    
/*
*	get_gravatar
*
*   Get either a Gravatar URL or complete image tag for a specified email address.
*
*   Turn a string into a slug
*
*	@source https://gravatar.com/site/implement/images/php/
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

/*
*   unzip
*
*   Unzip a file to a specified location
*
*   @see http://php.net/manual/en/ziparchive.extractto.php
*
*   @since 0.1
*   @last_modified 0.1
*
*	@params string $file - path to the file that you want to unzip
*   @params string $extractPath - path to the folder where you want to extract the contents
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