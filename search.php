<?php
require 'dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
    $noResults = true;
    require 'header.php';
    //Search Results here...

    //Thread is being Fetched by Thread_id...
    $query = $_GET['search'];
    $sql = "SELECT * FROM `thread` WHERE MATCH(thread_title,thread_desc) against ('$query')";
    $result = mysqli_query($con, $sql);

    echo '<h2>Search Results for ' . $_GET['search'] . '</h2>';

    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_id = $row['thread_id'];
        $url = "threadq.php?threadid=" . $thread_id;
        
        $noResults=false;
        //Display the Searched Results here...
        echo '
         <div class="result">
             <h3><a href="' . $url . '" class="text-dark">' . $title . '</a></h3>
             <p>' . $desc . '</p>
     </div>';
    }

    if ($noResults) {
        echo "<br>No Results found. Please Enter correct keywords to find results...";
    }

    ?>
    <?php require 'footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>