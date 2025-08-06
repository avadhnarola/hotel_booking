<?php
ob_start();
include("../db.php");
include("header.php");


if (isset($_GET['d_id'])) {

    $del = "delete from service where id=" . $_GET['d_id'];
    mysqli_query($conn, $del);
    header("location:viewService.php");
}
$select = "select * from service";
$res = mysqli_query($conn, $select);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Services </title>
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
            <a href="addService.php" class=" btn btn-add">+ <b>Service</b></a>

        </div>
    </div>


    <div class="container d-flex justify-content-center">
        <div class="admin-panel">
            <h2>View Services</h2>
            <div class="table-responsive">


                <table class="table table-light table-hover table-striped">
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
                    <tbody>

                        <?php
                        while ($row = mysqli_fetch_assoc($res)) { ?>

                            <tr class="trow">

                                <td><?php echo $row['id']; ?></td>
                                <td class="icons ">
                                    <div class="icon justify-content-center align-items-center d-flex"><span
                                            class="<?php echo $row['icon']; ?>"></span></div>
                                </td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['content']; ?></td>
                                <td>
                                    <a href="addService.php?u_id=<?php echo $row['id']; ?>" class="btn edit-btn">Edit</a>
                                </td>
                                <td>
                                    <a href="viewService.php?d_id=<?php echo $row['id']; ?>" class="btn delete-btn"
                                        onclick="return confirm('Are you sure to delete this Service?');">Delete</a>
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
<?php
include("footer.php");
?>