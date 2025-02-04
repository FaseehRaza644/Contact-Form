<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="style.css">
    <style>
#success,
#alert{
    width: 500px;
    text-align: center;
    position: absolute;
    top: 30px;
    left: 50%;
    transform: translateX(-50%);
    color: whitesmoke;
    padding: 8px 0;
    /* display: none; */
}
#alert{
    background-color: rgb(252, 59, 59);
}
#success{
    background-color: rgb(44, 158, 24);
}
    </style>
</head>

<body>
    <div class="form-container" id="form-container-1">
        <form id="myform" action='' method='post'>
            <div class="form-row" id="form-row-1">
                <div class="form-group" id="form-group-1">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group" id="form-group-2">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
            </div>
            <div class="form-row" id="form-row-2">
                <div class="form-group" id="form-group-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group" id="form-group-4">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
            </div>
            <div class="form-group" id="form-group-5">
                <label for="message">Message</label>
                <textarea id="message" name="message" placeholder="Write your message...." rows="4" required></textarea>
            </div><br>
            <button type="submit" id='btn' name='send'>Send Message</button><br>
        </form>
    </div>

    <!-- <script>
    document.getElementById("myform").addEventListener("submit", function(event) {
        event.preventDefault(); // Form ko refresh hone se rokna

        // Show Success Message
        let successMsg = document.getElementById("success");
        let errorMsg = document.getElementById("alert");

        // Simulate success or error (remove this after integrating with PHP)
        let isSuccess = true;  // Change this to false to test error message
        
        if(isSuccess) {
            successMsg.style.display = "block";
            setTimeout(function() {
                successMsg.style.display = "none";
            }, 2000);
        } else {
            errorMsg.style.display = "block";
            setTimeout(function() {
                errorMsg.style.display = "none";
            }, 2000);
        }

        // Yahan apna form submit karne ka PHP/Ajax code add kar sakta hai
        this.submit(); // Agar PHP ke saath work kar raha hai toh
    });
</script> -->
</body>

</html>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['send'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];



//Load Composer's autoloader
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';
require 'phpMailer/Exception.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
                   //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'faseehraza29@gmail.com';                     //SMTP username
    $mail->Password   = 'xvnm htse yqtt pgqm';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Get Form Data
    $userEmail = $_POST['email'];  // User ka email jo form me likha hai
    $userfirst_Name = $_POST['first_name'];    // User ka naam
    $userlast_Name = $_POST['last_name'];    // User ka naam
    $userphone = $_POST['phone'];    // User ka naam
    $message = $_POST['message'];  // User ka message

    //Recipients
    $mail->setFrom('faseehraza29@gmail.com', 'contact-form');
    $mail->addAddress('faseehraza644@gmail.com', 'faseeh raza');     //Add a recipient
    $mail->Subject = 'Contact Form';
    $mail->Body    = "First_Name: $userfirst_Name\nLast_Name $userlast_Name\nEmail: $userEmail\nphone: $userphone\nMessage: $message";
    $mail->send();

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->clearAddresses();  // Purani addresses hatao
    $mail->addAddress($userEmail);  // User ka email
    $mail->Subject = 'Contact Form';
    $mail->Body    = "First_Name: $userfirst_Name\nLast_Name $userlast_Name\nEmail: $userEmail\nphone: $userphone\nMessage: $message";
    $mail->send();

    $mail->send();
    echo "<div id='success'> Thank you </div>";
} catch (Exception $e) {
    echo "<div id='alert'> Message could not be sent</div>";
}
}