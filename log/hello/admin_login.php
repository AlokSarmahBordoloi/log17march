<?php
session_start();
if (isset($_SESSION["customer"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
 if (isset($_POST["login"]))
 {
   $email = $_POST["email"];
   $password = $_POST["password"];
    require_once "database.php";
    $sql = "SELECT * FROM customer WHERE c_email_id = '$email' AND c_password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Successful login
        session_start();
        $_SESSION["email"] = $email;
        header("Location: registration.php"); // Redirect to a protected page
        exit;
    } else {
        // Invalid login
        echo "Invalid email or password. Please try again.";
    }

    $conn->close();
}
?>
<form action="login.php" method="post">

    <h2>ADMIN LOGIN</h2> <br>
    
  <div class="form-group">
      <input type="email" placeholder="Enter Email:" name="email" class="form-control">
  </div>
  <div class="form-group">
      <input type="password" placeholder="Enter Password:" name="password" class="form-control">
  </div>
  <div class="form-btn">
      <input type="submit" value="Login" name="login" class="btn btn-primary">
  </div>
</form>
<div><p>Not registered yet <a href="admin_registration.php">Register Here</a></p></div>
</div>
</body>
</html>