<?php
$name = $_POST['name'];
$email_subject = "New Form submission";
$message = $_POST['message'];

$email_body = "You have received a new message from the user $name.\n". "Here is the message:\n $message".

$to = "inias.debelder@gmail.com";
mail($to,$email_subject,$email_body);
?>