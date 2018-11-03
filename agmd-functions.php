<?php


/*
require ('agmd/model/database.php');
require ('agmd/model/DoctorDB.php');
*/
global $db_username;
global $db_password;
global $db_database;
global $db_host;
global $agmd_doctor_details_page;
global $agmd_doctor_accordion_page;
/*local
$db_username = 'root';
$db_password = 'pa55word';
$db_database = 'agmd';
$db_host = 'localhost:3306';
*/
$db_username = 'agmdho5_dev';
$db_password = 'd5v%0gMd';
$db_database = 'agmdho5_admin';
$db_host = 'localhost';
/*local
$agmd_doctor_accordion_page = 2730;
$agmd_doctor_details_page = 2735;
*/
$agmd_doctor_accordion_page = 1960;
$agmd_doctor_details_page = 1966;
/*
function bootstrapstarter_enqueue_styles() {
    wp_register_style('bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css' );
    $dependencies = array('bootstrap');
    wp_enqueue_style( 'bootstrapstarter-style', get_stylesheet_uri(), $dependencies ); 
}

function bootstrapstarter_enqueue_scripts() {
	//wp_enqueue_script('jquery_js','https://code.jquery.com/jquery-3.2.1.slim.min.js');
	
	wp_enqueue_script( 'pooper_js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js');
    $dependencies = array('jquery');
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/bootstrap/js/bootstrap.min.js', $dependencies, '3.3.6', true );
	
	wp_enqueue_script('bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js');
	

}
*/
//add_action( 'wp_enqueue_scripts', 'bootstrapstarter_enqueue_styles' );
//add_action( 'wp_enqueue_scripts', 'bootstrapstarter_enqueue_scripts' );


function agmd_files(){

  wp_enqueue_style( 'agmd-style', get_template_directory_uri() . '/agmd/css/agmd-style.css' );

  wp_enqueue_script('agmd-js',get_theme_file_uri('/agmd/js/agmd-scripts.js',array('jquery')),
  NULL,      //js has dependecy on other js
  microtime(),     //version: uing php function so it doesn't cache
  true);     //load before closing body tag


  wp_enqueue_style('university_main_style', 
    get_stylesheet_uri(),
    NULL,    //NO DEP
    microtime()   //Avoid caching

  );
 

  
}
add_action('wp_enqueue_scripts','agmd_files');

function agmd_features(){

  // Add feature for theme
  add_theme_support('title-tag');
}
add_action('after_setup_theme', 'agmd_features');


/*
 * CUSTOM GLOBAL VARIABLES
 */
function wpagmd_global_vars() {

	global $wpagmd;
	$wpagmd['db_username'] = get_query_var('agmdho5_dev');
	$wpagmd['db_password'] = get_query_var('d5v%0gMd');
    $wpagmd['db_database'] = get_query_var('agmdho5_admin');
    $wpagmd['db_host'] = get_query_var('localhost');

}
//parse_query
add_action( 'init', 'wpagmd_global_vars' );


function get_doctor() {
	

$doctorDB = new DoctorDB();
$state = $_POST['state'];


$results = NULL;
$results = $doctorDB->get_wp_DoctorByState($state);
echo $results;

die(); 
}

add_action('wp_ajax_get_doctor', 'get_doctor');
add_action('wp_ajax_nopriv_get_doctor', 'get_doctor');


?>