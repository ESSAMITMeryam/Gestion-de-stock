<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_name = "1a_insea";
    $db_password = "";
    //$conn = "";


    

    try{
        $conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);
    }
    catch(mysqli_sql_exception){
        echo "T'as pas pu vous connecter!!";
        die();
    }

?>