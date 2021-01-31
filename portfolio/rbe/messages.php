<?php

session_start();
if ( !isset( $_SESSION['ID'] ) ) {
    header( 'Location: adminlogin.php' );
}

$dbhostname = 'localhost';
$dbusername = 'root';
$dbpassword = 'usbw';

$dbConnected = @mysql_connect( $dbhostname, $dbusername, $dbpassword );
$dbSelected = @mysql_select_db( 'rbe', $con );

$dbSuccessfull = true;
if ( $dbConnected ) {
} else {
    $dbSuccessfull = false;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>RBE | messages</title>
<link rel = 'stylesheet' type = 'text/css' href = 'style_rbe.css' />

</head>
<body style = 'background-color:white;'>

<div class = 'adminnav'>
<ul>
<li><a>Adminpanel</a></li>
<li><a href = 'logout.php'>Log out</a></li>
<li><a href = 'home.html'>Home</a></li>
</ul>
</div>

<div class = 'messages'>
<?php
$sql = "
SELECT *
FROM rbe.messages
";

$result = mysql_query( $sql );
if ( $result === false ) {
    echo 'ja da werkt ni eh';
}

echo "
<table>
    <tr class='legend'>
        <td class='test'>id</td>
        <td>voornaam</td>
        <td>achternaam</td>
        <td>email</td>
        <td>onderwerp</td>
        <td>bericht </td>
    </tr>   
";

while ( $row = mysql_fetch_array( $result, MYSQL_NUM ) ) {
    $id = $row[0];
    $fname = $row[1];
    $lname = $row[2];
    $email = $row[3];
    $subject = $row[4];
    $message = $row[5];

    echo "
        <tr>
            <td>$id</td>
            <td>$fname</td>
            <td>$lname</td>
            <td>$email</td>
            <td>$subject</td>
            <td>$message</td>
        </tr>   
    ";
}

echo '</table>'
?>

</div>

</body>
</html>