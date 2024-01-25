<?php ob_start(); ?>
<?php
// Get the current page URL
$current_page_url = $_SERVER['REQUEST_URI'];

// Define an array of navigation links and their corresponding URLs

$nav_links = array(
    'Home' => '/crud/',
    'All Comments' => '/crud/comments.php',
    'Gallery' => '/crud/gallery.php',
    // Add more links as needed
);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP_CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/08ec2d528c.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- <?php echo $current_page_url ?> -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light bg-gradient border">
        <div class="container-fluid">
            <a class="navbar-brand" href="/crud/">PHP_CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/crud">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/crud/comments.php">All Comments</a>
                    </li> -->
                    <?php
                    // Iterate through the navigation links
                    foreach ($nav_links as $label => $url) {
                        // Check if the current page URL matches the link URL
                        $active_class = ($current_page_url == $url) ? 'active bg-primary text-light rounded fw-bolder' : '';

                        // Output the navigation link with the active class
                        echo "<li class='$active_class nav-item'><a class='nav-link' aria-current='page' href='$url' >$label</a></li>";
                    }
                    ?>
                </ul>
                <form class="d-flex" action="search-comment.php" method="post">
                    <input name='search_text' class="form-control me-2" type="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>