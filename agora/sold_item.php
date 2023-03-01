<?php

@include 'config.php';

if(isset($_POST['update_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'please fill out all!';    
   }else{

      $update_data = "UPDATE seller_db SET name='$product_name', price='$product_price', image='$product_image'  WHERE id = '$id'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         header('location:seller_page.php');
      }else{
         $$message[] = 'please fill out all!'; 
      }

   }
};

?>

<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['buyer_name'])){
   header('location:login.php');
}

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO seller_db(name, price, image) VALUES('$product_name', '$product_price', '$product_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php ecommerce agora</title>
    <!-- bootsrap and font -->
    <link rel="stylesheet" href="css/products.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<nav class="navbar navbar-dark bg-dark justify-content-around">
   <a class="navbar-brand" href="home_page.php">Agora</a>
      <span class="navbar-text">
         <a href="login.php" class="btn">Home</a>
         <a href="login.php" class="btn">Products</a>
         <a href="register.php" class="btn">Register</a>
         <a href="login.php" class="btn">Logout</a>
      </span>
      <div class="form-inline text-white">
         <a>Hey <?php echo $_SESSION['buyer_name'] ?>, for checking out!</a>
      </div>
</nav>
<div class="container bg-light">
   <div class="cart-container text-center">
      <div class="seccontainer shadow p-3">
         <div class="content">
            <p class="checkout text-light bg-dark">Item Sold!</p>
            <h4>Hi, <span><?php echo $_SESSION['buyer_name'] ?></span></h4>
            <h6>Your Item is coming your way!</h6><br>
            <div>
               <p>Thanks for purchasing<br>with us.</p>
               <a href="buyer_page.php" class="btn btn-primary">Back to Products</a>
            </div>
            <p></p>
         </div>
      </div>
   </div>
</div>
<footer class="p-5 text-white text-center position-relative" style="background-color: #044947;">
   <div class="container"><p class="lead">Copyright &copy; 2021 Christine's Bootstrap</p>
      <a href="" class="position-absolute bottom-0 end-0 p-5">
         <i style="font-size:24px" class="fa">&#xf01b;</i>
   </div>
</footer>
</body>
</html>