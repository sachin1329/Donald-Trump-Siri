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
			
			$UserArray = array();
			$explodeKey = array();
			$Key = array();
			
			//Create connection
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$sqlread = "SELECT * FROM MHacks8DB.quotes where Candidate='Trump' ORDER BY RAND()";/*Declares varible sqlread as blank*/
			$stmt = $conn->prepare($sqlread); /*secures sql command*/
			$stmt->execute();/*execute sql command*/
			
			$phraseCount = $stmt->rowCount();
			$oldCounter = 0;
			$newCounter = 0;
			
$val = $_POST["input"];
//echo $val;
$result = "";	
$hasMatch = False;		
    if($phraseCount > 0)
	{
        while($row = $stmt->fetch()) 
		{
            $phrase = $row["Quote"];
            $key = $row["Key"];

            $explodeKey = explode(",", $key);
			$UserArray = explode(" ",$val);
            for ($i=0; $i < count($UserArray); $i++) 
			{
				for($x=0;$x<count($explodeKey);$x++)
				{
					if(in_array($UserArray[$i],$explodeKey))
					{
						$oldCounter++;
						if($oldCounter>$newCounter) {
							$newCounter = $oldCounter;
							$result = $row['Quote']." \n ";
							$hasMatch = True;
							//echo $result . "\n";
						}
					}
					elseif($hasMatch == False) {
						$result = "Do you mind if I sit back a little? Because your breath is very bad";
					}
				}
				
				
			$oldCounter = 0;
			}
		}
			//explode(" ",$_POST['input']);
			explode (",",$row["Key"]);
			
			//echo pickPhrase("Are you a drug dealers?");
			//echo $result;
			
			$DataArray = array();
			$row = $stmt->fetch();
			
			array_push($DataArray,($row['pictures']!='')?"data:image/jpeg;base64,".base64_encode($row['pictures']):"Trump.jpg");
			array_push ($DataArray,$result);
			echo json_encode($DataArray);
			$conn=null; //ends connection
			
	}
		}
        catch(PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
$myArray = array( "","","other","","other" );
$length  = count( array_keys( $myArray, "" ));
//echo $length;
?>