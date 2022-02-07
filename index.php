<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Signin Template · Bootstrap v5.1</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/"> -->

    

    <!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .alert {
        font-size: 0.9em;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
<form method="POST" action="index.php">
    <img class="mb-4" src="assets/img/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

      <?php
        include (dirname(__FILE__) .'\app\connection.php');
        if ( isset($_POST['email'], $_POST['password']) ) {
          $email=$_POST['email'];
          $password=$_POST['password'];


          $sql="select * from loginform where email='".$email."'AND password='".$password."' limit 1";
          $result = $conn->query($sql);

          if ($result->num_rows > 0){
              header("Location: http://localhost/signindemo/app/product.php");
              exit();
          }  else {
              $sqlEmail="select * from loginform where email='".$email."' limit 1";
              $resultEmail = $conn->query($sqlEmail);

              if ($resultEmail->num_rows == 0){
                echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">User does not exists.
                Please register first.
                </div>';                              
              } else {                  
                  echo'
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">Your email/password is incorrect</div>';                                
              }         
          }    

          if(isset( $_POST['submit'] )) {
          // your complete rest php code goes here to insert the record
          }
        }
      ?>  

      <div class="checkbox mb-3 left">
        <label> Not registered yet? Click <a href="app/register.php">here</a> to Register
        </label>
      </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2022</p>

  </form>
</main>


    
  </body>
</html>
