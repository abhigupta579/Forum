<?php
require 'dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
    require 'header.php';

    //Thread is being Fetched by Thread_id...
    $id = $_GET['threadid']; //Now, threadid is used instead of Catid to Open a Thread questions...
    $sql = "SELECT * FROM `thread` WHERE `thread_id`=$id";
    $result = mysqli_query($con, $sql);
    //To check whether Result exists or not...
    $noResult = true; //By default NO result let assume..
    while ($row = mysqli_fetch_assoc($result)) {
        $noResult = false;
        $id = $row['thread_id'];
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
    }

    //Comments are Posted...
    //Commenst Post Query is run here...
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $comment = $_POST['comment'];
        // die("The id in insertion is $id");
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_time`) VALUES ('$comment', '$id', current_timestamp());";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "<br>Your Comment has been Added.";
        } else {
            die("<br>Comment not Added");
        }
    }
    ?>
    <!-- jumbotron is used... -->
    <div class="container bg-light mt-4 p-4">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title ?></h1>
            <p class="lead"><?php echo $desc ?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p class="class"><b><i>Posted by : Abhi</i></b></p>
        </div>
    </div>
    <!-- Discussion... -->
    <div class="container media" style="margin-top: 50px;">
        <h1>Post a Comment : </h1>
        <!-- Comments are being done... -->
        <?php
        echo '<div class="formQ  bg-light mt-2 mb-3 p-3">
            <form action="/forum/threadq.php?threadid=' . $id . '" method="post">
                <div class="form-group">
                    <label for="exampleInputPassword1">Type your Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary my-2">Post Comment</button>
            </form>
        </div>';
        //Comments are Fetched...
        $id = $_GET['threadid'];
        // die("Id is $id");
        $sql = "SELECT * FROM `comments` WHERE `thread_id`=$id";
        //Thread_cat_id is Used to Discuss about Individual Categories...
        $result = mysqli_query($con, $sql);
        //To check whether Result exists or not...
        $noResult = true; //By default NO result let assume...
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $cid = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];

            //    Media-Objects are Used...
            echo '<div class="media mt-4">
                <img class="mr-3" src="https://source.unsplash.com/40x40/?coding,code" class="card-img"
                    alt="Generic placeholder image" style="float:left; margin-right: 5px">
                <div class="media-body">
                <p><b>User</b> commented at ' . $comment_time . '</p>
                   <p  style="margin-left: 45px">' . $content . '</p>
                </div>
        </div>';
        }


        ?>


        <?php
        //Discussions  are being done here...
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid bg-light p-5">
            <div class="container">
              <p class="display-4">No Threads Found.</p>
              <p class="lead">Be the 1st Person to Ask the Questions.</p>
            </div>
          </div>';
        }
        ?>

        <?php require 'footer.php'; ?>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
</body>

</html>