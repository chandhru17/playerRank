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
    <title>Admin - Player Rank</title>
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

        .box {
            border: 2px solid #333;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"]{
            width: 97%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        
        input[type="radio"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #337ab7;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
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
            <h1>Welcome <?php echo $_SESSION['name']; ?>!</h1>
            <h2 style="color: #337ab7;">Add or Edit Player's Data</h2>
        </center>
        <div class="box">
            <form action="insertplayers.php" method="post">
                <label for="name">Player Name:</label>
                <input type="text" name="name" required>

                <label for="type">Player Type:</label>
                <select name="type" required>
                    <option value="Batsman">Batsman</option>
                    <option value="All Rounder">All Rounder</option>
                    <option value="Bowler">Bowler</option>
                </select>
                <label for="format">Format:</label>
                <input type="radio" name="format" value="T20I" required>T20I
                <input type="radio" name="format" value="ODI">ODI
                <input type="radio" name="format" value="Test">Test
                <br>
                <br><label for="rating">Player Rating:</label>
                <input type="text" name="rating" required>

                <label for="nationality">Nationality:</label>
                <select name="nationality" required>
                    <option value="AUS">Australia</option>
                    <option value="AFG">Afghanistan</option>
                    <option value="BAN">Bangladesh</option>
                    <option value="ENG">England</option>
                    <option value="IND">India</option>
                    <option value="NED">Netherlands</option>
                    <option value="NZ">New Zealand</option>
                    <option value="PAK">Pakistan</option>
                    <option value="SA">South Africa</option>
                    <option value="SL">Sri Lanka</option>
                </select>

                <input type="submit" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>
