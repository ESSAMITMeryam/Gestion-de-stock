<?php
include("connectlogin.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <style>
        /** {
            margin: 0;
            
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: blanchedalmond;
            
        }

        form {
            border: 2px solid black;
            padding: 5%;
            border-radius: 20%;
            box-shadow: 4px 4px 4px 4px grey;
        }
        
        tr, th, td {
            border: 2px solid black;
        }*/
        /* Styles for login form */
        body {
            background-color: blanchedalmond;
        }

        .login-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            position: absolute;
            top: 30%;
            left: 43%;
        }
        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-form input[type="text"],
        .login-form input[type="password"],
        .login-form input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            
        }
        .login-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

    </style>
</head>
<body>
    <div class="login-form">
        <h2>LOGIN</h2>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <input type="text" name="username" placeholder="Username"><br><br>
            <input type="email" name="email" placeholder="Enter your email"><br><br>
            <input type="password" name="password" placeholder="Enter your password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+])[a-zA-Z\d!@#$%^&*()_+]{8,16}$" title="Password must contain at least one lowercase letter, one uppercase letter, one digit, one special character, and be between 8 and 16 characters long"><br><br>
            <input type="submit" name="login" value="Login">
        </form>
    </div>
</body>
</html>



<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $password = $_POST["password"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $usernamereplaced = preg_replace("/[^a-zA-Z0-9_]/", "", $username);


        $emailreplaced = preg_replace('/[^a-zA-Z0-9_@.]/', '', $email);

    
        if(!empty($username) && !empty($email) && !empty($password)){
            
            
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO login (username, password, email) VALUES('$usernamereplaced', '$hash', '$emailreplaced')";
            mysqli_query($conn, $sql);
            header("Location: home.php");
        }
    }

    mysqli_close($conn);
?>

