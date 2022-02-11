<!DOCTYPE html>
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
    <h1>Add Vehicle</h1>
    <p>*Note all fields are required</p>
    <form action="/phpmotors/accounts/index.php" method="post">
    <form action="/phpmotors/accounts/index.php" method="post">
        <?php echo $dropList; ?>
        <br>
        <br>

        <label for="make">Make:<br>
        <input type="text" id="make" name="invMake"></label><br>
        
        <label for="model">Model:<br>
        <input type="text" id="model" name="invModel"><br></label>

        <label for="description">Description:<br>
        <textarea id="description" name="invDescription"></textarea></label>

        <br>
        <label for="imagePath">Image Path:<br>
        <input type="text" id="imagePath" name="invImage"><br></label>

        <label for="thumbnailPath">Thumbnail Path:<br>
        <input type="text" id="thumbnailPath" name="invThumbnail"><br></label>

        <label for="price">Price:<br>
        <input type="number" id="price" name="invPrice"><br></label>

        <label for="inStock">How Many in Stock:<br>
        <input type="number" id="inStock" name="invStock"><br></label>

        <label for="color">Color:<br>
        <input type="number" id="color" name="invColor"><br></label>




        
    
        <input type="submit" name="submit" id="regbtn" value="register">
        <input type="hidden" name="action" value="register">
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