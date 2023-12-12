<?php
// Start a session
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Include PHPMailer autoload
require 'config/mailer/src/PHPMailer.php';
require 'config/mailer/src/Exception.php';
require 'config/mailer/src/SMTP.php';
include('config/db.php');


// require 'vendor/autoload.php';
// $mail = new PHPMailer(true);

// Process the forgot password form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $email = trim($_POST['email']);

    // Check if the email exists in the database
    $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_email_sql);

    if ($result->num_rows > 0) {
        // Generate a temporary password (you may use a more secure method)
        $temp_password = bin2hex(random_bytes(8));

        // Hash the temporary password before storing it in the database
        $hashed_temp_password = password_hash($temp_password, PASSWORD_DEFAULT);

        // Update the user's password with the temporary password
        $update_password_sql = "UPDATE users SET password = '$hashed_temp_password' WHERE email = '$email'";
        $conn->query($update_password_sql);


        $mail = new PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Port = 2525;
$mail->SMTPAuth = true;
$mail->Host = 'sandbox.smtp.mailtrap.io';
$mail->Username = '33d385311dfa0b';
$mail->Password = '1d91f05cbd8b41';
$mail->setFrom('your_email@example.com', 'Your Name');
$mail->addAddress($email);
$mail->Subject = 'Password Reset';
$mail->Body = "Your temporary password is: $temp_password";
$mail->AltBody = 'HTML messaging not supported';
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

        
        if ($mail->send()) {
            echo "A temporary password has been sent to your email. Please check your inbox.";
        } else {
            echo "Error sending email: " . $mail->ErrorInfo;
        }
    } else {
        echo "Email not found in our records.";
    }
}

// Close the database connection
$conn->close();
?>
