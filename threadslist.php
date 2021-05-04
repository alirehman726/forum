<!-- INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('1', 'unable to auto by distroy', 'I am not able to install python on linex', '1', '0', current_timestamp()); -->

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <style>
    #ques {
        min-height: 533px;
    }
    </style>
    <title>I-Discuss Forums</title>
</head>

<body>

    <?php include 'part/_database.php';?>
    <?php include 'part/_header.php';?>

    <?php

        $id = $_GET['catid'];
        $sql = "SELECT * FROM `categories` WHERE category_id = $id";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)) {
            $catname = $row['category_name'];
            $catdesc = $row['category_description'];
        }
    ?>

    <?php
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        // echo $method;
        if ($method == 'POST') {
            //Insert the threads 
            $th_title = $_POST['title'];
            $th_desc = $_POST['desc'];

            
            $th_title = str_replace("<", "&lt;", $th_title);
            $th_title = str_replace(">", "&gt;", $th_title);

            
            $th_desc = str_replace("<", "&lt;", $th_desc);
            $th_desc = str_replace(">", "&gt;", $th_desc);

            $sno = $_POST['sno']; 
            $sql = " INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
            $result1 = mysqli_query($conn, $sql);
            $showAlert = true;

            if ($showAlert) {
                echo '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong>Your thread has been addes. Please wait community to respond
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
            }
        }
    ?>

    <div class="container my-5">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> forums</h1>
            <p class="lead"> <?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>It uses utility No Spam / Advertising / Self-promote in the forums. is not allowed. Do not post
                copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Do not PM users asking for help. Remain respectful of other members at all times.
            </p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>

    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '
            <div class="container">
                <h1 class="py-3">Start a Discussions</h1>
                <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
                    <div class="form-group my-3">
                        <label class="my-2" for="exampleInputEmail1">Problem Title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as possible.</small>
                    </div>
                    <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
                    <div class="form-group">
                        <label class="my-2" for="exampleFormControlTextarea1">Ellaborate Your Concern</label>
                        <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                    </div>
                    <div class="form-check">
                        <!-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> -->
                        <!-- <label class="form-check-label" for="exampleCheck1">Check me out</label> -->
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>';
    }else {
        echo '
            <div class="container">
                <h1 class="py-3">Start a Discussions</h1>
                <h4 class="mb-3"> You are not Logged in . Please Login to be able to start Discussion.</h4>
            </div>' ;
    }
        
    ?>

    <div class="container" id="ques">
        <h1 class="py-3">Browse Questions</h1>

        <?php 
             $id = $_GET['catid'];
             $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
             $result = mysqli_query($conn, $sql);
             $noResult = true;
     
             while($row = mysqli_fetch_assoc($result)) {
                 $noResult = false;
                 $id = $row['thread_id'];
                 $title = $row['thread_title'];
                 $desc = $row['thread_desc'];
                 $thread_time = $row['timestamp'];
                 $thread_user_id = $row['thread_user_id'];
                 $sql2 = "SELECT user_email FROM `users` WHERE sno = '$thread_user_id'";
                 $result2 = mysqli_query($conn, $sql2);
                 $row2 = mysqli_fetch_assoc($result2);
                echo '
                    <div class="media my-5">
                        <img class="mr-3" src="image/profile.png" width="50px" alt="...">
                        <div class="media-body">
                            <p class="font-weight-bold my-0">' . $row2['user_email'] . '   at ' . $thread_time . '</p>
                            <h5 class="mt-0"> <a class="text-dark" style="text-decoration:none" href="thread.php?threadid=' . $id . '"> ' . $title . '</a></h5>
                            ' . $desc . '
                        </div>
                    </div>
                ';
            }
            if ($noResult) {
                echo '
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                    <p class="display-4">No Threads found</p>
                    <p class="lead">Be the first person to ask a question.</p>
                    </div>
                </div>';
            }
        ?>

    </div>

    <?php include 'part/_footer.php';?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
</body>

</html>