<?php
session_start();
unset($_SESSION['user']);
if(session_destroy()){
    header('location:log.php');
}
?>