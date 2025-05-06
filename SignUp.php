<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>
	<link rel="stylesheet" href="css/signUp.css">
    <script src="js/Validation.js" defer></script> 
</head>
<body>
    <div id="div1">
         <form action="" method="post" id="form" onsubmit="return check_form()">
            
            <h2 style="color: #000080;" align="center">Sign Up</h2>

            <span id="fname_msg" style="color: red; font-size: 12px;"></span>
            <input type="text" placeholder="Name" id="name" name="name">

            <span id="email_msg" style="color:red"></span>
            <input type="text" placeholder="Email" id="email" name="email">

            <span id="pwd1_msg" style="color:red"></span>
            <input type="password" placeholder="Password" id="password1" name="password1">

            <span id="pwd2_msg" style="color:red"></span>
            <input type="password" placeholder="Confirm Password" id="password2" name="password2">

            <br>
            
            <button type="submit" value="Sign Up" id="button" name="signUp">Sign Up</button><br>
            
            <table id="table">
                <tr>
                    <td>Already have an account ? </td>
                    <td><a href="SignIn.php">Sign In</a></td>
                </tr>
            </table>

        </form>

        <?php
     include 'DataBaseConnection.php';
     if(isset($_POST['signUp']))
    {
       $name = $_POST['name'];
       $email = $_POST['email'];
       $password=$_POST['password2'];
       $admin="0";
       $_SESSION['email'] = $email;

       $stmt = $conn->prepare("INSERT INTO users (name, email,password,is_admin) VALUES (?, ?, ?,?)");
       $stmt->bind_param("sssi",$name, $email,$password,$admin);

            if ($stmt->execute()) {
                 $stmt->close();
                $conn->close();
                  header("Location: SignIn.php?success=1");
                exit();
            } else {
               // echo "Error: " . $stmt->error;
            }

      $stmt->close();
}
$conn->close();
?>
</body>
</html>