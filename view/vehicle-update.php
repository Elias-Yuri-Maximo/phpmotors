<?php
//print_r($classifications) ;
//Creates the dropdown list
$dropList = '<select required id="classification" name="classificationId">';
//print_r( $invInfo);

foreach ($classifications as $classification){
    //echo '<br>';
    //print_r($classification);
$dropList .="<option value='$classification[classificationId]'";

//echo $invInfo['classificationId'];
//echo $classificationId.'\n';
if(isset($classificationId)){
    //echo $classification['classificationId'].'/n';
 //echo $classificationId;
   //echo $invInfo;
    if(strval($classification['classificationId']) === strval($classificationId)){
            $dropList .= ' selected ';

    }       
}elseif(isset($invInfo['classificationId'])){
       
        if(strval($classification['classificationId']) === strval($invInfo['classificationId'])){
         $dropList .= ' selected ';
        }
}


$dropList .= ">$classification[classificationName]</option>";
}
$dropList.='</select>';

?><!DOCTYPE html>
<html lang="en-us">
<head>
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP Motors</title>

    <meta charset="UTF-8">

    <link rel="stylesheet" type="text/css" href="/phpmotors/css/small.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/medium.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/phpmotors/css/large.css" media="screen" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script defer src="../phpmotors/js/nav-bar.js"></script>
</head>
<body>
    <main>
    <header>
        <!--img src="images/site/logo.png" alt="PHP motors logo">
        <button>My Account</button-->
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php';?>


    </header>
    <nav >
        <!--ul>
            <li>Home</li>
            <li>Classic</li>
            <li>Sports</li>
            <li>SUV</li>
            <li>Truck</li>
            <li>Used</li>
        </ul-->
            <!--?//php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/nav.php';?-->
        <?php echo $navList; ?>
    </nav>
    <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
        elseif(isset($invMake) && isset($invModel)) { 
	echo "Modify$invMake $invModel"; }?></h1>

    <p>*Note all fields are required</p>

    <?php
        //isset() checks if the variable message exists, 
        //If it does, it returns TRUE.
        if (isset($message)) {
            echo $message;
        }
    ?>
    <form action="/phpmotors/vehicles/index.php" method="post">
        <label for="classification">
        <?php echo $dropList; ?>
        </label>
        <br>
        <br>

        <label for="make">Make:<br>
        <input type="text" <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?> id="make" name="invMake" required></label><br>
        
        <label for="model">Model:<br>
        <input type="text" <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?> id="model" name="invModel" required><br></label>

        <label for="description">Description:<br>
        <textarea  id="description" name="invDescription" required><?php if(isset($invDescription)){echo "$invDescription";}elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }  ?> </textarea></label>

        <br>
        <label for="imagePath">Image Path:<br>
        <input type="text" <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }  ?> id="imagePath" name="invImage" required><br></label>

        <label for="thumbnailPath">Thumbnail Path:<br>
        <input type="text" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }  ?>id="thumbnailPath" name="invThumbnail" required><br></label>

        <label for="price">Price:<br>
        <input type="number"<?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }  ?> id="price" name="invPrice" required><br></label>

        <label for="inStock">How Many in Stock:<br>
        <input type="number"<?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }  ?> id="inStock" name="invStock" required><br></label>

        <label for="color">Color:<br>
        <input type="text" <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }  ?> id="color" name="invColor" required><br></label>




        
    
        <input type="submit" name="submit" value="Update Vehicle">
        <input type="hidden" name="action" value="updateVehicle">
        <input type="hidden" name="invId" value="
        <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
        elseif(isset($invId)){ echo $invId; } ?>
        ">
        <br>
        <br>

        
    </form>
    <footer>
    <!--p>&copy; PHP Motors, All rights reserved. All Images used are believed
         to be in "Fair Use". Please notify the author if any are not and 
         they will be removed.</p-->
         <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </footer>
    </main>

</body>
</html>