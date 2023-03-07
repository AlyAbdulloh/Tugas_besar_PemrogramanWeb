<?php
    session_start();
    session_destroy();

    header('location:../RegisLogin/RegAndLog.php');
?>