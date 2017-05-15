<?php
/*
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
*   average
*   is_even
*   is_odd
*   round_up
*   round_down
*   sum
*   arabic2roman
*   roman2arabic
*   temperature
*   latlon_distance
*/

/*
*   absint
*
*   Convert a value to non-negative integer
*
*   @author WordPress
*   @source https://developer.wordpress.org/reference/functions/absint/
*
*   @since v. 0.1
*   @last_modified v 0.1
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

/*
*   average
*
*   Get the average of a set of values in an array
*
*   @author Mucello
*   @source http://php.net/manual/en/function.array-sum.php
*
*   @since v. 0.1
*   @last_modified v 0.1
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

/*
*   is_even
*
*   Check if a number is even
*
*   @author Pawel Dubiel
*   @source http://stackoverflow.com/a/9153969
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param integer $number - number to check
*
*   @return bool - true if it's even, false if it's not
*/
function is_even( $number ){
	
	if( $number & 1 ){
	    return false;
	} else {
	    return true;
	}
	
}

/*
*   is_odd
*
*   Check if a number is odd
*
*   @author Pawel Dubiel
*   @source http://stackoverflow.com/a/9153969
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param integer $number - number to check
*
*   @return bool - true if it's odd, false if it's not
*/
function is_odd( $number ){
	
	if( $number & 1 ){
	    return true;
	} else {
	    return false;
	}
	
}

/*
*   round_up
*
*   Round number up to specified precision
*
*   @author taking sides
*   @source http://php.net/manual/en/function.round.php#114573
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param integer $number - number to round
*	@param integer $precision - number of decimal places to round to
*
*   @return integer / float - rounded number
*/
function round_up($number, $precision = 2){
    $fig = (int) str_pad('1', ( $precision + 1 ), '0');
    return (ceil($number * $fig) / $fig);
}

/*
*   round_down
*
*   Round number up to specified value
*
*   @author taking sides
*   @source http://php.net/manual/en/function.round.php#114573
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param integer $number - number to round
*	@param integer $precision - number of decimal places to round to
*
*   @return integer / float - rounded number
*/
function round_down($number, $precision = 2){
    $fig = (int) str_pad('1', ( $precision + 1 ), '0');
    return (floor($number * $fig) / $fig);
}
   
/*
*   sum
*
*   Sum of values in an array (alias of array_sum)
*
*   @since v. 0.1
*   @last_modified v 0.1
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
   
/*
*   arabic2roman
*
*   Convert an integer in Arabic numerals to Roman numerals
*
*   @author user2095686
*   @source http://stackoverflow.com/a/15023547
*
*   @since v. 0.1
*   @last_modified v 0.1
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
   
   
/*
*   roman2arabic
*
*   Convert a string from Roman numerals to Arabic numerals
*
*   @author andyb
*   @source http://stackoverflow.com/a/6266158
*
*   @since v. 0.1
*   @last_modified v 0.1
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

/*
*   temperature
*
*   Convert a temperature between celsius, fahrenheit and kelvin
*
*   @since v. 0.1
*   @last_modified v 0.1
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
	
	if( $from = 'fahrenheit' ){
		
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

/*
*   latlon_distance
*
*   Calculate a distance between two latitude and longitude positions
*
*	@author Janith Chinthana
*	@source http://stackoverflow.com/a/30556851/7956549
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @params int | float $lat1 - first latitude
*   @params int | float $lon - first longitude
*   @params int | float $lat1 - second latitude
*   @params int | float $lon - second longitude
*   @params string $unit - unit to use (K for Kilometers, N for Nautical Miles or M for miles)
*
*   @return int | float - distance between the two points
*/
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