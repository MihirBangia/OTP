<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//this file is for otp validation purpose in php
$otp;


function generateotp()
{
    global $otp;

    $otp = rand(1000, 9999);
    if (!$_COOKIE['otp']) {
        setcookie('otp', $otp);
        $email = $_POST['email'];

        //sending mail to user


        //Load Composer's autoloader
        require 'vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = 'geekytest123@gmail.com'; //SMTP username
            $mail->Password = 'eiuzoosjhbbsireo'; //SMTP password
            $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
            $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('geekytest123@gmail.com', 'Test Test');
            $mail->addAddress($email); //Add a recipient               //Name is optional




            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'OTP For Validation';
            $mail->Body = "Hiii Your One Time Password for validation is:<b>$otp</b>";
            

            $mail->send();
            echo 'Email has been sent';
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #otp1{
            margin-top: 150px;
        }
    </style>
</head>

<body>

    <form method="post">

        <fieldset>
        <label for="email">Please Enter email where you want to recieve otp:</label>
        <input type="email" name="email" id="email" required> <br> <hr>
    
        <button type="submit" name="generat">Generate Otp</button>
        </fieldset>
       
    </form>


    <form action="" method="post" id="otp1">
        <fieldset>
            <legend>
                Enter OTP:
            </legend>


            <label for="otp">Please Provide the OTP</label>
            <input type="number" name="otp" id="otp" required>  <br> <hr>
            <input type="submit" name="verify">
        </fieldset>
    </form>
</body>

<?php
if (isset($_POST['generat'])) {
    generateotp();
    header('location:otp.php');

}
if (isset($_POST['verify'])) {
    $getcok = $_COOKIE['otp'];
    if ($_POST['otp'] == $getcok) {
        echo "<script>alert('Success');</script>";
        setcookie('otp', "", time() - 3600);
        echo "<script>location.href='otp.php'</script>";


    } else {
        echo "<script>alert('Failed');location.href='otp.php'</script>";
    }
}
?>

</html>