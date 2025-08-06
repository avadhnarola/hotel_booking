<?php
ob_start();
include("../db.php");
include("header.php");

// Handle delete
if (isset($_GET['d_id'])) {
    $id = intval($_GET['d_id']);
    $del = "DELETE FROM booking WHERE id = $id";
    mysqli_query($conn, $del);
    header("Location: viewBooking.php");
    exit();
}

// Pagination setup
$limit = 4; // Number of records per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Total records
$total_query = "SELECT COUNT(*) AS total FROM booking";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

// Fetch limited bookings
$select = "SELECT * FROM booking LIMIT $limit OFFSET $offset";
$res = mysqli_query($conn, $select);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Booking Details</title>
    <link rel="stylesheet" href="view-style.css">
    <link rel="stylesheet" href="assets/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="../css/aos.css">
    <link rel="stylesheet" href="../css/ionicons.min.css">
    <link rel="stylesheet" href="../css/flaticon.css">
    <link rel="stylesheet" href="../css/icomoon.css">

    <style>
        .icon-status {
            font-size: 18px;
            vertical-align: middle;
            margin-right: 4px;
        }

        .status-approved {
            color: green;
        }

        .status-rejected {
            color: red;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center" style="margin-top: 80px;">
        <div class="admin-panel">
            <h2>Booking Details</h2>
            <div class="table-responsive">
                <table class="table table-light table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Hotel Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['check_in']; ?></td>
                                <td><?php echo $row['check_out']; ?></td>
                                <td><?php echo $row['location']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['HotelType']; ?></td>
                                <td>
                                    <?php if (strtolower($row['status']) == 'approved'): ?>
                                        <span class="status-approved">
                                            <i class="icon ion-ios-checkmark-circle icon-status"></i> Approved
                                        </span>
                                    <?php else: ?>
                                        <span class="status-rejected">
                                            <i class="icon ion-ios-close-circle icon-status"></i>
                                            <?php echo htmlspecialchars($row['status']); ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="viewBooking.php?d_id=<?php echo $row['id']; ?>" class="btn delete-btn"
                                        onclick="return confirm('Are you sure to delete this booking?');">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination">
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

</body>

</html>

<?php include("footer.php"); ?>
