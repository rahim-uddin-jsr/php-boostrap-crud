<?php
include('header.php');
include('connectDb.php');
print_r($_POST['search_text']);
$s_text = $_POST['search_text'];
$s_c_sql = "SELECT * FROM comments
WHERE email LIKE '%$s_text%';";
$s_comments = mysqli_query($data, $s_c_sql);

if ($s_comments->num_rows > 0) {
    echo '<table class="table">';
    echo '<thead><tr><th scope="col">ID</th><th scope="col">Email</th><th scope="col">Comment</th> <th scope="col">Action</th><th scope="col">Update</th></tr></thead>';
    echo '<tbody>';
    $index = 1;
    while ($row = $s_comments->fetch_assoc()) {
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