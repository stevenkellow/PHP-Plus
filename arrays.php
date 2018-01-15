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
*       array_reindex
*   is_assoc
*   shuffle_assoc
*   array_remove_empty
*   unset_value
*   unset_key
*   sort_by_array
*   array_wrap
*   array_flat
*
*/

/*
*   array_reindex
*
*   Reindex arrays (alias of array_values)
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param array $array - array to reindex
*
*	@return array - array that's been reindexed
*/
if( ! function_exists( 'array_reindex') ){
function array_reindex( $array ){
    return array_values( $array );
}
}

/*
*   is_assoc
*
*   Check if an array is an associative one
*
*   @author JBZoo
*   @source https://github.com/JBZoo/Utils/blob/master/src/Arr.php
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param array $array - array to check
*
*	@return bool - true if associative, false if not
*/
if( ! function_exists( 'is_assoc') ){
function is_assoc($array) {
    return array_keys($array) !== range(0, count($array) - 1);
}
}

/*
*   shuffle_assoc
*
*   Shuffle associative arrays whilst keeping key => value pairs
*
*   @author Korcholis
*   @source http://stackoverflow.com/q/4102777
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
if( ! function_exists( 'unset_key') ){
function unset_key( $key, $array, $reindex = false ){

    if( $key ) {
        unset( $array[$key] );
		
		echo 'works';
        
        if( $reindex == true ){
            $array = array_values($array); // 'reindex' array
            return $array;
        }
		
		return $array;
        
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
if( ! function_exists( 'unset_value') ){
function unset_value( $value, $array, $reindex = false ){
    
    $keys = array_keys($array, $value);
	
	foreach( $keys as $key ){
		
		$array = unset_key( $key, $array, $reindex );
		
	}

    return $array;
    
}
}

/*
*   sort_by_array
*
*   Sort an array by another array
*
*   @author JBZoo
*   @source https://github.com/JBZoo/Utils/blob/master/src/Arr.php
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param array $array - array to sort
*   @param array $orderArray - array to sort by
*
*   @return array $array - returns the reindexed array if we've asked for that
*
*/
if( ! function_exists( 'sort_by_array') ){
function sort_by_array(array $array, array $orderArray){
    return array_merge(array_flip($orderArray), $array);
}
}

/*
*   array_wrap
*
*   Wrap an object or other item in an array
*
*   @author JBZoo
*   @source https://github.com/JBZoo/Utils/blob/master/src/Arr.php
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param mixed $object - object to turn into array
*
*   @return array - object as an array
*
*/
if( ! function_exists( 'array_wrap') ){
function array_wrap($object){
    if (is_null($object)) {
        return array();
    } elseif (is_array($object) && !is_assoc($object)) {
        return $object;
    }
    return array($object);
}
}

/*
*   array_flat
*
*   Flatten an array into a single dimension
*
*   @param array $array - array to flatten
*   @param string $prefix - prefix for each key
*   @param string $concat - the string to concatenate keys with
*
*   @return type $return - what comes out
*
*   @see https://stackoverflow.com/a/9546302/7956549
*
*	@since	0.1
*	@last_modified	0.1
*/
if( ! function_exists( 'array_flat' ) ){
function array_flat($array, $prefix = '', $concat = '_'){
    
    $result = array();

    foreach ($array as $key => $value){
        
        $new_key = $prefix . (empty($prefix) ? '' : $concat) . $key;

        if (is_array($value)) {
            
            $result = array_merge($result, array_flat($value, $new_key));
            
        } else {
            
            $result[$new_key] = $value;
            
        }
    }

    return $result;
    
}
}
