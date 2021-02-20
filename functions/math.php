<?php
/**
*	Math functions
*
*	@package PHP Plus!
*
*/

/*
*   CONTENTS
*
*   absint
*   mean
*   median
*   mode
*   average
*   is_even
*   is_odd
*   round_up
*   round_down
*   round_bank
*   sum
*   arabic2roman
*   roman2arabic
*   temperature
*   latlon_distance
*   ordinal
*   percent
*   calc
*   is_zero
*   is_positive
*   is_negative
*   approximate_equal
*   pearson
*   is_decimal
*   currency_format
*   factorial
*   normal_dists
*   multi_normal_dists
*   rebase
*/

/**
*   absint
*
*   Convert a value to non-negative integer
*
*   @author WordPress
*   @source https://developer.wordpress.org/reference/functions/absint/
*
*   @param integer $number - number to return absolute
*
*   @return integer
*
*   @since 0.1
*   @modified 0.1
*/
if( ! function_exists( 'absint') ){
function absint( $number ){
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
*   @param array $array - an array with elements
*   @param numbers - list of numbers to average
*
*   @return float/int $average - the average of all elements
*
*   @since 0.1
*   @modified 0.1
*
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
        for ( $i = 0; $i < $numargs; $i++){
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
*   @param array $array - an array with elements
*   @param numbers - list of numbers to average
*
*   @return float/int $average - the average of all elements
*
*   @since 0.1
*   @modified 0.1
*
*/
if( ! function_exists( 'median' ) ){
function median(){
    
    // Get all the arguments
    $arg_list = func_get_args();
    
    if( !is_array( $arg_list[0]) ){
        
        // Get number of arguments passed through
        $numargs = func_num_args();
    
        // Create an array for each passed element
        $array = array();
        for ( $i = 0; $i < $numargs; $i++){
            $array[] = $arg_list[$i];
        }
        
        
    } else {
        
        $array = $arg_list[0];
        
    }
    
      // perhaps all non numeric values should filtered out of $array here?
      $iCount = count( $array );
      // if we're down here it must mean $array
      // has at least 1 item in the array.
      $middle_index = floor( $iCount / 2 );
      sort( $array, SORT_NUMERIC );
      $median = $array[$middle_index]; // assume an odd # of items
      // Handle the even case by averaging the middle 2 items
      if( $iCount % 2 == 0 ){
        $median = ( $median + $array[$middle_index - 1]) / 2;
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
*   @param array $array - an array with elements
*   @param numbers - list of numbers to average
*
*   @return int $average - the mode of all elements
*
*   @since 0.1
*   @modified 0.1
*
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
        for ( $i = 0; $i < $numargs; $i++){
            $array[] = $arg_list[$i];
        }
		
		
	} else {
		
		$array = $arg_list[0];
		
	}
		
	$values = array_count_values( $array ); 
		
	$mode = array_search( max( $values ), $values );
	return $mode;
}
}

/**
*   average
*
*   Get the average of a set of values in an array (alias for Mean )
*
*   @param array $array - an array with elements
*   @param numbers - list of numbers to average
*
*   @return float/int $average - the average of all elements
*
*   @since 0.1
*   @modified 0.1
*
*/
if( ! function_exists( 'average') ){
function average(){
  
    // Get all the arguments
    $arg_list = func_get_args();
    
    // Send the function through mean
 	return call_user_func_array('mean', $arg_list );
    
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
*   @param integer $number - number to check
*
*   @return bool - true if it's even, false if it's not
*
*   @since 0.1
*   @modified 0.1
*
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
*   @param integer $number - number to check
*
*   @return bool - true if it's odd, false if it's not
*
*   @since 0.1
*   @modified 0.1
*
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
*   @param integer $number - number to round
*	@param integer $precision - number of decimal places to round to
*
*   @return integer | float - rounded number
*
*   @since 0.1
*   @modified 0.1
*
*/
if( ! function_exists( 'round_up') ){
function round_up( $number, $precision = 2 ){
    $fig = (int ) str_pad('1', ( $precision + 1 ), '0');
    return ( ceil( $number * $fig ) / $fig );
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
*   @param integer $number - number to round
*	@param integer $precision - number of decimal places to round to
*
*   @return integer | float - rounded number
*
*   @since 0.1
*   @modified 0.1
*
*/
if( ! function_exists( 'round_down') ){
function round_down( $number, $precision = 2 ){
    $fig = (int ) str_pad('1', ( $precision + 1 ), '0');
    return ( floor( $number * $fig ) / $fig );
}
}

/**
*   round_bank
*
*   Round to nearest even number
*
*   @param float $number - $number to round
*   @param int $precision - optionally change the precision
*   @param string $separator - decimal separator
*
*   @return integer / float - rounded number
*
*   @since 0.1
*   @modified 0.1
*
*/
if( ! function_exists( 'round_bank') ){
function round_bank( $number, $precision = 0, $separator = DECIMAL_SEP ){
	
    // Check if we need to do this at all
	if( is_float( $number ) ){
		
        // If we're rounding a decimal
		if( $precision > 0 ){
			
            // Get the decimal part of the number
			$str_arr = explode( $separator, $number );
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
					return round_up( $number, $precision );
					
				}
				
			} else {
                
                // The number before rounding is odd
				
				// If the digit to check would normally be rounded up
				if( $decimal_to_round > 0 ){
					
                    // Round up, so it's closer to the even number
					return round_up( $number, $precision );
					
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
*   Sum of values in an array (alias of array_sum )
*
*   @param array $array - an array with elements to add up
*   @param numbers - list of numbers to add
*
*   @return integer / float - sum of all numbers
*
*   @since 0.1
*   @modified 0.1
*
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
        for ( $i = 0; $i < $numargs; $i++){
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
*   @param integer $integer - integer in Arabic numerals
*
*   @return string $roman - integer in Roman numerals
*
*   @since 0.1
*   @modified 0.1
*
*/
if( ! function_exists( 'arabic2roman') ){
function arabic2roman( $integer ){ 
    
    $table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1 ); 
    $roman = ''; 
    
    while( $integer > 0 ){
        foreach( $table as $rom=>$arb ){ 
            if( $integer >= $arb ){ 
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
*   @param string $roman - integer in Roman numerals
*
*   @return integer $integer - integer in Arabic numerals
*
*   @since 0.1
*   @modified 0.1
*
*/
if( ! function_exists( 'roman2arabic') ){
function roman2arabic( $roman ){
    $romans = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1 ); 

    $integer = 0;
    
    $roman = strtoupper( $roman );

    foreach( $romans as $key => $value ){
        while ( strpos( $roman, $key ) === 0 ){
            $integer += $value;
            $roman = substr( $roman, strlen( $key ) );
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
*   @param int | float $number - value of temperature to convert
*	@param string $from - temperature to convert from (celsius, fahrenheit or kelvin )
*	@param string $to - temperature to convert to (celsius, fahrenheit or kelvin )
*
*   @return int | float - converted temperature
*
*   @since 0.1
*   @modified 1.1
*
*/
if( ! function_exists( 'temperature') ){
function temperature( $number, $from, $to ){
    
    // Create aliases for temperature
    if( strlen( $from ) == 1 ){
        if( $from == 'C' || $from == 'c' ){
            $from = 'celsius';
        }
        if( $from == 'F' || $from == 'f' ){
            $from = 'fahrenheit';
        }
        if( $from == 'K' || $from == 'k' ){
            $from = 'kelvin';
        }
    }
    if( strlen( $to ) == 1 ){
        if( $to == 'C' || $to == 'c' ){
            $to = 'celsius';
        }
        if( $to == 'F' || $to == 'f' ){
            $to = 'fahrenheit';
        }
        if( $to == 'K' || $to == 'k' ){
            $to = 'kelvin';
        }
    }
	
	if( $from == 'celsius' ){
		
		if( $to == 'fahrenheit' ){
			
			return ( $number * 9/5 ) + 32;
			
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
			
			return ( $number - 32 ) / ( 9/5 );
			
		}
		
		
		if( $to == 'kelvin' ){
			
			return ( $number + 459.67 ) * ( 5/9 );
			
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
			
			return ( $number * ( 9/5 ) ) + 459.67;
			
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
*   @param int | float $lat1 - first latitude
*   @param int | float $lon - first longitude
*   @param int | float $lat1 - second latitude
*   @param int | float $lon - second longitude
*   @param string $unit - unit to use (K/km for Kilometers, N for Nautical Miles or M for miles )
*
*   @return int | float - distance between the two points
*
*   @since 0.1
*   @modified 1.1
*
*/
if( ! function_exists( 'latlon_distance') ){
function latlon_distance( $lat1, $lon1, $lat2, $lon2, $unit = 'M'){

	$theta = $lon1 - $lon2;
	$dist = sin( deg2rad( $lat1 ) ) * sin( deg2rad( $lat2 ) ) +  cos( deg2rad( $lat1 ) ) * cos( deg2rad( $lat2 ) ) * cos( deg2rad( $theta ) );
	$dist = acos( $dist );
	$dist = rad2deg( $dist );
	$miles = $dist * 60 * 1.1515;
	$unit = strtoupper( $unit );

	if( $unit == "K" || $unit == 'KM'){
	  return ( $miles * 1.609344 );
	} else if( $unit == "N"){
	  return ( $miles * 0.8684 );
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
*   @param int $cdnl - normal / cardinal number to add
*
*   @return string - ordinal number
*
*   @since 0.1
*   @modified 0.1
*
*/
if( ! function_exists( 'ordinal' ) ){
function ordinal( $cdnl ){ 
    $test_c = abs( $cdnl ) % 10; 
    $ext = (( abs( $cdnl ) %100 < 21 && abs( $cdnl ) %100 > 4 ) ? 'th' 
            : (( $test_c < 4 ) ? ( $test_c < 3 ) ? ( $test_c < 2 ) ? ( $test_c < 1 ) 
            ? 'th' : 'st' : 'nd' : 'rd' : 'th') ); 
    return $cdnl.$ext; 
}
}

/**
*	percent
*
*	Output a number as a percentage
*
*	@param float | int - a number to pass through
*	@param int - number of decimal places to include
*
*	@return string - percentage
*
*	@since 1.0.2
*	@modified 1.0.2
*
*/
if( ! function_exists( 'percent' ) ){
function percent( $number, $decimals = 2 ){
	
	$rounded = round( $number * 100, $decimals );
	
	return number_format( $rounded, $decimals ) . '%';

}
}

/**
*   calc
*
*   Perform a calculation and make sure the value has a minimum and maximum
*
*   @param float $number - the number to evaluate
*   @param float $min - the minimum value for the calculation
*   @param float $max - the maximum value for the calculation
*   @param bool $fail - whether the function should fail if the number is outside the min and max
*
*   @return int | float $number - either the calculated number, or max, or min
*
*	@since	1.1
*	@modified	1.1
*
*/
if( ! function_exists( 'calc' ) ){
function calc( $number, $min = false, $max = false, $fail = false ){
    
    // Check if the number is less than the min
    if( $min !== false && $number < $min ){
        
        // If we want to throw a fail, then return false
        if( $fail == true ){
            
            return false;
            
        } else {
            
            // Return the minimum value
            return $min;
            
        }
        
    } elseif( $max !== false && $number > $max ){
        
        // If the number is greater than the max - and we want to return fail, then false
        if( $fail == true ){
            
            return false;
            
        } else {
            
            // Return the maximum value
            return $max;
            
        }
        
    }
    
    // If it's within the two values then just return that
    return $number;
    
}
}

/**
*   is_zero
*
*   Checks whether the value is zero
*
*   @param object $value - the value to check
*
*   @return bool true if it's zero, false if it's not
*
*	@since	1.1
*	@modified	1.1
*
*/
if( ! function_exists( 'is_zero' ) ){
function is_zero( $value ){

    if( $value === 0 ){
        return true;
    } else {
        return false;
    }

}
}

/**
*   is_positive
*
*   Checks whether the value is positive (greater than or equal to zero )
*
*   @param object $value - the value to check
*
*   @return bool true if it's positive, false if it's not
*
*	@since	1.1
*	@modified	1.1
*
*/
if( ! function_exists( 'is_positive' ) ){
function is_positive( $value ){

    if( $value >= 0 ){
        return true;
    } else {
        return false;
    }

}
}

/**
*   is_negative
*
*   Checks whether the value is negative (less than zero )
*
*   @param object $value - the value to check
*
*   @return bool true if it's negative, false if it's not
*
*	@since	1.1
*	@modified	1.1
*
*/
if( ! function_exists( 'is_negative' ) ){
function is_negative( $value ){

    if( $value < 0 ){
        return true;
    } else {
        return false;
    }

}
}

/**
*   approximate_equal
*
*   Check if two floats are approximately equal, given a specified tolerance
*
*   @author Joey
*   @see https://stackoverflow.com/a/3148991/7956549
*
*   @param float $float_one - the first float to compare
*   @param float $float_two - the second float to compare
*   @param float $tolerance - the tolerance of difference
*   @param string $tolerance_type - whether it's a percentage or integer
*
*   @return bool - true if equal or approximately equal, false if not
*
*	@since	1.1
*	@modified	1.1
*
*/
if( ! function_exists( 'approximate_equal' ) ){
function approximate_equal( $float_one, $float_two, $tolerance, $tolerance_type = 'int' ){
    
    if( $tolerance_type == 'int' ){
    
        if( abs( $float_one - $float_two ) <= $tolerance ){
            return true;
        } else {
            return false;
        }
    
    }
    
    if( $tolerance_type == 'percent' ){
        
        if( abs( ( $float_one - $float_two ) / $float_two ) <= $tolerance ){
            return true;
        } else {
            return false;
        }
        
    }
    
}
}

/**
*   pearson
*
*   Returns the Pearson correlation coefficient (least squares best fit line)
*
*   @param array $x array of all x vals
*   @param array $y array of all y vals
*
*   @return float - the coefficient
*
*	@since	1.1
*	@modified	1.1
*/
if( ! function_exists( 'pearson' ) ){
function pearson($x, $y){
    
    // number of values
    $n = count($x);
    $keys = array_keys(array_intersect_key($x, $y));

    // get all needed values as we step through the common keys
    $x_sum = 0;
    $y_sum = 0;
    $x_sum_sq = 0;
    $y_sum_sq = 0;
    $prod_sum = 0;
    foreach($keys as $k){
        
        $x_sum += $x[$k];
        $y_sum += $y[$k];
        $x_sum_sq += pow($x[$k], 2);
        $y_sum_sq += pow($y[$k], 2);
        $prod_sum += $x[$k] * $y[$k];
    }

    $numerator = $prod_sum - ($x_sum * $y_sum / $n);
    $denominator = sqrt( ($x_sum_sq - pow($x_sum, 2) / $n) * ($y_sum_sq - pow($y_sum, 2) / $n) );

    return $denominator == 0 ? 0 : $numerator / $denominator;
}
}

/**
*   is_decimal
*
*   Test if a given value is a decimal
*
*   @author cwallenpoole
*   @see https://stackoverflow.com/a/6772657/7956549
*
*   @param int|float|string $val - a number in any format
*
*   @return bool - true if decimal, false if not
*
*	@since	1.1.1
*	@modified	1.1.1
*/
if( ! function_exists( 'is_decimal' ) ){
function is_decimal( $val ){
    return is_numeric( $val ) && floor( $val ) != $val;
}
}

/**
*   currency_format
*
*   Returns a number to 2 decimal places if decimal, ignores decimal if it doesn't exists
*
*   @param int|float|string $number - a number in any format
*   @param string $symbol - a string to prepend to the format
*
*   @return string  - the formatted currency
*
*	@since	1.1.1
*	@modified	1.1.1
*/
if( ! function_exists( 'currency_format' ) ){
function currency_format( $number, $symbol = '' ){
    
    if( is_decimal( $number ) ){
        return $symbol . number_format( $number, 2 );
    } else {
        return $symbol . number_format( $number, 0 );
    }
    
}
}

/**
*   factorial
*
*   Returns the factorial of a number
*
*   @see https://www.geeksforgeeks.org/php-factorial-number/
*
*   @param int $number - the number to return the factorial of
*
*   @return int  - the factorial
*
*	@since	1.1.2
*/
if( ! function_exists( 'factorial') ){
function factorial( $number ){
    
    $factorial = 1; 
    for ($i = 1; $i <= $number; $i++){ 
      $factorial = $factorial * $i; 
    } 
    return $factorial; 
    
} 
}

/**
*   normal_dists
*
*   Returns a normal distribution, using Box-Muller transform (Box, Muller 1958)
*
*   @see https://en.wikipedia.org/wiki/Box%E2%80%93Muller_transform
*
*   @param float $mean - the mean of the distribution
*   @param float $variance - the variance of the distribution
*
*   @return float - a value in the distribution
*
*	@since	1.1.3
*/
if( ! function_exists( 'normal_dists' ) ){
function normal_dists( $mean, $variance ){
    
    $u = mt_rand()/mt_getrandmax();
    $v = mt_rand()/mt_getrandmax();
    $boxmuller =  sqrt(-2 * log($u)) * cos(2 * M_PI * $v);
    
    return $boxmuller * sqrt($variance) + $mean;
    
}
}

/**
*   multi_normal_dists
*
*   Returns multiple normal distributions
*
*   @param float $mean - the mean of the distribution
*   @param float $variance - the variance of the distribution
*   @param int $number - how many to return
*
*   @return array - a set of values in the distribution
*
*	@since	1.1.3
*/
if( ! function_exists( 'multi_normal_dists' ) ){
function multi_normal_dists( $mean, $margin, $number ){
    
    $dists = array();
    
    for( $x = 1; $x <= $number; $x++ ){
        
        $dists[] = better_normal_dists( $mean, $margin );
        
    }
    
    return $dists;
    
}
}

/**
*   rebase
*
*   Round array values to reach a given sum
*
*   @param array $array - the values to check
*   @param float $base - the number all items should round to
*   @param int $round - the rounding precision
*
*   @return array $array - the rebased array
*
*	@since	1.1.3
*/
if( ! function_exists( 'rebase' ) ){
function rebase( $array, $base = 1, $round = 6 ){
    
    $total = array_sum( $array );
    
    if( $total !== $base ){
        
        // Make sure it'll go to 1
        $coefficient = $base / $total;
        
        foreach( $array as $key => $val ){
            
            // If we want to round
            if( is_int( $round ) ){
            
                $array[$key] = round( $val * $coefficient, $round );
                
            } else {
                
                $array[$key] = $val * $coefficient;
                
            }
            
        }
        
    }
    
    return $array;
    
}
}

