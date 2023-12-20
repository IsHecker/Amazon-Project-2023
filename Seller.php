<?php 
  include('db_connection.php');
	session_start();

  $username = $_GET['username'];
  $id = $_GET['id'];
	

	if(isset($_POST['search-btn'])){
		$_SESSION['search_value'] = $_POST['search'];
	}
	
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		header("Location: {$_SERVER['REQUEST_URI']}");
	}
	
	
	if(isset($_POST['submit'])){
		$sql = "INSERT INTO `products`(`seller_name`, `name`, `price`, `category`, `seller_id`) VALUES('{$username}', '{$_POST['name']}','{$_POST['price']}$', '{$_POST['category']}', '{$id}')";
		
		if($_POST['updatemode']=="Update")
		$sql = "UPDATE `products` SET `name`='{$_POST['name']}',`price`='{$_POST['price']}$',`category`='{$_POST['category']}', `created_at` = current_timestamp WHERE product_id = {$_POST['productid']}";
		
		mysqli_query($conn, $sql);
		$_POST['submit'] = '';
	}
  
	if(isset($_POST['delete'])){
		$productid = mysqli_real_escape_string($conn, $_POST['product_to_delete']);
		$sql = "DELETE FROM products WHERE product_id = $productid";
		mysqli_query($conn, $sql);
		$_POST['delete'] = '';
	}

	if($_SESSION['search_value'] != ''){
		$sql = "SELECT * FROM `products` WHERE name = '{$_SESSION['search_value']}' and seller_id = $id;";
	}
	else{
		$sql = "SELECT * FROM products WHERE seller_id = $id";
	}
	
	$result = mysqli_query($conn, $sql);
	$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);
	mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">  -->
<link rel="stylesheet" href="CSS/materialize.min.css"> <!-- Framework -->
<link rel="stylesheet" href="CSS/seller.css">

<?php include('Template/Header.php'); ?>

<h4 class="center grey-text">Welcome <?php echo $username ?>!</h4>

<form class="white" action="Seller.php?username=<?php echo $username ?>&id=<?php echo $id ?>" method="POST" style="
				width: 500px;
				margin: 20px auto;
				padding: 20px;
				border-radius: 8px;">
  <h4 class="center">Product Details</h4>

  <input type="hidden" id="productid" name="productid">
  <input type="hidden" id="updatemode" name="updatemode">

  <label>Product Name</label>
  <input type="text" name="name" required value="">
  <div class="red-text"></div>

  <label>Price</label>
  <input type="number" name="price" required value="">
  <div class="red-text"></div>

  <label>Category</label>
  <input type="text" name="category" required value="">
  <div class="red-text"></div>

  <div class="center">
    <button type="submit" name="submit" class="add-btn">Add</button>
  </div>

</form>

<script type="text/javascript" src="JS/UpdateProcess.js"></script>

<div class="products white">
  <h4 class="center">Your Products</h4>

  <div class="search">
    <form action="Seller.php?username=<?php echo $username ?>&id=<?php echo $id?>" method="POST"
      class="center form-group" style="max-width: 1000px;width: 100%; margin: 0px 0px;">
      <input type="text" style="margin: 0 0;" name="search" placeholder="Search Product Name">
      <button type="submit" name="search-btn">Search</button>
    </form>
  </div>

  <table>
    <tr>
      <th>id</th>
      <th>Product Name</th>
      <th>Price</th>
      <th>Category</th>
      <th>Date</th>
      <th>Update</th>
      <th>Delete</th>
    </tr>

    <tbody>
      <?php
						$i = 1;
						foreach($products as $product):
					?>

      <tr>
        <td><?php echo $i?></td>
        <td><?php echo $product['name'] ?></td>
        <td><?php echo $product['price'] ?></td>
        <td><?php echo $product['category'] ?></td>
        <td><?php echo $product['created_at'] ?></td>
        <td><button onclick="PrepareUpdate(<?php echo $i++?>)" class="update-btn" name="update">Update</button></td>
        <form action="Seller.php?username=<?php echo $username ?>&id=<?php echo $id ?>" method="POST"
          class="center form-group">
          <input type="hidden" name="product_to_delete" value="<?php echo $product['product_id'] ?>">
          <td><button class="delete-btn" name="delete">Delete</button></td>
        </form>
      </tr>
      <script type="text/javascript">
      GetAllProducts(<?php echo json_encode($product);?>);
      </script>
      <?php endforeach ?>

    </tbody>

  </table>
</div>

</body>

</html>