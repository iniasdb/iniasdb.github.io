<!DOCTYPE html>
<html>

<head>
  <title>RBE | contact</title>
  <link rel="stylesheet" type="text/css" href="style_rbe.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- favicon -->
  <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <link rel="manifest" href="favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- end favicon -->

</head>

<body>
  <div class="header">
    <a alt="logo" href="home.html"><img id="logo" src="images/logo.png" /></a>
      <div class="nav">
        <ul>
          <li><a href="home.html">HOME</a></li>
          <li><a href="music.html">MUSIC</a></li>
          <li><a href="calendar.html">CALENDAR</a></li>
          <li><a href="news.html">NEWS</a></li>
          <li><a href="contact.php">CONTACT</a></li>
        </ul>
      </div>
  </div>

  <div class="text">
    <h1>Contact</h1><br>
    <p><br><br><br>U kunt contact met mij opnemen via het formulier of door een e-mail te sturen naar
      contact@rbemusic.com <br><br><br><br><br><br><br>You can contact me through the form or by sending an e-mail to
      contact@rbemusic.com</p>
  </div>

  <?php
  if ( !empty( $_POST ) ) {
    header( "location:$URI" );
  }

  if (isset($_POST['submit'])) {
    $hostname = "localhost";
    $username = "root";
    $password = "usbw";

    $dbConnected = @mysql_connect($hostname, $username, $password);
    
    $dbSuccessfull = true;
    if ($dbConnected) {
    } else {
      $dbSuccessfull = false;
    }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    
    if (empty($_POST["fname"]) || empty($_POST['lname']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
      $err = "* fields are required";
      $allfieldsfilled = false;
    } else {
      $allfieldsfilled = true;
    }
  

    $fname = test_input($_POST['fname']);
    $lname = test_input($_POST['lname']);
    $email = test_input($_POST['email']);
    $subject = test_input($_POST['subject']);
    $message = test_input($_POST['message']);

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }

    //echo $fname." ".$lname." ".$email." ".$subject." ".$message;

    if ($dbSuccessfull) {

      $sql_create_database = "CREATE DATABASE rbe";
      $sql_create_table = "CREATE TABLE rbe.messages (
          ID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
          Fname varchar(255),
          Lname varchar(225),
          Email varchar(255),
          Subj varchar(255),
          Mess varchar(1000),
          Ip varchar(255)
      )";
      $sql_insert_data = "INSERT INTO `rbe`.`messages` (
          ID ,
          Fname,
          Lname ,
          Email,
          Subj,
          Mess,
          Ip
          )
          VALUES (
          NULL , '".$fname."' , '".$lname."' , '".$email."' , '".$subject."' , '".$message."','".$ip."'
          )";

      if (mysql_query($sql_create_database)) {
        //echo "created db<br>";
        if (mysql_query($sql_create_table)) {
            //echo "created table<br>";
        } else {
            //echo "failed to create table<br>";
        }
      } else {
        //echo "failed to create db<br>";
      }


      if ($allfieldsfilled) {
        if (mysql_query($sql_insert_data)) {
          //echo "data inserted";
        } else {
          echo "insert failed";
        }
      } else {
        echo "<script>alert('* is required');</script>";
      }

  }
}

?>

  <div class="form">
    <form action="" method="POST">
      <fieldset>
        <label><span>*</span> First Name</label><input type="text" id="fname" name="fname">
        <label><span>*</span> Last Name</label><input type="text" id="lname" name="lname"><br>
        <label><span>*</span> Email</label><input type="text" id="email" name="email"><br>
        <label><span>*</span> Subject</label><input type="text" id="subject" name="subject"><br>
        <label><span>*</span> Message</label><textarea id="message" name="message" rows="10" cols="30"></textarea><br>
        <button type="submit" name="submit">Submit</button>
      </fieldset>
    </form>
  </div>

</div>

  <div class="footer">
    <hr>
    <a href="https://open.spotify.com/artist/5dXbGfYJ54FZVAsn7ZMcRo?si=XdPpaHDmQN-ktO9UVE9Huw" target="_blank"><img
        alt="spotify logo" src="images/spotify-logo.png"></a>
    <a href="https://anchor.fm/ruben-elsen/episodes/RBE-Rap-mixmashup-DAW-ebmkb7/a-a1nrsg6" target="_blank"><img
        alt="anchor logo" src="images/anchor-logo.jpg"></a>
    <a href="https://soundcloud.com/user-933801604-812886564" target="_blank"><img alt="soundcloud logo"
        src="images/soundcloud-logo.png"></a>
    <a href="https://www.facebook.com/RBERubenElsen/photos/rpp.491087337922596/753211921710135/?type=3&theater"
      target="_blank"><img alt="facebook logo" src="images/fb.svg"></a>
    <a href="https://www.instagram.com/rbeofficialmusic/?hl=nl" target="_blank"><img alt="instagram logo"
        src="images/insta.svg"></a>
  </div>

  <a href="messages.php"><div class="gotologin"></div></a>


</body>

</html>