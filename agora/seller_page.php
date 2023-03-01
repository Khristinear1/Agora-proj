<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['seller_name'])){
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
   header('location:seller_page.php');
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
         <a href="home_page.php" class="btn">Home</a>
         <a href="products.php" class="btn">Products</a>
         <a href="register.php" class="btn">Register</a>
         <a href="login.php" class="btn">Logout</a>
      </span>
      <div class="form-inline text-white">
         <a>Hi <?php echo $_SESSION['seller_name'] ?>, Welcome back!</a>
         </div>
   </div>
</nav>
<div class="container">
   <div class="content">
      <h3>Hi, <span>Seller</span></h3>
      <h1>Welcome <span><?php echo $_SESSION['seller_name'] ?></span></h1>
      <p>this is an seller page</p>
      <a class="btn btn-primary" href="editsellerprofile.php" class="btn">Update profile</a>
      <a class="btn btn-primary" href="login.php" class="btn">Logout</a>
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

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new product</h3>
         <input type="text" placeholder="enter product name" name="product_name" class="box">
         <input type="number" placeholder="enter product price" name="product_price" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn text-light btn-warning" name="add_product" value="add product">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM seller_db");
   
   ?>
   <div class="product-display" style="padding: 2rem;"><br><br>
      <table class="table table-hover">
         <thead>
            <tr>
               <th><h6>Product Image</h6></th>
               <th><h6>Product Name</h6></th>
               <th><h6>Product Price</h6></th>
               <th><h6>Edit/Delete</h6></th>
            </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <th scope="row"><img src="uploaded_img/<?php echo $row['image']; ?>" height="150" width="200" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo $row['price']; ?>/-</td>
            <td><a href="seller_update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a></td>
            <td><a href="seller_page.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a></td>
         </tr>
         <?php } ?>
      </table>
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