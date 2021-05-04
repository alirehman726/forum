<?php

session_start();
echo "Logout";

session_destroy();
header("Location: /forum/index.php");


?>