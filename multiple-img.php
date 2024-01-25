<?php
include('header.php');
include('connectDb.php');
if (isset($_POST['upload_gallery'])) {
    $allowedTypes = array(
        'image/jpeg',
        'image/png',
        'image/jpg',
        'image/webp',
    );
    if ($_FILES['gallery_image_input']) {
        $upload_done;
        $totalFiles = count($_FILES['gallery_image_input']['name']);
        for ($i = 0; $i < $totalFiles; $i++) {
            if (in_array($_FILES['gallery_image_input']['type'][$i], $allowedTypes) !== false && $_FILES['image']['size'][$i] < 5 * 1024 * 1024) {
                $g_imageName = "images/" . $_FILES['gallery_image_input']['name'][$i];
                $g_query = "INSERT INTO gallery(images) VALUES('$g_imageName')";
                $g_result = mysqli_query($data, $g_query);
                if ($g_result) {
                    // echo "INSERTED successfully";
                    move_uploaded_file($_FILES['gallery_image_input']['tmp_name'][$i], "images/" . $_FILES['gallery_image_input']['name'][$i]);
                } else {
                    echo "bd update error";
                }
                header('Location: multiple-img.php');
            }
        }
    }
}

?>

<div class="container-sm mt-5">
    <h2 class="text-center">Upload photos for Gallery</h2>
    <form class="mx-auto w-50" action="multiple-img.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleFormControlInput3" class="form-label">Upload Image</label>
            <input multiple draggable="true" required type="file" class="form-control" name="gallery_image_input[]"
                id="exampleFormControlInput3" placeholder="name@example.com">
        </div>
        <!-- <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input required type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
            <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3" required></textarea>
        </div> -->
        <input type="submit" class="btn btn-primary" name="upload_gallery" value="Upload" />
    </form>
</div>

<?php
include('footer.php');
?>