<?php
/*
*	Array functions
*
*	@package PHP Plus!
*
*/

/*  CONTENTS
*
*   array_reindex
*   is_assoc
*   shuffle_assoc
*   is_numeric_array
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
*   array_rand_weighted
*   array_numeric
*   in_array_quick
*   array_orderby
*   array_split
*/

/*
*   array_reindex
*
*   Reindex arrays (alias of array_values )
*
*   @param array $array - array to reindex
*
*	@return array - array that's been reindexed
*
*   @since 0.1
*   @modified 0.1
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
*   @param array $array - array to check
*
*	@return bool - true if associative, false if not
*
*   @since 0.1
*   @modified 0.1
*/
if( ! function_exists( 'is_assoc') ){
function is_assoc( $array ){
    return array_keys( $array ) !== range( 0, count( $array ) - 1 );
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
*   @param array $list - array to shuffle
*
*	@return array $random - array that's been shuffled
*
*   @since 0.1
*   @modified 0.1
*/
if( ! function_exists( 'shuffle_assoc' ) ){
function shuffle_assoc( $list ){
    
    if( ! is_array( $list ) ){
        return $list;
    }

    $keys = array_keys( $list ); 
    
    shuffle( $keys ); 
    $random = array();
    
    foreach( $keys as $key ){ 
        $random[$key] = $list[$key]; 
    }
    
    return $random; 
}
}

/**
*   is_numeric_array
*
*   Returns boolean if a function is flat/sequential numeric array
*
*   @author brandonwamboldt
*   @see https://github.com/brandonwamboldt/utilphp/blob/master/src/utilphp/util.php
*
*   @param array $array - array to test
*
*   @return bool - true if numeric, false if not
*
*	@since	1.1
*	@modified	1.1
*/
if( ! function_exists( 'is_numeric_array' ) ){
function is_numeric_array( $array ){
    if( !is_array( $array ) ){
        return false;
    }
    
    $current = 0;
    foreach( array_keys( $array ) as $key ){
        if( $key !== $current ){
            return false;
        }
        $current++;
    }
    return true;
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
*   @param array $arr - array to remove empties from
*   @param bool $reindex - whether or not to reindex the array so keys don't have a missing number
*
*	@return array $narr - array that's been cleaned
*
*   @since 0.1
*   @modified 1.1.2
*/
if( ! function_exists( 'array_remove_empty' ) ){
function array_remove_empty( $arr, $reindex = false ){
    
    $narr = array();
    
    foreach( $arr as $key => $val ){
        if( ! empty( $val ) ){
            $narr[$key] = $val;
        }
    }
    
    if( $reindex == true ){
        $narr = array_values( $narr ); // 'reindex' array
    }
    
    return $narr;
}
}

/*
*   unset_key
*
*   Unset an array element by key and optionally reindex
*
*   @param array $array - array to delete from
*   @param mixed $key - key to delete from array
*   @param bool $reindex - whether to reindex the array after deleting
*
*   @return array $array - returns the reindexed array if we've asked for that
*
*   @since 0.1
*   @modified 1.1
*/
if( ! function_exists( 'unset_key') ){
function unset_key( $array, $key, $reindex = false ){

    if( isset( $array[$key] ) ){
        
        // Remove it
        unset( $array[$key] );
        
        if( $reindex == true ){
            $array = array_values( $array ); // 'reindex' array
            return $array;
        }
		
		return $array;
        
    } else {
        
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
*   @param array $array - array to delete from
*   @param mixed $value - value to delete from array
*   @param bool $reindex - whether to reindex the array after deleting
*
*   @return array $array - returns the reindexed array if we've asked for that
*
*   @since 0.1
*   @modified 1.1
*/
if( ! function_exists( 'unset_value') ){
function unset_value( $array, $value, $reindex = false ){
    
    $counter = 0;
    
    // Wrap the value as an array if needed for the diff
    $value = array_wrap( $value );
	
	$array = array_diff( $array, $value );
    
    // If we want to reindex the array
    if( $reindex == true ){
        
        return array_values( $array );
        
    } else {

        return $array;
        
    }
    
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
*   @param array $array - array to sort
*   @param array $orderArray - array to sort by
*
*   @return array $array - returns the reindexed array if we've asked for that
*
*   @since 0.1
*   @modified 0.1
*/
if( ! function_exists( 'sort_by_array') ){
function sort_by_array( array $array, array $orderArray ){
    return array_merge( array_flip( $orderArray ), $array );
}
}

/*
*   array_wrap
*
*   Wrap a variable or other item in an array if it's a single. Also converts objects to array
*
*   @author JBZoo
*   @source https://github.com/JBZoo/Utils/blob/master/src/Arr.php
*
*   @param mixed $item - item to turn into array
*
*   @return array - item as an array
*
*   @since 0.1
*   @modified 1.1
*/
if( ! function_exists( 'array_wrap') ){
function array_wrap( $item ){
    
    if( is_null( $item ) ){
        return array();
    } elseif( is_array( $item ) ){
        return $item;
    } elseif( is_object( $item ) ){
        return (array) $item;
    }
    return array( $item );
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
*   @author J. Bruni
*   @see https://stackoverflow.com/a/9546302/7956549
*
*   @return array $result - the flattened array
*
*	@since	0.1
*	@modified	0.1
*/
if( ! function_exists( 'array_flat' ) ){
function array_flat( $array, $prefix = '', $concat = '_'){
    
    $result = array();

    foreach( $array as $key => $value ){
        
        $new_key = $prefix . ( empty( $prefix ) ? '' : $concat ) . $key;

        if( is_array( $value ) ){
            
            $result = array_merge( $result, array_flat( $value, $new_key ) );
            
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
*	@modified	1.0.3
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
			
				uasort( $array, '__low_to_high');
				
				return $array;
			
			}
			
			// If we're sorting high to low
			if( $order == 'high_to_low' || $order == 'Z to A' ){
				
				uasort( $array, '__high_to_low');
				
				return $array;
			
			
			}
		
		
		} else {
		
			// Not reserving keys so use usort
		
			// If we're sorting low to high
			if( $order == 'low_to_high' || $order == 'A to Z' || $order == 'alphabetical' ){
			
				usort( $array, '__low_to_high');
				
				return $array;
			
			}
			
			// If we're sorting high to low
			if( $order == 'high_to_low' || $order == 'Z to A' ){
				
				usort( $array, '__high_to_low');
				
				return $array;
			
			
			}
		
		
		}

	} elseif( $sort_by == $sort_key ){
		
		// If we're sorting low to high
		if( $order == 'low_to_high' || $order == 'A to Z' || $order == 'alphabetical' ){
			
			uksort( $array, '__low_to_high');
			
			return $array;
		
		}
		
		// If we're sorting high to low
		if( $order == 'high_to_low' || $order == 'Z to A' ){
			
			uksort( $array, '__high_to_low');
			
			return $array;
		
		
		}
		
		
	}
	
}
}

/*
*   __low_to_high
*
*   Compares two items when sorting arrays
*
*	@param array $a - an array to compare
*	@param array $b - an array to compare
*
*   @return array - the sorted array
*
*	@since	1.0.3
*	@modified	1.0.3
*/
if( ! function_exists( '__low_to_high' ) ){
function __low_to_high( $a, $b ){
	
	$sort_key = $GLOBALS['sort_key'];
		
	return spaceship( $a[$sort_key], $b[$sort_key] );
	
}
}

/*
*   __high_to_low
*
*   Compares two items when sorting arrays
*
*	@param array $a - an array to compare
*	@param array $b - an array to compare
*
*   @return array - the sorted array
*
*	@since	1.0.3
*	@modified	1.0.3
*
*/
if( ! function_exists( '__high_to_low' ) ){
function __high_to_low( $a, $b ){
	
	$sort_key = $GLOBALS['sort_key'];
	
	return spaceship( $b[$sort_key], $a[$sort_key] );
	
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
*   @param  $array - data
*   @param  $key - item you want to pluck from array
*
*   @return plucked array only with key data
*
*	@since	1.1
*	@modified	1.1
*/
if( ! function_exists( 'array_pluck' ) ){
function array_pluck( $array, $key ){
    return array_map( function( $v ) use ( $key ){
      return is_object( $v ) ? $v->$key : $v[$key];
    }, $array );
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
*	@modified	1.1
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
*	@modified	1.1
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
*	@modified	1.1
*
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
*	@modified	1.1
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
*	@modified	1.1
*/
if( ! function_exists( 'array_cartesian' ) ){
function array_cartesian( $input ){
    // filter out empty values
    $input = array_filter( $input );

    $result = array( array() );

    foreach( $input as $key => $values ){
        $append = array();

        foreach( $result as $product ){
            foreach( $values as $item ){
                $product[$key] = $item;
                $append[] = $product;
            }
        }

        $result = $append;
    }

    return $result;
}
}

/**
*   array_rand_weighted()
*
*   Utility function for getting random values with weighting.
*   Pass in an associative array, such as array('A'=>5, 'B'=>45, 'C'=>50 )
*   An array like this means that "A" has a 5% chance of being selected, "B" 45%, and "C" 50%.
*   The return value is the array key, A, B, or C in this case.  Note that the values assigned
    do not have to be percentages.  The values are simply relative to each other.  If one value
    weight was 2, and the other weight of 1, the value with the weight of 2 has about a 66%
    chance of being selected.  Also note that weights should be integers.
*
*   @author Brad
*   @see https://stackoverflow.com/a/11872928/7956549
*
*   @param array $weightedValues
*   @param int $factor - if the weighted values are percentage, by what factor should they be multiplied
*
*   @return string $key
*
*   @since  1.1
*   @modified  1.1.2
*/
if( ! function_exists( 'array_rand_weighted' ) ){
function array_rand_weighted( $weightedValues, $factor = 6 ){
    
    $value_sum = array_sum( $weightedValues );
    
    if( $value_sum <= 1 ){
        
        $factor_power = pow( 10, $factor );
        
        foreach( $weightedValues as $key => $value ){
            $weightedValues[$key] = $value * $factor_power;
        }
        
        $value_sum = $value_sum * $factor_power;
        
    }
    
    if( function_exists( 'random_int' ) ){
        $rand = random_int( 1, $value_sum );
    } else {
        $rand = mt_rand( 1, $value_sum );
    }

    foreach( $weightedValues as $key => $value ){
      $rand -= $value;
      if( $rand <= 0 ){
        return $key;
      }
    }
}
}

/**
*   array_numeric
*
*   Makes sure an array only includes numeric values
*
*   @param array $array - the array to check
*   @param bool | string $cast - whether to cast the element as an int or float
*
*   @return array $new_array - the updated array
*
*	@since	1.1
*	@modified	1.1
*/
if( ! function_exists( 'array_numeric' ) ){
function array_numeric( $array, $cast = false ){
    
    $new_array = array();
    
    // Go through each element of the array
    foreach( $array as $key => $element ){
        
        // Save it if it's a numeric element
        if( is_numeric( $element ) ){
            
            // Determine whether to cast the value as an int or float
            switch( $cast ){
                
                case 'int':
                    
                    $new_array[$key] = intval( $element );
                    break;
                    
                case 'float':
                    
                    $new_array[$key] = floatval( $element );
                    break;
                
                default:
                    
                    $new_array[$key] = $element;
            }
            
        }
        
    }
    
    return $new_array;
    
}
}

/**
*   in_array_quick
*
*   A quick check if an element is in an array
*   Useful for large arrays
*
*   @author JV
*   @see http://php.net/manual/en/function.in-array.php#96198
*
*   @param mixed $needle - what to look for
*   @param array $haystack - the array to search in
*
*   @return bool - true if found, false if not
*
*	@since	1.1
*	@modified	1.1
*/
if( ! function_exists( 'in_array_quick' ) ){
function in_array_quick( $needle, $haystack ){
    
    $flipped_haystack = array_flip( $haystack ); 

    if( isset( $flipped_haystack[$needle]) ){
        
        return true;
        
    } else {
        
        return false;
        
    }
    
}
}

/**
*   array_orderby
*
*   Sort arrays by items
*
*   @author Jimpoz
*   @see https://www.php.net/manual/en/function.array-multisort.php#100534
*
*   @param array $array - the array to sort
*   @param string $key - the key to sort by
*   @param string $flag - either SORT_DESC to sort descending or SORT_ASC to sort ascending
*
*   @return array - the sorted array
*
*	@since	1.1.1
*/
if( ! function_exists( 'array_orderby' ) ){
function array_orderby(){
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
            }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}
}

/**
*   array_split
*
*   Split an array into the given number of sub-arrays
*
*   @param array $array - the array to split
*   @param int $elements - the number of sub-arrays to create
*   @param string $type - either 'straight' to fill sub-arrays sequentially (e.g. [1,2,3], [4,5] ) or 'interleaved' to fill one by one (e.g. [1,3,5], [2,4] )
*
*   @return array - the sorted array
*
*	@since	1.1.2
*/
if( ! function_exists( 'array_split' ) ){
function array_split( $array, $elements, $type = 'straight' ){
    
    $return = array();
    
    // Create subarrays
    for( $x = 0; $x < $elements; $x++ ){
        $return[$x] = array();
    }
    
    $x = 0;
    if( $type == 'interleaved' ){
        
        // Go through the array
        foreach( $array as $key => $value ){

            // Reset pointer to first array
            if( $x >= $elements ){
                $x = 0;
            }
            $return[$x][$key] = $value;
            $x++;

        }
    
    } elseif( $type == 'straight' ){
        
        // Check max to add to a sub-array
        $divs = round_up( count( $array ) / $elements, 0 );
        
        $y = 0;
        
        // Go through the array
        foreach( $array as $key => $value ){
            
            // If array is full move to next
            if( $x >= $divs ){
                $y++;
                $x = 0;
            }
            $return[$y][$key] = $value;
            $x++;
            
        }
        
    }
    
    return $return;
    
}
}
