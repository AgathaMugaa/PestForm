<?php

session_start();
if (!isset($_SESSION['user_id'])) {
	header("Location: index.php");
}
require 'connect.php';

?>
<!DOCTYPE html>
<html>
<head>
<title>Clean house</title>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="style.css">
<style>
table, td {
  border: 1px solid black;
  border-collapse: collapse;
}
 td {
  padding: 15px;
}
.center {
    margin: auto;
    padding: 15px;
    width: 20%;
    border: 1px solid #E3E3E3;
    border-radius: 5px;
    background: #FFF;
    box-shadow: 4px 4px 8px 8px #E3E3E3;
    margin-top: 30px;
    display: none;
    overflow: auto;
}
.center button{
    float: right;
    margin-top: 10px;
}
</style>
</head>
<body>
<section>
   <div class='row'>
      <div class='col-md-12'>
          <div class='container'>
             <h2>Pest control requests</h2>
             <div class='request'>
               <table>
                 <tr>
                    <th><td><b>Name</b></td></th>
                    <th><td><b>Email</b></td></th>
                    <th><td><b>Phone</b></td></th>
                    <th><td><b>Gender</b></td></th>
                    <th><td><b>House number</b></td></th>
                    <th><td><b>Pest</b></td></th>
                    <th><td><b>Date</b></td></th>
                    <th><td><b>Actions</b></td></th>
                 </tr>
<?php
            $fetch_requests = "SELECT * FROM requests";
            $execute = mysqli_query($conn,$fetch_requests);
            while($row = mysqli_fetch_assoc($execute)){
                $request_id = $row['request_id'];
                $name = $row['name'];
                $gender = $row['gender'];
                $house  = $row['house_number'];
                $phone  = $row['phone'];
                $email  = $row['email']; 
                $pest = $row['pest']; 
                $date = $row['control_date']; 

                 echo "
                        <tr>
                          <th><td>$name</td></th>
                          <th><td>$email</td></th>
                          <th><td>$phone</td></th>
                          <th><td>$gender</td></th>
                          <th><td>$house</td></th>
                          <th><td>$pest</td></th>
                          <th><td>$date</td></th>
                          <th>
                             <td class='actions'>
                                <a href='admin_dashboard.php?edit_request=$request_id'>
                                   <button class='btn btn-success' name='edit-request' data-bs-toggle='modal' data-bs-target='#exampleModal'>Edit date</button> 
                                </a>
                                <a href='admin_dashboard.php?delete_request=$request_id'>
                                   <button class='btn btn-danger' type='submit' name='delete-request'>Delete</button>
                                </a>
                             </td>
                         </th>
                        </tr>
                      ";
            }
?>
                </table>
             </div>
          </div>
      </div>
   </div>
   <div class='row'>
        <div class='center' id='date'>
            <form class='update-form' method='POST' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
                <input type='date' class='form-control' name='new-date' required='required'>
                <button class='btn btn-warning' type='submit' name='update'><font color='#FFF'>Update</div></button>
            </form>
        </div>
   </div>
</section>
<?php

    if(isset($_GET['delete_request'])){
        $request_id = $_GET['delete_request'];
        $delete = "DELETE FROM requests WHERE request_id = '$request_id'";
        $execute = mysqli_query($conn,$delete);
        if($execute){
            header("location: admin_dashboard.php");
        }
    }

    if(isset($_GET['edit_request'])){
        $request_id = $_GET['edit_request'];
        $_SESSION['edit'] = $request_id;
        echo "
                <script>
                   document.getElementById('date').style.display = 'block';
                </script>
             ";
    }

?>
<?php

if(isset($_POST['update'])){
    $new_date = $_POST['new-date'];
    $request_id = $_SESSION['edit'];
    $update = "UPDATE requests SET control_date = '$new_date' WHERE request_id = '$request_id'";
    $execute = mysqli_query($conn,$update);
    if($execute){
        header("Location: admin_dashboard.php");
    }
    else{
        echo "
        <script>
           alert('An error occured while processing your request! Try again later.');
        </script></br>
     ";
}
} 

?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>