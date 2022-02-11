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
    <h1>Sign in</h1>


    <?php
        //isset() checks if the variable message exists, 
        //If it does, it returns TRUE.
        if (isset($message)) {
            echo $message;
        }
    ?>



    <form action="/phpmotors/accounts/index.php" method="post">
        
        <label for="fName">First Name:<br>
        <input type="text" id="fName" name="clientFirstname"></label><br>
        
        <label for="lName">Last Name<br>
        <input type="text" id="lName" name="clientLastname"><br></label>

        <label for="email">E-mail<br>
        <input type="email" id="email" name="clientEmail"></label>

        <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</p>

        <label for="password">Password<br>
        <input type="password" id="password" name="clientPassword"><br></label>
        
        <button>Show Password</button>
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