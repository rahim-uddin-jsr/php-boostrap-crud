<?php
include('header.php');
include('connectDb.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $comment = $_POST['comment'];
    $query = "INSERT INTO comments(email,comment) VALUES('$email','$comment')";
    $result = mysqli_query($data, $query);
    if ($result) {
        echo "updated successfully";
        header("Location: comments.php");
    } else {
        echo "bd update error";
    }
}
?>
<div class="container-sm mt-5">
    <h2 class="text-center">Write your opinion</h2>
    <form class="mx-auto w-50" action="index.php" method="post">

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input required type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="name@example.com">
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