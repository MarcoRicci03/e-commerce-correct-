<?php
include("../chkCreateCart.php");
include("../connection.php");
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['filtroSearch'])) {
    $_SESSION['filtroSearch'] = $_POST['filtroSearch'];
}
if (isset($_SESSION['id_user'])) {
    $q = "SELECT * FROM carts WHERE id_user= $_SESSION[id_user] AND closed = 0";
    $result = $conn->query($q);
    if ($result->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO carts (id_user) VALUES (?)");
        $stmt->bind_param("i", $id);
        // set parameters and execute
        $id = $_SESSION["id_user"];
        $stmt->execute();
    }
    $q = "select id_cart from carts where closed = 0 and id_user = $_SESSION[id_user]";
    $result = $conn->query($q);
    $row = $result->fetch_assoc();
    $_SESSION["id_cart"] = $row["id_cart"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>E-Commerce Homepage</title>
    <!-- Favicon-->
    <!-- <link rel="icon" type="image/x-icon" href="assets/favicon.ico" /> -->
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/style.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function openCart() {
            location.replace("../cart/cart.php");
        }

        function deleteProdotto(id) {
            var ris = window.confirm("Sei sicuro di voler eliminare il prodotto selezionato?");
            if (ris) {
                location.replace("chkRimuovi.php?id_article=" + id);
            }
        }
    </script>
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
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="../index/index.php">Home</a></li>
                    <?php
                    if (isset($_SESSION['id_user'])) {
                        $q = "SELECT name, surname FROM users WHERE id_user = $_SESSION[id_user]";
                        $result = $conn->query($q);
                        $row = $result->fetch_assoc();
                        echo '<li class="nav-item"><a class="nav-link toggle" aria-current="page" href="../profile/profile.php">' . $row['name'] . ', ' .  $row['surname'] . '</a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link toggle" aria-current="page" href="../login/login.php">Accedi</a></li>';
                    } ?>
                </ul>
                <form class="d-flex" action="../cart/cart.php">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill"><?php
                                                                                    if (isset($_SESSION['id_user'])) {
                                                                                        if (isset($_COOKIE["cart_quantita_" . $_SESSION['id_user']])) {
                                                                                            $temp = explode("-", $_COOKIE["cart_quantita_" . $_SESSION['id_user']]);
                                                                                            $somma = 0;
                                                                                            for ($i = 0; $i < sizeof($temp); $i++) {
                                                                                                $somma += intval($temp[$i]);
                                                                                            }
                                                                                            $_SESSION["sommaProdotti_" . $_SESSION['id_user']] = $somma;
                                                                                            echo $somma;
                                                                                        } else {
                                                                                            echo "0";
                                                                                        }
                                                                                    } else if (isset($_COOKIE["cart_quantita"])) {
                                                                                        $temp = explode("-", $_COOKIE["cart_quantita"]);
                                                                                        $somma = 0;
                                                                                        for ($i = 0; $i < sizeof($temp); $i++) {
                                                                                            $somma += intval($temp[$i]);
                                                                                        }
                                                                                        $_SESSION["sommaProdotti"] = $somma;
                                                                                        echo $somma;
                                                                                    } else {
                                                                                        echo "0";
                                                                                    }
                                                                                    ?></span>
                    </button>

                </form>
                <form class="d-flex" action="insertProdotto.php">
                    <?php
                    if (isset($_SESSION['admin'])) {
                        if ($_SESSION['admin'] == 1) {
                            echo '<button class="btn btn-outline-dark" type="submit">
                        <i class="bi bi-plus-lg"></i>
                        Aggiungi un prodotto
                    </button>';
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Lista prodotti</h1>
                <p class="lead fw-normal text-white-50 mb-0"></p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <form action="index.php" method="POST">
            <div style="margin-left: 40%; margin-right: 40%;">
                <div class="input-group rounded">
                    <?php
                    if (isset($_SESSION['filtroSearch'])) {
                        echo '<input value="' . $_SESSION["filtroSearch"] . '" name="filtroSearch" type="search" class="form-control rounded" placeholder="Cerca" aria-label="Search" aria-describedby="search-addon" />';
                    } else {
                        echo '<input name="filtroSearch" type="search" class="form-control rounded" placeholder="Cerca" aria-label="Search" aria-describedby="search-addon" />';
                    } ?>
                    <button type="submit" class="input-group-text border-0" id="search-addon">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <!-- Inizio oggetto -->
                <?php
                $q = "SELECT * FROM articles";
                if (isset($_SESSION['filtroSearch'])) {
                    $q .= " WHERE name LIKE '%$_SESSION[filtroSearch]%'";
                }
                $result = $conn->query($q);
                $conn->close();
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col mb-5'>";
                    echo "<div class='card h-100'>";
                    echo "<img class='card-img-top' src='$row[image]' alt='...' />";
                    echo "<div class='card-body p-4'>";
                    echo "<div class='text-center'>";
                    echo "<h5 class='fw-bolder'><a href='prodotto.php?id=$row[id_article]'>$row[name]</a></h5>";
                    echo "$row[price]???<br>";
                    echo "$row[average_stars]&#9733;<br>";
                    if (isset($_SESSION['admin'])) {
                        if ($_SESSION['admin'] == 1) {
                            echo "<input id='txtNewQ$row[id_article]' onchange='changeV()' value='$row[amount]' type='number'/><button onclick='changeAmount($row[id_article])'>Aggiorna</button><br>";
                        }
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>";
                    echo "<div class='text-center'><a class='btn btn-outline-dark mt-auto' href='../cart/chkAddCart.php?id_article=$row[id_article]'>Aggiungi al carrello</a></div>";
                    if (isset($_SESSION['admin'])) {
                        if ($_SESSION['admin'] == 1) {
                            echo "<br>";
                            echo "<div class='text-center'><button class='btn btn-outline-dark mt-auto' onclick='deleteProdotto($row[id_article])'>Rimuovi dal database</button></div>";
                        }
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
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
    <script>
        function changeAmount(idArticle) {
            $.ajax({
                url: "chkChangeAmount.php?newQ=" + $("#txtNewQ" + idArticle).val() + "&idA=" + idArticle,
                success: function(data) {}
            });
        }
    </script>
</body>

</html>