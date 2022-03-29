<html>

<head>
    <script>
        function registrati() {
            window.location = "../register/register.php";
        }
    </script>
</head>

<body>

    <form action="chkLogin.php" method="POST">
        <label for="txtUsernameOrMail">Username o Mail</label><input type="text" name="txtUsernameOrMail" required="true">
        <label for="txtPass">Password</label><input type="password" name="txtPass" required="true">
        <input value="Accedi" type="submit">
    </form><input type="submit" value="Non hai un account? Registrati" onclick="registrati()">
    <?php
    if (isset($_GET["msg"])) {
        echo $_GET["msg"];
    }
    ?>


</body>

</html>