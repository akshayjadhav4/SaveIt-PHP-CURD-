
<?php
session_start();
$serevername = "localhost";
$usernameS = "root";
$password = "12345";
$dbname = "todo app";
$errors = array();


try {
  $conn = new PDO("mysql:host=$serevername;dbname=$dbname",$usernameS,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['signup'])){
      $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
      $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      $password_1 = $_POST['password'];
      $password_2 = $_POST['password_confirm'];



      if ($password_1 != $password_2 )
      {
        array_push($errors, "The two passwords do not match");
        $_SESSION["message"] = "The two passwords does not match.";
        $_SESSION["msg_type"] = "danger";
      }

      $stmt = $conn->query("SELECT * FROM account WHERE username='$username'");
      $stmt->execute();
      // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $num_rows = $stmt->fetchColumn();
      // echo "string : ".$num_rows;
      // echo "<br><pre>".print_r($num_rows)."</pre>";
      if ($num_rows>0) {
            // code...
            $_SESSION["message"] = "This Username already exists.";
            $_SESSION["msg_type"] = "danger";
            header('Location:signup.php');

          } else {
            // code...
            // TO REGISTER USER
            if (count($errors) == 0) {
              // code...
              $hashed_password = password_hash($password_1, PASSWORD_DEFAULT);

              // prepare sql and bind parameters
               $stmt = $conn ->prepare("INSERT INTO account (username, email,password)
               VALUES (:username,:email,:password)");
               $stmt->bindParam(':username', $username);
               $stmt->bindParam(':email', $email);
               $stmt->bindParam(':password', $hashed_password);
               $stmt->execute();
               $_SESSION["message"] = "Account is created.";
               $_SESSION["msg_type"] = "success";
            }
            header('Location:signup.php');
          }
    }

    //LOGIN
    if (isset($_POST['login'])) {
      $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
      $password_1 = $_POST['password'];
      $query = "SELECT * FROM account WHERE username = :username";
          $stmt = $conn->prepare($query);
          $stmt->bindParam(':username', $username);
          $stmt->execute();
          $data = $stmt->fetch();
          $user = $data['username'];
          $email = $data['email'];
          $ID = $data['id'];
          $hashed_password = $data['password'];
          if (password_verify($password_1,$hashed_password)) {
            // code...
            $_SESSION['is_login']= true;
            $_SESSION['USERNAME'] = $user;
            $_SESSION['USER_ID'] = $ID;
            header('Location:todoadd.php');
          }else {
            // code...

            $_SESSION["message"] = "Wrong username or password.";
            $_SESSION["msg_type"] = "danger";
            header('Location:login.php');

          }
    }
    if (isset($_POST['logout'])){
      session_destroy();
      header('Location:login.php');

    }

} catch (PDOException $e) {
  echo "Connection Failed :".$e->getMessage();

}

//Disconnect
$conn = null;
 ?>


































 <!-- AKSHAY JADHAV -->
