<?php 
//this file is for otp validation purpose in php
$otp;
function generateotp(){
global $otp;
$otp= rand(1000,9999);
if(!$_COOKIE['otp']){
setcookie('otp',$otp);
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
</head>
<body>
  <?php if($_COOKIE['otp']){

    echo $_COOKIE['otp'];
    
  }?>
    <form method="post">
        <button type="submit" name="generat">Generate Otp</button>
    </form>
    <form action="" method="post" id="otp1">
        <fieldset>
            <legend>
                Enter OTP:
            </legend>

            <label for="otp">Please Provide the OTP</label>
            <input type="number" name="otp" id="otp">
            <input type="submit" name="verify">
        </fieldset>
    </form>
</body>

<?php 
if(isset($_POST['generat'])){
    generateotp();
    header('location:checkotp.php');

}
if(isset($_POST['verify'])){
    $getcok = $_COOKIE['otp'];
    if($_POST['otp']==$getcok){
        echo "<script>alert('Success');</script>";
        setcookie('otp',"",time()-3600);
        echo "<script>location.href='checkotp.php'</script>";
        
        
    }
    else{
        echo "<script>alert('Failed');location.href='checkotp.php'</script>";
    }
}
?>

</html>