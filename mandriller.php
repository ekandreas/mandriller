<?php
/*
Plugin Name:        Mandriller
Description:        Reuse of mail functions with Mandrill
Version:            0.1
Author:             Andreas Ek
Author URI:         http://www.aekab.se/
License:            MIT License
License URI:        http://opensource.org/licenses/MIT
*/
if( !class_exists('Mandriller\Message')) {
	require_once('vendor/autoload.php');
}

include_once 'globals.php';
include_once 'filters.php';

