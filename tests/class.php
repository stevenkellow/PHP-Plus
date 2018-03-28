<?php

class PHP_Plus_Test {
    
    public static $bigint;
    public static $smallint;
    public static $tinyint;
    
    public static $true = true;
    public static $false = false;
    public static $true_string = 'true';
    public static $false_string = 'false';
    
    public static $email = 'test.name@gmail.com';
    public static $email_bad = 'test@gmail';
    
    public static $http_url = 'http://www.google.com';
    public static $https_url = 'https://www.google.com';
    
    public static function call( $function, $args, $expected ){
        
        try{
            
            $result = call_user_func_array( $function, $args );
            
            if( $result === $expected ){
                
                return true;
                
            } else {
                
                return false;
                
            }
            
        } catch( Exception $e ){
            
            return false;
            
        }
        
    }
    
}