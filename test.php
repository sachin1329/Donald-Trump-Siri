<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


try {

    $servername = "localhost";
    $username = "Mhacks8User";
    $password = "mHacks8";
    $dbname   = "MHacks8DB";
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

function pickPhrase($val) {
$sql=mysql_query("SELECT * FROM quotes");
$phraseCount = mysql_num_rows($sql);
$oldCounter = 0;
$newCounter = 0;
    if($phraseCount > 0) {
        while($row = mysql_fetch_array($sql)) {
            $phrase = $row["quote"]; 
            $key = $row["Key"];

            $explodeKey = explode(",", $key);

            for ($i=0; $i < count($explodeKey); $i++) { 
                if(strpos($val, $explodeKey[$i])) {
                    $oldCounter++;
                    if($oldCounter > $newCounter) {
                        $newCounter = $oldCounter;//resest the value newCounter;
                        $phraseToPick = $phrase; //picks phrase with the most amount of common keyterms
                    } //end old vs new counter;
               }//end finding keyterm in phrase
            }//end for loop
            if($oldCounter == 0) {
                return "You are too close, I can smell your dirty breath";
            }
            $oldCounter = 0;
        }
    }

    return $phraseToPick;
}
    

}catch(PDOException $e) {
    echo "Error: " . $e -> getMessage();
}
?>