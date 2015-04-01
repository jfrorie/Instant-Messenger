<?php
$server = 'localhost';
$username   = 'root';
$password   = 'EiKah8ie';
$database   = 'accounts';
 
if(!mysql_connect($server, $username,  $password))
{
        die('Could not establish database connection: ' . mysql_error());
}
if(!mysql_select_db($database))
{
        die('Could select the database: ' . mysql_error());
}
?>

