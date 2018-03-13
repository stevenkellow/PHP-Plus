<?php
/**
*	Math functions
*
*	@package PHP Plus!
*
*
*/

/*
*   CONTENTS
*
*   absint
*   mean
*   median
*   mode
*       average
*   is_even
*   is_odd
*   round_up
*   round_down
*   round_bank
*   sum
*   arabic2roman
*   roman2arabic
*   ordinal
*   temperature
*   latlon_distance
*   percent
*/

/**
*   absint
*
*   Convert a value to non-negative integer
*
*   @author WordPress
*   @source https://developer.wordpress.org/reference/functions/absint/
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param integer $number - number to return absolute
*
*   @return integer
*/
if( ! function_exists( 'absint') ){
function absint( $number ) {
    return abs( intval( $number ) );
}
}

/**
*   mean
*
*   Get the mean of a set of values in an array
*
*   @author Mucello
*   @source http://php.net/manual/en/function.array-sum.php
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param array $array - an array with elements
*   @param numbers - list of numbers to average
*
*   @return float/int $average - the average of all elements
*/
if( ! function_exists( 'mean') ){
function mean(){
    
    // Get all the arguments
    $arg_list = func_get_args();
    
    // If an array was passed through
    if( is_array( $arg_list[0]) ){
        
        return array_sum( $arg_list[0] ) / count( $arg_list[0] );
        
    } else {
        
        // Get number of arguments passed through
        $numargs = func_num_args();
    
        // Create an array for each passed element
        $args_array = array();
        for ($i = 0; $i < $numargs; $i++) {
            $args_array[] = $arg_list[$i];
        }

        return array_sum( $args_array ) / $numargs;
    
    }
    
    
}
}

/**
*   median
*
*   Get the median of a set of values in an array
*
*   @author Mchl
*   @source https://codereview.stackexchange.com/a/223
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param array $array - an array with elements
*   @param numbers - list of numbers to average
*
*   @return float/int $average - the average of all elements
*/
if( ! function_exists( 'median' ) ){
function median() {
    
    // Get all the arguments
    $arg_list = func_get_args();
    
    if( !is_array( $arg_list[0]) ){
        
        // Get number of arguments passed through
        $numargs = func_num_args();
    
        // Create an array for each passed element
        $array = array();
        for ($i = 0; $i < $numargs; $i++) {
            $array[] = $arg_list[$i];
        }
        
        
    } else {
        
        $array = $arg_list[0];
        
    }
    
      // perhaps all non numeric values should filtered out of $array here?
      $iCount = count($array);
      // if we're down here it must mean $array
      // has at least 1 item in the array.
      $middle_index = floor($iCount / 2);
      sort($array, SORT_NUMERIC);
      $median = $array[$middle_index]; // assume an odd # of items
      // Handle the even case by averaging the middle 2 items
      if ($iCount % 2 == 0) {
        $median = ($median + $array[$middle_index - 1]) / 2;
      }
      return $median;

}
}

/**
*   mode
*
*   Get the mode of a set of values in an array
*
*   @author White Elephant
*   @source https://stackoverflow.com/a/12036174/7956549
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param array $array - an array with elements
*   @param numbers - list of numbers to average
*
*   @return int $average - the mode of all elements
*/
if( ! function_exists( 'mode' ) ){
function mode(){
	
	// Get all the arguments
    $arg_list = func_get_args();
    
    // If an array was passed through
    if( ! is_array( $arg_list[0]) ){
	
		// Get number of arguments passed through
        $numargs = func_num_args();
    
        // Create an array for each passed element
        $array = array();
        for ($i = 0; $i < $numargs; $i++) {
            $array[] = $arg_list[$i];
        }
		
		
	} else {
		
		$array = $arg_list[0];
		
	}
		
	$values = array_count_values($array); 
		
	$mode = array_search(max($values), $values);
	return $mode;
}
}

/**
*   average
*
*   Get the average of a set of values in an array (alias for Mean)
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param array $array - an array with elements
*   @param numbers - list of numbers to average
*
*   @return float/int $average - the average of all elements
*/
if( ! function_exists( 'average') ){
function average(){
  
    // Get all the arguments
    $arg_list = func_get_args();
    
    // Send the function through mean
 	return call_user_func_array('mean',$arg_list);
    
}
}

/**
*   is_even
*
*   Check if a number is even
*
*   @author Pawel Dubiel
*   @source http://stackoverflow.com/a/9153969
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param integer $number - number to check
*
*   @return bool - true if it's even, false if it's not
*/
if( ! function_exists( 'is_even' ) ){
function is_even( $number ){
	
	if( $number & 1 ){
	    return false;
	} else {
	    return true;
	}
	
}
}

