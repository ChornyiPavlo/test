<?php

/*$EmailTo = "info@radiustheme.com";*/
$EmailTo = "techlabpro7@gmail.com";

$Subject = "New Message Received";



$errorMSG = "";

$name = $email = $message = null;

 

// NAME

if (empty($_POST["name"])) {

    $errorMSG = "Name is required ";

} else {

    $name = $_POST["name"];

}

 

// EMAIL

if (empty($_POST["email"])) {

    $errorMSG .= "Email is required ";

} else {

    $email = $_POST["email"];

}

// SUBJECT

if (empty($_POST["subject"])) {

    $errorMSG .= "Subject is required ";

} else {

    $email = $_POST["subject"];

}

// MESSAGE

if (empty($_POST["message"])) {

    $errorMSG .= "Message is required ";

} else {

    $message = $_POST["message"];

}

 

// prepare email body text

$Body .= "Name: ";

$Body .= $name;

$Body .= "\n";


$Body .= "Email: ";

$Body .= $email;

$Body .= "\n";


$Body .= "Subject: ";

$Body .= $subject;

$Body .= "\n";
 

$Body .= "Message: ";

$Body .= $message;

$Body .= "\n";

 

// send email

if($name && $email && $message){

	$success = mail($EmailTo, $Subject, $Body, "From:".$email);

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