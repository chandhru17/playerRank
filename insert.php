<!DOCTYPE html>
<html>

<head>
	<title>Insert Page page</title>
</head>

<body>
	<center>
		<?php

		// servername => localhost
		// username => root
		// password => empty
		// database name => playerrank
		if (!isset($_POST['email'], $_POST['password'], $_POST['option'])) {
			echo '<script>alert("Please fill all the fields!")
			        window.location.replace("signup.html");</script>';
		}

		$conn = mysqli_connect("localhost", "root", "", "playerrank");

		// Check connection
		if ($conn === false) {
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}

		$email = $_POST['email'];
		
		// Check if the email already exists in the "players" table
		$checkQuery = "SELECT email FROM accounts WHERE email = '$email'";
		$result = mysqli_query($conn, $checkQuery);

		if (mysqli_num_rows($result) > 0) {
			// Email already exists, show an alert message and redirect to login.html
			echo '<script>alert("Account already exists. Please use a different email.")
			window.location.replace("signup.html");</script>';
		} else {
			// Email doesn't exist, proceed to insert the new account
			$name = $_REQUEST['name'];
			$password = $_REQUEST['password'];
			$option = $_REQUEST['option'];

			// Performing insert query execution
			$sql = "INSERT INTO accounts VALUES ('$name', '$email', '$password', '$option')";

			if (mysqli_query($conn, $sql)) {
				echo '<script>alert("Account created successfully!")
				window.location.replace("login.html");</script>';
			} else {
				echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
			}
		}

		// Close connection
		mysqli_close($conn);
		?>
	</center>
</body>

</html>
