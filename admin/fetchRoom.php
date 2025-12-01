<?php
session_start();
include("../db.php");

// Optional: check session only if you want to restrict AJAX
if (!isset($_SESSION['admin_id'])) {
    echo "<p style='color:red; text-align:center;'>Unauthorized access.</p>";
    exit();
}

if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    $query = "SELECT * FROM room 
              WHERE title LIKE '%$search%' 
              OR location LIKE '%$search%' 
              OR price LIKE '%$search%'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table table-light table-hover table-striped">
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
                <tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . htmlspecialchars($row['title']) . '</td>
                    <td>' . htmlspecialchars($row['price']) . '</td>
                    <td style="text-align:left">' . htmlspecialchars($row['description']) . '</td>
                    <td>' . htmlspecialchars($row['location']) . '</td>
                    <td>';
            if (!empty($row['image'])) {
                echo '<img src="images/' . htmlspecialchars($row['image']) . '" style="height:60px;width:90px;" />';
            }
            echo '</td>
                    <td><a href="addRoom.php?u_id=' . $row['id'] . '" class="btn edit-btn">Edit</a></td>
                    <td><a href="viewRoom.php?d_id=' . $row['id'] . '" class="btn delete-btn"
                           onclick="return confirm(\'Are you sure to delete this Room?\');">Delete</a></td>
                  </tr>';
        }
        echo '</tbody></table>';
    } else {
        echo "<p style='color:red; text-align:center;'>No matching rooms found!</p>";
    }
}
