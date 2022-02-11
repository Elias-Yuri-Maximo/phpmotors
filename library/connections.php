<?php 
/*Proxy connction to php motors Database */
function phpmotorsConnect(){

/*
$server='192.168.15.16';
$username='elias';
$password='senha';

*/
$server='localhost';
$username='client';
$password='senha';

$dbname='phpmotors';
$dsn = "mysql:host=$server;dbname=$dbname";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try{
    $link= new PDO($dsn, $username, $password, $options);
    if(is_object($link)){
        //echo 'It Worked';
    
    return $link;
    }
}catch(PDOException $e){
//echo "It didn't work, error:" . $e->getMessage();
header('Location: /phpmotors/error-message.php');
exit;
}
}

phpmotorsConnect();
?>
