<?php
if($_SESSION['clientData']['clientLevel'] < 2){
 header('location: /phpmotors/');
 exit;
}
?><!DOCTYPE html>

<html lang="en-us">
<head>
    <title><?php if(isset($invInfo['invMake'])){ 
		echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>

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
    <h1><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";}?></h1>

    <p>*Confirm vehicle deletion. The delete is permanent.</p>

    <?php
        //isset() checks if the variable message exists, 
        //If it does, it returns TRUE.
        if (isset($message)) {
            echo $message;
        }
    ?>
    <form action="/phpmotors/vehicles/index.php" method="post">
    

        <label for="make">Make:<br>
        <input type="text" readonly <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?> id="make" name="invMake"></label><br>
        
        <label for="model">Model:<br>
        <input type="text" readonly <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?> id="model" name="invModel"><br></label>

        <label for="description">Description:<br>
        <textarea readonly id="description" name="invDescription"><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; } ?> </textarea></label>

    
        
        <input type="submit" name="submit" value="Delete Vehicle">
        <input type="hidden" name="action" value="deleteVehicle">
        <input type="hidden" name="invId" value="
        <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} ?>">
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