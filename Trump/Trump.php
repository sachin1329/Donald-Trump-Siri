<?php
		
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        try
        {
			$servername = "localhost";
			$username = "MHacks8User";
			$password = "mHacks8";
			$dbname = "MHacks8DB";
			header("Access-Control-Allow-Origin: *");
			header("Content-Type: application/json; charset=UTF-8");

			//Create connection
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sqlread = "SELECT * FROM MHacks8DB.quotes where Candidate=:can ORDER BY RAND()";/*Declares varible sqlread as blank*/
			$stmt = $conn->prepare($sqlread); /*secures sql command*/
			$stmt->bindParam(':can', $_POST["Candidate"]);
			$stmt->execute();/*execute sql command*/
			
			$DataArray = array();
			$row = $stmt->fetch();
			
			array_push($DataArray,($row['pictures']!='')?"data:image/jpeg;base64,".base64_encode($row['pictures']):$_POST["Candidate"].".jpg");
			array_push ($DataArray,$row["Quote"]);
			echo json_encode($DataArray);
			$conn=null; //ends connection
        }
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
		
?>