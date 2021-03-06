<!DOCTYPE html>
<html lang="en-us">
<head>
    <title>Search | PHP Motors</title>

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
    <h1>Search</h1>

    <?php
        //isset() checks if the variable message exists, 
        //If it does, it returns TRUE.
        if (isset($message)) {
            echo $message;
        }
    ?>

    <form action="/phpmotors/search/index.php" method="post">
        
        <label for="searchString">What are you looking for today?<br>
        <input type="text" id="searchString" name="searchString" <?php if(isset($searchString)){echo "value='$searchString '";}  ?> required></label>

        <input type="submit" name="submit" value="search">
        <input type="hidden" name="action" value="search">
    </form>

    <?php
    if(isset($totalResults)){ echo'<h2>'.$totalResults.' results returned for search '.$searchString.'</h2>';}
    ?>

    <?php
    if(isset($htmlResults)){  echo $htmlResults;  }
    ?>

    <?php
    if(isset($pageMenu)){echo $pageMenu;}
    ?>

    <footer>
    <!--p>&copy; PHP Motors, All rights reserved. All Images used are believed
         to be in "Fair Use". Please notify the author if any are not and 
         they will be removed.</p-->
         <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </footer>
    </main>

</body>
</html>