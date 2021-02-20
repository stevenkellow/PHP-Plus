<?php
/**
*	Constants
*
*	@package PHP Plus!
*
*
*/

/*  CONTENTS
*
*   PATH_TO_PHP_PLUS
*
*   MINUTE_IN_SECONDS
*       MINUTE
*   HOUR_IN_SECONDS
*       HOUR
*   DAY_IN_SECONDS
*       DAY
*   WEEK_IN_SECONDS
*       WEEK
*   MONTH_IN_SECONDS
*       MONTH
*   YEAR_IN_SECONDS
*       YEAR
*
*   KB_IN_BYTES
*   MB_IN_BYTES
*   GB_IN_BYTES
*   TB_IN_BYTES
*
*   PI
*   C
*       SPEED_OF_LIGHT
*   MILLION
*   BILLION
*   TRILLION
*/

/*
*   Define the core directory
*/
define( 'PATH_TO_PHP_PLUS', __DIR__ . '/..' );

/**
*   Time constants
*
*   @author WordPress
*   @see https://codex.wordpress.org/Easier_Expression_of_Time_Constants
*
*   @since 0.1
*   @modified 0.1
*/

// Minutes
if( ! defined( 'MINUTE_IN_SECONDS') ){
    define( 'MINUTE_IN_SECONDS', 60 );
}
    if( ! defined( 'MINUTE') ){
        define( 'MINUTE', 60 );
    }

// Hours
if( ! defined( 'HOUR_IN_SECONDS') ){
    define( 'HOUR_IN_SECONDS', 60 * 60 );
}
    if( ! defined( 'HOUR') ){
        define( 'HOUR', 60 * 60 );
    }

// Days
if( ! defined( 'DAY_IN_SECONDS') ){
    define( 'DAY_IN_SECONDS', 24 * 60 * 60 );
}
    if( ! defined( 'DAY') ){
        define( 'DAY', 24 * 60 * 60 );
    }

// Weeks
if( ! defined( 'WEEK_IN_SECONDS') ){
    define( 'WEEK_IN_SECONDS', 7 * 24 * 60 * 60 );
}
    if( ! defined( 'WEEK') ){
        define( 'WEEK', 7 * 24 * 60 * 60 );
    }

// Months
if( ! defined( 'MONTH_IN_SECONDS') ){
    define( 'MONTH_IN_SECONDS', 30 * 24 * 60 * 60 );
}
    if( ! defined( 'MONTH') ){
        define( 'MONTH', 30 * 24 * 60 * 60 );
    }

// Years
if( ! defined( 'YEAR_IN_SECONDS') ){
    define( 'YEAR_IN_SECONDS', 365 * 24 * 60 * 60 );
}
    if( ! defined( 'YEAR') ){
        define( 'YEAR', 365 * 24 * 60 * 60 );
    }

/**
*   Data storage constants
*
*   @author WordPress
*   @source https://core.trac.wordpress.org/browser/tags/4.7.3/src/wp-includes/default-constants.php#L0
*
*   @since 0.1
*   @modified 0.1
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

/**
*   Math constants
*
*   @since 0.1
*   @modified 1.0.3
*/

// PI - as defined by PHP
if( ! defined( 'PI') ){
    define( 'PI', M_PI );
}

// Speed of Light (m/s )
if( ! defined( 'C' ) ){
    define( 'C', 299792458 );
}
if( ! defined( 'SPEED_OF_LIGHT') ){
    define( 'SPEED_OF_LIGHT', 299792458 );
}

if( ! defined( 'MILLION') ){
    define( 'MILLION', 1000000 );
}

if( ! defined( 'BILLION') ){
    define( 'BILLION', 1000 * MILLION );
}

if( ! defined( 'TRILLION') ){
    define( 'TRILLION', 1000 * BILLION );
}