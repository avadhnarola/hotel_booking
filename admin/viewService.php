<?php
ob_start();
include("../db.php");
include("header.php");

if (!isset($_SESSION['admin_id'])) {
    header("location:index.php");
} else {
    header("loaction:dashboard.php");
}

// Delete service if requested
if (isset($_GET['d_id'])) {
    $del = "DELETE FROM service WHERE id=" . intval($_GET['d_id']);
    mysqli_query($conn, $del);
    header("location:viewService.php");
    exit();
}

// Pagination setup
$limit = 3; // Number of records per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Total records from service table (fixed)
$total_query = "SELECT COUNT(*) AS total FROM service";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

// Fetch limited services
$select = "SELECT * FROM service LIMIT $limit OFFSET $offset";
$res = mysqli_query($conn, $select);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Services</title>
    <link rel="stylesheet" href="view-style.css">
    <link rel="stylesheet" href="assets/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="../css/aos.css">
    <link rel="stylesheet" href="../css/ionicons.min.css">
    <link rel="stylesheet" href="../css/flaticon.css">
    <link rel="stylesheet" href="../css/icomoon.css">

    <!-- jQuery for AJAX -->
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
            <a href="addService.php" class="btn btn-add">+ <b>Service</b></a>
        </div>
    </div>

    <div class="container d-flex justify-content-center">
        <div class="admin-panel">
            <h2>View Services</h2>

             <!-- Search Box -->
            <input type="text" id="search-box" placeholder="🔍 Search by title or description..." />

            <div class="table-responsive" id="table-data">
                <table class="table table-light table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                            <tr class="trow">
                                <td><?php echo $row['id']; ?></td>
                                <td class="icons">
                                    <div class="icon justify-content-center align-items-center d-flex">
                                        <span class="<?php echo $row['icon']; ?>"></span>
                                    </div>
                                </td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['content']; ?></td>
                                <td>
                                    <a href="addService.php?u_id=<?php echo $row['id']; ?>" class="btn edit-btn">Edit</a>
                                </td>
                                <td>
                                    <a href="viewService.php?d_id=<?php echo $row['id']; ?>" class="btn delete-btn"
                                       onclick="return confirm('Are you sure to delete this Service?');">Delete</a>
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
            // Live search using AJAX
            $("#search").on("keyup", function () {
                var search = $(this).val();
                $.ajax({
                    url: "fetchService.php",
                    type: "POST",
                    data: { query: search },
                    success: function (data) {
                        $("#table-data").html(data);
                        $("#pagination").hide(); // Hide pagination when searching
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php include("footer.php"); ?>
