<?php

include 'database.php';

session_start();
session_unset();
session_destroy();

header('location:cus_login.php');

?>