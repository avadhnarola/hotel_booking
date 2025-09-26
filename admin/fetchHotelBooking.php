<?php
include("../db.php");
if (!isset($_SESSION['admin_id'])) {
    header("location:index.php");
} else {
    header("loaction:dashboard.php");
}

if (isset($_POST['query'])) {
    $search = mysqli_real_escape_string($conn, $_POST['query']);

    $query = "SELECT hb.*, u.fullname AS user_fullname 
              FROM hotelbookings hb
              LEFT JOIN users u ON hb.user_id = u.id
              WHERE u.fullname LIKE '%$search%' 
              OR hb.user_id LIKE '%$search%' 
              OR hb.hotel_id LIKE '%$search%' 
              OR hb.guests LIKE '%$search%' 
              OR hb.checkin_date LIKE '%$search%' 
              OR hb.checkout_date LIKE '%$search%'
              ORDER BY hb.id DESC";
} else {
    $query = "SELECT hb.*, u.fullname AS user_fullname 
              FROM hotelbookings hb
              LEFT JOIN users u ON hb.user_id = u.id
              ORDER BY hb.id DESC 
              LIMIT 4";
}

$result = mysqli_query($conn, $query);

$output = '<table class="table table-light table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>User ID</th>
                    <th>Hotel ID</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Guests</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Format dates to "19-Jan-2023"
        $checkin = !empty($row['checkin_date']) ? date('d-M-Y', strtotime($row['checkin_date'])) : '-';
        $checkout = !empty($row['checkout_date']) ? date('d-M-Y', strtotime($row['checkout_date'])) : '-';

        $output .= '<tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . (!empty($row['user_fullname']) ? $row['user_fullname'] : 'Unknown') . '</td>
                        <td>' . $row['user_id'] . '</td>
                        <td>' . $row['hotel_id'] . '</td>
                        <td>' . $checkin . '</td>
                        <td>' . $checkout . '</td>
                        <td>' . $row['guests'] . '</td>
                        <td>
                            <a href="viewhotelbooking.php?d_id=' . $row['id'] . '" 
                               class="btn delete-btn"
                               onclick="return confirm(\'Are you sure to delete this booking?\');">Delete</a>
                        </td>
                    </tr>';
    }
} else {
    $output .= '<tr><td colspan="8" style="text-align:center;">No Records Found</td></tr>';
}

$output .= '</tbody></table>';

echo $output;
?>