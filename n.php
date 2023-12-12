<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lavinia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
if (isset($_POST["submit"])) {
    $formative_ass = $_POST["formative_ass"];
    $summative_ass = $_POST["summative_ass"];
    $comprehensive_ass = $_POST["comprehensive_ass"];

    $sql = "INSERT INTO Marks (Formative_Ass, Summative_Ass, Comprehensive_Ass) 
            VALUES ('$formative_ass', '$summative_ass', '$comprehensive_ass')";

    if ($conn->query($sql) === TRUE) {
        echo "Record created successfully";
    } else {
        echo "Error creating record: " . $conn->error;
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Insert Marks</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#"><i class="fas fa-home"></i> HOME</a></li>
                <li><a href="#"><i class="fas fa-user-plus"></i> SIGN UP</a></li>
                <li><a href="#"><i class="fas fa-sign-in-alt"></i> LOG IN</a></li>
            </ul>
        </nav>
    </header>

    <div class="main-content">
        <h2>Insert Marks</h2>
        <form action="" method="post">
            <label for="formative_ass">Formative Assessment:</label>
            <input type="text" id="formative_ass" name="formative_ass" required>

            <label for="summative_ass">Summative Assessment:</label>
            <input type="text" id="summative_ass" name="summative_ass" required>

            <label for="comprehensive_ass">Comprehensive Assessment:</label>
            <input type="text" id="comprehensive_ass" name="comprehensive_ass" required>

            <button type="submit" name="submit">Insert Data</button>
        </form>
    </div>

    <footer>
        <nav>
            <p>&copy; 2023 All Rights Reserved</p>
        </nav>
    </footer>
</body>
</html>
