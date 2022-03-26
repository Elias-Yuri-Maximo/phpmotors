<?php
function searchInDB($searchString){
    //$searchString2 = $searchString;
    //$searchString3 = $searchString;
    $searchString = "%".$searchString."%";


    $db = phpmotorsConnect();
    $sql = "SELECT inventory.invId, inventory.invMake, inventory.invModel, inventory.invDescription, inventory.invColor, images.imgPath 
    FROM inventory 
    JOIN images 
    ON inventory.invId = images.invId
    WHERE 
    ((imgName LIKE '%-tn%') AND (imgPrimary = 1)) 
    AND ((invMake LIKE :searchString) OR (invColor LIKE :searchString) OR (invModel LIKE :searchString) OR (invDescription LIKE :searchString))
    ;";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':searchString', $searchString, PDO::PARAM_STR);
  
    //$stmt->bindValue(':searchString2', $searchString2, PDO::PARAM_STR);
    //$stmt->bindValue(':searchString3', $searchString3, PDO::PARAM_STR);
    $stmt->execute();
    $responseArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $responseArray;

}




?>