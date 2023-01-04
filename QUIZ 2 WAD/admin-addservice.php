<!DOCTYPE html>
<html lang="en">

<head>
    <title>ADMIN CUCCI LAUNDRY</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="style.css" rel="stylesheet">
</head>

<?php
include 'connect.php';
session_start();

$id_user = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id='$id_user'");
$user = mysqli_fetch_assoc($query);
$query2 = mysqli_query($conn, "SELECT * FROM orders");
?>

<body>
    <nav class="navbar navbar-expand-sm navbar-light fw-bold px-4 fixed-top" style="background-color: rgb(205, 251, 251);">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <img src="images/washing-machine.png" alt="Logo EAD" width="40" height="40" fill="currentColor">
                    <a class="nav-link" aria-current="page" href="admin.php"><i class="fa fa-fw fa-home"></i>Home</a>
                    <a class="nav-link" href="admin.php">Order</a>
                    <a class="nav-link" href="admin.php#stats">Statistics</a>
                </div>
            </div>
            <a type="button" href="admin-addorder.php" class="btn btn-dark btn-rounded mx-1">Add Order</a>
            <a type="button" href="admin-addservice.php" class="btn btn-dark btn-rounded mx-1">Add Service</a>
            <div class="dropdown">
                <button class="btn btn-dark btn-rounded dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $user['username'] ?>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="auth.php?logout=success">Logout</a></li>
                </ul>
            </div>
    </nav>

    <section style="margin-top: 75px;">
        <div class="container border border-1 rounded w-75">
            <h4 style='text-align: left; margin-top: 50px; font-weight: bold;'>Add New Service</h4>
            <form action="services.php" method="post" enctype='multipart/form-data'>
                <div class="mb-3">
                    <label for="nama" class="form-label fw-bold">Service Name</label>
                    <input type="text" name="nama_servis" id="nama" placeholder="Service Name" class='form-control'>
                </div>

                <div class="mb-3">
                    <label for="pick" class="form-label fw-bold">Pick Up & Delivery</label><br>
                    <input type="radio" name="pick" id="pick" value="Yes" class="form-check-input me-2"><label for="iron">Yes</label>
                    <input type="radio" name="pick" id="pick" value="No" class="form-check-input ms-3 me-2"><label for="iron">No</label>
                </div>
                <div class="mb-3">
                    <label for="iron" class="form-label fw-bold">Iron</label><br>
                    <input type="radio" name="iron" id="iron" value="Yes" class="form-check-input me-2"><label for="iron">Yes</label>
                    <input type="radio" name="iron" id="iron" value="No" class="form-check-input ms-3 me-2"><label for="iron">No</label>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label fw-bold">Price</label>
                    <input type="text" name="harga" id="harga" placeholder="Price" class='form-control'>
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label fw-bold">Image</label>
                    <input class="form-control" type="file" id="formFile" name="image">
                </div>

                <div class="mb-3 d-grid">
                    <button type="submit" name='addService' class="btn btn-success">Add New Service</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center text-lg-start bg-light text-muted">

        <!-- Right -->
        <div>
            <a href="" class="me-4 text-reset">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="" class="me-4 text-reset">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="" class="me-4 text-reset">
                <i class="fab fa-google"></i>
            </a>
            <a href="" class="me-4 text-reset">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="" class="me-4 text-reset">
                <i class="fab fa-linkedin"></i>
            </a>
            <a href="" class="me-4 text-reset">
                <i class="fab fa-github"></i>
            </a>
        </div>
        <!-- Right -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h5 class="text-uppercase fw-bold mb-4">
                            <i class="fas fa-gem me-3"></i>CUCCI LAUNDRY
                        </h5>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum
                            dolor sit amet, consectetur adipisicing elit.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase mb-4">
                            Useful links
                        </h6>
                        <p>
                            <a class="text-reset" href="detailpage.html">Pricing</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Settings</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Orders</a>
                        </p>
                        <p>
                            <a href="#!" class="text-reset">Help</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase mb-4">Find Us</h6>
                        <p><i class="fas fa-home me-3"></i>3JVC+J3 Citarum, Bandung City, West Java</p>
                        <p>
                            <i class="fas fa-envelope me-3"></i>
                            www.5asecindonesia.com
                        </p>
                        <p><i class="fas fa-phone me-3"></i> (022) 4238907</p>
                        <p><i class="fas fa-print me-3"></i> (022) 4238907</p>
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 255, 255, 0.119);">
            © 2022 Copyright:
            <a class="text-reset fw-bold" href="mailto:amara.prita.n@gmail.com">AMARA PRITA NADYATAMA - 1202200100</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

</body>

</html>