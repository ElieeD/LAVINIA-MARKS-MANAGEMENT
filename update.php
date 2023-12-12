<?php
include('conect.php');
$s = "";

// Fetch data for foreign key fields
$moduleQuery = "SELECT Module_Id, ModName FROM modules";
$traineeQuery = "SELECT Trainee_Id, FirstName, LastName FROM trainees";

$moduleResult = $conn->query($moduleQuery);
$traineeResult = $conn->query($traineeQuery);

if (isset($_POST['ok'])) {
    $Module_Id = $_POST['module_Id'];
    $Trainee_Id = $_POST['trainee_Id'];
    $Assessment_Type = $_POST['assessmentType'];

    // Assuming you have input fields for each assessment type
    $Formative_Ass = ($_POST['assessmentType'] == 'Formative Assessment') ? $_POST['assessmentValue'] : 0;
    $Summative_Ass = ($_POST['assessmentType'] == 'Summative Assessment') ? $_POST['assessmentValue'] : 0;
    $Comprehensive_Ass = ($_POST['assessmentType'] == 'Comprehensive Assessment') ? $_POST['assessmentValue'] : 0;

    $Total_Marks_100 = ($Formative_Ass + $Summative_Ass + $Comprehensive_Ass) / 3;

    $insertSql = "UPDATE  marks SET Formative_Ass ='$Formative_Ass',Summative_Ass ='$Summative_Ass' Comprehensive_Ass ='$Comprehensive_Ass')" ;
            

    if ($conn->query($insertSql) === TRUE) {
        header('location:operation.php');
        $s = "Mark Record  successfully Updated";
    } else {
        $s = "Error occurred: " . $conn->error;
    }
}

$id = $_GET['Mark_ID'];

// Fetech user data based on id
$result = mysqli_query($conn, "SELECT Formative_Ass,Summative_Ass,Comprehensive_Ass FROM marks WHERE Mark_ID=$id");

while($user_data = mysqli_fetch_array($result))
{
	$name = $user_data['Formative_Ass'];
	$email = $user_data['Summative_Ass'];
	$mobile = $user_data['Comprehensive_Ass'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylee.css">
    <!-- Include Font Awesome CSS (you can use a CDN or download the file) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Form with Select Options</title>
    <!-- Add your additional styles here -->
    <style> 
        /* Add your custom styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            position: fixed;
            overflow: hidden; /* Hide horizontal overflow */
        }

        header {
            background-color: #900C3F;
            color: #000;
            text-align: center;
            padding: 10px 0;
        }

        nav {
            background-color: #900C3F;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav li {
            display: inline;
            padding: 190px;
            margin-right: 30px; /* Increased distance between navigation items to 30px */
        }

        nav a {
            text-decoration: none;
            color: #000;
            font-weight: bold;
            font-size: 16px;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        nav a:hover {
            color: #fff; /* Change font color to white on hover */
            transform: translateY(-3px);
        }

        nav i {
            margin-right: 5px; /* Adjust the margin between the icon and text */
        }

        .elie {
            height: 80px;
            width: 80%;
            background-color: #900C3F;
            margin-left: 310px;
            margin-top: 10px;
        }

        .elie li {
            display: inline;
            padding: 92px;
            margin-left:-90px;
        }

        .elie a {
            text-decoration: none;
            display: inline;
            margin-right:-73px;
        }

        .main-content {
            text-align: center;
            position: fixed;
            bottom: -52px;
            left: 0;
            right: 0;
            overflow-y: auto; /* Enable vertical overflow */
        }

        footer {
            background-color: #900C3F;
            color: #000;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            position: fixed;
            bottom: 0;
        }

        .login-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 400px; /* Adjust the maximum width as needed */
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

        .login-form select,
        .login-form input {
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
    <br>
    <div class="main-content">
        <div class="login-form">
            <p><?php echo $s; ?></p>
            <form action="" method="post">
                
                <label>Formative Assessment</label>
                <input type="number" name="Formative_Ass" required>
                <label>Summative Assessment</label>
                <input type="text" name="Summative_Ass">
                </select>
                <label>Comprehensive Assessment</label>
                <input type="text" name="Comprehensive_Ass">
                <button type="submit" name="ok">UPDATE</button>
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
