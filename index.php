<?php

// Include database configuration file
include("config.php");

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Escape user inputs to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check user credentials
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND Password='$password'") or die("Select Error");

    // Check if query returned any rows
    if (mysqli_num_rows($result) > 0) {
        // Fetch user data
        $row = mysqli_fetch_assoc($result);

        // Store user data in session variables
        $_SESSION['valid'] = $row['email'];
        $_SESSION['username'] = $row['name'];
        $_SESSION['age'] = $row['Age'];
        $_SESSION['id'] = $row['id'];

        // Redirect to home.php if login is successful
        header("Location: home.php");
        exit;
    } else {
        // Display error message if login fails
        $login_error_message = "<div class='message'><p>Wrong Username or Password</p></div> <br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/css.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Login</title>
    <style>
        /* Style for the container of password input and show/hide password button */
        .password-container {
            position: relative;
        }

        /* Style for the show/hide password button */
        .show-password-btn {
            position: absolute;
            top: 50%;
            right: 5px; /* Adjust this value as needed */
            transform: translateY(-50%);
            cursor: pointer;
            z-index: 1; /* Ensure the button stays above the input field */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo" style="width:40px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.html">Home</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container_new">
        <div class="box form-box">
            <?php
            if(isset($login_error_message)) {
                echo $login_error_message;
            }
            ?>

            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <div class="password-container">
                        <input type="password" name="password" id="password" autocomplete="off" required>
                        <!-- Show/hide password button -->
                        <span class="show-password-btn" onclick="togglePasswordVisibility()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="none" d="M0 0h24v24H0z"/>
                                <path d="M12 4a8 8 0 0 0-8 8c0 1.83.62 3.5 1.67 4.83l1.43-1.43A5.955 5.955 0 0 1 4 12a6 6 0 0 1 6-6c1.33 0 2.57.43 3.57 1.18l1.43-1.43A7.963 7.963 0 0 0 12 4zm6.83 7.83l-1.42 1.42C16.54 14.39 16 13.27 16 12s.54-2.39 1.41-3.24l1.42 1.42C17.55 10.12 17 11.04 17 12s.55 1.88 1.83 2.83zM12 6c-2.08 0-3.99.8-5.41 2.1l1.42 1.42C9.17 8.82 10.53 8 12 8s2.83.82 3.9 2.12l1.42-1.42A7.963 7.963 0 0 0 12 6zm3.9 5.88C14.83 13.18 13.47 14 12 14s-2.83-.82-3.9-2.12L6.68 10.46A7.965 7.965 0 0 0 12 10c1.46 0 2.82.39 4 1.06l1.9 1.82zm0 0" fill="currentColor"/>
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have an account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var passwordFieldType = passwordField.getAttribute("type");
            if (passwordFieldType === "password") {
                passwordField.setAttribute("type", "text");
            } else {
                passwordField.setAttribute("type", "password");
            }
        }
    </script>
</body>

</html>
