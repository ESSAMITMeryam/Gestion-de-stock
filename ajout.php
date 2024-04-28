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
            height: 100vh;
            background-color: blanchedalmond;
        }

        .container , .container_text {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .container_text {
            padding-top: 20px;
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
<body>
    <div class="container">
        <form action="ajout.php" method="post">


            
            <input type="text" name="prod_code" placeholder="Code du produit"><br><br>
            <input type="text" name="prod_designation" placeholder="Designation du produit"><br><br>
            <input type="number" name="prod_prix" placeholder="Prix du produit"><br><br>
            <input type="text" name="prod_marge" placeholder="Marge du produit"><br><br>
            <input type="number" name="prod_quantite" placeholder="Quantite du produit"><br><br>
            <input type="text" name="prod_seuil" placeholder="Seuil du produit"><br><br>
            <?php
                include("connect.php");

                $sql2 = "select * from fournisseur";
                $result = mysqli_query($conn, $sql2);

                echo ' <select name = "fournisseur">';
                echo "<option value=''> ---Choisir fournisseur ---</option>";
                
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option value=".$row["id_four"].">".$row["id_four"]." ".$row["responsable"]."</option>";
                    }
                    echo "</select>";
                ?>
                <br><br>


            <input type="submit" value="Ajouter" name="ajouter">
        </form>
        <?php

            include("connect.php");

            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajouter'])) {
                
                $prod_code = $_POST["prod_code"];
                $prod_designation = $_POST["prod_designation"]; 
                $prod_prix = $_POST["prod_prix"]; 
                $prod_marge = $_POST["prod_marge"];     
                $prod_quantite = $_POST["prod_quantite"]; 
                $prod_seuil = $_POST["prod_seuil"];   
                $id_four = $_POST["fournisseur"];
            
                if(!empty($prod_code)  && !empty($prod_designation) && !empty($prod_prix) && !empty($prod_marge) && !empty($prod_quantite) && !empty($prod_seuil) && !empty($id_four)){
                    $sql = "INSERT INTO stock (prod_code, prod_designation, prod_prix, prod_marge, prod_quantite, prod_seuil, id_fournisseur) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
        
                    $stmt->bind_param("ssssiii", $prod_code, $prod_designation, $prod_prix, $prod_marge, $prod_quantite, $prod_seuil, $id_four);
                
                
                    if ($stmt->execute()) {
                        echo "<div class=\"container_text\">";
                        echo "Le produit a ete ajouter avec succes";
                        echo "</div>";
                    }else {
                        echo "<div class=\"container_text\">";
                        echo "Erreur lors d'ajout du produit!";
                        echo "</div>";
                    }
                }
                //$stmt->close();
            }
        
            //$conn->close();
            
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