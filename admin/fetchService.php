<?php
include("../db.php");
if (!isset($_SESSION['admin_id'])) {
    header("location:index.php");
} else {
    header("loaction:dashboard.php");
}

$search = isset($_POST['query']) ? mysqli_real_escape_string($conn, $_POST['query']) : '';

if ($search != '') {
    $sql = "SELECT * FROM service WHERE title LIKE '%$search%' OR content LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM service ORDER BY id DESC";
}

$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) > 0) {
    echo '<table class="table table-light table-hover table-striped">
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
            <tbody>';

    while ($row = mysqli_fetch_assoc($res)) {
        echo '<tr>
                <td>' . $row['id'] . '</td>
                <td class="icons">
                    <div class="icon justify-content-center align-items-center d-flex">
                        <span class="' . $row['icon'] . '"></span>
                    </div>
                </td>
                <td>' . $row['title'] . '</td>
                <td>' . $row['content'] . '</td>
                <td>
                    <a href="addService.php?u_id=' . $row['id'] . '" class="btn edit-btn">Edit</a>
                </td>
                <td>
                    <a href="viewService.php?d_id=' . $row['id'] . '" class="btn delete-btn" 
                       onclick="return confirm(\'Are you sure to delete this Service?\');">Delete</a>
                </td>
              </tr>';
    }

    echo '</tbody></table>';
} else {
    echo "<p style='text-align:center; padding:10px; color:red;'>No records found!</p>";
}
?>
