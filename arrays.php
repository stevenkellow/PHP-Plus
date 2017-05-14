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
*   array_remove_empty
*   unset_value
*   unset_key
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
*   array_remove_empty
*
*   Remove empty elements from an array
*
*   @author Jonas John
*   @source http://www.jonasjohn.de/snippets/php/array-remove-empty.htm
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param array $arr - array to remove empties from
*   @param bool $reindex - whether or not to reindex the array so keys don't have a missing number
*
*	@return array $random - array that's been cleaned
*/
if( ! function_exists( 'array_remove_empty' ) ){
function array_remove_empty($arr, $reindex = false){
    $narr = array();
    while(list($key, $val) = each($arr)){
        if (is_array($val)){
            $val = array_remove_empty($val);
            // does the result array contain anything?
            if (count($val)!=0){
                // yes :-)
                $narr[$key] = $val;
            }
        }
        else {
            if (trim($val) != ""){
                $narr[$key] = $val;
            }
        }
    }
    unset($arr);
    
    if( $reindex == true ){
        $narr = array_values($narr); // 'reindex' array
    }
    
    return $narr;
}
}

/*
*   unset_key
*
*   Unset an array element by key and optionally reindex
*
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param mixed $value - key to delete from array
*   @param array $array - array to delete from
*   @param bool $reindex - whether to reindex the array after deleting
*
*   @return array $array - returns the reindexed array if we've asked for that
*
*/
function unset_key( $key, $array, $reindex = false ){

    if( $key !== false) {
        unset( $array[$key] );
        
        if( $reindex == true ){
            $narr = array_values($array); // 'reindex' array
            return $narr;
        }
        
    }
    
}

/*
*   unset_value
*
*   Unset an array element by value and optionally reindex
*
*   @author Bojangles
*   @source http://stackoverflow.com/a/7225113
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param mixed $value - value to delete from array
*   @param array $array - array to delete from
*   @param bool $reindex - whether to reindex the array after deleting
*
*   @return array $array - returns the reindexed array if we've asked for that
*
*/

function unset_value( $value, $array, $reindex = false ){
    
    $key = array_search($value, $array);

    unset_key( $key, $array, $reindex );
    
}