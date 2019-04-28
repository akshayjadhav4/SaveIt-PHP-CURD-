<?php
    session_start();

    if (!isset($_SESSION['USERNAME'])){
      header('Location:login.php');
    }

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>TODO APP</title>
  </head>
  <body>
    <?php require 'addprocess.php'; ?>
    <?php
      try {
        $conn = new PDO("mysql:host=$serevername;dbname=$dbname",$usernameS,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


        if (isset($_POST['edit'])) {
          // code...
          $edit_id = $_POST['edit_id'];
          // FETCH DATA
          $sql = "SELECT * FROM tasks WHERE id=$edit_id";
          $statement = $conn->prepare($sql);
          $statement->execute();
          $result = $statement->fetchAll();
          foreach ($result as $key => $value) {}
          // echo "Title: ".$value['title'];
          // echo "Post: ".$value['body'];
        }
        //UPDATING DATA
        if (isset($_POST['save'])) {
          // code...
         $task =filter_var($_POST['task'] , FILTER_SANITIZE_STRING);
         $work  =filter_var($_POST['work'],FILTER_SANITIZE_STRING);
         $id = $_POST['edit_id'];
         $stmt = $conn ->prepare("UPDATE tasks SET task = :task , work = :work WHERE id=:id");
         $stmt->bindParam(':task', $task);
         $stmt->bindParam(':work', $work);
         $stmt->bindParam(':id', $id);
         $stmt->execute();
         header("location: todoadd.php");
         }


      } catch (PDOException $e) {
         echo "Error: " . $e->getMessage();
      }

    ?>
    <div class="container">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off">
        <div class="form-group form-row align-items-center ">
          <label for="">Event</label>
          <input type="text" class="form-control" name="task" value="<?php echo $value['task']; ?>" required>
        </div>
        <div class="form-group form-row align-items-center ">
          <label for="">Description</label>
          <textarea type="text" class="form-control" rows="5" name="work" required><?php echo $value['work']; ?></textarea>
        </div>
        <input type="hidden" name="edit_id" value="<?php echo $value['id']; ?>">
        <button type="submit" class="btn btn-primary mb-2" name="save">Save</button>
      </form>
    </div>

<?php
$conn = null;
 ?>
  </body>
</html>
