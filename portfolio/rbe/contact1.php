<?php

$hostname = 'localhost';
$username = 'root';
$password = 'usbw';

$dbConnected = @mysql_connect( $hostname, $username, $password );

$dbSuccessfull = true;
if ( $dbConnected ) {
} else {
    $dbSuccessfull = false;
}

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

//echo $fname.' '.$lname.' '.$email.' '.$subject.' '.$message;

if ( $dbSuccessfull ) {

    $sql_create_database = 'CREATE DATABASE rbe';
    $sql_create_table = "CREATE TABLE rbe.messages (
        ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        Fname varchar(255),
        Lname varchar(225),
        Email varchar(255),
        Subj varchar(255),
        Mess varchar(255)
    )";
    $sql_insert_data = "INSERT INTO `rbe`.`messages` (
        ID ,
        Fname,
        Lname ,
        Email,
        Subj,
        Mess
        )
        VALUES (
        NULL , '".$fname."' , '".$lname."' , '".$email."' , '".$subject."' , '".$message."'
        )
    
    ";

    if ( mysql_query( $sql_create_database ) ) {
        //echo 'created db<br>';
        if ( mysql_query( $sql_create_table ) ) {
            //echo 'created table<br>';
        } else {
            //echo 'failed to create table<br>';
        }
    } else {
        //echo 'failed to create db<br>';
    }

    if ( mysql_query( $sql_insert_data ) ) {
        //echo 'data inserted';
    } else {
        echo 'insert failed';
    }

}

?>