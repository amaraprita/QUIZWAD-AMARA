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
                    <a class="nav-link" aria-current="page" href="#home"><i class="fa fa-fw fa-home"></i>Home</a>
                    <a class="nav-link" href="#about">About</a>
                    <a class="nav-link" href="#service">Services</a>
                    <a class="nav-link" href="#location">Location</a>
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
                                <input type="text" id="defaultForm-email defaultForm-user" class="form-control validate" name="email" <?php if (isset($_COOKIE['email'])) echo "value=".$_COOKIE['email']?>>
                            </div>

                            <div class="md-form mb-4">
                                <i class="fas fa-lock prefix grey-text"></i>
                                <label data-error="wrong" data-success="right" for="defaultForm-pass">Password</label>
                                <input type="password" id="defaultForm-pass" class="form-control validate" name="password" <?php if (isset($_COOKIE['pass'])) echo "value=".$_COOKIE['pass']?>>
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


    <!-- Carousel -->

    <div id="demo" class="carousel slide w-75 mx-auto" data-bs-ride="carousel">

        <!-- Indicators/dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
        </div>

        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
            <div align='center' class="carousel-item active">
                <img src="images/jan-antonin-kolar-yCdirrhQaTw-unsplash.jpg" alt="Los Angeles" class="d-block" style="width:80%">
                <div class="carousel-caption">
                    <h3 class="text-white">Cleanliness is Our Priority</h3>
                </div>
            </div>
            <div align='center' class="carousel-item">
                <img src="images/waldemar-brandt-NPPNHZK1U0s-unsplash.jpg" alt="Chicago" class="d-block" style="width:80%">
                <div class="carousel-caption">
                    <h3 class="text-white">We provide many services for you</h3>
                </div>
            </div>
            <div align='center' class="carousel-item">
                <img src="images/engin-akyurt-yCYVV8-kQNM-unsplash.jpg" alt="New York" class="d-block" style="width:80%">
            </div>
        </div>

        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <section id="about">
        <!--ABOUT-->
        <div class="p-3">
            <br><br>
            <h4 class="text-center fw-bold">About Us</h4>
        </div>
        <div class="container text-left">
            <div class="row row-cols-4">
                <div class="col"></div>
                <div class="col">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo molestias dignissimos ratione!.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo molestias dignissimos ratione!.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo molestias dignissimos ratione!</div>
                <div class="col">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo molestias dignissimos ratione!.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo molestias dignissimos ratione!.Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo molestias dignissimos ratione!</div>
                <div class="col"></div>
            </div>
        </div>
        <br>
        <div class="jumbotron jumbotron-fluid text-center">
            <iframe width="860" height="480" src="https://www.youtube.com/embed/hIxoGrjiQZU" alt="Laundry Animation" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <path d="M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516.024.034 1.52.087 2.475-1.258.955-1.345.762-2.391.728-2.43zm3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422.212-2.189 1.675-2.789 1.698-2.854.023-.065-.597-.79-1.254-1.157a3.692 3.692 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56.244.729.625 1.924 1.273 2.796.576.984 1.34 1.667 1.659 1.899.319.232 1.219.386 1.843.067.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758.347-.79.505-1.217.473-1.282z" />
            <path d="M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516.024.034 1.52.087 2.475-1.258.955-1.345.762-2.391.728-2.43zm3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422.212-2.189 1.675-2.789 1.698-2.854.023-.065-.597-.79-1.254-1.157a3.692 3.692 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56.244.729.625 1.924 1.273 2.796.576.984 1.34 1.667 1.659 1.899.319.232 1.219.386 1.843.067.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758.347-.79.505-1.217.473-1.282z" />
        </div>
        <br><br>
    </section>

    <!--SERVICE-->
    <section id="service">
        <!--pake card-->
        <div class="p-4">
            <br><br>
            <h4 class="text-center fw-bold">Our Services</h4>
        </div>
        <div class="container">
            <div class="row justify-content-center" style="margin-left: 5px;">
                <?php while ($service = mysqli_fetch_assoc($query2)) { ?>
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="images/uploaded/<?= $service['image'] ?>" alt="Card image">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase fw-bold"><?= $service['service'] ?></h5>
                                <p class="card-text text-center"><?= "Rp " . number_format($service['price'], 2, ",", ".") ?> / Kg</p>
                                <div class="text-center">
                                    <a class="btn btn-outline-dark btn-rounded" data-mdb-ripple-color="dark" href="detailpage.php">See Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
        <br><br>
    </section>


    <section id="location">
        <!--LOCATION MAPS-->
        <div class="p-4">
            <br><br>
            <h4 class="text-center fw-bold">Our Location</h4>
        </div>
        <div class="jumbotron jumbotron-fluid text-center">
            <div class="container p-4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.871341370084!2d107.61794371455879!3d-6.90598479500996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e64abfd26c4d%3A0xeb3b85be7c8d25bf!2s5asec%20Bandung!5e0!3m2!1sen!2sid!4v1667379197664!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <path d="M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516.024.034 1.52.087 2.475-1.258.955-1.345.762-2.391.728-2.43zm3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422.212-2.189 1.675-2.789 1.698-2.854.023-.065-.597-.79-1.254-1.157a3.692 3.692 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56.244.729.625 1.924 1.273 2.796.576.984 1.34 1.667 1.659 1.899.319.232 1.219.386 1.843.067.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758.347-.79.505-1.217.473-1.282z" />
            </div>
        </div>
        <br><br>
    </section>
    </div>

    <section id="tanya">
        <div class="container-fluid" style="background-color: rgba(205, 251, 251, 0.219);">
            <div class="p-4">
                <br><br>
                <h4 class="text-center fw-bold">Contact Us</h4>
            </div>
            <div>
                <form action="" style="margin-left: 340px;">
                    <div class="row g-2 align-items-center">
                        <div class="col-8">
                            <label for="inputEmail" class="col-form-label">Email Address </label>
                            <input type="text" id="inputEmail" class="form-control" placeholeder="">
                        </div>
                    </div>

                    <div class="row g-2 align-items-center mt-3">
                        <div class="col-8">
                            <label for="inputName" class="col-form-label">Full Name</label>
                            <input type="text" id="inputName" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="row g-2 align-items-center mt-3">
                        <div class="col-8">
                            <label for="inputHP" class="col-form-label">Phone Number</label>
                            <input type="text" id="inputHP" class="form-control" placeholder="">
                        </div>
                    </div>

                    <div class="row g-2 align-items-center mt-3">
                        <div class="col-8">
                            <label for="inputAlamat" class="col-form-label">Your Message</label>
                            <textarea name="textarea" style="width:790px;height:100px;"></textarea>
                        </div>
                    </div>

                    <br>
                    <button type="button" class="btn btn-dark btn-rounded" style="margin-left: 340px;">SEND</button>
                    <br><br><br><br>
                </form>
            </div>
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