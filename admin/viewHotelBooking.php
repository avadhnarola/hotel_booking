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
    $del = "DELETE FROM hotelbookings WHERE id = $id";
    mysqli_query($conn, $del);
    header("Location: viewHotelBooking.php");
    exit();
}

// Pagination setup
$limit = 4;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Total records
$total_query = "SELECT COUNT(*) AS total FROM hotelbookings";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_records = $total_row['total'];
$total_pages = ceil($total_records / $limit);

// Fetch limited records with JOIN to get user fullname and hotel name
$select = "SELECT hb.*, 
                  u.fullname AS user_fullname, 
                  h.location AS hotel_name 
           FROM hotelbookings hb
           LEFT JOIN users u ON hb.user_id = u.id
           LEFT JOIN hotels h ON hb.hotel_id = h.id
           ORDER BY hb.id DESC 
           LIMIT $limit OFFSET $offset";
$res = mysqli_query($conn, $select);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Hotel Booking Details</title>
    <link rel="stylesheet" href="view-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

        .status-paid {
            color: #28a745;
            font-weight: bold;
        }

        .status-pending {
            color: #dc3545;
            font-weight: bold;
        }

        .delete-btn {
            background: #dc3545;
            color: #fff;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.3s;
        }

        .delete-btn:hover {
            background: #c82333;
        }

        
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center" style="margin-top: 80px;">
        <div class="admin-panel">
            <h2>Booking Details</h2>
            <input type="text" id="search-box"
                placeholder="🔍 Search by Name, User, Hotel, Guests, Check-in or Check-out..." />

            <div class="table-responsive" id="booking-data">
                <table class="table table-light table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>User ID</th>
                            <th>Hotel</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Guests</th>
                            <th>Payments</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo !empty($row['user_fullname']) ? $row['user_fullname'] : 'Unknown'; ?></td>
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo !empty($row['hotel_name']) ? $row['hotel_name'] : 'N/A'; ?></td>
                                <td><?php echo date('d-M-Y', strtotime($row['checkin_date'])); ?></td>
                                <td><?php echo date('d-M-Y', strtotime($row['checkout_date'])); ?></td>
                                <td><?php echo $row['guests']; ?></td>
                                <td>
                                    <?php if (strtolower($row['payment_status']) == 'paid successfully') { ?>
                                        <span class="status-paid"><i class="fas fa-check-circle"></i>
                                            </span>
                                    <?php } else { ?>
                                        <span class="status-pending"><i class="fas fa-times-circle"></i>
                                            </span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="viewhotelbooking.php?d_id=<?php echo $row['id']; ?>" class="btn delete-btn"
                                        onclick="return confirm('Are you sure to delete this booking?');">Delete</a>
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
                    <a href="?page=<?php echo $i; ?>" class="<?php if ($i == $page)
                           echo 'active'; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>">Next &raquo;</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- AJAX Live Search -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#search-box").on("keyup", function () {
                let query = $(this).val();
                $.ajax({
                    url: "fetchHotelBooking.php",
                    method: "POST",
                    data: { query: query },
                    success: function (data) {
                        $("#booking-data").html(data);
                        $("#pagination").hide();
                    }
                });
            });
        });
    </script>

</body>

</html>

<?php include("footer.php"); ?>