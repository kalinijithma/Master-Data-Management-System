<?php
session_start();
$brand_id=$_GET['brand_id'];
$user_id=$_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Brand</title>
     <link rel="stylesheet" href="css/AddItems.css">
</head>
<body>

    <form class="brand-form" action="" method="POST">
    <h2>Update Brand</h2>

    <label for="code">New Code</label>
    <span id = "code" style="color:red"> </span>
    <input type="text" id="code" name="code" required>

    <label for="name">Name</label>
    <input type="text" id="name" name="name" required>

    <input type="submit" value="Update" class="button" name="update_btn">
</form>
<?php
include 'DataBaseConnection.php';

if (isset($_POST['update_btn'])) {
    $code = $_POST['code'];
    $name = $_POST['name'];

     $stmt = $conn->prepare("SELECT code FROM master_brand WHERE code = ? AND user_id = ? AND id != ?");
$stmt->bind_param("sii", $code, $user_id, $brand_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
        echo "<script type='text/javascript'> text='** Code already exit **';
            document.getElementById('code').innerHTML = text;</script>";
    } else{

    // Use placeholders
    $stmt = $conn->prepare("UPDATE master_brand SET code = ?, name = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("ssi", $code, $name, $brand_id);
            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();
                header("Location: DashBoard.php?success=1");
                exit();
        } else {
            echo "Execute failed: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Prepare failed: " . $conn->error;
    }

    $conn->close();
}
}
?>

</body>
</html>
