<?php 
include('conect.php');
$s = "";

if(isset($_POST['ok'])){
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Gender = $_POST['Gender'];
    $Trade_Id= $_POST['Trade_Id'];
    $checkSql = "SELECT * FROM trainees WHERE FirstName = '$FirstName' AND LastName ='$LastName' AND Gender='$Gender'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult && $checkResult->num_rows > 0) {
        $s = "Module Name already exists. Please choose a different Module Name.";
    } else {
        // If the module name doesn't exist, proceed with the insertion
        $insertSql = "INSERT INTO trainees(FirstName, LastName,Gender,Trade_Id) VALUES ('$FirstName', '$LastName','$Gender','$Trade_Id')";
        if ($conn->query($insertSql) === TRUE) {
            $s = "Trainee submitted successfully";
        } else {
            $s = "Error occurred: " . $conn->error;
        }
    }
}
$tradeQuery = "SELECT Trade_Id,Trade_Name FROM trades";
$tradeResult = $conn->query($tradeQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylee.css">
    <!-- Include Font Awesome CSS (you can use a CDN or download the file) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Home Page</title>
    <style>
        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-top: -150px;
            
        }

        .login-form {
            background-color: #fff;
            width: 30%;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-form h2 {
            text-align: center;
            color: #333;
        }

        .login-form form {
            display: flex;
            flex-direction: column;
        }

        .login-form label {
            margin-bottom: 8px;
            color: #555;
        }

        .login-form input ,select{
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .login-form button {
            background-color: #900C3F;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .login-form button:hover {
            background-color: #900C3F;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#"><i class="fas fa-home"></i> DASHBOARD</a></li>
                <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> LOG OUT</a></li>
            </ul>
        </nav>
    </header>
    <br><br>
    <div class="elie"> 
        <ul><br>
            <li><a href="inserts.php"><i class="fas fa-book"></i> MODULES</a></li>
            <li><a href="trade.php"><i class="fas fa-tools"></i> TRADES</a></li>
            <li><a href="trainee.php"><i class="fas fa-users"></i> TRAINEES</a></li>
            <li><a href="marks.php"><i class="fas fa-marker"></i> MARKS</a></li>
        </ul>
    </div>
    <center><h2 style="margin-top:130px;">REGISTER MODULE HERE !</h2></center>

    <div class="main-content">
        <div class="login-form">
            <p> <?php echo $s; ?></p>
            <form action="" method="post">
                <label for="FirstName">First Name:</label>
                <input type="text" name="FirstName" required>

                <label for="LastName">Last Name:</label>
                <input type="text" name="LastName" required>

                <label for="Gender">Gender:</label>
                <input type="text" name="Gender" required>
                <label for="Trade">Trade:</label>

                <select name="Trade_Id" required>
                    <option></option>
                    <?php
                    while ($row = $tradeResult->fetch_array()) {
                        echo "<option value='{$row['Trade_Id']}'>{$row['Trade_Name']}</option>";
                    }
                    
                    ?>
                </select>



                <button type="submit" name="ok">SAVE</button>
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
