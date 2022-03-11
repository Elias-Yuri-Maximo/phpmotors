
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

// Create or access a Session
session_start();


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
   checkUserLog();
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
   checkUserLog();
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

   case 'classificationView':
    checkUserLog();
      include '../view/add-classification.php';
   break;

   case 'addVehicle':
    checkUserLog();
      include '../view/add-vehicles.php';
   break;

  
   /* * ********************************** 
  * Get vehicles by classificationId 
  * Used for starting Update & Delete process 
  * ********************************** */ 
  case 'getInventoryItems': 
  // Get the classificationId 
  $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
  // Fetch the vehicles by classificationId from the DB 
  $inventoryArray = getInventoryByClassification($classificationId); 
  // Convert the array to a JSON object and send it back 
  echo json_encode($inventoryArray); 
  break;

  ///PART 1 OF THE MODIFYING VEHICLE PROCESS
  //- gets the id and the info for the car
  // (coming from the table on the car management view)  
  //-Shows the vehicle update view

  case 'mod';
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);

    if(count($invInfo)<1){
      $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-update.php';
    exit;

  break;

  //SECOND PART FOR THE MODIFYYING VEHICLE PROCESS
  //-coming from the update-vehicle.php page 
  //-gets the information from the form in the update view
  //-checks if it is empty 
  //-sends the update to be processed by the model
  //-checks to see if any errors were returned

  case 'updateVehicle':
  
    // Filter and store the data
    $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_UNSAFE_RAW));
    $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_UNSAFE_RAW));
    $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_UNSAFE_RAW));
    $invImage = 'http://localhost/phpmotors/images/no-image.png';
    $invThumbnail = 'http://localhost/phpmotors/images/no-image.png';
    
    //$invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_UNSAFE_RAW));
    //$invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_UNSAFE_RAW));
    //The FILTER_FLAG_ALLOW_FRACTION was throwing an error, so I changed it for 
    // FILTER_SANITIZE_NUMBER_FLOAT
    $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT ));
    $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
    $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_UNSAFE_RAW));
    
    //This gets the post from the dropdown list
    $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

    // Check for missing data
  if(empty($invMake) || empty( $invModel) || empty($invDescription) 
  || empty($invImage) || empty($invThumbnail) || empty($invPrice) 
  || empty($invStock) || empty($invColor)|| empty($classificationId)){
    $message = '<p>Please provide information for all empty form fields.</p>';
    include '../view/vehicle-update.php';
    exit; 
  }

  // Send the data to the model
  $updateResult = updateVehicle($invMake, $invModel,
  $invDescription, $invImage, $invThumbnail, $invPrice, $invStock,
   $invColor, $classificationId, $invId);

  // Check and report the result
if($updateResult === 1){
    $message = "<p class='notice'>The $invModel was successfully updated.</p>";
    $_SESSION['message'] = $message;
    header('location: /phpmotors/vehicles/');
    exit;

  } else {
    $message = "<p>Sorry but the update for the $invModel failed. Please try again.</p>";
    include '../view/vehicle-update.php';
    exit;
  }
  break;

  //STEP ONE FOR THE DELETION PROCESS
  case 'del':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);

    if(count($invInfo)<1){
      $message = 'Sorry, no vehicle information could be found.';
      //alters the message if it failed
    }
    include '../view/vehicle-delete.php';
    exit;

  break;

  //STEP TWO FOR THE DELETION PROCESS
  //-Make the deletion 
  //-report the results 
  case 'deleteVehicle':
  
     // Filter and store the data
     $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_UNSAFE_RAW));
     $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_UNSAFE_RAW));
     $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
 
 
   // Send the data to the model
   $deleteResult = deleteVehicle($invId);
 
   // Check and report the result
 if($deleteResult === 1){
     $message = "<p class='notice'>The $invModel was successfully deleted.</p>";
     $_SESSION['message'] = $message;
     header('location: /phpmotors/vehicles/');
     exit;
 
   } else {
     $message = "<p>Sorry but the deletion for the $invModel failed. Please try again.</p>";
     $_SESSION['message'] = $message;
     include '../view/vehicle-update.php';
     exit;
   }

  break;

  case 'classification':
   

    $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $vehicles = getVehiclesByClassification($classificationName);

    if(!count($vehicles)){
      $message = "<p class='notice'>Sorry, no $classificationName</p>";

    } else {
      $vehicleDisplay = buildVehiclesDisplay($vehicles);
    }

    //echo $vehicleDisplay;
    //exit;
    
    include '../view/classification.php';
  break;

  case 'carInfo':
  $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
  $vehicleInfo = getVehiclesById($invId);

  if(!count($vehicleInfo)){
  $message = "<p class='notice'>Sorry, no $classificationName</p>";
  }else{
  $vehicleInfoDisplay = buildVehicleDisplay($vehicleInfo);
  }

  //print_r($vehicleInfo);


  break;


  default:
   checkUserLog();

      $classificationList = buildClassificationList($classifications);

      include '../view/vehicle-management.php';
     break;
   }
   


?>