<?php 
include("conect.php");

$s = "";

if (isset($_POST['ok'])) {
    $a = $_POST['UserName'];
    $b = $_POST['Password'];

    // Check if the username already exists
    $checkSql = "SELECT * FROM users WHERE UserName = '$a'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult && $checkResult->num_rows > 0) {
        $s = "Username already exists. Please choose a different username.";
    } else {
        // If the username doesn't exist, proceed with the insertion
        $insertSql = "INSERT INTO users(UserName, Password) VALUES ('$a', '$b')";
        if ($conn->query($insertSql) === TRUE) {
            $s = "Account created successfully";
        } else {
            $s = "Error creating record: " . $conn->error;
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- Include Font Awesome CSS (you can use a CDN or download the file) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Home Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #ffd700;
            color: #000;
            text-align: center;
            padding: 10px 0;
        }

        nav {
            background-color: #ffd700;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav li {
            display: inline;
            margin-right: 30px;
        }

        nav a {
            text-decoration: none;
            color: #000;
            font-weight: bold;
            font-size: 16px;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        nav a:hover {
            color: #fff;
            transform: translateY(-3px);
        }

        nav i {
            margin-right: 5px;
        }

        .main-content {
            text-align: center;
            margin: 50px;
    
        }

        footer {
            background-color: #ffd700;
            color: #000;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }

        .login-form {
            max-width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-form label {
            display: block;
            margin-bottom: 8px;
        }

        .login-form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .login-form button {
            background-color: #ffd700;
            color: #000;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .login-form button:hover {
            background-color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html"><i class="fas fa-home"></i> HOME</a></li>
                <li><a href="signup.php"><i class="fas fa-user-plus"></i> SIGN UP</a></li>
                <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> LOG IN</a></li>
            </ul>
        </nav>
    </header>
<br><br><br><br>
    <div class="main-content">
        <div class="login-form">
            <h2>SIGN UP</h2>
            <p style="color: #ffd700; font-style:bold;"><?php  echo $s; ?></p><br>
            <form action="" method="post">
                <label for="UserName">UserName:</label>
                <input type="text" name="UserName" required>

                <label for="Password">Password:</label>
                <input type="password" name="Password" required>

                <button type="submit" name="ok">SIGN UP</button>
            </form>
        </div>
    </div>

    <footer>
        <nav>
            <p>&copy; 2023 All Rights Reserved</p>
        </nav>
    </footer>
</body>
</html>
