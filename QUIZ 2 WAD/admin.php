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
$query3 = mysqli_query($conn, "SELECT * FROM services");
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
                    <a class="nav-link" href="admin.php">Order</a>
                    <a class="nav-link" href="#stats">Statistics</a>
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

    <section id="home">
        <div class="mt-5 p-5 text-white text-center">
            <h1>CUCCI LAUNDRY</h1>
            <h3>Trust Your Clothes to Us!</h3>
        </div>
    </section>

    <!--ORDERS TABLE-->
    <div class="container">
        <h4 class="text-center fw-bold">ORDER</h4>
        <table class="table" href="#">
            <thead>
                <tr>
                    <th scope="row">Order ID</th>
                    <th scope="row">Order Category</th>
                    <th scope="row">Customer</th>
                    <th scope="row">Progress</th>
                    <th scope="row">Status</th>
                    <th scope="row">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php while ($orders = mysqli_fetch_assoc($query2)) { ?>
                    <tr>
                        <th scope="col">#<?= $orders['orderID'] ?></th>
                        <td><?= $orders['ordCat'] ?></td>
                        <td><?= $orders['custName'] ?></td>
                        <td><?= $orders['progress'] ?></td>
                        <td text-primary><?= $orders['status'] ?></td>
                        <td><a class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editOrder<?= $orders['id'] ?>">Edit</a></td>
                        <div class="modal fade" id="editOrder<?= $orders['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Order</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="orders.php?id=<?= $orders['id'] ?>" method="post" enctype='multipart/form-data'>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="orderid" class="form-label fw-bold">Order ID</label>
                                                <input type="text" name="order_id" id="orderid" placeholder="Order ID" readonly class='form-control' value="<?= $orders['orderID'] ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="nama" class="form-label fw-bold">Customer Name</label>
                                                <input type="text" name="nama" id="nama" placeholder="Name" readonly class='form-control' value="<?= $orders['custName'] ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="ordCategory" class="form-label fw-bold">Order Category</label>
                                                <select class="form-select" aria-label="order category" name="kategori" disabled>
                                                    <option value="Dry Clean" <?php if ($orders['ordCat'] == 'Dry Clean') echo 'selected="selected"'; ?>>Dry Clean</option>
                                                    <option value="Self Service" <?php if ($orders['ordCat'] == 'Self Service') echo 'selected="selected"'; ?>>Self Service</option>
                                                    <option value="On Demand" <?php if ($orders['ordCat'] == 'On Demand') echo 'selected="selected"'; ?>>On Demand</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Tanggal" class="form-label fw-bold">Order Date</label>
                                                <input type="date" name="Tanggal" id="Tanggal" class='form-control' value="<?= $orders['ordDate'] ?>" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="progress" class="form-label fw-bold">Progress</label>
                                                <select class="form-select" aria-label="order progress" name="progress">
                                                    <option value="In The Queue" <?php if ($orders['progress'] == 'In The Queue') echo 'selected="selected"'; ?>>In The Queue</option>
                                                    <option value="On Process" <?php if ($orders['progress'] == 'On Process') echo 'selected="selected"'; ?>>On Process</option>
                                                    <option value="Ready to Pick-up" <?php if ($orders['progress'] == 'Ready to Pick-up') echo 'selected="selected"'; ?>>Ready to Pick-up</option>
                                                    <option value="Delivered" <?php if ($orders['progress'] == 'Delivered') echo 'selected="selected"'; ?>>Delivered</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="status" class="form-label fw-bold">Status</label>
                                                <select class="form-select" aria-label="order status" name="status">
                                                    <option value="New" <?php if ($orders['status'] == 'New') echo 'selected="selected"'; ?>>New</option>
                                                    <option value="On Going" <?php if ($orders['status'] == 'On Going') echo 'selected="selected"'; ?>>On Going</option>
                                                    <option value="Finished" <?php if ($orders['status'] == 'Finished') echo 'selected="selected"'; ?>>Finished</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="payment" class="form-label fw-bold">Payment</label><br>
                                                <input type="radio" name="payment" id="payment" value="Lunas" class="form-check-input me-2" <?php if ($orders['payment'] == 'Lunas') echo 'checked="checked"'; ?>><label for="Lunas">Lunas</label>
                                                <input type="radio" name="payment" id="payment" value="Belum Lunas" class="form-check-input ms-3 me-2" <?php if ($orders['payment'] == 'Belum Lunas') echo 'checked="checked"'; ?>><label for="belumlunas">Belum Lunas</label>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-outline-success" name="updateOrder">Edit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h4 class="text-center fw-bold mt-4">SERVICES</h4>
        <table class="table" href="#">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Pick Up & Delivery</th>
                    <th scope="col">Iron</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php while ($service = mysqli_fetch_assoc($query3)) { ?>
                    <tr>
                        <th scope="row"><?= $service['service'] ?></th>
                        <td><?= $service['pickup_delivery'] ?></td>
                        <td><?= $service['iron'] ?></td>
                        <td><?= "Rp " . number_format($service['price'], 2, ",", ".") ?> / Kg</td>
                        <td><a class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editService<?= $service['id'] ?>">Edit</a> <a class="btn btn-outline-danger" href="services.php?aksi=delete&id_servis=<?= $service['id'] ?>">Delete</a></td>
                        <div class="modal fade" id="editService<?= $service['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Service</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="services.php?id_servis=<?= $service['id'] ?>" method="post" enctype='multipart/form-data'>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label fw-bold">Service Name</label>
                                                <input type="text" name="nama_servis" id="nama" placeholder="Service Name" class='form-control' value="<?= $service['service'] ?>">
                                            </div>

                                            <div class="mb-3">
                                                <label for="pick" class="form-label fw-bold">Pick Up & Delivery</label><br>
                                                <input type="radio" name="pick" id="pick" value="Yes" class="form-check-input me-2" <?php if ($service['pickup_delivery'] == 'Yes') echo 'checked="checked"'; ?>><label for="iron">Yes</label>
                                                <input type="radio" name="pick" id="pick" value="No" class="form-check-input ms-3 me-2" <?php if ($service['pickup_delivery'] == 'No') echo 'checked="checked"'; ?>><label for="iron">No</label>
                                            </div>
                                            <div class="mb-3">
                                                <label for="iron" class="form-label fw-bold">Iron</label><br>
                                                <input type="radio" name="iron" id="iron" value="Yes" class="form-check-input me-2" <?php if ($service['iron'] == 'Yes') echo 'checked="checked"'; ?>><label for="iron">Yes</label>
                                                <input type="radio" name="iron" id="iron" value="No" class="form-check-input ms-3 me-2" <?php if ($service['iron'] == 'No') echo 'checked="checked"'; ?>><label for="iron">No</label>
                                            </div>

                                            <div class="mb-3">
                                                <label for="harga" class="form-label fw-bold">Price</label>
                                                <input type="text" name="harga" id="harga" placeholder="Price" class='form-control' value="<?= $service['price'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label fw-bold">Image</label>
                                                <input class="form-control" type="file" id="formFile" name="image">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-outline-success" name="updateService">Edit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    <!--CUSTOMER STAT-->
    <section id="stats">
        <div class="container">
            <h6 class="text-center fw-bold">Statistics</h6>
            <p>Our customers through out the months.</p>
            <div class="progress" style="height:30px;width:100%">
                <div class="progress-bar bg-success" role="progressbar" aria-label="Basic example" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">January</div>
            </div>
            <br>
            <div class="progress" style="height:30px;width:100%">
                <div class="progress-bar bg-info" role="progressbar" aria-label="Basic example" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">February</div>
            </div>
            <br>
            <div class="progress" style="height:30px;width:100%">
                <div class="progress-bar bg-warning" role="progressbar" aria-label="Basic example" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">March</div>
            </div>
            <br>
            <div class="progress" style="height:30px;width:100%">
                <div class="progress-bar bg-danger" role="progressbar" aria-label="Basic example" style="width: 68%" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100">April</div>
            </div>
            <br><br>
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