/**
*   is_odd
*
*   Check if a number is odd
*
*   @author Pawel Dubiel
*   @source http://stackoverflow.com/a/9153969
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param integer $number - number to check
*
*   @return bool - true if it's odd, false if it's not
*/
if( ! function_exists( 'is_odd' ) ){
function is_odd( $number ){
	
	if( $number & 1 ){
	    return true;
	} else {
	    return false;
	}
	
}
}

/**
*   round_up
*
*   Round number up to specified precision
*
*   @author taking sides
*   @source http://php.net/manual/en/function.round.php#114573
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param integer $number - number to round
*	@param integer $precision - number of decimal places to round to
*
*   @return integer / float - rounded number
*/
if( ! function_exists( 'round_up') ){
function round_up($number, $precision = 2){
    $fig = (int) str_pad('1', ( $precision + 1 ), '0');
    return (ceil($number * $fig) / $fig);
}
}

/**
*   round_down
*
*   Round number up to specified value
*
*   @author taking sides
*   @source http://php.net/manual/en/function.round.php#114573
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param integer $number - number to round
*	@param integer $precision - number of decimal places to round to
*
*   @return integer / float - rounded number
*/
if( ! function_exists( 'round_down') ){
function round_down($number, $precision = 2){
    $fig = (int) str_pad('1', ( $precision + 1 ), '0');
    return (floor($number * $fig) / $fig);
}
}

/**
*   round_bank
*
*   Round to nearest even number
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param float $number - $number to round
*   @param int $precision - optionally change the precision
*   @param string $separator - decimal separator
*
*   @return integer / float - rounded number
*/
if( ! function_exists( 'round_bank') ){
function round_bank( $number, $precision = 0, $separator = DECIMAL_SEP ){
	
    // Check if we need to do this at all
	if( is_float( $number ) ){
		
        // If we're rounding a decimal
		if( $precision > 0 ){
			
            // Get the decimal part of the number
			$str_arr = explode($separator, $number);
			$decimal = $str_arr[1];

            // Get the digit that we're wanting to check whether to change
			$decimal_to_change = substr( $decimal, ( $precision - 1 ), 1 );

            // Get the digits that affects whether we round up or down
			$decimal_to_round = substr( $decimal, $precision );

            // If the digit befre rounding is even
			if( is_even( $decimal_to_change ) ){
				
                // If the digit to check would normally be rounded up
				if( $decimal_to_round > 0 ){
					
                    // Round down, so it's closer to the even number
					return round_down( $number, $precision );
					
					
				} else {
					
                    // Round up, so it's closer to the even number
					return round_up ( $number, $precision );
					
				}
				
			} else {
                
                // The number before rounding is odd
				
				// If the digit to check would normally be rounded up
				if( $decimal_to_round > 0 ){
					
                    // Round up, so it's closer to the even number
					return round_up ( $number, $precision );
					
				} else {
					
                    // Round down, so it's closer to the even number
					return round_down( $number, $precision );
				}
				
			}
			
		} else {

	        // If the number is even, we'll round down - else round up
            if( is_even( absint( $number ) ) ){

                return round_down( $number, $precision );

            } else {

                return round_up( $number, $precision );

            }
            
        }
		
	} else {
		
		return $number;
		
	}
	
	
}
}
   
/**
*   sum
*
*   Sum of values in an array (alias of array_sum)
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param array $array - an array with elements to add up
*   @param numbers - list of numbers to add
*
*   @return integer / float - sum of all numbers
*/
if( ! function_exists( 'sum' ) ){
function sum(){
    
    // Get all the arguments
    $arg_list = func_get_args();
    
    // If an array was passed through
    if( is_array( $arg_list[0]) ){
        
        return array_sum( $arg_list[0] );
        
    } else {
        
        // Get number of arguments passed through
        $numargs = func_num_args();
    
        // Create an array for each passed element
        $args_array = array();
        for ($i = 0; $i < $numargs; $i++) {
            $args_array[] = $arg_list[$i];
        }

        return array_sum( $args_array );
    
    }
    
}
}
   
