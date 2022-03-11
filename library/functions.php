<?php 
function checkEmail($clientEmail){
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
    echo $valEmail;
    }

// Check the password for a minimum of 8 characters,
 // at least one 1 capital letter, at least 1 number and
 // at least 1 special character
 function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
   }

   //Checks the classification Name
   //in order to check if classification Name has less than 30 characters
 function checkClassificationName($classificationName){
     $pattern = '/^.{1,30}$/';
     return preg_match($pattern, $classificationName);
 }

 function renderNavBar($classifications){
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/vehicles?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
 }

 function checkUserLog(){
     //Checks if the user is logged and has a high
     //enough level. 
     if($_SESSION['loggedin'] && intval($_SESSION['clientData']['clientLevel']) > 1 ){
        //print_r($_SESSION['clientData']['clientLevel']);
     }else{
        header('Location: /phpmotors/index.php');
         
     }

     //print_r($_SESSION['clientData']);
 }

 // Build the classifications select list 
function buildClassificationList($classifications){ 
   $classificationList = '<select name="classificationId" id="classificationList">'; 
   $classificationList .= "<option>Choose a Classification</option>"; 
   foreach ($classifications as $classification) { 
    $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
   } 
   $classificationList .= '</select>'; 
   return $classificationList; 
}

function buildVehiclesDisplay($vehicles){
   $dv = '<ul id="inv-display">';
   foreach ($vehicles as $vehicle) {
    $dv .= '<li>';
    $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
    $dv .= '<hr>';
    $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
    $dv .='<a href = "/phpmotors/vehicles/index.php?action=carInfo&invId='.urlencode($vehicle['invId']).'">More info on '.$vehicle['invMake'] .' '. $vehicle['invModel'].'</a>'; 
    $dv .= "<span>$vehicle[invPrice]</span>";
    $dv .= '</li>';
   }
   $dv .= '</ul>';
   return $dv;
  }


   
?>