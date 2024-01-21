<?php

include('connectDb.php');
include('header.php');

$s_id = $_GET['id'];
$pageLink = "update.php?id='$s_id'";
$getDataByIdSql = "SELECT * FROM comments where ID='{$_GET['id']}'";
$singleCommentByIdSqlResult = mysqli_query($data, $getDataByIdSql);
if ($singleCommentByIdSqlResult) {
    $singleComment = $singleCommentByIdSqlResult->fetch_assoc();
    // echo var_dump($singleComment);
}


if (isset($_POST['update'])) {

    $s_updateEmail = $_POST['updateEmail'];
    $s_updateComment = $_POST['updateComment'];
    $updateByIdQuery = "UPDATE comments SET email='$s_updateEmail', comment='$s_updateComment' WHERE ID='{$_GET['id']}'";
    $updateResult = mysqli_query($data, $updateByIdQuery);
    if ($updateResult) {
        echo "updated";
        header("Location: comments.php");
    } else {
        echo "update error!";
    }
}
?>
<div class="container-sm mt-5">
    <h2 class="text-center my-5 ">Update comment which id is <?php echo "{$_GET['id']}"; ?></h2>
    <form class="mx-auto w-50" action="update.php?id=<?php echo "{$_GET['id']}" ?>" method="post">
        <div class="mb-3">
            <label for="updateEmail" class="form-label">Email address</label>
            <input required type="email" class="form-control" name="updateEmail" id="updateEmail" placeholder="name@example.com" value="<?php echo "{$singleComment['email']}" ?>">
        </div>
        <div class="mb-3">
            <label for="updateComment" class="form-label">Example textarea</label>
            <textarea class="form-control" name="updateComment" id="updateComment" rows="3" required><?php echo "{$singleComment['comment']}" ?></textarea>
        </div>
        <button class="btn btn-primary" id="update" name="update">Update</button>
    </form>
</div>
<?php
include('footer.php');
