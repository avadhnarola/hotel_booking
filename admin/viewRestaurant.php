<?php

ob_start();
include("../db.php");
include("header.php");

// Check admin session
if (!isset($_SESSION['admin_id'])) {
    header("location:index.php");
    exit();
}

// Handle delete
if (isset($_GET['d_id'])) {
    $id = intval($_GET['d_id']);
    $del = "DELETE FROM restaurant WHERE id = $id";
    mysqli_query($conn, $del);
    header("Location: viewRestaurant.php");
    exit();
}

// Pagination setup
$limit = 3; // records per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Total records
$total_query  = "SELECT COUNT(*) AS total FROM restaurant";
$total_result = mysqli_query($conn, $total_query);
$total_row    = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages   = ceil($total_records / $limit);

// Fetch restaurants
$select = "SELECT * FROM restaurant ORDER BY id DESC LIMIT $limit OFFSET $offset";
$res = mysqli_query($conn, $select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Restaurants</title>
    <link rel="stylesheet" href="view-style.css">
    <link rel="stylesheet" href="assets/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="../css/aos.css">
    <link rel="stylesheet" href="../css/ionicons.min.css">
    <link rel="stylesheet" href="../css/flaticon.css">
    <link rel="stylesheet" href="../css/icomoon.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        #search-box {
            width: 40%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        #search-box:focus {
            outline: none;
            border-color: #4c3aecff;
            box-shadow: 0 0 5px rgba(76, 58, 236, 0.5);
        }
        .delete-btn {
            background: #dc3545;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
        }
        .edit-btn {
            background: #007bff;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="button-container">
        <a href="addRestaurant.php" class="btn btn-add">+ <b>Restaurant</b></a>
    </div>
</div>

<div class="container d-flex justify-content-center">
    <div class="admin-panel">
        <h2>View Restaurants</h2>

        <!-- Search Box -->
        <input type="text" id="search-box" placeholder="🔍 Search restaurants by location, shop name, or price..." />

        <!-- Table Data -->
        <div id="table-data" class="table-responsive">
            <table class="table table-light table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Location</th>
                        <th>Shop Name</th>
                        <th>Start At</th>
                        <th>Star</th>
                        <th>Image</th>
                        <th>Rate</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['location']); ?></td>
                            <td><?php echo htmlspecialchars($row['shopName']); ?></td>
                            <td>$<?php echo htmlspecialchars($row['price']); ?></td>
                            <td>
                                <?php
                                for ($i = 0; $i < $row['star']; $i++) echo '★';
                                for ($j = $row['star']; $j < 5; $j++) echo '☆';
                                ?>
                            </td>
                            <td>
                                <?php if (!empty($row['image'])): ?>
                                    <img src="images/<?php echo htmlspecialchars($row['image']); ?>" style="height:60px;width:90px;object-fit:cover;" />
                                <?php else: ?>
                                    No Image
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($row['rate']); ?></td>
                            <td>
                                <a href="addRestaurant.php?u_id=<?php echo $row['id']; ?>" class="btn edit-btn">Edit</a>
                            </td>
                            <td>
                                <a href="viewRestaurant.php?d_id=<?php echo $row['id']; ?>" class="btn delete-btn"
                                   onclick="return confirm('Are you sure to delete this restaurant?');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination" id="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>">&laquo; Prev</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="<?php if ($i == $page) echo 'active'; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>">Next &raquo;</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $("#search-box").on("keyup", function(){
        var query = $(this).val();
        $.ajax({
            url: "fetchRestaurant.php",
            type: "POST",
            data: { query: query },
            success: function(data){
                $("#table-data").html(data);
                $("#pagination").hide(); // hide pagination when searching
            }
        });
    });
});
</script>
</body>
</html>

<?php include("footer.php"); ?>
