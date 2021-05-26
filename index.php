<?php

session_start();
require 'connect.php';

?>
<!DOCTYPE html>
<html>
<head>
<title>Clean house</title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<section>
<div class='pest-control-form'>
    <h5>Log in to your account</h5></br>
    <form method='POST' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <input type='email' class='form-control' name='email' placeholder='Email' required='required'></br>
        <input type='password' class='form-control' name='password' placeholder='password' required='required'></br>
        <button class='btn btn-success' type='submit' name='submitForm'>Sigin in</button></br>
    </form>
<?php 

      if(isset($_POST['submitForm'])){
          $email   = $_POST['email'];
          $password = $_POST['password'];

          $fetch_user = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
          $execute = mysqli_query($conn,$fetch_user);
          if(mysqli_num_rows($execute) > 0){
              while($row = mysqli_fetch_assoc($execute)){
                  $_SESSION['user_id'] = $row['user_id'];
                  if($row['role'] === 'Admin'){
                    header("location: admin_dashboard.php");
                  }
                  else{
                    header("location: user_dashboard.php");
                  }
              }
          }
          else{
              echo "
                       <div class='alert alert-danger'>
                          Incorrect email or password!
                       </div></br>
                   ";
          }
          
      }

?>
</div></br>
</section>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>