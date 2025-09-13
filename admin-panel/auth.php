<?php

if (!isset($_SESSION)) {
    session_start();
}

$USER = new User(NULL);
if (!$USER->authenticate()) {
    redirect('login.php');
}

 