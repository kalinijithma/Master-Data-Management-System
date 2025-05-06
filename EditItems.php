
<?php
session_start();
$item_id=$_GET['item_id'];
$user_id=$_SESSION['user_id'];
$brand_id=$_SESSION['brd_id'];
$category_id=$_SESSION['category_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Item</title>
     <link rel="stylesheet" href="css/AddItems.css">
</head>
<body>

    <form class="brand-form" action="" method="POST">
    <h2>Update Item</h2>

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

    // Use placeholders
     $stmt = $conn->prepare("SELECT code FROM master_item WHERE code = ? AND user_id = ? AND category_id= ? AND brand_id=?");
$stmt->bind_param("siii", $code, $user_id,$category_id, $brand_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
        echo "<script type='text/javascript'> text='** Code already exit **';
            document.getElementById('code').innerHTML = text;</script>";
    } else{

    $stmt = $conn->prepare("UPDATE master_item SET code = ?, name = ? WHERE id = $item_id");

    if ($stmt) {
        $stmt->bind_param("ss", $code, $name);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            //header("Location: EditItems.php?success=1");
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
