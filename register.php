<?php
// Initialize variables to empty values
$name = $email = $age = $mobileNumber = $creditScore = $password = $retypePassword = "";
$nameErr = $emailErr = $ageErr = $mobileNumberErr = $creditScoreErr = $passwordErr = $retypePasswordErr = "";

// Your database connection code here...
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "grip_bank"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a random account number
function generateAccountNumber() {
    // Generate a random number of 8 digits
    $randomNumber = mt_rand(10000000, 99999999);
    return $randomNumber;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $age = test_input($_POST["age"]);
    $mobileNumber = test_input($_POST["mobile_number"]);
    $creditScore = test_input($_POST["credit_score"]);
    $password = test_input($_POST["password"]);
    $retypePassword = test_input($_POST["retype_password"]);

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

    // Check if age is empty, numeric, and greater than zero
    if (empty($age)) {
        $ageErr = "Age is required";
    } elseif (!is_numeric($age) || $age <= 0) {
        $ageErr = "Age must be a positive number";
    }

    // Check if mobile number is empty, numeric, and greater than zero
    if (empty($mobileNumber)) {
        $mobileNumberErr = "Mobile Number is required";
    } elseif (!is_numeric($mobileNumber) || $mobileNumber <= 0) {
        $mobileNumberErr = "Mobile Number must be a positive number";
    }

    // Check if credit score is empty, numeric, and greater than zero
    if (empty($creditScore)) {
        $creditScoreErr = "Credit Score is required";
    } elseif (!is_numeric($creditScore) || $creditScore <= 0) {
        $creditScoreErr = "Credit Score must be a positive number";
    }


    // Check if password is empty
    if (empty($password)) {
        $passwordErr = "Password is required";
    }

    // Check if retype password matches password
    if ($password !== $retypePassword) {
        $retypePasswordErr = "Passwords do not match";
    }

    // Insert data into database
    if (empty($nameErr) && empty($emailErr) && empty($ageErr) && empty($mobileNumberErr) && empty($creditScoreErr) && empty($passwordErr) && empty($retypePasswordErr)) {
        // Generate a random account number
        $accountNumber = generateAccountNumber();

        $sql = "INSERT INTO users (name, email, age, mobile, credit_score, password, accountnumber) VALUES ('$name', '$email', $age, '$mobileNumber', $creditScore, '$password', '$accountNumber')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br/>" . $conn->error;
        }
    }
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Close connection
$conn->close();
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
		<title>Register</title>
		<style>
			/* Style for the container of password input and show/hide password button */
			.password-container {
				position: relative;
			}

			/* Style for the show/hide password button */
			.show-password-btn {
				position: absolute;
				top: 50%;
				right: 5px;
				/* Adjust this value as needed */
				transform: translateY(-50%);
				cursor: pointer;
				z-index: 1;
				/* Ensure the button stays above the input field */
			}
		</style>
	</head>
	<body>
		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.html">
					<img src="images/logo.png" alt="logo" style="width:40px;">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="index.html">Home</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- End Navbar -->
		<!-- Form Container -->
		<div class="container_new">
			<div class="box form-box">
				<header>Register</header>
				<!-- Form Start -->
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<!-- Name Field -->
					<div class="field input">
						<label for="name">Name</label>
						<input type="text" name="name" value="<?php echo $name;?>">
						<span class="error"> <?php echo $nameErr;?> </span>
					</div>
					<!-- Email Field -->
					<div class="field input">
						<label for="email">Email</label>
						<input type="text" name="email" value="<?php echo $email;?>">
						<span class="error"> <?php echo $emailErr;?> </span>
					</div>
					<!-- Age Field -->
					<div class="field input">
						<label for="age">Age</label>
						<input type="text" name="age" value="<?php echo $age;?>">
						<span class="error"> <?php echo $ageErr;?> </span>
					</div>
					<!-- Credit Score Field -->
					<div class="field input">
						<label for="credit_score">Credit Score</label>
						<input type="text" name="credit_score" value="<?php echo $creditScore;?>">
						<span class="error"> <?php echo $creditScoreErr;?> </span>
					</div>
					<!-- Mobile Number Field -->
					<div class="field input">
						<label for="mobile_number">Mobile Number</label>
						<input type="text" name="mobile_number" value="<?php echo $mobileNumber;?>">
						<span class="error"> <?php echo $mobileNumberErr;?> </span>
					</div>
					<!-- Password Field -->
					<div class="field input">
						<label for="password">Password</label>
						<input type="password" id="password" name="password" value="<?php echo $password;?>">
						<span class="error"> <?php echo $passwordErr;?> </span>
						<span class="show-password-btn" onclick="togglePasswordVisibility()">
							<!-- Show Password Icon -->
						</span>
					</div>
					<!-- Retype Password Field -->
					<div class="field input">
						<label for="retype_password">Retype Password</label>
						<input type="password" name="retype_password" value="<?php echo $retypePassword;?>">
						<span class="error"> <?php echo $retypePasswordErr;?> </span>
					</div>
					<!-- Submit Button -->
					<div class="field">
						<input type="submit" class="btn" name="submit" value="Submit" required>
					</div>
				</form>
				<!-- Form End -->
			</div>
		</div>
		<!-- Script for Show Password -->
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