 <?php
     session_start();

     if (!isset($_SESSION['USERNAME'])){
       header('Location:login.php');
     }

  ?>
  <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>TODO APP</title>
  </head>
  <body>
    <?php require 'addprocess.php'; ?>
    <?php
      try {
        $conn = new PDO("mysql:host=$serevername;dbname=$dbname",$usernameS,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $task ='';
        $work = '';
        $user_id = $_SESSION['USER_ID'];

        // FETCH DATA
        $stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id='$user_id'");
        $stmt->execute();
        // set the resulting array to associative
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

      } catch (PDOException $e) {
         echo "Error: " . $e->getMessage();
      }

    ?>
    <div class="">
      <header class="masthead mb-auto">
        <div class="inner">
          <div class="row">
            <div class="col-6">
              <h3 class="masthead-brand">Save It</h3>
            </div>
            <div class="col-6">
              <form class="float-right" action="accountcreation.php" method="post">
              <button class="btn btn-dark" type="submit"name="logout">LOGOUT</button>
              </form>
            </div>
          </div>
          <nav class="nav nav-masthead justify-content-center">
            <h5 class="lead">Welcome</h5>
            <h6 class="text-muted"><?php echo $_SESSION['USERNAME'];  ?></h6>
          </nav>
        </div>

      </header>
    </div>
    <hr>
    <div class="container">
      <a href="add.php" class="btn btn-success">TODO</a>
      <br>
      <br>
      <div class="row">
        <div class="table-responsive">
          <table class="table table-striped">
      <thead>
        <tr>
          <th class="text-center">Title</th>
          <th class="text-center">Description/th>
          <th class="text-center">Time</th>
          <th class="text-center">Action</th>

        </tr>
      </thead>
      <tbody>
        <?php try{
         foreach ($stmt->fetchAll() as $key => $value) {
        ?>
        <tr>
          <td><?php  echo $value['task']; ?></td>
          <td><?php  echo $value['work']; ?></td>
          <td><?php  echo $value['time']; ?></td>
          <td>
            <form class="" action="addprocess.php" method="post">
              <input type="hidden" name="delete_id" value="<?php echo $value['id']; ?>">
              <button type="submit" class="btn btn-danger mb-2" name="delete">Delete</button>
            </form>
          <td/>
          <td>
            <form class="" action="update.php" method="post">
              <input type="hidden" name="edit_id" value="<?php echo $value['id']; ?>">
              <button type="submit" class="btn btn-info mb-2" name="edit">EditIt</button>
            </form>
          </td>
        </tr>
      </tbody>
    <?php }
                 } catch (PDOException $e) {
                   //throw $th;
                   echo "Connection failed: " . $e->getMessage();

                 }
                   $conn = null;
                 ?>
    </table>
        </div>
      </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
