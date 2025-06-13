<?php
require 'db.php';
session_start();

if(!isset($_SESSION['user_id']) || !isset($_GET['id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$quote_id = $_GET['id'];

$stmt = $pdo -> prepare("DELETE FROM quotes WHERE id = ? AND user_id = ?");
$stmt -> execute([$quote_id, $user_id]);

header("Location: dashboard.php");
exit;
