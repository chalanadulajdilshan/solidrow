<?php
include '../class/include.php';
header('Content-Type: application/json; charset=UTF-8');

if (!isset($_SESSION)) {
    session_start();
}

$gallery = new Gallery();
$companyFilter = isset($_GET['company_id']) && $_GET['company_id'] !== '' ? (int)$_GET['company_id'] : null;
$items = $gallery->all($companyFilter);

echo json_encode($items);
