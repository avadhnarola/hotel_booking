<?php
ob_start();
include("../db.php");
include("header.php");

if (isset($_GET['u_id'])) {
    $id = $_GET['u_id'];
    $res = mysqli_query($conn, "SELECT * FROM restaurant WHERE id=$id");
    $u_data = mysqli_fetch_assoc($res);
}

if (isset($_POST['submit'])) {
    $price = $_POST['price'];
    $shopName = $_POST['shopName'];
    $location = $_POST['location'];
    $star = $_POST['star'];
    $rate = $_POST['rate'];
    $img = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],"images/$img");

    if ($id) {
        $sql = "UPDATE restaurant SET price='$price',shopName='$shopName',location='$location',star='$star',image='$img',rate='$rate'WHERE id=$id";
    } else {
        $sql = "INSERT INTO restaurant (price, shopName, location, star, image, rate) VALUES ('$price', '$shopName', '$location', '$star', '$img', '$rate')";
    }

    $data = mysqli_query($conn, $sql);

    if ($data) {
        header("Location: viewRestaurant.php");
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
    <title>Add/Edit restaurant</title>
    <link rel="stylesheet" href="form-style.css">
</head>

<body>

    <div class="container d-flex justify-content-center">
        <div class="admin-panel">
            <h2>Add Restaurant</h2>
            <form method="POST" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label>Shop Name</label>
                    <input type="text" name="shopName" value="<?php echo @$u_data['shopName']; ?>" />
                    
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" value="<?php echo @$u_data['location']; ?>" />
                </div>
                
                <div class="form-group">
                    <label>Start At</label>
                    <input type="number" name="price" value="<?php echo @$u_data['price']; ?>" required />
                </div>
                

                <div class="form-group">
                    <label>Star Rating</label>
                    <select name="star">
                        <option value="">Rating by Star</option>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <option value="<?= $i ?>" <?php if (@$u_data['star'] == $i)
                                  echo 'selected'; ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control"/>
                    <?php if (!empty($u_data['image'])): ?>
                        <p>Current Image: <img src="images/<?php echo $u_data['image']; ?>" width="100" /></p>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Rate</label>
                    <input type="number" name="rate" value="<?php echo @$u_data['rate']; ?>" />
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