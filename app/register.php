<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Signin Template · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="../assets/css/bootstrap.min.css" rel="stylesheet">

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
    </style>

    
    <!-- Custom styles for this template -->
    <link href="../assets/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form action="register.php" method="POST">
    <img class="mb-4" src="../assets/img/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Please register</h1>

    <div class="form-floating">
      <input name="fname" type="text" class="form-control" id="floatingInputFname" placeholder="" required>
      <label for="floatingInputFname">First name</label>
    </div>

    <div class="form-floating">
      <input name="lname" type="text" class="form-control" id="floatingInputLname" placeholder="" required>
      <label for="floatingInputLname">Last name</label>
    </div>

    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInputEmail" placeholder="" required>
      <label for="floatingInputEmail">Email address</label>
    </div>

    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="" required>
      <label for="floatingPassword">Password</label>
    </div>

    <?php
        include (dirname(__FILE__) .'/connection.php');

        function isEmptyString($string) {
          if(trim($string) == '') {
            return true;                          
          } 
          return false;
        }

        function isValidEmail($email) {
          return filter_var($email, FILTER_VALIDATE_EMAIL) 
              && preg_match('/@.+\./', $email);
        }

        function isValidPassword($string) {
          $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';

          if(!preg_match_all($pattern, $string)){
            return true;
          }
           return false;          
        }

        function isValidName($string) {
          $pattern ="/^([a-zA-Z']+)$/";
          if(preg_match_all($pattern, $string)){
             return true;
          }
          return false;               
        }

        if ( isset($_POST['email'], $_POST['password']) ) {
          $email=$_POST['email'];
          $password=$_POST['password'];
          $first_name=$_POST['fname'];
          $last_name=$_POST['lname'];

          // echo "First name: " .$first_name. ", Last Name:" .$last_name;

          $sqlEmail="select * from loginform where email='".$email."' limit 1";
          $result = $conn->query($sqlEmail);

          if ($result->num_rows > 0){
              // header("Location: http://localhost/signindemo/app/product.php");
              echo "User with that email already exists";
              exit();
          }  else {
              $msg = '';
              $validEmail = true;
              $validPassword = true;
              $validName = true;
              if(isEmptyString($email) || !isValidEmail($email)) {
                $validEmail = false;
                $msg="Please enter valid email";
              }

              if(isEmptyString($password) || !isValidPassword($password)) {
                $validPassword = false;
                $msg="Please enter valid password";
              }

              if(isEmptyString($first_name) || !isValidName($first_name)){
                $validName = false;
                $msg="Your First name is not valid";
              }

              if(isEmptyString($last_name) || !isValidName($last_name)){
                $validName = false;
                $msg="Your Last name is not valid";
              }
        
              if ($validEmail && $validPassword && $validName) {

                $sqlInsertLF="insert into loginform (email,password,first_name,last_name) 
                        values('".$email. "', '" . $password. "', '" . $first_name. "', '" . $last_name. "')";
                
                $resultInsertLF = $conn->query($sqlInsertLF);

                if ($resultInsertLF===TRUE){
                  echo '
                  <div class="alert alert-success alert-dismissible fade show" role="alert">User registered successfully. 
                  Please Sign in <a href="../index.php">here</a>
                  </div>';
                  exit();
                } else {
                    // Redirect to registration page and show modal to user
                    echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">Could not register user.
                    </div>';
                }
              } else {
                if ($msg !== ''){
                  echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">'. $msg. '</div>';
                }else {
                  echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">Invalid input</div>';  
                }              
              }
          }    

          }
          if(isset( $_POST['submit'] )) {
          // your complete rest php code goes here to insert the record
          }
      ?>  
          

    <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit" >Register</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
  </form>
</main>


    
  </body>
</html>