/**
*   arabic2roman
*
*   Convert an integer in Arabic numerals to Roman numerals
*
*   @author user2095686
*   @source http://stackoverflow.com/a/15023547
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param integer $integer - integer in Arabic numerals
*
*   @return string $roman - integer in Roman numerals
*/
if( ! function_exists( 'arabic2roman') ){
function arabic2roman( $integer ){ 
    
    $table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1); 
    $roman = ''; 
    
    while($integer > 0){
        foreach($table as $rom=>$arb){ 
            if($integer >= $arb){ 
                $integer -= $arb; 
                $roman .= $rom; 
                break; 
            } 
        } 
    } 

    return $roman; 
}
}
   
   
/**
*   roman2arabic
*
*   Convert a string from Roman numerals to Arabic numerals
*
*   @author andyb
*   @source http://stackoverflow.com/a/6266158
*
*   @since 0.1
*   @last_modified 0.1
*
*   @param string $roman - integer in Roman numerals
*
*   @return integer $integer - integer in Arabic numerals
*/
if( ! function_exists( 'roman2arabic') ){
function roman2arabic( $roman ){
    $romans = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1); 

    $integer = 0;
    
    $roman = strtoupper( $roman );

    foreach ($romans as $key => $value) {
        while (strpos($roman, $key) === 0) {
            $integer += $value;
            $roman = substr($roman, strlen($key));
        }
    }
    return $integer;

}
}

/**
*   temperature
*
*   Convert a temperature between celsius, fahrenheit and kelvin
*
*   @since 0.1
*   @last_modified 0.1
*
*   @params int | float $number - value of temperature to convert
*	@params string $from - temperature to convert from (celsius, fahrenheit or kelvin)
*	@params string $to - temperature to convert to (celsius, fahrenheit or kelvin)
*
*   @return int | float - converted temperature
*/
if( ! function_exists( 'temperature') ){
function temperature( $number, $from, $to ){
	
	if( $from == 'celsius' ){
		
		if( $to == 'fahrenheit' ){
			
			return ($number * 9/5) + 32;
			
		}
		
		if( $to == 'kelvin' ){
			
			return $number + 273.15;
			
		}
		
		if( $to == 'celsius' ){
			
			return $number;
			
		}
		
	}
	
	if( $from == 'fahrenheit' ){
		
		if( $to == 'celsius' ){
			
			return ($number - 32) / ( 9/5 );
			
		}
		
		
		if( $to == 'kelvin' ){
			
			return ($number + 459.67 ) * ( 5/9 );
			
		}
		
		if( $to == 'fahrenheit'){
			
			return $number;
			
		}
		
	}
	
	if( $from == 'kelvin' ){
		
		if( $to == 'celsius' ){
			
			return $number - 273.15;
			
		}
		
		if( $to == 'fahrenheit' ){
			
			return ($number * (9/5)) + 459.67;
			
		}
		
		if( $to == 'kelvin' ){
			
			return $number;
			
		}
		
		
	}
	
}
}

/**
*   latlon_distance
*
*   Calculate a distance between two latitude and longitude positions
*
*	@author Janith Chinthana
*	@source http://stackoverflow.com/a/30556851/7956549
*
*   @since 0.1
*   @last_modified 0.1
*
*   @params int | float $lat1 - first latitude
*   @params int | float $lon - first longitude
*   @params int | float $lat1 - second latitude
*   @params int | float $lon - second longitude
*   @params string $unit - unit to use (K for Kilometers, N for Nautical Miles or M for miles)
*
*   @return int | float - distance between the two points
*/
if( ! function_exists( 'latlon_distance') ){
function latlon_distance($lat1, $lon1, $lat2, $lon2, $unit = 'M') {

	$theta = $lon1 - $lon2;
	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	$dist = acos($dist);
	$dist = rad2deg($dist);
	$miles = $dist * 60 * 1.1515;
	$unit = strtoupper($unit);

	if ($unit == "K") {
	  return ($miles * 1.609344);
	} else if ($unit == "N") {
	  return ($miles * 0.8684);
	} else {
	  return $miles;
	}
	
}
}

/**
*   ordinal
*
*   Add the ordinal reference (th, nd etc.) after a number
*
*   @author Cats who code
*   @source http://www.catswhocode.com/blog/10-awesome-php-functions-and-snippets
*
*   @since 0.1
*   @last_modified 0.1
*
*   @params int $cdnl - normal / cardinal number to add
*
*   @return string - ordinal number
*/
if( ! function_exists( 'ordinal' ) ){
function ordinal($cdnl){ 
    $test_c = abs($cdnl) % 10; 
    $ext = ((abs($cdnl) %100 < 21 && abs($cdnl) %100 > 4) ? 'th' 
            : (($test_c < 4) ? ($test_c < 3) ? ($test_c < 2) ? ($test_c < 1) 
            ? 'th' : 'st' : 'nd' : 'rd' : 'th')); 
    return $cdnl.$ext; 
}
}

/**
*	percent
*
*	Output a number as a percentage
*
*	@since 1.02
*	@last_modified 1.0.2
*
*	@param float | int - a number to pass through
*	@param int - number of decimal places to include
*
*	@return string - percentage
*/
if( ! function_exists( 'percent' ) ){
function percent( $number, $decimals = 2 ){
	
	$rounded = round( $number * 100, $decimals );
	
	return number_format( $rounded, $decimals ) . '%';

}
}
