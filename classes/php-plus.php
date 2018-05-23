<?php
/**
*   PHPPlus
*
*	A library of curated PHP helper functions, polyfills and more to add life to your PHP install
*
*	@author Steven Kellow
*	@url https://wwww.stevenkellow.com/phpplus/
*
*	@since	1.1
*	@last_modified	1.1
*/
class PHPPlus{
    
    /**
    *   files
    *
    *   The function files available to load
    *
    *	@since	1.1
    *	@last_modified	1.1
    */
    protected static $files = array(
        'constants', // Load first to avoid dependency issues
        'arrays',
        'date-time',
        'i-o',
        'math',
        'output',
        'security',
        'sessions',
        'strings',
        'variables'
    );
    
    /**
    *   load
    *
    *   Load the required files
    *
    *   @param array $include - the files to include (defaults to empty, which includes all)
    *   @param array $exclude - the files to exclude (defaults to empty, which excludes none)
    *
    *   @return array $loaded - the files that have been loaded
    *
    *	@since	1.1
    *	@last_modified	1.1
    */
    public static function load( $include = array(), $exclude = array() ){

        // Check incase we only want to include certain files
        if( ! empty( $include ) ){

            foreach( $include as $file ){
                
                // Check if the file is in the available files
                if( in_array( $file, self::$files ) ){
                
                    $include_array[] = $full_array[$file];
                    
                }
            }

        } else {

            $include_array = self::$files;

        }

        // Check if we want to exclude certain files
        if( ! empty( $exclude ) ){
            
            $include_array = array_diff( self::$values, $exclude );

        }
        
        // Load in each file
        $loaded = array();
        foreach( $include_array as $file ){
            
            // Create the path name
            $path = __DIR__ . '/../functions/' . $file . '.php';
            
            try{

                include_once( $path );
                
                $loaded[] = $path;
                
            } catch ( Exception $e ){
                
                // Handle silently
                
            }

        }
        
        // Return an array of all the loaded files
        return $loaded;
        
    }
    
}