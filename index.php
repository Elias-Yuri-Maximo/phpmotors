<?php
//THIS IS THE MAIN CONTRLLER FOR THE WEBSITE



// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
//Gets the functions library
require_once 'library/functions.php';

// Create or access a Session
session_start();

$classifications = getClassifications();
//This gets the classifications requested by the model
$navList = renderNavBar($classifications);

//var_dump($classifications);
//	exit;

 
/*$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
$navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
 }
$navList .= '</ul>';
*/
//echo $navList;
//exit;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}

if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

}

switch ($action){
    case 'something':
        include 'view/template.php';
     break;
    
    
    
    default:
     include 'view/home.php';
   }
   
?>