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
    <div class="logout">
        <form action="home.php" method="post">
            <input type="submit" name="logout" value="Logout">
        </form>
        
    </div>
    
    <div class="container">
        <form action="supprimer.php" method="post">
            <input type="text" name="id_prod" placeholder="ID du produit">
            <input type="submit" value="Supprimer" name="supprimer">
        </form>
        
        <?php
    
        include("connect.php");
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["supprimer"])) {
            $id_prod = $_POST['id_prod'];
            $check_sql = "SELECT id_produit FROM stock WHERE id_produit = ?";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bind_param("i", $id_prod);
            $check_stmt->execute();
            $check_stmt->store_result();
            
            if ($check_stmt->num_rows > 0) {
                $sql = "DELETE FROM stock WHERE id_produit = ?";
                $stmt = $conn->prepare($sql);

                $stmt->bind_param("i", $id_prod);

                if ($stmt->execute()) {
                    echo "<div class=\"container_text\">";
                    echo "Le produit a ete supprimer avec succes";
                    echo "</div>";
                } else {
                    echo "<div class=\"container_text\">";
                    echo "Erreur lors du suppression du produit!";
                    echo "</div>";
                }

                //$stmt->close();
            }else {
                echo "<div class=\"container_text\">";
                echo "L'ID du produit n'existe pas!";
                echo "</div>";
            }
        }

        //$conn->close();
    
    
?>
    </div>
</body>
</html>




<?php
    if(isset( $_POST['logout']) && $_SERVER["REQUEST_METHOD"] == "POST"){
        header("Location: login.php");
    }
?>