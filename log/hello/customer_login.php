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


// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Validate user input (sanitize and validate email and password)
//     $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
//     $password = $_POST['password']; // You should validate the password

//     // Check user credentials in the database (adjust your database connection)
//     $conn = new mysqli("localhost", "root", " ", "apnacab");
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }

//     $sql = "SELECT * FROM customer WHERE c_email_id = '$email' AND c_password = '$password'";
//     $result = $conn->query($sql);

//     if ($result->num_rows > 0) {
//         // Successful login
//         session_start();
//         $_SESSION["email"] = $email;
//         header("Location: dashboard.php"); // Redirect to a protected page
//         exit;
//     } else {
//         // Invalid login
//         echo "Invalid email or password. Please try again.";
//     }

//     $conn->close();
// }



// include 'components/connect.php';

// session_start();

// if(isset($_SESSION['user_id'])){
//    $user_id = $_SESSION['user_id'];
// }else{
//    $user_id = '';
// };

// if(isset($_POST['submit'])){

//    $name = $_POST['name'];
//    $name = filter_var($name, FILTER_SANITIZE_STRING);
//    $email = $_POST['email'];
//    $email = filter_var($email, FILTER_SANITIZE_STRING);
//    $number = $_POST['number'];
//    $number = filter_var($number, FILTER_SANITIZE_STRING);
//    $pass = sha1($_POST['pass']);
//    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
//    $cpass = sha1($_POST['cpass']);
//    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

//    $select_user = $conn->prepare("SELECT * FROM users WHERE email = ? OR number = ?");
//    $select_user->execute([$email, $number]);
//    $row = $select_user->fetch(PDO::FETCH_ASSOC);

//    if($select_user->rowCount() > 0){
//       $message[] = 'email or number already exists!';
//    }else{
//       if($pass != $cpass){
//          $message[] = 'confirm password not matched!';
//       }else{
//          $insert_user = $conn->prepare("INSERT INTO users(name, email, number, password) VALUES(?,?,?,?)");
//          $insert_user->execute([$name, $email, $number, $cpass]);
//          $select_user = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
//          $select_user->execute([$email, $pass]);
//          $row = $select_user->fetch(PDO::FETCH_ASSOC);
//          if($select_user->rowCount() > 0){
//             $_SESSION['user_id'] = $row['id'];
//             header('location:home.php');
//          }
//       }
//    }

// }



        if (isset($_POST["login"]))
         {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "database.php";
        //     $stmt = $conn->prepare("select * from customer where c_email_id = ?");
        //     $stmt->bind_param("s",$email);
        //     $stmt->execute();
        //     $stmt_result = $stmt->get_result();
        //     if($stmt_result -> num_rows > 0)
        //     {
        //         $data = $stmt_result -> fetch_assoc();
        //         if($data['password'] == $password && $data['email'] == $email)
        //         {
        //             $_SESSION["login"] = $_POST["email"];
        //             header('location:apnacab/index.html');
        //             exit();
        //         } else 
        //         {
        //             $errors[] = 'Invalid email or password';
        //         }
        //     }
        //     else {
        //         $errors[] = 'Invalid email or password';
        //     }
            
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

        <h2>CUSTOMER LOGIN</h2> <br>

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
     <div><p>Not registered yet <a href="customer_registration.php">Register Here</a></p></div>
    </div>
</body>
</html>