<?php
ob_start();
include("../db.php");
include("header.php");

if (!isset($_SESSION['admin_id'])) {
    header("location:index.php");
} else {
    header("loaction:dashboard.php");
}

// Handle delete
if (isset($_GET['d_id'])) {
    $id = intval($_GET['d_id']);
    $del = "DELETE FROM room WHERE id = $id";
    mysqli_query($conn, $del);
    header("Location: viewRoom.php");
    exit();
}

$limit = 4; // Number of records per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Total records
$total_query = "SELECT COUNT(*) AS total FROM room";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

// Fetch limited records
$select = "SELECT * FROM room LIMIT $limit OFFSET $offset";
$res = mysqli_query($conn, $select);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Rooms</title>
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
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="button-container">
            <a href="addRoom.php" class="btn btn-add">+ <b>Rooms</b></a>
        </div>
    </div>

    <div class="container d-flex justify-content-center">
        <div class="admin-panel">
            <h2>View Rooms</h2>

            <!-- Search Box -->
            <input type="text" id="search-box" placeholder="🔍 Search rooms by title, location or price..." />

            <div class="table-responsive" id="room-table">
                <table class="table table-light table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td style="text-align:left"><?php echo $row['description']; ?></td>
                                <td><?php echo $row['location']; ?></td>
                                <td>
                                    <?php if (!empty($row['image'])): ?>
                                        <img src="images/<?php echo $row['image']; ?>" style="height:60px;width:90px;" />
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="addRoom.php?u_id=<?php echo $row['id']; ?>" class="btn edit-btn">Edit</a>
                                </td>
                                <td>
                                    <a href="viewRoom.php?d_id=<?php echo $row['id']; ?>" class="btn delete-btn"
                                        onclick="return confirm('Are you sure to delete this Room?');">Delete</a>
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
                    <a href="?page=<?php echo $i; ?>" class="<?php if ($i == $page) echo 'active'; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>">Next &raquo;</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#search-box").keyup(function () {
                var query = $(this).val();
                $.ajax({
                    url: "fetchRoom.php",
                    method: "POST",
                    data: { search: query },
                    success: function (data) {
                        $("#room-table").html(data);
                        $("#pagination").hide();
                    }
                });
            });
        });
    </script>

</body>
</html>

<?php include("footer.php"); ?>
