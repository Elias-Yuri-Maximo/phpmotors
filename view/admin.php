<?php
if ($_SESSION['loggedin']==FALSE){
    header('../view/login.php');
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
    <div class="vehicles-content">
    <?php
    echo '<h1>'.$_SESSION['clientData']['clientFirstname'].' '.$_SESSION['clientData']['clientLastname'].'</h1>';

    //later check if session message worked
   if (isset($SESSION['message'])){
       echo 'message';
   }elseif(isset($message)){
       echo '<p>'.$message.'</p>';
   }

    $userInfoUl = '<p> You are logged in right now</p>';
    $userInfoUl .= '<ul>';
    $userInfoUl .='<li>First Name:'.$_SESSION['clientData']['clientFirstname'].'</li>';
    $userInfoUl .='<li>Last Name:'.$_SESSION['clientData']['clientLastname'].'</li>';
    $userInfoUl .='<li>E-mail:'.$_SESSION['clientData']['clientEmail'].'</li>';
    $userInfoUl .='</ul>';
    echo $userInfoUl;

    if(intval($_SESSION['clientData']['clientLevel']) > 1 ){
        echo '
        <h2>Inventory Management</h2>
        <p>Use this link to manage inventory</p>
        <p><a href="/phpmotors/vehicles/">Vehicle Administration</a></p>';
    }

    


    //print_r($_SESSION['clientData']);
    //echo "$_SESSION['clientData']['clientLevel']";
    ?>
    <h2>Account Management</h2>
    <p>Use this link to update your account information</p>
    <p><a href="/phpmotors/accounts/?action=modUser">Update Acoount information</a></p>
    </div>
    <footer>
    <!--p>&copy; PHP Motors, All rights reserved. All Images used are believed
         to be in "Fair Use". Please notify the author if any are not and 
         they will be removed.</p-->
         <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php';?>
    </footer>
    </main>

</body>
</html>