<?php
session_start();
?>

<html>
<head>
    <link rel="stylesheet" href="css/signIn.css">
</head>
<body>
	<div id="div1">
        <form action="" method="post" id="form">
            


            <h1 style="color:#000080;" >Sign In</h1>
                <span id = "username_msg" style="color:red"> </span>
                <input type="text" placeholder="Email" id="text" name="username"><br></td>
                 <!-- <input type="hidden" name="quantity" value="<?php echo $quantity?>"> -->

                <span id = "pwd_msg" style="color:red"> </span>
                <input type="password" placeholder="Password" id="text" name="pwd"><br>

                <button type="submit" value="Sign in" id="button" name="signIn">Sign in</button><br>

                <table id="table">
                    <tr>
                        <td> Don't have an account ?</td>
                        <td> <a href="SignUp.php">Sign Up</a></td>
                    </tr>
                </table>

        </form>
    </div>
</body>
<?php
include 'DataBaseConnection.php';
if(isset($_POST['signIn'])){
     $un = $_POST['username'];
    $pwd = $_POST['pwd'];
     $_SESSION['email'] = $un;

    if(empty($un)) {
        echo "<script type='text/javascript'> text='** Enter username **';
            document.getElementById('username_msg').innerHTML = text;</script>";
    }

    if(empty($pwd)) {
        echo "<script type='text/javascript'> text='** Enter password **';
            document.getElementById('pwd_msg').innerHTML = text;</script>";
    }

     if(!empty($un) && !empty($pwd)) {
        $sql = "SELECT id,name FROM users WHERE email='$un' AND password='$pwd'";
        $result = $conn->query($sql);
        

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row["id"];
            $name = $row["name"];
            
            // $_SESSION['email'] = $un;

            echo "<script type='text/javascript'>window.location.href='DashBoard.php';</script>";
            exit;
        } else {
            echo "<script type='text/javascript'> text='**Invalide Username or Password**';
            document.getElementById('pwd_msg').innerHTML = text;</script>";
        }

        $conn->close();
    }
}
    ?>
</html>