<?php

function isConnected () : bool
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['user_id']);
}

function user_connect() {
    if (!isConnected()) {
        header('Location: login.php');
        exit();
    }
}
?>