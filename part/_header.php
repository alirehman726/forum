<?php


session_start();

echo ' <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="/forum">I-Discuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forum">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Top Category
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
          
        $sql = "SELECT category_name, category_id  FROM `categories` LIMIT 3";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li><a class="dropdown-item" href="threadslist.php?catid=' . $row['category_id'] . '">' . $row['category_name'] . '</a></li>';
        }
        echo '</ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php" tabindex="-1">Contact </a>
      </li>
    </ul>

      <form class="d-flex" action="search.php" method="get">
          <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
      </form>';
      
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '<p class="text-light mx-3 my-3">Welcome    ' . $_SESSION['user_email'] . ' </p>';
        echo '<a href="part/_logout.php" class="btn btn-outline-success mx-2 my-2">Logout</a>';
      }else {
        echo '
          <div class="mx-2">
              <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModel">Login</button>
              <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupModel">Signup</button>
          </div>';

      }
      

      
 echo  '</div>
</div>
</nav>';

include 'part/_loginModel.php';
include 'part/_signupModel.php';
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == 'true') {
    echo '
        <div class="alert alert-success alert-dismissible fade show my-0" role="alert">
          <strong>Success!</strong> You can now Login.!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      ';  
  }else {
    if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == 'false') {
      echo '
          <div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error!</strong> You do not Login. Chack the email and password
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      ';
  }
}

?>