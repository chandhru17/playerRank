<!DOCTYPE html>
<html>
<head>
    <title>Player Insert/Update</title>
</head>
<body>
    <?php
        $conn = mysqli_connect("localhost", "root", "", "playerrank");
        if ($conn === false) {

        }

        $name = $_REQUEST['name'];
        $type = $_REQUEST['type'];
        $format = $_REQUEST['format'];
        $rating = $_REQUEST['rating'];
        $nationality = $_REQUEST['nationality'];

        $checkSql = "SELECT * FROM players WHERE name = '$name' AND type = '$type' AND format = '$format' AND nationality = '$nationality'";
        $result = mysqli_query($conn, $checkSql);

        if (mysqli_num_rows($result) > 0) {
            $updateSql = "UPDATE players SET rating = '$rating' WHERE name = '$name' AND type = '$type' AND format = '$format' AND nationality = '$nationality'";
            if (mysqli_query($conn, $updateSql)) {
                echo '<script>alert("Data updated successfully!")
                window.location.replace("admin.php")</script>';
            } else {

            }
        } else {
            $insertSql = "INSERT INTO players (name, type, format, rating, nationality) VALUES ('$name', '$type', '$format', '$rating', '$nationality')";
            if (mysqli_query($conn, $insertSql)) {
                echo '<script>alert("Data stored successfully!")
                window.location.replace("admin.php")</script>';
            } else {

            }
        }

        mysqli_close($conn);
    ?>
</body>
</html>
