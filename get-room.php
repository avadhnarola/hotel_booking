<?php
include "db.php";


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $room = $conn->query("SELECT * FROM Room WHERE id = $id")->fetch_assoc();
}
?>

<div class="col-md-12 room-wrap">
    <div class="row">
        <div class="col-md-7 d-flex">
            <div class="img align-self-stretch main-img"
                style="background-image: url('admin/images/<?php echo $room['image']; ?>'); height:400px;"></div>
        </div>
        <div class="col-md-5">
            <div class="text pb-5">
                <h3><?php echo $room['title']; ?></h3>

                <!-- ✅ Price is already displayed but we can keep it here -->
                <p class="pos">from <span class="price">$<?php echo $room['price']; ?></span>/night</p>

                <p><?php echo $room['description']; ?></p>
                <p>
                    <a href="#" class="btn btn-primary book-now-btn" data-title="<?php echo $room['title']; ?>"
                        data-image="admin/images/<?php echo $room['image']; ?>"
                        data-location="<?php echo $room['location']; ?>" data-price="<?php echo $room['price']; ?>" >
                        Book now
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>