<?php

$db_host = "localhost";
$db_username = "SachinK";
$db_pass = "";
$db_name = "Trump_Quotes";

$conn = new mysqli("$db_host", "$db_username", "$db_pass", "$db_name") or die("There is nothing to see here");
//mysql_select_db("$db_name")or die("there is no database with this name");

?>