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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #337ab7;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="logout.php" style="float: right;">Logout</a>
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
            <input type="submit" value="Apply">
        </form>

        <?php
        $conn = mysqli_connect("localhost", "root", "", "playerrank");
        if (mysqli_connect_errno()) {
            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
        }
        $number = 1;
        if ($_POST['nationality'] === "All") {
            if ($stmt = $conn->prepare('SELECT * FROM Players WHERE format = ? AND type = ? ORDER BY rating DESC LIMIT 10;')) {
                $stmt->bind_param('ss', $_POST['format'], $_POST['type']);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    echo '<table>';
                    echo '<tr><th>Rank</th><th>Name</th><th>Type</th><th>Format</th><th>Rating</th><th>Nationality</th></tr>';
                    
                    $stmt->bind_result($name, $type, $format, $rating, $nationality);
                
                    while ($stmt->fetch()) {
                        echo '<tr>';
                        echo '<td>' . $number . '</td>'; // Output the rank
                        echo '<td>' . $name . '</td>';
                        echo '<td>' . $type . '</td>';
                        echo '<td>' . $format . '</td>';
                        echo '<td>' . $rating . '</td>';
                        echo '<td>' . $nationality . '</td>';
                        echo '</tr>';
                        $number++; // Increment the number
                    }
                
                    echo '</table>';
                } else {
                    echo 'No results found.';
                }
            }
        } else {
            if ($stmt = $conn->prepare('SELECT * FROM Players WHERE format = ? AND type = ? and nationality = ? ORDER BY rating DESC LIMIT 10;')) {
                $stmt->bind_param('sss', $_POST['format'], $_POST['type'], $_POST['nationality']);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    echo '<table>';
                    echo '<tr><th>Rank</th><th>Name</th><th>Type</th><th>Format</th><th>Rating</th><th>Nationality</th></tr>';
                    $stmt->bind_result($name, $type, $format, $rating, $nationality);
                    while ($stmt->fetch()) {
                        echo '<tr>';
                        echo '<td>' . $number . '</td>'; // Output the rank
                        echo '<td>' . $name . '</td>';
                        echo '<td>' . $type . '</td>';
                        echo '<td>' . $format . '</td>';
                        echo '<td>' . $rating . '</td>';
                        echo '<td>' . $nationality . '</td>';
                        echo '</tr>';
                        $number++; // Increment the number
                    }
                    echo '</table>';
                } else{
                    echo "No results found.";
                }
            }
        }
        ?>