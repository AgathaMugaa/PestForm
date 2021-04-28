<!DOCTYPE html>
<html>
<head>
<title>Clean house</title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="style.css">
<style>
h1{
    text-align: center;
}

</style>
</head>
<body>
<section>
<h1>CleanHouse</h1>
<div class='pest-control-form'>
    <h5>Fill in the following form to request for pest control</h5></br>
    <form method='POST' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <input type='text' class='form-control' name='name' placeholder='Name' required='required'></br>
        <input type='radio' name='gender' value='male'> Male  <input type='radio' name='gender' value='female' style='margin-left: 20px;'> Female <input type='radio' name='gender' value='others' style='margin-left: 20px;'> Others</br></br>
        <input type='text' class='form-control' name='house' placeholder='House number' required='required'></br>
        <input type='number' class='form-control' name='phone' placeholder='Phone' required='required'></br>
        <input type='email' class='form-control' name='email' placeholder='Email' required='required'></br>
        <select name='pest' class='form-control'>
            <option>Select pest to control</option>
            <option value='cockroaches'>Cockroaches</option>
            <option value='rats'>Rats</option>
            <option value='pet'>Pet</option>
            <option value='pest'>Pest</option>
        </select></br>
        <button class='btn btn-success' type='submit' name='submitForm'>Submit</button>
    </form>
</div>
<?php 

      if(isset($_POST['submitForm'])){
          $name   = $_POST['name'];
          $gender = $_POST['gender'];
          $house  = $_POST['house'];
          $phone  = $_POST['phone'];
          $email  = $_POST['email'];   

          echo "
          
                    <div class='user-data'>
                        <h2>User's data</h2></br>
                        <p><b>Name:</b> $name</p>
                        <p><b>Gender:</b> $gender</p>
                        <p><b>House number:</b> $house</p>
                        <p><b>Phone number:</b> $phone</p>
                        <p><b>Pest to control:</b> $email</p>
                    </div>

               ";

      }

?>
</section>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>