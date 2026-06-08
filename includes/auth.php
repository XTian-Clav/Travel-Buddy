<?php

//LOGGED IN USERS
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    die();
}