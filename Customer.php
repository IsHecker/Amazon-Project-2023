<?php 
    include('db_connection.php');
	
    $username = $_GET['username'];
    $id = $_GET['id'];
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		header("Location: {$_SERVER['REQUEST_URI']}");
	}
    
    if(isset($_POST['buy'])){
        $productID = mysqli_real_escape_string($conn, $_POST['product_to_delete']);
        $sql = "DELETE FROM products WHERE product_id = $productID";
        mysqli_query($conn, $sql);
    }
    
	$sql = 'SELECT * FROM products';
    
	$result = mysqli_query($conn, $sql);

	$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);

	mysqli_close($conn);
    
?>

<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="CSS/materialize.min.css"> <!-- Framework -->
    <?php include('Template/Header.php'); ?>

    <h4 class="center grey-text">Welcome <?php echo $username ?>!</h4>

	<div class="container">
	    <div class="row">
            <?php foreach($products as $product): ?>
                <div class="col s3 md3">
                    <div class="card z-depth-0">
                        <div class="card-content center">
                            <h5><?php echo htmlspecialchars($product['name']);?></h5>
                            
                            <div class="right-align">
                                <h6>Price: <?php echo $product['price']?></h6>
                            </div>
                        </div>

                        <div class="card-action right-align form-group">
                            <h6 class="left-align">Category: <?php echo $product['category']?></h6>
                            <h6 class="left-align">Selled By: <?php echo $product['seller_name']?></h6>
                        



                            <form action="Customer.php?username=<?php echo $username ?>&id=<?php echo $id ?>" method="POST"class="center form-group">
                                <input type="hidden" name="product_to_delete" value = "<?php echo $product['product_id'] ?>">
                                <button type="submit" name="buy" style="
                                    background-color: orange; 
                                    color: black;
                                    width: 200px;
                                    font-size: 17px;
                                ">Buy</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
		</div>
	</div>

	
    </body>
</html>