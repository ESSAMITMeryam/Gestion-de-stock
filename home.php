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
        .nav-bar {
            height: 100%;
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: black;
            padding-top: 17%;
            border: 2px solid grey;
            text-align: left;

        }
        .nav-bar a{
            text-decoration: none;
            color: white;
        }

        
        .container {
            text-align: center;
            background-color: blanchedalmond;
            width: 100%;
            height: 100vh;

        }

        .container h1 {
            padding-top: 25%;
            padding-left: 15%;
        }

        /*.product-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            grid-gap: 20px;
        }
        .product-item {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .product-item img {
            max-width: 100%;
            height: auto;
        }
        .product-item h3 {
            margin-top: 10px;
        }*/

        .logout {
            background-color: blanchedalmond;
            position: fixed;
            top: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <div class="nav-bar">
        <ul>
            <li><a href="ajout.php">Ajouter un produit</a></li><br><br>
            <li><a href="rechercher.php">Rechercher un produit</a></li><br><br>
            <li><a href="modifier.php">Modifier un produit</a></li><br><br>
            <li><a href="supprimer.php">Supprimer un produit</a></li><br><br>
            <li><a href="lister.php">Lister tous les produits</a></li><br><br>
        </ul>
    </div>
    <div class="container">
        <h1>Welcome to IMS</h1>
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