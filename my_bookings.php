<?php
ob_start();
// session_start();
include 'db.php';
include 'header.php';

if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = "Please login first.";
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user']['id'];
$result = mysqli_query($conn, "SELECT b.*, h.location, h.image, h.price 
                               FROM hotelBookings b 
                               JOIN hotels h ON b.hotel_id = h.id 
                               WHERE b.user_id = '$user_id'
                               ORDER BY b.created_at DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>My Bookings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>My Bookings</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hotel</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Guests</th>
                    <th>Price / Night</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td>
                            <img src="admin/images/<?php echo $row['image']; ?>" width="80" class="mr-2 rounded">
                            <?php echo $row['location']; ?>
                        </td>
                        <td><?php echo $row['checkin_date']; ?></td>
                        <td><?php echo $row['checkout_date']; ?></td>
                        <td><?php echo $row['guests']; ?></td>
                        <td>$<?php echo $row['price']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
include 'footer.php'; ?>