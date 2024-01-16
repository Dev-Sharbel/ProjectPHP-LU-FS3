<?php
include_once("class.php");
// if(session_status() !== PHP_SESSION_ACTIVE) @session_start();
session_start();
// dd($_SESSION);

// if (!isset($_SESSION['data'])){
//     $_SESSION['data'] = array();
// }
if (!isset($_SESSION['Handler'])){
    $_SESSION['Handler'] = new Handler();
}
$Handler = $_SESSION['Handler'];
?>