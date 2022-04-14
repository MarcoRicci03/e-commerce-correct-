<html>

<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script>
        function accedi() {
            window.location = "../login/login.php";
        }

        function chkPass() {
            var pass1 = document.getElementById("pass1").value;
            var pass2 = document.getElementById("pass2").value;
            if (pass1 != pass2) {
                window.location.replace("register.php?msg=Le password non corrispondono.");
            }
        }
    </script>
</head>

<body>
    <form action="chkRegister.php" method="POST">
        <div class="container mt-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card px-5 py-5" id="form1">
                        <div class="form-data" v-if="!submitted">
                            <div class="forms-inputs mb-4"> <span>Nome</span> <input autocomplete="off" type="text" name="txtName" required="true"></div>
                            <div class="forms-inputs mb-4"> <span>Cognome</span> <input autocomplete="off" type="text" name="txtSurname" required="true"></div>
                            <div class="forms-inputs mb-4"> <span>Mail</span> <input autocomplete="off" type="mail" name="txtMail" required="true"></div>
                            <div class="forms-inputs mb-4"> <span>Username</span> <input autocomplete="off" type="text" name="txtUsername" required="true"></div>
                            <div class="forms-inputs mb-4"> <span>Password</span> <input id="pass1" autocomplete="off" type="password" name="txtPass" required="true"></div>
                            <div class="forms-inputs mb-4"> <span>Ripeti password</span> <input id="pass2" autocomplete="off" type="password" name="txtPassConfirm" required="true"></div>
                            <div class="mb-3"> <input value='Registrati' type="submit" onclick="chkPass()" class="btn btn-dark w-100"></a> </div>
                            <div class="mb-3"> <a href="../index/index.php" class="btn btn-dark w-100">Accedi come guest</a> </div>
                            <div class="mb-3"> <a href="../login/login.php" class="btn btn-dark w-100">Hai giá un account? Accedi</a></div>
                            <?php
                            if (isset($_GET["msg"])) {
                                echo $_GET["msg"];
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</body>

</html>