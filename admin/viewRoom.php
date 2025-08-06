<?php
ob_start();
include("../db.php");
include("header.php");

// Handle delete
if (isset($_GET['d_id'])) {
    $id = intval($_GET['d_id']);
    $del = "DELETE FROM Room WHERE id = $id";
    mysqli_query($conn, $del);
    header("Location: viewRoom.php");
    exit();
}

$select = "SELECT * FROM Room";
$res = mysqli_query($conn, $select);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Rooms</title>
    <link rel="stylesheet" href="view-style.css">
    <link rel="stylesheet" href="assets/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="../css/aos.css">
    <link rel="stylesheet" href="../css/ionicons.min.css">
    <link rel="stylesheet" href="../css/flaticon.css">
    <link rel="stylesheet" href="../css/icomoon.css">
</head>

<body>


    <div class="container-fluid">
        <div class="button-container">
            <a href="addRoom.php" class=" btn btn-add">+ <b>Rooms</b></a>

        </div>
    </div>



    <div class="container d-flex justify-content-center">
        <div class="admin-panel">
            <h2>View Rooms</h2>
            <div class="table-responsive">

                <table class="table table-light table-hover table-striped">
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
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td style="text-align:left"><?php echo $row['description']; ?></td>
                                <td><?php echo $row['location']; ?></td>
                
                                <td>
                                    <?php if (!empty($row['image'])): ?>
                                        <img src="images/<?php echo $row['image']; ?>" style="height:60px;width:90px;" />
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="addRoom.php?u_id=<?php echo $row['id']; ?>" class="btn edit-btn">Edit</a>
                                </td>
                                <td>
                                    <a href="viewRoom.php?d_id=<?php echo $row['id']; ?>" class="btn delete-btn"
                                        onclick="return confirm('Are you sure to delete this Room?');">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>

<?php include("footer.php"); ?>