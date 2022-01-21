<?php



$db = 'formdb';
$user = 'root';
$password = '';

$db = mysqli_connect('localhost', $user,$password, $db) or die("unable to connect");

if(!$db)
    echo 'Great work!!';

if(!mysqli_select_db($db,'formdb'))
    echo 'Database is not selected';    

?>