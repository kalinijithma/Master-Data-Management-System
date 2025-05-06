<?php
session_start();
$un=$_SESSION['email'];
$br_id=$_GET['brnd_id'];
$_SESSION['brd_id']=$br_id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>categories</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/DashBoard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

</head>
<body>
    <a href="AddnewCatagory.php"><input type="button" name="add-button" class="add-button" value="+ New Category"></a>
<br>
<h1>Categories</h1>
<br>


<div class="products" id="Products" style="line-height: 1.5;">

    <div class="products-container">
        <?php
        include 'DataBaseConnection.php';


         $limit = 5; // Brands per page
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $limit;

            // Count total brands for pagination
            $countStmt = $conn->prepare("SELECT COUNT(*) as total FROM master_category");
            $countStmt->execute();
            $countResult = $countStmt->get_result();
            $total = $countResult->fetch_assoc()['total'];
            $countStmt->close();

            $total_pages = ceil($total / $limit);



         $stmt = $conn->prepare("SELECT * FROM master_category LIMIT ?, ?");
        $stmt->bind_param("ii", $offset, $limit);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
        
             while ($row = $result->fetch_assoc()) {
                $id=$row["id"];
                $name=$row["name"];
                $_SESSION['category_id']=$id;

                echo '<div class="box">
                       
                               <a href="Items.php?category_id='.$id.'"><h2>'.$name.'</h2></a>

                    <div class="box-buttons">
                        <a href="EditCategories.php?category_id='.$id.'" <input type="button" name="edit-but" class="but" id="but1" value="Edit">Edit</button></a>


                         <form action="" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this category?\');" style="display:inline;">
                                <input type="hidden" name="category_id" value="' . $id . '">
                                <input type="submit" class="but" value="Delete" id="but2" >
                         </form>
                       
                    </div>

                        </div> ';
                    }
                }

                 if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_id'])) {
                $category_id = $_POST['category_id'];

                $stmt = $conn->prepare("DELETE FROM master_category WHERE id = ?");
                $stmt->bind_param("i", $category_id);

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
        </div> 
        <div class="pagination" style="text-align:center; margin-top:20px;">
        <?php if ($total_pages > 1): ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?brnd_id=<?php echo $br_id; ?>&page=<?php echo $i; ?>"
                   style="margin: 0 5px; <?php if ($i == $page) echo 'font-weight:bold; text-decoration:underline;'; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        <?php endif; ?>
    </div>

    </div> 


</div>

</body>
</html>