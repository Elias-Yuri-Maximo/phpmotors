<?php 
if ($_SESSION['loggedin']==FALSE){
    header('../view/login.php');
}?><!DOCTYPE html>
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

<?php 
print_r($_SESSION)?>

    <h1>Manage Account</h1>
    <h2>Update Account</h2>

    <form action="/phpmotors/accounts/index.php" method="post">
        <?php
        //MESSAGE BLOCK
                if (isset($message)) {
                    echo $message;
                }
        ?>
        <label for="fName">First Name:<br>
        <input <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}elseif(isset($_SESSION['clientData']['clientFirstname'])){echo "value=".$_SESSION['clientData']['clientFirstname'].""; }  ?> type="text" id="fName" name="clientFirstname" required></label><br>
        
        <label for="lName">Last Name<br>
        <input <?php if(isset($clientLastname)){echo "value='$clientLastname'";}elseif(isset($_SESSION['clientData']['clientLastname'])){echo "value=".$_SESSION['clientData']['clientLastname'].""; }  ?> type="text" id="lName" name="clientLastname" required><br></label>

        <label for="email">E-mail<br>
        <input <?php if(isset($clientEmail)){echo "value='$clientEmail'";}elseif(isset($_SESSION['clientData']['clientEmail'])){echo "value=".$_SESSION['clientData']['clientEmail'].""; }  ?> type="email" id="email" name="clientEmail" required></label>
        <br>
        
        
    
        <input type="submit" name="submit" value="Update User Info">
        <input type="hidden" name="action" value="updateUser">
        <input type="hidden" name="clientId" value="
        <?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} 
         ?>
        ">


        <h2>Update Password</h2>
        
        <?php
        //MESSAGE BLOCK
                if (isset($message)) {
                    echo $message;
                }
        ?>

        <form action="/phpmotors/accounts/index.php" method="post">
        <p>The password inserted here will be altered in our recods, it is not possible to recover the old one</p>
        <br><span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>

        <label for="password">Password<br>
        <input pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" type="password" id="password" name="clientPassword" ><br></label>
                
        <input type="submit" name="submit" value="Update Password">
        <input type="hidden" name="action" value="updatePassword">
        <input type="hidden" name="clientId" value="
        <?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} 
         ?>
        ">
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