<?php
include("../chkCreateCart.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <!-- <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> -->
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/style.css" rel="stylesheet" />
</head>

<body>
    <?php
    ?>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">E-Commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="#!">Home</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="#!">About</a></li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link toggle" aria-current="page" href="../profile/profile.php">Profile</a></li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill"><?php
                                                                                    if (isset($_COOKIE["cart"])) {
                                                                                        $temp = explode("n", $_COOKIE["cart"]);
                                                                                        echo sizeof($temp) - 1;
                                                                                    } else {
                                                                                        echo "0";
                                                                                    }

                                                                                    ?></span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                include("../connection.php");
                $ids_amount =  explode("n", $_COOKIE["cart"]);
                $ids = [];
                for ($i = 0; $i <  sizeof($ids_amount)- 1; $i++) {
                    $id = explode("-", $ids_amount[$i]);
                    $ids[$i] = $id;
                    $q = "SELECT * FROM articles WHERE id_article = $id[0]";
                    $result = $conn->query($q);

                    $row = $result->fetch_assoc();
                    //echo var_dump($row);
                    echo "<div class='col mb-5'>";
                    echo "<div class='card h-100'>";
                    if (file_exists("../img/product_$row[id_article].jpg")) {
                        echo "<img class='card-img-top' src='../img/product_$row[id_article].jpg' alt='...' />";
                    } else if (file_exists("../img/product_$row[id_article].png")) {
                        echo "<img class='card-img-top' src='../img/product_$row[id_article].png' alt='...' />";
                    } else {
                        echo "<img class='card-img-top' src='../img/default.jpg' alt='...' />";
                    }
                    echo "<div class='card-body p-4'>";
                    echo "<div class='text-center'>";
                    echo "<h5 class='fw-bolder'>$row[name]</h5>";
                    echo "$row[price]€&#9733;";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>";
                    echo "<div class='text-center'><a class='btn btn-outline-dark mt-auto' href='..'>Rimuovi dal carrello</a></div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                echo var_dump($ids);
                ?>


            </div>
        </div>
    </section>
    <div class="text-center">

    </div>
    <!-- Footer-->
    <footer class="py-5 bg-dark" style="position: sticky; top: 100%;">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; E-Commerce 2022</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="scripts.js"></script>
</body>

</html>