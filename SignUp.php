<?php 
  include('db_connection.php');
  $error = $email = $password = $name = '';
  
  if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);   //escaping any user harm or malicious code.
    $username = mysqli_real_escape_string($conn, $_POST['name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $usertype = mysqli_real_escape_string($conn, $_POST['userType']);

    $sql = "INSERT INTO `user_accounts`(`email`, `username`, `password`, `user_type`) VALUES ('$email','$username','$password', '$usertype')";
    
    try{
      mysqli_query($conn, $sql);
    }
    catch(Exception $e){
      $error = 'Email already Exists!, Please choose a different Email address.';
    }

    if($error == '')  // there are no errors.
      header('Location: index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('Template/Header.php'); ?>

    <div class="login-container CENTERABS">
        <h2>Sign Up</h2>
        <div style="color: red; display: inline;"><?php echo $error ?></div>
        <form action="SignUp.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" required  placeholder="Username" value= <?php echo $name ?> >
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <!-- <input type="email" name="email" required> -->
                <input type="email" name="email" required  placeholder="example@gmail.com"value= <?php echo $email ?>>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <!-- <input type="password" name="password" required> -->
                <input type="password" name="password" required  placeholder="Your Password" value= <?php echo $password ?>>
            </div>

            <div class="radio-group">
                <label>SignUp as:</label>
                <input type="radio" name="userType" value="Customer" checked>
                <label for="customer">Customer</label>
                <input type="radio" name="userType" value="Seller">
                <label for="seller">Seller</label>
            </div>

            <div class="form-group">
                <button type="submit" name="submit" >Sign Up</button>
            </div>

            <p class="grey">
                Already have account? 
                <a href="index.php" style="color: #1A8FE3;text-decoration: none;">Sign In</a>
            </p>
        </form>
    </div>
    
    <?php include('Template/Footer.php'); ?>
</html>