<?php
include('connectDb.php');

$s_ID = $_GET['id'];
echo $s_ID;


$deleteOneQuery = "DELETE FROM comments WHERE ID = '$s_ID'";
$deleteOneQueryResult = mysqli_query($data, $deleteOneQuery);

if ($deleteOneQueryResult) {
    echo "Record deleted successfully.";
    header('Location: comments.php');
} else {
    echo "Error deleting record: " . mysqli_error($data);
}
mysqli_close($data);