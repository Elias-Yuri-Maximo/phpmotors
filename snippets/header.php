<img src="/phpmotors/images/site/logo.png" alt="PHP motors logo">



<div class="links">
<?php
if(isset($_SESSION['clientData'])){
    echo '<a class="log" href="/phpmotors/accounts/">Welcome ' . $_SESSION['clientData']['clientFirstname']." </a>";
}
?>
<br>
<?php
if (isset($_SESSION['clientData'])){
    echo'<a class="log" href="/phpmotors/accounts/index.php?action=Logout">Logout</a>';
}else{
    echo'<a class="log" href="/phpmotors/accounts/index.php?action=login">My Account</a>';
}
?>

<a class="searchPage" href="/phpmotors/search/index.php?action=searchPage">&#128269;</a>
  
</div>