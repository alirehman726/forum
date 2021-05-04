<!-- https://www.youtube.com/watch?v=iIMwGpCmuEI -->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <style>
        #maincontainer {
            min-height: 100vh;
        }
    </style>
    <title>I-Discuss Forums</title>
  </head>
  <body>

    <?php include 'part/_database.php';?>
    <?php include 'part/_header.php';?>

    <!-- Search Results -->

    <div class="container my-3" id="maincontainer">
            <h1 class="py-3">Search result for <em>" <?php echo $_GET['search']?> "</em></h1>

            <?php
                $noResult = true;
                $query = $_GET['search'];
                $sql = "select * from threads where match (thread_title, thread_desc) against('$query')";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                    $title = $row['thread_title'];
                    $desc = $row['thread_desc'];
                    $thread_id  = $row['thread_id'];
                    $url  = "thread.php?threadid=". $thread_id;
                    $noResult = false;

                    echo '
                        <div class="result">
                            <h3> <a href="' . $url . '" class="text-dark" style="text-decoration:none"> ' . $title . '</a></h3>
                            <p>' . $desc . '</p>
                        </div>
                        ';
                }

                if ($noResult) {
                    echo '
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                        <h1 class="display-4">No Result found</h1>
                        <p class="lead">Suggestions: <ul>
                            <li>Make sure that all words are spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords.</li></ul>
                        </p>
                        </div>
                    </div>
                    ';
                }
            ?>
    </div>

    
    


    <?php include 'part/_footer.php';?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
    <!-- INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `created`) VALUES ('1', 'python', 'Python is an interpreted, object-oriented, high-level programming language with dynamic semantics. Python\'s simple, easy to learn syntax emphasizes readability and therefore reduces the cost of program maintenance. Python supports modules and packages.', current_timestamp()); -->
  </body>
  <!-- alter table threads add FULLTEXT(`thread_title`, `thread_desc`) -->
  <!-- select * from threads where match (thread_title, thread_desc) against('flutter') -->
</html>

