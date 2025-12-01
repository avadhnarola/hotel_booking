<?php
session_start();
include("../db.php");

if (!isset($_SESSION['admin_id'])) {
    header("location:index.php");
    exit();
}

if (isset($_POST['query']) && !empty($_POST['query'])) {
    $search = mysqli_real_escape_string($conn, $_POST['query']);
    $query = "SELECT hb.*, 
                     u.fullname AS user_fullname, 
                     h.location AS hotel_name
              FROM hotelbookings hb
              LEFT JOIN users u ON hb.user_id = u.id
              LEFT JOIN hotels h ON hb.hotel_id = h.id
              WHERE u.fullname LIKE '%$search%' 
                 OR hb.user_id LIKE '%$search%' 
                 OR h.location LIKE '%$search%'
                 OR hb.guests LIKE '%$search%' 
                 OR hb.checkin_date LIKE '%$search%' 
                 OR hb.checkout_date LIKE '%$search%'
              ORDER BY hb.id DESC";
} else {
    $query = "SELECT hb.*, 
                     u.fullname AS user_fullname, 
                     h.location AS hotel_name
              FROM hotelbookings hb
              LEFT JOIN users u ON hb.user_id = u.id
              LEFT JOIN hotels h ON hb.hotel_id = h.id
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
                    <th>Hotel</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Guests</th>
                    <th>Payments</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $checkin  = !empty($row['checkin_date']) ? date('d-M-Y', strtotime($row['checkin_date'])) : '-';
        $checkout = !empty($row['checkout_date']) ? date('d-M-Y', strtotime($row['checkout_date'])) : '-';
        $payment  = strtolower($row['payment_status']) == 'paid successfully' 
                    ? '<span class="status-paid"><i class="fas fa-check-circle"></i></span>' 
                    : '<span class="status-pending"><i class="fas fa-times-circle"></i></span>';

        $output .= '<tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . (!empty($row['user_fullname']) ? $row['user_fullname'] : 'Unknown') . '</td>
                        <td>' . $row['user_id'] . '</td>
                        <td>' . (!empty($row['hotel_name']) ? $row['hotel_name'] : 'N/A') . '</td>
                        <td>' . $checkin . '</td>
                        <td>' . $checkout . '</td>
                        <td>' . $row['guests'] . '</td>
                        <td>' . $payment . '</td>
                        <td>
                            <a href="viewHotelBooking.php?d_id=' . $row['id'] . '" 
                               class="btn delete-btn"
                               onclick="return confirm(\'Are you sure to delete this booking?\');">Delete</a>
                        </td>
                    </tr>';
    }
} else {
    $output .= '<tr><td colspan="9" style="text-align:center;">No Records Found</td></tr>';
}

$output .= '</tbody></table>';
echo $output;
