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
    <?php require 'accountcreation.php'; ?>
    <?php require 'nav.php'; ?>
    <div class="container">
      <?php
      if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-<?=$_SESSION['msg_type']; ?>" role="alert">
          <?php echo $_SESSION['message'];
          // remove all session variables
          session_unset();
          // destroy the session
          session_destroy();
           ?>
        </div>
      <?php endif  ?>
      <div class="card">
        <div class="card-header">
          SIGN UP
        </div>
        <div class="card-body">
          <form action="accountcreation.php" method="post" autocomplete="off">
            <div class="form-group">
              <label for="for username">UserName</label>
              <input type="text" class="form-control" name="username" required placeholder="Enter a User Name">
            </div>
            <div class="form-group">
              <label for="for username">Email</label>
              <input type="email" class="form-control" name="email" required placeholder="Enter a Email">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" required placeholder="Enter a Password">
            </div>
            <div class="form-group">
              <label for="password confirm">Confirm Password</label>
              <input type="password" class="form-control" name="password_confirm" required placeholder="Re Enter a Password">
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-info" name="signup">sign Up</button>
              <br>
              <a href="login.php">Already have an acount.</a>
            </div>
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
