<?php
    include("nav.html");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <style>
        * {
            margin: 0;
            
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            background-color: blanchedalmond;
            padding-left: 9%;
            overflow: auto;
            
        }

        .container form {
            padding-top: 25%;
            padding-bottom: 10px;
        }
        
        table { 
            border-collapse: collapse;
            overflow: auto;
        }

        tr, th, td {
            border: 2px solid black;
        }

        


        .logout {
            background-color: blanchedalmond;
            position: fixed;
            top: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="rechercher.php" method="post">
            
            <input type="text" name="id_rechercher" placeholder="ID a rechercher" id="rechercher">
            <input type="submit" value="Rechercher" name="rechercher">
            
        </form>
        <?php

    include("connect.php");
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rechercher'])){
        $id_rechercher = $_POST["id_rechercher"];
        $sql = "Select * from stock where id_produit=?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            
            mysqli_stmt_bind_param($stmt, "i", $id_rechercher);

            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    echo "<div class=\"container\">";
                    echo "<table>";
                    echo "<tr><th>ID Produit</th> <th>Code</th> <th>Désignation</th> <th>Prix</th> <th>Marge</th> <th>Quantité</th> <th>Seuil</th> <th>ID Fournisseur</th> </tr>";
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['id_produit']."</td>";
                        echo "<td>".$row['prod_code']."</td>";
                        echo "<td>".$row['prod_designation']."</td>";
                        echo "<td>".$row['prod_prix']."</td>";
                        echo "<td>".$row['prod_marge']."</td>";
                        echo "<td>".$row['prod_quantite']."</td>";
                        echo "<td>".$row['prod_seuil']."</td>";
                        echo "<td>".$row['id_fournisseur']."</td>";
                        
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "</div>";
                }
        }
    }


?>
    </div>
    <div class="logout">
        <form action="home.php" method="post">
            <input type="submit" name="logout" value="Logout">
        </form>
    </div>
</body>
</html>




<?php
    if(isset( $_POST['logout']) && $_SERVER["REQUEST_METHOD"] == "POST"){
        header("Location: login.php");
    }
?>