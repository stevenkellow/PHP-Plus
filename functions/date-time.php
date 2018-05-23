<?php
/**
*   date-time.php
*
*   Functions that deal with date and time
*
*   @package PHP Plus!
*
*   @since  1.1
*/

/*  CONTENTS
*
*   get_timezone_offset
*   get_gmt_offset
*   get_gmt_from_date
*   get_date_from_gmt
*   human_time_diff
*   time_ago
*   date_mysql
*   easter_date_orthodox
*   is_past
*   is_future
*   is_today
*   is_yesterday
*   is_tomorrow
*   copyright
*   current_time
*   create_date_range
*   working_date_range
*   days_between
*/

/**
*	get_timezone_offset
*
*	Returns the offset from the origin timezone to the remote timezone, in seconds.
*
*	@since 1.1
*	@last_modified	1.1
*
*	@param $remote_tz;
*	@param $origin_tz; If null the servers current timezone is used as the origin.
*	@return int;
*/
if( ! function_exists( 'get_timezone_offset' ) ){
function get_timezone_offset( $remote_tz, $origin_tz = null ){
    if( $origin_tz === null ){
        if( !is_string( $origin_tz = date_default_timezone_get() )){
            return false; // A UTC timestamp was returned -- bail out!
        }
    }
    $origin_dtz = new DateTimeZone( $origin_tz );
    $remote_dtz = new DateTimeZone( $remote_tz );
    $origin_dt = new DateTime("now", $origin_dtz );
    $remote_dt = new DateTime("now", $remote_dtz );
    $offset = $origin_dtz->getOffset( $origin_dt ) - $remote_dtz->getOffset( $remote_dt );
    return $offset;
}
}

/**
*	get_gmt_offset
*
*	Returns the offset from the origin timezone to the GMT, in seconds.
*
*	@since 1.1
*	@last_modified	1.1
*
*	@param $timezone;
*
*	@return int;
*/
if( ! function_exists( 'get_gmt_offset' ) ){
function get_gmt_offset( $timezone = false ){
	
	// If there is no timezone provided, use the system default
	if( $timezone == false ){
		$timezone = date_default_timezone_get();
	}
	
	return get_timezone_offset( $timezone, 'UTC' );
	
}
}

/**
*	get_gmt_from_date
*
*	Returns a date in the GMT equivalent.
*
*	Requires and returns a date in the Y-m-d H:i:s format. If there is a
*	timezone_string available, the date is assumed to be in that timezone,
*	otherwise it simply subtracts the value of the 'gmt_offset' option. Return
*	format can be overridden using the $format parameter.
*
*	@author WordPress
*   @see https://developer.wordpress.org/reference/functions/get_gmt_from_date/
*
*	@since 1.1
*	@last_modified	1.1
*
*	@param string $string The date to be converted.
*	@param string $format The format string for the returned date (default is Y-m-d H:i:s)
*	@return string GMT version of the date provided.
*/
if( ! function_exists( 'get_gmt_from_date' ) ){
function get_gmt_from_date( $string, $format = 'Y-m-d H:i:s' ){
	$tz = date_default_timezone_get();
	if( $tz ){
		$datetime = date_create( $string, new DateTimeZone( $tz ) );
		if( ! $datetime ){
			return gmdate( $format, 0 );
		}
		$datetime->setTimezone( new DateTimeZone( 'UTC' ) );
		$string_gmt = $datetime->format( $format );
	} else {
		if( ! preg_match( '#([0-9]{1,4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#', $string, $matches ) ){
			$datetime = strtotime( $string );
			if( false === $datetime ){
				return gmdate( $format, 0 );
			}
			return gmdate( $format, $datetime );
		}
		$string_time = gmmktime( $matches[4], $matches[5], $matches[6], $matches[2], $matches[3], $matches[1] );
		$string_gmt  = gmdate( $format, $string_time - get_gmt_offset( $tz ) * HOUR_IN_SECONDS );
	}
	return $string_gmt;
}
}

/**
*	get_date_from_gmt
*
*	Converts a GMT date into the correct format for the blog.
*
*	Requires and returns a date in the Y-m-d H:i:s format. If there is a
*	timezone_string available, the returned date is in that timezone, otherwise
*	it simply adds the value of gmt_offset. Return format can be overridden
*	using the $format parameter
*
*	@author WordPress
*   @see https://developer.wordpress.org/reference/functions/get_date_from_gmt/
*
*	@since 1.1
*	@last_modified	1.1
*
*	@param string $string The date to be converted.
*	@param string $format The format string for the returned date (default is Y-m-d H:i:s)
*	@return string Formatted date relative to the timezone / GMT offset.
*/
if( ! function_exists( 'get_date_from_gmt' ) ){
function get_date_from_gmt( $string, $format = 'Y-m-d H:i:s' ){
	$tz = date_default_timezone_get();
	if( $tz ){
		$datetime = date_create( $string, new DateTimeZone( 'UTC' ) );
		if( ! $datetime ){
			return date( $format, 0 );
		}
		$datetime->setTimezone( new DateTimeZone( $tz ) );
		$string_localtime = $datetime->format( $format );
	} else {
		if( ! preg_match( '#([0-9]{1,4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#', $string, $matches ) ){
			return date( $format, 0 );
		}
		$string_time      = gmmktime( $matches[4], $matches[5], $matches[6], $matches[2], $matches[3], $matches[1] );
		$string_localtime = gmdate( $format, $string_time + get_gmt_offset( $tz ) * HOUR_IN_SECONDS );
	}
	return $string_localtime;
}
}

