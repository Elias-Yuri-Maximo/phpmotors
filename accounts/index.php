<?php
//THIS IS THE ACCOUNTS CONTRLLER FOR THE WEBSITE



// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
//Gets the accounts model, which is where all the connections and commands 
//for the SQL are
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';


$classifications = getClassifications();
//This gets the classifications requested by the model
$navList = renderNavBar($classifications);
//var_dump($classifications);
//	exit;

/*
$navList = '<ul>';
$navList .= "<li><a href='/acme/' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
$navList .= "<li><a href='/phpmotors/vehicles?action=classificationlist".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] vehicles'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';
*/
//echo $navList;
//exit;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}
//echo $action;

switch ($action){

    case 'register':
      // Filter and store the data
      //FILTER_UNSAFE_RAW/ FILTER_SANITIZE_STRING
      $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname',FILTER_UNSAFE_RAW));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_UNSAFE_RAW));
      
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientEmail = checkEmail($clientEmail);
      
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_UNSAFE_RAW));
      $checkPassword = checkPassword($clientPassword);

      // Check for missing data
    if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
      $message = '<p>Please provide information for all empty form fields.</p>';
      include '../view/registration.php';
      exit; 
    }


    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
    // Send the data to the model
    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

    // Check and report the result
  if($regOutcome === 1){
      $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
      include '../view/login.php';
      exit;
    } else {
      $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/registration.php';
      exit;
    }


    break;

    case 'Login';
    
    $clientEmail= trim(filter_input(INPUT_POST, 'clientEmail',FILTER_UNSAFE_RAW));
    $clientEmail = checkEmail($clientEmail);

    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_UNSAFE_RAW));
    $checkPassword = checkPassword($clientPassword);

      // Check for missing data
      if(empty($clientEmail) || empty($checkPassword)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../view/login.php';
        exit; 
        }
    break;



    case 'login':
      include '../view/login.php';
     break;

    case 'registration':
      include '../view/registration.php';
    break;

    case 'template':
      include '../view/template.php';
    break;

    case 'error':
      include '../view/error-message.php';
    break;
    
    default:
      //include '../view/login.php';
      echo'default view';
   }
   
?>