<html>

<head>
    <script>
        function accedi() {
            window.location = "../login/login.php";
        }
    </script>
</head>

<body>
    <form action="chkRegister.php" method="POST">
        <label for="txtName">Nome</label><input type="text" name="txtName" required="true">
        <label for="txtSurname">Cognome</label><input type="password" name="txtSurname" required="true">
        <label for="txtMail">Mail</label><input type="password" name="txtMail" required="true">
        <label for="txtUsername">Username</label><input type="text" name="txtUsername" required="true">
        <label for="txtPass">Password</label><input type="password" name="txtPass" required="true">
        <label for="txtPassConfirm">Ripeti password</label><input type="password" name="txtPassConfirm" required="true">
        <input value="Registrati" type="submit">
    </form><input type="submit" value="Hai un account? Accedi" onclick="accedi()">


</body>

</html>