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
*
*   @return float $average - the average of all elements
*/
if( ! function_exists( 'average') ){
function average( $array ){
    
    return array_sum( $array ) / count( $array ); 
    
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
*   @param integer $number - number to return absolute
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
*   @param array $array - set of numbers to add up
*
*   @return integer / float
*/
if( ! function_exists( 'sum' ) ){
function sum( $array ){
    return array_sum( $array );
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
function roman2arabic( $roman ){
    $romans = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1); 

    $integer = 0;

    foreach ($romans as $key => $value) {
        while (strpos($roman, $key) === 0) {
            $integer += $value;
            $roman = substr($roman, strlen($key));
        }
    }
    return $integer;

}