<?php
include("../db.php");

$output = "";

if (isset($_POST['query'])) {
    $search = mysqli_real_escape_string($conn, $_POST['query']);
    $query = "SELECT * FROM booking 
              WHERE name LIKE '%$search%' 
              OR email LIKE '%$search%' 
              OR location LIKE '%$search%' 
              OR HotelType LIKE '%$search%'
              OR price LIKE '%$search%'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $output .= '<table class="table table-light table-hover table-striped">
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
                        <tbody>';

        while ($row = mysqli_fetch_assoc($result)) {
            $statusClass = strtolower($row['status']) == 'approved' ? 'status-approved' : 'status-rejected';
            $icon = strtolower($row['status']) == 'approved'
                ? '<i class="icon ion-ios-checkmark-circle icon-status"></i>'
                : '<i class="icon ion-ios-close-circle icon-status"></i>';

            $output .= '<tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['name'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['check_in'] . '</td>
                            <td>' . $row['check_out'] . '</td>
                            <td>' . $row['location'] . '</td>
                            <td>' . $row['price'] . '</td>
                            <td>' . $row['HotelType'] . '</td>
                            <td><span class="' . $statusClass . '">' . $icon . ' ' . $row['status'] . '</span></td>
                            <td>
                                <a href="viewBooking.php?d_id=' . $row['id'] . '" 
                                   class="btn delete-btn"
                                   onclick="return confirm(\'Are you sure to delete this booking?\');">Delete</a>
                            </td>
                        </tr>';
        }

        $output .= '</tbody></table>';
    } else {
        $output = '<h4 style="color:red;text-align:center;">No records found 😞</h4>';
    }
}

echo $output;
?>
