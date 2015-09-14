<?php
/*
 * this code will help us to retrieve all city by zone
 * villes par zone geographique 
 */
//Create an array for the JSON response 
$jsonResponse=array();
//Insert the database connection class
require_once __DIR__.'/db_connect.php';

//on check le type de methode utilisee
if(isset($_GET["idzone"])){
    $idzone=$_GET['idzone'];
    //instruction sql to retrieve data by id
    $result= mysql_query("SELECT * FROM city WHERE idzone=$idzone")or die (mysql_error());
    //test le resultat de la requete
    if(!empty($result)){
        
        if(mysql_num_rows($result)>0){
            //Noeud de l'utilisateur
            $jsonResponse["thecity"]=array();
            //Boucle l'array			
            while($row=  mysql_fetch_array($result)){
                $thecity=array();
                $thecity["idcity"]=$row["idcity"];
                $thecity["idzone"]=$row["idzone"];
                $thecity["namecity"]=$row["namecity"];
                $thecity["desccity"]=$row["desccity"];
                $thecity["latcity"]=$row["latcity"];
                $thecity["lngcity"]=$row["lngcity"];
                $thecity["altcity"]=$row["altcity"];
                $thecity["cityurlimage"]=$row["cityurlimage"];
                //push single question into final response array
                array_push($jsonResponse["thecity"], $thecity); //ceci affiche avec le nom thecity dans le json
               // array_push($jsonResponse, $thecity);
            }
            //succes 
            $jsonResponse["success"]=1;
            
            //JSON response dans un echo (affichage de la reponse JSON)
            echo json_encode($jsonResponse);
        }
        else {
            //dans le cas ou il n'y a aucun produit
            $jsonResponse["success"]=0;
            $jsonResponse["message"]="No Town found for this geozone Id !";
            //On affiche la reponse JSON dans un echo
            echo json_encode($jsonResponse);
        }
    }
    
}

?>
