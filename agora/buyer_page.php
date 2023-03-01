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

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM seller_db WHERE id = $id");
   header('location:buyer_page.php');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
   <!-- navbar -->
      <nav class="navbar navbar-dark bg-dark justify-content-around">
         <a class="navbar-brand" href="home_page.php">Agora</a>
            <span class="navbar-text">
               <a href="login.php" class="btn">Home</a>
               <a href="login.php" class="btn">Products</a>
               <a href="register.php" class="btn">Register</a>
               <a href="login.php" class="btn">Logout</a>
            </span>
            <div class="form-inline text-white">
               <a>Hi <?php echo $_SESSION['buyer_name'] ?>, Welcome back!</a>
            </div>
      </nav>
<div class="container"><br>
   <div class="content">
      <h3>Hi, <span>buyer</span></h3>
      <h1>Welcome <span><?php echo $_SESSION['buyer_name'] ?></span></h1>
      <p>this is an buyer page</p>
      <a class="btn btn-primary" href="login.php" class="btn">Logout</a>
      <a class="btn btn-primary" href="register.php" class="btn">Create new account</a><br><br>
   </div>
</div>
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   
<div class="container">

   <div class="admin-product-form-container">


   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM seller_db");
   
   ?>
   <div class="productitms">
      <div class="d-flex flex-row row row-cols-sm-1 row-cols-md-3 justify-content-around">
         <?php while($row = mysqli_fetch_assoc($select)){ ?>      
            <div class="d-flex flex-column align-items-center"> 
                <div class="cont shadow p-3 mb-5 bg-white rounded">
                    <img src="uploaded_img/<?php echo $row['image']; ?>" height="250" width="300" alt="products">
                    <br><br>
                    <h5><?php echo $row['name']; ?><br></h5>
                    $<?php echo $row['price']; ?>/-<br>
            
               <a href="addtocart.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-shopping-cart"></i> Buy Now </a>
               </div>
            </div>
      <?php //add to cart
    } ?>
         </div>
   </div>
</div>
</body>
<footer class="p-5 text-white text-center position-relative" style="background-color: #044947;">
        <div class="container"><p class="lead">Copyright &copy; 2021 Christine's Bootstrap</p>
        
            <a href="" class="position-absolute bottom-0 end-0 p-5">
                <i style="font-size:24px" class="fa">&#xf01b;</i>
        </div>
</footer>
</html>