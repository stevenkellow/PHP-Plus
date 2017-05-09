<?php
/*
*	Array functions
*
*	@package PHP Plus!
*
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