<?php

function isConnected () : bool
{
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    return !empty($_SESSION['connected']);
}



function user_connect(){
    if(!isConnected()){
        header('location: ../login.php');
        exit();
    }
}