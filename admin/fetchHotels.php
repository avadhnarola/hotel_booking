<?php
include("../db.php");

$search = mysqli_real_escape_string($conn, $_POST['search']);

$query = "SELECT * FROM hotels WHERE name LIKE '%$search%' OR location LIKE '%$search%'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td>
                <?php
                for ($i = 0; $i < $row['star']; $i++)
                    echo '★';
                for ($j = $row['star']; $j < 5; $j++)
                    echo '☆';
                ?>
            </td>
            <td>
                <?php if (!empty($row['image'])): ?>
                    <img src="images/<?php echo $row['image']; ?>" style="height:60px;width:90px;" />
                <?php endif; ?>
            </td>
            <td>
                <?php if (!empty($row['room_images'])): ?>
                    <?php foreach (explode(',', $row['room_images']) as $img): ?>
                        <img src="images/<?php echo $img; ?>" width="50" class="room-img" />
                    <?php endforeach; ?>
                <?php endif; ?>
            </td>
            <td><?php echo $row['rate']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td>
                <?php if (!empty($row['services'])): ?>
                    <?php foreach (explode(',', $row['services']) as $srv): ?>
                        <span class="service-badge"><?php echo ucfirst($srv); ?></span>
                    <?php endforeach; ?>
                <?php endif; ?>
            </td>
            <td>
                <a href="addHotel.php?u_id=<?php echo $row['id']; ?>" class="btn edit-btn">Edit</a>
            </td>
            <td>
                <a href="viewHotel.php?d_id=<?php echo $row['id']; ?>" class="btn delete-btn"
                    onclick="return confirm('Are you sure to delete this hotel?');">Delete</a>
            </td>
        </tr>
        <?php
    }
} else {
    echo '<tr><td colspan="12">No hotels found.</td></tr>';
}
?>