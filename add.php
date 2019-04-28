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
     <div class="row justify-content-center">
          <div class="col-lg-6">
            <form action="addprocess.php" method="post" autocomplete="off">
              <div class="form-group form-row align-items-center ">
                <label for="">Event</label>
                <input type="text" class="form-control" name="task" placeholder="Enter the Task" required>
              </div>
              <div class="form-group form-row align-items-center ">
                <label for="">Description</label>
                <textarea type="text" class="form-control" rows="5" name="work" placeholder="Description" required></textarea>
              </div>
              <input type="hidden" name="user_id" value="<?php echo $_SESSION['USER_ID']; ?>">
              <button type="submit" class="btn btn-primary mb-2" name="add">ADD</button>
            </form>
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




<!-- AKSHAY JADHAV -->
