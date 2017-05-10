<?php
/*
*	Array functions
*
*	@package PHP Plus!
*
*
*/

/*  CONTENTS
*
*   shuffle_assoc
*   print_pre
*
*/

/*
*   shuffle_assoc
*
*   Shuffle associative arrays whilst keeping key => value pairs, credit to Korcholis http://stackoverflow.com/q/4102777
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param array $list - array to shuffle
*
*	@return array $random - array that's been shuffled
*/
if( ! function_exists( 'shuffle_assoc' ) ){
function shuffle_assoc($list) { 
  if (!is_array($list)) return $list; 

  $keys = array_keys($list); 
  shuffle($keys); 
  $random = array(); 
  foreach ($keys as $key) { 
    $random[$key] = $list[$key]; 
  }
  return $random; 
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