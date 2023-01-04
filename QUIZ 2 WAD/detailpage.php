<!DOCTYPE html>
<html lang="en">

<head>
    <title>CUCCI LAUNDRY</title>
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
$query2 = mysqli_query($conn, "SELECT * FROM services");
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
                    <a class="nav-link" aria-current="page" href="home.php"><i class="fa fa-fw fa-home"></i>Home</a>
                    <a class="nav-link" href="home.php">About</a>
                    <a class="nav-link" href="home.php">Services</a>
                    <a class="nav-link" href="home.php">Location</a>
                </div>
            </div>

            <!--LOGIN BUTTON-->
            <?php if (!isset($_SESSION['logged'])) { ?>
                <div class="topnav">
                    <button type="button" href="#" class="btn btn-outline-dark btn-rounded" data-mdb-ripple-color="dark" data-bs-toggle="modal" data-bs-target="#mylogin">SIGN IN</button>
                    <button type="button" href="#" class="btn btn-dark btn-rounded" data-bs-toggle="modal" data-bs-target="#myreg">REGISTER</button>
                </div>
            <?php } elseif (isset($_SESSION['logged'])) { ?>
                <a type="button" href="myorder.php" class="btn btn-dark btn-rounded mx-1">My Order</a>
                <div class="dropdown">
                    <button class="btn btn-dark btn-rounded dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $user['username'] ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#update">Profile</a></li>
                        <li><a class="dropdown-item" href="auth.php?logout=success">Logout</a></li>
                    </ul>
                </div>
            <?php } ?>

    </nav>

    <!--REGISTER-->
    <section id="regist">
        <div class="modal fade" id="myreg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <!--HEADER-->
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 fw-bold">REGISTER</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!--BODY-->
                    <form action="auth.php" method="POST">
                        <div class="modal-body mx-3">
                            <div class="md-form mb-4">
                                <i class="fas fa-envelope prefix grey-text"></i>
                                <label data-error="wrong" data-success="right" for="defaultForm-email">Email</label>
                                <input type="email" id="defaultForm-email" class="form-control validate" name="email">
                            </div>

                            <div class="md-form mb-4">
                                <i class="fas fa-envelope prefix grey-text"></i>
                                <label data-error="wrong" data-success="right" for="defaultForm-user">Username</label>
                                <input type="text" id="defaultForm-user" class="form-control validate" name="username">
                            </div>

                            <div class="md-form mb-4">
                                <i class="fas fa-lock prefix grey-text"></i>
                                <label data-error="wrong" data-success="right" for="defaultForm-pass">Password</label>
                                <input type="password" id="defaultForm-pass" class="form-control validate" name="password">
                            </div>
                        </div>
                        <!--FOOTER-->
                        <div class="modal-footer d-flex justify-content-center">
                            <button class="btn btn-dark btn-rounded" type="submit" name="register">REGISTER</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <!--LOGIN-->
    <section id="login">
        <div class="modal fade" id="mylogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <!--HEADER-->
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 fw-bold">SIGN IN</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!--BODY-->
                    <form action="auth.php" method="POST">
                        <div class="modal-body mx-3">
                            <div class="md-form mb-5">
                                <i class="fas fa-envelope prefix grey-text"></i>
                                <label for="defaultForm-email defaultForm-user">Email / Username</label>
                                <input type="text" id="defaultForm-email defaultForm-user" class="form-control validate" name="email">
                            </div>

                            <div class="md-form mb-4">
                                <i class="fas fa-lock prefix grey-text"></i>
                                <label data-error="wrong" data-success="right" for="defaultForm-pass">Password</label>
                                <input type="password" id="defaultForm-pass" class="form-control validate" name="password">
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="remember" name="remember" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <!--FOOTER-->
                        <div class="modal-footer d-flex justify-content-center">
                            <button class="btn btn-dark btn-rounded" type="submit" name="login">LOGIN</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <!-- Update Profile -->
    <section id="update_profile">
        <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <!--HEADER-->
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 fw-bold">UPDATE PROFILE</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!--BODY-->
                    <form action="auth.php" method="POST">
                        <div class="modal-body mx-3">
                            <div class="md-form mb-4">
                                <i class="fas fa-envelope prefix grey-text"></i>
                                <label data-error="wrong" data-success="right" for="defaultForm-email">Email</label>
                                <input type="email" id="defaultForm-email" class="form-control validate" name="email" value="<?= $user['email'] ?>">
                            </div>

                            <div class="md-form mb-4">
                                <i class="fas fa-envelope prefix grey-text"></i>
                                <label data-error="wrong" data-success="right" for="defaultForm-user">Username</label>
                                <input type="text" id="defaultForm-user" class="form-control validate" name="username" value="<?= $user['username'] ?>">
                            </div>

                            <div class="md-form mb-4">
                                <i class="fas fa-lock prefix grey-text"></i>
                                <label data-error="wrong" data-success="right" for="defaultForm-pass">Password</label>
                                <input type="password" id="defaultForm-pass" class="form-control validate" name="password">
                            </div>
                        </div>
                        <!--FOOTER-->
                        <div class="modal-footer d-flex justify-content-center">
                            <button class="btn btn-dark btn-rounded" type="submit" name="update">UPDATE</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>

    <section id="home">
        <div class="mt-5 p-5 text-white text-center">
            <h1>CUCCI LAUNDRY</h1>
            <h3>Trust Your Clothes to Us!</h3>
        </div>
    </section>


    <!--DETAIL TABLE-->
    <div class="container">
        <h4 class="text-center fw-bold">Services Detail and Pricing</h4>
        <table class="table" href="#">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Pick Up & Delivery</th>
                    <th scope="col">Iron</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php while ($service = mysqli_fetch_assoc($query2)) { ?>
                    <tr>
                        <th scope="row"><?=$service['service']?></th>
                        <td><?=$service['pickup_delivery']?></td>
                        <td><?=$service['iron']?></td>
                        <td><?="Rp ".number_format($service['price'],2,",",".")?> / Kg</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


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