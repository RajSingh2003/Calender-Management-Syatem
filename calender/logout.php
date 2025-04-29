<?php
session_start();
if (isset($_SESSION["username"])) {
    session_destroy();
    header('location: index.php');
    if (isset($_COOKIE[session_name("username")])) {
        setcookie(session_name("username"), '', time() - 7000000, '/');
    }
}


 // where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow **session_unset();**


?>