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
*   floor_dec
*/
/*
*   floor_dec
*
*   Round a decimal down (truncate after certain point) credit to Maikl: http://php.net/manual/en/function.floor.php#114195
*
*   @since v. 0.1
*   @last_modified v 0.1
*
*   @param float $number - number to round
*   @param integer $precision - number of decimal places
*   @param string $separator - add different separator (internationalisation)
*
*   @return float
*/
if( ! function_exists( 'floor_dec' ){
function floor_dec( $number, $precision = 2, $separator = '.') {
    
    $numberpart = explode( $separator, $number );
    $numberpart[1] = substr_replace( $numberpart[1], $separator, $precision, 0);
    
    if( $numberpart[0] >= 0) {
        $numberpart[1] = substr( floor( '1' . $numberpart[1] ), 1 );
    } else {
        $numberpart[1] = substr( ceil( '1' . $numberpart[1] ), 1);
    }
    
    $ceil_number = array( $numberpart[0], $numberpart[1] );
    
    return implode( $separator, $ceil_number );
}
}