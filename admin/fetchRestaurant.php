<?php
session_start();
include("../db.php");

// Check admin login
if (!isset($_SESSION['admin_id'])) {
    header("location:index.php");
    exit();
}

// Search term
$search = isset($_POST['query']) ? mysqli_real_escape_string($conn, $_POST['query']) : '';

// SQL query
if ($search != '') {
    $sql = "SELECT * FROM restaurant 
            WHERE location LIKE '%$search%' 
               OR shopName LIKE '%$search%' 
               OR price LIKE '%$search%' 
               OR rate LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM restaurant ORDER BY id DESC";
}

$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
    echo '<table class="table table-light table-hover table-striped">
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
            <tbody>';

    while ($row = mysqli_fetch_assoc($res)) {
        echo '<tr>
                <td>' . htmlspecialchars($row['id']) . '</td>
                <td>' . htmlspecialchars($row['location']) . '</td>
                <td>' . htmlspecialchars($row['shopName']) . '</td>
                <td>$' . htmlspecialchars($row['price']) . '</td>
                <td>';

        // Show stars
        $star = intval($row['star']);
        for ($i = 0; $i < $star; $i++) echo '★';
        for ($j = $star; $j < 5; $j++) echo '☆';

        echo '</td>
                <td>';
        if (!empty($row['image'])) {
            echo '<img src="images/' . htmlspecialchars($row['image']) . '" style="height:60px;width:90px;object-fit:cover;border-radius:6px;"/>';
        } else {
            echo 'No Image';
        }
        echo '</td>
                <td>' . htmlspecialchars($row['rate']) . '</td>
                <td><a href="addRestaurant.php?u_id=' . $row['id'] . '" class="btn edit-btn">Edit</a></td>
                <td><a href="viewRestaurant.php?d_id=' . $row['id'] . '" class="btn delete-btn" onclick="return confirm(\'Are you sure to delete this restaurant?\');">Delete</a></td>
              </tr>';
    }

    echo '</tbody></table>';
} else {
    echo "<p style='text-align:center;color:red;'>No records found!</p>";
}
?>
