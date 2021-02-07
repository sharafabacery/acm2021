<?php
session_start();
include "../config/database.php";
include "../classes/elderly.php";
?>

<form action="login_elder.php" method="post">
  <label for="email">email</label>
  <input type="text" id="email" name="email"><br>
  <label for="password">password</label>
  <input type="text" id="password" name="password"> <br>
  <input type="submit">


</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $db = new Database();
  $connection = $db->connect();
  $Elder = new Elderly($connection);

  $Elder->email = $_POST['email'];
  $Elder->password = $_POST['password'];

  $email_data = $Elder->check_login();

  if (empty($email_data)) {
    echo " NO USER FOUND";
  } else {
   
    if($email_data['password']==$Elder->password ){
         $_SESSION['id'] = $email_data['id'];
          print_r($email_data);
    echo $email_data['id'];
    //<a href='/hackathon/frontent/login_elder.php'></a>
    header("Location:/hackathon/frontend/caretaker.php");
    echo "";
    }else{
      echo "invalid data";
    }
 
  }
}



?>