/**
*	human_time_diff
*	
*   Determines the difference between two timestamps.
*
*	The difference is returned in a human readable format such as "1 hour", "5 mins", "2 days".
*
*	@author WordPress
*   @see https://developer.wordpress.org/reference/functions/human_time_diff/
*
*	@since	1.1
*	@last_modified	1.1
*
*	@param int $from Unix timestamp from which the difference begins.
*	@param int $to   Optional. Unix timestamp to end the time difference. Default becomes time() if not set.
*	@return string Human readable time difference.
*/
if( ! function_exists( 'human_time_diff' ) ){
function human_time_diff( $from, $to = '' ){
	if( empty( $to ) ){
		$to = time();
	}
	
	// Allow to use text in the from/to inputs
	if( is_string( $from ) ){
		$from = strtotime( $from );
	}
	if( is_string( $to ) ){
		$to = strtotime( $to );
	}
	
	$diff = ( int) abs( $to - $from );

	if( $diff < HOUR_IN_SECONDS ){
		$mins = round( $diff / MINUTE_IN_SECONDS );
		if( $mins <= 1 ){
			$mins = 1;
		}
		/* translators: Time difference between two dates, in minutes (min=minute). %s: Number of minutes */
		$since = sprintf( ngettext( '%s min', '%s mins', $mins ), $mins );
	} elseif( $diff < DAY_IN_SECONDS && $diff >= HOUR_IN_SECONDS ){
		$hours = round( $diff / HOUR_IN_SECONDS );
		if( $hours <= 1 ){
			$hours = 1;
		}
		/* translators: Time difference between two dates, in hours. %s: Number of hours */
		$since = sprintf( ngettext( '%s hour', '%s hours', $hours ), $hours );
	} elseif( $diff < WEEK_IN_SECONDS && $diff >= DAY_IN_SECONDS ){
		$days = round( $diff / DAY_IN_SECONDS );
		if( $days <= 1 ){
			$days = 1;
		}
		/* translators: Time difference between two dates, in days. %s: Number of days */
		$since = sprintf( ngettext( '%s day', '%s days', $days ), $days );
	} elseif( $diff < MONTH_IN_SECONDS && $diff >= WEEK_IN_SECONDS ){
		$weeks = round( $diff / WEEK_IN_SECONDS );
		if( $weeks <= 1 ){
			$weeks = 1;
		}
		/* translators: Time difference between two dates, in weeks. %s: Number of weeks */
		$since = sprintf( ngettext( '%s week', '%s weeks', $weeks ), $weeks );
	} elseif( $diff < YEAR_IN_SECONDS && $diff >= MONTH_IN_SECONDS ){
		$months = round( $diff / MONTH_IN_SECONDS );
		if( $months <= 1 ){
			$months = 1;
		}
		/* translators: Time difference between two dates, in months. %s: Number of months */
		$since = sprintf( ngettext( '%s month', '%s months', $months ), $months );
	} elseif( $diff >= YEAR_IN_SECONDS ){
		$years = round( $diff / YEAR_IN_SECONDS );
		if( $years <= 1 ){
			$years = 1;
		}
		/* translators: Time difference between two dates, in years. %s: Number of years */
		$since = sprintf( ngettext( '%s year', '%s years', $years ), $years );
	}
	
	return $since;
}
}

/**
*   time_ago
*
*   Return the human readable difference between a given time and now
*
*	@since	1.1
*	@last_modified	1.1
*
*	@param int $from Unix timestamp from which the difference begins.
*
*   @return string - Human readable time difference.
*/
if( ! function_exists( 'time_ago' ) ){
function time_ago( $time ){
    
    return human_time_diff( $time, time() );
    
}
}


