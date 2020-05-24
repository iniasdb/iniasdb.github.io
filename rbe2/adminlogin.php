<html>

<head>
<title>RBE | admin login</title>
<link rel = 'stylesheet' type = 'text/css' href = 'style_rbe.css' />
<meta name = 'viewport' content = 'width=device-width, initial-scale=1.0'>

<!-- favicon -->
<link rel = 'apple-touch-icon' sizes = '57x57' href = 'favicon/apple-icon-57x57.png'>
<link rel = 'apple-touch-icon' sizes = '60x60' href = 'favicon/apple-icon-60x60.png'>
<link rel = 'apple-touch-icon' sizes = '72x72' href = 'favicon/apple-icon-72x72.png'>
<link rel = 'apple-touch-icon' sizes = '76x76' href = 'favicon/apple-icon-76x76.png'>
<link rel = 'apple-touch-icon' sizes = '114x114' href = 'favicon/apple-icon-114x114.png'>
<link rel = 'apple-touch-icon' sizes = '120x120' href = 'favicon/apple-icon-120x120.png'>
<link rel = 'apple-touch-icon' sizes = '144x144' href = 'favicon/apple-icon-144x144.png'>
<link rel = 'apple-touch-icon' sizes = '152x152' href = 'favicon/apple-icon-152x152.png'>
<link rel = 'apple-touch-icon' sizes = '180x180' href = 'favicon/apple-icon-180x180.png'>
<link rel = 'icon' type = 'image/png' sizes = '192x192' href = 'favicon/android-icon-192x192.png'>
<link rel = 'icon' type = 'image/png' sizes = '32x32' href = 'favicon/favicon-32x32.png'>
<link rel = 'icon' type = 'image/png' sizes = '96x96' href = 'favicon/favicon-96x96.png'>
<link rel = 'icon' type = 'image/png' sizes = '16x16' href = 'favicon/favicon-16x16.png'>
<link rel = 'manifest' href = 'favicon/manifest.json'>
<meta name = 'msapplication-TileColor' content = '#ffffff'>
<meta name = 'msapplication-TileImage' content = 'favicon/ms-icon-144x144.png'>
<meta name = 'theme-color' content = '#ffffff'>
<!-- end favicon -->

</head>

<body>
<div class = 'header'>
<a alt = 'logo' href = 'home.html'><img id = 'logo' src = 'images/logo.png' />
<div class = 'nav'>
<ul>
<li><a href = 'home.html'>HOME</a></li>
<li><a href = 'music.html'>MUSIC</a></li>
<li><a href = 'calendar.html'>CALENDAR</a></li>
<li><a href = 'news.html'>NEWS</a></li>
<li><a href = 'contact.php'>CONTACT</a></li>
</ul>
</div>
</div>

<div class = 'login'>
<form action = '' method = 'POST'>
username:<br> <input type = 'text' name = 'adminuser'><br>
password:<br> <input type = 'password' name = 'adminpass'><br>
<button type = 'submit' name = 'submit'>submit</button>
</form>

<?php
session_start();

//connect to db

$dbhostname = 'localhost';
$dbusername = 'root';
$dbpassword = 'usbw';

$dbConnected = @mysql_connect( $dbhostname, $dbusername, $dbpassword );
$dbSelected = @mysql_select_db("rbe",$con);

$dbSuccessfull = true;
if ( $dbConnected ) {
} else {
    $dbSuccessfull = false;
}

//get credentials and secure from sql injection

if ( isset( $_POST['submit'] ) ) {

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $user = test_input($_POST['adminuser']);
    $pass = test_input($_POST['adminpass']);

/*    $user = strip_tags( $_POST['adminuser'] );
    $pass = strip_tags( $_POST['adminpass'] );

    $user = stripslashes( $user );
    $pass = stripslashes( $pass );*/

    $pass = md5( $pass );
        
    $sql = "
    SELECT *
    FROM rbe.adminusers
    WHERE Username = 'root'
    LIMIT 1 
    " ;

    $result = mysql_query($sql);
    if ($result === false) {
        echo "ja da werkt ni eh";
    }

    $row = mysql_fetch_array($result, MYSQL_NUM);
    $id = $row[0];
    $db_user = $row[1];
    $db_password = $row[2];

    if ($pass == $db_password && $user == $db_user) {
        $_SESSION['Username'] = $user;
        $_SESSION['ID'] = $id;
        header("location: messages.php");

    } else {
        echo "wrong credentials";
    }
}

?>
</div>

</body>

</html>