<?php
    session_start();
    include_once('functions.php');
    logOut();
    #skickar tillbaka till startsida
    header("Location: ../index.php");
