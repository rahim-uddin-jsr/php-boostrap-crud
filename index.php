<?php
include('header.php');
include('connectDb.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $s_email = mysqli_real_escape_string($data, $email);
    $comment = $_POST['comment'];
    $s_comment = mysqli_real_escape_string($data, $comment);
    $imageName = "images/" . $_FILES['image']['name'];
    $query = "INSERT INTO comments(email,comment,images) VALUES('$s_email','$s_comment','$imageName')";
    $result = mysqli_query($data, $query);
    if ($result) {
        echo "INSERTED successfully";
        header("Location: comments.php");
    } else {
        echo "bd update error";
    }
    $allowedTypes = array(
        'image/jpeg',
        'image/png',
        'image/jpg',
        'image/webp',
    );
    if ($_FILES['image']) {
        if (in_array($_FILES['image']['type'], $allowedTypes) !== false && $_FILES['image']['size'] < 5 * 1024 * 1024) {
            move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $_FILES['image']['name']);
        }
    }
}

?>


<div class="container-sm mt-5">
    <h2 class="text-center">Write your opinion</h2>
    <form class="mx-auto w-50" action="index.php" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input required type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput3" class="form-label">Upload Image</label>
            <input required type="file" class="form-control" name="image" id="exampleFormControlInput3" placeholder="name@example.com">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
            <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3" required></textarea>
        </div>
        <button class="btn btn-primary" name="submit" value="Post">Post</button>
    </form>
</div>

<?php
include('footer.php')
?>