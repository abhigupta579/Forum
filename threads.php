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
    require 'header.php';

    //Particular Thread is being Fetched...
    $id = $_GET['catid'];  //catid is used to get Category ID...
    $sql = "SELECT * FROM `categories` WHERE `category_id`=$id";
    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $catname = $row['category_name'];
        $catdesc = $row['category_description'];
    }
    ?>
    <!-- jumbotron is used... -->
    <div class="container bg-light mt-4">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname ?> forums...</h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>


    <!-- Questions are being Asked here about that Particular Thread... -->
    <?php
    echo '
    <div class="container media" style="margin-top: 50px;">
        <h1>Ask a Question : </h1>
        <!-- Questions are being Asked here by FORMS... -->
        <div class="formQ  bg-light mt-2 mb-3 p-3">
            <form action="/forum/threads.php?catid=' . $id . '" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Problem title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
                        placeholder="Enter Your Query here...">
                    <small id="problemHelp" class="form-text text-muted">Keep your title as short as possible .</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Elaborate your Problem</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>';


    //Adding Questions via FORM...
    $method = $_SERVER['REQUEST_METHOD'];
    //  echo $method;

    //Thread Post Query is run here...
    if ($method == 'POST') {
        $th_title = $_POST['title'];
        $th_desc = $_POST['desc'];
        $sql = "INSERT INTO `thread` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '0', '2023-11-28 08:52:44.000000')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "<br>Your Thread has been Added.";
        } else {
            die("<br>Thread not Added");
        }
    }
    ?>
    <h2>Browse Questions : </h2>
    <?php
    //Threads Query are being run...
    $id = $_GET['catid']; //catid is used bcz of that required category...
    $sql = "SELECT * FROM `thread` WHERE `thread_cat_id`=$id"; //Thread_cat_id is Used to Discuss about Individual Categories...
    $result = mysqli_query($con, $sql);
    //To check whether Result exists or not...
    $noResult = true; //By default NO result let assume...
    while ($row = mysqli_fetch_assoc($result)) {
        $noResult = false;
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_time = $row['timestamp'];

        //    Media-Objects are Used...
        //Questions are Found here...
        echo '<div class="media mt-4">
            <img class="mr-3" src="https://source.unsplash.com/40x40/?coding,code" class="card-img"
                alt="Generic placeholder image" style="float:left; margin-right: 5px">
            <div class="media-body">
            <p><b>User</b> asked at ' . $thread_time . '</p>
                <h6 class="mt-0 ms-5" style="margin-top: -20px; display: inline-block"><a href="/forum/threadq.php?threadid=' . $id . '" class="text-dark text-decoration-none">' . $title . '</a></h6><h6 class="ms-5">' . $desc . '
            </h6></div>
    </div>';
    }

    // echo var_dump($noResult);
    if ($noResult) {
        echo '<div class="jumbotron jumbotron-fluid bg-light p-5">
            <div class="container">
              <p class="display-4">No Questions asked so far.</p>
              <p class="lead">Be the 1st Person to Ask the Questions.</p>
            </div>
          </div>';
    }
    ?>

    <?php require 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>