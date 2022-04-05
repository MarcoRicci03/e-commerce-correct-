<?php
include("../chkSession.php");
include("../connection.php");
?>

<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/style.css" rel="stylesheet" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link toggle" aria-current="page" href="../index/index.php">Home</a></li>
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
                    <li class="nav-item dropdown"><a class="nav-link active" aria-current="page" href="../profile/profile.php">Profile</a></li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-1">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Profilo</h1>
                <p class="lead fw-normal text-white-50 mb-0">Qui puoi visualizzare e modificare il tuo profilo</p>
            </div>
        </div>
    </header>
    <!--Profilo-->
    <div class="text-center">
        <?php
        $q = "SELECT * FROM users WHERE id_user = $_SESSION[id_user]";
        $result = $conn->query($q);
        $row = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            //echo var_dump($row);
            echo "<label>Mail: $row[mail]</label><br>";
            echo "<label>Username: $row[username]</label><br>";
            echo "<label>Nome: $row[name]</label><br>";
            echo "<label>Cognome: $row[surname]</label><br>";
        }
        ?>
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