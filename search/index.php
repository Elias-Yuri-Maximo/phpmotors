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
//Gets the uploads-model
require_once '../model/uploads-model.php';
//Gets the search model
require_once '../model/search-model.php';


// Create or access a Session
session_start();


//This creates the NAV list 
$classifications = getClassifications();
$navList = renderNavBar($classifications);


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}




switch ($action){
      //////////////////////////////////////////////////////////////////////////////////
  //FINAL PROJECT
  //////////////////////////////////////////////////////////////////////////////////
  
  case 'searchPage':
    // Goes to the search page 
    include '../view/search-view.php';
  
    break;
  
  
  
  
    case 'search';
    //Treates the information from the search form 
    $searchString = trim(filter_input(INPUT_POST, 'searchString', FILTER_UNSAFE_RAW));
  
    
    if(empty($searchString)){
      $message = '<p>Please fill the search field.</p>';
      include '../view/search-view.php';
      exit; 
    }
  
   
    //Checks if the user is searching for anything but aphanum characters
    //If they are, returns only a string
    if ( ctype_alnum($searchString) == false){
    //If non alphanumeric charcters
    $message = '<p>Please fill the search field with only numbers or letters.</p>';
    $searchString = preg_replace("/[^A-Za-z0-9 ]/", '', $searchString);
    include '../view/search-view.php';
    exit;
    }
  
    //Looks for the searchStign in the database
    //Function is in the model
    $responseArray = searchInDB($searchString);
    //Gets the total amount of results 
    $totalResults = count($responseArray);
    //Inside of parsed responses there are arrays of 10 cars at a time
    
    $parsedResponses = breakArrayIntoTens($responseArray);
    //$GLOBALS['parsedResponses'] = $parsedResponses;
    //foreach($parsedResponses as $simpleArray){
    // echo "<hr>";
    //  print_r($simpleArray);
    //}
    $currentPageIndex = 0;
    //$GLOBALS['currentPageIndex'] = $currentPageIndex;
    

    $htmlResults = renderResults($parsedResponses[$currentPageIndex]);
    
    $pageMenu = renderPageMenu($searchString, $parsedResponses,$currentPageIndex);
    
    include '../view/search-view.php';
  
    break;


    case 'nextPage';
    // plus 1 to the currentPageIndex, load new page, render new menu
    //$parsedResponses = $GLOBALS['parsedResponses'];
    //$currentPageIndex = $GLOBALS['currentPageIndex'];
    $currentPageIndex = filter_input(INPUT_POST, 'page');
    if ($currentPageIndex == NULL){
    $currentPageIndex = filter_input(INPUT_GET, 'page');
    }

    $searchString = filter_input(INPUT_POST, 'search');
    if ($searchString == NULL){
    $searchString = filter_input(INPUT_GET, 'search');
    }
   

    $responseArray = searchInDB($searchString);
    $totalResults = count($responseArray);
    $parsedResponses = breakArrayIntoTens($responseArray);

    $htmlResults = renderResults($parsedResponses[$currentPageIndex]);
    
    $pageMenu = renderPageMenu($searchString, $parsedResponses,$currentPageIndex);

    

    //$htmlResults = renderResults($parsedResponses[$currentPageIndex]);
    //$pageMenu = renderPageMenu($parsedResponses,$currentPageIndex);
    echo $currentPageIndex;
    
    include '../view/search-view.php';
    break;

    case 'previousPage';
    // minus 1 to the currentIndex, load new page, render new menu
    $currentPageIndex = filter_input(INPUT_POST, 'page');
    if ($currentPageIndex == NULL){
    $currentPageIndex = filter_input(INPUT_GET, 'page');
    }

    $searchString = filter_input(INPUT_POST, 'search');
    if ($searchString == NULL){
    $searchString = filter_input(INPUT_GET, 'search');
    }


    $responseArray = searchInDB($searchString);
    $totalResults = count($responseArray);
    $parsedResponses = breakArrayIntoTens($responseArray);

    $htmlResults = renderResults($parsedResponses[$currentPageIndex]);
    
    $pageMenu = renderPageMenu($searchString, $parsedResponses,$currentPageIndex);;
    
    include '../view/search-view.php';
    break;


    default:

    break;
  }
?>