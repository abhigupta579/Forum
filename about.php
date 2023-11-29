<?php
require 'dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</head>

<body>
    <!-- Slider here... -->
    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2500x600/?coding,code" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2500x600/?nature,water" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2500x600/?programmers,programme" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <!-- Category container here... -->
    <div class="container">
        <h2 class="text-center">iDiscuss Categories : </h2>

        <!-- Use a For Loop to Fetch Data... -->
        <div class="row">
            <?php
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);

            // $id = $row['category_id'];
            // $cat = $row['category_name'];
            // $sno = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo " 
            <div class='col-md-4 mt-4'>
                <div class='card bg-light' style='width: 18rem;'>
                    <img src='https://source.unsplash.com/500x400/?" . $row['category_name'] . ",coding' class='card-img-top' alt='...'>
                    <div class='card-body'>
                        <h5 class='card-title'>" . $row['category_id'] . " " . $row
                //Here, catId is Assigned...
                ['category_name'] . "</a></h5>
                        <p class='card-text'>" . $row['category_description'] . "</p>
                        <a href='/forum/threads.php?catid=" . $row['category_id'] . "' class='btn btn-primary'>View Threads</a>
                    </div>
                </div>
            </div>";
                // $sno++;
            }
            ?>
        </div>

    </div>
</body>

</html>