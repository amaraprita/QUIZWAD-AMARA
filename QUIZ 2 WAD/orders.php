<?php
include 'connect.php';

if (isset($_POST['addOrderUser'])){
    session_start();
    $id = $_SESSION['id'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $tanggal = $_POST['tanggal'];
    $progress = "Waiting For Pick Up";
    $status = "New";
    $payment = "Belum Lunas";
    $orderID = rand(10000,19999);

    $query = mysqli_query($conn, "INSERT INTO orders (orderID,custID,custName,ordCat,ordDate,progress,status,payment) VALUES ('$orderID','$id','$nama','$kategori','$tanggal','$progress','$status','$payment')");
    header('location: myorder.php');
}

if (isset($_POST['addOrderAdmin'])){
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $tanggal = $_POST['tanggal'];
    $progress = $_POST['progress'];
    $status = $_POST['status'];
    $payment = $_POST['payment'];
    $orderID = rand(10000,19999);

    $query = mysqli_query($conn, "INSERT INTO orders (orderID,custName,ordCat,ordDate,progress,status,payment) VALUES ('$orderID','$nama','$kategori','$tanggal','$progress','$status','$payment')");
    header('location: admin.php');
}

if (isset($_POST['updateOrder'])){
    $id = $_GET['id'];
    $progress = $_POST['progress'];
    $status = $_POST['status'];
    $payment = $_POST['payment'];

    $query = mysqli_query($conn, "UPDATE orders SET progress='$progress',status='$status',payment='$payment' WHERE id='$id'");
    header('location: admin.php');
}