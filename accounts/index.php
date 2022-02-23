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

// Create or access a Session
session_start();


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

    //Check if e-mail is duplicated
    $checkEmail = checkExistingEmail($clientEmail);
    if($checkEmail){
      $message = '<p>This e-mail already exists, do you want to login?</p>';
      include '../view/login.php';
      exit;
    }

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
      $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";  
      //$message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
      setcookie("firstname", $clientFirstname, strtotime('+ 1 year'), '/' );
      header('Location: /phpmotors/accounts/?action=login');
      //include '../view/login.php';
      exit;

    } else {
      $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/registration.php';
      exit;
    }


    break;

    case 'Login';
    
    $clientEmail= trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientEmail = checkEmail($clientEmail);

    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_UNSAFE_RAW));
    $checkPassword = checkPassword($clientPassword);

      // Check for missing data
      if(empty($clientEmail) || empty($checkPassword)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../view/login.php';
        exit; 
        }

      // A valid password exists, proceed with the login process
      // Query the client data based on the email address
      $clientData = getClient($clientEmail);
      // Compare the password just submitted against
      // the hashed password for the matching client
      $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
      // If the hashes don't match create an error
      // and return to the login view
      if(!$hashCheck) {
        $message = '<p class="notice">Please check your password and try again.</p>';
        include '../view/login.php';
        exit;
      }
      // A valid user exists, log them in
      $_SESSION['loggedin'] = TRUE;
      // Remove the password from the array
      // the array_pop function removes the last
      // element from an array
      array_pop($clientData);
      // Store the array into the session
      $_SESSION['clientData'] = $clientData;
      // Send them to the admin view
      include '../view/admin.php';
      exit;

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
      include '../view/admin.php';
      
   }
   
?>