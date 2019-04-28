<?php

$serevername = "localhost";
$usernameS = "root";
$password = "12345";
$dbname = "todo app";



try {
  $conn = new PDO("mysql:host=$serevername;dbname=$dbname",$usernameS,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    //todo delete
    //DELETE DATA
    if (isset($_POST['delete'])) {
      // code...
       $delete_id = $_POST['delete_id'];
       $stmt = $conn ->prepare("DELETE FROM tasks WHERE id = :id");
       $stmt->bindParam(':id', $delete_id);
       $stmt->execute();

       //REDIRECT THE USER
       header("location: todoadd.php");
    }

    //todo add
    if (isset($_POST['add'])) {
      // code...
    $task =filter_var($_POST['task'] , FILTER_SANITIZE_STRING);
    $work  =filter_var($_POST['work'],FILTER_SANITIZE_STRING);
    $user_id = $_POST['user_id'];
    $stmt = $conn ->prepare("INSERT INTO tasks (user_id,task,work ) VALUES (:user_id,:task,:work)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':task', $task);
    $stmt->bindParam(':work', $work);
    $stmt->execute();

    //REDIRECT THE USER
    header("location: todoadd.php");
    }


} catch (PDOException $e) {
  echo "Connection Failed :".$e->getMessage();

}

//Disconnect
$conn = null;
 ?>





















 <!-- AKSHAY JADHAV -->
