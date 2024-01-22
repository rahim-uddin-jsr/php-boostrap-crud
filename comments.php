<?php
include('header.php');
include('connectDb.php');
$sql = "SELECT * FROM comments";
$comments = mysqli_query($data, $sql);

echo "<h2 class='text-center mt-5 mb-3'>All comments</h2>";
// Check if there are rows in the result set
if ($comments->num_rows > 0) {
    echo '<table class="table">';
    echo '<thead><tr><th scope="col">ID</th><th scope="col">Email</th><th scope="col">Comment</th> <th scope="col">Action</th><th scope="col">Update</th></tr></thead>';
    echo '<tbody>';
    $index = 1;
    while ($row = $comments->fetch_assoc()) {
        echo '<tr>';
        echo '<th>' . $index . '</th>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['comment'] . '</td>';
        echo "<td><a class='btn btn-danger rounded ' href='delete.php?id={$row['ID']}'><i class='fa-solid fa-trash'></i></a></td>";
        echo "<td><a class='btn btn-secondary rounded ' href='update.php?id={$row['ID']}'><i class='fa-regular fa-pen-to-square'></i></a></td>";
        echo '</tr>';
        $index++;
    }
    echo '</tbody></table>';
} else {
    echo "0 results";
}
include('footer.php');
