<?php
include("../chkSession.php");
include("../connection.php");
?>

<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>E-Commerce Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/style.css" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">E-Commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link toggle" aria-current="page" href="../index/index.php">Home</a></li>
                    <?php
                    if (isset($_SESSION['id_user'])) {
                        include("../connection.php");
                        $q = "SELECT name, surname FROM users WHERE id_user = $_SESSION[id_user]";
                        $result = $conn->query($q);
                        $row = $result->fetch_assoc();
                        echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="../profile/profile.php">' . $row['name'] . ', ' .  $row['surname'] . '</a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="../login/login.php">Accedi</a></li>';
                    } ?>
                </ul>
                <form class="d-flex" action="../cart/cart.php">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill"><?php
                                                                                    $stringCookieID = "cart_ids";
                                                                                    $stringCookieQuantita = "cart_quantita";
                                                                                    $quantitaSessionName = "sommaProdotti";
                                                                                    if (isset($_SESSION['id_user'])) {
                                                                                        $stringCookieID = "cart_ids_" . $_SESSION['id_user'];
                                                                                        $stringCookieQuantita = "cart_quantita_" . $_SESSION['id_user'];
                                                                                        $quantitaSessionName = "sommaProdotti_" . $_SESSION['id_user'];
                                                                                    }
                                                                                    if (isset($_COOKIE[$stringCookieQuantita])) {
                                                                                        echo $_SESSION[$quantitaSessionName];
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
    <header class="bg-dark py-1">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Modifica Profilo</h1>
                <p class="lead fw-normal text-white-50 mb-0">Qui puoi modificare il tuo profilo</p>
            </div>
        </div>
    </header>
    <!--Profilo-->
    <form action="chkEdit.php" method="POST">
        <div class="text-center">
            <?php
            $q = "SELECT * FROM users WHERE id_user = $_SESSION[id_user]";
            $result = $conn->query($q);
            $row = $result->fetch_assoc();
            if ($result->num_rows > 0) {
                //echo var_dump($row);
                echo "<label>Mail: </label><input name='txtMail' type='text' value='$row[mail]'><br><br>";
                echo "<label>Username: </label><input name='txtUsername' type='text' value='$row[username]'><br><br>";
                echo "<label>Nome: </label><input name='txtName' type='text' value='$row[name]'><br><br>";
                echo "<label>Cognome: </label><input name='txtSurname' type='text' value='$row[surname]'><br>";
            }
            ?>
            <br>
            <input type="submit"></input>
        </div>
    </form>
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