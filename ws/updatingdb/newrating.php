<?php
// Declaration des variables de connection a la base des donnees
$server="localhost"; // Le server ou on va se connecter
$conectname="root"; // nom d'access au serveur
$monpass=""; //Le mot de passe
$mabd="mobidatabase"; // Le nom de la base des donnees

// ici on se connecte au serveur avec les parametres de connection ci-haut
$iconect=mysql_connect($server,$conectname,$monpass) or die('Connexion a la base des donnees impossible');
// Selection de la base des donnees 
mysql_select_db($mabd,$iconect) or die ('Impossible de se connecter a la base des donnees');
?>

<?php

/*
 * Following code will create a new comment row
 * All comments details are read from HTTP Post Request
 */

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['ratingid']) && isset($_POST['userid']) && isset($_POST['pointofinterestid'])
        && isset($_POST['idsite']) && isset($_POST['rating']) && isset($_POST['date'])) {
    
    $ratingid = $_POST['ratingid'];
    $userid = $_POST['userid'];
    $pointofinterestid = $_POST['pointofinterestid'];
    $idsite = $_POST['idsite'];
    $rating = $_POST['rating'];
    $date = $_POST['date'];


    // mysql inserting a new row
    $result = mysql_query("INSERT INTO comments(ratingid, userid, pointofinterestid, idsite, rating, date)
        VALUES('$ratingid', '$userid', '$pointofinterestid', '$idsite', '$rating', '$date')");

    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Rate successfully created.";

        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
        
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
mysql_close();
?>