<?php

$EmailTo = "info@radiustheme.com";
$Subject = "CheckOur Registration";

$errorMSG = "";
$url = $email = null;
// NAME
if (empty($_POST["url"])) {
    $errorMSG = "Url is required ";
} else {
    $url = $_POST["url"];
}
 
// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "Email is required ";
} else {
    $email = $_POST["email"];
}

 
// prepare email body text
$Body = null;
$Body .= "<p><b>URL:</b> {$url}</p>";
$Body .= "<p><b>Email:</b> {$email}</p>";

 

// send email
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: <' . $email .'>' . " \r\n" .
            'Reply-To: '.  $EmailTo . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

if($url && $email){
    $success = mail($EmailTo, $Subject, $Body, $headers );
}else{
    $success = false;
}


if ($success && $errorMSG == ""){
   echo "success";
}else{
    if($errorMSG == ""){
        echo "Something went wrong :(";
    } else {
        echo $errorMSG;
    }
} 