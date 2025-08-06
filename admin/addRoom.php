<?php
ob_start();
include("../db.php");
include("header.php");

if (isset($_GET['u_id'])) {
    $id = $_GET['u_id'];
    $res = mysqli_query($conn, "SELECT * FROM Room WHERE id=$id");
    $u_data = mysqli_fetch_assoc($res);
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $location = $_POST['location'];

    $img = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "images/$img");

    if ($id) {
        $sql = "UPDATE Room SET title='$title' , price='$price', description='$description' , location='$location', image='$img' WHERE id=$id";
    } else {
        $sql = "INSERT INTO Room (title, price, description,location, image) VALUES ('$title','$price', '$description', '$location', '$img')";
    }

    $data = mysqli_query($conn, $sql);

    if ($data) {
        header("Location: viewRoom.php");
        exit();
    } else {
        echo "Operation failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add/Edit Room</title>
    <link rel="stylesheet" href="form-style.css">
</head>

<body>

    <div class="container d-flex justify-content-center">
        <div class="admin-panel">
            <h2>Add Rooms</h2>
            <form method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="<?php echo @$u_data['title']; ?>" />

                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" value="<?php echo @$u_data['price']; ?>" />
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" value="<?php echo @$u_data['description']; ?>" required />
                </div>

                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" value="<?php echo @$u_data['location']; ?>" required />
                </div>

                


                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" />
                    <?php if (!empty($u_data['image'])): ?>
                        <p>Current Image: <img src="images/<?php echo $u_data['image']; ?>" width="100" /></p>
                    <?php endif; ?>
                </div>

                <div class="form-actions">
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
                </div>
            </form>
        </div>
    </div>

</body>

</html>

<?php include("footer.php"); ?>