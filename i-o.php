<?php
/*
*	Input / output functions
*
*	@package PHP Plus!
*
*
*/

/*
*   post_mail
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

if( ! function_exists( 'post_mail' ) ){
function post_mail($to, $subject, $message, $from_email, $from_name){
    
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
	if( $from_email && $from_name ){
		$headers[] = 'From: ' . $from_name . '<' . $from_email . '>';
		$headers[] = 'Reply-To: ' . $from_name . '<' . $from_email . '>';
	}
    
    // Send the email
    mail($to, $subject, $message, implode("\r\n", $headers));
    
 
}
}