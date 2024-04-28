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

        .container, .container_text {
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
</head>
<body>
    <div class="container">
        <form action="modifier.php" method="post">
            <input type="text" name="id_produit" placeholder="ID du produit à modifier"><br><br>
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


            <input type="submit" value="Modifier" name="modifier">
        </form>
        <?php
        
        
            include("connect.php");

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modifier"])) {
                
                $id_produit = $_POST["id_produit"];
                $existing_values_sql = "SELECT prod_code, prod_designation, prod_prix, prod_marge, prod_quantite, prod_seuil, id_fournisseur FROM stock WHERE id_produit = ?";
                $existing_values_stmt = $conn->prepare($existing_values_sql);
                $existing_values_stmt->bind_param("i", $id_produit);
                $existing_values_stmt->execute();
                $existing_values_result = $existing_values_stmt->get_result();
                $existing_values_row = $existing_values_result->fetch_assoc();

                
                $prod_code = $_POST["prod_code"] != '' ? $_POST["prod_code"] : $existing_values_row['prod_code'];
                $prod_designation = $_POST["prod_designation"] != '' ? $_POST["prod_designation"] : $existing_values_row['prod_designation'];
                $prod_prix = $_POST["prod_prix"] != '' ? $_POST["prod_prix"] : $existing_values_row['prod_prix'];
                $prod_marge = $_POST["prod_marge"] != '' ? $_POST["prod_marge"] : $existing_values_row['prod_marge'];
                $prod_quantite = $_POST["prod_quantite"] != '' ? $_POST["prod_quantite"] : $existing_values_row['prod_quantite'];
                $prod_seuil = $_POST["prod_seuil"] != '' ? $_POST["prod_seuil"] : $existing_values_row['prod_seuil'];
                $id_four = $_POST["fournisseur"] != '' ? $_POST["fournisseur"] : $existing_values_row['id_fournisseur'];

                
                $sql = "UPDATE stock SET prod_code = ?, prod_designation = ?, prod_prix = ?, prod_marge = ?, prod_quantite = ?, prod_seuil = ?, id_fournisseur = ? WHERE id_produit = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiiiiii", $prod_code, $prod_designation, $prod_prix, $prod_marge, $prod_quantite, $prod_seuil, $id_four, $id_produit);
                
                if ($stmt->execute()) {
                    header("Location: lister.php");
                } else {
                    echo "<div class=\"container_text\">";
                    echo "Une erreur s'est produite lors de la modification du produit.";
                    echo "</div>";
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
                
          

