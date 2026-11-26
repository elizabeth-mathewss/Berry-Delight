<?php
$server="localhost";
$user="root";
$password="";
$DB="db_miniproject";
$Con=mysqli_connect($server,$user,$password,$DB);
if(!$Con)
{
	echo "connection failed";
}
?>