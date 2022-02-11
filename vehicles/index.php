
<?php
//THI IS THE VEHICLE CONTROLLER

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
//Gets the accounts model, which is where all the connections and commands 
//for the SQL are
require_once '../model/vehicle-model.php';

//This creates the NAV list 
$classifications = getClassifications();
//var_dump($classifications);
$navList = '<ul>';
$navList .= "<li><a href='/acme/' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
$navList .= "<li><a href='/phpmotors/vehicles?action=classificationlist".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] vehicles'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

$dropList = '<select name="dropdown">';
foreach ($classifications as $classification){
$dropList .="<option value=$classification[classificationID]>$classification[classificationName]</option>";
}
$dropList.='</select>';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}


switch ($action){
   case 'regVehicle';
            // Filter and store the data
            $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
            $clientLastname = filter_input(INPUT_POST, 'clientLastname');
            $clientEmail = filter_input(INPUT_POST, 'clientEmail');
            $clientPassword = filter_input(INPUT_POST, 'clientPassword');
      
      
            // Check for missing data
          if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit; 
          }
      
          // Send the data to the model
          $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);
      
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

   case 'classification':
      include '../view/add-classification.php';
   break;

   case 'addVehicle':
      include '../view/add-vehicles.php';
   break;
    
   default:
     include '../view/vehicle-management.php';
   }
   


?>