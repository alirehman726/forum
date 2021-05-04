<!-- INSERT INTO `comments` (`comment_id`, `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES (NULL, 'Rehmanali', '1', '0', current_timestamp()); -->
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
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE thread_id  = $id";
        $result = mysqli_query($conn, $sql);

        $noResult = true;
        while($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_user_id = $row['thread_user_id'];

            $sqlquery = "SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
            $user_result = mysqli_query($conn, $sqlquery);
            $fetch_user = mysqli_fetch_assoc($user_result);
            $posted_by = $fetch_user['user_email'];
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


    <?php
        $showAlert = false;
        $method = $_SERVER['REQUEST_METHOD'];
        // echo $method;
        if ($method == 'POST') {
            //Insert into comment DC 
            
            $comment = $_POST['comment']; 
            $comment = str_replace("<", "&lt;", $comment);
            $comment = str_replace(">", "&gt;", $comment);
            $sno = $_POST['sno']; 
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment ', '$id', '$sno', current_timestamp());";
            $result1 = mysqli_query($conn, $sql);
            $showAlert = true;

            if ($showAlert) {
                echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong>Your Comment has been addes.!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
    ?>

    <div class="container my-5">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title; ?></h1>
            <p class="lead"> <?php echo $desc; ?></p>
            <hr class="my-4">
            <p>It uses utility No Spam / Advertising / Self-promote in the forums. is not allowed. Do not post
                copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Do not PM users asking for help. Remain respectful of other members at all times.
            </p>
            <p>Posted By : <b><em><?php echo $posted_by;?></em></b></p>
        </div>
    </div>
    <?php
        
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '
                <div class="container">
                    <h1 class="py-3">Post Comment</h1>
                    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                        <div class="form-group my-3">
                            <label class="my-2" for="exampleFormControlTextarea1">Type of Comment</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                            <input type="hidden" name="sno" value="' . $_SESSION["sno"] . '">
                        </div>
                        <button type="submit" class="btn btn-primary">Post Comment</button>
                    </form>
                </div>
            ';
        }else {
            echo '        
                <div class="container">
                    <h1 class="py-3">Post Comment</h1>
                    <h4> Yor are not Logged in. Please Login to be able to start Discussion</h4>
                </div>
            ';
        }
    ?>




    <div class="container" id="ques">
        <h1 class="py-3">Discussions</h1>

        <?php 
             $id = $_GET['threadid'];
             $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
             $result = mysqli_query($conn, $sql);
             $noResult = true;
     
             while($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $id = $row['comment_id'];
                $content = $row['comment_content'];
                $comment_time = $row['comment_time'];
                $thread_user_id = $row['comment_by'];
                $sql2 = "SELECT user_email FROM `users` WHERE sno ='$thread_user_id'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);

                echo '
                    <div class="media my-5">
                        <img class="mr-3" src="image/profile.png" width="50px" alt="...">
                        <div class="media-body">
                            <p class="font-weight-bold my-0">' . $row2['user_email'] . ' at ' . $comment_time . '</p>  
                            ' . $content . '
                        </div>
                    </div>
                ';
            }
            if ($noResult) {
                echo '
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                        <h1 class="display-4">No comments found</h1>
                        <p class="lead">Be the first person to comment.</p>
                        </div>
                    </div>
                
                ';
            }
        ?>

    </div>




    <?php include 'part/_footer.php';?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
</body>

</html>