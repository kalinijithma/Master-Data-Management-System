<?php
session_start();
$un = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Brands</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/DashBoard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <a href="LogOut."><img src="images/logout.png" class="log-out"></a>
    <a href="AddnewBrand.php"><input type="button" name="add-button" class="add-button" value="+ New Brand"></a>
    <br>
    <h1>Brands</h1>
    <br>

    <div class="products" id="Products" style="line-height: 1.5;">
        <div class="products-container">
            <?php
            include 'DataBaseConnection.php';

            $limit = 5; // Brands per page
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $limit;


            $countStmt = $conn->prepare("SELECT COUNT(*) as total FROM master_brand mb JOIN users u ON mb.user_id = u.id WHERE u.email = ?");
            $countStmt->bind_param("s", $un);
            $countStmt->execute();
            $countResult = $countStmt->get_result();
            $total = $countResult->fetch_assoc()['total'];
            $countStmt->close();

            $total_pages = ceil($total / $limit);

            $stmt = $conn->prepare("SELECT mb.*, u.id AS user_id FROM users u LEFT JOIN master_brand mb ON mb.user_id = u.id WHERE u.email = ? LIMIT ? OFFSET ?");
            $stmt->bind_param("sii", $un, $limit, $offset);
            $stmt->execute();
            $result = $stmt->get_result();
            //var_dump($result);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $user_id = $row["user_id"];
                    $name = $row["name"];
                    $id = $row["id"];
                    $_SESSION['user_id'] = $user_id;

                    if($id==null){
                        echo "No brands found.";
                    }else{
                         echo '<div class="box">
                            <a href="Category.php?brnd_id=' . $id . '"><h2>' . $name . '</h2></a>
                            <div class="box-buttons">
                                <a href="EditBrands.php?brand_id=' . $id . '"><input type="button" name="edit-but" class="but" id="but1" value="Edit"></a>

                                <form action="" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this brand?\');" style="display:inline;">
                                    <input type="hidden" name="brand_id" value="' . $id . '">
                                    <input type="submit" class="but" value="Delete" id="but2">
                                </form>
                            </div>
                          </div>';
                    }

                   
                }
            } else {
                echo "<p>No brands found.</p>";
            }


                  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['brand_id'])) {
    $brand_id = $_POST['brand_id'];


    $stmt = $conn->prepare("DELETE FROM master_item WHERE brand_id = ?");
    $stmt->bind_param("i", $brand_id);
    $stmt->execute();
    $stmt->close();


    $stmt = $conn->prepare("DELETE FROM master_brand WHERE id = ?");
    $stmt->bind_param("i", $brand_id);

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
                    <a href="?page=<?php echo $i; ?>" style="margin: 0 5px; <?php if ($i == $page) echo 'font-weight:bold; text-decoration:underline;'; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>





