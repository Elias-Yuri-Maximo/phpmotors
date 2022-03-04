<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}



?><!DOCTYPE html>
<html lang="en-us">
<head>
    <title>Template | PHP Motors</title>

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
    <h1>Vehicle Management</h1>
    <div class="vehicles-content">
    <a href="../vehicles/index.php?action=classification">Add Classification</a>
    <br>
    <a href="../vehicles/index.php?action=addVehicle">Add Vehicle</a>

    
    
    <?php
    if (isset($message)) { 
    echo $message; 
    } 
    if (isset($classificationList)) { 
    echo '<h2>Vehicles By Classification</h2>'; 
    echo '<p>Choose a classification to see those vehicles</p>'; 
    echo $classificationList; 
    }
    ?>

    <noscript>
    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
    </noscript>

    <table id="inventoryDisplay"></table>


    </div>
    <footer>
    <!--p>&copy; PHP Motors, All rights reserved. All Images used are believed
         to be in "Fair Use". Please notify the author if any are not and 
         they will be removed.</p-->
         <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </footer>
    </main>
<script src="../js/inventory.js"></script>
</body>
</html><?php unset($_SESSION['message']); ?>