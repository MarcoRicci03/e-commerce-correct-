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
    <script>
        function logOut() {
            var ris = window.confirm("Sei sicuro di voler fare il logout?");
            if (ris) {
                window.location.replace('logout.php');
            }
        }

        function delIndirizzo($id) {
            var ris = window.confirm("Sei sicuro di voler cancellare questo indirizzo?");
            if (ris) {
                window.location.replace('deleteAddress.php?id='+ $id);
            }
        }
    </script>
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

        <a href="editProfile.php">Modifica i tuoi dati</a>
        <br>
        <button onclick="logOut()">Logout</button>
        <div style="margin-left: 25%; margin-right: 25%;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Indirizzo</th>
                        <th scope="col">Cittá</th>
                        <th scope="col">Codice postale</th>
                        <th scope="col">Elimina</th>
                    </tr>
                </thead>
                <?php
                $q = "SELECT * FROM addresses WHERE id_user = $_SESSION[id_user]";
                $result = $conn->query($q);
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo '<th scope="row">1</th>';
                    echo "<td>$row[address]</td>";
                    echo "<td>$row[city]</td>";
                    echo "<td>$row[postal_code]</td>";
                    echo "<td><button style='border: none;' onclick='delIndirizzo($row[id_address])'><i class='bi bi-trash'></i></button></td>";
                }
                ?>
            </table>
            <a href="addAddress.php">Aggiungi un indirizzo</a>
        </div>
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