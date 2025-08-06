<?php
ob_start();
include("../db.php");
include("header.php");

if (isset($_GET['u_id'])) {
    $id = $_GET['u_id'];

    $u_data = mysqli_query($conn, "select * from service where id=$id");
    $u_data = mysqli_fetch_assoc($u_data);
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $icon = $_POST['icon'];

    if (isset($_GET['u_id'])) {

        mysqli_query($conn, "update service set title='$title',content='$content',icon='$icon' where id=$id");
        header('location:viewService.php');
    } else {

        $data = mysqli_query($conn, "INSERT INTO service(title, content, icon) VALUES ('$title', '$content', '$icon')");
    }


    if ($data) {
        header("Location: viewService.php");
        exit();
    } else {
        echo "Insert failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service Form</title>
    <link rel="stylesheet" href="form-style.css">
</head>



<body>

    <div class="container d-flex justify-content-center">
        <div class="admin-panel">
            <h2>Add Services</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" required value="<?php echo @$u_data['title']; ?>" />
                </div>

                <!-- <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category">
                        <option value="">Select a category</option>
                        <option value="news">News</option>
                        <option value="updates">Updates</option>
                        <option value="events">Events</option>
                    </select>
                </div> -->

                <div class="form-group">
                    <label for="content">Content</label>
                   <textarea id="content" name="content" rows="5"><?php echo @$u_data['content']; ?></textarea>

                </div>
                <div class="form-group">
                    <label for="icon">Icon</label>
                    <input type="text" id="icon" name="icon" required value="<?php echo @$u_data['icon']; ?>"/>
                </div>
                <div class="form-actions">
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
                </div>
            </form>
        </div>
    </div>
</body>


</html>
<?php
include("footer.php");
?>