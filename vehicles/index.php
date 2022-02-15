
<?php
//THI IS THE VEHICLE CONTROLLER

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
//Gets the accounts model, which is where all the connections and commands 
//for the SQL are
require_once '../model/vehicle-model.php';
//Gets the library with the utility functions
require_once '../library/functions.php';

//This creates the NAV list 
$classifications = getClassifications();
$navList = renderNavBar($classifications);
//var_dump($classifications);
/*
$navList = '<ul>';
$navList .= "<li><a href='/acme/' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
$navList .= "<li><a href='/phpmotors/vehicles?action=classificationlist".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] vehicles'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

/Creates the dropdown list
$dropList = '<select id="classification" name="classificationId">';
foreach ($classifications as $classification){
$dropList .="<option value=$classification[classificationID]>$classification[classificationName]</option>";
}
$dropList.='</select>';
*/
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}


switch ($action){
   case 'regVehicle';
            // Filter and store the data
            $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_UNSAFE_RAW));
            $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_UNSAFE_RAW));
            $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_UNSAFE_RAW));
            $invImage = 'http://localhost/phpmotors/images/no-image.png';
            $invThumbnail = 'http://localhost/phpmotors/images/no-image.png';
            
            //$invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_UNSAFE_RAW));
            //$invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_UNSAFE_RAW));
            $invPrice = trim(filter_input(INPUT_POST, 'invPrice',FILTER_FLAG_ALLOW_FRACTION ));
            $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
            $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_UNSAFE_RAW));
            
            //This gets the post from the dropdown list
            $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
      
      
            // Check for missing data
          if(empty($invMake) || empty( $invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)|| empty($classificationId)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-vehicles.php';
            exit; 
          }
      
          // Send the data to the model
          $regOutcome = regVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
      
          // Check and report the result
        if($regOutcome === 1){
            $message = "<p>The $invModel was successfully added.</p>";
            include '../view/add-vehicles.php';
            exit;
          } else {
            $message = "<p>Sorry but the registration for the $invModel failed. Please try again.</p>";
            include '../view/add-vehicles.php';
            exit;
          }
      
   break;

   case 'addClassification';
   // Filter and store the data
    $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING);
    $checkClassificationName = checkClassificationName($classificationName);
echo $checkClassificationName;
    

   // Check for missing data
 if(empty($checkClassificationName)){
   $message = '<p>Invalid Classfication name, Please enter the new classification name.</p>';
    include '../view/add-classification.php';
   exit; 
 }

 // Send the data to the model
 $regOutcome = addClassification($classificationName);

 // Check and report the result
if($regOutcome === 1){
   $message = "<p>The $classificationName successfully added.</p>";
   header('Location: /phpmotors/vehicles/index.php');
   exit;
   
   
 } else {
   $message = "<p>Sorry but the registration for the new $classificationName failed. Please try again.</p>";
   include '../view/add-classification.php';
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
     break;
   }
   


?>