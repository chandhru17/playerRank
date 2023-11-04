<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User - Player Rank</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        select, input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #337ab7;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #235a96;
        }

        a {
            display: block;
            text-align: right;
            margin-top: 10px;
            color: #337ab7;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="logout.php" style="float: right;">Logout</a><br><br>
        <center>
          <h2>Hello <?php echo $_SESSION['name']; ?>!</h2>
          <h2 style="color: #337ab7;"> Start exploring the world of cricket with us</h2>
        </center> 
          <form action="display.php" method="post">
            <select name="format" required>
                <option value="T20I">T20I</option>
                <option value="ODI">ODI</option>
                <option value="Test">Test</option>
            </select>
            <select name="type" required>
                <option value="Batsman">Batsman</option>
                <option value="All Rounder">All Rounder</option>
                <option value="Bowler">Bowler</option>
            </select>
            <select name="nationality" required>
                <option value="All">All</option>
                <option value="Australia">Australia</option>
                <option value="Afghanistan">Afghanistan</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="England">England</option>
                <option value="India">India</option>
                <option value="Netherlands">Netherlands</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Pakistan">Pakistan</option>
                <option value="South Africa">South Africa</option>
                <option value="Sri Lanka">Sri Lanka</option>
            </select>
            <input type="submit" value="Apply">
        </form>
    </div>
</body>
</html>