/**
*	date_mysql
*
*	Output an MySQL friendly date/time stamp
*
*	@since 1.0.2
*	@last_modified 1.1
*
*	@param string | int - $time - a time to base the output on
*	@param string $date_time - whether to output datetime or just date
*
*	@return string - MySQL datetime string
*
*/
if( ! function_exists( 'date_mysql' ) ){
function date_mysql( $time = false, $date_time = 'datetime' ){
    
    // Use current time if none set
    if( $time == false ){
        
        $time = time();
        
    } elseif( is_string( $time ) ){
        
        // Convert a string time to int
        $time = strtotime( $time );
    }
	
    // If outputting $date_time
    if( $date_time == 'date' ){
    
   	    return date( 'Y-m-d', $time );
	    
    } else {
	    
	   return date( 'Y-m-d H:i:s', $time );
	    
    }
    
}
}

/**
*	easter_date_orthodox
*
*	Output the date of Easter for Easter Orthodox churches in the UNIX epoch (1970 to 2037)
*
*   @author maxie
*   @source http://php.net/manual/en/function.easter-date.php#83794
*
*   @since  1.0
*   @last_modified  1.1
*
*	@param int $year - year to calculate easter for (default: current year)
*	@param string $date_format - the format to format the date in
*
*	@return int - timestamp of Easter (may want to use date to format)
*/
if( ! function_exists( 'easter_date_orthodox') ){
function easter_date_orthodox( $year = false, $date_format = false ){ 
    
    if( $year === false ){
        $year = date( 'Y' );
    }
    
    $a = $year % 4; 
    $b = $year % 7; 
    $c = $year % 19; 
    $d = ( 19 * $c + 15 ) % 30; 
    $e = ( 2 * $a + 4 * $b - $d + 34 ) % 7; 
    $month = floor(( $d + $e + 114 ) / 31 ); 
    $day = (( $d + $e + 114 ) % 31 ) + 1; 
    
    $de = mktime( 0, 0, 0, $month, $day + 13, $year );
	
	// If we want to format the date then do that
	$de = date( $date_format, $de );
    
    return $de; 
}
}

/**
*   is_past
*
*   Check if a date is in the past
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param string $date - the date to check
*
*   @return bool - true if in past, false if not
*/
if( ! function_exists( 'is_past' ) ){
function is_past( $date ){
    
    // Convert a string timestamp to integer
    if( is_string( $date ) ){
        $date = strtotime( $timestamp );
    }
    
    if( $date < time() ){
        
        return true;
        
    } else {
        
        return false;
        
    }
    
}
}

/**
*   is_future
*
*   Check if a date is in the future
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param string $date - the date to check
*
*   @return bool - true if in future, false if not
*/
if( ! function_exists( 'is_future' ) ){
function is_future( $date ){
    
    // Convert a string timestamp to integer
    if( is_string( $date ) ){
        $date = strtotime( $timestamp );
    }
    
    if( $date > time() ){
        
        return true;
        
    } else {
        
        return false;
        
    }
    
}
}

/**
*   is_today
*
*   Check if a timestamp is today
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param string - a timestamp
*
*   @return bool - true if today, false if not
*/
if( ! function_exists( 'is_today' ) ){
function is_today( $timestamp ){
    
    // Convert a string timestamp to integer
    if( is_string( $timestamp ) ){
        $timestamp = strtotime( $timestamp );
    }
    
    if( date('Ymd') == date('Ymd', $timestamp ) ){
        
        return true;
        
    } else {
        
        return false;
        
    }
    
}
}

/**
*   is_yesterday
*
*   Check if a timestamp is yesterday
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param string - a timestamp
*
*   @return bool - true if yesterday, false if not
*/
if( ! function_exists( 'is_yesterday' ) ){
function is_yesterday( $timestamp ){
    
    // Convert a string timestamp to integer
    if( is_string( $timestamp ) ){
        $timestamp = strtotime( $timestamp );
    }
    
    if( date('Ymd', time() - DAY_IN_SECONDS ) == date('Ymd', $timestamp ) ){
        
        return true;
        
    } else {
        
        return false;
        
    }
    
}
}

/**
*   is_tomorrow
*
*   Check if a timestamp is tomorrow
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param string - a tomorrow
*
*   @return bool - true if tomorrow, false if not
*/
if( ! function_exists( 'is_tomorrow' ) ){
function is_tomorrow( $timestamp ){
    
    // Convert a string timestamp to integer
    if( is_string( $timestamp ) ){
        $timestamp = strtotime( $timestamp );
    }
    
    if( date('Ymd', time() + DAY_IN_SECONDS ) == date('Ymd', $timestamp ) ){
        
        return true;
        
    } else {
        
        return false;
        
    }
    
}
}

