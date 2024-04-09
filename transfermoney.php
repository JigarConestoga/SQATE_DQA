<?php

    include("config.php");
    $query = mysqli_query($conn,"SELECT * FROM users WHERE id=$id");

    if($senderresult = mysqli_fetch_assoc($query)){
        $res_Uname = $senderresult['name'];
        $res_Email = $senderresult['email'];
        $res_Age = $senderresult['age'];
        $res_AccountNumber = $senderresult['accountnumber']; // Fetching account number
        $res_balance = $senderresult['balance'];
    } else {
        // Handle case where user details are not found
        $res_Uname = "User";
        $res_Email = "N/A";
        $res_Age = "N/A";
        $res_AccountNumber = "N/A";
        $res_balance = "N/A";
    }
    // Check if form is submitted
    if(isset($_POST['submit'])) {
        if(isset($_POST['account_number']) && isset($_POST['amount'])) { // Check if 'accountnumber' and 'amount' are set
            $accountnumber = $_POST['account_number'];
            $amount = $_POST['amount'];

            // Fetch user details
            $sql = "SELECT * FROM users WHERE accountnumber = '$accountnumber'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                // Check if the user has sufficient balance
                if($res_balance >= $amount) {
                    // Proceed with the transaction
                    $newBalance = $res_balance - $amount;
                    $sql = "UPDATE users SET balance = $newBalance WHERE accountnumber = '$res_AccountNumber'";
                    mysqli_query($conn, $sql);

                    $newBalanceRec = $user['balance'] + $amount;
                    $sql = "UPDATE users SET balance = $newBalanceRec WHERE accountnumber = '$accountnumber'";
                    mysqli_query($conn, $sql);

                    // Add the transaction to transaction history
                    $senderName = $res_Uname;
                    $recName = $user['name'];
                    $sql = "INSERT INTO transactions (sender, receiver, amount) VALUES ('$senderName','$recName', $amount)";
                    mysqli_query($conn, $sql);

                    // Redirect to transaction history page
                    header("Location: transactionhistory.php");
                    exit();
                } else {
                    // Insufficient balance, display an error message
                    $error = "Insufficient balance.";
                }
            } else {
                // Account number doesn't exist, display an error message
                $error = "Account number not found.";
            }
        } else {
            // 'accountnumber' or 'amount' is not set in $_POST
            $error = "Please enter both account number and amount.";
        }
    }

    // Fetch all users
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/css.css">
		<title>GRIP Bank</title>
		<link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
		<script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="css/table.css">
		<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600&family=Ubuntu:wght@700&display=swap" rel="stylesheet">
		<style>
			@import url('https://fonts.googleapis.com/css2?family=Baloo+Bhai+2&family=Roboto:wght@300&display=swap');
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
							<a class="nav-link active" aria-current="page" href="index.php">Home</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#services">Services</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="chatbot.html">Chatbot</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="logout.php">Logout</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- End Navbar -->
		<!-- User Details -->
		<main class="main-box">
			<div class="box">
				<div class="top">
					<p>Hello <b> <?php echo $res_Uname ?> </b>, Welcome </p>
				</div>
				<div class="top">
					<p>Your email is <b> <?php echo $res_Email ?> </b>. </p>
				</div>
				<div class="top">
					<p>Your account number is <b> <?php echo $res_AccountNumber ?> </b>. </p>
					<!-- Displaying account number -->
				</div>
				<div class="top">
					<p>You are <b> <?php echo $res_Age ?> years old </b>. </p>
				</div>
			</div>
		</main>
		<!-- User Details Ends -->
		<!-- Transfer Money Form -->
		<div class="container">
			<h2 class="text-center pt-4" style="color: black;">Transfer Money</h2>
			<br/>
			<div class="row">
				<div class="col">
					<form method="POST" action="
														<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<div class="mb-3">
							<label for="accountnumber" class="form-label">Enter Account Number:</label>
							<input type="text" class="form-control" id="accountnumber" name="account_number" required>
						</div>
						<div class="mb-3">
							<label for="amount" class="form-label">Enter Amount:</label>
							<input type="number" class="form-control" id="amount" name="amount" required>
						</div>
						<button type="submit" name="submit" class="btn btn-primary">Transact</button>
					</form> <?php if(isset($error)) { ?> <div class="alert alert-danger mt-3" role="alert"> <?php echo $error; ?> </div> <?php } ?>
				</div>
			</div>
		</div>
		<!-- End Transfer Money Form -->
		<!-- Footer -->
		<footer class="footer">
			<div class="container">
				<div class="social-links">
					<a class="btn-floating btn-lg m-1" target="_blank" href="#">
						<i class="fab fa-youtube"></i>
					</a>
					<a class="btn-floating btn-lg m-1" target="_blank" href="#">
						<i class="fab fa-twitter"></i>
					</a>
					<a class="btn-floating btn-lg m-1" target="_blank" href="#">
						<i class="fab fa-linkedin"></i>
					</a>
					<a class="btn-floating btn-lg m-1" target="_blank" href="#">
						<i class="fab fa-medium"></i>
					</a>
				</div>
				<p class="mt-3 mb-0">&copy; 2023. All rights reserved.</p>
				<p class="mb-0">
					<a href="index.html">Contact</a>
					<span class="px-2">|</span>
					<a href="index.html">Privacy & Cookie Policy</a>
					<span class="px-2">|</span>
					<a href="index.html">Terms of Use</a>
				</p>
			</div>
		</footer>
		<!-- End Footer -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
	</body>
</html>