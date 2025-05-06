
<?php
session_start();
$user_id=$_SESSION['user_id'];
$brand_id=$_SESSION['brd_id'];
$category_id=$_SESSION['category_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Item</title>
     <link rel="stylesheet" href="css/AddItems.css">
</head>
<body>

    <form class="brand-form" action="" method="POST">
        <h2>Add New Item</h2>

        <label for="code">Code</label>
        <span id = "code" style="color:red"> </span>
        <input type="text" id="code" name="code" required>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>

        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="Active" selected>Active</option>
            <option value="Inactive">Inactive</option>
        </select>

        <input type="submit" value="Create" class="button" name="add_new">
    </form>
</body>

<?php
     include 'DataBaseConnection.php';
     if (isset($_POST['add_new'])) {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $status=$_POST['status'];

    // Use placeholders
     $stmt = $conn->prepare("SELECT code FROM master_item WHERE code = ? AND user_id = ? AND category_id= ? AND brand_id=?");
     $stmt->bind_param("siii", $code, $user_id,$category_id, $brand_id);
     $stmt->execute();
     $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script type='text/javascript'> text='** Code already exit **';
                document.getElementById('code').innerHTML = text;</script>";
        }else{
           $stmt = $conn->prepare("INSERT INTO master_item (brand_id,category_id,code, name, status,user_id) VALUES (?, ?, ?,?,?,?)");
           $stmt->bind_param("iisssi", $brand_id, $category_id, $code, $name, $status,$user_id);

                if ($stmt->execute()) {
                     $stmt->close();
                    $conn->close();
                      header("Location: AddnewItem.php?success=1");
                    exit();
                } else {
                   // echo "Error: " . $stmt->error;
                }

    $stmt->close();
    }
}
$conn->close();
?>
</html>
