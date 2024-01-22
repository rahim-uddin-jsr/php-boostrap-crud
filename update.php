<?php
// Encryption function
function encryptId($id)
{
    // Use a secret key for added security
    // $key = "your_secret_key";
    // return base64_encode($id ^ $key);
    return rtrim(strtr(base64_encode($id), '+/', '-_'), '=');
}

// Decryption function
function decryptId($encryptedId)
{
    // Use a secret key for added security
    // $key = "your_secret_key";
    // return base64_decode($encryptedId) ^ $key;
    return base64_decode(str_pad(strtr($encryptedId, '-_', '+/'), strlen($encryptedId) % 4, '=', STR_PAD_RIGHT));
}

// Usage example

// Get the id from the URL
$idFromUrl = $_GET['id'];

// Encrypt the id for use in the URL
$encryptedId = encryptId($idFromUrl);

// Use the encrypted id in the URL
$url = "http://localhost/crud/update.php?id=" . $encryptedId;

echo "Encrypted URL: $url\n";

// Decrypt the id when processing the URL
$decryptedId = decryptId($encryptedId);

echo "Decrypted ID: $decryptedId\n";
?>



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
    $updated_imageName = "images/" . $_FILES['updated_image']['name'];
    // echo $updated_imageName;
    $s_updateEmail = $_POST['updateEmail'];
    $s_updateComment = $_POST['updateComment'];
    $updateByIdQuery = "UPDATE comments SET email='$s_updateEmail', comment='$s_updateComment',images='$updated_imageName' WHERE ID='{$_GET['id']}'";
    $updateResult = mysqli_query($data, $updateByIdQuery);
    if ($updateResult) {
        echo "updated";
        header("Location: comments.php");
    } else {
        echo "update error!";
    }

    $allowedTypes = array(
        'image/jpeg',
        'image/png',
        'image/jpg',
        'image/webp',
    );
    if ($_FILES['updated_image']) {
        if (in_array($_FILES['updated_image']['type'], $allowedTypes) !== false && $_FILES['image']['size'] < 5 * 1024 * 1024) {
            move_uploaded_file($_FILES['updated_image']['tmp_name'], "images/" . $_FILES['image']['name']);
        }
    }
}
?>
<div class="container-sm mt-5">
    <h2 class="text-center my-5 ">Update comment which id is <?php echo "{$_GET['id']}"; ?></h2>
    <form class="mx-auto w-50" enctype="multipart/form-data" action="update.php?id=<?php echo "{$_GET['id']}" ?>" method="post">
        <div class="mb-3">
            <label for="updateEmail" class="form-label">Email address</label>
            <input required type="email" class="form-control" name="updateEmail" id="updateEmail" placeholder="name@example.com" value="<?php echo "{$singleComment['email']}" ?>">
        </div>
        <img class="img-fluid responsive img-thumbnail rounded w-25" src="<?php echo $singleComment['images'] ?>" alt="">
        <div class="mb-3">
            <label for="exampleFormControlInput3" class="form-label">Upload Image</label>
            <input required type="file" class="form-control" name="updated_image" id="exampleFormControlInput3" placeholder="name@example.com">
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