/**
*
*	copyright
*
*	Output an automatic copyright notice
*
*   @author Chris Coyier
*   @source https://css-tricks.com/snippets/php/automatic-copyright-year/
*
*   @since 0.1
*   @last_modified 0.1
*
*	@param int $year - a start year for copyright
*   @param bool $roman - use roman numerals for year
*
*	@return string - copyright notice like (c) 2017, (c) MMVII or (c) 2012 - 2017
*/
if( ! function_exists( 'copyright' ) ){
function copyright( $year = false, $roman = false ){
	
    if( intval( $year ) == false ){
        $year = date('Y');
    }
    
	if( intval( $year ) == date('Y') ){
        // Output the copy symbol and either the year or the year in Roman numerals
        return '&copy; ' . ( $roman == false ? intval( $year ) : arabic2roman( intval( $year ) ) );
    }
    
	if( intval( $year ) < date('Y') ){
        // Output the copy symbol and either the year range or the year range in Roman numerals
        return '&copy; ' . ( $roman == false ? ( intval( $year ) . ' - ' . date('Y') ) : ( arabic2roman( intval( $year ) ) . ' - ' . arabic2roman( date('Y') ) ) );
    }
    
	if( intval( $year ) > date('Y') ){
        // Output the copy symbol and the current year or the current year in Roman numerals
        return '&copy; ' . ( $roman == false ? date('Y') : arabic2roman( date('Y') ) );
    } 
}
}

/**
*   current_time
*
*   Get the current time in a variety of formats
*
*   @author WordPress
*   @see https://developer.wordpress.org/reference/functions/current_time/
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param string $type - either 'mysql' for MySQL format, 'timestamp' for integer, or PHP date format
*   @param int | bool $gmt - whether to use GMT time
*
*   @return string - the date
*/
if( ! function_exists( 'current_time' ) ){
function current_time( $type, $gmt = 0 ){
	switch ( $type ){
		case 'mysql':
			return ( $gmt ) ? gmdate( 'Y-m-d H:i:s' ) : gmdate( 'Y-m-d H:i:s', ( time() + ( get_gmt_offset() * HOUR_IN_SECONDS ) ) );
		case 'timestamp':
			return ( $gmt ) ? time() : time() + ( get_gmt_offset() * HOUR_IN_SECONDS );
		default:
			return ( $gmt ) ? date( $type ) : date( $type, time() + ( get_gmt_offset() * HOUR_IN_SECONDS ) );
	}
}
}

/**
*   create_date_range
*
*   Create an array of dates between two given dates (includes the start and excludes the end)
*
*   @author ViNce
*   @see https://stackoverflow.com/a/4312630/7956549
*
*	@since	1.1
*	@last_modified    1.1
*
*   @param string $start - the first date to include
*   @param string $end - the last date in the range
*   @param string $format - the date format to use
*
*   @return array $dates - an array of dates, formatted as requested
*/
if( ! function_exists( 'create_date_range' ) ){
function create_date_range( $start, $end, $format = 'Y-m-d' ){
	
	// Make sure the dates are formatted correctly, and that we use the last day
	$start = date( 'Y-m-d', strtotime( $start ) );
	$end = date( 'Y-m-d', strtotime( $end ) + DAY_IN_SECONDS );
	
    // Create a DatePeriod object
	$period = new DatePeriod(
		 new DateTime( $start ),
		 new DateInterval('P1D'),
		 new DateTime( $end )
	);
	
    // Open the array of dates
	$dates = array();
	
    // Add each date to the array
	foreach( $period as $key => $value ){
		$dates[] = $value->format( $format );  
	}
	
    // Return the answer
	return $dates;
	
}
}

/**
*   working_date_range
*
*   Get a list of working days between two dates
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param string $start - the first date to include
*   @param string $end - the last date in the range
*   @param string $format - the date format to use
*   @param array $working_days - an array of day digits that are "working" days
*
*   @return array $dates - an array of dates, formatted as requested
*/
if( ! function_exists( 'working_date_range' ) ){
function working_date_range( $start, $end, $format = 'Y-m-d', $working_days = array( 1, 2, 3, 4, 5 ) ){
    
    // Create the date range
    $date_range = create_date_range( $start, $end, $format );
    
    // Create the working date range
    $working_date_range = array();
    
    // Go through each day
    foreach( $date_range as $day ){
        
        // If it's a working day then add to the array
        if( in_array( date( 'N', strtotime( $day ) ), $working_days ) ){
            
            $working_date_range[] = $day;
            
        }
        
        
    }
    
    // Return the dates
    return $working_date_range;
    
}
}

/**
*   days_between
*
*   Count the days between two dates
*
*	@since	1.1
*	@last_modified	1.1
*
*   @param string $start - the first date to include
*   @param string $end - the last date in the range
*   @param array $working_days - if only counting certain days, an array of day digits that are "working" days
*
*   @return int - the number of days
*/
if( ! function_exists( 'days_between' ) ){
function days_between( $start, $end, $working_days = array() ){
    
    if( empty( $working_days ) ){
        
        return count( create_date_range( $start, $end ) ) - 1;
        
    } else {
        
        return count( working_date_range( $start, $end, 'Y-m-d', $working_days ) ) - 1;
        
    }
    
    
    
}
}