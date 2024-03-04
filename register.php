<?php
// Initialize variables to empty values
$name = $email = $age = $password = "";
$nameErr = $emailErr = $ageErr = $passwordErr = "";

// Your database connection code here...

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $age = test_input($_POST["age"]);
    $password = test_input($_POST["password"]);

    // Check if name is empty
    if (empty($name)) {
        $nameErr = "Name is required";
    }

    // Check if email is empty and valid
    if (empty($email)) {
        $emailErr = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }

    // Check if age is empty and numeric
    if (empty($age)) {
        $ageErr = "Age is required";
    } elseif (!is_numeric($age)) {
        $ageErr = "Age must be a number";
    }

    // Check if password is empty
    if (empty($password)) {
        $passwordErr = "Password is required";
    }

    // Your database insertion code here...

}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: rgba(255, 255, 255, 0.7); /* Background color with opacity */
            overflow: hidden; /* Prevent background scrolling */
        }

        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Ensure the image stays behind other content */
            opacity: 10; /* Adjust the opacity of the background image */
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        form {
            background-color: rgba(255, 255, 255, 50); /* Form background color with opacity */
            padding: 20px;
            border-radius: 10px;
            width: 700px;
        }

        h2 {
            text-align: center;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            display: inline; /* Display error messages inline */
        }
        .show-password-btn {
            cursor: pointer;
            margin-left: -30px; /* Adjust the horizontal position */
            position: relative;
            top: 6px; /* Adjust the vertical position */
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
    <img class="background-image" src="https://t3.ftcdn.net/jpg/03/55/60/70/360_F_355607062_zYMS8jaz4SfoykpWz5oViRVKL32IabTP.jpg" alt="Background Image">
    <div class="form-container">
        <div>
            <h2>Register</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            Name: <input type="text" name="name" value="<?php echo $name;?>"> <span class="error"> <?php echo $nameErr;?></span>
            <br><br>
            Email: <input type="text" name="email" value="<?php echo $email;?>"> <span class="error"> <?php echo $emailErr;?></span>
            <br><br>
            Age: <input type="text" name="age" value="<?php echo $age;?>"> <span class="error"> <?php echo $ageErr;?></span>
            <br><br>
            Password: 
            <input type="password" id="password" name="password" value="<?php echo $password;?>"> 
            <span class="error"> <?php echo $passwordErr;?></span>
            <span class="show-password-btn" onclick="togglePasswordVisibility()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="none" d="M0 0h24v24H0z"/>
                    <path d="M12 4a8 8 0 0 0-8 8c0 1.83.62 3.5 1.67 4.83l1.43-1.43A5.955 5.955 0 0 1 4 12a6 6 0 0 1 6-6c1.33 0 2.57.43 3.57 1.18l1.43-1.43A7.963 7.963 0 0 0 12 4zm6.83 7.83l-1.42 1.42C16.54 14.39 16 13.27 16 12s.54-2.39 1.41-3.24l1.42 1.42C17.55 10.12 17 11.04 17 12s.55 1.88 1.83 2.83zM12 6c-2.08 0-3.99.8-5.41 2.1l1.42 1.42C9.17 8.82 10.53 8 12 8s2.83.82 3.9 2.12l1.42-1.42A7.963 7.963 0 0 0 12 6zm3.9 5.88C14.83 13.18 13.47 14 12 14s-2.83-.82-3.9-2.12L6.68 10.46A7.965 7.965 0 0 0 12 10c1.46 0 2.82.39 4 1.06l1.9 1.82zm0 0" fill="currentColor"/>
                </svg>
            </span>


            <br><br>
            <input type="submit" name="submit" value="Submit">
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
