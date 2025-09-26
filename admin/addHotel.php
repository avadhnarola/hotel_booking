<?php
ob_start();
include("../db.php");
include("header.php");

if (!isset($_SESSION['admin_id'])) {
    header("location:index.php");
} else {
    header("loaction:dashboard.php");
}

if (isset($_GET['u_id'])) {
    $id = $_GET['u_id'];
    $res = mysqli_query($conn, "SELECT * FROM hotels WHERE id=$id");
    $u_data = mysqli_fetch_assoc($res);
}

// ============================
// FORM SUBMIT LOGIC
// ============================
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $star = $_POST['star'];
    $rate = $_POST['rate'];
    $description = $_POST['description'];
    $services = isset($_POST['services']) ? implode(',', $_POST['services']) : '';

    // ---- Hotel Main Image ----
    if (!empty($_FILES['hotel_image']['name'])) {
        $hotel_img = time() . "_" . $_FILES['hotel_image']['name'];
        move_uploaded_file($_FILES['hotel_image']['tmp_name'], "images/$hotel_img");
    } else {
        $hotel_img = isset($u_data['image']) ? $u_data['image'] : '';
    }

    // ---- Room Images (Multiple) ----
    $room_images = [];
    if (!empty($_FILES['room_images']['name'][0])) {
        foreach ($_FILES['room_images']['name'] as $key => $img_name) {
            if (!empty($img_name)) {
                $unique_name = time() . "_" . $img_name;
                $img_tmp = $_FILES['room_images']['tmp_name'][$key];
                $img_path = "images/" . $unique_name;
                move_uploaded_file($img_tmp, $img_path);
                $room_images[] = $unique_name;
            }
        }
    } else {
        $room_images = isset($u_data['room_images']) ? explode(',', $u_data['room_images']) : [];
    }

    $images_str = implode(',', $room_images);

    // ---- Insert / Update ----
    if (isset($id) && !empty($id)) {
        $sql = "UPDATE hotels 
                SET name='$name',
                    price='$price',
                    location='$location',
                    star='$star',
                    image='$hotel_img',
                    room_images='$images_str',
                    rate='$rate',
                    description='$description',
                    services='$services'
                WHERE id=$id";
    } else {
        $sql = "INSERT INTO hotels (name, price, location, star, image, room_images, rate, description, services) 
                VALUES ('$name', '$price', '$location', '$star', '$hotel_img', '$images_str', '$rate', '$description', '$services')";
    }

    $data = mysqli_query($conn, $sql);

    if ($data) {
        header("Location: viewHotel.php");
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
    <title>Add/Edit Hotel</title>
    <link rel="stylesheet" href="form-style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
        }

        .admin-panel {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 700px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
            display: flex;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 8px 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .room-boxes {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .room-box {
            width: 80px;
            height: 80px;
            border: 2px dashed #aaa;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
            color: #555;
            cursor: pointer;
            border-radius: 6px;
            position: relative;
            background: #fafafa;
        }

        .room-box:hover {
            border-color: #007bff;
            color: #007bff;
        }

        .room-box input {
            display: none;
        }

        .room-box img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 6px;
            display: block;
            position: absolute;
        }

        /* Services Grid */
        .services-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 10px;
        }

        .service-option {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            padding: 10px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            cursor: pointer;
            transition: 0.3s;
            font-weight: 500;
            position: relative;
        }

        .service-option input {
            display: none;
        }

        .service-option .checkmark {
            width: 18px;
            height: 18px;
            border: 2px solid #4c3aec;
            border-radius: 4px;
            margin-right: 10px;
            position: relative;
            background: white;
            display: inline-flex;
        }

        .service-option input:checked+.checkmark {
            background: #4c3aec;
            width: 20px;
        }

        .service-option input:checked+.checkmark::after {
            content: "✓";
            color: white;
            position: absolute;
            top: -3px;
            left: 3px;
            font-size: 14px;
        }

        .service-option:hover {
            background: #eef0ff;
            border-color: #4c3aec;
        }

        .form-actions {
            text-align: right;
        }

        .btn {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
        }

        .btn:hover {
            background: #0056b3;
        }
    </style>
    <script>
        function triggerFileInput(index) {
            document.getElementById("fileInput" + index).click();
        }
        function previewImage(event, index) {
            const reader = new FileReader();
            reader.onload = function () {
                const img = document.getElementById("preview" + index);
                img.src = reader.result;
                img.style.display = "block";
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</head>

<body>
    <div class="container d-flex justify-content-center">
        <div class="admin-panel">
            <h2><?php echo isset($id) ? 'Edit Hotel' : 'Add Hotel'; ?></h2>
            <form method="POST" enctype="multipart/form-data">

                <!-- Hotel Name -->
                <div class="form-group">
                    <label>Hotel Name</label>
                    <input type="text" name="name" value="<?php echo @$u_data['name']; ?>" required />
                </div>

                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" value="<?php echo @$u_data['location']; ?>" required />
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" value="<?php echo @$u_data['price']; ?>" required />
                </div>

                <div class="form-group">
                    <label>Star Rating</label>
                    <select name="star" required>
                        <option value="">Rating by Star</option>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <option value="<?= $i ?>" <?php if (@$u_data['star'] == $i) echo 'selected'; ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <!-- Hotel Main Image -->
                <div class="form-group">
                    <label>Hotel Image</label>
                    <input type="file" name="hotel_image" class="form-control" />
                    <?php if (!empty($u_data['image'])): ?>
                        <p>Current Image: <img src="images/<?php echo $u_data['image']; ?>" width="100"></p>
                    <?php endif; ?>
                </div>

                <!-- Room Images Section -->
                <div class="form-group">
                    <label>Room Images</label>
                    <div class="room-boxes">
                        <?php for ($i = 1; $i <= 6; $i++): ?>
                            <div class="room-box" onclick="triggerFileInput(<?= $i ?>)">
                                <span id="plus<?= $i ?>">+</span>
                                <img id="preview<?= $i ?>" style="display:none;" />
                                <input type="file" name="room_images[]" id="fileInput<?= $i ?>" accept="image/*"
                                    onchange="previewImage(event, <?= $i ?>)" />
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
                <?php if (!empty($u_data['room_images'])): ?>
                    <p>Current Room Images:</p>
                    <?php foreach (explode(',', $u_data['room_images']) as $img): ?>
                        <img src="images/<?php echo $img; ?>" width="100" style="margin:5px;" />
                    <?php endforeach; ?>
                <?php endif; ?>

                <div class="form-group">
                    <label>Rate</label>
                    <input type="number" name="rate" value="<?php echo @$u_data['rate']; ?>" required />
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="4" required><?php echo @$u_data['description']; ?></textarea>
                </div>

                <!-- Services Section -->
                <div class="form-group">
                    <label>Services</label>
                    <div class="services-row">
                        <?php
                        $services_arr = [
                            'wifi' => 'WiFi',
                            'swimming pool' => 'Swimming Pool',
                            'breakfast' => 'Breakfast',
                            'parking' => 'Parking',
                            'air conditioning' => 'Air Conditioning'
                        ];
                        $selected_services = isset($u_data['services']) ? explode(',', $u_data['services']) : [];
                        foreach ($services_arr as $key => $label): ?>
                            <label class="service-option">
                                <input type="checkbox" name="services[]" value="<?= $key ?>" 
                                    <?php if (in_array($key, $selected_services)) echo 'checked'; ?>>
                                <span class="checkmark"></span>
                                <?= $label ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="form-actions text-center">
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php include("footer.php"); ?>
