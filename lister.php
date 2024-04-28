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
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: blanchedalmond;
        }

        table {
            width: 50%; 
            border-collapse: collapse;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
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
        <form action="lister.php" method="post">
            <input type="submit" value="Lister" name="lister"><br><br>
            <input type="submit" value="Trier par ID" name="trier_id"><br><br>
            <input type="submit" value="Trier par prix" name="trier_prix"><br><br>
            <input type="submit" value="Trier par quantite" name="trier_quantite">
        </form>
        <?php
            include("connect.php");
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset( $_POST["lister"])) {  
                $sql = "SELECT * FROM stock";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    
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
                    
                } else {
                     echo "Aucun produit trouvé.";
                }
            }

            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["trier_id"])){
                $sql = "SELECT * FROM stock order by id_produit DESC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    
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
                    
                } else {
                     echo "Aucun produit trouvé.";
                }
            }

            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["trier_prix"])){
                $sql = "SELECT * FROM stock order by prod_prix DESC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    
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
                    
                } else {
                     echo "Aucun produit trouvé.";
                }
            }

            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["trier_quantite"])){
                $sql = "SELECT * FROM stock order by prod_quantite DESC";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    
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
                    
                } else {
                     echo "Aucun produit trouvé.";
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
