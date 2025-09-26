<?php
include("../db.php");
if (!isset($_SESSION['admin_id'])) {
    header("location:index.php");
} else {
    header("loaction:dashboard.php");
}

$search = isset($_POST['query']) ? mysqli_real_escape_string($conn, $_POST['query']) : '';

if ($search != '') {
    $sql = "SELECT * FROM hotels WHERE location LIKE '%$search%' OR price LIKE '%$search%' OR rate LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM hotels ORDER BY id DESC";
}

$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
    echo '<table class="table table-light table-hover table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Location</th>
                    <th>Price</th>
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
                <td>'.$row['id'].'</td>
                <td>'.$row['location'].'</td>
                <td>'.$row['price'].'</td>
                <td>';
        for ($i = 0; $i < $row['star']; $i++) echo '★';
        for ($j = $row['star']; $j < 5; $j++) echo '☆';
        echo '</td>
                <td>';
        if (!empty($row['image'])) {
            echo '<img src="images/'.$row['image'].'" style="height:60px;width:90px;"/>';
        }
        echo '</td>
                <td>'.$row['rate'].'</td>
                <td><a href="addHotel.php?u_id='.$row['id'].'" class="btn edit-btn">Edit</a></td>
                <td><a href="viewHotel.php?d_id='.$row['id'].'" class="btn delete-btn" onclick="return confirm(\'Are you sure to delete this hotel?\');">Delete</a></td>
              </tr>';
    }

    echo '</tbody></table>';
} else {
    echo "<p style='text-align:center;color:red;'>No records found!</p>";
}
?>
