<?php
session_start();
$user_id=$_SESSION['user_id'];
$brand_id=$_SESSION['brd_id'];
$category_id=$_GET['category_id'];
$_SESSION["category_id"]=$category_id;

?>

<html>
<head>
      <link rel="stylesheet" href="css/Items.css">
</head>

<body>
  <br><br>
  <a href="AddnewItem.php?" class="add-button">+ New Item</a>

  <br><br>
  <table>
  <thead>
    <tr>
      <th>Code</th>
      <th>Name</th>
      <th>Status</th>
      <th>Created Date</th>
      <th>Updated Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
     <?php
    
        include 'DataBaseConnection.php';

            $limit = 10; // Items per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Count total items
        $countQuery = $conn->prepare("SELECT COUNT(*) AS total FROM master_item WHERE brand_id = ? AND category_id = ? AND user_id = ?");
        $countQuery->bind_param("iii", $brand_id, $category_id, $user_id);
        $countQuery->execute();
        $countResult = $countQuery->get_result();
        $total_items = $countResult->fetch_assoc()['total'];
        $countQuery->close();

        $total_pages = ceil($total_items / $limit);




         $stmt = $conn->prepare("SELECT * FROM master_item WHERE brand_id = ? AND category_id = ? AND user_id = ? LIMIT ?, ?");
        $stmt->bind_param("iiiii", $brand_id, $category_id, $user_id, $offset, $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
        
             while ($row = $result->fetch_assoc()) {
                 $id=$row["id"];
                $code=$row["code"];
                $name=$row["name"];
                $status=$row["status"];
                $create_date=$row["created_at"];
                $updated_date=$row["updated_at"];
                $_SESSION['item_id']=$id;

                echo '<tr>
                        <td>'.$code.'</td>
                        <td>'.$name.'</td>
                        <td>'.$status.'</td>
                        <td>'.$create_date.'</td>
                        <td>'.$updated_date.'</td>
                        <td>
                          <a href="EditItems.php?item_id=' . $id . '" <button class="edit-button">Edit</button></a>
                          <form action="" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this category?\');" style="display:inline;">
                                <input type="hidden" name="item_id" value="' . $id . '">
                                <input type="submit" class="delete-button" value="Delete" id="but2" >
                         </form>
                        </td>
                      </tr>';
                    }
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
                $item_id = $_POST['item_id'];

                $stmt = $conn->prepare("DELETE FROM master_item WHERE id = ?");
                $stmt->bind_param("i", $item_id);

                    if ($stmt->execute()) {
                        //header("Location: Brands.php");
                        exit;
                    } else {
                        echo "Error deleting brand: " . $stmt->error;
                    }

                    $stmt->close();
                        }

                    $conn->close();
        ?>
   
  </tbody>
</table>


<div style="text-align: center; margin-top: 20px;">
    <?php if ($total_pages > 1): ?>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?category_id=<?php echo $category_id; ?>&page=<?php echo $i; ?>"
               style="margin: 0 5px; <?php if ($i == $page) echo 'font-weight: bold; text-decoration: underline;'; ?>">
                <?php echo $i; ?>
            </a>
        <?php endfor; ?>
    <?php endif; ?>
</div>

</body>
</html>