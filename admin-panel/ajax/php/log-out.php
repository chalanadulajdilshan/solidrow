<?php

include_once('../../../class/include.php');
$USER = new User(NULL);

if ($USER->logOut()) {
    header('Location: ../../login.php');
} 

