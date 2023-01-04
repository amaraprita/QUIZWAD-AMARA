<?php 
include 'connect.php';

if (isset($_POST['addService'])){
    $nama_servis = $_POST['nama_servis'];
    $pickup = $_POST['pick'];
    $iron = $_POST['iron'];
    $price = $_POST['harga'];

    $rand = rand(10000,19999);
    $ekstensi =  array('png', 'jpg', 'jpeg', 'gif');
    $filename = $_FILES['image']['name'];
    $ukuran = $_FILES['image']['size'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if(!in_array($ext,$ekstensi) ) {
        header("location:index.php?alert=gagal_ekstensi");
    }else{
        if ($ukuran < 104407000) {
            $image = $rand . '_' . $filename;
            move_uploaded_file($_FILES['image']['tmp_name'], 'images/uploaded/' . $rand . '_' . $filename);
            $query = mysqli_query($conn, "INSERT INTO services (service,pickup_delivery,iron,price,image) VALUES ('$nama_servis','$pickup','$iron','$price','$image')");
            header('Location: MY_ITEM.php');
        }
    }

    
    header('location: admin.php');
}
if (isset($_POST['updateService'])){
    $id = $_GET['id_servis'];
    $nama_servis = $_POST['nama_servis'];
    $pickup = $_POST['pick'];
    $iron = $_POST['iron'];
    $price = $_POST['harga'];
    if($foto == ''){
        $query = mysqli_query($conn, "UPDATE services SET service='$nama_servis',pickup_delivery='$pickup',iron='$iron',price='$price' WHERE id='$id'");
        header('Location: admin.php');
    }else{
        $rand = rand(10000,19999);
        $ekstensi =  array('png', 'jpg', 'jpeg', 'gif');
        $filename = $_FILES['image']['name'];
        $ukuran = $_FILES['image']['size'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!in_array($ext,$ekstensi) ) {
            header("location:admin.php?alert=gagal_ekstensi");
        }else{
            if ($ukuran < 104407000) {
                $image = $rand . '_' . $filename;
                move_uploaded_file($_FILES['image']['tmp_name'], 'images/uploaded/' . $rand . '_' . $filename);
                $query = mysqli_query($conn, "UPDATE services SET service='$nama_servis',pickup_delivery='$pickup',iron='$iron',price='$price',image='$image' WHERE id='$id'");
                header('Location: admin.php');
            }
        }
    }

    
    header('location: admin.php');
}

if (isset($_GET['aksi'])){
    $id = $_GET['id_servis'];
    $query = "DELETE FROM services WHERE id = $id";
    $delete = mysqli_query($conn, $query);
    
    header('Location: admin.php');
}
?>