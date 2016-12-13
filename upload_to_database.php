<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
try {

	$servername = "localhost";
	$username = "SachinK";
	$password = "";
	$dbname   = "Trump_Quotes";
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	$conn = new PDO("mysql:host=$servername;dbname=$dbname;", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



	$file = fopen("quotes.txt", "r") or die("Unable to open file!");
	$file_read = fread($file,filesize("quotes.txt"));
	fclose($file);
	$array = explode("\n", $file_read);

	foreach($array as $val) {
	    
	    //Add product into database
	    $sql = $conn->prepare("INSERT INTO 'Quotes' (quotes) VALUES(':val')");
	    $sql->bindParam(':val', $val);


	}

}catch(PDOException $e) {
	echo "Error: " . $e -> getMessage();
}




?>