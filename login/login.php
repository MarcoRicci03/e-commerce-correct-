<html>

<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script>
    </script>
</head>

<body>

    <form action="chkLogin.php" method="POST">
    <div class="container mt-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card px-5 py-5" id="form1">
                        <div class="form-data" v-if="!submitted">
                            <div class="forms-inputs mb-4"> <span>Username o Mail</span> <input autocomplete="off" type="text" name="txtUsernameOrMail" required="true"></div>
                            <div class="forms-inputs mb-4"> <span>Password</span> <input autocomplete="off" type="password" name="txtPass" required="true"></div>
                            <div class="mb-3"> <input value="Accedi" type="submit" class="btn btn-dark w-100"></div>
                            <div class="mb-3"> <a href="../index/index.php" class="btn btn-dark w-100">Accedi come guest</a> </div>
                            <div class="mb-3"> <a href="../register/register.php" class="btn btn-dark w-100">Non hai un account? Registrati</a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    if (isset($_GET["msg"])) {
        echo $_GET["msg"];
    }
    ?>


</body>

</html>