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
*   array_reindex
*   is_assoc
*   shuffle_assoc
*   array_remove_empty
*   unset_key
*   unset_value
*   sort_by_array
*   array_wrap
*   array_flat
*   array_sort_deep
        _low_to_high
        _high_to_low
*   array_pluck
*   array_add
*   array_only
*   array_last
*   array_first
*   array_cartesian
*/

/*
*   array_reindex
*
*   Reindex arrays (alias of array_values)
*
*   @since 0.1
*   @last_modified 0.1
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
*   @since 0.1
*   @last_modified 0.1
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
*   @since 0.1
*   @last_modified 0.1
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
*   @since 0.1
*   @last_modified 0.1
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
*   @since 0.1
*   @last_modified 1.1
*
*   @param array $array - array to delete from
*   @param mixed $key - key to delete from array
*   @param bool $reindex - whether to reindex the array after deleting
*
*   @return array $array - returns the reindexed array if we've asked for that
*
*/
if( ! function_exists( 'unset_key') ){
function unset_key( $array, $key, $reindex = false ){

    if( $key ) {
        unset( $array[$key] );
        
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
*   @since 0.1
*   @last_modified 1.1
*
*   @param array $array - array to delete from
*   @param mixed $value - value to delete from array
*   @param bool $reindex - whether to reindex the array after deleting
*
*   @return array $array - returns the reindexed array if we've asked for that
*
*/
if( ! function_exists( 'unset_value') ){
function unset_value( $array, $value, $reindex = false ){
    
    $counter = 0;
	
	foreach( $array as $key => $item_value ){
		
		if( $item_value == $value ){
			
			unset( $array[$key] );
			
		}
		
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
*   @since 0.1
*   @last_modified 0.1
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
*   @since 0.1
*   @last_modified 0.1
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

/*
*   array_sort_deep
*
*   Sort an multi-dimensional array by lower values - combines usort, uasort and uksort into one function
*
*   @param array $array - the array to sort
*   @param string $sort_key - the key  to sort by
*   @param string $sort_by - either 'key' or 'value'
*   @param bool $preserve_keys - whether to preserve keys when sorting
*   @param string $order - the order to sort:
		- low_to_high
		- A to Z
		- alphabetical
		- high_to_low
		- Z to A
*
*   @return array - the sorted array
*
*	@since	1.0.3
*	@last_modified	1.0.3
*/
if( ! function_exists( 'array_sort_deep' ) ){
function array_sort_deep( $array, $sort_key, $sort_by = 'value', $preserve_keys = true, $order = 'high_to_low' ){
	
	// Set the sort key in a global so it can be used by our comparison functions
	$GLOBALS['sort_key'] = $sort_key;

	// If we're sorting by value
	if( $sort_by == 'value' ){
		
		// Sorting by value
		
		// Check whether we're preserving keys
		if( $preserve_keys == true ){
			
			// Preserving keys so use uasort
			
			// If we're sorting low to high
			if( $order == 'low_to_high' || $order == 'A to Z' || $order == 'alphabetical' ){
			
				uasort($array, '__low_to_high');
				
				return $array;
			
			}
			
			// If we're sorting high to low
			if( $order == 'high_to_low' || $order == 'Z to A' ){
				
				uasort($array, '__high_to_low');
				
				return $array;
			
			
			}
		
		
		} else {
		
			// Not reserving keys so use usort
		
			// If we're sorting low to high
			if( $order == 'low_to_high' || $order == 'A to Z' || $order == 'alphabetical' ){
			
				usort($array, '__low_to_high');
				
				return $array;
			
			}
			
			// If we're sorting high to low
			if( $order == 'high_to_low' || $order == 'Z to A' ){
				
				usort($array, '__high_to_low');
				
				return $array;
			
			
			}
		
		
		}

	} elseif( $sort_by == $sort_key ){
		
		// If we're sorting low to high
		if( $order == 'low_to_high' || $order == 'A to Z' || $order == 'alphabetical' ){
			
			uksort($array, '__low_to_high');
			
			return $array;
		
		}
		
		// If we're sorting high to low
		if( $order == 'high_to_low' || $order == 'Z to A' ){
			
			uksort($array, '__high_to_low');
			
			return $array;
		
		
		}
		
		
	}
	
}
}

/*
*   __low_to_high
*
*   Compares to items when sorting arrays
*
*	@param array $a - an array to compare
*	@param array $b - an array to compare
*
*   @return array - the sorted array
*
*	@since	1.0.3
*	@last_modified	1.0.3
*/
if( ! function_exists( '__low_to_high' ) ){
function __low_to_high( $a, $b ){
	
	$sort_key = $GLOBALS['sort_key'];
		
	return $a[$sort_key] <=> $b[$sort_key];
	
}
}

/*
*   __high_to_low
*
*	@param array $a - an array to compare
*	@param array $b - an array to compare
*
*   Compares to items when sorting arrays
*
*   @return array - the sorted array
*
*	@since	1.0.3
*	@last_modified	1.0.3
*/
if( ! function_exists( '__high_to_low' ) ){
function __high_to_low( $a, $b ){
	
	$sort_key = $GLOBALS['sort_key'];
	
	return $b[$sort_key] <=> $a[$sort_key];
	
}
}

/**
*   array_pluck
*
*   Pluck an array of values from an array/object. (Only for PHP 5.3+)
*
*   @author Ozh / Laravel
*   @see https://gist.github.com/ozh/82a17c2be636a2b1c58b49f271954071
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param  $array - data
*   @param  $key - item you want to pluck from array
*
*   @return plucked array only with key data
*/
if( ! function_exists( 'array_pluck' ) ){
function array_pluck($array, $key) {
    return array_map(function($v) use ($key) {
      return is_object($v) ? $v->$key : $v[$key];
    }, $array);
}
}

/**
*   array_add
*
*   Add a key value pair to an array if it doesn't already exist
*
*   @param array $array - the array to add to
*   @param string $key - the key to add
*   @param mixed $value - the value to add
*
*   @return array $array - the potentially edited array
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( 'array_add' ) ){
function array_add( $array, $key, $value ){
    
    if( ! isset( $array[$key] ) ){
        $array[$key] = $value;
    }
    
    return $array;
    
}
}

/**
*   array_only
*
*   Return only the specified keys from an array
*
*   @param array $array - the base array to get data from
*   @param array $keys - the keys to return
*
*   @return array $return - the edited array
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( 'array_only' ) ){
function array_only( $array, $keys ){
    
    $return = array();
	
	// Check if the keys is a string
	$keys = array_wrap( $keys );
    
    foreach( $keys as $key ){
        
        $return[$key] = $array[$key];
        
    }
    
    return $return;
    
}
}

/**
*   array_last
*
*   Alias of array_pop, returns the last element of the array but preserves original array structure
*
*   @param array $array - array to use
*
*   @return mixed - the last element of the array
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( 'array_last' ) ){
function array_last( $array ){
    return array_pop( $array );
}
}

/**
*   array_first
*
*   Alias of array_shift, returns the first element of the array but preserves original array structure
*
*   @param array $array - array to use
*
*   @return mixed - the first element of the array
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( 'array_first' ) ){
function array_first( $array ){
    $array = array_reverse( $array );
    return array_pop( $array );
}
}

/**
*   array_cartesian
*
*   Returns the cartesian product of an array
*
*   @author Serg
*   @see https://stackoverflow.com/a/15973172/7956549
*
*   @param array $array - the inital arrray, containing arrays of attributes
*
*   @return array $result - the resulting cartesian product
*
*	@since	1.1
*	@last_modified	1.1
*/
if( ! function_exists( 'cartesian' ) ){
function array_cartesian($input) {
    // filter out empty values
    $input = array_filter($input);

    $result = array(array());

    foreach ($input as $key => $values) {
        $append = array();

        foreach($result as $product) {
            foreach($values as $item) {
                $product[$key] = $item;
                $append[] = $product;
            }
        }

        $result = $append;
    }

    return $result;
}
}