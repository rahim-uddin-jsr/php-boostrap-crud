<?php
include('header.php');
include('connectDb.php');

$g_sql = "SELECT * FROM gallery";
$gallery_images_result = mysqli_query($data, $g_sql);

?>
<h2 class="text-center text-primary mb-5">Gallery</h2>
<div class="container-md border">
    <div class="w-100 d-flex align-items-center justify-content-start">
        <a href="multiple-img.php" class="btn btn-primary my-5">Upload more</a>
    </div>
    <?php
    if ($gallery_images_result->num_rows > 0) {
        $index = 1;
        echo   "<div class='row g-5  align-items-center h-100'>";
        while ($row = $gallery_images_result->fetch_assoc()) {
            $src = $row['images'];
            echo "
            <div class='col-4'>
            <img class='img-fluid' style='height:400px' src='$src' alt=''>
            </div>";
            $index++;
        }
        echo "</div>";
    }

    ?>

</div>

<?php
include('footer.php')
?>