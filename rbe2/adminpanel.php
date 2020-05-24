<?php
session_start();
if ( !isset( $_SESSION['ID'] ) ) {
    header( 'Location: adminlogin.php' );
}

error_reporting( 0 );

//connect to db

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
<title>adminpanel</title>
<link rel = 'stylesheet' type = 'text/css' href = 'style_rbe.css' />
</head>
<body style = 'background-color: #c8c8c8;'>

<div class = 'adminnav'>
<ul>
<li><a href = 'messages.php'>Messages</a></li>
<li><a href = 'logout.php'>Log out</a></li>
<li><a href = 'home.html'>Home</a></li>
</ul>
</div>

<div class = 'editMusic'>
<h1 class = 'define'>Add new music</h1>
<form action = '' method = 'POST' enctype = 'multipart/form-data'>
cover art: <input type = 'file' name = 'coverPic' id = 'coverPic'><br>
link naar streaming site: https://<input type = 'text' id = 'link'><br>
naam van track: <input type = 'text' id = 'trackname'><br>
<button type = 'submit' name = 'submitCoverPic' onclick = 'createHtmlCoverCode()'>Submit</button>
</form>

<script>
var filenameCover;
var htmlCover;

function getCoverPic() {
    var fu1 = document.getElementById( 'coverPic' );
    var path = fu1.value;
    filenameCover = path.substr( 12, path.length );
}

function createHtmlCoverCode() {
    var linkCover = document.getElementById( 'link' ).value;
    var track = document.getElementById( 'trackname' ).value
    var trackName = track.charAt( 0 ).toUpperCase() + track.slice( 1 );
    getCoverPic();
    htmlCover = '<a href=\"https://' + linkCover + '\" target=\"_blank\"><img alt=\"track: ' + trackName.replace( "'", "\'" ) + '\" src=\"music/' + filenameCover + '\"></a>';

    alert( htmlCover );
}

</script>

<?php

if ( isset( $_POST['submitCoverPic'] ) ) {
    $info = $_POST['info'];
    //$link = music/;
}

$target_dir = 'music/';
$target_file = @$target_dir . basename( $_FILES['coverPic']['name'] );
echo $_FILES['coverPic']['name'];
$uploadOk = 1;
$imageFileType = strtolower( pathinfo( $target_file, PATHINFO_EXTENSION ) );

// Check if image file is a actual image or fake image
if ( isset( $_POST['submitCoverPic'] ) ) {
    $check = getimagesize( $_FILES['coverPic']['tmp_name'] );
    if ( $check !== false ) {
        echo '<br>File is an image - ' . $check['mime'] . '.';
        $uploadOk = 1;
    } else {
        echo '<br>File is not an image.';
        $uploadOk = 0;
    }
}

// Check if $uploadOk is set to 0 by an error
if ( $uploadOk == 0 ) {
    echo '<br>Sorry, your file was not uploaded.';
    // if everything is ok, try to upload file
} else {
    if ( move_uploaded_file( $_FILES['coverPic']['tmp_name'], $target_file ) ) {
        echo '<br>The file '. basename( $_FILES['coverPic']['name'] ). ' has been uploaded.';
    } else {
        //echo '<br>Sorry, there was an error uploading your file.';
    }
}

if ( !empty( $_POST ) ) {
    header( "location:$URI" );
}

?>
</div>
<hr>
<div class = 'editCalendar'>
<h1>Add event</h1><br>
<form action = '' method = 'POST' enctype = 'multipart/form-data'>
event foto: <input type = 'file' name = 'eventPic' id = 'eventPic'><br>
event link: https://<input type = 'text' id = 'eventLink'><br>
event naam: <input type = 'text' id = 'eventName'><br>
event datum: <input type = 'text' id = 'date'><br>
<button type = 'submit' name = 'submitEventPic' onclick = 'createHtmlEventCode()'>Submit</button>
</form>

<script>
var filenameEvent;
var htmlEvent;

function getEventPic() {
    var fu1 = document.getElementById( 'eventPic' );
    var path = fu1.value;
    filenameEvent = path.substr( 12, path.length );
}

function createHtmlEventCode() {
    var eventLink = document.getElementById( 'eventLink' ).value;
    var event = document.getElementById( 'eventName' ).value;
    var eventName = event.toUpperCase();
    var eventDate = document.getElementById( 'date' ).value;
    getEventPic();
    htmlEvent = '<a href=\"https://' + eventLink + '\" target=\"_blank\"><img alt=\"' + eventName + '\" src=\"events/' + filenameEvent + '\"></a> \n <h1>' + eventName + ' - ' + eventDate + '</h1><hr>';
    alert( htmlEvent );
}

</script>

<?php
$target_dir = 'events/';
$target_file = @$target_dir . basename( $_FILES['eventPic']['name'] );
$uploadOk = 1;
$imageFileType = strtolower( pathinfo( $target_file, PATHINFO_EXTENSION ) );
// Check if image file is a actual image or fake image
if ( isset( $_POST['submitEventPic'] ) ) {
    $check = getimagesize( $_FILES['eventPic']['tmp_name'] );
    if ( $check !== false ) {
        echo '<br>File is an image - ' . $check['mime'] . '.';
        $uploadOk = 1;
    } else {
        echo '<br>File is not an image.';
        $uploadOk = 0;
    }
}

// Check if $uploadOk is set to 0 by an error
if ( $uploadOk == 0 ) {
    echo '<br>Sorry, your file was not uploaded.';
    // if everything is ok, try to upload file
} else {
    if ( move_uploaded_file( $_FILES['eventPic']['tmp_name'], $target_file ) ) {
        echo '<br>The file '. basename( $_FILES['eventPic']['name'] ). ' has been uploaded.';
    } else {
        //echo '<br>Sorry, there was an error uploading your file.';
    }
}
?>
</div>
<hr>
<div class = 'editNews'>
<h1>Nieuwsbericht toevoegen</h1><br>
<form action = '' method = 'POST' enctype = 'multipart/form-data'>
titel: <input type = 'text' id = 'title'><br>
bericht: <br><textarea id = 'message' name = 'message' rows = '10' cols = '30'></textarea><br>
<button type = 'submit' name = 'submitNews' onclick = 'createHtmlNewsCode()'>Submit</button>
</form>

<script>
var htmlNews;

function createHtmlNewsCode() {
    var title = document.getElementById( 'title' ).value;
    var message = document.getElementById( 'message' ).value;
    getEventPic();
    htmlNews = '<h1>' + title + '</h1>\n<p>' + message +  '</p>\n<hr>';
    alert( htmlNews );
}

</script>

</div>
</body>
</html>