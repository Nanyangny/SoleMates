<?php
$servername = "localhost";
$username = "f36ee";
$password = "f36ee";
$DBname = "f36ee";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $DBname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// $sql = "CREATE TABLE IF NOT EXISTS feedback (
//   id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//   username VARCHAR(30) NOT NULL,
//   email VARCHAR(30),
//   category VARCHAR(30) NOT NULL,
//   question VARCHAR(1000) NOT NULL
// )";

// if (!mysqli_query($conn, $sql)) {
// 	echo "Error creating Products table: " . mysqli_error($conn);

// }

$username = $_POST['username'];
$email = $_POST['Email'];
$content = $_POST['content'];
$cate = $_POST['Category'];

$message = 'Received feedback from '.$username.' with email: '.$email."\r\n".
          'The feedback is in '.$cate.', whose content is:'.$content;

$to      = 'f36ee@localhost';
$subject = 'the subject';
$headers = 'From: f36ee@localhost' . "\r\n" .
    'Reply-To: f36ee@localhost' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers,'-ff36ee@localhost');
$sql = "INSERT INTO f36ee.feedback ( username, email, category, question) VALUES ('$username', '$email', '$cate', '$content');";
if (!mysqli_query($conn, $sql)){
  echo "Error to insert feedback: ".mysqli_error($conn);
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
   <head>
      <title>SoleMates - Redirecting</title>
      <meta http-equiv = "refresh" content = "2; url = ../contact.php" />
   </head>
   <body>
     <?php echo ("mail sent to : ".$to); ?>
      <p>Redirecting to contact us page</p>
   </body>
</html>
