<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

?>
<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = mysqli_real_escape_string($conn, ($_POST['user_type']));

  

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `user_form`(name, email, password, user_type) VALUES('$name', '$email', '$pass', '$user_type')") or die('query failed');

         if($insert){
            $message[] = 'registered successfully!';

         }else{
            $message[] = 'registeration failed!';
         }
      }
   }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php ecommerce agora</title>
    <link rel="stylesheet" href="css/admin.css">
    <!-- bootsrap js and font -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- navbar -->
<nav class="navbar navbar-dark bg-dark justify-content-around">
   <a class="navbar-brand" href="home_page.php">Agora</a>
      <span class="navbar-text">
         <a href="home_page.php" class="btn">Home</a>
         <a href="products.php" class="btn">Products</a>
         <a href="register.php" class="btn">Register</a>
         <a href="login.php" class="btn">Logout</a>
      </span>
      <div class="form-inline text-white">
         <a>Hi <?php echo $_SESSION['admin_name'] ?>, Welcome!</a>
      </div>
   </div>
</nav>
</head>
<body>
   
<div class="container">
   <div class="logo">
      <?php
         $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
   </div>
</div>
      <div class="text-white" style="background-color: #5baeb7;">
      <div class="welcome text-white"><br><br>
         <h3> Hi, <span>Business Owner</span></h3>
         <h3>Welcome to Agora! <?php echo $fetch['name']; ?></h3>
         <a class="btn btn-primary" href="update_profile.php" class="btn">Update profile</a>
         <a class="btn btn-primary" href="businessac_page.php?logout=<?php echo $user_id; ?>" class="btn">Logout</a>
      </div>
      </div>
   </div>
</div>
<div class="container my-5">
   <h4 class="text-center">LISTS OF CONNECTIONS</h4>
   <br>
   <br>
   <table class="table table-dark">
   <thead>
      <tr>
         <th>Id</th>
         <th>Name</th>
         <th>Email</th>
         <th>Phone</th>
         <th>Address</th>
         <th>Action</th>
      </tr>
      </thead>
      <tbody>
         <?php
         $servername = "localhost";
         $username = "root";
         $password = "";
         $database = "ass3agora_db";

         //create connection
         $connection = new mysqli($servername, $username, $password, $database);

         if ($connection->connect_error) {
            die("connection failed: " . $connection->connect_error);
         }

         // read all row  from database
         $sql = "select * from clients";
         $result = $connection->query($sql);

         if (!$result) {
            die("Invalid query: " . $connection->error);
         }

         //read data each row
         while($row = $result->fetch_assoc()){
            echo "
            <tr>
               <td>$row[id]</td>
               <td>$row[name]</td>
               <td>$row[email]</td>
               <td>$row[phone]</td>
               <td>$row[address]</td>
               <td>
                     <a class='btn btn-primary btn-sm' href='/agora/edit.php?id=$row[id]'>edit</a>
                     <a  class='btn btn-danger btn-sm' href='/agora/delete.php?id=$row[id]'>delete</a>
               </td>
            </tr>
            ";
         }
         ?>
      </tbody>
      </table>
         <a class="btn btn-primary" href="/agora/newclient.php" role="button">New connection</a><br><br>
      <table class="table table-dark">
      <h4 class="text-center">CURRENT ACTIVE BUYER AND SELLER</h4>
         <thead>
            <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>User Type</th>
            </tr>
         </thead>
         <br><br>
         <tbody>
            <?php

            // read all row  from database
            $sql = "select * from user_form";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            //read data each row
            while($row = $result->fetch_assoc()){
                echo "
                <tr>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[user_type]</td>
                </tr>
                ";
            }
            ?>
         </tbody>
      </table>
      <a class="btn btn-primary" href="/agora/registerNewclient.php" role="button">Register New Client</a>
</div>
<footer class="p-5 text-white text-center position-relative" style="background-color: #044947;">
   <div class="container"><p class="lead">Copyright &copy; 2021 Christine's Bootstrap</p>
      <a href="" class="position-absolute bottom-0 end-0 p-5">
         <i style="font-size:24px" class="fa">&#xf01b;</i>
   </div>
</footer>
</body>
</html>