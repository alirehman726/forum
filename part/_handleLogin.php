<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "_database.php";
    $email = $_POST["loginEmail"];
    $pass = $_POST["loginPass"];

    $sql = "SELECT * FROM `users` WHERE user_email = '$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);

    if ($numRows == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['user_password'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['user_email'] = $email;
            $_SESSION['sno'] = $row['sno'];
            echo "Logged in....". $email;
        }
        // echo "Enable to login";
        header("Location: /forum/index.php");
    }
    header("Location: /forum/index.php");
}

?>