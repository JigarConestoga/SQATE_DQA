<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $credit_score = $_POST['credit_score'];
    $loan_type = $_POST['loan_type'];

    // Check if user already has an ongoing loan
    $sql_check_loan = "SELECT * FROM transactions WHERE sender='$name' OR receiver='$name'";
    $result_check_loan = $conn->query($sql_check_loan);

    if ($result_check_loan->num_rows > 0) {
        // User has an ongoing loan, display prompt
        echo "<script>alert('Error: You already have an ongoing loan.'); window.location.href='loanapplication.html';</script>";
    } else {
        // Determine eligibility based on loan type and credit score
        $eligible = false;
        if ($loan_type == "personal" && $credit_score >= 550) {
            $eligible = true;
        } elseif ($loan_type == "car" && $credit_score >= 500) {
            $eligible = true;
        } elseif ($loan_type == "business" && $credit_score >= 700) {
            $eligible = true;
        }

        if ($eligible) {
            // Process loan application
            // Here you can insert the data into the database, perform additional calculations, etc.
            echo "Congratulations! Your $loan_type loan application has been approved.";
        } else {
            // User is not eligible for the loan, display prompt
            echo "<script>alert('Sorry, you are not eligible for a $loan_type loan at the moment.'); window.location.href='loan_application.php';</script>";
        }
    }
}
?>
