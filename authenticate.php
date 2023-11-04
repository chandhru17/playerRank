<?php
    session_start();
    $conn=mysqli_connect("localhost","root","","playerrank");
    if ( mysqli_connect_errno() ) {
        exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
    if ( !isset($_POST['email'], $_POST['password'], $_POST['option']) ) {
        echo '<script>alert("Please fill all the fields!")
			                window.location.replace("login.html");</script>';
    }

    if ($stmt = $conn->prepare('SELECT name,email,password,type FROM accounts WHERE email = ?')) {
        $stmt->bind_param('s', $_POST['email']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($name,$email,$password,$option);
            $stmt->fetch();
            // Account exists, now we verify the password.
            // Note: remember to use password_hash in your registration file to store the hashed passwords.
            if ($_POST['password'] === $password && $_POST['option'] === $option) {
                // Verification success! User has logged-in!
                // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['name']=$name;
                $_SESSION['option']=$option;
                echo 'Welcome ' . $name . '!';
                if($_POST['option']==="Admin"){
                    echo '<script>alert("Logged in successfully!")
			                window.location.replace("admin.php");</script>';
                } else{
                    echo '<script>alert("Logged in successfully!")
			                window.location.replace("user.php");</script>';
                }
                
            } else {
                echo '<script>alert("Incorrect credentials, Try again!")
			            window.location.replace("login.html");</script>';
            }
        } else {
            echo '<script>alert("Incorrect credentials, Try again!")
			            window.location.replace("login.html");</script>';
        }
    
    
        $stmt->close();
    }
?>