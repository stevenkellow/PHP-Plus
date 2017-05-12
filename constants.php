<?php
/*
*	Constants
*
*	@package PHP Plus!
*
*
*/

/**
*   Time constants
*
*   @author WordPress
*   @source https://core.trac.wordpress.org/browser/tags/4.7.3/src/wp-includes/default-constants.php#L0
*
*   @since 0.1
*   @last_modified 0.1
*/

if( ! defined( 'CURRENT_TIME') ){
    define( 'CURRENT_TIME', time() );
}

if( ! defined( 'MINUTE_IN_SECONDS') ){
    define( 'MINUTE_IN_SECONDS', 60);
}

if( ! defined( 'HOUR_IN_SECONDS') ){
    define( 'HOUR_IN_SECONDS', 60 * MINUTE_IN_SECONDS);
}

if( ! defined( 'DAY_IN_SECONDS') ){
    define( 'DAY_IN_SECONDS', 24 * HOUR_IN_SECONDS);
}

if( ! defined( 'WEEK_IN_SECONDS') ){
    define( 'WEEK_IN_SECONDS', 7 * DAY_IN_SECONDS);
}

if( ! defined( 'MONTH_IN_SECONDS') ){
    define( 'MONTH_IN_SECONDS', 30 * DAY_IN_SECONDS);
}

if( ! defined( 'YEAR_IN_SECONDS') ){
    define( 'YEAR_IN_SECONDS', 365 * DAY_IN_SECONDS);
}

/*
*   Data storage constants
*
*   @author WordPress
*   @source https://core.trac.wordpress.org/browser/tags/4.7.3/src/wp-includes/default-constants.php#L0
*
*   @since 0.1
*   @last_modified 0.1
*/

if( ! defined( 'KB_IN_BYTES') ){
    define( 'KB_IN_BYTES', 1024 );
}

if( ! defined( 'MB_IN_BYTES') ){
    define( 'MB_IN_BYTES', 1024 * KB_IN_BYTES );
}

if( ! defined( 'GB_IN_BYTES') ){
    define( 'GB_IN_BYTES', 1024 * MB_IN_BYTES );
}

if( ! defined( 'TB_IN_BYTES') ){
    define( 'TB_IN_BYTES', 1024 * GB_IN_BYTES );
}

/*
*   Math constants
*/

// PI - as defined by PHP
if( ! defined( 'PI') ){
    define( 'PI', M_PI );
}

// Speed of Light (m/s)
if( ! defined( 'SPEED_OF_LIGHT') ){
    define( 'SPEED_OF_LIGHT', 299792458 );
}