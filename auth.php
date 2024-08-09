<?php

session_start();

if (isset($_SESSION['name'])) {
  header('location: ./home.php');
  exit;
}

if (!isset($_POST['submit'])) {
  header('location: ./index.php');
  exit;
}

$conn = mysqli_connect('localhost', 'root', '', 'login');

// Preparation of parameterized query
$query = "SELECT * FROM users WHERE username=? AND password=?";
$stmt = $conn->prepare($query);

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Binding parameters to the query
$stmt->bind_param("ss", $username, $password);

// Executing the query
$stmt->execute();

$result = $stmt->get_result();
$users_num = $result->num_rows;

if ($users_num < 1) {
  $_SESSION['login_failed'] = true;
  header('location: ./index.php');
  exit;
}

$user = $result->fetch_assoc();
$_SESSION['name'] = $user['name'];
header('location: ./home.php');
exit;
